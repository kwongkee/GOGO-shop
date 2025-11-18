<?php

// +----------------------------------------------------------------------
// | laravelvip 乐融沃B2B2C商城系统
// +----------------------------------------------------------------------
// | Copyright (c) 2017-2027 http://www.laravelvip.com All rights reserved.
// +----------------------------------------------------------------------
// | Notice: This code is not open source, it is strictly prohibited
// |         to distribute the copy, otherwise it will pursue its
// |         legal responsibility.
// +----------------------------------------------------------------------
// | 版权所有 2015-2027 云南乐融沃网络科技有限公司，并保留所有权利。
// | 网站地址: http://www.laravelvip.com
// +----------------------------------------------------------------------
// | 这不是一个自由软件！禁止拷贝本软件副本，否则将追究其法律责任！
// | 如需使用，请移步官网购买正版授权。
// +----------------------------------------------------------------------
// | Author: 雲溪荏苒 <290648237@qq.com>
// | Date:2018-08-17
// | Description: 首页控制器
// +----------------------------------------------------------------------

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

//header("Access-Control-Allow-Origin: https://boss.gogo198.cn");
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
//        require_once(base_path()."/vendor/tinify-php-master/lib/Tinify/Exception.php");
//        require_once(base_path()."/vendor/tinify-php-master/lib/Tinify/ResultMeta.php");
//        require_once(base_path()."/vendor/tinify-php-master/lib/Tinify/Result.php");
//        require_once(base_path()."/vendor/tinify-php-master/lib/Tinify/Source.php");
//        require_once(base_path()."/vendor/tinify-php-master/lib/Tinify/Client.php");
//        require_once(base_path()."/vendor/tinify-php-master/lib/Tinify.php");

        #更改节日为当前年份
//        $festival = Db::connection('shop_db')->table('website_festival')->get();
//        $festival = objtoarr($festival);
//        foreach($festival as $k=>$v){
//            Db::connection('shop_db')->table('website_festival')->where(['id'=>$v['id']])->update([
//                'date'=>str_replace('2024','2025',$v['date'])
//            ]);
//        }
//        echo 'success';exit;

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

        #口号
        $data['slogan'] = Db::connection('shop_db')->table('website_slogan')->where(['system_id'=>3])->orderBy('id', 'asc')->get();
        $data['slogan'] = objtoarr($data['slogan']);

        #轮播图
        $rotate = Db::connection('shop_db')->table('website_rotate')->where(['system_id'=>3])->get();
        $rotate = objtoarr($rotate);

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

        #站内信息
        $data['msg'] = Db::connection('shop_db')->table('website_message_manage')->get();
        $data['msg'] = objtoarr($data['msg']);

        #汇率
        $data['rate'] = Db::connection('shop_db')->table('website_exchange_rate')->whereRaw('id != 158 ')->get();
        $data['rate'] = objtoarr($data['rate']);

        #新闻列表
        $news = Db::connection('shop_db')->table('website_crossborder_news')->where(['time'=>date('Y-m-d')])->inRandomOrder()->limit(50)->get();
        if (count($news)==0) {
            $news = Db::connection('shop_db')->table('website_crossborder_news')->where(['status'=>1])->inRandomOrder()->limit(50)->get();
        }
        $news = objtoarr($news);

        #其他币种
        $currency = Db::connection('shop_db')->table('centralize_currency')->whereRaw('code_zhname <> "人民币元"')->get();
        $currency = objtoarr($currency);

        #世界城市
        $citys = Db::connection('shop_db')->table('website_world_time')->where(['is_show'=>0])->orderBy('displayorder', 'asc')->get()->groupBy('contryCn');
        $citys = objtoarr($citys);

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
//        foreach($discovery_rotate as $k=>$v){
//            if($v['go_other']==2){
//                #应用
//                $discovery_rotate[$k]['other_link'] = '/?s=main/guide_page&page_id='.$v['other_navbar'];
//            }
//            elseif($v['go_other']==3){
//                #图文
//                $discovery_rotate[$k]['other_link'] = '/?s=main/detail&page_id=0&type=pictxt&id='.$v['other_pic'];
//            }
//            elseif($v['go_other']==4){
//                #消息
//                $discovery_rotate[$k]['other_link'] = '/?s=main/detail&page_id=0&type=msg&id='.$v['other_msg'];
//            }
//        }

        #热卖商品
        $new_goods = Db::table('goods')->where(['goods_status'=>1])->orderBy('goods_id', 'desc')->first();
        $hotbuy = Db::table('goods')->whereRaw('goods_id<>'.$new_goods->goods_id.' and goods_status=1 and level_id=0')->orderBy('goods_id', 'desc')->limit(60)->get();
        $hotbuy = objtoarr($hotbuy);
        foreach ($hotbuy as $k2 => $v2) {
            #查询规格币种
            $have_sku_prices = Db::table('goods_sku')->where(['sku_id'=>$v2['sku_id']])->first();
            if (empty($have_sku_prices)) {
                continue;
            }
            $sku_prices = Db::table('goods_sku')->where(['sku_id'=>$v2['sku_id']])->first()->sku_prices;
            $sku_prices = json_decode($sku_prices, true);
            if ($v2['goods_price']==0) {
                $hotbuy[$k2]['goods_price'] = number_format(end($sku_prices['price']), 2);
            }
            $hotbuy[$k2]['currency'] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$sku_prices['currency'][0]])->first()->currency_symbol_standard;
            $imgs = Db::table('goods_image')->where(['goods_id'=>$v2['goods_id']])->get();
            $imgs = objtoarr($imgs);
            if (empty($imgs)) {
                $hotbuy[$k2]['mainItemImgs'] = [];
            } else {
                $hotbuy[$k2]['mainItemImgs'] = $imgs;
            }
        }

        #导页版式 START===========================================================
        $data['guide'] = Db::table('guide_body')->where(['company_id'=>0,'system_id'=>3])->orderBy('displayorders', 'asc')->get();
        $data['guide'] = objtoarr($data['guide']);
        foreach ($data['guide'] as $k=>$v) {
            #导页样式

            $data['guide'][$k]['content_info'] = Db::table('guide_format')->where(['id' => $v['content_id']])->first();
            $data['guide'][$k]['content_info'] = objtoarr($data['guide'][$k]['content_info']);
            if ($data['guide'][$k]['content_info']['type'] == 7) {
                #平台推荐版式

                #废弃
                if (1>2) {
                    if ($v['id']==14) {
                        #工厂直供
                        $data['guide'][$k]['company_info'] = Db::connection('shop_db')->table('website_user_company')->whereRaw('id>=22')->get();
                        $data['guide'][$k]['company_info'] = objtoarr($data['guide'][$k]['company_info']);

                        #合并所有企业的商品
                        $data['guide'][$k]['company_goods_info'] = [];
                        foreach ($data['guide'][$k]['company_info'] as $k2=>$v2) {
                            $data['guide'][$k]['company_info'][$k2]['goods_info'] = Db::table('goods')->whereRaw('shop_id='.$v2['id'].' and goods_status=1')->get();
                            if (!empty($data['guide'][$k]['company_info'][$k2]['goods_info'])) {
                                $data['guide'][$k]['company_info'][$k2]['goods_info'] = objtoarr($data['guide'][$k]['company_info'][$k2]['goods_info']);
                                foreach ($data['guide'][$k]['company_info'][$k2]['goods_info'] as $k3=>$v3) {
                                    $data['guide'][$k]['company_info'][$k2]['goods_info'][$k3]['company'] = $v2['company'];
                                    $data['guide'][$k]['company_info'][$k2]['goods_info'][$k3]['goods_currency'] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$data['guide'][$k]['company_info'][$k2]['goods_info'][$k3]['goods_currency']])->first()->currency_symbol_standard;
                                    $sku_info = Db::table('goods_sku')->where(['sku_id'=>$v3['sku_id']])->first();
                                    $sku_info = objtoarr($sku_info);
                                    $sku_info['sku_prices'] = json_decode($sku_info['sku_prices'], true);
                                    $data['guide'][$k]['company_info'][$k2]['goods_info'][$k3]['price'] = number_format(end($sku_info['sku_prices']['price']), 2);
                                }

                                $data['guide'][$k]['company_goods_info'] = array_merge($data['guide'][$k]['company_goods_info'], $data['guide'][$k]['company_info'][$k2]['goods_info']);
                            }
                        }
                        #打乱所有企业商品排序
                        shuffle($data['guide'][$k]['company_goods_info']);
                    }
                }

                $shelf_info = Db::table('goods_shelf')->whereRaw('type=2 and guide_id='.$v['id'].' and keywords <> ""')->get();
                $shelf_info = objtoarr($shelf_info);

                $data['guide'][$k]['company_info'] = [];
                if (!empty($shelf_info)) {
                    #有企业商品上架信息
                    foreach ($shelf_info as $k2=>$v2) {
                        $arr1 = explode('、', $v2['keywords']);
                        $arr2 = explode('、', $v['gkeywords']);

                        $intersection = array_intersect($arr1, $arr2);#找关键字交集
                        if (!empty($intersection)) {
                            $data['guide'][$k]['goods_info'][$k2] = Db::table('goods')->where(['goods_id'=>$v2['gid'],'goods_status'=>1])->first();
                            $data['guide'][$k]['goods_info'][$k2] = objtoarr($data['guide'][$k]['goods_info'][$k2]);

                            if (!empty($data['guide'][$k]['goods_info'][$k2])) {
                                #企业
                                $company_info = Db::connection('shop_db')->table('website_user_company')->where(['id'=>$v2['cid']])->first();
                                $company_info = objtoarr($company_info);
                                $found = false;
                                if (empty($data['guide'][$k]['company_info'])) {
                                    $found = true;
                                } else {
                                    foreach ($data['guide'][$k]['company_info'] as $subArray) {
                                        if (!in_array($company_info['company'], $subArray)) {
                                            $found = true;
                                            break;
                                        }
                                    }
                                }
                                if ($found) {
                                    array_push($data['guide'][$k]['company_info'], $company_info);
                                }

                                #商品
                                $data['guide'][$k]['goods_info'][$k2]['company'] = $company_info['company'];
                                $data['guide'][$k]['goods_info'][$k2]['goods_currency'] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$data['guide'][$k]['goods_info'][$k2]['goods_currency']])->first()->currency_symbol_standard;
                                $sku_info = Db::table('goods_sku')->where(['sku_id'=>$data['guide'][$k]['goods_info'][$k2]['sku_id']])->first();
                                $sku_info = objtoarr($sku_info);
                                $sku_info['sku_prices'] = json_decode($sku_info['sku_prices'], true);
                                $data['guide'][$k]['goods_info'][$k2]['price'] = number_format(end($sku_info['sku_prices']['price']), 2);
                            } else {
                                unset($data['guide'][$k]['goods_info'][$k2]);
                            }
                        }
                    }
                }

                #板块关键字
                if (!empty($v['gkeywords'])) {
                    $arr2 = explode('、', $v['gkeywords']);
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
                            if (isset($data['guide'][$k]['goods_info'])) {
                                $data['guide'][$k]['goods_info'] = array_merge($data['guide'][$k]['goods_info'], $keys_goods);
                            } else {
                                $data['guide'][$k]['goods_info'] = $keys_goods;
                            }
                        }
                    }
                }

                #打乱所有企业商品排序
                if (!empty($data['guide'][$k]['goods_info'])) {
                    shuffle($data['guide'][$k]['goods_info']);
                }
            } elseif ($data['guide'][$k]['content_info']['type'] == 8) {
                #产业集聚版式
                $data['guide'][$k]['big_children'] = Db::table('guide_content')->where(['system_id'=>3,'company_id'=>0,'pid'=>$v['id'],'is_show'=>0,'type'=>1])->inRandomOrder()->orderBy('displayorders', 'asc')->get();
                $data['guide'][$k]['big_children'] = objtoarr($data['guide'][$k]['big_children']);
                foreach ($data['guide'][$k]['big_children'] as $k2=>$v2) {
                    $data['guide'][$k]['big_children'][$k2]['link2'] = $this->getAppLink($v2['go_other'], $v2, 'guide');
                    $data['guide'][$k]['big_children'][$k2]['sml_children'] = Db::table('guide_content')->where(['system_id'=>3,'company_id'=>0,'pid'=>$v['id'],'top_id'=>$v2['id'],'is_show'=>0,'type'=>0])->inRandomOrder()->get();
                    $data['guide'][$k]['big_children'][$k2]['sml_children'] = objtoarr($data['guide'][$k]['big_children'][$k2]['sml_children']);
                    if (is_mobile2()) {
                        $data['guide'][$k]['big_children'][$k2]['sml_children'] = array_chunk($data['guide'][$k]['big_children'][$k2]['sml_children'], 4);
                    } else {
                        $data['guide'][$k]['big_children'][$k2]['sml_children'] = array_chunk($data['guide'][$k]['big_children'][$k2]['sml_children'], 4);
                    }
                    foreach ($data['guide'][$k]['big_children'][$k2]['sml_children'] as $k3=>$v3) {
                        foreach ($v3 as $k4=>$v4) {
                            $color = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['pid'=>12])->inRandomOrder()->first();
                            $color = objtoarr($color);
                            $data['guide'][$k]['big_children'][$k2]['sml_children'][$k3][$k4]['rand_background'] = sprintf("#%02x%02x%02x", $color['param1'], $color['param2'], $color['param3']);
                            $data['guide'][$k]['big_children'][$k2]['sml_children'][$k3][$k4]['name'] = mb_substr($v4['name'], 0, 2, 'UTF-8');
                            $data['guide'][$k]['big_children'][$k2]['sml_children'][$k3][$k4]['name2'] = mb_substr($v4['name'], 2, mb_strlen($v4['name'], 'UTF-8'), 'UTF-8');
                            $data['guide'][$k]['big_children'][$k2]['sml_children'][$k3][$k4]['link2'] = $this->getAppLink($v4['go_other'], $v4, 'guide');
                        }
                    }
                }
            } elseif ($data['guide'][$k]['content_info']['type'] == 9) {
                #环球节庆版式
                $data['guide'][$k]['children'] = Db::connection('shop_db')->table('website_festival')->whereRaw('date >= DATE_SUB(CURDATE(), INTERVAL 1 DAY) and date <= DATE_ADD(CURDATE(), INTERVAL 15 DAY)')->inRandomOrder()->get();
                $data['guide'][$k]['children'] = addCountryPic(objtoarr($data['guide'][$k]['children']));
                $data['guide'][$k]['children'] = array_filter($data['guide'][$k]['children'], function ($item) {
                    return !isset($item['is_deplicate']);
                });
                sort($data['guide'][$k]['children']);
                shuffle($data['guide'][$k]['children']);
                if (is_mobile2()) {
                    $data['guide'][$k]['children'] = array_chunk($data['guide'][$k]['children'], 1);
                } else {
                    $data['guide'][$k]['children'] = array_chunk($data['guide'][$k]['children'], 6);
                }
                foreach ($data['guide'][$k]['children'] as $k2=>$v2) {
                    if (is_mobile2()) {
                        $data['guide'][$k]['children'][$k2] = array_chunk($v2, 1);
                    } else {
                        $data['guide'][$k]['children'][$k2] = array_chunk($v2, 3);
                    }
                }
//                dd($data['guide'][$k]['children']);
            }
        }
//        dd($data['guide']);

        $compact = compact('page', 'tplHtml', 'navContainerHtml', 'nav_banner', 'webStatic', 'website', 'rotate', 'news', 'currency', 'data', 'citys', 'discovery_rotate', 'hotbuy', 'industry', 'festival');

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

    #备份首页
    public function home_backup2(Request $request)
    {
        if (is_app()) {
            $page = 'app';
        } elseif (is_mobile() || (request()->getHost() == env('MOBILE_DOMAIN'))) {
            $page = 'm_site';
        } else {
            $page = 'site';
        }

        // 获取首页焦点图
        $navBannerCondition = [
            'where' => [
                ['nav_page', $page],
                ['is_show', 1]
            ],
            'limit' => 5, // 只取5个
            'sortname' => 'banner_sort',
            'sortorder' => 'asc'
        ];
        list($nav_banner, $total) = $this->navBanner->getList($navBannerCondition);

        $template = $this->templateItem->getTplItems($page); // app端模板数据

        list($tplHtml, $navContainerHtml) = $this->templateItem->getPageTplHtml($page); // 模板Html数据

        // 判断首页静态页面开启状态
        $webStatic = (is_mobile() && !is_app()) ? sysconf('m_site_web_static') : sysconf('site_web_static');

        //按照销量排序查找商品(商品币种+最低的金额)
//        $goods_list = Db::table('goods')->whereRaw(' goods_audit=1 and goods_number!="" ')->orderBy('sale_num','desc')->get();
//        $goods_list = objtoarr($goods_list);
//        foreach($goods_list as $k=>$v){
//            $sku_info = Db::table('goods_sku')->where(['goods_id'=>$v['goods_id']])->get();
//            $sku_info = objtoarr($sku_info);
//            foreach($sku_info as $k2=>$v2){
//                $sku_info[$k2]['sku_prices'] = json_decode($v2['sku_prices'],true);
//                foreach($sku_info[$k2]['sku_prices']['unit'] as $k3=>$v3){
//                    $sku_info[$k2]['sku_prices']['currency'][$k3] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$sku_info[$k2]['sku_prices']['currency'][$k3]])->first()->currency_symbol_origin;
//                }
//            }
//            $goods_list[$k]['currency'] = $sku_info[0]['sku_prices']['currency'][0];
//            $goods_list[$k]['goods_price'] = $sku_info[0]['sku_prices']['price'][0];
//            foreach ($sku_info as $k2=>$v2){
//                foreach($v2['sku_prices']['price'] as $k3=>$v3){
//                    if($goods_list[$k]['goods_price']>$v3){
//                        $goods_list[$k]['goods_price'] = $v3;
//                    }
//                }
//            }
//        }

        #获取配置信息
        $website = get_website();

        #轮播图
        $rotate = Db::connection('shop_db')->table('website_rotate')->where(['system_id'=>3])->get();
        $rotate = objtoarr($rotate);
        foreach ($rotate as $k=>$v) {
            $rotate[$k]['link'] = $this->getAppLink($v['go_other'], $v, 'lunbo');
        }

        #搜索栏
        $search = Db::table('search_setting')->where(['id'=>1])->first();
        $search = objtoarr($search);

        #搜索栏
        $schFrame = Db::table('frame_body')->where(['pid'=>21])->orderBy('id', 'asc')->get();
        $schFrame = objtoarr($schFrame);

        #站内信息
        $data['msg'] = Db::connection('shop_db')->table('website_message_manage')->get();
        $data['msg'] = objtoarr($data['msg']);

        #流程信息
        $data['process'] = Db::connection('shop_db')->table('centralize_process_list')->where(['system_id'=>3,'pid'=>0])->get();
        $data['process'] = objtoarr($data['process']);
        $data['process'] = $this->getProcessChild($data['process']);

        #汇率
        $data['rate'] = Db::connection('shop_db')->table('website_exchange_rate')->whereRaw('id != 158 ')->get();
        $data['rate'] = objtoarr($data['rate']);

        #新闻列表
        $news = Db::connection('shop_db')->table('website_crossborder_news')->where(['time'=>date('Y-m-d')])->orderBy('id', 'desc')->get();
        if (count($news)==0) {
            $news = Db::connection('shop_db')->table('website_crossborder_news')->where(['status'=>1])->orderBy('id', 'desc')->get();
        }
        $news = objtoarr($news);

        #其他币种
        $currency = Db::connection('shop_db')->table('centralize_currency')->whereRaw('code_zhname <> "人民币元"')->get();
        $currency = objtoarr($currency);

        #世界城市
        $citys = Db::connection('shop_db')->table('website_world_time')->where(['is_show'=>0])->orderBy('displayorder', 'asc')->get()->groupBy('contryCn');
        $citys = objtoarr($citys);

        #访问量
        $yesterday_timestamp = strtotime("-1 day");
        $yesterday_startDate = strtotime(date("Y-m-d 00:00:00", $yesterday_timestamp));
        $yesterday_endDate = strtotime(date("Y-m-d 23:59:59", $yesterday_timestamp));
        $data['yesterday'] = Db::connection('shop_db')->table('system_log')->whereRaw('createtime>='.$yesterday_startDate.' and createtime<='.$yesterday_endDate)->count();
        $time = time();
        $month_startDate = strtotime(date("Y-m-1 00:00:00", $time));
        $month_endDate = strtotime(date("Y-m-30 23:59:59", $time));
        $data['this_month'] = Db::connection('shop_db')->table('system_log')->whereRaw('createtime>='.$month_startDate.' and createtime<='.$month_endDate)->count();

        #导页版式 START===========================================================
        $data['guide'] = Db::table('guide_body')->where(['company_id'=>0,'system_id'=>3])->orderBy('displayorders', 'asc')->get();
        $data['guide'] = objtoarr($data['guide']);
        $hotbuy = [];
        $hotbuy2 = [];
        $hotbuy4 = [];
        $hotbuy6 = [];
        foreach ($data['guide'] as $k=>$v) {
            #导页样式
            $content_info = Db::table('guide_format')->where(['id'=>$v['content_id']])->first();
            $content_info = objtoarr($content_info);
            if ($content_info['type']==1) {
                #商品板块展示
                if ($content_info['type2']==3) {
                    #商品类别
                    $hotbuy = Db::table('goods')->where(['cat_id'=>$v['gcateid'],'goods_status'=>1])->orderBy('goods_id', 'desc')->limit(60)->get();
                } elseif ($content_info['type2']==4) {
                    #商品关键字
                    $keywords = explode('、', $v['gkeywords']);
//                    $g_kw = [];
//                    foreach($keywords as $k2=>$v2){
//                        $g_kw[$k2]['list'] = Db::table('goods')->whereRaw('goods_status=1 and goods_name like %'.$v2.'%')->orderBy('goods_id','desc')->limit(60)->select(['goods_id'])->get();
//                        $g_kw[$k2]['list'] = objtoarr($g_kw[$k2]['list']);
//                    }
                    #todo 待做，混装、选择前60个.....
                    $hotbuy = Db::table('goods')->whereRaw('goods_status=1 and goods_name like %'.$keywords[0].'%')->orderBy('goods_id', 'desc')->limit(60)->get();
                } elseif ($content_info['type2']==9) {
                    $hotbuy = Db::table('goods')->where(['shop_id'=>0,'goods_status'=>1])->orderBy('goods_id', 'desc')->limit(60)->get();
                } else {
                    $hotbuy = Db::table('goods')->where(['shop_id'=>0,'goods_status'=>1])->orderBy('goods_id', 'desc')->limit(60)->get();
                }

                $hotbuy = objtoarr($hotbuy);

                foreach ($hotbuy as $k2 => $v2) {
                    $hotbuy[$k2]['mainItemImgs'] = Db::table('goods_image')->where(['goods_id'=>$v2['goods_id']])->get();
                    $hotbuy[$k2]['mainItemImgs'] = objtoarr($hotbuy[$k2]['mainItemImgs']);
                }

                $data['guide'][$k]['two_children'] = array_chunk($hotbuy, 2);
                $data['guide'][$k]['for_children'] = array_chunk($hotbuy, 4);
                $data['guide'][$k]['six_children'] = array_chunk($hotbuy, 6);
            } elseif ($content_info['type']==2) {
                #卡片展示【小卡片】
                $data['guide'][$k]['children'] = Db::table('guide_content')->where(['company_id'=>0,'pid'=>$v['id'],'is_show'=>0])->inRandomOrder()->get();
                $data['guide'][$k]['children'] = objtoarr($data['guide'][$k]['children']);
                foreach ($data['guide'][$k]['children'] as $k2=>$v2) {
                    $data['guide'][$k]['children'][$k2]['link2'] = $this->getAppLink($v2['go_other'], $v2, 'guide');
                }
                $data['guide'][$k]['children'] = array_chunk($data['guide'][$k]['children'], 9);
                foreach ($data['guide'][$k]['children'] as $k2=>$v2) {
                    $data['guide'][$k]['children'][$k2] = array_chunk($v2, 3);
                }
            } elseif ($content_info['type']==3) {
                #热议随定数组（待修改）
                $data['guide'][$k]['children'] = [
                    [
                        ['id'=>65,'name'=>'左秋','line'=>'新加坡专线','country'=>'新加坡','comment'=>'质量很好，希望更多的朋友信赖.','photo'=>['https://api-jiyun.beegoplus.com/storage/client-images202405/20240518RpX4dMPoKTw7cjKGaw8neE5vlRl4dFvcFj4K0Om9.jpg','https://api-jiyun.beegoplus.com/storage/client-images202405/20240518WBNcoIGlrryEAqJoJ53nuvS9HZjOyWjKyaDAE7yz.jpg'],'goods'=>['img'=>'https://img.alicdn.com/bao/uploaded/i3/1036215908/O1CN010Ll1u41tVusZkdYQJ_!!0-item_pic.jpg','name'=>'Orico/奥睿科 3.5英寸硬盘保护盒PP盒裸盘收纳盒台式硬盘盒收纳包','price'=>'9.99']],
                        ['id'=>66,'name'=>'柳絮泡泡','line'=>'澳大利亚专线','country'=>'澳大利亚','comment'=>'价格很优惠，服务也很好，东西不错，哈哈.','photo'=>['https://api-jiyun.beegoplus.com/storage/client-images202405/20240518PAqZIZFf4D4Rap1SbZBFpJKv9Nxy16pu9FZ7zVkM.jpg','https://api-jiyun.beegoplus.com/storage/client-images202405/20240518eqsFRO8J9Fns3oemlOiIsM217DNZ2WVP56wAD08D.jpg'],'goods'=>['img'=>'https://img.alicdn.com/bao/uploaded/i2/2215443471034/O1CN01UAwiMb1JVcTqvC6yl_!!0-item_pic.jpg','name'=>'NuPhy 雕刻的草原键帽PBT五面热升华机械键盘键帽定制117键小全套','price'=>'299.00']],
                        ['id'=>67,'name'=>'平定天下','line'=>'新加坡专线','country'=>'新加坡','comment'=>'终于拿到啦~~好开心那!.','photo'=>['https://api-jiyun.beegoplus.com/storage/client-images202405/20240518hOEebDmyvjPnvg11xX9fpVNU0sQ711ywIpM2F3or.jpg'],'goods'=>['img'=>'https://img.alicdn.com/bao/uploaded/i3/2208323902909/O1CN01YRJYlV1XMN6ZvTk05_!!0-item_pic.jpg','name'=>'适用iQOOZ9Turbo手机壳iQ00Z9x新款vivoiQOOZ9保护iQZ套iPOOZ爱酷外壳液态硅胶vivo全包','price'=>'9.80']],
                    ],
                    [
                        ['id'=>68,'name'=>'悟红尘','line'=>'新加坡专线','country'=>'新加坡','comment'=>'很好，非常满意!.','photo'=>['https://api-jiyun.beegoplus.com/storage/client-images202405/2024051876u5Y29DN4FrhZNreaj4BZLEfpSViTp6NmdJgoeK.jpg','https://api-jiyun.beegoplus.com/storage/client-images202405/2024051876u5Y29DN4FrhZNreaj4BZLEfpSViTp6NmdJgoeK.jpg'],'goods'=>['img'=>'https://img.alicdn.com/bao/uploaded/i1/3937219703/O1CN01yn2omY2LY1xQjDL0D_!!3937219703-0-C2M.jpg','name'=>'挂脖风扇懒人便携式学生迷你小型随身usb充电颈降温制冷空调手持户外夏天厨房无叶静音电风扇电扇续航大风力','price'=>'11.83']],
                        ['id'=>69,'name'=>'苍暮颜','line'=>'澳大利亚专线','country'=>'澳大利亚','comment'=>'价格很优惠，服务也很好，东西不错，哈哈.','photo'=>['https://api-jiyun.beegoplus.com/storage/client-images202405/20240518518vxugv6TBrok9m3tOaRVmTe97RNSaWwyvHZs7Y.jpg','https://api-jiyun.beegoplus.com/storage/client-images202405/20240518518vxugv6TBrok9m3tOaRVmTe97RNSaWwyvHZs7Y.jpg'],'goods'=>['img'=>'https://img.alicdn.com/bao/uploaded/i2/2207258548721/O1CN01h9V1CH2EIGyduVimm_!!0-item_pic.jpg','name'=>'五子棋子带磁性围棋棋盘儿童初学套装学生益智正品大人便携黑白棋','price'=>'23.80']],
                        ['id'=>70,'name'=>'kelly','line'=>'新加坡专线','country'=>'新加坡','comment'=>'期盼之中，终于等到了心爱的东东，谢谢!.','photo'=>['https://img2.baidu.com/it/u=3653930467,1219983717&fm=253&fmt=auto&app=138&f=JPEG?w=375&h=500','https://img2.baidu.com/it/u=3653930467,1219983717&fm=253&fmt=auto&app=138&f=JPEG?w=375&h=500'],'goods'=>['img'=>'https://img.alicdn.com/bao/uploaded/i2/2202560968849/O1CN01JiC8gA2FEtjl9XCJW_!!0-item_pic.jpg','name'=>'吕小军luxiaojun硬拉训练赤足鞋平底防滑家庭室内运动综合训练鞋','price'=>'199.00']],
                    ],
                ];
            } elseif ($content_info['type']==4) {
                #卡片展示【大卡片+小卡片】
                #大卡片
                $data['guide'][$k]['big_children'] = Db::table('guide_content')->where(['company_id'=>0,'pid'=>$v['id'],'is_show'=>0,'type'=>1])->orderBy('displayorders', 'asc')->get();
                $data['guide'][$k]['big_children'] = objtoarr($data['guide'][$k]['big_children']);
                foreach ($data['guide'][$k]['big_children'] as $k2=>$v2) {
                    $data['guide'][$k]['big_children'][$k2]['link2'] = $this->getAppLink($v2['go_other'], $v2, 'guide');
                }

                #小卡片
                $data['guide'][$k]['sml_children'] = Db::table('guide_content')->where(['pid'=>$v['id'],'is_show'=>0,'type'=>0])->inRandomOrder()->get();
                $data['guide'][$k]['sml_children'] = objtoarr($data['guide'][$k]['sml_children']);
                $data['guide'][$k]['sml_children'] = array_chunk($data['guide'][$k]['sml_children'], 4);
                foreach ($data['guide'][$k]['sml_children'] as $k2=>$v2) {
                    foreach ($v2 as $k3=>$v3) {
                        $data['guide'][$k]['sml_children'][$k2][$k3]['link2'] = $this->getAppLink($v3['go_other'], $v3, 'guide');
                    }
                }

                if (!empty($v['introduce'])) {
                    $data['guide'][$k]['introduce'] = json_decode($v['introduce'], true);
                }
            }
            #更多链接
            $data['guide'][$k]['link'] = $this->getAppLink(2, ['other_navbar'=>$v['more_id']]);
        }
//        dd($data['guide']);
        #导页版式 START===========================================================

        $compact = compact('page', 'tplHtml', 'navContainerHtml', 'nav_banner', 'webStatic', 'goods_list', 'website', 'rotate', 'schFrame', 'hotbuy2', 'hotbuy4', 'hotbuy6', 'news', 'currency', 'search', 'data', 'citys');

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
            #店铺链接
            return '/shop_detail?id='.isset($data['other_shop'])??$data['other_shop'];
        } elseif ($go==6) {
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

    #新闻详情
    public function news_detail(Request $request)
    {
        $dat = $request->except(['_token']);
        $foid = isset($dat['foid']) ? intval($dat['foid']) : 0;

        if ($request->isMethod('post')) {
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
            $news = Db::connection('shop_db')->table('website_crossborder_news')->where(['id'=>$dat['id']])->first();
            $news = objtoarr($news);
            $news['share_num'] = intval($news['share_num']);
            if (empty($news['like_num'])) {
                $news['like_num'] = rand(100, 999);
                Db::connection('shop_db')->table('website_crossborder_news')->where(['id'=>$dat['id']])->update(['like_num'=>$news['like_num']]);
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

            #随机码
            $rand = 0;
            #上一个新闻
            $prev_news = Db::connection('shop_db')->table('website_crossborder_news')->where('id', '<', $dat['id'])->orderBy('id', 'desc')->limit(1)->first();
            $prev_news = objtoarr($prev_news);
            #下一个新闻
            $next_news = Db::connection('shop_db')->table('website_crossborder_news')->where('id', '>', $dat['id'])->orderBy('id', 'asc')->limit(1)->first();
            $next_news = objtoarr($next_news);
            #所有评论
            $type=3;
            $all_comment = Db::connection('shop_db')->table('website_crossborder_news_chat')->where(['news_id'=>$dat['id'],'type'=>$type])->orderBy('id', 'desc')->get();
            $all_comment = objtoarr($all_comment);

            #是否有配置跳转其他应用
            $footerInfo = Db::table('footer_body')->where(['id'=>$foid])->first();
            $footerInfo = objtoarr($footerInfo);
            if (isset($footerInfo['have_link'])) {
                $footerInfo['link'] = $this->getAppLink(2, ['other_navbar'=>$footerInfo['content_id']]);
                $data['url'] = $footerInfo['link'];
            }

            return view('home.news_detail', compact('website', 'news', 'id', 'rand', 'data', 'prev_news', 'next_news', 'signPackage', 'all_comment', 'type', 'footerInfo'));
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
    public function guide_page(Request $request)
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
            #废弃
            if (1>2) {
                if ($data['guide']['id']==14) {
                    #工厂直供
                    $data['guide']['company_info'] = Db::connection('shop_db')->table('website_user_company')->whereRaw('id>=22')->get();
                    $data['guide']['company_info'] = objtoarr($data['guide']['company_info']);

                    #合并所有企业的商品
                    $data['guide']['company_goods_info'] = [];
                    foreach ($data['guide']['company_info'] as $k2=>$v2) {
                        $data['guide']['company_info'][$k2]['goods_info'] = Db::table('goods')->whereRaw('shop_id='.$v2['id'].' and goods_status=1')->get();
                        if (!empty($data['guide']['company_info'][$k2]['goods_info'])) {
                            $data['guide']['company_info'][$k2]['goods_info'] = objtoarr($data['guide']['company_info'][$k2]['goods_info']);
                            foreach ($data['guide']['company_info'][$k2]['goods_info'] as $k3=>$v3) {
                                $data['guide']['company_info'][$k2]['goods_info'][$k3]['company'] = $v2['company'];
                                $data['guide']['company_info'][$k2]['goods_info'][$k3]['goods_currency'] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$data['guide']['company_info'][$k2]['goods_info'][$k3]['goods_currency']])->first()->currency_symbol_standard;
                                $sku_info = Db::table('goods_sku')->where(['sku_id'=>$v3['sku_id']])->first();
                                $sku_info = objtoarr($sku_info);
                                $sku_info['sku_prices'] = json_decode($sku_info['sku_prices'], true);
                                $data['guide']['company_info'][$k2]['goods_info'][$k3]['price'] = number_format(end($sku_info['sku_prices']['price']), 2);
                            }

                            $data['guide']['company_goods_info'] = array_merge($data['guide']['company_goods_info'], $data['guide']['company_info'][$k2]['goods_info']);
                        }
                    }
                    #打乱所有企业商品排序
                    shuffle($data['guide']['company_goods_info']);
                }
            }

            $shelf_info = Db::table('goods_shelf')->whereRaw('type=2 and guide_id='.$id.' and keywords <> ""')->get();
            $shelf_info = objtoarr($shelf_info);

            $data['guide']['company_info'] = [];
            if (1>2) {
                foreach ($shelf_info as $k2=>$v2) {
                    $arr1 = explode('、', $v2['keywords']);
                    $arr2 = explode('、', $data['guide']['gkeywords']);

                    $intersection = array_intersect($arr1, $arr2);

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
                            $data['guide']['goods_info'][$k2]['goods_currency'] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$data['guide']['goods_info'][$k2]['goods_currency']])->first()->currency_symbol_standard;
                            $sku_info = Db::table('goods_sku')->where(['sku_id'=>$data['guide']['goods_info'][$k2]['sku_id']])->first();
                            $sku_info = objtoarr($sku_info);
                            $sku_info['sku_prices'] = json_decode($sku_info['sku_prices'], true);
                            $data['guide']['goods_info'][$k2]['price'] = number_format(end($sku_info['sku_prices']['price']), 2);
                        } else {
                            unset($data['guide']['goods_info'][$k2]);
                        }
                    }
                }
            }

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
        } elseif ($data['guide']['content_info']['type'] == 8) {
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
        } elseif ($data['guide']['content_info']['type'] == 9) {
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
    //新的首页-2024-05-08 end==============================================

    //旧的首页-2024-04-07
    public function home_backup(Request $request)
    {

//        if(session('user') == ''){
//            #从gogo网登录进来带uid
//            $uid = $request->get('uid');
//            if(!empty($uid)){
//                $custom = Db::connection('shop_db')->table('website_user')->where('id',$uid)->first();
//                $user = Db::table('user')->where(['gogo_id'=>$custom->custom_id])->first();
//                if(empty($user)){
//                    $user_id = Db::table('user')->insertGetId([
//                        'gogo_id'=>$custom->custom_id,
//                        'user_name'=>$custom->realname,
//                        'password'=>bcrypt('888888'),
//                        'mobile'=>$custom->phone,
//                        'email'=>$custom->email,
//                        'status'=>1,
//                        'shopping_status'=>1,
//                        'comment_status'=>1,
//                        'created_at'=>date('Y-m-d H:i:s')
//                    ]);
//                    sleep(1);
//                    $user = Db::table('user')->where(['user_id'=>$user_id])->first();
//                }
//                $user = objtoarr($user);
//                $request->session()->put('user', $user);
//            }
//        }

        if (is_app()) {
            $page = 'app';
        } elseif (is_mobile() || (request()->getHost() == env('MOBILE_DOMAIN'))) {
            $page = 'm_site';
        } else {
            $page = 'site';
        }

        // 获取首页焦点图
        $navBannerCondition = [
            'where' => [
                ['nav_page', $page],
                ['is_show', 1]
            ],
            'limit' => 5, // 只取5个
            'sortname' => 'banner_sort',
            'sortorder' => 'asc'
        ];
        list($nav_banner, $total) = $this->navBanner->getList($navBannerCondition);

//        $shopConfigRep = new ShopConfigRepository();
//        $shopConfigRep->createShopConfigData(1);

        $template = $this->templateItem->getTplItems($page); // app端模板数据

        list($tplHtml, $navContainerHtml) = $this->templateItem->getPageTplHtml($page); // 模板Html数据

        // 判断首页静态页面开启状态
        $webStatic = (is_mobile() && !is_app()) ? sysconf('m_site_web_static') : sysconf('site_web_static');

        //按照销量排序查找商品(商品币种+最低的金额)
        $goods_list = Db::table('goods')->whereRaw(' goods_audit=1 and goods_number!="" ')->orderBy('sale_num', 'desc')->get();
        $goods_list = objtoarr($goods_list);
        foreach ($goods_list as $k=>$v) {
            $sku_info = Db::table('goods_sku')->where(['goods_id'=>$v['goods_id']])->get();
            $sku_info = objtoarr($sku_info);
            foreach ($sku_info as $k2=>$v2) {
                $sku_info[$k2]['sku_prices'] = json_decode($v2['sku_prices'], true);
                foreach ($sku_info[$k2]['sku_prices']['unit'] as $k3=>$v3) {
                    $sku_info[$k2]['sku_prices']['currency'][$k3] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$sku_info[$k2]['sku_prices']['currency'][$k3]])->first()->currency_symbol_origin;
                }
            }
            $goods_list[$k]['currency'] = $sku_info[0]['sku_prices']['currency'][0];
            $goods_list[$k]['goods_price'] = $sku_info[0]['sku_prices']['price'][0];
            foreach ($sku_info as $k2=>$v2) {
                foreach ($v2['sku_prices']['price'] as $k3=>$v3) {
                    if ($goods_list[$k]['goods_price']>$v3) {
                        $goods_list[$k]['goods_price'] = $v3;
                    }
                }
            }
        }
//        dd($goods_list);

        $compact = compact('page', 'tplHtml', 'navContainerHtml', 'nav_banner', 'webStatic', 'goods_list');

        $this->show_seo('seo_index'); // SEO

//        $str = '';
//        $data = object_to_field_str($str);
//        dd($data);
//        dd(is_mobile());
        // 测试代码
//        dd(json_decode(sysconf('shipping_time'),true));
//        $user = new User();
//        var_dump($user->makeVisible('updated_at')->get()->toArray());die;


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
//        return view('home.home', $compact);
    }

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
