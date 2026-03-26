<?php
namespace App\Modules\Frontend\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\BonusRepository;
use App\Repositories\NavBannerRepository;
use App\Repositories\NavigationRepository;
use App\Repositories\NavQuickServiceRepository;
use App\Repositories\ShopConfigRepository;
use App\Repositories\TemplateCatRepository;
use App\Repositories\TemplateItemRepository;
use App\Repositories\TemplateRepository;
use App\Repositories\TemplateSelectorRepository;
use App\Services\ConnectApi;
use App\Services\SmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Overtrue\EasySms\Exceptions\Exception;
use QL\QueryList;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;

header('Access-Control-Allow-Origin:*'); //设置http://www.baidu.com允许跨域访问
header('Access-Control-Allow-Headers: X-Requested-With,X_Requested_With'); //设置允许的跨域header

class HomeController extends Frontend
{
    protected $template;
    protected $selector;
    protected $templateItem;
    protected $templateCat;
    protected $navBanner;
    protected $navigation;
    protected $navQuickService;

    public function __construct()
    {
        parent::__construct();
//        $this->template = new  TemplateRepository();
//        $this->selector = new TemplateSelectorRepository();
//        $this->templateItem = new TemplateItemRepository();
//        $this->templateCat = new TemplateCatRepository();
//        $this->navBanner = new NavBannerRepository();
//        $this->navigation = new NavigationRepository();
//        $this->navQuickService = new NavQuickServiceRepository();
    }

    //新的首页-2024-04-08 start============================================
    public function home(Request $request)
    {
        //tinyify文件
//        require_once(base_path()."/vendor/tinify-php-master/lib/Tinify/Exception.php");
//        require_once(base_path()."/vendor/tinify-php-master/lib/Tinify/ResultMeta.php");
//        require_once(base_path()."/vendor/tinify-php-master/lib/Tinify/Result.php");
//        require_once(base_path()."/vendor/tinify-php-master/lib/Tinify/Source.php");
//        require_once(base_path()."/vendor/tinify-php-master/lib/Tinify/Client.php");
//        require_once(base_path()."/vendor/tinify-php-master/lib/Tinify.php");

        #授权登录跳转=======start
        $data = $request->all();
        if (isset($data['authid'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
            $device = $_SERVER['HTTP_USER_AGENT'];
            $info = Db::connection('shop_db')->table('website_login_log')->where(['ip'=>$ip,'device'=>$device,'status'=>1,'id'=>intval($data['authid'])])->first();
            $info = objtoarr($info);
            if ($info) {
                $account = Db::table('user')->where(['email'=>$info['account']])->first();
                $account = objtoarr($account);

                $request->session()->put('user', objtoarr($account));
                session('user', objtoarr($account));

                auth()->guard('user')->attempt(
                    ['email'=>$account['email'],'password'=>'888888'],
                    $request->filled('remember')
                );
            }

            header("Location: /");
        }
        #授权登录跳转=======end
        
        $template = '';
        #获取配置信息
        $website = get_website();
        
        // 1. 一次性加载所有常用表（内存缓存 5 分钟，极大减少查询）
        #口号
        $data['slogan'] = Cache::remember('home_slogan', 86400, function() {
            return DB::connection('shop_db')->table('website_slogan')->where(['system_id'=>3])->orderBy('id','asc')->get();
        });
        $data['slogan'] = objtoarr($data['slogan']);
        #轮播图
        $rotate = Cache::remember('home_rotate', 86400, function() {
            if(is_mobile()){
                $rotate_list = DB::connection('shop_db')->table('website_rotate')->where(['system_id'=>3])->get()->toArray();
                $rotate_list = objtoarr($rotate_list);
                foreach($rotate_list as $k=>$v){
                    if(empty($v['mob_thumb'])){
                        $rotate_list[$k]['thumb'] = $v['mob_thumb'];
                    }
                }
            }else{
                $rotate_list = DB::connection('shop_db')->table('website_rotate')->where(['system_id'=>3])->get();
                return objtoarr($rotate_list);
            }
        });
        
        #站内消息
        $data['msg'] = Cache::remember('home_msg', 86400, function() {
            return DB::connection('shop_db')->table('website_message_manage')->get();
        });
        $data['msg'] = objtoarr($data['msg']);
        #汇率
        $data['rate'] = Cache::remember('home_rate', 86400, function() {
            return DB::connection('shop_db')->table('website_exchange_rate')->whereRaw('id != 158')->get();
        });
        $data['rate'] = objtoarr($data['rate']);
        #其他币种
        $currency = Cache::remember('home_currency', 86400, function() {
            return DB::connection('shop_db')->table('centralize_currency')->whereRaw('code_zhname <> "人民币元"')->get()->keyBy('id');
        });
        #世界城市
        $citys = Cache::remember('home_citys', 86400, function() {
            return DB::connection('shop_db')->table('website_world_time')->where(['is_show'=>0])->orderBy('displayorder','asc')->get()->groupBy('contryCn');
        });
        $citys = objtoarr($citys);

        #请求thinify接口，返回压缩的图片
//        \Tinify\setKey("8ZrSBL0MSmvB563TRcdGf7wkfnq7BthZ");
        foreach ($rotate as $k=>$v) {
//            if(empty($v['api_thumb'])){
//                $source = \Tinify\fromUrl("https://shop.gogo198.cn/".$v['thumb']);
//                $true_pic = str_replace("collect_website/public/uploads/centralize/website_rotate/",'',$v['thumb']);
//                $pic = $source->toFile("/www/wwwroot/gogo/collect_website/public/uploads/centralize/website_rotate/api_thumb_".$true_pic);
//                Db::connection('shop_db')->table('website_rotate')->where(['system_id'=>3,'id'=>$v['id']])->update([
//                    'api_thumb'=>"collect_website/public/uploads/centralize/website_rotate/api_thumb_".$true_pic
//                ]);
//            }
            $rotate[$k]['link'] = $this->getAppLink($v['go_other'], $v, 'lunbo');
        }

        #搜索栏
//        $search = Db::table('search_setting')->where(['id'=>1])->first();
//        $search = objtoarr($search);
        
        // 新闻（去掉 inRandomOrder，改用 orderBy 提速）
        $news = DB::connection('shop_db')->table('website_crossborder_news')
            ->where(['time'=>date('Y-m-d')])->orderBy('id','desc')->limit(50)->get();
        if($news->isEmpty()){
            $news = DB::connection('shop_db')->table('website_crossborder_news')->where(['status'=>1])->orderBy('id','desc')->limit(50)->get();
        }
        $news = objtoarr($news);

        #访问量
        $yesterday_timestamp = strtotime("-1 day");
        $yesterday_startDate = strtotime(date("Y-m-d 00:00:00", $yesterday_timestamp));
        $yesterday_endDate = strtotime(date("Y-m-d 23:59:59", $yesterday_timestamp));
        $data['yesterday'] = Db::connection('shop_db')->table('system_log')->whereRaw('createtime>='.$yesterday_startDate.' and createtime<='.$yesterday_endDate)->count();
        $time = time();
        $month_startDate = strtotime(date("Y-m-1 00:00:00", $time));
        $month_endDate = strtotime(date("Y-m-30 23:59:59", $time));
        $data['this_month'] = Db::connection('shop_db')->table('system_log')->whereRaw('createtime>='.$month_startDate.' and createtime<='.$month_endDate)->count();

        #发现轮播图
        $discovery_rotate = Db::connection('shop_db')->table('website_discovery_list')->where(['system_id'=>3,'company_id'=>0])->get();
        $discovery_rotate = objtoarr($discovery_rotate);

        #热卖商品
        $hotbuy = Cache::remember('home_hotbuy_v3', 86400, function () use ($currency) {
            #查询板块有无发现轮播样式
            $website_index_format = Db::connection('shop_db')->table('website_index')->where(['system_id'=>3,'format_type'=>3])->select(['supply_show','api_merchant'])->first();
            $api_id = [-1];
            if(!empty($website_index_format->api_merchant)){
                $api_id = explode(',',$website_index_format->api_merchant);
            }
            $new_goods = DB::table('goods')->where(['goods_status'=>1,'shop_id'=>0])->whereIn('api_id',$api_id)->orderBy('goods_id', 'desc')->first();
        
            $hotbuy = DB::table('goods')
                ->where(['goods_status'=>1,'level_id'=>0,'shop_id'=>0])
                ->where('goods_id', '<>', optional($new_goods)->goods_id)
                ->whereIn('api_id',$api_id)
                ->orderBy('goods_id', 'desc')
                ->limit(60)
                ->get();
        
            $goods_ids = $hotbuy->pluck('goods_id')->all();
        
            $all_sku = DB::table('goods_sku')
                ->whereIn('goods_id', $goods_ids)
                ->get()
                ->keyBy('goods_id');  // 注意：这里改成 keyBy goods_id 而不是 sku_id！！！
        
            $all_images = DB::table('goods_image')
                ->whereIn('goods_id', $goods_ids)
                ->get()
                ->groupBy('goods_id');
        
            $result = [];
            foreach ($hotbuy as $goods) {
                $sku = $all_sku->get($goods->goods_id);
        
                $sku_prices = $sku ? json_decode($sku->sku_prices, true) : ['price' => [$goods->goods_price], 'currency' => [5]];
                
                $price = ($goods->goods_price ?? 0) == 0 ? end($sku_prices['price'] ?? [0]) : ($goods->goods_price ?? 0);
                $currency_symbol = $currency[$sku_prices['currency'][0] ?? 5]['currency_symbol_standard'] ?? 'CNY';
        
                // 安全处理图片：如果字段不对，fallback 到 goods->goods_image
                $main_imgs_raw = $all_images->get($goods->goods_id, collect());
                $main_imgs = $main_imgs_raw->toArray();
                if (empty($main_imgs)) {
                    $main_imgs = [];  // fallback 到商品主图
                }
                
                $result[] = [
                    'goods_id'      => $goods->goods_id,
                    'goods_name'    => $goods->goods_name ?? '',
                    'goods_image'   => $goods->goods_image ?? '',
                    'goods_price'   => number_format($price, 2),
                    'currency'      => $currency_symbol,
                    'mainItemImgs'  => $main_imgs,  // 现在是纯数组，不会出错
                ];
            }
            shuffle($result);
            return $result;
        });
        $hotbuy = objtoarr($hotbuy);
        
        #导页版式 START===========================================================
        $cache = is_mobile2() ? 'home_guide_all_mobile' : 'home_guide_all_pc';
        if(1>2){
            #旧版
            $guide = Cache::remember($cache, 86400, function () use ($currency) {
                // 1. 主体 + 版式一次性加载
                $guide_bodies = DB::table('guide_body')
                    ->where('company_id', 0)
                    ->where('system_id', 3)
                    ->orderBy('displayorders', 'asc')
                    ->get();
            
                $content_ids = $guide_bodies->pluck('content_id')->unique()->filter()->values()->all();
            
                $formats = DB::table('guide_format')
                    ->whereIn('id', $content_ids)
                    ->get()
                    ->keyBy('id');
            
                // 2. 预加载上架商品相关数据（type=7）
                $all_shelf = DB::table('goods_shelf')
                    ->where('type', 2)
                    ->whereIn('guide_id', $guide_bodies->pluck('id')->all())
                    ->where('keywords', '<>', '')
                    ->get();
            
                $all_goods_ids = $all_shelf->pluck('gid')->unique()->all();
            
                $goods_map = DB::table('goods')
                    ->whereIn('goods_id', $all_goods_ids)
                    ->where('goods_status', 1)
                    ->get()
                    ->keyBy('goods_id');
            
                $sku_map = DB::table('goods_sku')
                    ->whereIn('goods_id', $all_goods_ids)
                    ->get()
                    ->keyBy('goods_id');
            
                // 3. 颜色预加载（type=8）
                $colors = DB::connection('shop_db')
                    ->table('centralize_diycountry_content')
                    ->where('pid', 12)
                    ->inRandomOrder()
                    ->limit(100)
                    ->get()
                    ->toArray();
            
                $color_count = count($colors);
                $color_index = 0;
            
                $result = [];
            
                foreach ($guide_bodies as $item) {
                    $format = $formats->get($item->content_id);
                    if (!$format) {
                        continue;
                    }
            
                    $row = (array) $item;
                    $row['content_info'] = (array) $format;
            
                    // ========= 类型7：平台推荐商品 =========
                    if ($format->type == 7) {
                        $goods_list = collect();
            
                        // 上架商品匹配
                        foreach ($all_shelf as $s) {
                            if ($s->guide_id != $item->id) continue;
            
                            $g = $goods_map->get($s->gid);
                            if (!$g) continue;
            
                            $arr1 = array_filter(explode('、', $s->keywords));
                            $arr2 = array_filter(explode('、', $item->gkeywords));
                            if (empty(array_intersect($arr1, $arr2))) continue;
            
                            $sku = $sku_map->get($g->goods_id);
                            $sku_prices = $sku ? json_decode($sku->sku_prices, true) : ['price' => [$g->goods_price]];
            
                            $goods_list->push((object) [
                                'goods_id'       => $g->goods_id,
                                'goods_name'     => $g->goods_name,
                                'goods_image'    => $g->goods_image,
                                'company'        => 'Gogo',
                                'goods_currency' => $currency[$g->goods_currency]['currency_symbol_standard'] ?? 'CNY',
                                'price'          => number_format(end($sku_prices['price']), 2),
                            ]);
                        }
            
                        // 关键字兜底商品
                        if (!empty(trim($item->gkeywords))) {
                            $keywords = array_filter(explode('、', $item->gkeywords));
            
                            $kw_goods = DB::table('goods')
                                ->join('goods_keywords', 'goods.keywords_id', '=', 'goods_keywords.id')
                                ->whereIn('goods_keywords.keywords', $keywords)
                                ->where('goods.goods_status', 1)
                                ->select('goods.*')
                                ->limit(30)
                                ->get();
            
                            foreach ($kw_goods as $g) {
                                $sku = $sku_map->get($g->goods_id);
                                $sku_prices = $sku ? json_decode($sku->sku_prices, true) : ['price' => [$g->goods_price]];
            
                                $goods_list->push((object) [
                                    'goods_id'       => $g->goods_id,
                                    'goods_name'     => $g->goods_name,
                                    'goods_image'    => $g->goods_image,
                                    'company'        => 'Gogo',
                                    'goods_currency' => $currency[$g->goods_currency]['currency_symbol_standard'] ?? 'CNY',
                                    'price'          => number_format(end($sku_prices['price']), 2),
                                ]);
                            }
                        }
            
                        $row['goods_info'] = $goods_list->shuffle()->take(30)->values()->toArray();
                    }
            
                    // ========= 类型8：产业集聚 =========
                    elseif ($format->type == 8) {
                        $big_children = DB::table('guide_content')
                            ->where([
                                'system_id'  => 3,
                                'company_id' => 0,
                                'pid'        => $item->id,
                                'is_show'    => 0,
                                'type'       => 1
                            ])
                            ->orderBy('displayorders', 'asc')
                            ->get();
            
                        $small_all = DB::table('guide_content')
                            ->where([
                                'system_id'  => 3,
                                'company_id' => 0,
                                'pid'        => $item->id,
                                'is_show'    => 0,
                                'type'       => 0
                            ])
                            ->get()
                            ->groupBy('top_id');
            
                        foreach ($big_children as $big) {
                            $big->link2 = $this->getAppLink($big->go_other, (array)$big, 'guide');
            
                            $sml = $small_all->get($big->id, collect())
                                            ->merge($small_all->get(0, collect()))
                                            ->take(is_mobile2() ? 8 : 12);
            
                            foreach ($sml as $s) {
                                $color = $colors[$color_index % $color_count];
                                $color_index++;
            
                                $s->rand_background = sprintf("#%02x%02x%02x", $color->param1, $color->param2, $color->param3);
                                $s->name  = mb_substr($s->name, 0, 2, 'UTF-8');
                                $s->name2 = mb_substr($s->name, 2, null, 'UTF-8');
                                $s->link2 = $this->getAppLink($s->go_other, (array)$s, 'guide');
                            }
            
                            $big->sml_children = $sml->chunk(4)->toArray();
                        }
            
                        $row['big_children'] = $big_children->toArray();
                    }
            
                    // ========= 类型9：环球节庆（关键修复：去掉 fn()） =========
                    elseif ($format->type == 9) {
                        $festival = Cache::remember('home_festival_v2', 86400, function () {
                            return DB::connection('shop_db')
                                ->table('website_festival')
                                ->whereRaw('date >= DATE_SUB(CURDATE(), INTERVAL 1 DAY)')
                                ->whereRaw('date <= DATE_ADD(CURDATE(), INTERVAL 15 DAY)')
                                ->orderBy('date', 'asc')
                                ->get()
                                ->toArray();
                        });
            
                        $festival = addCountryPic(objtoarr($festival));
            
                        // 手动过滤（替代 fn()）
                        $filtered = [];
                        foreach ($festival as $item) {
                            if (!isset($item['is_deplicate'])) {
                                $filtered[] = $item;
                            }
                        }
                        $festival = $filtered;
            
                        $festival = array_values($festival);
                        shuffle($festival);
            
                        $chunks = collect($festival)->chunk(is_mobile2() ? 1 : 6);
                        $final_chunks = [];
                        foreach ($chunks as $chunk) {
                            $final_chunks[] = $chunk->chunk(is_mobile2() ? 1 : 3)->toArray();
                        }
                        $row['children'] = $final_chunks;
                    }
            
                    $result[] = $row;
                }
            
                return $result;
            });
        }else{
            $guide = Cache::remember($cache, 86400, function () use ($currency) {
                #首页板块
                $services = Db::connection('shop_db')->table('website_index')->where(['system_id'=>3])->orderBy('displayorder','asc')->get();
                $services = objtoarr($services);
                
                foreach($services as $k=>$v){
                    if($v['format_type']==2){
                        #内容切换框
                        $services[$k]['content'] = json_decode($v['content'],true);
        
                        #按键内容
                        $services[$k]['btn_content'] = json_decode($v['btn_content'],true);
                        foreach($services[$k]['btn_content'] as $k2=>$v2){
                            $services[$k]['btn_content'][$k2]['id'] = $v['id'];
                            $services[$k]['btn_content'][$k2]['link'] = $this->getAppLink($v2['go_other'],$services[$k]['btn_content'][$k2],'btn');
                        }
                    }
                    elseif($v['format_type']==4){
                        #标题和描述折叠框
                        $services[$k]['fq_content'] = json_decode($v['fq_content'],true);
                    }
                    elseif($v['format_type']==5){
                        #一问一答图文轮播
                        $services[$k]['fq_category_content'] = json_decode($v['fq_category_content'],true);
                        foreach($services[$k]['fq_category_content'] as $k2=>$v2){
                            $services[$k]['fq_category_content'][$k2]['fq_list'] = Db::connection('shop_db')->table('website_image_txt')->whereRaw('id in ('.$v2['fq_ids'].')')->select(['id','name','createtime'])->orderBy('id','desc')->get();
                            $services[$k]['fq_category_content'][$k2]['fq_list'] = objtoarr($services[$k]['fq_category_content'][$k2]['fq_list']);
                            foreach($services[$k]['fq_category_content'][$k2]['fq_list'] as $k3=>$v3){
                                $services[$k]['fq_category_content'][$k2]['fq_list'][$k3]['name'] = json_decode($v3['name'],true)['zh'];
                                $services[$k]['fq_category_content'][$k2]['fq_list'][$k3]['createtime'] = date('Y-m-d',$v3['createtime']);
                            }
                        }
                    }
                    elseif($v['format_type']==6){
                        #标题+描述+图片（一行四个）卡片
                        $services[$k]['card1_content'] = json_decode($v['card1_content'],true);
                    }
                    elseif($v['format_type']==7){
                        #标题+图标（两行各五个）卡片
                        $services[$k]['card2_content'] = json_decode($v['card2_content'],true);
                    }
                    elseif($v['format_type']==8){
                        #标题+描述+图片（两行各两个）卡片
                        $services[$k]['card3_content'] = json_decode($v['card3_content'],true);
                    }
                    elseif($v['format_type']==9){
                        #标题+图片（一排四个）卡片样式
                        if($v['bind_festival']==1){
                            $services[$k]['children'] = $this->get_festival();
                        }elseif($v['supply_show']==0){
                            #接口商品
                            $services[$k]['children'] = $this->get_api_goods($v['api_merchant'],$currency,$v);
                        }elseif($v['supply_show']==1){
                            #买手商品
                            $services[$k]['children'] = $this->get_buyer_goods($v['buyer_merchant'],$currency,$v);
                        }elseif($v['supply_show']==2){
                            #店铺商品
                            $services[$k]['children'] = $this->get_shop_goods($v['shop_merchant'],$currency,$v);
                        }elseif(!empty($v['gkeywords'])){
                            $services[$k]['children'] = $this->get_keywords_goods($v['gkeywords'],$currency,$v);
                        }else{
                            $services[$k]['children'] = Db::table('guide_content')->where(['pid'=>$v['id'],'system_id'=>3,'top_id'=>0])->get();
                            $services[$k]['children'] = objtoarr($services[$k]['children']);
                            foreach($services[$k]['children'] as $k2=>$v2){
                                $services[$k]['children'][$k2]['back_content'] = 'https://shop.gogo198.cn/'.$v2['back_content'];
                            }
                        }
                        
                        shuffle($services[$k]['children']);
                    }
                    elseif($v['format_type']==10){
                        #标题+图片（一排三个）卡片样式
                        
                        if($v['bind_festival']==1){
                            $services[$k]['children'] = $this->get_festival();
                        }elseif($v['supply_show']==0){
                            #接口商品
                            $services[$k]['children'] = $this->get_api_goods($v['api_merchant'],$currency,$v);
                        }elseif($v['supply_show']==1){
                            #买手商品
                            $services[$k]['children'] = $this->get_buyer_goods($v['buyer_merchant'],$currency,$v);
                        }elseif($v['supply_show']==2){
                            #店铺商品
                            $services[$k]['children'] = $this->get_shop_goods($v['shop_merchant'],$currency,$v);
                        }elseif(!empty($v['gkeywords'])){
                            $services[$k]['children'] = $this->get_keywords_goods($v['gkeywords'],$currency,$v);
                        }else{
                            $services[$k]['children'] = Db::table('guide_content')->where(['pid'=>$v['id'],'system_id'=>3,'top_id'=>0])->get();
                            $services[$k]['children'] = objtoarr($services[$k]['children']);
                            foreach($services[$k]['children'] as $k2=>$v2){
                                $services[$k]['children'][$k2]['back_content'] = 'https://shop.gogo198.cn/'.$v2['back_content'];
                            }
                        }
                        
                        shuffle($services[$k]['children']);
                    }
                    elseif($v['format_type']==11){
                        #标题+图片（两排六个）卡片样式
                        
                        if($v['bind_festival']==1){
                            $services[$k]['children'] = $this->get_festival();
                        }elseif($v['supply_show']==0){
                            #接口商品
                            $services[$k]['children'] = $this->get_api_goods($v['api_merchant'],$currency,$v);
                        }elseif($v['supply_show']==1){
                            #买手商品
                            $services[$k]['children'] = $this->get_buyer_goods($v['buyer_merchant'],$currency,$v);
                        }elseif($v['supply_show']==2){
                            #店铺商品
                            $services[$k]['children'] = $this->get_shop_goods($v['shop_merchant'],$currency,$v);
                        }elseif(!empty($v['gkeywords'])){
                            $services[$k]['children'] = $this->get_keywords_goods($v['gkeywords'],$currency,$v);
                        }else{
                            $services[$k]['children'] = Db::table('guide_content')->where(['pid'=>$v['id'],'system_id'=>3,'top_id'=>0])->get();
                            $services[$k]['children'] = objtoarr($services[$k]['children']);
                            // foreach($services[$k]['children'] as $k2=>$v2){
                            //     $services[$k]['children'][$k2]['back_content'] = 'https://shop.gogo198.cn/'.$v2['back_content'];
                            // }
                            
                            shuffle($services[$k]['children']);
                            if(is_mobile2()){
                                $services[$k]['children'] = array_chunk($services[$k]['children'],1);
                            }else{
                                $services[$k]['children'] = array_chunk($services[$k]['children'],6);
                            }
            
                            foreach($services[$k]['children'] as $k2=>$v2){
                                if(is_mobile2()){
                                    $services[$k]['children'][$k2] = array_chunk($v2,1);
                                }else{
                                    $services[$k]['children'][$k2] = array_chunk($v2,3);
                                }
                            }
                        }
                    }
                    elseif($v['format_type']==12){
                        #杂志导航
                        $services[$k]['big_children'] = Db::table('guide_content')->where(['top_id'=>0,'pid'=>$v['id'],'system_id'=>3,'is_show'=>0])->get();
                        $services[$k]['big_children'] = objtoarr($services[$k]['big_children']);
                        foreach($services[$k]['big_children'] as $k2=>$v2){
                            $services[$k]['big_children'][$k2]['sml_children'] = Db::table('guide_content')->where(['pid'=>$v['id'],'top_id'=>$v2['id'],'system_id'=>3])->get();
                            $services[$k]['big_children'][$k2]['sml_children'] = objtoarr($services[$k]['big_children'][$k2]['sml_children']);
        
                            if(is_mobile2()){
                                $services[$k]['big_children'][$k2]['sml_children'] = array_chunk($services[$k]['big_children'][$k2]['sml_children'],4);
                            }else{
                                $services[$k]['big_children'][$k2]['sml_children'] = array_chunk($services[$k]['big_children'][$k2]['sml_children'],4);
                            }
                            
                            foreach($services[$k]['big_children'][$k2]['sml_children'] as $k3=>$v3){
                                foreach($v3 as $k4=>$v4) {
                                    $color = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['pid' => 12])->inRandomOrder()->first();
    
                                    $services[$k]['big_children'][$k2]['sml_children'][$k3][$k4]['rand_background'] = sprintf("#%02x%02x%02x", $color->param1, $color->param2, $color->param3);
                                }
                            }
                        }
                        
                        // 调用函数处理 $arr
                        $services[$k] = $this->fillSmlChildren($services[$k]);
                    }
                    elseif($v['format_type']==13){
                        #标题+图片（一排两个）卡片样式
                        
                        if($v['bind_festival']==1){
                            $services[$k]['children'] = $this->get_festival();
                        }elseif($v['supply_show']==0){
                            #接口商品
                            $services[$k]['children'] = $this->get_api_goods($v['api_merchant'],$currency,$v);
                        }elseif($v['supply_show']==1){
                            #买手商品
                            $services[$k]['children'] = $this->get_buyer_goods($v['buyer_merchant'],$currency,$v);
                        }elseif($v['supply_show']==2){
                            #店铺商品
                            $services[$k]['children'] = $this->get_shop_goods($v['shop_merchant'],$currency,$v);
                        }elseif(!empty($v['gkeywords'])){
                            $services[$k]['children'] = $this->get_keywords_goods($v['gkeywords'],$currency,$v);
                        }else{
                            $services[$k]['children'] = Db::table('guide_content')->where(['pid'=>$v['id'],'system_id'=>3,'top_id'=>0])->get();
                            $services[$k]['children'] = objtoarr($services[$k]['children']);
                            foreach($services[$k]['children'] as $k2=>$v2){
                                $services[$k]['children'][$k2]['back_content'] = 'https://shop.gogo198.cn/'.$v2['back_content'];
                            }
                        }
                        shuffle($services[$k]['children']);
                    }
        
                    if($v['format']==1){
                        $services[$k]['info'] = Db::connection('shop_db')->table('website_navbar')->where(['id'=>$v['navbar_id']])->select(['id','name','desc','format','color','go_other','other_link','other_navbar','thumb'])->first();
                        $services[$k]['info'] = objtoarr($services[$k]['info']);
                        $services[$k]['info']['name'] = json_decode($services[$k]['info']['name'],true)['zh'];
                        $services[$k]['info']['desc'] = isset($services[$k]['info']['desc'])?json_decode($services[$k]['info']['desc'],true)['zh']:'';
                        // $services[$k]['info']['desc'] = explode('、',$services[$k]['info']['desc']);
                        $services[$k]['info']['children'] = Db::connection('shop_db')->table('website_navbar')->where('pid',$services[$k]['info']['id'])->select(['id','name','desc','thumb','format','color','go_other','other_link','other_navbar'])->get();
                        $services[$k]['info']['children'] = objtoarr($services[$k]['info']['children']);
                        // dd($services[$k]['info']['children']);
                        foreach($services[$k]['info']['children'] as $k2=>$v2){
                            $services[$k]['info']['children'][$k2]['name'] = json_decode($services[$k]['info']['children'][$k2]['name'],true)['zh'];
                            $services[$k]['info']['children'][$k2]['desc'] = json_decode($services[$k]['info']['children'][$k2]['desc'],true)['zh'];
                            $services[$k]['info']['children'][$k2]['desc'] = explode('、',$services[$k]['info']['children'][$k2]['desc']);
                            $services[$k]['info']['children'][$k2]['children'] = Db::connection('shop_db')->table('website_navbar')->where('pid',$v2['id'])->select(['id','name','desc','thumb','format','color','go_other','other_link','other_navbar'])->get();
                            $services[$k]['info']['children'][$k2]['children'] = objtoarr($services[$k]['info']['children'][$k2]['children']);
                            foreach($services[$k]['info']['children'][$k2]['children'] as $k3=>$v3){
                                $services[$k]['info']['children'][$k2]['children'][$k3]['name'] = json_decode($services[$k]['info']['children'][$k2]['children'][$k3]['name'],true)['zh'];
                                $services[$k]['info']['children'][$k2]['children'][$k3]['desc'] = json_decode($services[$k]['info']['children'][$k2]['children'][$k3]['desc'],true)['zh'];
                                // $services[$k]['info']['children'][$k2]['children'][$k3]['desc'] = explode('、',$services[$k]['info']['children'][$k2]['children'][$k3]['desc']);
                            }
                        }
                    }
                    elseif($v['format']==2){
                        $services[$k]['info'] = Db::connection('shop_db')->table('website_navbar')->where('id',$v['navbar_id'])->select(['id','name','desc','thumb','format','color','go_other','other_link','other_navbar','thumb'])->first();
                        $services[$k]['info'] = objtoarr($services[$k]['info']);
                        $services[$k]['info']['name'] = json_decode($services[$k]['info']['name'],true)['zh'];
                        $services[$k]['info']['desc'] = json_decode($services[$k]['info']['desc'],true)['zh'];
                        $services[$k]['info']['children'] = Db::connection('shop_db')->table('website_navbar')->where('pid',$services[$k]['info']['id'])->select(['id','name','desc','thumb','format','color','go_other','other_link','other_navbar'])->get();
                        $services[$k]['info']['children'] = objtoarr($services[$k]['info']['children']);
                        foreach($services[$k]['info']['children'] as $k2=>$v2){
                            $services[$k]['info']['children'][$k2]['name'] = json_decode($services[$k]['info']['children'][$k2]['name'],true)['zh'];
                            $services[$k]['info']['children'][$k2]['desc'] = json_decode($services[$k]['info']['children'][$k2]['desc'],true)['zh'];
                            $services[$k]['info']['children'][$k2]['children'] = Db::connection('shop_db')->table('website_navbar')->where('pid',$v2['id'])->select(['id','name','desc','thumb','format','color','go_other','other_link','other_navbar'])->get();
                            $services[$k]['info']['children'][$k2]['children'] = objtoarr($services[$k]['info']['children'][$k2]['children']);
                            foreach($services[$k]['info']['children'][$k2]['children'] as $k3=>$v3){
                                $services[$k]['info']['children'][$k2]['children'][$k3]['name'] = json_decode($services[$k]['info']['children'][$k2]['children'][$k3]['name'],true)['zh'];
                                $services[$k]['info']['children'][$k2]['children'][$k3]['desc'] = json_decode($services[$k]['info']['children'][$k2]['children'][$k3]['desc'],true)['zh'];
                            }
                        }
                    }
                    elseif($v['format']==0){
                        if($v['navbar_id']=='A1' || $v['format_type']==3){
                            $services[$k]['info'] = [];
                            $services[$k]['info']['name'] = '';
                            $services[$k]['info']['desc'] = '';
                            $services[$k]['info']['children'] = [];
                        }elseif($v['navbar_id']=='A2'){
                            $services[$k]['info'] = [];
                            $services[$k]['info']['name'] = '常见问题';
                            $services[$k]['info']['desc'] = '';
                            $services[$k]['info']['children'] = [];
                        }
                    }
                }
                
                return $services;
            });
        }
        
        // $data['guide'] = &$guide;
        // $data['guide'] = objtoarr($data['guide']);
        $services = &$guide;
        // dd($services);
        #导页版式 END===========================================================
        
        $currency = objtoarr($currency);
        
        $compact = compact('page', 'tplHtml', 'navContainerHtml', 'nav_banner', 'webStatic', 'website', 'rotate', 'news', 'currency', 'data', 'citys', 'discovery_rotate', 'hotbuy', 'industry', 'festival','services');

        $this->show_seo('seo_index'); // SEO

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'template' => $template,
                'app_header_style' => 1,
            ],
            'app_suffix_data' => [
                'user_id' => null,
                'user_name' => null,
                'SYS_SITE_MODE' => '1',
                'site_id' => 1,
                'site_name' => '总站',
                'goods_counts' => 0
            ],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'home.home'
        ];

        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }
    
    #调整杂志样式的smlchildren，自动填充满4个
    private function fillSmlChildren(array $arr): array{
        // 确保存在 big_children 且为数组
        if (!isset($arr['big_children']) || !is_array($arr['big_children'])) {
            return $arr;
        }
    
        // 遍历每个大模块
        foreach ($arr['big_children'] as &$bigChild) {
            if (!isset($bigChild['sml_children']) || !is_array($bigChild['sml_children'])) {
                continue;
            }
    
            $groups = &$bigChild['sml_children']; // 引用，便于修改
            $groupCount = count($groups);
    
            // 按顺序处理每个子分组
            for ($i = 0; $i < $groupCount; $i++) {
                $current = &$groups[$i];
                $currentSize = count($current);
                $need = 4 - $currentSize;
    
                // 不足4个且有前一个分组时进行填充
                if ($need > 0 && $i > 0) {
                    $prev = $groups[$i - 1]; // 前一个分组（当前状态的副本）
                    $prevSize = count($prev);
                    if ($prevSize > 0) {
                        // 取前 $need 个，若不够则取全部
                        $take = array_slice($prev, 0, $need);
                        // 将取出的元素合并到当前分组
                        $current = array_merge($current, $take);
                    }
                }
            }
            unset($groups); // 解除引用，避免后续意外修改
        }
        unset($bigChild);
    
        return $arr;
    }
    
    #根据关键词获取商品
    public function get_keywords_goods($keywords,$currency,$navbar=[]){
        $goods_list = collect();
        
        $keywords = array_filter(explode('、', $keywords));
        
        $kw_goods = DB::table('goods')
            ->join('goods_keywords', 'goods.keywords_id', '=', 'goods_keywords.id')
            ->whereIn('goods_keywords.keywords', $keywords)
            ->where('goods.goods_status', 1)
            ->select('goods.*')
            ->inRandomOrder()
            ->limit(20)
            ->get();

        foreach ($kw_goods as $g) {
            // $sku = $sku_map->get($g->goods_id);
            // $sku_prices = $sku ? json_decode($sku->sku_prices, true) : ['price' => [$g->goods_price]];
            $gsku = Db::table('goods_sku')->where(['goods_id'=>$g->goods_id])->select(['sku_prices'])->first();
            $price = json_decode($gsku->sku_prices,true)['price'];
            
            $goods_list->push((object) [
                'goods_id'       => $g->goods_id,
                'goods_name'     => $g->goods_name,
                'goods_image'    => $g->goods_image,
                'company'        => 'Gogo',
                'goods_currency' => $currency[$g->goods_currency]['currency_symbol_standard'] ?? 'CNY',
                'price'          => number_format(end($price), 2),
                
                'back_content'   => $g->goods_image,
                'name'           => $g->goods_name,
                'go_other'       => 2,
                'info'           => ['currency'=>$currency[$g->goods_currency]['currency_symbol_standard'] ?? 'CNY','goods_price'=>number_format(end($price), 2)],
                'other_goods'    => $g->goods_id,
                'desc'           => $g->goods_name,
            ]);
        }
        
        $row = $goods_list->shuffle()->take(20)->values()->toArray();
        $row = objtoarr($row);
        
        // if($keywords[0] == '平台供应商'){
            #查询商家上架表的当前导页id下是否有相同的关键字对碰
            $merchant_shelf = Db::table('goods_shelf')->whereRaw('guide_id='.$navbar['id'].' and type=4 and is_shelf_platform=0 and keywords!=""')->get();
            $merchant_shelf = objtoarr($merchant_shelf);
            
            if(!empty($merchant_shelf)){
                foreach($merchant_shelf as $k=>$v){
                    #商家在平台上架的关键字
                    $merchant_shelf_kwds = explode('、',$v['keywords']);
                    #平台该板块的关键字
                    // $platform_kwds = explode('、',$keywords);
                    
                    // 获取两个数组的交集
                    $intersect_arr = array_intersect($keywords, $merchant_shelf_kwds);
                    // 如果需要重新索引为连续数字下标
                    $intersect_arr = array_values($intersect_arr);
                    
                    if(!empty($intersect_arr)){
                        $new_goods = DB::table('goods')->where(['goods_id'=>$v['gid']])->where('goods_status', 1)->first();
                        
                        $gsku = Db::table('goods_sku')->where(['goods_id'=>$new_goods->goods_id])->select(['sku_prices'])->first();
                        $price = json_decode($gsku->sku_prices,true)['price'];
                        $news_goods_arr = [
                            'goods_id'       => $new_goods->goods_id,
                            'goods_name'     => $new_goods->goods_name,
                            'goods_image'    => $new_goods->goods_image,
                            'company'        => 'Gogo',
                            'goods_currency' => $currency[$new_goods->goods_currency]['currency_symbol_standard'] ?? 'CNY',
                            'price'          => number_format(end($price), 2),
                            
                            'back_content'   => $new_goods->goods_image,
                            'name'           => $new_goods->goods_name,
                            'go_other'       => 2,
                            'info'           => ['currency'=>$currency[$new_goods->goods_currency]['currency_symbol_standard'] ?? 'CNY','goods_price'=>number_format(end($price), 2)],
                            'other_goods'    => $new_goods->goods_id,
                            'desc'           => $new_goods->goods_name,
                        ];
                        
                        array_push($row,$news_goods_arr);
                    }
                }
            }
        // }
        return $row;
    }
    
    #获取接口商品
    public function get_api_goods($merchant,$currency,$navbar=[]){
        $goods_list = collect();
        $merchant = explode(',',$merchant);
        
        $kw_goods = DB::table('goods')
            ->whereIn('api_id', $merchant)
            ->where('goods_status', 1)
            ->select('*')
            ->inRandomOrder()
            ->limit(20)
            ->get();

        foreach ($kw_goods as $g) {
            $gsku = Db::table('goods_sku')->where(['goods_id'=>$g->goods_id])->select(['sku_prices'])->first();
            $price = json_decode($gsku->sku_prices,true)['price'];
            
            $goods_list->push((object) [
                'goods_id'       => $g->goods_id,
                'goods_name'     => $g->goods_name,
                'goods_image'    => $g->goods_image,
                'company'        => 'Gogo',
                'goods_currency' => $currency[$g->goods_currency]['currency_symbol_standard'] ?? 'CNY',
                'price'          => number_format(end($price), 2),
                
                'back_content'   => $g->goods_image,
                'name'           => $g->goods_name,
                'go_other'       => 2,
                'info'           => ['currency'=>$currency[$g->goods_currency]['currency_symbol_standard'] ?? 'CNY','goods_price'=>number_format(end($price), 2)],
                'other_goods'    => $g->goods_id,
                'desc'           => $g->goods_name,
            ]);
        }
        
        $row = $goods_list->shuffle()->take(20)->values()->toArray();
        $row = objtoarr($row);
        
        if(!empty($navbar['gkeywords'])){
            $keywords_goods = $this->get_keywords_goods($navbar['gkeywords'],$currency,$navbar);
            $row = array_merge($keywords_goods,$row);
        }
        
        return $row;
    }
    
    #获取买手商品
    public function get_buyer_goods($merchant,$currency,$navbar=[]){
        $goods_list = collect();
        $merchant = explode(',',$merchant);
        
        $kw_goods = DB::table('goods')
            ->whereIn('buyer_id', $merchant)
            ->where('goods_status', 1)
            ->select('*')
            ->inRandomOrder()
            ->limit(20)
            ->get();

        foreach ($kw_goods as $g) {
            $gsku = Db::table('goods_sku')->where(['goods_id'=>$g->goods_id])->select(['sku_prices'])->first();
            $price = json_decode($gsku->sku_prices,true)['price'];
            
            $goods_list->push((object) [
                'goods_id'       => $g->goods_id,
                'goods_name'     => $g->goods_name,
                'goods_image'    => $g->goods_image,
                'company'        => 'Gogo',
                'goods_currency' => $currency[$g->goods_currency]['currency_symbol_standard'] ?? 'CNY',
                'price'          => number_format(end($price), 2),
                
                'back_content'   => $g->goods_image,
                'name'           => $g->goods_name,
                'go_other'       => 2,
                'info'           => ['currency'=>$currency[$g->goods_currency]['currency_symbol_standard'] ?? 'CNY','goods_price'=>number_format(end($price), 2)],
                'other_goods'    => $g->goods_id,
                'desc'           => $g->goods_name,
            ]);
        }
        
        $row = $goods_list->shuffle()->take(20)->values()->toArray();
        $row = objtoarr($row);
        
        if(!empty($navbar['gkeywords'])){
            $keywords_goods = $this->get_keywords_goods($navbar['gkeywords'],$currency,$navbar);
            $row = array_merge($keywords_goods,$row);
        }
        
        return $row;
    }
    
    #获取店铺商品
    public function get_shop_goods($merchant,$currency,$navbar=[]){
        $goods_list = collect();
        $merchant = explode(',',$merchant);
        
        $kw_goods = DB::table('goods')
            ->whereIn('shop_id', $merchant)
            ->where(['goods_status'=>1,'buyer_id'=>0])
            ->select('*')
            ->inRandomOrder()
            ->limit(20)
            ->get();

        foreach ($kw_goods as $g) {
            $gsku = Db::table('goods_sku')->where(['goods_id'=>$g->goods_id])->select(['sku_prices'])->first();
            $price = json_decode($gsku->sku_prices,true)['price'];
            
            $goods_list->push((object) [
                'goods_id'       => $g->goods_id,
                'goods_name'     => $g->goods_name,
                'goods_image'    => $g->goods_image,
                'company'        => 'Gogo',
                'goods_currency' => $currency[$g->goods_currency]['currency_symbol_standard'] ?? 'CNY',
                'price'          => number_format(end($price), 2),
                
                'back_content'   => $g->goods_image,
                'name'           => $g->goods_name,
                'go_other'       => 2,
                'info'           => ['currency'=>$currency[$g->goods_currency]['currency_symbol_standard'] ?? 'CNY','goods_price'=>number_format(end($price), 2)],
                'other_goods'    => $g->goods_id,
                'desc'           => $g->goods_name,
            ]);
        }
        
        $row = $goods_list->shuffle()->take(20)->values()->toArray();
        $row = objtoarr($row);
        
        if(!empty($navbar['gkeywords'])){
            $keywords_goods = $this->get_keywords_goods($navbar['gkeywords'],$currency,$navbar);
            $row = array_merge($keywords_goods,$row);
        }
        
        return $row;
    }
    
    #获取节日表信息
    public function get_festival(){
        #更改节日为当前年份
        // $festival = Db::connection('shop_db')->table('website_festival')->get();
        // $festival = objtoarr($festival);
        // foreach($festival as $k=>$v){
        //     Db::connection('shop_db')->table('website_festival')->where(['id'=>$v['id']])->update([
        //         'date'=>str_replace('2025','2026',$v['date'])
        //     ]);
        // }
        // echo 'success';exit;
        
        $festival = Cache::remember('home_festival_v2', 86400, function () {
            return DB::connection('shop_db')
                ->table('website_festival')
                ->whereRaw('date >= DATE_SUB(CURDATE(), INTERVAL 1 DAY)')
                ->whereRaw('date <= DATE_ADD(CURDATE(), INTERVAL 15 DAY)')
                ->orderBy('date', 'asc')
                ->get()
                ->toArray();
        });

        $festival = addCountryPic(objtoarr($festival));
        
        // 手动过滤（替代 fn()）
        $filtered = [];
        foreach ($festival as $key => $item) {
            if(!empty($item['zh_name'])){
                $festival[$key]['name'] = $item['zh_name'];
            }elseif(!empty($item['en_name'])){
                $festival[$key]['name'] = $item['en_name'];
            }else{
                $festival[$key]['name'] = '';
            }
            $festival[$key]['go_other'] = 5;
            $festival[$key]['gkeywords'] = $item['keywords'];
            $festival[$key]['desc'] = $item['keywords'];
            $festival[$key]['back_content'] = isset($item['national_flag'][0])?str_replace('//shop.gogo198.cn','',$item['national_flag'][0]):$item['back_content'];
            
            if (!isset($item['is_deplicate'])) {
                $filtered[] = $festival[$key];
            }
        }
        $festival = $filtered;

        $festival = array_values($festival);
        shuffle($festival);

        $chunks = collect($festival)->chunk(is_mobile2() ? 1 : 6);
        $final_chunks = [];
        foreach ($chunks as $chunk) {
            $final_chunks[] = $chunk->chunk(is_mobile2() ? 1 : 3)->toArray();
        }
        // $row['children'] = $final_chunks;
        
        return $final_chunks;
    }

    public function member_login(Request $request)
    {
        $dat = $request->except(['_token']);

        #获取配置信息
        $website = get_website();
        return view('home.login', compact('website'));
    }

    #切换账号
    public function change_account(Request $request)
    {
        dd(session()->all());
    }

    public function getProcessChild($process=[])
    {
        if (!empty($process)) {
            foreach ($process as $k=>$v) {
                $process[$k]['children'] = Db::connection('shop_db')->table('centralize_process_list')->where(['pid'=>$v['id']])->get();
                $process[$k]['children'] = objtoarr($process[$k]['children']);
                if (empty($process[$k]['children'])) {
                    if ($v['go_other']>0) {
                        $process[$k]['link'] = $this->getAppLink($v['go_other'], $v, 'liucheng');
                    }
                } else {
                    $process[$k]['children'] = $this->getProcessChild($process[$k]['children']);
//                    return $process;
                }
            }
        }
        return $process;
    }

    public function getAppLink($go=0, $data=[], $type='')
    {
        if ($go==1) {
            #第三方链接
            if (isset($data['other_link'])) {
                return $data['other_link'];
            } elseif (isset($data['origin_link'])) {
                return $data['origin_link'];
            } else {
                return $data['link'];
            }
        } elseif ($go==2) {
            #菜单（应用）链接
            $link = Db::table('guide_frame')->where(['id'=>$data['other_navbar']])->first();
            $link = objtoarr($link);
            return $link['link'];
        } elseif ($go==3) {
            #图文链接
            return '/txt_detail?id='.$data['other_pic'].'&type='.$type.'&oid='.$data['id'];
        } elseif ($go==4) {
            #消息链接
            return '/msg_detail?id='.$data['other_msg'].'&type='.$type.'&oid='.$data['id'];
        } elseif ($go==5) {
            #搜索结果链接
            return '/goods_list?frame_id=3&hotsearchId='.$data['id'].'&searchTitle='.$data['other_keywords'];
        } elseif ($go==6) {
            #店铺链接
            return '/shop_detail?id='.isset($data['other_shop'])??$data['other_shop'];
        } elseif ($go==7) {
            #政策链接
            return '/policy_detail?id='.$data['other_privacy'].'&type='.$type.'&oid='.$data['id'];
        }
    }

    public function getFrame(Request $request)
    {
        $data = $request->except(['_token']);
        $id = intval($data['id']);
        $type = intval($data['type']);

        if ($type==0) {
            $list = Db::table('frame_body')->where(['pid'=>$id])->get();
            $list = objtoarr($list);

            return Response()->json(['code'=>0,'list'=>$list]);
        } elseif ($type==99) {
            #提示框图片
            $adv = Db::table('frame_adv')->where(['id'=>$id])->first();
            $adv = objtoarr($adv);

            return Response()->json(['code'=>0,'adv'=>$adv]);
        } else {
            $list = Db::table('frame_body')->where(['type'=>$type,'pid'=>0,'id'=>$id])->orderBy('displayorder', 'asc')->get();
            $list = objtoarr($list);
            foreach ($list as $k=>$v) {
                if ($v['id']==$id) {
                    $list[$k]['children'] = Db::table('frame_body')->where(['pid'=>$id])->get();
                    $list[$k]['children'] = objtoarr($list[$k]['children']);
                    foreach ($list[$k]['children'] as $k2=>$v2) {
                        $list[$k]['children'][$k2]['link'] = $this->getAppLink(2, ['other_navbar'=>$v2['app_id']]);
                        if (strpos($list[$k]['children'][$k2]['link'], '?') !== false) {
                            $list[$k]['children'][$k2]['link'] .= '&isframe=1';
                        } else {
                            $list[$k]['children'][$k2]['link'] .= '?isframe=1';
                        }
                    }
                }

                if ($v['id']==11) {
                    #社交平台（获取后台配置的社交平台数据）
                    $list[$k]['children'] = Db::connection('shop_db')->table('website_contact')->where(['system_id'=>3])->get();
                    $list[$k]['children'] = objtoarr($list[$k]['children']);
                    foreach ($list[$k]['children'] as $k2=>$v2) {
                        if ($v2['type']==2) {
                            $list[$k]['children'][$k2]['link'] = '/social_detail?id='.$v2['id'].'&isframe=1';
                        }
                    }
                }

                if ($v['id']==21) {
                    #搜索中心（获取后台配置的搜索管理数据）
                    $list[$k]['children'] = Db::table('search_list')->get();
                    $list[$k]['children'] = objtoarr($list[$k]['children']);
                    foreach ($list[$k]['children'] as $k2=>$v2) {
                        $list[$k]['children'][$k2]['link'] = '/search_list?id='.$v2['id'].'&isframe=1';
                    }
                }
            }
            $adv = Db::table('frame_adv')->where(['type'=>$type])->first();
            $adv = objtoarr($adv);

            return Response()->json(['code'=>0,'list'=>$list,'adv'=>$adv]);
        }
    }
    
    #菜单详情
    public function detail(Request $request){
        $dat = $request->except(['_token']);
        $oid = isset($dat['oid']) ? intval($dat['oid']) : 0;
        $foid = isset($dat['foid']) ? intval($dat['foid']) : 0;
        $page_id = isset($dat['id']) ? intval($dat['id']) : 0;

        if ($request->isMethod('post')) {
        } else {
            $news = Db::connection('shop_db')->table('website_navbar')->where(['id'=>intval($dat['id'])])->first();
            $news = objtoarr($news);
            
            if($news['go_other']==1){
                header('Location: '.$news['other_link']);
            }
            
            if (!empty($news['content'])) {
                $news['content'] = json_decode($news['content'], true)['zh'];
            }
            if (!empty($news['color_word'])) {
                $news['color_word'] = json_decode($news['color_word'], true)['zh'];
            }
//            dd($news);

            $stype = isset($dat['type'])?trim($dat['type']):0;
            $news['share_num'] = 0;
            $news['like_num'] = 0;
            $type=1;

            $news['share_num'] = intval($news['share_num']);

            if (empty($news['like_num'])) {
                $news['like_num'] = rand(100, 999);
                Db::connection('shop_db')->table('website_navbar')->where(['id'=>intval($dat['id'])])->update(['like_num'=>$news['like_num']]);
            } else {
                $news['like_num'] = $news['like_num'];
            }

            $news['comment_num'] = Db::connection('shop_db')->table('website_crossborder_news_chat')->where(['type'=>$type,'news_id'=>$dat['id']])->count();

            $id = $news['id'];
            $news['id'] = $id;
            $news['name'] = json_decode($news['name'], true)['zh'];
            $news['desc'] = json_decode($news['desc'], true)['zh'];
            #分享
            $data['url'] = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"];
            $data['name'] = $news['name'];
            $data['desc'] = $news['desc'];
            $data['url_this'] = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"];
            $data['thumb'] = 'https://shop.gogo198.cn/collect_website/public/uploads/centralize/website_index/64a5282e9bdbf.png';
            $signPackage = weixin_share($data);
            $news['link'] = '';

            #随机码
            $rand = rand(11111, 99999);

            #获取配置信息
            $website = get_website();
            $website['name'] = $news['name'];
            $page_info = get_pageinfo('/msg_detail');
            $website['background'] = $page_info['content']['background'];
            $website['content'] = $page_info['content']['content'];
            $website['fontcolor'] = $page_info['content']['fontcolor'];
//            $website['name'] = $news['title'];
//            $website['keywords'] = $news['title'];
//            $website['desc'] = $news['title'];

            #所有评论
            $all_comment = Db::connection('shop_db')->table('website_crossborder_news_chat')->where(['news_id'=>$id,'type'=>$type])->orderBy('id', 'desc')->get();
            $all_comment = objtoarr($all_comment);

            $origin_page = '/detail?id='.$page_id.'&type='.$stype.'&oid='.$id.'&foid='.$foid;

            #是否有配置跳转其他应用
            $footerInfo = Db::table('footer_body')->where(['id'=>$foid])->first();
            $footerInfo = objtoarr($footerInfo);
            if (isset($footerInfo['have_link'])) {
                $footerInfo['link'] = $this->getAppLink(2, ['other_navbar'=>$footerInfo['content_id']]);
                $data['link'] = $footerInfo['link'];
            }
            
            return view('home.detail', compact('website', 'news', 'id', 'data', 'signPackage', 'all_comment', 'type', 'rand', 'footerInfo', 'origin_page'));
        }
    }
    
    #新闻详情
    public function news_detail(Request $request)
    {
        $dat = $request->except(['_token']);
        $foid = isset($dat['foid']) ? intval($dat['foid']) : 0;
        
        if ($request->isMethod('post')) {
            if ($dat['type']==1) {
                #头部菜单
                $id = intval($dat['id']);
                if ($dat['pa']==1) {
                    $news = Db::connection('shop_db')->table('website_navbar')->where(['id'=>$id])->first();
                    $news = objtoarr($news);
                    $res = Db::connection('shop_db')->table('website_navbar')->where(['id'=>$id])->update(['like_num'=>$news['like_num']+1]);
                    if ($res) {
                        return Response()->json(['code'=>0,'msg'=>'点赞成功！']);
                    }
                } elseif ($dat['pa']==2) {
                    $time = time();
                    $res = Db::connection('shop_db')->table('website_crossborder_news_chat')->insert(['news_id'=>$dat['id'],'text'=>trim($dat['val']),'createtime'=>$time,'type'=>$dat['type'],'ip'=>$_SERVER['REMOTE_ADDR']]);
                    if ($res) {
                        return Response()->json(['code'=>0,'msg'=>'评论成功！','time'=>date('Y-m-d H:i', $time),'ip'=>$_SERVER['REMOTE_ADDR']]);
                    }
                } elseif ($dat['pa']==3) {
                    $news = Db::connection('shop_db')->table('website_navbar')->where(['id'=>$id])->first();
                    $news = objtoarr($news);
                    $res = Db::connection('shop_db')->table('website_navbar')->where(['id'=>$id])->update(['share_num'=>intval($news['share_num'])+1]);
                    if ($res) {
                        return Response()->json(['code'=>0,'msg'=>'分享成功！']);
                    }
                }
            }
            if ($dat['type']==3) {
                #跨境新闻
                if ($dat['pa']==1) {
                    $news = Db::connection('shop_db')->table('website_crossborder_news')->where(['id'=>$dat['id']])->first();
                    $news = objtoarr($news);
                    $res = Db::connection('shop_db')->table('website_crossborder_news')->where(['id'=>$dat['id']])->update(['like_num'=>$news['like_num']+1]);
                    if ($res) {
                        return Response()->json(['code'=>0,'msg'=>'点赞成功！']);
                    }
                } elseif ($dat['pa']==2) {
                    $time = time();
                    $res = Db::connection('shop_db')->table('website_crossborder_news_chat')->insert(['news_id'=>$dat['id'],'text'=>trim($dat['val']),'createtime'=>$time,'type'=>$dat['type'],'ip'=>$_SERVER['REMOTE_ADDR']]);
                    if ($res) {
                        return Response()->json(['code'=>0,'msg'=>'评论成功！','time'=>date('Y-m-d H:i', $time),'ip'=>$_SERVER['REMOTE_ADDR']]);
                    }
                } elseif ($dat['pa']==3) {
                    $news = Db::connection('shop_db')->table('website_crossborder_news')->where(['id'=>$dat['id']])->first();
                    $news = objtoarr($news);
                    $res = Db::connection('shop_db')->table('website_crossborder_news')->where(['id'=>$dat['id']])->update(['share_num'=>intval($news['share_num'])+1]);
                    if ($res) {
                        return Response()->json(['code'=>0,'msg'=>'分享成功！']);
                    }
                }
            }
            if ($dat['type']==4) {
                #政策
                if ($dat['pa']==1) {
                    $news = Db::connection('shop_db')->table('policy_list')->where(['id'=>$dat['id']])->first();
                    $news = objtoarr($news);
                    $res = Db::connection('shop_db')->table('policy_list')->where(['id'=>$dat['id']])->update(['like_num'=>$news['like_num']+1]);
                    if ($res) {
                        return Response()->json(['code'=>0,'msg'=>'点赞成功！']);
                    }
                } elseif ($dat['pa']==2) {
                    $time = time();
                    $res = Db::connection('shop_db')->table('website_crossborder_news_chat')->insert(['news_id'=>$dat['id'],'text'=>trim($dat['val']),'createtime'=>$time,'type'=>$dat['type'],'ip'=>$_SERVER['REMOTE_ADDR']]);
                    if ($res) {
                        return Response()->json(['code'=>0,'msg'=>'评论成功！','time'=>date('Y-m-d H:i', $time),'ip'=>$_SERVER['REMOTE_ADDR']]);
                    }
                } elseif ($dat['pa']==3) {
                    $news = Db::connection('shop_db')->table('policy_list')->where(['id'=>$dat['id']])->first();
                    $news = objtoarr($news);
                    $res = Db::connection('shop_db')->table('policy_list')->where(['id'=>$dat['id']])->update(['share_num'=>intval($news['share_num'])+1]);
                    if ($res) {
                        return Response()->json(['code'=>0,'msg'=>'分享成功！']);
                    }
                }
            }
//            elseif($dat['type']==5){
//                #轮播图
//                if($dat['pa']==1){
//                    $news = Db::connection('shop_db')->table('website_rotate')->where(['id'=>$dat['id']])->first();
//                    $news = objtoarr($news);
//                    $res = Db::connection('shop_db')->table('website_rotate')->where(['id'=>$dat['id']])->update(['like_num'=>$news['like_num']+1]);
//                    if($res){
//                        return Response()->json(['code'=>0,'msg'=>'点赞成功！']);
//                    }
//                }elseif($dat['pa']==2){
//                    $time = time();
//                    $res = Db::connection('shop_db')->table('website_crossborder_news_chat')->insert(['news_id'=>$dat['id'],'text'=>trim($dat['val']),'createtime'=>$time,'type'=>$dat['type'],'ip'=>$_SERVER['REMOTE_ADDR']]);
//                    if($res){
//                        return Response()->json(['code'=>0,'msg'=>'评论成功！','time'=>date('Y-m-d H:i',$time),'ip'=>$_SERVER['REMOTE_ADDR']]);
//                    }
//                }elseif($dat['pa']==3){
//                    $news = Db::connection('shop_db')->table('website_rotate')->where(['id'=>$dat['id']])->first();
//                    $news = objtoarr($news);
//                    $res = Db::connection('shop_db')->table('website_rotate')->where(['id'=>$dat['id']])->update(['share_num'=>intval($news['share_num'])+1]);
//                    if($res){
//                        return Response()->json(['code'=>0,'msg'=>'分享成功！']);
//                    }
//                }
//            }
//            elseif($dat['type']==6){
//                #流程
//                if($dat['pa']==1){
//                    $news = Db::connection('shop_db')->table('centralize_process_list')->where(['id'=>$dat['id']])->first();
//                    $news = objtoarr($news);
//                    $res = Db::connection('shop_db')->table('centralize_process_list')->where(['id'=>$dat['id']])->update(['like_num'=>$news['like_num']+1]);
//                    if($res){
//                        return Response()->json(['code'=>0,'msg'=>'点赞成功！']);
//                    }
//                }elseif($dat['pa']==2){
//                    $time = time();
//                    $res = Db::connection('shop_db')->table('website_crossborder_news_chat')->insert(['news_id'=>$dat['id'],'text'=>trim($dat['val']),'createtime'=>$time,'type'=>$dat['type'],'ip'=>$_SERVER['REMOTE_ADDR']]);
//                    if($res){
//                        return Response()->json(['code'=>0,'msg'=>'评论成功！','time'=>date('Y-m-d H:i',$time),'ip'=>$_SERVER['REMOTE_ADDR']]);
//                    }
//                }elseif($dat['pa']==3){
//                    $news = Db::connection('shop_db')->table('centralize_process_list')->where(['id'=>$dat['id']])->first();
//                    $news = objtoarr($news);
//                    $res = Db::connection('shop_db')->table('centralize_process_list')->where(['id'=>$dat['id']])->update(['share_num'=>intval($news['share_num'])+1]);
//                    if($res){
//                        return Response()->json(['code'=>0,'msg'=>'分享成功！']);
//                    }
//                }
//            }
//            elseif($dat['type']==7){
//                #页脚
//                if($dat['pa']==1){
//                    $news = Db::table('footer_body')->where(['id'=>$dat['id']])->first();
//                    $news = objtoarr($news);
//                    $res = Db::table('footer_body')->where(['id'=>$dat['id']])->update(['like_num'=>$news['like_num']+1]);
//                    if($res){
//                        return Response()->json(['code'=>0,'msg'=>'点赞成功！']);
//                    }
//                }elseif($dat['pa']==2){
//                    $time = time();
//                    $res = Db::connection('shop_db')->table('website_crossborder_news_chat')->insert(['news_id'=>$dat['id'],'text'=>trim($dat['val']),'createtime'=>$time,'type'=>$dat['type'],'ip'=>$_SERVER['REMOTE_ADDR']]);
//                    if($res){
//                        return Response()->json(['code'=>0,'msg'=>'评论成功！','time'=>date('Y-m-d H:i',$time),'ip'=>$_SERVER['REMOTE_ADDR']]);
//                    }
//                }elseif($dat['pa']==3){
//                    $news = Db::table('footer_body')->where(['id'=>$dat['id']])->first();
//                    $news = objtoarr($news);
//                    $res = Db::table('footer_body')->where(['id'=>$dat['id']])->update(['share_num'=>intval($news['share_num'])+1]);
//                    if($res){
//                        return Response()->json(['code'=>0,'msg'=>'分享成功！']);
//                    }
//                }
//            }
            elseif ($dat['type']==8) {
                #消息
                if ($dat['pa']==1) {
                    $news = Db::connection('shop_db')->table('website_message_manage')->where(['id'=>$dat['id']])->first();
                    $news = objtoarr($news);
                    $res = Db::connection('shop_db')->table('website_message_manage')->where(['id'=>$dat['id']])->update(['like_num'=>$news['like_num']+1]);
                    if ($res) {
                        return Response()->json(['code'=>0,'msg'=>'点赞成功！']);
                    }
                } elseif ($dat['pa']==2) {
                    $time = time();
                    $res = Db::connection('shop_db')->table('website_crossborder_news_chat')->insert(['news_id'=>$dat['id'],'text'=>trim($dat['val']),'createtime'=>$time,'type'=>$dat['type'],'ip'=>$_SERVER['REMOTE_ADDR']]);
                    if ($res) {
                        return Response()->json(['code'=>0,'msg'=>'评论成功！','time'=>date('Y-m-d H:i', $time),'ip'=>$_SERVER['REMOTE_ADDR']]);
                    }
                } elseif ($dat['pa']==3) {
                    $news = Db::connection('shop_db')->table('website_message_manage')->where(['id'=>$dat['id']])->first();
                    $news = objtoarr($news);
                    $res = Db::connection('shop_db')->table('website_message_manage')->where(['id'=>$dat['id']])->update(['share_num'=>intval($news['share_num'])+1]);
                    if ($res) {
                        return Response()->json(['code'=>0,'msg'=>'分享成功！']);
                    }
                }
            } elseif ($dat['type']==11) {
                #图文
                if ($dat['pa']==1) {
                    $news = Db::connection('shop_db')->table('website_image_txt')->where(['id'=>$dat['id']])->first();
                    $news = objtoarr($news);
                    $res = Db::connection('shop_db')->table('website_image_txt')->where(['id'=>$dat['id']])->update(['like_num'=>$news['like_num']+1]);
                    if ($res) {
                        return Response()->json(['code'=>0,'msg'=>'点赞成功！']);
                    }
                } elseif ($dat['pa']==2) {
                    $time = time();
                    $res = Db::connection('shop_db')->table('website_image_txt')->insert(['news_id'=>$dat['id'],'text'=>trim($dat['val']),'createtime'=>$time,'type'=>$dat['type'],'ip'=>$_SERVER['REMOTE_ADDR']]);
                    if ($res) {
                        return Response()->json(['code'=>0,'msg'=>'评论成功！','time'=>date('Y-m-d H:i', $time),'ip'=>$_SERVER['REMOTE_ADDR']]);
                    }
                } elseif ($dat['pa']==3) {
                    $news = Db::connection('shop_db')->table('website_image_txt')->where(['id'=>$dat['id']])->first();
                    $news = objtoarr($news);
                    $res = Db::connection('shop_db')->table('website_image_txt')->where(['id'=>$dat['id']])->update(['share_num'=>intval($news['share_num'])+1]);
                    if ($res) {
                        return Response()->json(['code'=>0,'msg'=>'分享成功！']);
                    }
                }
            }
//            elseif($dat['type']==10){
//                #业务服务
//                if($dat['pa']==1){
//                    $news = Db::connection('shop_db')->table('centralize_services_list')->where(['id'=>$dat['id']])->first();
//                    $news = objtoarr($news);
//                    $res = Db::connection('shop_db')->table('centralize_services_list')->where(['id'=>$dat['id']])->update(['like_num'=>$news['like_num']+1]);
//                    if($res){
//                        return Response()->json(['code'=>0,'msg'=>'点赞成功！']);
//                    }
//                }elseif($dat['pa']==2){
//                    $time = time();
//                    $res = Db::connection('shop_db')->table('website_crossborder_news_chat')->insert(['news_id'=>$dat['id'],'text'=>trim($dat['val']),'createtime'=>$time,'type'=>$dat['type'],'ip'=>$_SERVER['REMOTE_ADDR']]);
//                    if($res){
//                        return Response()->json(['code'=>0,'msg'=>'评论成功！','time'=>date('Y-m-d H:i',$time),'ip'=>$_SERVER['REMOTE_ADDR']]);
//                    }
//                }elseif($dat['pa']==3){
//                    $news = Db::connection('shop_db')->table('centralize_services_list')->where(['id'=>$dat['id']])->first();
//                    $news = objtoarr($news);
//                    $res = Db::connection('shop_db')->table('centralize_services_list')->where(['id'=>$dat['id']])->update(['share_num'=>intval($news['share_num'])+1]);
//                    if($res){
//                        return Response()->json(['code'=>0,'msg'=>'分享成功！']);
//                    }
//                }
//            }
        } else {
            $nid = intval($dat['id']);
            $news = Db::connection('shop_db')->table('website_crossborder_news')->where(['id'=>$nid])->first();
            $news = objtoarr($news);
            $news['share_num'] = intval($news['share_num']);
            if (empty($news['like_num'])) {
                $news['like_num'] = rand(100, 999);
                Db::connection('shop_db')->table('website_crossborder_news')->where(['id'=>$nid])->update(['like_num'=>$news['like_num']]);
            }
            $news['comment_num'] = Db::connection('shop_db')->table('website_crossborder_news_chat')->where(['news_id'=>$news['id']])->count();
            $id = $news['id'];
            #分享
            $data['url'] = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"];
            $data['name'] = $news['title'];
            $data['desc'] = $news['descs'];
            $data['url_this'] = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"];
            $data['thumb'] = 'https://shop.gogo198.cn/collect_website/public/uploads/centralize/website_index/64a5282e9bdbf.png';
            $signPackage = weixin_share($data);

            #获取配置信息
            $website = get_website();
            $website['name'] = $news['title'];
            $website['keywords'] = $news['title'];
            $website['desc'] = $news['title'];
            $page_info = get_pageinfo('/news_detail');
            $website['background'] = $page_info['content']['background'];
            $website['content'] = $page_info['content']['content'];
            $website['fontcolor'] = $page_info['content']['fontcolor'];

            $origin_page = '/news_detail?id='.$id;
            
            #随机码
            $rand = 0;
            #上一个新闻
            $prev_news = Db::connection('shop_db')->table('website_crossborder_news')->where('id', '<', $id)->orderBy('id', 'desc')->limit(1)->first();
            $prev_news = objtoarr($prev_news);
            #下一个新闻
            $next_news = Db::connection('shop_db')->table('website_crossborder_news')->where('id', '>', $id)->orderBy('id', 'asc')->limit(1)->first();
            $next_news = objtoarr($next_news);
            
            #所有评论
            $type=3;
            $all_comment = Db::connection('shop_db')->table('website_crossborder_news_chat')->where(['news_id'=>$id,'type'=>$type])->orderBy('id', 'desc')->get();
            $all_comment = objtoarr($all_comment);

            #是否有配置跳转其他应用
            $footerInfo = Db::table('footer_body')->where(['id'=>$foid])->first();
            $footerInfo = objtoarr($footerInfo);
            if (isset($footerInfo['have_link'])) {
                $footerInfo['link'] = $this->getAppLink(2, ['other_navbar'=>$footerInfo['content_id']]);
                $data['url'] = $footerInfo['link'];
            }
            
            return view('home.news_detail', compact('website', 'news', 'id', 'rand', 'data', 'prev_news', 'next_news', 'signPackage', 'all_comment', 'type', 'footerInfo','origin_page'));
        }
    }

    #消息管理
    public function msg_list(Request $request)
    {
        $dat = $request->except(['_token']);
        $isframe = isset($dat['isframe']) ? intval($dat['isframe']) : 0;

        if (isset($dat['pa'])) {
            $limit = $dat['limit'];
            $page = $dat['page'] - 1;

            if ($page != 0) {
                $page = $limit * $page;
            }
            $count = Db::connection('shop_db')->table('website_message_manage')->count();
            $rows = DB::connection('shop_db')->table('website_message_manage')
                ->offset($page)
                ->limit($limit)
                ->orderBy('createtime', 'desc')
                ->get();
            $rows = objtoarr($rows);

            foreach ($rows as $k=>$v) {
                $rows[$k]['createtime'] = date('Y-m-d H:i', $v['createtime']);
            }
            return Response()->json(['code'=>0,'count'=>$count,'data'=>$rows]);
        } else {
            #获取配置信息
            $website = get_website();
            $page_info = get_pageinfo('/msg_list');
            $website['background'] = $page_info['content']['background'];
            $website['content'] = $page_info['content']['content'];
            $website['fontcolor'] = $page_info['content']['fontcolor'];

            return view('home.inner.msg_list', compact('website', 'pid', 'page_info', 'isframe'));
        }
    }

    #消息详情
    public function msg_detail(Request $request)
    {
        $dat = $request->except(['_token']);
        $id = $dat['id'];
        $foid = isset($dat['foid']) ? intval($dat['foid']) : 0;
        $isframe = isset($dat['isframe']) ? intval($dat['isframe']) : 0;

        if ($request->isMethod('post')) {
        } else {
            $type=8;

            $news = Db::connection('shop_db')->table('website_message_manage')->where(['id'=>$dat['id']])->first();
            $news = objtoarr($news);
            $news['share_num'] = intval($news['share_num']);
            if (empty($news['like_num'])) {
                $news['like_num'] = rand(100, 999);
                Db::connection('shop_db')->table('website_message_manage')->where(['id'=>$dat['id']])->update(['like_num'=>$news['like_num']]);
            }
            $news['comment_num'] = Db::connection('shop_db')->table('website_crossborder_news_chat')->where(['type'=>$type,'news_id'=>$news['id']])->count();
            $id = $news['id'];
            #分享
            $data['url'] = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"];
            $data['name'] = $news['name'];
            $data['desc'] = $news['desc'];
            $data['url_this'] = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"];
            $data['thumb'] = 'https://shop.gogo198.cn/collect_website/public/uploads/centralize/website_index/64a5282e9bdbf.png';
            $signPackage = weixin_share($data);

            #获取配置信息
            $website = get_website();
            $website['name'] = $news['name'];
            $page_info = get_pageinfo('/msg_detail');
            $website['background'] = $page_info['content']['background'];
            $website['content'] = $page_info['content']['content'];
            $website['fontcolor'] = $page_info['content']['fontcolor'];

            #随机码
            $rand = rand(11111, 99999);
            #上一个消息
            $prev_news = Db::connection('shop_db')->table('website_message_manage')->where('id', '<', $id)->orderBy('id', 'desc')->limit(1)->first();
            $prev_news = objtoarr($prev_news);
            #下一个消息
            $next_news = Db::connection('shop_db')->table('website_message_manage')->where('id', '>', $id)->orderBy('id', 'asc')->limit(1)->first();
            $next_news = objtoarr($next_news);
            #所有评论
            $all_comment = Db::connection('shop_db')->table('website_crossborder_news_chat')->where(['news_id'=>$id,'type'=>$type])->orderBy('id', 'desc')->get();
            $all_comment = objtoarr($all_comment);

            #是否有配置跳转其他应用
            $footerInfo = Db::table('footer_body')->where(['id'=>$foid])->first();
            $footerInfo = objtoarr($footerInfo);
            if (isset($footerInfo['have_link'])) {
                $footerInfo['link'] = $this->getAppLink(2, ['other_navbar'=>$footerInfo['content_id']]);
                $data['link'] = $footerInfo['link'];
            }

            return view('home.msg_detail', compact('website', 'news', 'id', 'type', 'prev_news', 'next_news', 'all_comment', 'data', 'signPackage', 'rand', 'footerInfo', 'isframe'));
        }
    }

    #图文详情
    public function txt_detail(Request $request)
    {
        $dat = $request->except(['_token']);
        $oid = isset($dat['oid']) ? intval($dat['oid']) : 0;
        $foid = isset($dat['foid']) ? intval($dat['foid']) : 0;
        $page_id = isset($dat['id']) ? intval($dat['id']) : 0;

        if ($request->isMethod('post')) {
        } else {
            $news = Db::connection('shop_db')->table('website_image_txt')->where(['id'=>intval($dat['id'])])->first();
            $news = objtoarr($news);

            if (!empty($news['content'])) {
                $news['content'] = json_decode($news['content'], true)['zh'];
            }
            if (!empty($news['color_word'])) {
                $news['color_word'] = json_decode($news['color_word'], true)['zh'];
            }
//            dd($news);

            $stype = trim($dat['type']);
            $news['share_num'] = 0;
            $news['like_num'] = 0;
            $type=11;

//            if($stype=='lunbo'){
//                #轮播调用
//                $type=5;
//
//                $con = Db::connection('shop_db')->table('website_rotate')->where(['id'=>intval($dat['oid'])])->first();
//                $con = objtoarr($con);
//                $news['share_num'] = intval($con['share_num']);
//
//                if(empty($con['like_num'])){
//                    $news['like_num'] = rand(100,999);
//                    Db::connection('shop_db')->table('website_rotate')->where(['id'=>intval($dat['oid'])])->update(['like_num'=>$news['like_num']]);
//                }else{
//                    $news['like_num'] = $con['like_num'];
//                }
//
//                $news['comment_num'] = Db::connection('shop_db')->table('website_crossborder_news_chat')->where(['type'=>$type,'news_id'=>$con['id']])->count();
//            }
//            elseif($stype=='liucheng'){
//                #流程调用
//                $type=6;
//
//                $con = Db::connection('shop_db')->table('centralize_process_list')->where(['id'=>intval($dat['oid'])])->first();
//                $con = objtoarr($con);
//                $news['share_num'] = intval($con['share_num']);
//
//                if(empty($con['like_num'])){
//                    $news['like_num'] = rand(100,999);
//                    Db::connection('shop_db')->table('centralize_process_list')->where(['id'=>intval($dat['oid'])])->update(['like_num'=>$news['like_num']]);
//                }else{
//                    $news['like_num'] = $con['like_num'];
//                }
//
//
//                $news['comment_num'] = Db::connection('shop_db')->table('website_crossborder_news_chat')->where(['type'=>$type,'news_id'=>$con['id']])->count();
//            }
//            elseif($stype=='yejiao'){
//                #页脚调用
//                $type=7;
//
//                $con = Db::table('footer_body')->where(['id'=>intval($dat['oid'])])->first();
//                $con = objtoarr($con);
//                $news['share_num'] = intval($con['share_num']);
//
//                if(empty($con['like_num'])){
//                    $news['like_num'] = rand(100,999);
//                    Db::table('footer_body')->where(['id'=>intval($dat['oid'])])->update(['like_num'=>$news['like_num']]);
//                }else{
//                    $news['like_num'] = $con['like_num'];
//                }
//
//                $news['comment_num'] = Db::connection('shop_db')->table('website_crossborder_news_chat')->where(['type'=>$type,'news_id'=>$con['id']])->count();
//            }
//            elseif($stype=='services'){
//                #业务服务调用
//                $type=10;
//
//                $con = Db::connection('shop_db')->table('centralize_services_list')->where(['id'=>intval($dat['oid'])])->first();
//                $con = objtoarr($con);
//                $news['share_num'] = intval($con['share_num']);
//
//                if(empty($con['like_num'])){
//                    $news['like_num'] = rand(100,999);
//                    Db::connection('shop_db')->table('centralize_services_list')->where(['id'=>intval($dat['oid'])])->update(['like_num'=>$news['like_num']]);
//                }else{
//                    $news['like_num'] = $con['like_num'];
//                }
//
//                $news['comment_num'] = Db::connection('shop_db')->table('website_crossborder_news_chat')->where(['type'=>$type,'news_id'=>$con['id']])->count();
//            }

            $news['share_num'] = intval($news['share_num']);

            if (empty($news['like_num'])) {
                $news['like_num'] = rand(100, 999);
                Db::connection('shop_db')->table('website_image_txt')->where(['id'=>intval($dat['id'])])->update(['like_num'=>$news['like_num']]);
            } else {
                $news['like_num'] = $news['like_num'];
            }

            $news['comment_num'] = Db::connection('shop_db')->table('website_crossborder_news_chat')->where(['type'=>$type,'news_id'=>$dat['id']])->count();

            $id = intval($dat['oid']);
            $news['id'] = $id;
            $news['name'] = json_decode($news['name'], true)['zh'];
            $news['desc'] = json_decode($news['desc'], true)['zh'];
            #分享
            $data['url'] = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"];
            $data['name'] = $news['name'];
            $data['desc'] = $news['desc'];
            $data['url_this'] = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"];
            $data['thumb'] = 'https://shop.gogo198.cn/collect_website/public/uploads/centralize/website_index/64a5282e9bdbf.png';
            $signPackage = weixin_share($data);
            $news['link'] = '';

            #随机码
            $rand = rand(11111, 99999);

            #获取配置信息
            $website = get_website();
            $website['name'] = $news['name'];
            $page_info = get_pageinfo('/msg_detail');
            $website['background'] = $page_info['content']['background'];
            $website['content'] = $page_info['content']['content'];
            $website['fontcolor'] = $page_info['content']['fontcolor'];
//            $website['name'] = $news['title'];
//            $website['keywords'] = $news['title'];
//            $website['desc'] = $news['title'];

            #所有评论
            $all_comment = Db::connection('shop_db')->table('website_crossborder_news_chat')->where(['news_id'=>$id,'type'=>$type])->orderBy('id', 'desc')->get();
            $all_comment = objtoarr($all_comment);

            $origin_page = '/txt_detail?id='.$page_id.'&type='.$stype.'&oid='.$id.'&foid='.$foid;

            #是否有配置跳转其他应用
            $footerInfo = Db::table('footer_body')->where(['id'=>$foid])->first();
            $footerInfo = objtoarr($footerInfo);
            if (isset($footerInfo['have_link'])) {
                $footerInfo['link'] = $this->getAppLink(2, ['other_navbar'=>$footerInfo['content_id']]);
                $data['link'] = $footerInfo['link'];
            }
            
            return view('home.txt_detail', compact('website', 'news', 'id', 'data', 'signPackage', 'all_comment', 'type', 'rand', 'footerInfo', 'origin_page'));
        }
    }

    #政策详情
    public function policy_detail(Request $request)
    {
        $dat = $request->except(['_token']);
        $foid = isset($dat['foid']) ? intval($dat['foid']) : 0;

        if ($request->isMethod('post')) {
        } else {
            $news = Db::connection('shop_db')->table('policy_list')->where(['id'=>intval($dat['id'])])->first();
            $news = objtoarr($news);
            $news['share_num'] = intval($news['share_num']);
            $type=4;

            if (empty($news['like_num'])) {
                $news['like_num'] = rand(100, 999);
                Db::connection('shop_db')->table('policy_list')->where(['id'=>intval($dat['id'])])->update(['like_num'=>$news['like_num']]);
            }

            $news['comment_num'] = Db::connection('shop_db')->table('website_crossborder_news_chat')->where(['type'=>$type,'news_id'=>$news['id']])->count();

            $news['name'] = json_decode($news['name'], true)['zh'];
            $news['content'] = json_decode($news['content'], true)['zh'];
            $news['issuing_authority'] = json_decode($news['issuing_authority'], true)['zh'];
            $news['document_number'] = json_decode($news['document_number'], true)['zh'];
            $news['effect'] = json_decode($news['effect'], true)['zh'];
            if ($news['origin_type']==2) {
                $news['file'] = json_decode($news['file'], true)[0];
            }

            $id = intval($dat['id']);
            #分享
            $data['url'] = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"];
            $data['name'] = $news['name'];
            $data['desc'] = $news['issuing_authority'];
            $data['url_this'] = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"];
            $data['thumb'] = 'https://shop.gogo198.cn/collect_website/public/uploads/centralize/website_index/64a5282e9bdbf.png';
            $signPackage = weixin_share($data);

            #随机码
            $rand = rand(11111, 99999);

            #获取配置信息
            $website = get_website();
            $website['name'] = $news['name'];
            $page_info = get_pageinfo('/policy_detail');
            $website['background'] = $page_info['content']['background'];
            $website['content'] = $page_info['content']['content'];
            $website['fontcolor'] = $page_info['content']['fontcolor'];
//            $website['name'] = $news['title'];
//            $website['keywords'] = $news['title'];
//            $website['desc'] = $news['title'];

            #所有评论
            $all_comment = Db::connection('shop_db')->table('website_crossborder_news_chat')->where(['news_id'=>$id,'type'=>$type])->orderBy('id', 'desc')->get();
            $all_comment = objtoarr($all_comment);

            #是否有配置跳转其他应用
            $footerInfo = Db::table('footer_body')->where(['id'=>$foid])->first();
            $footerInfo = objtoarr($footerInfo);
            if (isset($footerInfo['have_link'])) {
                $footerInfo['link'] = $this->getAppLink(2, ['other_navbar'=>$footerInfo['content_id']]);
                $data['link'] = $footerInfo['link'];
            }

            $origin_page = '/policy_detail?id='.$dat['id'].'&foid='.$foid;

            return view('home.policy_detail', compact('website', 'news', 'id', 'data', 'signPackage', 'all_comment', 'type', 'rand', 'footerInfo', 'origin_page'));
        }
    }

    #平台规则列表
    public function rule_list(Request $request)
    {
        $dat = $request->except(['_token']);
        if ($request->isMethod('post')) {
            $limit = $dat['limit'];
            $page = $dat['page'] - 1;

            if ($page != 0) {
                $page = $limit * $page;
            }
            $count = Db::connection('shop_db')->table('website_platform_keywords')->orderBy('id', 'desc')->count();
            $rows = DB::connection('shop_db')->table('website_platform_keywords as a')
                ->leftJoin('website_platform_type as b', 'b.id', '=', 'a.type_id')
                ->limit($page.','.$limit)
                ->orderBy('id', 'desc')
                ->select(['a.*','b.name as type_name'])
                ->get();
            $rows = objtoarr($rows);
            foreach ($rows as $k=>$v) {
                $rows[$k]['name'] = $v['type_name'].'['.$v['name'].']';
            }
            return Response()->json(['code'=>0,'count'=>$count,'data'=>$rows]);
        } else {
            $list = Db::connection('shop_db')->table('website_platform_type')->get();
            $list = objtoarr($list);
            foreach ($list as $k=>$v) {
                $list[$k]['children'] = Db::connection('shop_db')->table('website_platform_keywords')->where(['type_id'=>$v['id']])->get();
                $list[$k]['children'] = objtoarr($list[$k]['children']);
                foreach ($list[$k]['children'] as $k2=>$v2) {
                    $list[$k]['children'][$k2]['children'] = Db::connection('shop_db')->table('website_platform_rule')->where(['type_id'=>$v['id'],'key_id'=>$v2['id'],'pid'=>0])->get();
                    $list[$k]['children'][$k2]['children'] = objtoarr($list[$k]['children'][$k2]['children']);
                }
            }

            #获取配置信息
            $website = get_website();
            $page_info = get_pageinfo('/rule_detail');
            $website['background'] = $page_info['content']['background'];
            $website['content'] = $page_info['content']['content'];
            $website['fontcolor'] = $page_info['content']['fontcolor'];

            $origin_page = '/rule_list';

            return view('home.rule_list', compact('website', 'list', 'page_info', 'origin_page'));
        }
    }

    #规则版本列表
    public function version_list(Request $request)
    {
        $dat = $request->except(['_token']);
        $pid = isset($dat['pid']) ? intval($dat['pid']) : 0;
        if (isset($dat['pa'])) {
            $limit = $dat['limit'];
            $page = $dat['page'] - 1;

            if ($page != 0) {
                $page = $limit * $page;
            }
            $count = Db::connection('shop_db')->table('website_platform_rule')->where(['pid'=>$pid,'status'=>0])->orWhere('id', '=', $pid)->count();
            $rows = DB::connection('shop_db')->table('website_platform_rule')
                ->where(['pid'=>$pid,'status'=>0])
                ->orWhere('id', '=', $pid)
                ->offset($page)
                ->limit($limit)
                ->orderBy('createtime', 'desc')
                ->get();
            $rows = objtoarr($rows);

            foreach ($rows as $k=>$v) {
                $rows[$k]['createtime'] = date('Y-m-d H:i', $v['createtime']);
            }
            return Response()->json(['code'=>0,'count'=>$count,'data'=>$rows]);
        } else {
            $history = Db::connection('shop_db')->table('website_platform_rule')->where(['id'=>$pid])->first();
            $history = objtoarr($history);

            #获取配置信息
            $website = get_website();
            $page_info = get_pageinfo('/rule_detail');
            $website['background'] = $page_info['content']['background'];
            $website['content'] = $page_info['content']['content'];
            $website['fontcolor'] = $page_info['content']['fontcolor'];

            $origin_page = '/version_list?pid='.$pid;

            return view('home.version_list', compact('website', 'pid', 'page_info', 'history', 'origin_page'));
        }
    }

    #平台规则详情
    public function rule_detail(Request $request)
    {
        $dat = $request->except(['_token']);
        $foid = isset($dat['foid']) ? intval($dat['foid']) : 0;
        if ($request->isMethod('post')) {
            $data = Db::connection('shop_db')->table('website_platform_rule')->where(['id'=>$dat['id']])->find();
            $data = objtoarr($data);
            $data['content'] = json_decode($data['content'], true);
            $content = [];
            $first = [];
            $second = [];
            foreach ($data['content'] as $k=>$v) {
                if ($v['pnum']==$dat['parag_num']) {
                    array_push($first, [
                        'title'=>$v['title'],
                        'parag_num'=>$v['parag_num'],
                        'pnum'=>$v['pnum'],
                        'content'=>$v['content'],
                        'children'=>[],
                    ]);
                } else {
                    array_push($second, [
                        'title'=>$v['title'],
                        'parag_num'=>$v['parag_num'],
                        'pnum'=>$v['pnum'],
                        'content'=>$v['content'],
                        'children'=>[],
                    ]);
                }
            }

            #最多嵌套3层
            foreach ($first as $k=>$v) {
                foreach ($second as $k2=>$v2) {
                    if ($v['parag_num']==$v2['pnum']) {
                        #1.1.
                        array_push($first[$k]['children'], $v2);
                    } else {
                        foreach ($first[$k]['children'] as $k3=>$v3) {
                            if ($v3['parag_num']==$v2['pnum']) {
                                #1.1.1.
                                array_push($first[$k]['children'][$k3]['children'], [
                                    'title'=>$v2['title'],
                                    'parag_num'=>$v2['parag_num'],
                                    'pnum'=>$v2['pnum'],
                                    'content'=>$v2['content'],
                                    'children'=>[],
                                ]);
                            }
                        }
                    }
                }
            }
            $content = $first;
            return Response()->json(['code'=>0,'data'=>$content]);
        } else {
            #获取配置信息
            $website = get_website();
            $page_info = get_pageinfo('/rule_detail');
            $website['background'] = $page_info['content']['background'];
            $website['content'] = $page_info['content']['content'];
            $website['fontcolor'] = $page_info['content']['fontcolor'];

            #规则内容
            $data = Db::connection('shop_db')->table('website_platform_rule')->where(['id'=>$dat['id']])->first();
            $data = objtoarr($data);

            #分享
            $data['url'] = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"];
            $data['desc'] = $data['version'];
            $data['name'] = $data['rule_name'];
            $data['url_this'] = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"];
            $signPackage = weixin_share($data);

            #序言
            if ($data['is_preamble']==1) {
                $data['preamble_con'] = json_decode($data['preamble_con'], true);
            }
            $data['content'] = json_decode($data['content'], true);
            #整理树形结构代码
            if ($data['type']==1) {
                $first = [];
                $second = [];
                foreach ($data['content'] as $k=>$v) {
                    if ($v['pnum']==0) {
                        array_push($first, [
                            'title'=>$v['title'],
                            'parag_num'=>$v['parag_num'],
                            'pnum'=>$v['pnum'],
                            'content'=>$v['content'],
                            'children'=>[],
                        ]);
                    } else {
                        array_push($second, [
                            'title'=>$v['title'],
                            'parag_num'=>$v['parag_num'],
                            'pnum'=>$v['pnum'],
                            'content'=>$v['content'],
                            'children'=>[],
                        ]);
                    }
                }

                #最多嵌套3层
                foreach ($first as $k=>$v) {
                    foreach ($second as $k2=>$v2) {
                        if ($v['parag_num']==$v2['pnum']) {
                            #1.1.
                            array_push($first[$k]['children'], $v2);
                        } else {
                            foreach ($first[$k]['children'] as $k3=>$v3) {
                                if ($v3['parag_num']==$v2['pnum']) {
                                    #1.1.1.
                                    array_push($first[$k]['children'][$k3]['children'], [
                                        'title'=>$v2['title'],
                                        'parag_num'=>$v2['parag_num'],
                                        'pnum'=>$v2['pnum'],
                                        'content'=>$v2['content'],
                                        'children'=>[],
                                    ]);
                                }
                            }
                        }
                    }
                }
                $data['content2'] = $first;
            }

            $origin_page = '/rule_detail?id='.$dat['id'].'&foid='.$foid;

            #是否有配置跳转其他应用
            $footerInfo = Db::table('footer_body')->where(['id'=>$foid])->first();
            $footerInfo = objtoarr($footerInfo);
            if (isset($footerInfo['have_link'])) {
                $footerInfo['link'] = $this->getAppLink(2, ['other_navbar'=>$footerInfo['content_id']]);
            }

            return view('home.rule_detail', compact('website', 'data', 'signPackage', 'page_info', 'footerInfo', 'origin_page'));
        }
    }

    #关注我们详情
    public function social_detail(Request $request)
    {
        $dat = $request->except(['_token']);
        $id = isset($dat['id']) ? intval($dat['id']) : 0;
        $isframe = isset($dat['isframe']) ? intval($dat['isframe']) : 0;
        $origin_page = '/social_detail?id='.$id;

        if ($request->isMethod('post')) {
        } else {
            #获取配置信息
            $website = get_website();
            $page_info = get_pageinfo('/social_detail');
            $website['background'] = $page_info['content']['background'];
            $website['content'] = $page_info['content']['content'];
            $website['fontcolor'] = $page_info['content']['fontcolor'];

            $data = Db::connection('shop_db')->table('website_contact')->where(['id'=>$id])->first();
            $data = objtoarr($data);

            return view('home.social_detail', compact('website', 'data', 'id', 'page_info', 'isframe', 'origin_page'));
        }
    }

    #平台电邮详情
    public function platfrom_email(Request $request)
    {
        $dat = $request->except(['_token']);
        $isframe = isset($dat['isframe']) ? intval($dat['isframe']) : 0;

        #获取配置信息
        $website = get_website();
        $page_info = get_pageinfo('/platfrom_email');
        $website['background'] = $page_info['content']['background'];
        $website['content'] = $page_info['content']['content'];
        $website['fontcolor'] = $page_info['content']['fontcolor'];
        return view('home.inner.platfrom_email', compact('website', 'list', 'page_info', 'isframe'));
    }

    #个人资料
    public function basic_info(Request $request)
    {
        $dat = $request->except(['_token']);
        $isframe = isset($dat['isframe']) ? intval($dat['isframe']) : 0;

        if ($request->isMethod('post')) {
            if ($request->session()->get('user.user_id')>0) {
                Db::beginTransaction();
                try {
                    Db::table('user')->where(['user_id' => $request->session()->get('user.user_id')])->update([
                        'nickname' => trim($dat['nickname']),
                        'user_name' => trim($dat['realname']),
                        'mobile' => trim($dat['mobile']),
                        'email' => trim($dat['email']),
                    ]);

                    Db::connection('shop_db')->table('website_user')->where(['custom_id' => $request->session()->get('user.gogo_id')])->update([
                        'nickname' => trim($dat['nickname']),
                        'realname' => trim($dat['realname']),
                        'phone' => trim($dat['mobile']),
                        'email' => trim($dat['email']),
                    ]);
                    DB::commit();
                    return Response()->json(['code'=>0,'msg'=>'保存成功']);
                } catch (\Exception $e) {
                    Db::rollBack();
                    echo $e->getMessage();
                    echo $e->getCode();
                }
            }
        } else {
            #获取配置信息
            $website = get_website();
            $page_info = get_pageinfo('/basic_info');
            $website['background'] = $page_info['content']['background'];
            $website['content'] = $page_info['content']['content'];
            $website['fontcolor'] = $page_info['content']['fontcolor'];

            $user = Db::table('user')->where(['user_id' => $request->session()->get('user.user_id')])->first();
            $user = objtoarr($user);

            return view('home.inner.basic_info', compact('website', 'list', 'page_info', 'isframe', 'user'));
        }
    }

    #友情链接
    public function friendly_link(Request $request)
    {
        $dat = $request->except(['_token']);

        if ($request->isMethod('post')) {
        } else {
            #获取配置信息
            $website = get_website();
            $page_info = get_pageinfo('/friendly_link');
            $website['background'] = $page_info['content']['background'];
            $website['content'] = $page_info['content']['content'];
            $website['fontcolor'] = $page_info['content']['fontcolor'];

            #友情链接分类
            $linkcate_list = Db::connection('shop_db')->table('website_linkcategory')->where(['show'=>2,'company_id'=>0])->orderBy('id', 'desc')->get();
            $linkcate_list = objtoarr($linkcate_list);
            foreach ($linkcate_list as $k=>$v) {
                $linkcate_list[$k]['name'] = json_decode($v['name'], true)['zh'];
                $linkcate_list[$k]['children'] = Db::connection('shop_db')->table('website_link')->where('cate_id', $v['id'])->get();
                $linkcate_list[$k]['children'] = objtoarr($linkcate_list[$k]['children']);
                foreach ($linkcate_list[$k]['children'] as $k2=>$v2) {
                    $linkcate_list[$k]['children'][$k2]['name'] = json_decode($v2['name'], true)['zh'];
                }
            }

            return view('home.friendly_detail', compact('website', 'linkcate_list', 'page_info'));
        }
    }

    #帮助中心
    public function help_us(Request $request)
    {
        $dat = $request->except(['_token']);

        if ($request->isMethod('post')) {
        } else {
            #获取配置信息
            $website = get_website();
            $page_info = get_pageinfo('/help_us');
            $website['background'] = $page_info['content']['background'];
//            $website['help'] = $page_info['content']['help'];
            $website['content']['content'] = $page_info['content']['content'];
            $website['fontcolor'] = $page_info['content']['fontcolor'];

            return view('home.help_us', compact('website', 'data', 'page_info'));
        }
    }

    #我要咨询
    public function advice(Request $request)
    {
        $dat = $request->except(['_token']);

        if ($request->isMethod('post')) {
            if ($dat['code_origin'] != trim($dat['code_input'])) {
                return Response()->json(['code'=>-1,'msg'=>'验证码不正确']);
            }

            if (empty($dat['name']) || empty($dat['email']) || empty($dat['mobile']) || empty($dat['content'])) {
                return Response()->json(['code'=>-1,'msg'=>'请输入信息']);
            }

            if (!preg_match("/^1[34578]\d{9}$/", trim($dat['mobile']))) {
                return Response()->json(['code'=>-1,'msg'=>'请输入正确的手机号码']);
            }

            if (!preg_match('/([\w\-]+\@[\w\-]+\.[\w\-]+)/', trim($dat['email']))) {
                return Response()->json(['code'=>-1,'msg'=>'请输入正确的邮箱号码']);
            }

            $res = Db::connection('shop_db')->table('website_message')->insert([
                'pid'=>intval($dat['id']),
                'name'=>trim($dat['name']),
                'email'=>trim($dat['email']),
                'tel'=>trim($dat['mobile']),
                'remark'=>$dat['content'],
                'createtime'=>time(),
            ]);
            if ($res) {
                return Response()->json(['code'=>0,'msg'=>'提交成功！']);
            }
        }
    }

    #客服中心
    public function customer_online(Request $request)
    {
        $dat = $request->except(['_token']);
        $control_height = isset($dat['control_height']) ? $dat['control_height'] : 350;
        if ($request->isMethod('post')) {
            $user = Db::connection('shop_db')->table('website_user')->where(['custom_id'=>session('user.gogo_id')])->first();
            $user = objtoarr($user);
            if ($dat['pa']==1) {
                #插入数据表

                $content = json_encode($dat['content'], true);
                $merchant_master = 0;
                #判断当前页面是否商品页面
                $origin_page = trim($dat['origin_page']);
                if (strpos($origin_page, 'goods-') !== false) {
                    $gid = explode('goods-', $origin_page)[1];
                    $gid = explode('.html', $gid)[0];
                    $merchant_master = Db::table('goods')->where(['goods_id'=>$gid])->first()->shop_id;
                }

                Db::connection('shop_db')->table('website_chatlist')->insert([
                    'pid'=>$dat['pid'],
                    'uid'=>$user['id'],
                    'merchant_master'=>$merchant_master,
                    'who_send'=>$dat['who_send'],
                    'is_read'=>0,
                    'content_type'=>$dat['content_type'],
                    'content'=>$content,
                    'quote_text'=>isset($dat['quote_text']) ? trim($dat['quote_text']) : '',
                    'origin_page'=>$origin_page,
                    'createtime'=>time()
                ]);

                return Response()->json(['code'=>0,'msg'=>'已发送']);
            } elseif ($dat['pa']==2) {
                #获取历史消息，以日为数组
                $list = Db::connection('shop_db')->table('website_chatlist')->where(['uid'=>$user['id']])->orderBy('id', 'asc')->select(['id','createtime'])->get();
                $list = objtoarr($list);
                if (!empty($list)) {
                    $pid = $list[0]['id'];
                } else {
                    $pid = 0;
                }

                $chat_group = [];
                $who_send = 2;
                if (!empty($list)) {
                    #聊天记录以时间为数组
                    $group = [];
                    foreach ($list as $k=>$v) {
                        $time = date('Y-m-d', $v['createtime']);
                        if (empty($group)) {
                            $group = array_merge($group, [$time]);
                        } else {
                            if (!in_array($time, $group)) {
                                $group = array_merge($group, [$time]);
                            }
                        }
                    }
                    sort($group);
                    #根据时间查找聊天记录
                    foreach ($group as $k=>$v) {
                        $starttime = strtotime($v.' 00:00:00');
                        $endtime = strtotime($v.' 23:59:59');
                        $chat_group[$k]['time'] = date('Y年m月d日', $starttime);

                        $chat_group[$k]['info'] = Db::connection('shop_db')->table('website_chatlist')->where(['uid' => $user['id']])->whereBetween('createtime', [$starttime, $endtime])->orderBy('createtime', 'asc')->get();
                        $chat_group[$k]['info'] = objtoarr($chat_group[$k]['info']);
                    }
                    #整理数组
                    foreach ($chat_group as $k=>$v) {
                        foreach ($v['info'] as $kk=>$vv) {
                            $chat_group[$k]['info'][$kk]['content'] = json_decode($vv['content'], true);
                            $chat_group[$k]['info'][$kk]['createtime'] = date('H:i', $vv['createtime']);
                        }
                    }

                    #全部设置成已看记录
                    Db::connection('shop_db')->table('website_chatlist')->where(['pid' => $pid, 'who_send' => 1,'is_read'=>0])->update(['is_read' => 1]);
                }

                return Response()->json(['code'=>0,'data'=>$chat_group,'pid'=>$pid]);
            } elseif ($dat['pa']==3) {
                #撤回消息（查看当前聊天有无被对方看过）
                $id = intval($dat['id']);
                $nowchat = Db::connection('shop_db')->table('website_chatlist')->where(['id'=>$id])->first();
                if ($nowchat->is_read==0) {
                    Db::connection('shop_db')->table('website_chatlist')->where(['id'=>$id])->update(['is_withdraw'=>1]);
                }
                return Response()->json(['code'=>0,'msg'=>'撤回成功']);
            }
        } else {
//            $user = Db::connection('shop_db')->table('website_user')->where(['custom_id'=>session('user.gogo_id')])->first();
//            $user = objtoarr($user);
            $who_send = 2;
            return view('home.customer_online', compact('who_send', 'control_height'));
        }
    }

    #汇率详情
    public function rate_detail(Request $request)
    {
        $dat = $request->except(['_token']);
        $id = isset($dat['id']) ? intval($dat['id']) : 0;
        $isframe = isset($dat['isframe']) ? intval($dat['isframe']) : 0;
        $price = isset($dat['price']) ? intval($dat['price']) : 1;

        if ($request->isMethod('post')) {
            if ($dat['pa']==1) {
                $key = 'feea63fb96c064f252418348bf775fa9';
                $from = Db::connection('shop_db')->table('website_exchange_rate')->where(['id'=>$dat['from_currency']])->first();
                $to = Db::connection('shop_db')->table('website_exchange_rate')->where(['id'=>$dat['to_currency']])->first();
                $url = 'http://api.tanshuapi.com/api/exchange/v1/index?key='.$key.'&from='.$from->symbol.'&to='.$to->symbol.'&money='.intval($dat['from_money']);
                $list = json_decode(file_get_contents($url), true);

                if ($list['code']==1) {
                    return Response()->json(['code'=>0,'msg'=>'查询成功','data'=>$list['data']]);
                } else {
                    return Response()->json(['code'=>-1,'msg'=>'查询失败']);
                }
            }
        } else {
            $data = Db::connection('shop_db')->table('website_exchange_rate')->where(['id'=>$id])->first();
            $data = objtoarr($data);

            #获取配置信息
            $website = get_website();
            $page_info = get_pageinfo('/rate_detail');
            $website['background'] = $page_info['content']['background'];
            $website['content'] = $page_info['content']['content'];
            $website['fontcolor'] = $page_info['content']['fontcolor'];

            #币种
            $currency = Db::connection('shop_db')->table('website_exchange_rate')->whereRaw('id != 158 ')->get();
            $currency = objtoarr($currency);

            $origin_page = '/';

            return view('home.rate_detail', compact('data', 'id', 'website', 'currency', 'isframe', 'price', 'origin_page'));
        }
    }

    #高级搜索页
    public function search_list(Request $request)
    {
        $dat = $request->except(['_token']);
        $id = isset($dat['id']) ? intval($dat['id']) : 0;
        $isframe = isset($dat['isframe']) ? intval($dat['isframe']) : 0;

        if ($request->isMethod('post')) {
        } else {
            #获取配置信息
            $website = get_website();
            $page_info = get_pageinfo('/search_list');
            $website['background'] = $page_info['content']['background'];
            $website['content'] = $page_info['content']['content'];
            $website['fontcolor'] = $page_info['content']['fontcolor'];

            $data = Db::table('search_list')->where(['id'=>$id])->first();
            $data = objtoarr($data);

            if (!empty($data['content'])) {
                $data['column_content'] = Db::table('search_column')->whereRaw('find_in_set(id,?)', [$data['content']])->whereRaw('type <> 1')->get();
                $data['column_content'] = objtoarr($data['column_content']);
                foreach ($data['column_content'] as $k=>$v) {
                    $data['column_content'][$k]['content'] = json_decode($v['content'], true);
                    if (!empty($data['column_content'][$k]['content'])) {
                        $data['column_content'][$k]['content'] = explode('、', $data['column_content'][$k]['content']);
                    }
                }
            }

            $origin_page = '/';

            return view('home.inner.search_list', compact('website', 'data', 'isframe', 'id', 'origin_page'));
        }
    }

    #网站菜单页
    public function menu_detail(Request $request)
    {
        $dat = $request->except(['_token']);
        $isframe = isset($dat['isframe']) ? intval($dat['isframe']) : 0;

        if ($request->isMethod('post')) {
        } else {
            #获取配置信息
            $website = get_website();
            $page_info = get_pageinfo('/menu_detail');
            $website['background'] = $page_info['content']['background'];
            $website['content'] = $page_info['content']['content'];
            $website['fontcolor'] = $page_info['content']['fontcolor'];
            return view('home.inner.menu_detail', compact('website', 'isframe', 'page_info'));
        }
    }

    #导页
    public function guide_page(Request $request){
        $dat = $request->except(['_token']);
        $id = $dat['id'];
        
        $cache = is_mobile2() ? 'guide_page_all_mobile_'.$id : 'guide_page_all_pc_'.$id;
        
        $guide = Cache::remember($cache, 84600, function () use ($id) {
            
            $guide = DB::table('guide_body')->where('id', $id)->first();
            if (!$guide) return null;
            $guide = (array)$guide;
    
            $format = DB::table('guide_format')->where('id', $guide['content_id'])->first();
            if (!$format) return null;
            $guide['content_info'] = (array)$format;
    
            $type = $format->type;
    
            // type == 7 平台推荐（最慢的那个）
            if ($type == 7) {
                $guide = $this->optimizeType7($guide, $id);
            }
            // type == 8 产业集聚
            elseif ($type == 8) {
                $guide = $this->optimizeType8($guide, $id);
            }
            // type == 9 环球节庆（几乎无压力，直接缓存）
            elseif ($type == 9) {
                $guide['children'] = Cache::remember('guide_festival_chunks', 86400, function () {
                    $festival = DB::connection('shop_db')
                        ->table('website_festival')
                        ->whereRaw('date >= DATE_SUB(CURDATE(), INTERVAL 1 DAY)')
                        ->whereRaw('date <= DATE_ADD(CURDATE(), INTERVAL 15 DAY)')
                        ->orderBy('date', 'asc')
                        ->get()
                        ->toArray();
                  
                    $festival = addCountryPic(objtoarr($festival));
                    $filtered = [];
                    foreach ($festival as $item) {
                        if (!isset($item['is_deplicate'])) {
                            $filtered[] = $item;
                        }
                    }
                    $festival = $filtered;
                    $festival = array_values($festival);
                    shuffle($festival);
    
                    $chunkSize = is_mobile2() ? 1 : 6;
                    
                    $chunks = collect($festival)->chunk($chunkSize);
    
                    $final = [];
                    foreach ($chunks as $chunk) {
                        $final[] = $chunk->chunk(is_mobile2() ? 1 : 3)->toArray();
                    }
                    return $final;
                });
            }
            
            return $guide;
        });
        
        $data['guide'] = &$guide;
        // $data['guide'] = objtoarr($data['guide'])[0];
        
        $website = get_website();
        #当前页面的链接
        $origin_page = '/login.html?open=4&param2='.base64_encode('/guide_page?id='.$id);

        return view('home.guide_page', compact('id', 'data', 'website', 'origin_page'));
    }
    
    private function optimizeType7($guide, $guide_id)
    {
        // 1. 一次性取出所有上架商品
        $shelfItems = DB::table('goods_shelf')
            ->where('type', 2)
            ->where('guide_id', $guide_id)
            ->where('keywords', '<>', '')
            ->get();
    
        $gids = $shelfItems->pluck('gid')->unique()->filter()->values()->all();
    
        // 2. 批量预加载商品和 SKU
        $goods = DB::table('goods')
            ->whereIn('goods_id', $gids)
            ->where('goods_status', 1)
            ->get()
            ->keyBy('goods_id');
    
        $skus = DB::table('goods_sku')
            ->whereIn('goods_id', $gids)
            ->get()
            ->keyBy('goods_id');
    
        // 3. 批量预加载企业信息
        $companyIds = $shelfItems->pluck('cid')->unique()->filter()->values()->all();
        $companies = collect();
        if ($companyIds) {
            $companies = DB::connection('shop_db')
                ->table('website_user_company')
                ->whereIn('id', $companyIds)
                ->get()
                ->keyBy('id');
        }
    
        // ====== 修复关键词处理 ======
        $guideKeywords = [];
        if (!empty($guide['gkeywords'])) {
            $guideKeywords = array_filter(explode('、', $guide['gkeywords']));
        }
        // ============================
    
        $goodsList = [];
    
        // 上架商品匹配
        foreach ($shelfItems as $shelf) {
            $goodsItem = $goods->get($shelf->gid);
            if (!$goodsItem) {
                continue;
            }
    
            $shelfKeywords = array_filter(explode('、', $shelf->keywords));
    
            // 如果导页有设置关键词，必须有交集才显示
            if (!empty($guideKeywords) && empty(array_intersect($shelfKeywords, $guideKeywords))) {
                continue;
            }
    
            $sku = $skus->get($goodsItem->goods_id);
            $sku_prices = $sku ? json_decode($sku->sku_prices, true) : ['price' => [$goodsItem->goods_price]];
    
            $companyName = 'Gogo';
            if ($shelf->cid && isset($companies[$shelf->cid])) {
                $companyName = $companies[$shelf->cid]->company ?? 'Gogo';
            }
    
            $goodsList[] = [
                'goods_id'       => $goodsItem->goods_id,
                'goods_name'     => $goodsItem->goods_name,
                'goods_image'    => $goodsItem->goods_image,
                'company'        => $companyName,
                'goods_currency' => 'CNY',
                'price'          => number_format(end($sku_prices['price']), 2),
            ];
        }
    
        // 关键词兜底商品（如果上架商品太少）
        if (!empty($guideKeywords)) {
            $keywordGoods = DB::table('goods')
                ->join('goods_keywords', 'goods.keywords_id', '=', 'goods_keywords.id')
                ->whereIn('goods_keywords.keywords', $guideKeywords)
                ->where('goods.goods_status', 1)
                ->select('goods.*')
                ->limit(30)
                ->get();
    
            foreach ($keywordGoods as $g) {
                $sku = $skus->get($g->goods_id);
                $sku_prices = $sku ? json_decode($sku->sku_prices, true) : ['price' => [$g->goods_price]];
    
                $goodsList[] = [
                    'goods_id'       => $g->goods_id,
                    'goods_name'     => $g->goods_name,
                    'goods_image'    => $g->goods_image,
                    'company'        => 'Gogo',
                    'goods_currency' => 'CNY',
                    'price'          => number_format(end($sku_prices['price']), 2),
                ];
            }
        }
    
        // 打乱并限制数量
        shuffle($goodsList);
        $guide['goods_info'] = array_slice($goodsList, 0, 30);
    
        // ========= 新增：公司筛选列表 =========
        $companyInfo = [];
        foreach ($shelfItems as $s) {
            if ($s->cid && isset($companies[$s->cid])) {
                $c = $companies[$s->cid];
                $companyInfo[$c->id] = [
                    'id'      => $c->id,
                    'company' => $c->company ?? 'Gogo',
                ];
            }
        }
        $companyInfo[0] = ['id' => 0, 'company' => 'Gogo平台']; // 平台自营
        $guide['company_info'] = array_values($companyInfo);
    
        return $guide;
    }

    private function optimizeType8($guide, $id)
    {
        // 1. 一次性取出所有子内容
        $allChildren = DB::table('guide_content')
            ->where('system_id', 3)
            ->where('company_id', 0)
            ->where('pid', $id)
            ->where('is_show', 0)
            ->orderBy('displayorders', 'asc')
            ->get();
    
        $bigChildren  = $allChildren->where('type', 1);
        $smallByTopId = $allChildren->where('type', 0)->groupBy('top_id'); // 按 top_id 分组
    
        // 2. 颜色缓存
        $colors = Cache::remember('diycountry_colors_100', 86400, function () {
            return DB::connection('shop_db')
                ->table('centralize_diycountry_content')
                ->where('pid', 12)
                ->inRandomOrder()
                ->limit(100)
                ->get()
                ->toArray();
        });
    
        $colorIndex = 0;
        $colorTotal = count($colors);
    
        foreach ($bigChildren as $big) {
            $big->link2 = $this->getAppLink($big->go_other, (array)$big, 'guide');
    
            // 正确合并：专属小类 + 公共小类（top_id = 0）
            $ownSmall    = $smallByTopId->get($big->id, collect());  // 可能是空 Collection
            $publicSmall = $smallByTopId->get(0, collect());
    
            // 合并后打乱顺序 + 限制数量
            $smlChildren = $ownSmall->merge($publicSmall)->shuffle()->take(is_mobile2() ? 8 : 12);
    
            foreach ($smlChildren as $s) {
                $color = $colors[$colorIndex % $colorTotal];
                $colorIndex++;
    
                $s->rand_background = sprintf("#%02x%02x%02x", $color->param1, $color->param2, $color->param3);
                $s->name  = mb_substr($s->name, 0, 2, 'UTF-8');
                $s->name2 = mb_substr($s->name, 2, null, 'UTF-8');
                $s->link2 = $this->getAppLink($s->go_other, (array)$s, 'guide');
            }
    
            $big->sml_children = $smlChildren->chunk(4)->toArray();
        }
    
        $guide['big_children'] = objtoarr($bigChildren->values());
    
        return $guide;
    }
    
    public function guide_page2(Request $request)
    {
        $dat = $request->except(['_token']);
        $id = $dat['id'];

        $data['guide'] = Db::table('guide_body')->where(['id'=>$id])->first();
        $data['guide'] = objtoarr($data['guide']);

        #导页样式
        $data['guide']['content_info'] = Db::table('guide_format')->where(['id' => $data['guide']['content_id']])->first();
        $data['guide']['content_info'] = objtoarr($data['guide']['content_info']);
        if ($data['guide']['content_info']['type'] == 7) {
            #平台推荐版式

            $shelf_info = Db::table('goods_shelf')->whereRaw('type=2 and guide_id='.$id.' and keywords <> ""')->get();
            $shelf_info = objtoarr($shelf_info);

            $data['guide']['company_info'] = [];

            if (!empty($shelf_info)) {
                #有企业商品上架信息
                foreach ($shelf_info as $k2=>$v2) {
                    $arr1 = explode('、', $v2['keywords']);
                    $arr2 = explode('、', $data['guide']['gkeywords']);

                    $intersection = array_intersect($arr1, $arr2);#找关键字交集
                    if (!empty($intersection)) {
                        $data['guide']['goods_info'][$k2] = Db::table('goods')->where(['goods_id'=>$v2['gid'],'goods_status'=>1])->first();
                        $data['guide']['goods_info'][$k2] = objtoarr($data['guide']['goods_info'][$k2]);

                        if (!empty($data['guide']['goods_info'][$k2])) {
                            #企业
                            $company_info = Db::connection('shop_db')->table('website_user_company')->where(['id'=>$v2['cid']])->first();
                            $company_info = objtoarr($company_info);
                            $found = false;
                            if (empty($data['guide']['company_info'])) {
                                $found = true;
                            } else {
                                foreach ($data['guide']['company_info'] as $subArray) {
                                    if (!in_array($company_info['company'], $subArray)) {
                                        $found = true;
                                        break;
                                    }
                                }
                            }
                            if ($found) {
                                array_push($data['guide']['company_info'], $company_info);
                            }

                            #商品
                            $data['guide']['goods_info'][$k2]['company'] = $company_info['company'];
                            $data['guide']['goods_info'][$k2]['goods_currency'] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$data['guide']['goods_info']['goods_currency']])->first()->currency_symbol_standard;
                            $sku_info = objtoarr($sku_info);
                            $sku_info['sku_prices'] = json_decode($sku_info['sku_prices'], true);
                            $data['guide']['goods_info'][$k2]['price'] = number_format(end($sku_info['sku_prices']['price']), 2);
                        } else {
                            unset($data['guide']['goods_info'][$k2]);
                        }
                    }
                }
            }

            #板块关键字
            if (!empty($data['guide']['gkeywords'])) {
                $arr2 = explode('、', $data['guide']['gkeywords']);
                foreach ($arr2 as $k2 => $v2) {
                    if (!empty($v2)) {
                        #获取关键字id
                        $keys = Db::table('goods_keywords')->where(['keywords'=>$v2])->first();
                        $keys = objtoarr($keys);

                        #获取关键字商品
                        $keys_goods = Db::table('goods')->where(['keywords_id'=>$keys['id'],'goods_status'=>1])->get();
                        $keys_goods = objtoarr($keys_goods);

                        #商品
                        foreach ($keys_goods as $k3=>$v3) {
                            $keys_goods[$k3]['company'] = 'Gogo';
                            $keys_goods[$k3]['goods_currency'] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$v3['goods_currency']])->first()->currency_symbol_standard;
                            $sku_info = Db::table('goods_sku')->where(['sku_id'=>$v3['sku_id']])->first();
                            $sku_info = objtoarr($sku_info);
                            $sku_info['sku_prices'] = json_decode($sku_info['sku_prices'], true);
                            $keys_goods[$k3]['price'] = number_format(end($sku_info['sku_prices']['price']), 2);
                        }
                        if (isset($data['guide']['goods_info'])) {
                            $data['guide']['goods_info'] = array_merge($data['guide']['goods_info'], $keys_goods);
                        } else {
                            $data['guide']['goods_info'] = $keys_goods;
                        }
                    }
                }
            }

            #打乱所有企业商品排序
            if (!empty($data['guide']['goods_info'])) {
                shuffle($data['guide']['goods_info']);
            }
        } 
        elseif ($data['guide']['content_info']['type'] == 8) {
            #产业集聚版式
            $data['guide']['big_children'] = Db::table('guide_content')->where(['system_id'=>3,'company_id'=>0,'pid'=>$data['guide']['id'],'is_show'=>0,'type'=>1])->orderBy('displayorders', 'asc')->inRandomOrder()->get();
            $data['guide']['big_children'] = objtoarr($data['guide']['big_children']);
            foreach ($data['guide']['big_children'] as $k2=>$v2) {
                $data['guide']['big_children'][$k2]['link2'] = $this->getAppLink($v2['go_other'], $v2, 'guide');
                $data['guide']['big_children'][$k2]['sml_children'] = Db::table('guide_content')->where(['system_id'=>3,'company_id'=>0,'pid'=>$data['guide']['id'],'top_id'=>$v2['id'],'is_show'=>0,'type'=>0])->inRandomOrder()->get();
                $data['guide']['big_children'][$k2]['sml_children'] = objtoarr($data['guide']['big_children'][$k2]['sml_children']);
                if (is_mobile2()) {
                    $data['guide']['big_children'][$k2]['sml_children'] = array_chunk($data['guide']['big_children'][$k2]['sml_children'], 4);
                } else {
                    $data['guide']['big_children'][$k2]['sml_children'] = array_chunk($data['guide']['big_children'][$k2]['sml_children'], 4);
                }
                foreach ($data['guide']['big_children'][$k2]['sml_children'] as $k3=>$v3) {
                    foreach ($v3 as $k4=>$v4) {
                        $color = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['pid'=>12])->inRandomOrder()->first();
                        $color = objtoarr($color);
                        $data['guide']['big_children'][$k2]['sml_children'][$k3][$k4]['rand_background'] = sprintf("#%02x%02x%02x", $color['param1'], $color['param2'], $color['param3']);
                        $data['guide']['big_children'][$k2]['sml_children'][$k3][$k4]['name'] = mb_substr($v4['name'], 0, 2, 'UTF-8');
                        $data['guide']['big_children'][$k2]['sml_children'][$k3][$k4]['name2'] = mb_substr($v4['name'], 2, mb_strlen($v4['name'], 'UTF-8'), 'UTF-8');
                        $data['guide']['big_children'][$k2]['sml_children'][$k3][$k4]['link2'] = $this->getAppLink($v4['go_other'], $v4, 'guide');
                    }
                }
            }
        } 
        elseif ($data['guide']['content_info']['type'] == 9) {
            #环球节庆版式
            $data['guide']['children'] = Db::connection('shop_db')->table('website_festival')->whereRaw('date >= DATE_SUB(CURDATE(), INTERVAL 1 DAY) and date <= DATE_ADD(CURDATE(), INTERVAL 15 DAY)')->inRandomOrder()->get();
            $data['guide']['children'] = addCountryPic(objtoarr($data['guide']['children']));
            $data['guide']['children'] = array_filter($data['guide']['children'], function ($item) {
                return !isset($item['is_deplicate']);
            });
            sort($data['guide']['children']);
            shuffle($data['guide']['children']);

            if (is_mobile2()) {
                $data['guide']['children'] = array_chunk($data['guide']['children'], 1);
            } else {
                $data['guide']['children'] = array_chunk($data['guide']['children'], 6);
            }

            foreach ($data['guide']['children'] as $k2=>$v2) {
                if (is_mobile2()) {
                    $data['guide']['children'][$k2] = array_chunk($v2, 1);
                } else {
                    $data['guide']['children'][$k2] = array_chunk($v2, 3);
                }
            }
        }

        $website = get_website();
        #当前页面的链接
        $origin_page = '/login.html?open=4&param2='.base64_encode('/guide_page?id='.$id);

        return view('home.guide_page', compact('id', 'data', 'website', 'origin_page'));
    }

    #搜索信息
    public function search_info(Request $request)
    {
        $data = $request->except(['__token']);
        $title = trim($data['title']);

        if (!empty($title)) {
            $list = Db::table('goods')->whereRaw('goods_name like "%'.$title.'%"')->get();
            $list = objtoarr($list);

            if (empty($list)) {
                $list = Db::table('goods')->where(['other_goods_link'=>$title])->first();
                $list = objtoarr($list);

                if (empty($list)) {
                    $new_goods = httpRequest2('https://shop.gogo198.cn/collect_website/public/?s=api/getgoods/detail_query', json_encode(['type'=>2,'goodsLink'=>$title], true), ['Content-Type: application/json']);
                    $new_goods = json_decode($new_goods, true);

                    if ($new_goods['code']==-1) {
                        return Response()->json(['code'=>-1,'msg'=>'没有找到此商品，请联系客服进行处理']);
                    } elseif ($new_goods['code']==0) {
                        $res = $this->get_goods($new_goods);
                        if ($res['code']==-1) {
                            return Response()->json(['code'=>-1,'msg'=>$res['msg']]);
                        } elseif ($res['code']==0) {
                            return Response()->json(['code'=>0,'msg'=>$res['msg'],'href'=>'/goods-'.$res['id'].'.html']);
                        }
                    }
                } else {
                    return Response()->json(['code'=>0,'href'=>'/goods-'.$list['goods_id'].'.html']);
                }
            } else {
                return Response()->json(['code'=>0,'href'=>'/goods_list?cate_name='.$title]);
            }
        } else {
            return Response()->json(['code'=>-1,'msg'=>'请填写需要查询的内容']);
        }
    }

    public function get_goods($new_goods)
    {
        $time = time();
        $date = date('Y-m-d H:i:s');
        #查看商品的计量单位

        if (isset($new_goods['data']['repositoryInfo']['quantityText'])) {
            $quantityText = trim(mb_substr($new_goods['data']['repositoryInfo']['quantityText'], -1));
            $unit = Db::connection('shop_db')->table('unit')->where(['code_name' => $quantityText])->first()->code_value;
            if (empty($unit)) {
                $unit = '011';
            }
        } else {
            $unit = '011';
        }
        if ($new_goods['code']==0 && isset($new_goods['data']['goodsDetailHtml'])) {
            try {
                #获取商品分类==START
                $last_catId = ['cat_id'=>0,'parent_id'=>0];
                $cat_id1 = 0;#一级
                $cat_id = 0;#最后一级
                $cat_id2 = 0;#最后一级

                if (isset($new_goods['data']['goodsCatName'])) {
                    $last_catId = Db::table('category')->where(['cat_name' => $new_goods['data']['goodsCatName']])->first();
                    $last_catId = objtoarr($last_catId);
                    if (!empty($last_catId)) {
                        #自己的分类表有
                        $cat_id = intval($last_catId['cat_id']);
                        $cat_id2 = intval($last_catId['cat_id']);#最后一级
                        #获取第一级
                        $first_catId = Db::table('category')->where(['cat_id' => $last_catId['parent_id']])->first();
                        $first_catId = objtoarr($first_catId);
                        if ($first_catId['parent_id'] > 0) {
                            $first_catId = Db::table('category')->where(['cat_id' => $first_catId['parent_id']])->first();
                            $first_catId = objtoarr($first_catId);
                            if ($first_catId['parent_id'] > 0) {
                                $first_catId = Db::table('category')->where(['cat_id' => $first_catId['parent_id']])->first();
                                $first_catId = objtoarr($first_catId);
                                $cat_id1 = $first_catId['cat_id'];
                            } else {
                                $cat_id1 = $first_catId['cat_id'];
                            }
                        }
                    } else {
                        #查询其他平台的分类表，并获取名称判断原分类表有无，无的话就插入/有的话就->获取分类ID
                        $last_catId = Db::table('category_backydrop')->where(['name' => $new_goods['data']['goodsCatName']])->first();
                        $last_catId = objtoarr($last_catId);
                        if (!empty($last_catId)) {
                            #搜索其他平台的分类表，找到三级分类后插入原分类表，并依次获取分类id

                            #获取第二级
                            $ishave2 = Db::table('category_backydrop')->where(['id' => $last_catId['pid']])->first();
                            $ishave2 = objtoarr($ishave2);
                            if ($ishave2['pid']>0) {
                                #获取第一级
                                $ishave1 = Db::table('category_backydrop')->where(['id' => $ishave2['pid']])->first();
                                $ishave1 = objtoarr($ishave1);
                                if ($ishave1['id']>0) {
                                    #开始插入原分类表
                                    $ishave_name = Db::table('category')->where(['cat_name'=>$ishave1['name']])->first();
                                    $ishave_name = objtoarr($ishave_name);

                                    #第一级
                                    if (empty($ishave_name['cat_id'])) {
                                        $cat_id1 = Db::table('category')->insertGetId([
                                            'cat_name'=>$ishave1['name'],
                                            'type_id'=>1,
                                            'parent_id'=>0,
                                            'cat_level'=>1,
                                            'is_parent'=>1,
                                            'is_show'=>1,
                                            'created_at'=>$date
                                        ]);
                                    } else {
                                        $cat_id1 = $ishave_name['cat_id'];
                                    }

                                    #第二级
                                    $cat2_id = Db::table('category')->insertGetId([
                                        'cat_name'=>$ishave2['name'],
                                        'type_id'=>1,
                                        'parent_id'=>$cat_id1,
                                        'cat_level'=>2,
                                        'is_parent'=>1,
                                        'is_show'=>1,
                                        'created_at'=>$date
                                    ]);

                                    #第三级
                                    $cat_id = Db::table('category')->insertGetId([
                                        'cat_name'=>$last_catId['name'],
                                        'type_id'=>1,
                                        'parent_id'=>$cat2_id,
                                        'cat_level'=>3,
                                        'is_parent'=>0,
                                        'is_show'=>1,
                                        'created_at'=>$date
                                    ]);
                                    $cat_id2 = $cat_id;
                                }
                            }
                        }
                    }
                }
                #获取商品分类====END

                #导页卡片ID（废弃）===START
                $frame_id=0;
                #导页卡片ID===END

                #是否包邮和运费
                $is_domestic_baoyou = 1;
                $goods_freight_fee = 0;
                if (isset($new_goods['data']['freight'])) {
                    if ($new_goods['data']['freight']['price']>0) {
                        $is_domestic_baoyou = 2;
                        $goods_freight_fee = $new_goods['data']['freight']['price'];
                    }
                }
                $good_id = Db::table('goods')->insertGetId([
                    'goods_name' => $new_goods['data']['goodsName'],
                    'shop_id' => 0,
                    'other_goods_id' => $new_goods['data']['goodsId'],
                    'other_spuCode' => $new_goods['data']['spuCode'],
                    'other_goods_link' => $new_goods['data']['goodsLink'],
                    'other_shop' => json_encode($new_goods['data']['shop'], true),
                    'other_platform' => $new_goods['data']['platform'],
                    'cat_id' => $cat_id,
                    'cat_id1' => $cat_id1,
                    'cat_id2' => $cat_id2,
                    'keywords_id'=>0,
                    'guide_type'=>0,#废弃
                    'hotsearch_id'=>$frame_id,#废弃
                    'pc_desc' => $new_goods['data']['goodsDetailHtml'],
                    'goods_mode' => 0,
                    'brand_type' => 0,#空牌
                    'goods_status' => 1,
                    'click_count'=>mt_rand(111, 9999),
                    'star_count'=>mt_rand(111, 9999),
                    'share_count'=>mt_rand(111, 9999),
                    'created_at' => $date,
                    'sku_id' => 0,#（在下方插入规格id）
                    'goods_subname' => $new_goods['data']['goodsName'],
                    'goods_price' => $new_goods['data']['proPrice']['price'],
                    'market_price' => $new_goods['data']['proPrice']['price'],
                    'cost_price' => $new_goods['data']['proPrice']['price'],
                    'goods_number' => isset($new_goods['data']['repositoryInfo']['quantity']) ? $new_goods['data']['repositoryInfo']['quantity'] : 2000,
                    'goods_image' => $new_goods['data']['picUrl'],
                    'keywords' => $new_goods['data']['goodsName'],
                    'goods_audit' => 1,
                    'contract_ids' => 'a:4:{i:1;s:1:"0";i:2;s:1:"0";i:3;s:1:"0";i:5;s:1:"0";}',
                    'add_time' => $time,
                    'goods_freight_fee'=>$goods_freight_fee,
                    'domestic_baoyou'=>$is_domestic_baoyou,
                    'goods_moq' => 1,
                    'other_attrs' => serialize([
                        'value_name0' => '', 'value_desc0' => '',
                    ]),#(接口/爬虫商品不需要填写这个)
                    'updated_at' => $date,
                ]);

                $have_specs = 1;
                if (empty($new_goods['data']['productProps'])) {
                    #无规格
                    $goodsSkuInsert = [
                        'goods_id' => $good_id,
                        'market_price' => $new_goods['data']['proPrice']['price'],
                        'goods_price' => $new_goods['data']['proPrice']['price'],
                        'goods_number' => isset($new_goods['data']['repositoryInfo']['quantity']) ? $new_goods['data']['repositoryInfo']['quantity'] : 2000,
                        'warn_number' => 0,
                        'goods_sn' => $new_goods['data']['spuCode'],
                        'goods_barcode' => '',
                        'goods_stockcode' => '',
                        'is_spu' => 1, // 无规格商品 是SPU商品
                        'sku_prices' => json_encode([
                            'goods_number' => isset($new_goods['data']['repositoryInfo']['quantity']) ? $new_goods['data']['repositoryInfo']['quantity'] : 2000,
                            'start_num' => [1],
                            'unit' => [$unit],
                            'select_end' => [1],
                            'end_num' => [isset($new_goods['data']['repositoryInfo']['quantity']) ? $new_goods['data']['repositoryInfo']['quantity'] : 2000],
                            'currency' => [5],
                            'price' => [$new_goods['data']['proPrice']['price']],
                        ], true),#该规格的区间价格
                        'created_at' => $date,
                        'updated_at' => $date,
                    ];
                    Db::table('goods_sku')->insert($goodsSkuInsert);
                    Db::table('goods')->where(['goods_id'=>$good_id])->update([
                        'nospecs'=>json_encode([
                            'goods_number' => [isset($new_goods['data']['repositoryInfo']['quantity']) ? $new_goods['data']['repositoryInfo']['quantity'] : 2000],
                            'start_num' => [1],
                            'unit' => [$unit],
                            'select_end' => [1],
                            'end_num' => [isset($new_goods['data']['repositoryInfo']['quantity']) ? $new_goods['data']['repositoryInfo']['quantity'] : 2000],
                            'currency' => [5],
                            'price' => [$new_goods['data']['proPrice']['price']],
                        ], true)
                    ]);
                    $have_specs = 2;
                } else {
                    #有规格

                    #1、插入或查看有无该属性
                    foreach ($new_goods['data']['productProps'] as $gsKey => $item) {
                        $ishave = Db::table('attribute')->where(['attr_name' => $item['propName']])->first();
                        $ishave = objtoarr($ishave);
                        if (empty($ishave['attr_id'])) {
                            $new_goods['data']['productProps'][$gsKey]['attr_id'] = Db::table('attribute')->insertGetId([
                                'attr_name' => $item['propName'],
                                'is_spec' => 1,
                                'created_at' => $date,
                                'updated_at' => $date,
                            ]);
                        } else {
                            $new_goods['data']['productProps'][$gsKey]['attr_id'] = $ishave['attr_id'];
                        }

                        #1.1、插入子属性
                        $ishave2 = Db::table('attr_value')->where(['attr_vname' => $item['valueName'], 'attr_id' => $new_goods['data']['productProps'][$gsKey]['attr_id']])->first();
                        $ishave2 = objtoarr($ishave2);
                        if (empty($ishave2['attr_vid'])) {
                            $new_goods['data']['productProps'][$gsKey]['attr_vid'] = Db::table('attr_value')->insertGetId([
                                'attr_id' => $new_goods['data']['productProps'][$gsKey]['attr_id'],
                                'attr_vname' => $item['valueName'],
                                'attr_vsort' => $gsKey + 1,
                                'created_at' => $date,
                                'updated_at' => $date,
                            ]);
                        } else {
                            $new_goods['data']['productProps'][$gsKey]['attr_vid'] = $ishave2['attr_vid'];
                        }
                    }

                    #2、插入商品规格类别表
                    foreach ($new_goods['data']['productProps'] as $gsKey => $item) {
                        $goodsSpecInsert = [
                            'goods_id' => $good_id,
                            'attr_id' => $item['attr_id'],
                            'attr_vid' => $item['attr_vid'],
                            'cat_id' => $cat_id,
                            'attr_value' => $item['valueName'],
                            'attr_desc' => '',
                            'is_checked' => 1,
                            'spec_sort' => $gsKey,
                            'created_at' => $date,
                            'updated_at' => $date,
                        ];
                        Db::table('goods_spec')->insert($goodsSpecInsert);
                    }

                    #3、插入规格表
                    foreach ($new_goods['data']['skuList'] as $k2 => $v2) {
                        $spec_ids = [];#大规格
                        $spec_vids = [];#子规格
                        $spec_names = [];#大规格名称：子规格名称
                        foreach ($v2['props'] as $k3 => $v3) {
                            $spec_ids_arr = Db::table('attribute')->where(['attr_name' => $v3['propName']])->first()->attr_id;
                            $spec_ids = array_merge($spec_ids, [$spec_ids_arr]);


                            $spec_vids_arr = Db::table('attr_value')->where(['attr_vname' => $v3['valueName'],'attr_id'=>$spec_ids_arr])->first()->attr_vid;
                            $spec_vids = array_merge($spec_vids, [$spec_vids_arr]);

                            $spec_names = array_merge($spec_names, [$v3['propName'] . ':' . $v3['valueName']]);
                        }
                        $skuList = [
                            'goods_id' => $good_id,
                            'sku_images'=>$v2['imgUrl'],
                            'spec_ids' => implode('|', $spec_ids),
                            'spec_vids' => implode('|', $spec_vids),
                            'spec_names' => implode(' ', $spec_names),
                            'sku_specs' => implode('*', $spec_vids),
                            'goods_price' => $v2['price']['price'],
                            'market_price' => $v2['price']['price'],
                            'goods_number' => $v2['quantity'],
                            'goods_sn' => $v2['skuCode'],
                            'is_spu' => 0,// 商品有规格 不是SPU商品
                            'sku_prices' => json_encode([
                                'goods_number' => $v2['quantity'],
                                'disabled_num' => 0,#0在售
                                'start_num' => [1],
                                'unit' => [$unit],
                                'select_end' => [1],#1数值，2以上
                                'end_num' => [$v2['quantity']],
                                'currency' => [5],
                                'price' => [$v2['price']['price']]
                            ], true),
                            'created_at' => $date,
                            'updated_at' => $date,
                        ];

                        Db::table('goods_sku')->insert($skuList);
                    }
                }

                #4、设置商品的默认sku_id
                $default_sku_id = Db::table('goods_sku')->where(['goods_id' => $good_id, 'checked' => 1])->orderBy('sku_id', 'asc')->first()->sku_id;
                // 更新商品表 sku_id 为goods_sku 第一个
                Db::table('goods')->where(['goods_id' => $good_id])->update(['sku_id' => $default_sku_id,'have_specs'=>$have_specs]);

                #5、插入商品图片表
                foreach ($new_goods['data']['mainItemImgs'] as $k2 => $v2) {
                    Db::table('goods_image')->insert([
                        'goods_id' => $good_id,
                        'spec_id' => 0,#商品规格类别表id，主要用作规格切换图片
                        'path' => $v2,
                        'is_default' => $k2 == 0 ? 1 : 0,
                        'sort' => $k2 + 1,
                        'created_at' => $date,
                        'updated_at' => $date,
                    ]);
                }

                #6、返回id给标签
                return ['code'=>0,'msg'=>'搜索成功','id'=>$good_id];
            } catch (Exception $e) {
                return ['code'=>-1,'msg'=>$e->getMessage()];
            }
        } else {
            return ['code'=>-1,'msg'=>'搜索失败，接口返回商品的详情信息为空值'];
        }
    }

    #记录用户行为
    public function user_record(Request $request)
    {
        $dat = $request->except(['_token']);
        $ip = $_SERVER['REMOTE_ADDR'];
        $user = $request->session()->get('user');
        $goods_id = isset($dat['goods_id']) ? intval($dat['goods_id']) : 0;
        $second = isset($dat['seconds']) ? intval($dat['seconds']) : 0;
        $type = intval($dat['type']);

        log_user_behavior(['type'=>$type,'ip'=>$ip,'user'=>$user,'goods_id'=>$goods_id,'second'=>$second]);
    }
    
    #成为买手
    public function become_buyer(Request $request){
        $dat = $request->except(['_token']);
        $user = session('user');
        $id = isset($dat['id'])?intval($dat['id']):0;
        
        if (empty($user)) {
            header('Location: /login.html?open=4&param2='.base64_encode('/become_buyer?id='.$id));
        }
        
        $website_user = Db::connection('shop_db')->table('website_user')->where(['custom_id'=>$user['gogo_id']])->first();
        $website_user = objtoarr($website_user);
        
        if ($request->isMethod('post')) {
            if(empty($id)){
                #申请成为买手
                $phone = '';$email = '';$verify_type = '';
                if($dat['type']==2 || $dat['type']==3){
                    if($dat['verify_type']==1){
                        $phone = trim($dat['phone']);
                        if(empty($phone)){
                            return Response()->json(['code'=>-1,'msg'=>'手机号码不能为空！']);
                        }
                    }elseif($dat['verify_type']==2){
                        $email = trim($dat['email']);
                        if(empty($email)){
                            return Response()->json(['code'=>-1,'msg'=>'邮箱号码不能为空！']);
                        }
                    }
                    $verify_type = $dat['verify_type'];
                }
                
                $time = time();
                $buyer_id = Db::connection('shop_db')->table('website_buyer')->insertGetId([
                    'uid'=>$website_user['id'],
                    'company_id'=>33,#默认钜铭企业买手
                    'type'=>$dat['type'],
                    'name'=>trim($dat['name']),
                    'api_address'=>$dat['type']==1?trim($dat['api_address']):'',
                    'is_verify'=>$dat['type']==1?1:0,
                    'is_apply'=>1,
                    'verify_type'=>$verify_type,
                    'phone'=>$phone,
                    'email'=>$email,
                    'createtime'=>$time
                ]);
                if($buyer_id){
                    #通知总后台
                    $system = Db::connection('shop_db')->table('centralize_system_notice')->where(['uid'=>0])->first();
                    $system = objtoarr($system);
                    if ($system['notice_type']==1) {
                        $post = json_encode([
                            'call' => 'confirmCollectionNotice',
                            'first' => '有用户申请成为买手，请进入总后台查看！',
                            'keyword1' => '有用户申请成为买手，请进入总后台查看！',
                            'keyword2' => '待审核',
                            'keyword3' => date('Y-m-d H:i:s', $time),
                            'remark' => '点击查看详情',
                            'url' => 'https://gadmin.gogo198.cn',
    //                    'url' => 'https://shopping.gogo198.cn/check_prescription?prescription_id='.$prescription_id,
                            'openid' => $system['account'],
                            'temp_id' => 'SVVs5OeD3FfsGwW0PEfYlZWetjScIT8kDxht5tlI1V8'
                        ]);
                        httpRequest('https://shop.gogo198.cn/api/sendwechattemplatenotice.php', $post);
                    }
                    
                    return Response()->json(['code'=>0,'msg'=>'已提交申请']);
                }
            }else{
                #平台邀请成为买手
                $buyer = Db::connection('shop_db')->table('website_buyer')->where(['id'=>$id])->first();
                $buyer = objtoarr($buyer);
                
                $res = Db::connection('shop_db')->table('website_buyer')->where(['id'=>$id])->update(['uid'=>$website_user['id'],'is_verify'=>1]);
                if($res){
                    return Response()->json(['code'=>0,'msg'=>'确认成为买手成功！']);
                }
                
                return Response()->json(['code'=>-1,'msg'=>'确认成为买手失败！']);
            }
        } else {
            if(empty($id)){
                #申请成为买手
                $info = Db::connection('shop_db')->table('website_buyer')->where(['uid'=>$website_user['id']])->first();
            }else{
                #平台邀请成为买手
                $info = Db::connection('shop_db')->table('website_buyer')->where(['id'=>$id])->first();
            }
            $info = objtoarr($info);
            
            if(!empty($info)){
                if($info['is_verify']==1){
                    header('Location: https://dtc.gogo198.net/?s=index/buyer_manage&company_id='.$info['company_id'].'&company_type=0&buyer_id='.$info['id']);
                }
            }
            
            return view('home.become_buyer',compact('id','info','website_user'));
        }
    }
    //新的首页-2024-05-08 end==============================================

    public function bonusPush(Request $request, $bonus_id)
    {
        $seo_title = sysconf('site_name');

        $bonusRep = new BonusRepository();
        $bonus_info = $bonusRep->getById($bonus_id);
        if (empty($bonus_info)) {
            return abort(404, '红包id无效');
        }

        $bonus_info->shop_name = Shop::where('shop_id', $bonus_info->shop_id)->value('shop_name');

        return view('home.bonus_push', compact('seo_title', 'bonus_info'));
    }

    public function bonusSuccess(Request $request, $bonus_id)
    {
        $seo_title = sysconf('site_name');

        $bonusRep = new BonusRepository();
        $bonus_info = $bonusRep->getById($bonus_id);

        if (empty($bonus_info)) {
            return abort(404, '红包id无效');
        }

        $bonus_info->user_name = $this->user['user_name'] ?? null;
        $bonus_info->shop_name = Shop::where('shop_id', $bonus_info->shop_id)->value('shop_name');

        return view('home.bonus_success', compact('seo_title', 'bonus_info'));
    }


    /**
     * 测试短信发送功能
     */
    public function send()
    {
        $connectApi = new ConnectApi();
        $ret = $connectApi->sendCaptcha('18669035369', 1);

//        $smsService = new SmsService();
//        $ret = $smsService->send('18669035369', '您的验证码为：6379，该验证码 5 分钟内有效，请勿泄漏于他人。');

        dd($ret);
    }

    public function collectGoods()
    {
        header('Content-type:text/html;charset=utf-8');
        $url = "https://detail.tmall.com/item.htm?id=578637124349&spm=875.7931836/B.2017077.6.6614426510Skct&scm=1007.12144.81309.73263_0&pvid=20e53276-e569-45a0-bfb2-b6c57d38ae79&utparam={%22x_hestia_source%22:%2273263%22,%22x_object_type%22:%22item%22,%22x_mt%22:8,%22x_src%22:%2273263%22,%22x_pos%22:5,%22x_pvid%22:%2220e53276-e569-45a0-bfb2-b6c57d38ae79%22,%22x_object_id%22:578637124349}";
//        $ql = QueryList::get($url)->encoding('utf-8', 'gbk');
//        $rt = [];
//        $rt['goods_name'] = $ql->find('.tb-detail-hd > h1')->texts();
//        $rt['goods_price'] = $ql->find('.tm-price-panel dd span')->texts();
//
//        dd($rt);

        $str = QueryList::get($url)
            ->encoding('utf-8', 'gbk')->getHtml();
        $preg = "/TShop.Setup\(*?\)/i";
        $start_str = <<<STR
TShop.Setup(
	  	
STR;
        $end_str = <<<STR
	  );
})()
STR;


        $preg = "/TShop.Setup\([\s\S]*?\}\)\(\)/i";
        preg_match($preg, $str, $matches);    //第四个参数中的3表示替换3次，默认是-1，替换全部
        $res = str_replace([$start_str, $end_str], '', $matches[0]);
        $goods_data = json_decode($res, true);
        var_export($goods_data);
        die;
        $rules = [
            'goods_name' => ['.tb-detail-hd > h1', 'text'],
            'goods_price' => ['tm-fcs-panel', 'html'],
            'tm_count' => ['.tm-count', 'text'],
            'images' =>['img', 'src'],
            'reg' => ['TShop.Setup', 'text']
        ];
        $data = QueryList::get($url)
            ->encoding('utf-8', 'gbk')
            ->rules($rules)->range('')->queryData();
        print_r($data);
        die;
    }
}
