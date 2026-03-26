<?php
namespace App\Modules\Frontend\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Goods;
use App\Models\GoodsLayout;
use App\Models\GoodsSku;
use App\Models\GoodsUnit;
use App\Models\Shop;
use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\BonusRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\CollectRepository;
use App\Repositories\CompareRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\GoodsCommentRepository;
use App\Repositories\GoodsHistoryRepository;
use App\Repositories\GoodsRepository;
use App\Repositories\GoodsSkuRepository;
use App\Repositories\SelfPickupRepository;
use App\Repositories\ShopCategoryRepository;
use App\Repositories\ShopCreditRepository;
use App\Repositories\ShopRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Nexmo\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

header('Access-Control-Allow-Origin: *'); //设置http://www.baidu.com允许跨域访问
header('Access-Control-Allow-Headers: X-Requested-With,X_Requested_With'); //设置允许的跨域header

class GoodsController extends Frontend
{
    protected $goods; // 商品模型
    protected $category; // 商品分类模型
    protected $goodsHistory; // 商品浏览记录模型
    protected $collect;
    protected $selfPickup;

    protected $shopCategory;
    protected $shop;
    protected $compare;
    protected $goodsSku;
    protected $shopCredit;
    protected $customer;

    protected $bonus;

    protected $goodsComment; // 商品评价

    public function __construct()
    {
        parent::__construct();
        $this->goods = new GoodsRepository();
        $this->category = new CategoryRepository();
        $this->goodsHistory = new GoodsHistoryRepository();
        $this->shopCategory = new ShopCategoryRepository();
        $this->collect = new CollectRepository();
        $this->selfPickup = new SelfPickupRepository();
        $this->shop = new ShopRepository();
        $this->compare = new CompareRepository();
        $this->goodsSku = new GoodsSkuRepository();
        $this->shopCredit = new ShopCreditRepository();
        $this->customer = new CustomerRepository();

        $this->bonus = new BonusRepository();

        $this->goodsComment = new GoodsCommentRepository();
    }

    /**
     * 商品列表
     * 筛选条件
     *
     * @param Request $request
     * @param $filter_str
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function goodsList(Request $request, $filter_str)
    {
        $filter_param = explode('-', $filter_str);
        $cat_id = $request->get('cat_id', 0);

        if (empty($filter_param) && !$cat_id) {
            return redirect(route('pc_home'));
        }
        if (!$cat_id) {
            $cat_id = isset($filter_param[0]) ? (int)$filter_param[0] : 0; // 分类id
        }
        $p2 = isset($filter_param[1]) ? $filter_param[1] : 0; // 未知参数
        $p3 = isset($filter_param[2]) ? $filter_param[2] : 0; // 未知参数
        $is_platform = isset($filter_param[3]) ? $filter_param[3] : 0; // 平台自营
        $is_free_shipping = isset($filter_param[4]) ? $filter_param[4] : 0; // 包邮
        $is_offpay = isset($filter_param[5]) ? $filter_param[5] : 0; // 支持货到付款
        $has_goods_number = isset($filter_param[6]) ? $filter_param[6] : 0; // 仅显示有货
        $sort_field = isset($filter_param[7]) ? $filter_param[7] : 0; // 排序字段 综合/销量/新品/评论/价格/人气
        $sort_type = isset($filter_param[8]) ? $filter_param[8] : 4; // 排序方式 3-asc 4-desc
        $area_code = isset($filter_param[9]) ? $filter_param[9] : 0; // 地区code
        $display_model = isset($filter_param[10]) ? $filter_param[10] : 0; // 列表显示方式 0-大图模式 1-列表模式
        $brand_id = isset($filter_param[11]) ? $filter_param[11] : 0; // 品牌
        $min_price = isset($filter_param[12]) ? $filter_param[12] : 0; // 最小价格
        $max_price = isset($filter_param[13]) ? $filter_param[13] : 0; // 最大价格

        /*
         * 筛选条件
         *
         */
        $where = [];
        $where[] = ['goods_status',1]; // 商品状态 已发布
        $where[] = ['goods_audit',1]; // 审核通过
        // 搜索条件
       /* $search_arr = ['goods_barcode','keyword', 'cat_id','goods_status'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'goods_barcode') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }*/
        // 查询条件

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'goods_id',
            'sortorder' => 'desc'
        ];

        $cat_id_arr = [];
        $cat_brands = [];
        $hot_sale_goods = [];
        $new_goods = [];
        $sale_rank_goods = [];
        $goods_history = [];
        $goods_category = [];
        $navigate_cat = [];
        $navigate_cat_type = 0;

        if ($cat_id) {
            $cat_info = $this->category->getById($cat_id);
            $brand_ids = explode(',', $cat_info->brand_ids);
            $cat_brands = Brand::whereIn('brand_id', $brand_ids)->get();
            $cat_id_arr = get_cat_grandson($cat_id); // 获取该分类下的所有分类id
            $condition['in'] = [
                'field' => 'cat_id',
                'condition' => $cat_id_arr
            ];

            // 热卖商品
            $hot_sale_goods = $this->goods->getHotSaleGoods($cat_id_arr, 4);
            // 新品推荐
            $new_goods = $this->goods->getNewGoods($cat_id_arr, 4);
            // 销量排行榜
            $sale_rank_goods = $this->goods->getSaleRankGoods($cat_id_arr, 4);
            // 浏览历史
            list($goods_history, $goods_history_total) = $this->goods->getGoodsHistory($cat_id_arr, 6);

            // 商品分类列表
            $goods_category = Category::where('is_show', 1)->select(['cat_id','cat_name','parent_id', 'cat_level'])->orderBy('cat_sort', 'asc')->get();
            // 分类面包屑导航
            $navigate_cat = navigate_goods($cat_id);
            $navigate_cat_type = 0;

            $seo_info = [
                1 => $cat_info->title,
                2 => $cat_info->keywords,
                3 => $cat_info->discription,
            ];

            $this->show_seo($seo_info, ['name' => $cat_info->cat_name]); // SEO
        }


        list($goods_list, $goods_total) = $this->goods->getList($condition, '', $this->user_id);
        $pageHtml = frontend_pagination($goods_total);

        $pageArr = frontend_pagination($goods_total, true);
        $page_count = $pageArr['page_count'];
        $cur_page = $pageArr['cur_page'];
        $page_json = json_encode($pageArr);

//        dd($guess_like_goods);


        // 分类菜单显示 目前没有用到
//        $cur_cat_arr = $this->goods->getGoodsCat($cat_info); // 当前分类




        $compact = compact(
            'cat_info',
            'cat_brands',
            'cat_id',
            'goods_list',
            'goods_total',
            'pageHtml',
            'goods_category',
            'navigate_cat',
            'navigate_cat_type',
            'hot_sale_goods',
            'new_goods',
            'sale_rank_goods',
            'goods_history',
            'display_model',
            'page_count',
            'cur_page',
            'page_json'
        );


//        $this->show_seo($seo_info); // SEO

        return view('goods.goods_list', $compact);
    }

    /**
     * 商品列表
     * 多端共用一个方法
     *
     * @return array|\think\response\View
     */
    public function lists(Request $request, $filter_str='')
    {
        // 获取数据
        $params = $request->all();


        if (!empty($filter_str)) {
            $filter_param = explode('-', $filter_str);
//
            $params['cat_id'] = isset($filter_param[0]) ? (int)$filter_param[0] : 0; // 分类id
            $params['p2'] = isset($filter_param[1]) ? $filter_param[1] : 0; // 未知参数
            $params['p3'] = isset($filter_param[2]) ? $filter_param[2] : 0; // 未知参数
            $params['is_self'] = isset($filter_param[3]) ? $filter_param[3] : 0; // 平台自营
            $params['is_free'] = isset($filter_param[4]) ? $filter_param[4] : 0; // 包邮
            $params['is_cash'] = isset($filter_param[5]) ? $filter_param[5] : 0; // 支持货到付款
            $params['is_stock'] = isset($filter_param[6]) ? $filter_param[6] : 0; // 仅显示有货
            $params['sort'] = isset($filter_param[7]) ? $filter_param[7] : 0; // 排序字段 综合/销量/新品/评论/价格/人气
            $params['order'] = isset($filter_param[8]) ? $filter_param[8] : 4; // 排序方式 3-asc 4-desc
            $params['region'] = isset($filter_param[9]) ? $filter_param[9] : 0; // 地区code
            $params['style'] = isset($filter_param[10]) ? $filter_param[10] : 0; // 列表显示方式 0-大图模式 1-列表模式
            $params['brand_id'] = isset($filter_param[11]) ? $filter_param[11] : 0; // 品牌
            $params['price_min'] = isset($filter_param[12]) ? $filter_param[12] : 0; // 最小价格
            $params['price_max'] = isset($filter_param[13]) ? $filter_param[13] : 0; // 最大价格
            $params['keyword'] = isset($params['keyword']) ? $params['keyword'] : ''; // 关键词搜索
        }
//        $cat_id = $request->get('cat_id', 0);

//        if (empty($filter_param) && !$cat_id) {
//            return redirect(route('pc_home'));
//        }
//        if (!$cat_id) {
//            $cat_id = isset($filter_param[0]) ? (int)$filter_param[0] : 0; // 分类id
//        }
//        $p2 = isset($filter_param[1]) ? $filter_param[1] : 0; // 未知参数
//        $p3 = isset($filter_param[2]) ? $filter_param[2] : 0; // 未知参数
//        $is_self = isset($filter_param[3]) ? $filter_param[3] : 0; // 平台自营
//        $is_free = isset($filter_param[4]) ? $filter_param[4] : 0; // 包邮
//        $is_cash = isset($filter_param[5]) ? $filter_param[5] : 0; // 支持货到付款
//        $is_stock = isset($filter_param[6]) ? $filter_param[6] : 0; // 仅显示有货
//        $sort = isset($filter_param[7]) ? $filter_param[7] : 0; // 排序字段 综合/销量/新品/评论/价格/人气
//        $order = isset($filter_param[8]) ? $filter_param[8] : 4; // 排序方式 3-asc 4-desc
//        $region_code = isset($filter_param[9]) ? $filter_param[9] : 0; // 地区code
//        $display_model = isset($filter_param[10]) ? $filter_param[10] : 0; // 列表显示方式 0-大图模式 1-列表模式
//        $brand_id = isset($filter_param[11]) ? $filter_param[11] : 0; // 品牌
//        $price_min = isset($filter_param[12]) ? $filter_param[12] : 0; // 最小价格
//        $price_max = isset($filter_param[13]) ? $filter_param[13] : 0; // 最大价格


//        dd($params);
        extract($params);

        $goods_category = [];
        $navigate_cat = [];
        $navigate_cat_type = 0;
        if (isset($cat_id) && !empty($cat_id)) {
            $cat_info = $this->category->getById($cat_id);
            $brand_ids = explode(',', $cat_info->brand_ids);
            $cat_brands = Brand::whereIn('brand_id', $brand_ids)->get();

            // 商品分类列表
            $goods_category = Category::where('is_show', 1)->select(['cat_id','cat_name','parent_id', 'cat_level'])->orderBy('cat_sort', 'asc')->get();
            // 分类面包屑导航
            $navigate_cat = navigate_goods($cat_id, 1);
            $navigate_cat_type = 0;

            // 分类菜单显示 目前没有用到
//        $cur_cat_arr = $this->goods->getGoodsCat($cat_info); // 当前分类



            $seo_info = [
                1 => $cat_info->title,
                2 => $cat_info->keywords,
                3 => $cat_info->discription,
            ];

            $this->show_seo($seo_info, ['name' => $cat_info->cat_name]); // SEO
        }

        $cat_id_arr = [];
        if (!empty($cat_id)) {
            $cat_id_arr = get_cat_grandson($cat_id); // 获取该分类下的所有分类id
        }

//        $condition['in'] = [
//            'field' => 'cat_id',
//            'condition' => $cat_id_arr
//        ];
        // 热卖商品
        $hot_sale_goods = $this->goods->getHotSaleGoods($cat_id_arr, 4);
        // 新品推荐
        $new_goods = $this->goods->getNewGoods($cat_id_arr, 4);

        // 店内排行榜-销售量
        $sale_top_list = $this->goods->getTopGoods('sale_num', $cat_id_arr, 4);
        // 店内排行榜-收藏数
//        $collect_top_list = $this->goods->getTopGoods('collect_num', $cat_id_arr, 4);

        // 销量排行榜
//        $sale_rank_goods = $this->goods->getSaleRankGoods($cat_id_arr, 4);

        // 浏览历史
        list($goods_history, $goods_history_total) = $this->goods->getGoodsHistory($cat_id_arr, 6);

        // 商城所在地区
//        $region_code = sysconf('mall_region_code');

        $region_code = !empty($params['region']) ? str_replace('_', ',', $params['region']) : null;

        /*
        * 筛选条件
        *
        */
        $where = [];
        $where[] = ['goods_status',1]; // 商品状态 已发布
        $where[] = ['goods_audit',1]; // 审核通过
        list($where, $whereBetween, $whereIn) = $this->goods->splice_goods_list_condition($params);

        // 计算价格区间
        $goodsQuery = new Goods();
        $goodsPriceQuery = new Goods();
        if (!empty($where)) {
            $goodsQuery = $goodsQuery->where($where);
            $goodsPriceQuery = $goodsQuery->where($where);
        }

        if (!empty($whereBetween) && isset($whereBetween['goods_price'])) { // 暂时固定为goods_price
            $goodsQuery = $goodsQuery->whereBetween('goods_price', $whereBetween['goods_price']);
        }
        if (!empty($whereIn)) {
            foreach ($whereIn as $k=>$v) {
                $goodsQuery = $goodsQuery->whereIn($k, $v);
                $goodsPriceQuery = $goodsQuery->whereIn($k, $v);
            }
        }

        // 计算价格区间

        $goodsPriceData = $goodsPriceQuery
            ->select(DB::raw("MIN(goods_price) as price_min,MAX(goods_price) as price_max, GROUP_CONCAT(goods_price) as price_str"))
            ->first()->toArray();

        // 商品列表
        $curPage = isset($go) ? $go : 1;
        $pageSize = isset($size) ? $size : 20;
        $sortname = isset($sortname) ? $sortname : 1;
        $sortorder = isset($sortorder) ? $sortorder : 'DESC';
        $field = ['goods_id','goods_name','cat_id','shop_id','sku_id','sku_open','goods_price','market_price','mobile_price','give_integral','goods_number','warn_number','goods_image','brand_id','click_count','sale_num','comment_num','collect_num','is_best','is_new','is_hot','is_promote','freight_id','sales_model','goods_sort','last_time',
//            'shop_name','shop_type','is_supply','show_price','show_content','button_content', 'is_free', 'brand_name','button_url'
            'goods_freight_fee'
        ];
        $total = $goodsQuery
            ->select($field)->count();
        $list = $goodsQuery
            ->select($field)
            ->forPage($curPage, $pageSize)
            ->orderBy(get_goods_sort_array($sortname), $sortorder)
            ->get()->toArray();

        if (!empty($list)) {
            foreach ($list as &$v) {
                $shop_info = Shop::where('shop_id', $v['shop_id'])
                    ->select(['shop_name','shop_type','is_supply','show_price','show_content','button_content','button_url'])
                    ->first()->toArray();
                $brand_name = Brand::where('brand_id', $v['brand_id'])->value('brand_name');
                $isCollected = 0;
                if ($this->collect->checkIsCollected($this->user_id, 0, 0, $v['goods_id'])) {
                    // 已收藏
                    $isCollected = 1;
                }
                $v = array_merge($v, $shop_info);
                $v['is_free'] = $v['goods_freight_fee'] > 0 ? 0 : 1;
                $v['brand_name'] = $brand_name;
                $v['act_type'] = null;
                $v['default_spec_id'] = null;
                $v['goods_gift'] = 0;
                $v['price_show'] = ['code'=>1];
                $v['goods_price_format'] = '￥'.$v['goods_price'];
                $v['market_price_format'] = '￥'.$v['market_price'];
                $v['buy_enable'] = [ // 判断是否登录
                    'code' => 1,
                    'button_content' => '请登录'
                ];
                $v['is_collected'] = $isCollected; // 判断是否收藏商品
                $v['cart_num'] = 0; // 该商品购物车数量

                #修改价格bug=====
                $sku_info = Db::table('goods_sku')->where('sku_id', $v['sku_id'])->first();
                $sku_info->sku_prices = json_decode($sku_info->sku_prices, true);
                $low_price = '';
                foreach ($sku_info->sku_prices['price'] as $k=>$v2) {
                    if (empty($low_price)) {
                        $low_price = $v2;
                    } else {
                        if ($v2<$low_price) {
                            $low_price = $v2;
                        }
                    }
                }
                $v['goods_price'] = $low_price;
                #修改价格bug=====
            }
        }

        // 分页
        $pageHtml = frontend_pagination($total);
        $page_array = frontend_pagination($total, true);
        $page_json = json_encode($page_array);

        $goods_ids = implode(',', array_column($list, 'goods_id'));

//        dd($goodsPriceData);
        list($filter, $filter_condition) = $this->goods->goodsFilterData($params, $goodsPriceData);
//        dd($filter);

        //2024-02-21===
        #判断当前分类是否有下层分类
        $have_cate = 0;
        $now_cate = Db::table('category')->where('cat_id', $cat_id)->select('cat_id', 'cat_name')->first();
        $next_cate = Db::table('category')->where(['parent_id'=>$cat_id,'is_show'=>1])->get()->toArray();

        if (!empty($next_cate)) {
            foreach ($next_cate as $k2=>&$v2) {
                $v2->child = Db::table('category')->where(['parent_id'=>$v2->cat_id,'is_show'=>1])->get()->toArray();
            }
            $have_cate = 1;
        }
        //2024-02-21===

        // 重新设置params
        $params = [
            'filter_attr_vids' => isset($filter_attr_vids) ? $filter_attr_vids : null,
            'filter_attr_ids' => isset($filter_attr_ids) ? $filter_attr_ids : null,
            'filter_brand_ids' => isset($filter_brand_ids) ? $filter_brand_ids : null,
            'filter_goods_prices' => isset($filter_goods_prices) ? $filter_goods_prices : null,
            'cat_id' => isset($cat_id) ? $cat_id : 0,
            //2024-02-21
            'next_cate' => $next_cate,
            'have_cate' => $have_cate,
            'now_cate' => $now_cate,
            //2024-02-21
            'cat_ids' => isset($cat_ids) ? $cat_ids : null,
            'type' => isset($type) ? $type : 0,
            'go' => isset($go) ? $go : 1,
            'brand_id' => isset($brand_id) ? $brand_id : 0,
            'filter_attr' => isset($filter_attr) ? $filter_attr : 0, // '1801-1784-1825-1738-1773'
            'price_min' => isset($price_min) ? $price_min : 0, // '1'
            'price_max' => isset($price_max) ? $price_max : 0, // '300'
            'region_code' => $region_code,
            'is_free' => isset($is_free) ? $is_free : 0,
            'is_self' => isset($is_self) ? $is_self : 0,
            'is_stock' => isset($is_stock) ? $is_stock : 0,
            'is_cash'=>isset($is_cash) ? $is_cash : 0,
            'style'=>isset($style) ? $style : 'grid',
            'sort'=>isset($sort) ? $sort : '1',
            'order'=>isset($order) ? $order : 'DESC',
            'keyword'=>isset($keyword) ? $keyword : null,
            'shop_id'=>isset($shop_id) ? $shop_id : 0,
            'barcode'=>isset($barcode) ? $barcode : null,
        ];

        $compact = compact(
            'cat_info',
            'cat_brands',
            'cat_id',
            'list',
            'page_array',
            'total',
            'pageHtml',
            'goods_ids',
            'goods_category',
            'navigate_cat',
            'navigate_cat_type',
            'hot_sale_goods',
            'new_goods',
            'sale_top_list',
            'goods_history',
            'style',
            'page_json',
            'filter',
            'filter_condition',
            'region_code',
            'params'
        );

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'region_code' => $region_code,
                'price_show' => [
                    'code' => 1
                ],
                'display' => 'grid',
                'filter' => $filter,
                'params' => [
                    $params
                ],
                'condition'=>$filter_condition, // 选中的筛选项
                'list' => $list,
                'page' => $page_array, // 列表底部详细分页
                'goods_ids' => $goods_ids,
                'keyword' => isset($keyword) ? $keyword : '',
                'cat_id'=>isset($cat_id) ? $cat_id : 0,
                'scroll'=>1,
                'show_sale_number'=>'1',
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'goods.goods_list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }
    
    #展示商品卡片
    public function showGoods(Request $request, $goods_id){
        $data = $request->except(['_token']);
        $share_uid = isset($data['share_uid'])?intval($data['share_uid']):0;#分享者uid
        $campaign_id = isset($data['campaign_id'])?intval($data['campaign_id']):0;#用户参与活动id
        
        if($share_uid > 0 && empty(session('user')) ){
            # 小程序扫码时要求登录
            session('share_uid',$share_uid);
            $origin_page = '/login.html?open=4&param2='.base64_encode('/goods-'.$goods_id.'.html?campaign_id='.$campaign_id.'&share_uid='.$share_uid);   
            header('Location: '.$origin_page);exit;
        }
        
        $goods = Db::table('goods')->where(['goods_id'=>intval($goods_id)])->select('goods_id','sku_id','goods_name','goods_image','shop_id','goods_currency')->first();
        
        #商品分享词（限制41个词）
        $characters = mb_str_split($goods->goods_name, 1, 'UTF-8');
        $result = array_chunk($characters, 26);
        // 将每组字符重新组合成字符串
        $goods_share_words = array_map(function($chunk) {
            return implode('', $chunk);
        }, $result);
     
        $shop_name = 'Gogo淘中国';
        $shop_logo = 'https://shop.gogo198.cn/collect_website/public/uploads/centralize/website_index/679357cc06e93.png';
        if($goods->shop_id>0){
            $shop_name = Db::connection('shop_db')->table('website_user_company')->where(['id'=>$goods->shop_id])->select('company')->first()->company;
            try{
                $shop_logo = Db::connection('shop_db')->table('website_basic')->where(['company_id'=>$goods->shop_id,'company_type'=>0])->select('logo')->first()->logo;
                $shop_logo = '//dtc.gogo198.net'.$shop_logo;
            }
            catch (\Exception $e){}
        }
        $goods_currency = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$goods->goods_currency])->select('currency_symbol_standard')->first();
        $goods_sku = Db::table('goods_sku')->where(['goods_id'=>$goods_id])->get();
        
        $low_price = 0;// 最低价
        foreach($goods_sku as $k=>$v){
            $goods_sku[$k]->sku_prices = json_decode($v->sku_prices,true);
            foreach($goods_sku[$k]->sku_prices['price'] as $k2=>$v2){
                if(empty($low_price)){
                    $low_price = $v2;
                }else{
                    if($low_price>$v2){
                        $low_price = $v2;
                    }    
                }
            }
        }
        $true_low_price = $goods_currency->currency_symbol_standard.' '.$low_price;//最低价和币种
        
        //随机颜色
        $color = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['pid'=>12])->inRandomOrder()->select('param1','param2','param3')->first();
        
        $website = get_website();
        $page_info = get_pageinfo('/goods');
        $website['background'] = $page_info['content']['background'] ?? '';
        $website['content'] = $page_info['content']['content'] ?? '';
        $website['fontcolor'] = $page_info['content']['fontcolor'] ?? '';
        $website['agentLink'] = $page_info['content']['agent_link'] ?? '';
        if($share_uid>0){
            $origin_page = '/login.html?open=4&param2='.base64_encode('/goods-'.$goods_id.'.html?share_uid='.$share_uid);    
        }else{
            $origin_page = '/login.html?open=4&param2='.base64_encode('/goods-'.$goods_id.'.html');
        }
        
        $latestComment = Db::table('goods_comment')->where(['goods_id'=>$goods_id])->orderBy('comment_id','desc')->first();
        
        return view('goods.goods_home',compact('color','goods','true_low_price','shop_logo','shop_name','website','origin_page','goods_share_words','share_uid','campaign_id','latestComment'));
    }
    
    #商品评论
    public function goodsComment(Request $request){
        $data = $request->except(['_token']);
        $share_uid = isset($data['share_uid'])?$data['share_uid']:0;
        $goods_id = $data['goods_id'];
        $campaign_id = isset($data['campaign_id'])?$data['campaign_id']:0;
        $comment = isset($data['comment'])?trim($data['comment']):'';
        $isloading = isset($data['isloading'])?intval($data['isloading']):0;
        
        if($isloading==1){
            #获取该商品的全部聊天记录
            $list = Db::table('goods_comment')->where(['goods_id'=>$goods_id])->get();
            $list = objtoarr($list);
            foreach($list as $k=>$v){
                $list[$k]['created_at'] = date('Y-m-d H:i',$v['created_at']);
            }
            return Response()->json(['code'=>0,'data'=>$list]);
        }
        elseif($isloading==0){
            $res = Db::table('goods_comment')->insert([
                'user_id'=>session('user.user_id'),
                'user_nick'=>session('user.user_name'),
                'goods_id'=>$goods_id,
                'comment_desc'=>$comment,
                'is_show'=>1,
                'created_at'=>time()
            ]);
            
            if($res){
                //任务操作日志
                task_campaign(['share_uid'=>$share_uid,'goods_id'=>$goods_id,'campaign_id'=>$campaign_id,'campaign_type'=>4]);
                
                return Response()->json(['code'=>0,'msg'=>'评论成功']);
            }else{
                return Response()->json(['code'=>-1,'msg'=>'评论失败']);
            }   
        }
    }
    
    #展示商品详情
    public function showGoodsDetail(Request $request, $goods_id){
        $info = $request->except(['_token']);
        $goods_id = intval($goods_id);
        $share_uid = isset($info['share_uid'])?intval($info['share_uid']):0;
        $campaign_id = isset($info['campaign_id'])?intval($info['campaign_id']):0;
        
        //任务操作日志
        task_campaign(['share_uid'=>$share_uid,'goods_id'=>$goods_id,'campaign_id'=>$campaign_id,'campaign_type'=>1]);
        
        if ($request->routeIs('pc_show_goods') || $request->routeIs('mobile_show_goods')) {
            $sku_id = $this->goods->getSkuId($goods_id);
        } else {
            $sku_id = $goods_id;
            $goods_id = $this->goods->getGoodsId($sku_id);
        }
       
        $cacheKey = "goods_show_full_v2025_{$goods_id}";
        $cached = Cache::remember($cacheKey, 86400, function () use ($request, $goods_id, $sku_id) {
            $goods_info = $this->goods->getById($goods_id);
            
            if (empty($goods_info)) {
                abort(200, '商品不存在，可能已下架或者被转移');
            }
    
            $shopId = $goods_info->shop_id;
            
            // 店铺信息
            $shop_info = [];
            if ($shopId > 0) {
                $shop_row = DB::connection('shop_db')->table('website_user_company')->where('id', $shopId)->first();
                $shop_info = $shop_row ? (array)$shop_row : [];
            }
    
            $goods = $goods_info->toArray();
            
            // 商品sku列表（保持原 Repository 调用）
            $sku_list = $this->goods->getFrontendSkuList($goods_id);
            $base_sku_list = array_values($sku_list);
            
            // 商品规格列表 + has_sku 判断（优化 N+1）
            $spec_list = $this->goods->getGoodsSpecList($goods_info);
            // dd($spec_list);
            if (!empty($spec_list)) {
                // 一次性取出该商品所有 SKU 的 spec_vids
                $all_spec_vids = DB::table('goods_sku')
                    ->where('goods_id', $goods_id)
                    ->pluck('spec_vids')
                    ->toArray();
    
                foreach ($spec_list as $k => $v) {
                    foreach ($v['attr_values'] as $k2 => $v2) {
                        $spec_list[$k]['attr_values'][$k2]['has_sku'] = 0;
    
                        $found = false;
                        foreach ($all_spec_vids as $vids) {
                            if (strpos($vids, (string)$v2['attr_vid']) !== false) {
                                $found = true;
                                break;
                            }
                        }
                        if (!$found) {
                            $spec_list[$k]['attr_values'][$k2]['has_sku'] = -1;
                        }
                    }
                }
            }
            
            // 商品属性列表
            $attr_list = $this->goods->getGoodsAttrList($goods_id);
    
            // 商品售后服务保障列表
            $contract_ids = [];
            if (!empty($goods['contract_ids'])) {
                $decoded = is_string($goods['contract_ids']) ? unserialize($goods['contract_ids']) : $goods['contract_ids'];
                foreach ((array)$decoded as $k => $v) {
                    if ($v == 1) {
                        $contract_ids[] = $k;
                    }
                }
            }
            $contract_list = '';
    
            // 包装清单 & 售后保证
            $packing_layout = '';
            $service_layout = '';
    
            // 店铺常见问题
            $question_list = '';
    
            // 商品评论（暂留空，和原版一致）
            $comment = null;
    
            // 商品单位名称
            $unit_name = '';
    
            // 检查对比、收藏
            $is_compare = '';
    
            $is_collect = $this->collect->checkIsCollected($this->user_id, 0, 0, $goods_id);
    
            $is_shop_collect = $shopId > 0 ? $this->collect->checkIsCollected($this->user_id, 1, $goods['shop_id']) : false;
            
            $goods['goods_button_name'] = null;
            $goods['goods_button_url'] = null;
            $goods['region_code'] = isset($shop_info['shop']['region_code'])?$shop_info['shop']['region_code']:'';
            $goods['is_free'] = null;
            $goods['free_set'] = null;
            $goods['limit_sale'] = null;
            $goods['collect_count'] = $goods['collect_num'];
            $goods['shop_name'] = isset($shop_info['shop']['shop_name'])?$shop_info['shop']['shop_name']:'';
            $goods['is_supply'] = isset($shop_info['shop']['is_supply'])?$shop_info['shop']['is_supply']:'';
            $goods['start_price'] = isset($shop_info['shop']['start_price'])?$shop_info['shop']['start_price']:'';
            $goods['button_content'] = isset($shop_info['shop']['button_content'])?$shop_info['shop']['button_content']:'';
            $goods['button_url'] = isset($shop_info['shop']['button_url'])?$shop_info['shop']['button_content']:'';
            $goods['show_price'] = isset($shop_info['shop']['show_price'])?$shop_info['shop']['show_price']:'';
            $goods['show_content'] = isset($shop_info['shop']['show_content'])?$shop_info['shop']['show_content']:'';
            $goods['region_name'] = null;
            $goods['base_sku_list'] = $base_sku_list;
            $goods['sku_list'] = $sku_list;
            $goods['price_show'] = [
                'code' => 1 // todo
            ];
            $goods['spec_list'] = $spec_list;
            $goods['attr_list'] = $attr_list;
            $goods['contract_list'] = $contract_list;
            $goods['packing_layout'] = $packing_layout;
            $goods['service_layout'] = $service_layout;
            $goods['question_list'] = $question_list;
            $goods['comment_count'] = $goods['comment_num'];
            $goods['comment'] = $comment;
            $goods['goods_price_format'] = '￥'.$goods['goods_price'];
            $goods['unit_name'] = $unit_name;
            $goods['is_compare'] = $is_compare;
            $goods['is_collect'] = $is_collect;
            $goods['shop_collect'] = $is_shop_collect;
    
            // todo 暂时 等待平台后台添加商品配置信息后打开
            $goods['show_sale_number'] = sysconf('goods_show_sale_number'); // 是否显示商品销量
            
            // SKU 信息
            $default_shop = [
                'is_supply'      => '',
                'show_price'     => '',
                'show_content'   => '',
                'button_content' => '',
                'button_url'     => '',
                'start_price'    => '',
            ];
            $current_shop = $shop_info['shop'] ?? $default_shop;
            
            $sku = $this->goodsSku->getGoodsSkuInfo($sku_id, $goods_info, $current_shop);
            
            $sku['start_num'] = $sku['sku_prices']['start_num'][0];
            
            $goods['other_shop'] = json_decode($goods['other_shop'], true) ?: [];
    
            $sku_images = DB::table('goods_image')
                ->where('goods_id', $goods['goods_id'])
                ->pluck('path')
                ->toArray();
    
            $sku['sku_images'] = [];
            foreach ($sku_images as $path) {
                $imgLink = '';
                // if($shopId>0){
                //     $imgLink = 'https://dtc.gogo198.net';
                // }
                $sku['sku_images'][] = [$imgLink.$path, $imgLink.$path, $imgLink.$path]; // 原逻辑 3 个相同
            }
            
            // if($shopId>0){
            //     $goods['goods_image'] = 'https://dtc.gogo198.net'.$goods['goods_image'];
            // }
            
            $is_weixin = is_weixin();
            
            $shop_goods_count = $this->shop->getShopGoodsCount($shopId);
            $shop_collect_count = $shop_info['collect_num'] ?? 0;
    
            $sale_top_list = $collect_top_list = [];
            if ($goods['shop_id'] > 0) {
                $sale_top_list = $this->goods->getTopGoods('sale_num', [], 10, $goods['shop_id']);
                $collect_top_list = $this->goods->getTopGoods('collect_num', [], 10, $goods['shop_id']);
            }
    
            $im_enable = 1;
            $comment_count = '0';
            $collect_count = '0';
            $show_collect_count = sysconf('goods_info_show_collect');
            $bonus_list = [];
            $rank_prices = null;
            $rank_message = '请登录，确认是否享受优惠';
            $show_freight_region = 1;
            $show_stock = '1';
            
            // 自提点
            $condition = [
                'where' => [['is_show', 1], ['shop_id', $goods_info->shop_id]],
                'limit' => 0,
                'sortname' => 'pickup_id',
                'sortorder' => 'desc',
            ];
            list($pickup, $self_pickup_total) = $this->selfPickup->getList($condition);
            
            // 商品单位列表
            $unit_list = ['' => '-- 请选择 --'];
            $unitList = [];
            foreach ($unitList as $item) {
                $unit_list[$item->unit_id] = $item->unit_name;
            }
    
            $share = [
                'seo_goods_title'       => '【'.$goods['goods_name'].'】-网站名称',
                'seo_goods_keywords'    => '【'.$goods['goods_name'].'】-网站名称',
                'seo_goods_discription' => ''
            ];
            
            // 店铺内分类
            $shop_category_list = [];
            $shop_cat_condition = [
                'where' => [['shop_id', $goods_info->shop_id]],
                'sortname' => 'cat_sort',
                'sortorder' => 'asc',
            ];
            list($shop_category_list, $total) = $this->shopCategory->getList($shop_cat_condition, '', true);
    
            // 商品分类 & 面包屑
            $goods_category = Category::where('is_show', 1)
                ->select(['cat_id','cat_name','parent_id', 'cat_level'])
                ->orderBy('cat_sort', 'asc')
                ->get();
    
            $navigate_cat = navigate_goods($goods_id, 1);
            $navigate_cat_type = 1;
    
            $region_code = $shop_info['region_code'] ?? '';
            $lrw_last_region_code = session('LRW_LAST_REGION_CODE');
            if ($lrw_last_region_code) {
                $arr = unserialize(substr($lrw_last_region_code, 64));
                $region_code = $arr[1] ?? $region_code;
            }
            
            // ============================== 2024/01/18 全部字段处理（完整保留） ==============================
            $low_price = $sku['sku_prices']['price'][0] ?? $goods['goods_price'];
            foreach ($sku['sku_prices']['price'] ?? [] as $v) {
                if ($low_price > $v) $low_price = $v;
            }
    
            // 全部SKU价格区间处理（单位+货币一次性查）
            $all_sku_rows = DB::table('goods_sku')->where('goods_id', $goods['goods_id'])->get();
    
            $unit_codes = $currency_ids = [];
            foreach ($all_sku_rows as $s) {
                $p = json_decode($s->sku_prices, true);
                $unit_codes = array_merge($unit_codes, $p['unit'] ?? []);
                $currency_ids = array_merge($currency_ids, $p['currency'] ?? []);
            }
            $unit_map = DB::connection('shop_db')->table('unit')
                ->whereIn('code_value', array_unique($unit_codes))
                ->pluck('code_name', 'code_value')
                ->toArray();
            
            $currency_map = DB::connection('shop_db')->table('centralize_currency')
                ->whereIn('id', array_unique($currency_ids))
                ->pluck('currency_symbol_standard', 'id')
                ->toArray();
            
            $sku_info = [];
            foreach ($all_sku_rows as $k=>$s) {
                $p = json_decode($s->sku_prices, true);
                foreach ($p['unit'] as $k2 => $v2) {
                    $p['unit'][$k2] = $unit_map[$v2] ?? $v2;
                }
                foreach ($p['currency'] as $k2 => $v2) {
                    $p['currency'][$k2] = $currency_map[$v2] ?? '';
                }
                $s->sku_prices = $p;
                $sku_info[] = (array)$s;
            }
            
            #商品单位
            $goods['unit_name'] = $sku_info[0]['sku_prices']['unit'][0];
            #商品币种
            $goods['currency'] = $currency_map[$sku['sku_prices']['currency'][0] ?? 5] ?? 'CNY';
    
            if ($shopId == 0) {
                $goods['goods_price'] = $low_price;
            }else{
                $goods['goods_price'] = $sku['sku_prices']['price'][0];
            }
    
            // 分类名称、logi 等字段（原逻辑）
            $goods['cat_name'] = DB::table('category')->where('cat_id', $goods['cat_id'])->value('cat_name') ?? '';
            $goods['logi_id'] = $goods['crossb_cate2'] ?? $goods['crossb_cate1'] ?? 0;
            $goods['logi_name'] = '';
            if ($goods['logi_id'] > 0) {
                $goods['logi_name'] = DB::table('category')->where('cat_id', $goods['logi_id'])->value('cat_name') ?? '';
            }
            
            $country = [];
            if($goods['shop_id']==0){
                #接口商品只能选择海外地址走平台集运
                $country = DB::connection('shop_db')
                ->table('centralize_diycountry_content')
                ->whereRaw('pid=5 and id<>162')
                ->get()
                ->toArray();
            }
            elseif($goods['service_type']==1){
                #物流支撑（支持中国跨境配送），要让用户选择“平台集运”还是“自主集运”
                #选择“自主集运”后只能选择中国收货地址；
                #选择“平台集运”后只能选择线路，选择线路后，只能选择相应国地的收货地址；
                // $goods['gather_countrys'] = json_decode($goods['gather_countrys'],true);
                // $country_ids = implode(',',$goods['gather_countrys']['gather_country']);
                
                $country = DB::connection('shop_db')
                ->table('centralize_diycountry_content')
                ->whereRaw('pid=5')
                ->get()
                ->toArray();
            }
            elseif($goods['service_type']==2){
                #物流支撑（不支持中国跨境配送），只能让用户选择国内地址
                $country = DB::connection('shop_db')
                ->table('centralize_diycountry_content')
                ->whereRaw('pid=5 and id=162')
                ->get()
                ->toArray();
            }
            
            // 商户专属字段全部处理（完全复制你原代码，一字不差）
            if ($goods['shop_id'] > 0 && empty($goods['drug_id'])) {
                if (!empty($goods['reduction_content'])) {
                    $goods['reduction_content'] = json_decode($goods['reduction_content'], true);
                    foreach ($goods['reduction_content']['preferential_blong'] as $k => $v) {
                        $rule = DB::table('ssl_reduction_rule')->where('id', $goods['reduction_content']['type'][$k])->first();
                        $goods['reduction_content']['type_name'][$k] = $rule->name ?? '';
                        $goods['reduction_content']['content'][$k] = json_decode($rule->content ?? '[]', true);
                    }
                    $goods['reduction_content']['currency1'] = $currency_map[$goods['reduction_content']['currency1'] ?? 5] ?? '';
                    $goods['reduction_content']['currency2'] = $currency_map[$goods['reduction_content']['currency2'] ?? 5] ?? '';
                }
                
                if (!empty($goods['gift_content'])) {
                    $goods['gift_content'] = json_decode($goods['gift_content'], true);
                    $goods['gift_content']['points_currency'] = $currency_map[$goods['gift_content']['points_currency'] ?? 5] ?? '';
                    $goods['gift_content']['coupon_currency'] = $currency_map[$goods['gift_content']['coupon_currency'] ?? 5] ?? '';
                }
                
                if (!empty($goods['noinclude_content'])) {
                    $goods['noinclude_content'] = json_decode($goods['noinclude_content'], true);
                    $goods['noinclude_content']['currency'] = $currency_map[$goods['noinclude_content']['currency'] ?? 5] ?? '';
                }
                
                if (!empty($goods['potential_content'])) {
                    $goods['potential_content'] = json_decode($goods['potential_content'], true);
                    $goods['potential_content']['currency'][0] = $currency_map[$goods['potential_content']['currency'][0] ?? 5] ?? '';
                    $goods['potential_content']['currency'][1] = $currency_map[$goods['potential_content']['currency'][1] ?? 5] ?? '';
                    $goods['potential_content']['currency2'] = $currency_map[$goods['potential_content']['currency2'] ?? 5] ?? '';
                }
                
                if (!empty($goods['otherfees_content'])){
                    $goods['otherfees_content'] = json_decode($goods['otherfees_content'],true);
                }
                
                #商品启运国
                $goods['shipping_country_name'] = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['id'=>$goods['shipping_country']])->first()->param2;
                
                #商品配送规则
                if(!empty($goods['domestic_logistics']) &&  $goods['domestic_logistics']!=null){
                    #国内配送
                    $goods['domestic_logistics'] = json_decode($goods['domestic_logistics'],true);
                    $goods['domestic_logistics']['areas'] = [];
                    foreach($goods['domestic_logistics']['area1'] as $k=>$v){
                        if($v!='all'){
                            $area1 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$v])->first()->code_name;
                        }else{
                            $area1 = '全部省份';
                        }
                        
                        $area2 = '';$area3 = '';$area4 = '';$area5 = '';$area6 = '';
                        if(isset($goods['domestic_logistics']['area2'][$k])){
                            if($goods['domestic_logistics']['area2'][$k]!='all'){
                                $area2 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$goods['domestic_logistics']['area2'][$k]])->first()->code_name;
                            }else{
                                $area2 = '全部城市';
                            }
                        }
                        if(isset($goods['domestic_logistics']['area3'][$k])){
                            if($goods['domestic_logistics']['area3'][$k]!='all'){
                                $area3 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$goods['domestic_logistics']['area3'][$k]])->first()->code_name;
                            }else{
                                $area3 = '全部区域';
                            }
                        }
                        if(isset($goods['domestic_logistics']['area4'][$k])){
                            if($goods['domestic_logistics']['area4'][$k]!='all'){
                                $area4 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$goods['domestic_logistics']['area4'][$k]])->first()->code_name;
                            }else{
                                $area4 = '全部镇街';
                            }
                        }
                        if(isset($goods['domestic_logistics']['area5'][$k])){
                            if($goods['domestic_logistics']['area5'][$k]!='all'){
                                $area5 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$goods['domestic_logistics']['area5'][$k]])->first()->code_name;
                            }else{
                                $area5 = '全部居委';
                            }
                        }
                        // if(isset($goods['domestic_logistics']['area6'][$k])){
                            
                        //     $area6 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$goods['domestic_logistics']['area6']])->first()->code_name;
                        // }
                        array_push($goods['domestic_logistics']['areas'],['area1'=>$area1,'area2'=>$area2,'area3'=>$area3,'area4'=>$area4,'area5'=>$area5,'area6'=>$area6]);
                    }
                }
                
                if($goods['service_type']==1){
                    #支持（中国）跨境配送
                    
                    #平台集运支持的线路
                    if($goods['gather_lines']!=null && !empty($goods['gather_lines'])){
                        $goods['gather_lines'] = explode(',',$goods['gather_lines']);
                        
                        $goods['gather_lines_list'] = [];
                        foreach($goods['gather_lines'] as $k=>$v){
                            $gather_lines_list = Db::connection('shop_db')->table('centralize_lines')->where(['id'=>$v])->first();
                            $gather_lines_list = objtoarr($gather_lines_list);
                            array_push($goods['gather_lines_list'],$gather_lines_list);
                        }
                    }

                    #发货城市
                    $goods['shipping_country_info'] = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['id'=>$goods['shipping_country']])->first();
                    $goods['shipping_country_info'] = objtoarr($goods['shipping_country_info']);
                    $goods['shipping_areas'] = json_decode($goods['areas'],true);
                    foreach($goods['shipping_areas'] as $k=>$v){
                        $goods['shipping_areas'][$k] = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$v])->first();
                        $goods['shipping_areas'][$k] = objtoarr($goods['shipping_areas'][$k]);
                    }
                }
                
                #商品活动
                if(!empty($goods['activity_info'])){
                    $goods['activity_info'] = explode(',',$goods['activity_info']);
                    foreach($goods['activity_info'] as $k=>$v){
                        $goods['activity_info'][$k] = Db::table('ssl_activity')->where('id',$v)->first();
                        $goods['activity_info'][$k] = objtoarr($goods['activity_info'][$k]);
                    }
                }
                
                #商品规格名称信息
                if(!empty($goods['spec_info'])){
                    $goods['spec_info'] = json_decode($goods['spec_info'],true);
                }
                
                #商品描述
                if(!empty($goods['pc_desc'])){
                    $goods['pc_desc'] = json_decode($goods['pc_desc'],true);
                    // $goods['pc_desc'] = str_replace('src="/uploads','src="//rte.gogo198.cn/uploads',$goods['pc_desc']);
                    $goods['pc_desc'] = str_replace('src="/uploads','src="//dtc.gogo198.net/uploads',$goods['pc_desc']);
                }
                
                #商品品牌
                if($goods['brand_type']==1){
                    #有牌
                    if($goods['brand_type2']==0){
                        #自有品牌
                        $goods['goods_name'] = $goods['brand_name'].'的'.$goods['goods_name'];
                    }
                    elseif($goods['brand_type2']==1){
                        #知名品牌
                        $brand_name = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['pid'=>8,'id'=>$goods['brand_id']])->first()->param1;
                        $goods['goods_name'] = $brand_name.'的'.$goods['goods_name'];
                    }
                }
                
                #商品规则
                $goods['rule'] = Db::table('description_rule')->where(['id'=>$goods['rule_id']])->first();
                $goods['rule'] = objtoarr($goods['rule']);
                #序言
                if($goods['rule']['is_preamble']==1){
                    $goods['rule']['preamble_con'] = json_decode($goods['rule']['preamble_con'],true);
                }
                $goods['rule']['title'] = json_decode($goods['rule']['title'],true);
                if(isset($goods['rule']['content'])){
                    $goods['rule']['content'] = json_decode($goods['rule']['content'],true);    
                }else{
                    $goods['rule']['content'] = [];
                }
                
                #整理商品规则树形结构代码
                if(isset($goods['rule']['type'])){
                    if($goods['rule']['type']==1){
                        $first = [];
                        $second = [];
                        foreach($goods['rule']['content'] as $k=>$v){
                            if($v['pnum']==0){
                                array_push($first,[
                                    'title'=>$v['title'],
                                    'parag_num'=>$v['parag_num'],
                                    'pnum'=>$v['pnum'],
                                    'content'=>$v['content'],
                                    'children'=>[],
                                ]);
                            }else{
                                array_push($second,[
                                    'title'=>$v['title'],
                                    'parag_num'=>$v['parag_num'],
                                    'pnum'=>$v['pnum'],
                                    'content'=>$v['content'],
                                    'children'=>[],
                                ]);
                            }
                        }
    
                        #最多嵌套3层
                        foreach($first as $k=>$v){
                            foreach($second as $k2=>$v2){
                                if($v['parag_num']==$v2['pnum']){
                                    #1.1.
                                    array_push($first[$k]['children'],$v2);
                                }else{
                                    foreach($first[$k]['children'] as $k3=>$v3){
                                        if($v3['parag_num']==$v2['pnum']){
                                            #1.1.1.
                                            array_push($first[$k]['children'][$k3]['children'],[
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
                        $goods['rule']['content2'] = $first;
                    }
                }
                
                if (!empty($goods['manufacture'])) {
                    $goods['manufacture'] = json_decode($goods['manufacture'], true);
                    if (isset($goods['manufacture']['country'])) {
                        $goods['manufacture']['country_name'] = DB::connection('shop_db')->table('centralize_diycountry_content')->where('id', $goods['manufacture']['country'])->value('param2');
                    }
                    // ... 其余 area1~area6 名称处理同下
                    $areas = ['area1','area2','area3','area4','area5','area6'];
                    foreach ($areas as $area) {
                        if (isset($goods['manufacture'][$area])) {
                            $goods['manufacture'][$area.'_name'] = DB::connection('shop_db')->table('centralize_adminstrative_area')->where('id', $goods['manufacture'][$area])->value('code_name');
                        }
                    }
                }
                
                if (!empty($goods['sales'])) {
                    $goods['sales'] = json_decode($goods['sales'], true);
                    if (isset($goods['sales']['country'])) {
                        $goods['sales']['country_name'] = DB::connection('shop_db')->table('centralize_diycountry_content')->where('id', $goods['sales']['country'])->value('param2');
                    }
                    // ... 其余 area1~area6 名称处理同下
                    $areas = ['area1','area2','area3','area4','area5','area6'];
                    foreach ($areas as $area) {
                        if (isset($goods['sales'][$area])) {
                            $goods['sales'][$area.'_name'] = DB::connection('shop_db')->table('centralize_adminstrative_area')->where('id', $goods['sales'][$area])->value('code_name');
                        }
                    }
                }
                if (!empty($goods['foreign'])) {
                    $goods['foreign'] = json_decode($goods['foreign'], true);
                    if (isset($goods['foreign']['country'])) {
                        $goods['foreign']['country_name'] = DB::connection('shop_db')->table('centralize_diycountry_content')->where('id', $goods['foreign']['country'])->value('param2');
                    }
                    // ... 其余 area1~area6 名称处理同下
                    $areas = ['area1','area2','area3','area4','area5','area6'];
                    foreach ($areas as $area) {
                        if (isset($goods['foreign'][$area])) {
                            $goods['foreign'][$area.'_name'] = DB::connection('shop_db')->table('centralize_adminstrative_area')->where('id', $goods['foreign'][$area])->value('code_name');
                        }
                    }
                }
                if (!empty($goods['effective'])){
                    $goods['effective'] = json_decode($goods['effective'],true);
                }
                if (!empty($goods['store'])){
                    $goods['store'] = json_decode($goods['store'],true);
                }
                if (!empty($goods['packing'])){
                    $goods['packing'] = json_decode($goods['packing'],true);
                    if(!empty($goods['packing']['packing_container'])){
                        $goods['packing']['packing_container_name'] = Db::connection('shop_db')->table('packing_category')->where(['id'=>$goods['packing']['packing_container'],'type'=>1])->first()->name;
                    }
                    if(!empty($goods['packing']['packing_material'])){
                        $goods['packing']['packing_material_name'] = Db::connection('shop_db')->table('packing_category')->where(['id'=>$goods['packing']['packing_material'],'type'=>2])->first()->name;
                    }
                }
                
                // 无规格 & 有规格 单位/货币处理
                if ($goods['have_specs'] == 2) {
                    $goods['nospecs'] = json_decode($goods['nospecs'], true);
                    foreach ($goods['nospecs']['unit'] as $k => $v) {
                        $goods['nospecs']['unit'][$k] = $unit_map[$v] ?? $v;
                        $goods['nospecs']['currency'][$k] = $currency_map[$goods['nospecs']['currency'][$k] ?? 5] ?? '';
                    }
                    foreach ($sku['sku_prices']['unit'] as $k => $v) {
                        $sku['sku_prices']['unit'][$k] = $unit_map[$v] ?? $v;
                        $sku['sku_prices']['currency'][$k] = $currency_map[$sku['sku_prices']['currency'][$k] ?? 5] ?? '';
                    }
                } else {
                    foreach ($sku['sku_prices']['unit'] as $k => $v) {
                        $sku['sku_prices']['unit'][$k] = $unit_map[$v] ?? $v;
                        $sku['sku_prices']['currency'][$k] = $currency_map[$sku['sku_prices']['currency'][$k] ?? 5] ?? '';
                    }
                }
            }
    
            // 更多服务
            if ($goods['drug_id'] > 0) {
                $drug_shelf = DB::connection('medical_db')->table('drug_shelf')->where('drug_id', $goods['drug_id'])->first();
                $drug_shelf = $drug_shelf ? (array)$drug_shelf : [];
                $services = DB::table('goods_services')
                    ->whereRaw('find_in_set(id,?)', [$drug_shelf['services_id'] ?? ''])
                    ->get();
            } else {
                $services = DB::table('goods_services')->where('company_id', 0)->get();
            }
            $services = objtoarr($services);
            $services_money = 0;
            foreach ($services as $k => $v) {
                $services[$k]['currency'] = $currency_map[$v['currency'] ?? 5] ?? '';
                if ($v['is_select'] == 1) {
                    $services_money += $v['price'];
                }
            }
            
            // 网站配置、收货地址、时段判断等全部保留（你原代码全部复制）

            $website = get_website();
            $page_info = get_pageinfo('/goods');
            $website['background'] = $page_info['content']['background'] ?? '';
            $website['content'] = $page_info['content']['content'] ?? '';
            $website['fontcolor'] = $page_info['content']['fontcolor'] ?? '';
            $website['agentLink'] = $page_info['content']['agent_link'] ?? '';
            
            $timeInterval = DB::table('time_interval')->get();
            $timeInterval = objtoarr($timeInterval);
            $time_interval = '北京时间';
            foreach ($timeInterval as $k => $v) {
                $typeName = $v['type'] == 1 ? '当日' : ($v['type'] == 2 ? '次日' : '');
                $timeInterval[$k]['typeName'] = $typeName;
            }
            
            $origin_page = '/login.html?open=4&param2='.base64_encode('/goodsdetail-'.$goods['goods_id'].'.html');
            
            $country = objtoarr($country);
            $goods_category = objtoarr($goods_category);
            // compact 所有变量（和你原版完全一致）
            $compact = compact(
                'website','address','goods','origin_page','time_interval','timeInterval',
                'services','services_money','country','sku','is_weixin','shop_goods_count',
                'shop_collect_count','sale_top_list','collect_top_list','im_enable',
                'shop_info','comment_count','collect_count','show_collect_count',
                'bonus_list','rank_prices','rank_message','show_freight_region','show_stock',
                'region_code','pickup','unit_list','share','shop_category_list',
                'goods_category','navigate_cat','navigate_cat_type','sku_info'
            );
            
            return [
                'app_prefix_data'=>[
                    'goods' => $goods,
                    'sku' => $sku,
                    'is_weixin' => is_weixin(),
                    'shop_goods_count' => $shop_goods_count,
                    'shop_collect_count' => $shop_collect_count,
                    'sale_top_list' => $sale_top_list,
                    'collect_top_list' => $collect_top_list,
                    'im_enable' => $im_enable,
                    'shop_info' => $shop_info,
                    'comment_count' => $comment_count,
                    'collect_count' => $collect_count,
                    'show_collect_count' => $show_collect_count,
                    'bonus_list' => $bonus_list,
                    'rank_prices' => $rank_prices,
                    'rank_message' => $rank_message,
                    'show_freight_region' => $show_freight_region,
                    'show_stock' => $show_stock,
                    'region_code' => $region_code,
                    'pickup' => $pickup->toArray(),
                    'unit_list' => $unit_list,
                    'share' => $share,
                ],
    
                'app_suffix_data' => [],
                'web_data' => [],
                'compact_data' => $compact,
                'tpl_view' => 'goods.show_goods'
            ];
        });
        
        // 缓存外只执行的代码
        if (is_login()) {
            $this->goodsHistory->addHistoryLog(is_login(), $cached['app_prefix_data']['goods']);
        }
        Goods::where('goods_id', $goods_id)->increment('click_count', 1);
        
        #商品库存获取表=2026-01-13
        // dd($cached);
        if($cached['compact_data']['goods']['shop_id']>0){
            $post = [
                'goods_id' => $cached['compact_data']['goods']['goods_id'],
                'sku_id'   => $cached['compact_data']['sku']['sku_id'],
                'shop_id'  => $cached['compact_data']['goods']['shop_id'],
                'wid'      => $cached['compact_data']['goods']['wid'],
                'goods_type'=>$cached['compact_data']['goods']['goods_type']
            ];
            // dd($post);
            $skunum = httpRequest('https://shop.gogo198.cn/collect_website/public/?s=api/func/get_goods_num', $post);
            
            #商品&规格可售库存
            $cached['compact_data']['sku']['goods_number'] = $skunum;
            $cached['compact_data']['sku']['sku_prices']['goods_number'] = $skunum;
        }
        // dd($cached['compact_data']['sku']);
        
        #收货地址-----START
        $address = [];
        if(!empty($request->session()->get('user')['user_id'])){
            // $user = Db::table('user')->where(['user_id' => $request->session()->get('user')['gogo_id']])->first();
            $user2 = Db::connection('shop_db')->table('website_user')->where(['custom_id' => $request->session()->get('user')['gogo_id']])->first();
            $address = Db::connection('shop_db')->table('centralize_user_address')->where(['user_id'=>$user2->id])->get();
            $address = objtoarr($address);
            
            if(!empty($address)){
                foreach($address as $k=>$v){
                    $address[$k]['country_id'] = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['id'=>$v['country_id']])->select('param2')->first()->param2;
                    $address[$k]['true_addr'] = $address[$k]['country_id'];
                    $postal_code = trim($v['postal']);
                    
                    if($v['country_id']==162){
                        #中国行政区域
                        if($v['have_postal_code']==1){
                            #有邮政编码
                            $address[$k]['true_addr'] .= ' '.trim($v['pre_address']).'('.$postal_code.')';
                        }elseif($v['have_postal_code']==2){
                            #无邮政编码
                            if(!empty($v['province'])){
                                $province_code = intval($v['province']);
                                #省份
                                $province = Db::connection('shop_db')->table('centralize_country_areas')->where(['country_id'=>$v['country_id'],'id'=>$province_code])->select('name')->first()->name;
                                $address[$k]['true_addr'] .= ' '.$province;
                            }
                            if(!empty($v['city'])) {
                                $city_code = intval($v['city']);
                                #城市
                                $city = Db::connection('shop_db')->table('centralize_country_areas')->where(['country_id'=>$v['country_id'],'id'=>$city_code])->select('name')->first()->name;
                                $address[$k]['true_addr'] .= ' '.$city;
                            }
                            if(!empty($v['area'])) {
                                $district_code = intval($v['area']);
                                #区域
                                $district = Db::connection('shop_db')->table('centralize_country_areas')->where(['country_id'=>$v['country_id'],'id'=>$district_code])->select('name')->first()->name;
                                $address[$k]['true_addr'] .= ' '.$district;
                            }
                            if(!empty($v['area2'])) {
                                $town_code = intval($v['area2']);
                                #镇街
                                $town = Db::connection('shop_db')->table('centralize_country_areas')->where(['country_id'=>$v['country_id'],'id'=>$town_code])->select('name')->first()->name;
                                $address[$k]['true_addr'] .= ' '.$town;
                            }
                            if(!empty($v['area3'])) {
                                $village_code = intval($v['area3']);
                                #居委
                                $village = Db::connection('shop_db')->table('centralize_country_areas')->where(['country_id'=>$v['country_id'],'id'=>$village_code])->select('name')->first()->name;
                                $address[$k]['true_addr'] .= ' '.$village;
                            }
                        }
                    }
                    else{
                        #海外行政区域
                        $address[$k]['true_addr'] .= ' '.trim($v['pre_address']).'('.$postal_code.')';
                    }
                    
                    $address[$k]['true_addr'] .= ' '.$v['address1'];
                }
            }
        }
        #收货地址-------END
         
        // dd($cached['compact_data']['goods']['domestic_logistics']);
        $cached['compact_data']['address'] = $address;
        $cached['compact_data']['share_uid'] = $share_uid;
        $cached['compact_data']['campaign_id'] = $campaign_id;
        $this->setData($cached);
        
        $this->show_seo('seo_goods', ['name' => $cached['app_prefix_data']['goods']['goods_name']]);
        
        return $this->displayData();
    }
    
    public function showGoods2(Request $request, $goods_id)
    {
        $starttime = time();
        $goods_id = intval($goods_id);
        
        if ($request->routeIs('pc_show_goods') || $request->routeIs('mobile_show_goods')) {
            $sku_id = $this->goods->getSkuId($goods_id);
        } else {
            $sku_id = $goods_id;
            $goods_id = $this->goods->getGoodsId($sku_id);
        }
        
        $goods_info = $this->goods->getById($goods_id);
        if (empty($goods_info)) {
            abort(200, '商品不存在，可能已下架或者被转移');
        }
        $shopId = $goods_info->shop_id;

        // 店铺信息
        $shop_info = [];
        if($shopId>0){
            $shop_info = Db::connection('shop_db')->table('website_user_company')->where(['id'=>$shopId])->first();
            $shop_info = objtoarr($shop_info);
        }

        $goods = $goods_info->toArray();
        
        // 商品sku列表
        $sku_list = $this->goods->getFrontendSkuList($goods_id);
        $base_sku_list = array_values($sku_list);

        // 商品规格列表
        $spec_list = $this->goods->getGoodsSpecList($goods_info);

        if (!empty($spec_list)) {
            #判断当前属性id在商品规格表中是否存在，不存在时，记录“has_sku”为“-1”，默认为“0”代表有
            foreach ($spec_list as $k=>$v) {
                foreach ($v['attr_values'] as $k2=>$v2) {
                    $spec_list[$k]['attr_values'][$k2]['has_sku'] = 0;
                    $has_sku = Db::table('goods_sku')->whereRaw('goods_id='.$goods_id.' and spec_vids like "%'.$v2['attr_vid'].'%"')->first();
                    if (empty($has_sku)) {
                        $spec_list[$k]['attr_values'][$k2]['has_sku'] = -1;
                    }
                }
            }
        }

        // 商品属性列表
        $attr_list = $this->goods->getGoodsAttrList($goods_id);

        // 商品售后服务保障列表
        $contract_ids = [];
        if (!empty($goods['contract_ids'])) {
            foreach ($goods['contract_ids'] as $k=>$v) {
                if ($v == 1) {
                    $contract_ids[] = $k;
                }
            }
        }
        
        // 合同
        $contract_list = '';
        // 包装清单
        $packing_layout = '';
        // 售后保证版式
        $service_layout = '';
        // 店铺常见问题
        $question_list = '';
        // 商品评论
        $comment = null;
        // 商品单位名称
        $unit_name = '';
        // 检查该商品是否加入过对比
        $is_compare = '';

        // 是否收藏商品
        $is_collect = false;
        if ($this->collect->checkIsCollected($this->user_id, 0, 0, $goods_id)) {
            // 已收藏
            $is_collect = true;
        }

        // 是否收藏店铺
        $is_shop_collect = false;
        if ($this->collect->checkIsCollected($this->user_id, 1, $goods['shop_id'])) {
            // 已收藏
            $is_shop_collect = true;
        }

        $goods['goods_button_name'] = null;
        $goods['goods_button_url'] = null;
        $goods['region_code'] = isset($shop_info['shop']['region_code']) ? $shop_info['shop']['region_code'] : '';
        $goods['is_free'] = null;
        $goods['free_set'] = null;
        $goods['limit_sale'] = null;
        $goods['collect_count'] = $goods['collect_num'];
        $goods['shop_name'] = isset($shop_info['shop']['shop_name']) ? $shop_info['shop']['shop_name'] : '';
        $goods['is_supply'] = isset($shop_info['shop']['is_supply']) ? $shop_info['shop']['is_supply'] : '';
        $goods['start_price'] = isset($shop_info['shop']['start_price']) ? $shop_info['shop']['start_price'] : '';
        $goods['button_content'] = isset($shop_info['shop']['button_content']) ? $shop_info['shop']['button_content'] : '';
        $goods['button_url'] = isset($shop_info['shop']['button_url']) ? $shop_info['shop']['button_content'] : '';
        $goods['show_price'] = isset($shop_info['shop']['show_price']) ? $shop_info['shop']['show_price'] : '';
        $goods['show_content'] = isset($shop_info['shop']['show_content']) ? $shop_info['shop']['show_content'] : '';
        $goods['region_name'] = null;
        $goods['base_sku_list'] = $base_sku_list;
        $goods['sku_list'] = $sku_list;
        $goods['price_show'] = [
            'code' => 1 // todo
        ];
        $goods['spec_list'] = $spec_list;
        $goods['attr_list'] = $attr_list;
        $goods['contract_list'] = $contract_list;
        $goods['packing_layout'] = $packing_layout;
        $goods['service_layout'] = $service_layout;
        $goods['question_list'] = $question_list;
        $goods['comment_count'] = $goods['comment_num'];
        $goods['comment'] = $comment;
        $goods['goods_price_format'] = '￥'.$goods['goods_price'];
        $goods['unit_name'] = $unit_name;
        $goods['is_compare'] = $is_compare;
        $goods['is_collect'] = $is_collect;
        $goods['shop_collect'] = $is_shop_collect;

        // todo 暂时 等待平台后台添加商品配置信息后打开
        $goods['show_sale_number'] = sysconf('goods_show_sale_number'); // 是否显示商品销量

        // 商品SKU信息
        if (empty($shop_info)) {
            $shop_info['shop'] = [
                'is_supply'=>'',
                'show_price'=>'',
                'show_content'=>'',
                'button_content'=>'',
                'button_url'=>'',
                'start_price'=>'',
            ];
        } else {
            if ($shopId>0) {
                $shop_info['shop'] = [
                    'is_supply'=>'',
                    'show_price'=>'',
                    'show_content'=>'',
                    'button_content'=>'',
                    'button_url'=>'',
                    'start_price'=>'',
                ];
            }
        }

        $sku = $this->goodsSku->getGoodsSkuInfo($sku_id, $goods_info, $shop_info['shop']);

        $goods['other_shop'] = json_decode($goods['other_shop'], true);
        $sku_images = Db::table('goods_image')->where(['goods_id'=>$goods['goods_id']])->select(['path'])->get();
        $sku_images = objtoarr($sku_images);

        $sku['sku_images'] = [];
        foreach ($sku_images as $k2=>$v2) {
            for ($i=0;$i<3;$i++) {
                $sku['sku_images'][$k2][$i] = $v2['path'];
            }
        }

        // 是否微信端访问
        $is_weixin = is_weixin();

        $shop_goods_count = $this->shop->getShopGoodsCount($shopId);
        $shop_collect_count = isset($shop_info['shop']['collect_num']) ? $shop_info['shop']['collect_num'] : 0;

        // 店内排行榜-销售量
        $sale_top_list = 0;
        $collect_top_list = 0;
        if ($goods['shop_id']>0) {
            $sale_top_list = '';
            // 店内排行榜-收藏数
            $collect_top_list = '';
        }

        $im_enable = 1; // todo

        $comment_count = '0';
        $collect_count = '0';
        $show_collect_count = sysconf('goods_info_show_collect'); // 是否显示商品收藏人气;

        // 红包列表
        $bonus_list = [];
//        $bonus_list = $this->bonus->getGoodsDetailBonusList($goods_id, $goods['shop_id'], $this->user_id);

        $rank_prices = null;
        $rank_message = '请登录，确认是否享受优惠';
        $show_freight_region = 1;
        $show_stock = '1';

        // 自提点
        $condition = [
            'where' => [
                ['is_show', 1],
                ['shop_id', $goods_info->shop_id]
            ],
            'limit' => 0,
            'sortname' => 'pickup_id',
            'sortorder' => 'desc',
        ];
        list($pickup, $self_pickup_total) = $this->selfPickup->getList($condition);

        // 商品单位列表
        $unit_list = ['' => '-- 请选择 --'];
        $unitList = [];
        if (!empty($unitList)) {
            foreach ($unitList as $item) {
                $unit_list[$item->unit_id] = $item->unit_name;
            }
        }

        // 分享
        $share = [
            'seo_goods_title' => '商品名称-网站名称',
            'seo_goods_keywords' => '【商品名称】-网站名称',
            'seo_goods_discription' => ''
        ];

        /* PC端独有 START */
        // 店铺内分类
        $where = [];
        $where[] = ['shop_id', $goods_info->shop_id];
        $condition = [
            'where' => $where,
            'sortname' => 'cat_sort',
            'sortorder' => 'asc',
        ];
        list($shop_category_list, $total) = $this->shopCategory->getList($condition, '', true);

        // 商品分类列表
        $goods_category = Category::where('is_show', 1)->select(['cat_id','cat_name','parent_id', 'cat_level'])->orderBy('cat_sort', 'asc')->get();

        // 分类面包屑导航
        $navigate_cat = [];
        $navigate_cat_type = 1;

        $region_code = isset($shop_info['shop']['region_code']) ? $shop_info['shop']['region_code'] : '';
        $lrw_last_region_code = session('LRW_LAST_REGION_CODE');
        if (!empty($lrw_last_region_code)) {
            $lrw_last_region_code_arr = unserialize(substr($lrw_last_region_code, 64));
//            dd($lrw_last_region_code_arr);
            $region_code = $lrw_last_region_code_arr[1];
        }

        #=== 2024/01/18 根据商品信息调整 START ===
        #1、根据价格区间来进行默认价钱
        $low_price = 0;
        if (isset($sku['sku_prices']['price'][0])) {
            $low_price = $sku['sku_prices']['price'][0];
            foreach ($sku['sku_prices']['price'] as $k=>$v) {
                if ($low_price>$v) {
                    $low_price = $v;
                }
            }
        } else {
            $low_price = $sku['sku_prices']['price'];
        }

        //全部规格区间
        $sku_info = Db::table('goods_sku')->where(['goods_id'=>$goods['goods_id']])->get();
        $sku_info = objtoarr($sku_info);
        foreach ($sku_info as $k=>$v) {
            $sku_info[$k]['sku_prices'] = json_decode($v['sku_prices'], true);
            foreach ($sku_info[$k]['sku_prices']['unit'] as $k2=>$v2) {
                $sku_info[$k]['sku_prices']['unit'][$k2] = Db::connection('shop_db')->table('unit')->where(['code_value'=>$v2])->first()->code_name;
                $sku_info[$k]['sku_prices']['currency'][$k2] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$sku_info[$k]['sku_prices']['currency'][$k2]])->first()->currency_symbol_standard;
            }
        }

        $goods['currency'] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$sku['sku_prices']['currency'][0]])->first()->currency_symbol_standard;
        if ($shopId==0) {
            $goods['goods_price'] = $low_price;
        } else {
            $goods['goods_price'] = $sku['sku_prices']['price'][0];
        }
        #1.1、获取分类名称
        $goods['cat_name'] = '';
        if ($goods['cat_id']>0) {
            $goods['cat_name'] = Db::table('category')->where(['cat_id'=>$goods['cat_id']])->first()->cat_name;
        }
        $goods['logi_id'] = 0;
        if (!empty($goods['crossb_cate2'])) {
            $goods['logi_id'] = $goods['crossb_cate2'];
            $goods['logi_name'] = Db::table('category')->where(['cat_id'=>$goods['crossb_cate2']])->first()->cat_name;
        } elseif (!empty($goods['crossb_cate1'])) {
            $goods['logi_id'] = $goods['crossb_cate1'];
            $goods['logi_name'] = Db::table('category')->where(['cat_id'=>$goods['crossb_cate1']])->first()->cat_name;
        }

        #国家
        $country = Db::connection('shop_db')->table('centralize_diycountry_content')->whereRaw('pid=5 and id<>162')->get();
        $country = objtoarr($country);

        if ($goods['shop_id']>0 && empty($goods['drug_id'])) {

            #1.1.2、减免...
            if (!empty($goods['reduction_content'])) {
                $goods['reduction_content'] = json_decode($goods['reduction_content'], true);
                foreach ($goods['reduction_content']['preferential_blong'] as $k=>$v) {
                    $reduction_rule = Db::table('ssl_reduction_rule')->where(['id'=>$goods['reduction_content']['type'][$k]])->first();
                    $reduction_rule = objtoarr($reduction_rule);
                    $goods['reduction_content']['type_name'][$k] = $reduction_rule['name'];
                    $goods['reduction_content']['content'][$k] = json_decode($reduction_rule['content'], true);
                }
                $goods['reduction_content']['currency1'] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$goods['reduction_content']['currency1']])->first()->currency_symbol_standard;
                $goods['reduction_content']['currency2'] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$goods['reduction_content']['currency2']])->first()->currency_symbol_standard;
            }


            #1.1.2-2、随赠...
            if (!empty($goods['gift_content'])) {
                $goods['gift_content'] = json_decode($goods['gift_content'], true);
                $goods['gift_content']['points_currency'] = Db::connection('shop_db')->table('centralize_currency')->where(['id' => $goods['gift_content']['points_currency']])->first()->currency_symbol_standard;
                $goods['gift_content']['coupon_currency'] = Db::connection('shop_db')->table('centralize_currency')->where(['id' => $goods['gift_content']['coupon_currency']])->first()->currency_symbol_standard;
            }

            #1.1.2-3、价格未含
            if (!empty($goods['noinclude_content'])) {
                $goods['noinclude_content'] = json_decode($goods['noinclude_content'], true);
                $goods['noinclude_content']['currency'] = Db::connection('shop_db')->table('centralize_currency')->where(['id' => $goods['noinclude_content']['currency']])->first()->currency_symbol_standard;
            }

            #1.1.2-4、潜在收费
            if (!empty($goods['potential_content'])) {
                $goods['potential_content'] = json_decode($goods['potential_content'], true);
                $goods['potential_content']['currency'] = Db::connection('shop_db')->table('centralize_currency')->where(['id' => $goods['potential_content']['currency']])->first()->currency_symbol_standard;
                $goods['potential_content']['currency2'] = Db::connection('shop_db')->table('centralize_currency')->where(['id' => $goods['potential_content']['currency2']])->first()->currency_symbol_standard;
            }

            #1.1.2-5、其他费用
            if (!empty($goods['otherfees_content'])) {
                $goods['otherfees_content'] = json_decode($goods['otherfees_content'], true);
            }

            #1.1.2-6、物流支撑
            $goods['shipping_country_name'] = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['id'=>$goods['shipping_country']])->first()->param2;
            if ($goods['service_type']==1) {
                #国内配送
                $goods['domestic_logistics'] = json_decode($goods['domestic_logistics'], true);
                $goods['domestic_logistics']['areas'] = [];
                foreach ($goods['domestic_logistics']['area1'] as $k=>$v) {
                    $area1 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$v])->first()->code_name;
                    $area2 = '';
                    $area3 = '';
                    $area4 = '';
                    $area5 = '';
                    $area6 = '';
                    if (isset($goods['domestic_logistics']['area2'][$k])) {
                        $area2 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$goods['domestic_logistics']['area2'][$k]])->first()->code_name;
                    }
                    if (isset($goods['domestic_logistics']['area3'][$k])) {
                        $area3 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$goods['domestic_logistics']['area3'][$k]])->first()->code_name;
                    }
                    if (isset($goods['domestic_logistics']['area4'][$k])) {
                        $area4 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$goods['domestic_logistics']['area4'][$k]])->first()->code_name;
                    }
                    if (isset($goods['domestic_logistics']['area5'][$k])) {
                        $area5 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$goods['domestic_logistics']['area5'][$k]])->first()->code_name;
                    }
                    if (isset($goods['domestic_logistics']['area6'][$k])) {
                        $area6 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$goods['domestic_logistics']['area6']])->first()->code_name;
                    }
                    array_push($goods['domestic_logistics']['areas'], ['area1'=>$area1,'area2'=>$area2,'area3'=>$area3,'area4'=>$area4,'area5'=>$area5,'area6'=>$area6]);
                }
            } 
            elseif ($goods['service_type']==2) {
                #跨境配送
                if ($goods['gather_method']==2 && $goods['support_export']==1) {
                    #自主集运+支持跨境配送
                    $goods['gather_countrys'] = json_decode($goods['gather_countrys'], true);
                    $goods['gather_countrys']['areas'] = [];
                    foreach ($goods['gather_countrys']['gather_zhou'] as $k=>$v) {
                        $area1 = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['id'=>$v])->first();
                        $area1 = objtoarr($area1);
                        $area2 = [];
                        $area3 = [];
                        if (isset($goods['gather_countrys']['gather_country'][$k])) {
                            $area2 = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['id'=>$goods['gather_countrys']['gather_country'][$k]])->first();
                            $area2 = objtoarr($area2);
                        }
                        if (isset($goods['gather_countrys']['gather_postal'][$k])) {
                            $area3 = Db::connection('shop_db')->table('centralize_adminstrative_area')->whereRaw('id in ('.$goods['gather_countrys']['gather_postal'][$k].')')->get();
                            $area3 = objtoarr($area3);
                        }
                        array_push($goods['gather_countrys']['areas'], ['area1'=>$area1,'area2'=>$area2,'area3'=>$area3]);
                    }

                    #发货城市
                    $goods['shipping_country_info'] = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['id'=>$goods['shipping_country']])->first();
                    $goods['shipping_country_info'] = objtoarr($goods['shipping_country_info']);
                    $goods['shipping_areas'] = json_decode($goods['areas'], true);
                    foreach ($goods['shipping_areas'] as $k=>$v) {
                        $goods['shipping_areas'][$k] = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$v])->first();
                        $goods['shipping_areas'][$k] = objtoarr($goods['shipping_areas'][$k]);
                    }

                    #支持集运国家
                    $country = [];
                    if (isset($goods['gather_countrys']['gather_country'][0])) {
                        foreach ($goods['gather_countrys']['gather_country'] as $k=>$v) {
                            $c2 = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['id'=>$v])->first();
                            $c2 = objtoarr($c2);
                            array_push($country, $c2);
                        }
                    }
                }
            }

            #1.1.2-7、商品促销
            if (!empty($goods['activity_info'])) {
                $goods['activity_info'] = explode(',', $goods['activity_info']);
                foreach ($goods['activity_info'] as $k=>$v) {
                    $goods['activity_info'][$k] = Db::table('ssl_activity')->where('id', $v)->first();
                    $goods['activity_info'][$k] = objtoarr($goods['activity_info'][$k]);
                }
            }

            #1.1.2-8、商品参数
            if (!empty($goods['spec_info'])) {
                $goods['spec_info'] = json_decode($goods['spec_info'], true);
            }

            #1.1.2-9、商品详情
            if (!empty($goods['pc_desc'])) {
                $goods['pc_desc'] = json_decode($goods['pc_desc'], true);
                $goods['pc_desc'] = str_replace('src="/uploads', 'src="//rte.gogo198.cn/uploads', $goods['pc_desc']);
                $goods['pc_desc'] = str_replace('src="/uploads', 'src="//dtc.gogo198.net/uploads', $goods['pc_desc']);
            }

            #1.1.3、商品品牌
            if ($goods['brand_type']==1) {
                #有牌
                if ($goods['brand_type2']==0) {
                    #自有品牌
                    $goods['goods_name'] = $goods['brand_name'].'的'.$goods['goods_name'];
                } elseif ($goods['brand_type2']==1) {
                    #知名品牌
                    $brand_name = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['pid'=>8,'id'=>$goods['brand_id']])->first()->param1;
                    $goods['goods_name'] = $brand_name.'的'.$goods['goods_name'];
                }
            }

            #1.1.4、卖家说明规则
            $goods['rule'] = Db::table('description_rule')->where(['id'=>$goods['rule_id']])->first();
            $goods['rule'] = objtoarr($goods['rule']);
            #序言
            if ($goods['rule']['is_preamble']==1) {
                $goods['rule']['preamble_con'] = json_decode($goods['rule']['preamble_con'], true);
            }
            $goods['rule']['content'] = json_decode($goods['rule']['content'], true);

            #整理树形结构代码
            if (isset($goods['rule']['type'])) {
                if ($goods['rule']['type']==1) {
                    $first = [];
                    $second = [];
                    foreach ($goods['rule']['content'] as $k=>$v) {
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
                    $goods['rule']['content2'] = $first;
                }
            }

            #1.1.5、商品参数-制造企业
            if (!empty($goods['manufacture'])) {
                $goods['manufacture'] = json_decode($goods['manufacture'], true);
                if (isset($goods['manufacture']['country'])) {
                    $goods['manufacture']['country_name'] = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['id'=>$goods['manufacture']['country']])->first()->param2;
                }
                if (isset($goods['manufacture']['area1'])) {
                    $goods['manufacture']['area1_name'] = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$goods['manufacture']['area1']])->first()->code_name;
                }
                if (isset($goods['manufacture']['area2'])) {
                    $goods['manufacture']['area2_name'] = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$goods['manufacture']['area2']])->first()->code_name;
                }
                if (isset($goods['manufacture']['area3'])) {
                    $goods['manufacture']['area3_name'] = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$goods['manufacture']['area3']])->first()->code_name;
                }
                if (isset($goods['manufacture']['area4'])) {
                    $goods['manufacture']['area4_name'] = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$goods['manufacture']['area4']])->first()->code_name;
                }
                if (isset($goods['manufacture']['area5'])) {
                    $goods['manufacture']['area5_name'] = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$goods['manufacture']['area5']])->first()->code_name;
                }
                if (isset($goods['manufacture']['area6'])) {
                    $goods['manufacture']['area6_name'] = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$goods['manufacture']['area6']])->first()->code_name;
                }
            }
            #1.1.6、商品参数-销售企业
            if (!empty($goods['sales'])) {
                $goods['sales'] = json_decode($goods['sales'], true);
                if (isset($goods['sales']['country'])) {
                    $goods['sales']['country_name'] = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['id' => $goods['sales']['country']])->first()->param2;
                }
                if (isset($goods['sales']['area1'])) {
                    $goods['sales']['area1_name'] = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$goods['sales']['area1']])->first()->code_name;
                }
                if (isset($goods['sales']['area2'])) {
                    $goods['sales']['area2_name'] = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$goods['sales']['area2']])->first()->code_name;
                }
                if (isset($goods['sales']['area3'])) {
                    $goods['sales']['area3_name'] = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$goods['sales']['area3']])->first()->code_name;
                }
                if (isset($goods['sales']['area4'])) {
                    $goods['sales']['area4_name'] = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$goods['sales']['area4']])->first()->code_name;
                }
                if (isset($goods['sales']['area5'])) {
                    $goods['sales']['area5_name'] = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$goods['sales']['area5']])->first()->code_name;
                }
                if (isset($goods['sales']['area6'])) {
                    $goods['sales']['area6_name'] = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$goods['sales']['area6']])->first()->code_name;
                }
            }
            #1.1.7、商品参数-外贸企业
            if (!empty($goods['foreign'])) {
                $goods['foreign'] = json_decode($goods['foreign'], true);
                if (isset($goods['foreign']['country'])) {
                    $goods['foreign']['country_name'] = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['id' => $goods['foreign']['country']])->first()->param2;
                }
                if (isset($goods['foreign']['area1'])) {
                    $goods['foreign']['area1_name'] = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$goods['foreign']['area1']])->first()->code_name;
                }
                if (isset($goods['foreign']['area2'])) {
                    $goods['foreign']['area2_name'] = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$goods['foreign']['area2']])->first()->code_name;
                }
                if (isset($goods['foreign']['area3'])) {
                    $goods['foreign']['area3_name'] = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$goods['foreign']['area3']])->first()->code_name;
                }
                if (isset($goods['foreign']['area4'])) {
                    $goods['foreign']['area4_name'] = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$goods['foreign']['area4']])->first()->code_name;
                }
                if (isset($goods['foreign']['area5'])) {
                    $goods['foreign']['area5_name'] = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$goods['foreign']['area5']])->first()->code_name;
                }
                if (isset($goods['foreign']['area6'])) {
                    $goods['foreign']['area6_name'] = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$goods['foreign']['area6']])->first()->code_name;
                }
            }
            #1.1.8、商品参数-有效期限
            if (!empty($goods['effective'])) {
                $goods['effective'] = json_decode($goods['effective'], true);
            }
            #1.1.9、商品参数-贮存条件
            if (!empty($goods['store'])) {
                $goods['store'] = json_decode($goods['store'], true);
            }
            #1.2.1、商品参数-产品包装
            if (!empty($goods['packing'])) {
                $goods['packing'] = json_decode($goods['packing'], true);
                if (!empty($goods['packing']['packing_container'])) {
                    $goods['packing']['packing_container_name'] = Db::connection('shop_db')->table('packing_category')->where(['id'=>$goods['packing']['packing_container'],'type'=>1])->first()->name;
                }
                if (!empty($goods['packing']['packing_material'])) {
                    $goods['packing']['packing_material_name'] = Db::connection('shop_db')->table('packing_category')->where(['id'=>$goods['packing']['packing_material'],'type'=>2])->first()->name;
                }
            }
        }

        #10、无规格下解析
        if ($goods['have_specs']==2) {
            #无规格
            $goods['nospecs'] = json_decode($goods['nospecs'], true);
            foreach ($goods['nospecs']['unit'] as $k=>$v) {
                $goods['nospecs']['unit'][$k] = Db::connection('shop_db')->table('unit')->where('code_value', $v)->first()->code_name;
                $goods['nospecs']['currency'][$k] = Db::connection('shop_db')->table('centralize_currency')->where('id', $goods['nospecs']['currency'][$k])->first()->currency_symbol_standard;
            }
            foreach ($sku['sku_prices']['unit'] as $k=>$v) {
                $sku['sku_prices']['unit'][$k] = Db::connection('shop_db')->table('unit')->where('code_value', $v)->first()->code_name;
                $sku['sku_prices']['currency'][$k] = Db::connection('shop_db')->table('centralize_currency')->where('id', $sku['sku_prices']['currency'][$k])->first()->currency_symbol_standard;
            }
        }
        else {
            #有规格
            foreach ($sku['sku_prices']['unit'] as $k=>$v) {
                $sku['sku_prices']['unit'][$k] = Db::connection('shop_db')->table('unit')->where('code_value', $v)->first()->code_name;
                $sku['sku_prices']['currency'][$k] = Db::connection('shop_db')->table('centralize_currency')->where('id', $sku['sku_prices']['currency'][$k])->first()->currency_symbol_standard;
            }
        }

        #=== 2024/01/18 根据商品信息调整 END ===

        #获取配置信息
        $website = get_website();
        $page_info = get_pageinfo('/goods');
        $website['background'] = $page_info['content']['background'];
        $website['content'] = $page_info['content']['content'];
        $website['fontcolor'] = $page_info['content']['fontcolor'];
        $website['agentLink'] = $page_info['content']['agent_link'];

        #收货地址-----START
        $address = [];
        if (!empty($request->session()->get('user')['user_id']) && 1>2) {
            $user = Db::table('user')->where(['user_id' => $request->session()->get('user')['user_id']])->first();
            $user2 = Db::connection('shop_db')->table('website_user')->where(['custom_id' => $user->gogo_id])->first();
            $address = Db::connection('shop_db')->table('centralize_user_address')->where(['user_id'=>$user2->id])->get();
            $address = objtoarr($address);
            if (!empty($address)) {
                foreach ($address as $k=>$v) {
                    $address[$k]['country_id'] = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['id'=>$v['country_id']])->first()->param2;
                    $address[$k]['true_addr'] = $address[$k]['country_id'];
                    if ($v['province']>0) {
                        $address[$k]['province'] = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$v['province']])->first()->code_name;
                        $address[$k]['true_addr'] .= $address[$k]['province'];
                    }
                    if ($v['city']>0) {
                        $address[$k]['city'] = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id' => $v['city']])->first()->code_name;
                        $address[$k]['true_addr'] .= $address[$k]['city'];
                    }
                    if ($v['area']>0) {
                        $address[$k]['area'] = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id' => $v['area']])->first()->code_name;
                        $address[$k]['true_addr'] .= $address[$k]['area'];
                    }
                    $address[$k]['true_addr'] .= $address[$k]['address1'];
                }
            }
        }
        #收货地址-------END

        #时段判断
        $timeInterval = Db::table('time_interval')->get();
        $timeInterval = objtoarr($timeInterval);
        $time_interval = '北京时间';
        foreach ($timeInterval as $k=>$v) {
            $typeName='';
            if ($v['type']==1) {
                $typeName = '当日';
            } elseif ($v['type']==2) {
                $typeName = '次日';
            }
            $timeInterval[$k]['typeName'] = $typeName;
        }

        #更多服务
        if ($goods['drug_id']>0) {
            $drug_shelf = Db::connection('medical_db')->table('drug_shelf')->where(['drug_id'=>$goods['drug_id']])->first();
            $drug_shelf = objtoarr($drug_shelf);
            $services = Db::table('goods_services')->whereRaw('find_in_set(id,?)', [$drug_shelf['services_id']])->get();
            $services = objtoarr($services);
        } else {
            $services = Db::table('goods_services')->where(['company_id'=>0])->get();
            $services = objtoarr($services);
        }
        $services_money = 0;
        foreach ($services as $k=>$v) {
            $services[$k]['currency'] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$v['currency']])->first()->currency_symbol_standard;
            if ($v['is_select']==1) {
                $services_money += $v['price'];
            }
        }

        #当前页面的链接
        $origin_page = '/login.html?open=4&param2='.base64_encode('/goods-'.$goods['goods_id'].'.html');

        /* PC端独有 END */
        $compact = compact(
            'website',
            'address',
            'goods',
            'origin_page',
            'time_interval',
            'timeInterval',
            'services',
            'services_money',
            'country',
            'sku',
            'is_weixin',
            'shop_goods_count',
            'shop_collect_count',
            'sale_top_list',
            'collect_top_list',
            'im_enable',
            'shop_info',
            'comment_count',
            'collect_count',
            'show_collect_count',
            'bonus_list',
            'rank_prices',
            'rank_message',
            'show_freight_region',
            'show_stock',
            'region_code',
            'pickup',
            'unit_list',
            'share',
            'shop_category_list',
            'goods_category',
            'navigate_cat',
            'navigate_cat_type',
            'sku_info' // PC端独有
        );
        $webData = []; // web端（pc、mobile）数据对象

        $data = [
            'app_prefix_data' => [
                'goods' => $goods,
                'sku' => $sku,
                'is_weixin' => is_weixin(),
                'shop_goods_count' => $shop_goods_count,
                'shop_collect_count' => $shop_collect_count,
                'sale_top_list' => $sale_top_list,
                'collect_top_list' => $collect_top_list,
                'im_enable' => $im_enable,
                'shop_info' => $shop_info,
                'comment_count' => $comment_count,
                'collect_count' => $collect_count,
                'show_collect_count' => $show_collect_count,
                'bonus_list' => $bonus_list,
                'rank_prices' => $rank_prices,
                'rank_message' => $rank_message,
                'show_freight_region' => $show_freight_region,
                'show_stock' => $show_stock,
                'region_code' => $region_code,
                'pickup' => $pickup->toArray(),
                'unit_list' => $unit_list,
                'share' => $share
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'goods.show_goods'
        ];

        if(is_login()) {
            // 记录浏览历史
            $this->goodsHistory->addHistoryLog(is_login(), $goods_info);
        }
        Goods::where('goods_id', $goods_id)->increment('click_count', 1); // 统计点击数+1
        
        $this->setData($data); // 设置数据
        $endtime = time();
        dd($endtime - $starttime);
        $this->show_seo('seo_goods', ['name'=>$goods_info->goods_name]);
        
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }#685-1287

    //自定义请求方法=====================================================start

    #加入选购清单
    public function join_cart(Request $request)
    {
        $data = $request->except(['_token']);
        
        #判断收货方式内容====start
        if(!isset($data['selectDeliveryMethod'])){
            return Response()->json(['code'=>-1,'msg'=>'请选择收货方式']);
        }
        $delivery_method = intval($data['selectDeliveryMethod']);
        
        $gather_method = $line_id = 0;
        if($delivery_method==2){
            #海外收货
            if(!isset($data['selectGatherMethod'])){
                return Response()->json(['code'=>-1,'msg'=>'请选择集运方式']);
            }
            $gather_method = intval($data['selectGatherMethod']);
            
            if($gather_method==1){
                #平台集运
                if(!isset($data['selectLine'])){
                    return Response()->json(['code'=>-1,'msg'=>'请选择线路']);
                }
                $line_id = intval($data['selectLine']);
            }
        }
        
        if(!isset($data['address_id'])){
            return Response()->json(['code'=>-1,'msg'=>'请选择收货地址']);
        }
        $address_id = intval($data['address_id']);
        #判断收货方式内容====end
        
        //{
        // 	"data[buy_attr][0][attr_id]": "58_983564",
        // 	"data[buy_attr][0][spec_id]": "19_21",
        // 	"data[buy_attr][0][attr_name]": "颜色分类：灰汁团，尺码：M",
        // 	"data[buy_attr][0][buy_num]": "0",
        // 	"data[buy_attr][0][now_gprice]": "",
        // 	"data[id]": "56825",
        // 	"data[services_attr][0][service_id]": "2",
        // 	"data[services_attr][1][service_id]": "12",
        // 	"data[services_attr][2][service_id]": "13",
        // 	"_token": "2bmWs36g1nMLS7BTCKyygRWpkGaBr88RaR0zT2a6",
        // 	"share_uid": "0",
        // 	"campaign_id": "0"
        // }
        
        if(isset($data['is_default'])){
            #在主题页直接点击“加入选购”
            $sku_info2 = Db::table('goods_sku')->where(['sku_id'=>$data['sku_id']])->first();
            $sku_info2->sku_prices = json_decode($sku_info2->sku_prices,true);
            
            $data['data'] = [
                'id'=>$data['goods_id'],
                'buy_attr'=>[
                    [
                        'attr_id' => $sku_info2->spec_vids,
                        'spec_id' => $sku_info2->spec_ids,
                        'attr_name' => $sku_info2->spec_names,
                        'buy_num' => $sku_info2->sku_prices['start_num'][0],
                        'now_gprice' => $sku_info2->sku_prices['start_num'][0] * $sku_info2->sku_prices['price'][0],
                    ]
                ]
            ];
        }
        
        if (!isset($data['data']['buy_attr'])) {
            return Response()->json(['code'=>-1,'msg'=>'请选择商品规格']);
        }

        #1、获取商品信息
        $goods = Db::table('goods')->where(['goods_id'=>intval($data['data']['id'])])->first();
        $goods = objtoarr($goods);
        
        #2、整理规格的数量+总价
        $content = ['good_id'=>intval($data['data']['id']),'shop_id'=>$goods['shop_id'],'good_num'=>0,'good_price'=>0,'buy_attr'=>$data['data']['buy_attr']];
        foreach ($data['data']['buy_attr'] as $k=>$v) {
            $content['good_num'] += $v['buy_num'];
            $content['good_price'] += $v['now_gprice'];
        }
        
        if (1>2) {
            #3、其他费用
            $goods['otherfee_content'] = json_decode($goods['otherfee_content'], true);
            $goods['otherfee_total'] = 0;
            if (empty($goods['otherfee_content']['currency'][0])) {
                $goods['otherfee_currency'] = 'CNY';
            } else {
                $goods['otherfee_currency'] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$goods['otherfee_content']['currency'][0]])->first()->currency_symbol_standard;
                foreach ($goods['otherfee_content']['standard'] as $k=>$v) {
                    if ($v==1) {
                        #按订单数量(1张)
                        $goods['otherfee_total'] += $goods['otherfee_content']['price'][$k];
                        $goods['otherfee_content']['otherfee_standard_name'][$k] = '按订单数量';
                    } elseif ($v==2) {
                        #按包裹数量（1个）
                        $goods['otherfee_total'] += $goods['otherfee_content']['price'][$k];
                        $goods['otherfee_content']['otherfee_standard_name'][$k] = '按包裹数量';
                    } elseif ($v==3) {
                        #按商品数量
                        $goods['otherfee_content']['price'][$k] = str_replace(',', '', number_format(intval($content['good_num']) * $goods['otherfee_content']['price'][$k], 2));
                        $goods['otherfee_total'] += $goods['otherfee_content']['price'][$k];
                        $goods['otherfee_content']['otherfee_standard_name'][$k] = '按商品数量';
                    } elseif ($v==4) {
                        #按服务次数（1次）
                        $goods['otherfee_total'] += $goods['otherfee_content']['price'][$k];
                        $goods['otherfee_content']['otherfee_standard_name'][$k] = '按服务次数';
                    } elseif ($v==5) {
                        #按商品总价比率
                        $goods['otherfee_content']['price'][$k] = str_replace(',', '', number_format($content['good_price'] * $goods['otherfee_content']['price'][$k], 2));
                        $goods['otherfee_total'] += $goods['otherfee_content']['price'][$k];
                        $goods['otherfee_content']['otherfee_standard_name'][$k] = '按商品总价比率';
                    }
                }
            }
            $content['other_fee'] = ['otherfee_content'=>$goods['otherfee_content'],'otherfee_total'=>$goods['otherfee_total'],'otherfee_currency'=>$goods['otherfee_currency']];

            #4、减免优惠
            $content['reduction_money'] = 0;
            $content['prefe_reduction'] = [];
            if (isset($data['prefe_reduction'])) {
                $content['prefe_reduction'] = $data['prefe_reduction'];
                foreach ($data['prefe_reduction'] as $k=>$v) {
                    $content['reduction_money'] += $v['reduction_price'];
                }
            }

            #5、随赠优惠
            $content['gift_money'] = 0;
            $prefe_gift = [];
            if (isset($data['prefe_gift'])) {
                foreach ($data['prefe_gift'] as $k => $v) {
                    if ($v['type'] == 1) {
                        #积分
                        $content['gift_money'] += $v['points_send'];
                        array_push($prefe_gift, ['strict' => $v['strict'], 'type' => $v['type'], 'operaer' => $v['operaer'], 'points_type' => $v['points_type'], 'points_currency' => $v['points_currency'],'points_money'=>$v['points_money'],'points_send'=>$v['points_send']]);
                    } elseif ($v['type'] == 2) {
                        #卡券
                        $content['gift_money'] += $v['coupon_money'] * $v['coupon_num'];
                        array_push($prefe_gift, ['strict' => $v['strict'], 'type' => $v['type'], 'operaer' => $v['operaer'], 'coupon_num' => $v['coupon_num'], 'coupon_currency' => $v['coupon_currency'],'coupon_money'=>$v['coupon_money']]);
                    } elseif ($v['type'] == 3) {
                        #随赠(不需要计算)
                        $name = '';
                        if ($v['accgift_type'] == 1) {
                            $name = '虚拟';
                        } elseif ($v['accgift_type'] == 2) {
                            $name = '服务';
                        } elseif ($v['accgift_type'] == 3) {
                            $name = '实物';
                        }
                        array_push($prefe_gift, ['strict' => $v['strict'], 'type' => $v['type'], 'accgift_type' => $v['accgift_type'], 'accgift_typeName' => $name, 'accgift_content' => $v['accgift_content'], 'accgift_num' => $v['accgift_num']]);
                    }
                }
            }
            $content['prefe_gift'] = $prefe_gift;
            #6、实付费用
            $content['true_price'] = ($content['good_price'] + $content['other_fee']['otherfee_total']) - ($content['reduction_money'] + $content['gift_money']);

            #6.1、平台监管文件
            $file = [];
            if (isset($data['data']['supervise_file'])) {
                foreach ($data['data']['supervise_file'] as $k=>$v) {
                    array_push($file, $v['file']);
                }
            }
            $content['file'] = $file;

            #6.2、更多服务
            $content['services'] = $data['data']['services_attr'];
        }

        #7、插入购物车
        $user = Db::connection('shop_db')->table('website_user')->where(['custom_id'=>session('user.gogo_id')])->first();
        $shop_id = '';
        if ($goods['shop_id']>0) {
            $shop_id = $goods['shop_id'];
        } else {
            if (!empty($goods['other_shop'])) {
                $goods['other_shop'] = json_decode($goods['other_shop'], true);
                $shop_id = 'o_'.$goods['other_shop']['shopId'];
            }
        }
        
        #8、生成订购单编号
        $ordersn = get_ordersn(1);

        #9、判断当前“已选购，未订购”的购物车有无此商品
        $ishave = Db::table('cart')->where(['user_id'=>$user->id,'goods_id'=>$goods['goods_id'],'is_show'=>0,'is_buy'=>0,'delivery_method'=>$delivery_method,'gather_method'=>$gather_method,'line_id'=>$line_id,'address_id'=>$address_id])->first();
        $ishave = objtoarr($ishave);

        if (empty($ishave)) {
            #购物车不存在此商品
            $cart_id = Db::table('cart')->insertGetId([
                'user_id'=>$user->id,
                'goods_id'=>$goods['goods_id'],
                'ordersn'=>$ordersn,
                'shop_id'=>$shop_id,
                'selected'=>1,
                'delivery_method'=>$delivery_method,
                'gather_method'=>$gather_method,
                'line_id'=>$line_id,
                'address_id'=>$address_id,
//                #减免优惠
//                'reduction_money'=>$content['reduction_money'],
//                'prefe_reduction'=>json_encode($content['prefe_reduction'],true),
//                #随赠优惠
//                'gift_money'=>$content['gift_money'],
//                'prefe_gift'=>json_encode($content['prefe_gift'],true),
//                #其他费用
//                'otherfee_content'=>json_encode($content['other_fee']['otherfee_content'],true),
//                'otherfee_currency'=>$content['other_fee']['otherfee_currency'],
//                'otherfee_total'=>$content['other_fee']['otherfee_total'],
//                #监管文件
//                'file'=>json_encode($content['file'],true),
                #更多服务
//            'services'=>json_encode($content['services'],true),
//            'services'=>'',
                'created_at'=>time()
            ]);

            foreach ($content['buy_attr'] as $k=>$v) {
                if (isset($v['attr_id'])) {
                    #有规格
                    $attr_id = implode('|', array_reverse(explode('_', $v['attr_id'])));
                    $sku = Db::table('goods_sku')->where(['goods_id'=>$content['good_id'],'spec_vids'=>$attr_id])->first();
                    if (empty($sku)) {
                        $attr_id = implode('|', array_reverse(explode('|', $attr_id)));
                        $sku = Db::table('goods_sku')->where(['goods_id'=>$content['good_id'],'spec_vids'=>$attr_id])->first();
                    }
                } else {
                    #无规格
                    $sku = Db::table('goods_sku')->where(['goods_id'=>$goods['goods_id']])->first();
                }
                $sku = objtoarr($sku);
                $sku['sku_prices'] = json_decode($sku['sku_prices'], true);

                //获取商品可售库存
                if($goods['shop_id']>0){
                    $post = [
                        'goods_id' => $goods['goods_id'],
                        'sku_id'   => $sku['sku_id'],
                        'shop_id'  => $goods['shop_id'],
                        'wid'      => $goods['wid'],
                        'goods_type'=>$goods['goods_type']
                    ];
                    
                    $skunum = httpRequest('https://shop.gogo198.cn/collect_website/public/?s=api/func/get_goods_num', $post);
                    
                    #商品&规格可售库存
                    $sku['sku_prices']['goods_number'] = $skunum;
                }

                #判断有无超过商品数量
                if ($v['buy_num']>$sku['sku_prices']['goods_number']) {
                    $content['buy_attr'][$k]['buy_num'] = $sku['sku_prices']['goods_number'];
                }

                #判断区间价格：商品金额
                $price = 0;
                if (count($sku['sku_prices']['price'])>1) {
                    foreach ($sku['sku_prices']['start_num'] as $k2=>$v2) {
                        if ($sku['sku_prices']['select_end'][$k2]==1) {
                            #数值
                            if ($content['buy_attr'][$k]['buy_num']>=$v2 and $content['buy_attr'][$k]['buy_num']<=$sku['sku_prices']['end_num'][$k2]) {
                                $target_price = $sku['sku_prices']['price'][$k2];
                                $price = $content['buy_attr'][$k]['buy_num'] * $target_price;
                                break;
                            }
                        } elseif ($sku['sku_prices']['select_end'][$k2]==2) {
                            #以上
                            if ($content['buy_attr'][$k]['buy_num']>=$v2) {
                                $target_price = $sku['sku_prices']['price'][$k2];
                                $price = $content['buy_attr'][$k]['buy_num'] * $target_price;
                                break;
                            }
                        }
                    }
                } else {
                    $price = $content['buy_attr'][$k]['buy_num'] * $sku['sku_prices']['price'][0];
                }

                Db::table('cart_sku')->insert([
                    'cart_id'=>$cart_id,
                    'sku_id'=>$sku['sku_id'],
                    'attr_id'=>isset($v['attr_id']) ? $v['attr_id'] : 0,
                    'spec_id'=>isset($v['spec_id']) ? $v['spec_id'] : 0,
                    'goods_num'=>$content['buy_attr'][$k]['buy_num'],
                    'currency'=>$sku['sku_prices']['currency'][0],
                    'price'=>$price,
                    'selected'=>1,
                ]);
            }
        } else {
            #购物车存在此商品
            foreach ($content['buy_attr'] as $k=>$v) {
                if (isset($v['attr_id'])) {
                    #有规格
                    $attr_id = implode('|', array_reverse(explode('_', $v['attr_id'])));
                    $sku = Db::table('goods_sku')->where(['goods_id' => $content['good_id'], 'spec_vids' => $attr_id])->first();
                    if (empty($sku)) {
                        $attr_id = implode('|', array_reverse(explode('|', $attr_id)));
                        $sku = Db::table('goods_sku')->where(['goods_id' => $content['good_id'], 'spec_vids' => $attr_id])->first();
                    }
                } else {
                    #无规格
                    $sku = Db::table('goods_sku')->where(['goods_id' => $goods['goods_id']])->first();
                }
                $sku = objtoarr($sku);
                $sku['sku_prices'] = json_decode($sku['sku_prices'], true);

                $ishave2 = Db::table('cart_sku')->where(['cart_id'=>$ishave['cart_id'],'sku_id'=>$sku['sku_id']])->first();
                $ishave2 = objtoarr($ishave2);

                #判断有无超过商品数量
                if ($v['buy_num']>$sku['sku_prices']['goods_number']) {
                    $content['buy_attr'][$k]['buy_num'] = $sku['sku_prices']['goods_number'];
                }

                if (empty($ishave2)) {
                    #购物车规格表不存在此商品

                    #判断区间价格：商品金额
                    $price = 0;
                    if (count($sku['sku_prices']['price'])>1) {
                        foreach ($sku['sku_prices']['start_num'] as $k2=>$v2) {
                            if ($sku['sku_prices']['select_end'][$k2]==1) {
                                #数值
                                if ($content['buy_attr'][$k]['buy_num']>=$v2 and $content['buy_attr'][$k]['buy_num']<=$sku['sku_prices']['end_num'][$k2]) {
                                    $target_price = $sku['sku_prices']['price'][$k2];
                                    $price = $content['buy_attr'][$k]['buy_num'] * $target_price;
                                    break;
                                }
                            } elseif ($sku['sku_prices']['select_end'][$k2]==2) {
                                #以上
                                if ($content['buy_attr'][$k]['buy_num']>=$v2) {
                                    $target_price = $sku['sku_prices']['price'][$k2];
                                    $price = $content['buy_attr'][$k]['buy_num'] * $target_price;
                                    break;
                                }
                            }
                        }
                    } else {
                        $price = $content['buy_attr'][$k]['buy_num'] * $sku['sku_prices']['price'][0];
                    }

                    Db::table('cart_sku')->insert([
                        'cart_id'=>$ishave['cart_id'],
                        'sku_id'=>$sku['sku_id'],
                        'attr_id'=>isset($v['attr_id']) ? $v['attr_id'] : 0,
                        'spec_id'=>isset($v['spec_id']) ? $v['spec_id'] : 0,
                        'goods_num'=>$content['buy_attr'][$k]['buy_num'],
                        'currency'=>$sku['sku_prices']['currency'][0],
                        'price'=>$price,
                        'selected'=>1,
                    ]);
                } else {
                    #购物车规格表存在此商品
                    $content['buy_attr'][$k]['buy_num'] = $content['buy_attr'][$k]['buy_num']+intval($ishave2['goods_num']);

                    #判断区间价格：商品金额
                    $price = 0;
                    if (count($sku['sku_prices']['price'])>1) {
                        foreach ($sku['sku_prices']['start_num'] as $k2=>$v2) {
                            if ($sku['sku_prices']['select_end'][$k2]==1) {
                                #数值
                                if ($content['buy_attr'][$k]['buy_num']>=$v2 and $content['buy_attr'][$k]['buy_num']<=$sku['sku_prices']['end_num'][$k2]) {
                                    $target_price = $sku['sku_prices']['price'][$k2];
                                    $price = $content['buy_attr'][$k]['buy_num'] * $target_price;
                                    break;
                                }
                            } elseif ($sku['sku_prices']['select_end'][$k2]==2) {
                                #以上
                                if ($content['buy_attr'][$k]['buy_num']>=$v2) {
                                    $target_price = $sku['sku_prices']['price'][$k2];
                                    $price = $content['buy_attr'][$k]['buy_num'] * $target_price;
                                    break;
                                }
                            }
                        }
                    } else {
                        $price = $content['buy_attr'][$k]['buy_num'] * $sku['sku_prices']['price'][0];
                    }

                    Db::table('cart_sku')->where(['cart_id'=>$ishave['cart_id'],'sku_id'=>$sku['sku_id']])->update([
                        'goods_num'=>$content['buy_attr'][$k]['buy_num'],
                        'price'=>$price
                    ]);
                }
            }
        }

        #记录用户行为操作
        $ip = $_SERVER['REMOTE_ADDR'];
        $user = $request->session()->get('user');
        $type = 3;
        log_user_behavior(['type'=>$type,'ip'=>$ip,'user'=>$user,'goods_id'=>$goods['goods_id'],'second'=>0]);

        //任务操作日志
        task_campaign(['share_uid'=>$data['share_uid'],'goods_id'=>$data['data']['id'],'campaign_id'=>$data['campaign_id'],'campaign_type'=>2]);

        return Response()->json(['code'=>0,'msg'=>'恭喜你！商品已添加至选购中心']);
    }

    #详情页里立即购买
    public function loglastbuy(Request $request)
    {
        $data = $request->except(['_token']);
        
        #判断收货方式内容====start
        if(!isset($data['selectDeliveryMethod'])){
            return Response()->json(['code'=>-1,'msg'=>'请选择收货方式']);
        }
        $delivery_method = intval($data['selectDeliveryMethod']);
        
        $gather_method = $line_id = 0;
        if($delivery_method==2){
            #海外收货
            if(!isset($data['selectGatherMethod'])){
                return Response()->json(['code'=>-1,'msg'=>'请选择集运方式']);
            }
            $gather_method = intval($data['selectGatherMethod']);
            
            if($gather_method==1){
                #平台集运
                if(!isset($data['selectLine'])){
                    return Response()->json(['code'=>-1,'msg'=>'请选择线路']);
                }
                $line_id = intval($data['selectLine']);
            }
        }
        
        if(!isset($data['address_id'])){
            return Response()->json(['code'=>-1,'msg'=>'请选择收货地址']);
        }
        $address_id = intval($data['address_id']);
        #判断收货方式内容====end
        
        $spec_vids = rtrim($data['spec_vids'], '|');
        $ordersn = get_ordersn(1);

        $website_user = Db::connection('shop_db')->table('website_user')->where(['custom_id'=>session('user')['gogo_id']])->first();

        $goods = Db::table('goods')->where(['goods_id'=>$data['goods_id']])->first();
        $goods = objtoarr($goods);
        $shop_id = 0;
        if ($goods['shop_id']==0) {
            $goods['other_shop'] = json_decode($goods['other_shop'], true);
            $shop_id = 'o_'.$goods['other_shop']['shopId'];
        } else {
            $shop_id = $goods['shop_id'];
        }

        if ($goods['have_specs']==2) {
            $goods_sku = Db::table('goods_sku')->where(['goods_id'=>$data['goods_id']])->first();
        } else {
            $goods_sku = Db::table('goods_sku')->where(['spec_vids'=>$spec_vids,'goods_id'=>$data['goods_id']])->first();
        }


        $goods_sku = objtoarr($goods_sku);

        $goods_sku['sku_prices'] = json_decode($goods_sku['sku_prices'], true);
        
        //获取商品可售库存
        if($goods['shop_id']>0){
            $post = [
                'goods_id' => $data['goods_id'],
                'sku_id'   => $goods_sku['sku_id'],
                'shop_id'  => $goods['shop_id'],
                'wid'      => $goods['wid'],
                'goods_type'=>$goods['goods_type']
            ];
            
            $skunum = httpRequest('https://shop.gogo198.cn/collect_website/public/?s=api/func/get_goods_num', $post);
            
            #商品&规格可售库存
            $goods_sku['sku_prices']['goods_number'] = $skunum;
        }
        
        #判断有无超过商品数量
        if ($data['number']>$goods_sku['sku_prices']['goods_number']) {
            $data['number'] = $goods_sku['sku_prices']['goods_number'];
//            return Response()->json(['code'=>-1,'msg'=>'当前购买数量>商品库存']);
        }

        $cart_id = Db::table('cart')->insertGetId([
            'user_id'=>$website_user->id,
            'goods_id'=>$data['goods_id'],
            'ordersn'=>$ordersn,
            'shop_id'=>$shop_id,
            'selected'=>1,
            'is_show'=>1,
            'delivery_method'=>$delivery_method,
            'gather_method'=>$gather_method,
            'line_id'=>$line_id,
            'address_id'=>$address_id,
            'created_at'=>time()
        ]);

        #属性id_id
        $attr_id = '';
        if (!empty($goods_sku['spec_vids'])) {
            $goods_sku['spec_vids'] = explode("|", $goods_sku['spec_vids']);
            foreach ($goods_sku['spec_vids'] as $k=>$v) {
                if (!empty($v)) {
                    $attr_id .= $v.'_';
                }
            }
            $attr_id = rtrim($attr_id, '_');
        } else {
            $attr_id = '0';
        }
        #属性类别id_id
        $spec_id = '';
        if (!empty($goods_sku['spec_ids'])) {
            $goods_sku['spec_ids'] = explode("|", $goods_sku['spec_ids']);
            foreach ($goods_sku['spec_ids'] as $k=>$v) {
                if (!empty($v)) {
                    $spec_id .= $v.'_';
                }
            }
            $spec_id = rtrim($spec_id, '_');
        } else {
            $spec_id = '0';
        }


        #判断区间价格：商品金额
        $price = 0;
        if (count($goods_sku['sku_prices']['price'])>1) {
            foreach ($goods_sku['sku_prices']['start_num'] as $k=>$v) {
                if ($goods_sku['sku_prices']['select_end'][$k]==1) {
                    #数值
                    if ($data['number']>=$v and $data['number']<=$goods_sku['sku_prices']['end_num'][$k]) {
                        $target_price = $goods_sku['sku_prices']['price'][$k];
                        $price = $data['number'] * $target_price;
                        break;
                    }
                } elseif ($goods_sku['sku_prices']['select_end'][$k]==2) {
                    #以上
                    if ($data['number']>=$v) {
                        $target_price = $goods_sku['sku_prices']['price'][$k];
                        $price = $data['number'] * $target_price;
                        break;
                    }
                }
            }
        } else {
            $price = $data['number'] * $goods_sku['sku_prices']['price'][0];
        }

        Db::table('cart_sku')->insert([
            'cart_id'=>$cart_id,
            'sku_id'=>$goods_sku['sku_id'],
            'attr_id'=>$attr_id,
            'spec_id'=>$spec_id,
            'goods_num'=>$data['number'],
            'currency'=>$goods_sku['sku_prices']['currency'][0],
            'price'=>$price,
            'selected'=>1,
        ]);

        return Response()->json(['code'=>0,'cart_id'=>$cart_id]);
    }

    #确认订单页
    public function order_confirm(Request $request)
    {
        $data = $request->except(['_token']);
        
        $mid = !empty($data['mid']) ? base64_decode($data['mid']) : 0;
        if ($mid>0) {
            #默认登录
            $user = Db::connection('shop_db')->table('website_user')->where(['id'=>$mid])->first();

            $acc = Db::table('user')->where(['gogo_id'=>$user->custom_id])->first();
            $acc = objtoarr($acc);

            $request->session()->put('user', $acc);
            session('user', $acc);

            $loginField = 'email';
            $loginAcc = '';
            if (!empty($acc['email'])) {
                $loginField = 'email';
                $loginAcc = $acc['email'];
            } elseif (!empty($acc['mobile'])) {
                $loginField = 'mobile';
                $loginAcc = $acc['mobile'];
            }

            auth()->guard('user')->attempt(
                [$loginField=>$loginAcc,'password'=>'888888'],
                $request->filled('remember')
            );

            sleep(1);
        }
        $cart_id = rtrim($data['cart_id'], ',');#购物车id：用逗号分割开
        $origin_page = '/order_confirm';

        $website_user = Db::connection('shop_db')->table('website_user')->where(['custom_id'=>session('user')['gogo_id']])->first();
        if (empty($website_user)) {
            header('Location: /login.html?open=4&param2='.base64_encode('/order_confirm?cart_id='.$data['cart_id']));
        }
//        $data = Db::table('last_sure_buy')->where(['user_id'=>$website_user->id])->first();
//        $data = objtoarr($data);
//        $data['content'] = json_decode($data['content'],true);
        $is_daifa = 2;#1直发，2代发
        $data = Db::table('cart')->whereRaw('cart_id in ('.$cart_id.') and user_id='.$website_user->id)->get();
        $data = objtoarr($data);
        
        $final['final_price'] = 0;
        $final['final_currency']='';
        $final['freight_price'] = $this->calc_freight($data,$data[0]['freight_id']);#计算运费
        
        foreach ($data as $k=>$v) {
            if (empty($v['services'])) {
                $data[$k]['services_old']=[];
                $data[$k]['services'] = [];

                #1、记录该清单的必选服务
                $parent_services = Db::table('cost_service')->where(['company_id'=>0,'pid'=>0])->get();
                $parent_services = objtoarr($parent_services);
                $all_services_arr = '';
                foreach ($parent_services as $pk=>$pv) {
                    $all_services = Db::table('cost_service')->where(['pid'=>$pv['id']])->get();
                    $all_services = objtoarr($all_services);
                    foreach ($all_services as $sk=>$sv) {
                        $all_services_arr .= $sv['id'].',';
                    }
                }

                #2、必选增值服务
                $must_selected_services = Db::table('goods_services')->whereRaw('company_id=0 and is_select=1 and find_in_set(service_id,"'.rtrim($all_services_arr, ',').'")')->get();
                $must_selected_services = objtoarr($must_selected_services);

                $insert_services = [];
                foreach ($must_selected_services as $mk=>$ms) {
                    array_push($insert_services, ['service_id'=>$ms['id']]);
                }

                //3、记录在表
                Db::table('cart')->where(['cart_id'=>$v['cart_id']])->update([
                    'services'=>json_encode($insert_services, true)
                ]);
            } else {
                $data[$k]['services_old'] = $v['services'];
                $data[$k]['services'] = json_decode($v['services'], true);
            }

            #这层相当于在店铺
            $data[$k]['sku_info'] = Db::table('cart_sku')->where(['cart_id'=>$v['cart_id'],'selected'=>1,'is_buy'=>0])->get();
            $data[$k]['sku_info'] = objtoarr($data[$k]['sku_info']);
            
            #当前购物车的商品价格
            $goods_price = 0;
            #附加费用
            $freight_num=0;
            $goods_freight_fee=0;
            $data[$k]['services']['additional_money'] = 0;#附加费用
            $data[$k]['services']['potential_money'] = 0;#潜在费用
            
            $goods = Db::table('goods')->where(['goods_id'=>$data[$k]['goods_id']])->first();
            $goods = objtoarr($goods);
            
            #商品是否包邮
            $data[$k]['is_baoyou'] = $goods['is_baoyou'];
            
            foreach ($data[$k]['sku_info'] as $k2=>$v2) {
                #这层相当于是该店铺下的各规格商品
                $goods_sku = Db::table('goods_sku')->where(['sku_id'=>$v2['sku_id']])->first();
                $goods_sku = objtoarr($goods_sku);
                $goods_sku['sku_prices'] = json_decode($goods_sku['sku_prices'], true);
                
                //获取商品可售库存
                if($goods['shop_id']>0){
                    
                    $post = [
                        'goods_id' => $data[$k]['goods_id'],
                        'sku_id'   => $data[$k]['sku_info'][$k2]['sku_id'],
                        'shop_id'  => $data[$k]['shop_id'],
                        'wid'      => $goods['wid'],
                        'goods_type'=>$goods['goods_type']
                    ];
                    
                    $skunum = httpRequest('https://shop.gogo198.cn/collect_website/public/?s=api/func/get_goods_num', $post);
                    
                    #商品&规格可售库存
                    $goods_sku['sku_prices']['goods_number'] = $skunum;
                }
                
                $data[$k]['sku_info'][$k2]['start_num'] = $goods_sku['sku_prices']['start_num'][0];
                $data[$k]['sku_info'][$k2]['goods_number'] = $goods_sku['sku_prices']['goods_number'];
                
                #判断该商品是否代发
                if (!empty($goods['shop_id'])) {
                    $goods_merchant = Db::table('goods_merchant')->where(['shelf_id'=>$goods['goods_id']])->select('wid')->first();
                    // $warehouse_merchant = Db::connection('shop_db')->table('centralize_warehouse_merchant')->where(['id'=>$goods_merchant->wid])->select('warehouse_id')->first();
                    $is_daifa = Db::connection('shop_db')->table('centralize_warehouse_list')->where(['id'=>$goods_merchant->wid])->select('warehouse_form')->first()->warehouse_form;
                }
                
                if (!empty($goods['shop_id'])) {
                    #店铺名称
                    $data[$k]['shop_name'] = Db::connection('shop_db')->table('website_user_company')->where(['id'=>$goods['shop_id']])->first()->company;
                } else {
                    $goods['other_shop'] = json_decode($goods['other_shop'], true);
                    #店铺名称
                    $data[$k]['shop_name'] = $goods['other_shop']['shopName'];
                }

                #规格/商品图片
                if (!empty($goods_sku['sku_images'])) {
                    $data[$k]['sku_info'][$k2]['goods_image'] = $goods_sku['sku_images'];
                } else {
                    $data[$k]['sku_info'][$k2]['goods_image'] = $goods['goods_image'];
                }
                
                #商品名称
                $data[$k]['goods_name'] = $goods['goods_name'];
                #商品id
                $data[$k]['goods_id'] = $goods['goods_id'];

                #商品（规格）信息==============================start
                $data[$k]['sku_info'][$k2]['bgoods_name'] = $goods['goods_name'];
                if (empty($goods_sku['spec_names'])) {
                    #无规格商品
                    $data[$k]['sku_info'][$k2]['boption_name'] = $goods['goods_name'];
                } else {
                    #有规格商品
                    $data[$k]['sku_info'][$k2]['boption_name'] = $goods_sku['spec_names'];
                }

                #商品规格名称
                if (empty($goods_sku['spec_names'])) {
                    #无规格商品
                    $data[$k]['sku_info'][$k2]['soption_name'] = $goods['goods_name'];
                } else {
                    #有规格商品
                    $data[$k]['sku_info'][$k2]['soption_name'] = $goods_sku['spec_names'];
                }
                
                #商品（规格）币种&数量&价格（不用重复计算价格了，已经计算了）
                $data[$k]['sku_info'][$k2]['currency'] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$v2['currency']])->first()->currency_symbol_standard;
                $data[$k]['sku_info'][$k2]['price'] = $v2['price'];
                $data[$k]['sku_info'][$k2]['num'] = $v2['goods_num'];
                #商品（规格）信息==============================end

                #附加费用（国内运费）=====================================start
                $freight_num += $v2['goods_num'];
                $goods_freight_fee += $goods['goods_freight_fee'];
                #附加费用（国内运费）=====================================end

                #当前购物车的商品价格
                $goods_price += $v2['price'];
                $data[$k]['currency'] = $data[$k]['sku_info'][$k2]['currency'];
                $data[$k]['price'] = number_format($goods_price, 2);

                #最终价格的币种
                $final['final_currency']=$data[$k]['currency'];

                #商品附加费用：卖家运费/卖家要的费用
                #附加费用=======================================start
                if ($goods['shop_id']==0) {
                    $services_ids = Db::table('cost_service')->where(['pid'=>2,'company_id'=>0])->get();
                    $services_ids = objtoarr($services_ids);
                    $service_ids_arr = '';
                    foreach ($services_ids as $sk=>$sv) {
                        $service_ids_arr .= $sv['id'].',';
                    }

                    $data[$k]['services']['additional'] = Db::table('goods_services')->whereRaw('company_id=0 and find_in_set(service_id,"'.rtrim($service_ids_arr, ',').'")')->get();
                    $data[$k]['services']['additional'] = objtoarr($data[$k]['services']['additional']);
                    foreach ($data[$k]['services']['additional'] as $k3=>$v3) {
                        $data[$k]['services']['additional'][$k3]['currency'] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$v3['currency']])->first()->currency_symbol_standard;
                        if ($v3['is_select']==1) {
                            $data[$k]['services']['additional_money'] += $v3['price'];
                        }
                    }
                } else {
                    #商户企业id
                    if (empty($goods['otherfees_content']) && empty($goods['reduction_content']) && empty($goods['gift_content']) && empty($goods['noinclude_content'])) {
                        $data[$k]['services']['additional'] = [];
                    } else {
                        if (!empty($goods['otherfees_content'])) {
                            #1、其他费用判断
                            $otherfees_content = json_decode($goods['otherfees_content'], true);

                            foreach ($otherfees_content['fees_name'] as $k3=>$v3) {
                                if ($otherfees_content['fees_condition'][$k3]==2) {
                                    #有条件触发

                                    if ($otherfees_content['fees_trigger'][$k3]==1) {
                                        #要素触发
                                        if ($otherfees_content['fees_trigger2_equal'][$k3]==1) {
                                            #少于

                                            #大于/等于就退出当前循环，进行下一个循环（不满足条件）
                                            if ($otherfees_content['fees_trigger2'][$k3]==1) {
                                                #购买数量
                                                if ($v2['goods_num']>=$otherfees_content['fees_trigger2_num'][$k3]) {
                                                    continue;
                                                }
                                            } elseif ($otherfees_content['fees_trigger2'][$k3]==2) {
                                                #购买金额
                                                if ($v2['price']>=$otherfees_content['fees_trigger2_num'][$k3]) {
                                                    continue;
                                                }
                                            }
                                        } elseif ($otherfees_content['fees_trigger2_equal'][$k3]==2) {
                                            #少于或等于

                                            #大于就退出当前循环，进行下一个循环（不满足条件）
                                            if ($otherfees_content['fees_trigger2'][$k3]==1) {
                                                #购买数量
                                                if ($v2['goods_num']>$otherfees_content['fees_trigger2_num'][$k3]) {
                                                    continue;
                                                }
                                            } elseif ($otherfees_content['fees_trigger2'][$k3]==2) {
                                                #购买金额
                                                if ($v2['price']>$otherfees_content['fees_trigger2_num'][$k3]) {
                                                    continue;
                                                }
                                            }
                                        } elseif ($otherfees_content['fees_trigger2_equal'][$k3]==3) {
                                            #等于

                                            #不等于就退出当前循环，进行下一个循环（不满足条件）
                                            if ($otherfees_content['fees_trigger2'][$k3]==1) {
                                                #购买数量
                                                if ($v2['goods_num']!=$otherfees_content['fees_trigger2_num'][$k3]) {
                                                    continue;
                                                }
                                            } elseif ($otherfees_content['fees_trigger2'][$k3]==2) {
                                                #购买金额
                                                if ($v2['price']!=$otherfees_content['fees_trigger2_num'][$k3]) {
                                                    continue;
                                                }
                                            }
                                        } elseif ($otherfees_content['fees_trigger2_equal'][$k3]==4) {
                                            #大于

                                            #少于/等于就退出当前循环，进行下一个循环（不满足条件）
                                            if ($otherfees_content['fees_trigger2'][$k3]==1) {
                                                #购买数量
                                                if ($v2['goods_num']<=$otherfees_content['fees_trigger2_num'][$k3]) {
                                                    continue;
                                                }
                                            } elseif ($otherfees_content['fees_trigger2'][$k3]==2) {
                                                #购买金额
                                                if ($v2['price']<=$otherfees_content['fees_trigger2_num'][$k3]) {
                                                    continue;
                                                }
                                            }
                                        } elseif ($otherfees_content['fees_trigger2_equal'][$k3]==5) {
                                            #大于或等于

                                            #少于就退出当前循环，进行下一个循环（不满足条件）
                                            if ($otherfees_content['fees_trigger2'][$k3]==1) {
                                                #购买数量
                                                if ($v2['goods_num']<$otherfees_content['fees_trigger2_num'][$k3]) {
                                                    continue;
                                                }
                                            } elseif ($otherfees_content['fees_trigger2'][$k3]==2) {
                                                #购买金额
                                                if ($v2['price']<$otherfees_content['fees_trigger2_num'][$k3]) {
                                                    continue;
                                                }
                                            }
                                        }
                                    } elseif ($otherfees_content['fees_trigger'][$k3]==2) {
                                        #型号触发
                                        if ($otherfees_content['fees_options'][$k3]==-1) {
                                            continue;
                                        }
                                        #首先找到商户商品表id和规格
                                        $goods_merchant = Db::table('goods_merchant')->where(['shelf_id'=>$v['goods_id']])->first();
                                        $goods_sku_merchant = Db::table('goods_sku_merchant')->where(['goods_id'=>$goods_merchant->id,'sku_id'=>$otherfees_content['fees_options'][$k3]])->first();
                                        $goods_sku_merchant = objtoarr($goods_sku_merchant);

                                        #不是当前规格就退出当前循环，进行下一个循环（不满足条件）
                                        if ($goods_sku['spec_names']!=$goods_sku_merchant['spec_names']) {
                                            continue;
                                        }
                                    } elseif ($otherfees_content['fees_trigger'][$k3]==3) {
                                        #物流触发（待做）
                                    }
                                }

                                #收费标准
                                if ($otherfees_content['fees_standard'][$k3]==1) {
                                    #定额计价
                                    $data[$k]['services']['additional'][] = [
                                        'name'=>$otherfees_content['fees_name'][$k3],
                                        'desc'=>$otherfees_content['fees_desc'][$k3],
                                        'currency'=>Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$otherfees_content['fees_standard_currency'][$k3]])->first()->currency_symbol_standard,
                                        'price'=>number_format($otherfees_content['fees_standard_price'][$k3], 2)
                                    ];
                                    $data[$k]['services']['additional_money'] += $otherfees_content['fees_standard_price'][$k3];
                                } elseif ($otherfees_content['fees_standard'][$k3]==2) {
                                    #比例计价
                                    if ($otherfees_content['fees_standard_ratio'][$k3]==1) {
                                        #计费基数
                                        $data[$k]['services']['additional'][] = [
                                            'name'=>$otherfees_content['fees_name'][$k3],
                                            'desc'=>$otherfees_content['fees_desc'][$k3],
                                            'currency'=>Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$otherfees_content['fees_standard_currency'][$k3]])->first()->currency_symbol_standard,
                                            'price'=>number_format($otherfees_content['fees_standard_ratio_price'][$k3], 2)
                                        ];
                                        $data[$k]['services']['additional_money'] += $otherfees_content['fees_standard_ratio_price'][$k3];
                                    } elseif ($otherfees_content['fees_standard_ratio'][$k3]==2) {
                                        #计费比率
                                        $ratio_price = ($otherfees_content['fees_standard_ratio_ratio'][$k3] / 100) * $v2['price'];
                                        $data[$k]['services']['additional'][] = [
                                            'name'=>$otherfees_content['fees_name'][$k3],
                                            'desc'=>$otherfees_content['fees_desc'][$k3],
                                            'currency'=>Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$otherfees_content['fees_standard_currency'][$k3]])->first()->currency_symbol_standard,
                                            'price'=>number_format($ratio_price, 2)
                                        ];
                                        $data[$k]['services']['additional_money'] += $ratio_price;
                                    }
                                }
                            }
                        }

                        if (!empty($goods['reduction_content'])) {
                            #2、销售优惠减免判断
                            $reduction_content = json_decode($goods['reduction_content'], true);

                            $reduction_strict = 0;
                            $reduction_arr = [];
                            foreach ($reduction_content['preferential_blong'] as $k3=>$v3) {
                                $rule_name = Db::table('ssl_reduction_rule')->where(['id'=>$reduction_content['type'][$k3]])->first();
                                $rule_name = objtoarr($rule_name);
                                $rule_name['content'] = json_decode($rule_name['content'], true);

                                $name = '';
                                if ($v3==1) {
                                    $name = '卖家优惠';
                                } elseif ($v3==2) {
                                    $name = '平台优惠';
                                } elseif ($v3==3) {
                                    $name = '他方优惠';
                                }

                                if ($reduction_content['strict'][$k3]==1 && $reduction_strict==0) {
                                    #单独
                                    if ($v2['price']>$reduction_content['price1'][$k3]) {
                                        $reduction_arr = [
                                            'name'=>$name,
                                            'desc'=>$rule_name['content'][0].$reduction_content['price1'][$k3].$rule_name['content'][2].$reduction_content['price2'][$k3],
                                            'currency'=>Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$reduction_content['currency1']])->first()->currency_symbol_standard,
                                            'price'=>'-'.number_format($reduction_content['price2'][$k3], 2)
                                        ];
                                        $data[$k]['services']['additional'][] = $reduction_arr;
                                        $data[$k]['services']['additional_money'] -= $reduction_content['price2'][$k3];
                                        break;
                                    }
                                    $reduction_strict=1;
                                } elseif ($reduction_content['strice'][$k3]==2 && ($reduction_strict==0 || $reduction_strict==2)) {
                                    #叠加
                                    if ($v2['price']>$reduction_content['price1'][$k3]) {
                                        $reduction_arr = [
                                            'name' => $name,
                                            'desc' => $rule_name['content'][0] . $reduction_content['price1'][$k3] . $rule_name['content'][2] . $reduction_content['price2'][$k3],
                                            'currency' => Db::connection('shop_db')->table('centralize_currency')->where(['id' => $reduction_content['currency1']])->first()->currency_symbol_standard,
                                            'price' => '-'.number_format($reduction_content['price2'][$k3], 2)
                                        ];
                                        $data[$k]['services']['additional'][] = $reduction_arr;
                                        $data[$k]['services']['additional_money'] -= $otherfees_content['price2'][$k3];
                                    }
                                    $reduction_strict=2;
                                }
                            }
                        }

                        if (!empty($goods['gift_content'])) {
                            #3、随赠优惠判断
                            $gift_content = json_decode($goods['gift_content'], true);

                            $gift_strict = 0;
                            foreach ($gift_content['preferential_blong'] as $k3=>$v3) {
                                $name = '';
                                if ($v3==1) {
                                    $name = '卖家优惠';
                                } elseif ($v3==2) {
                                    $name = '平台优惠';
                                } elseif ($v3==3) {
                                    $name = '他方优惠';
                                }

                                if ($gift_content['strict'][$k3]==1 && $gift_strict==0) {
                                    #单独
                                    $gift_strict=1;
                                } elseif ($gift_content['strict'][$k3]==2 && ($gift_strict==0 || $gift_strict==2)) {
                                    #叠加
                                    $gift_strict=2;
                                } else {
                                    continue;
                                }

                                $gift_project = '随赠项目：';
                                if ($gift_content['type'][$k3]==1) {
                                    $gift_project .= '积分；';

                                    if ($gift_content['points_type'][$k3]==1) {
                                        $gift_project .= '按每订单/次，赠送'.$gift_content['points_send'][$k3].'积分；';
                                    } elseif ($gift_content['points_type'][$k3]==2) {
                                        if ($v2['price']>=$gift_content['points_money'][$k3]) {
                                            $points_currency = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$gift_content['points_currency']])->first()->currency_symbol_standard;
                                            $gift_project .= '按金额满 '.$points_currency.' '.number_format($gift_content['points_money'][$k3], 2).'，赠送'.$gift_content['points_send'][$k3].'积分；';
                                        }
                                    }
                                } elseif ($gift_content['type'][$k3]==2) {
                                    $gift_project .= '卡券；';
                                    $coupon_currency = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$gift_content['coupon_currency']])->first()->currency_symbol_standard;
                                    $gift_project .= '赠送价值 '.$coupon_currency.' '.$gift_content['coupon_money'][$k3].' *'.$gift_content['coupon_num'][$k].'张；';
                                } elseif ($gift_content['type'][$k3]==3) {
                                    $gift_project .= '随赠；';

                                    if ($gift_content['accgift_type'][$k3]==1) {
                                        $gift_project .= '虚拟物品：'.$gift_content['accgift_content'][$k3].' *'.$gift_content['accgift_num'][$k3].'个';
                                    } elseif ($gift_content['accgift_type'][$k3]==2) {
                                        $gift_project .= '额外服务：'.$gift_content['accgift_content'][$k3].' *'.$gift_content['accgift_num'][$k3].'次';
                                    } elseif ($gift_content['accgift_type'][$k3]==3) {
                                        $gift_project .= '实物赠品：'.$gift_content['accgift_content'][$k3].' *'.$gift_content['accgift_num'][$k3].'个';
                                    }
                                }

                                $gift_arr = [
                                    'name'=>$name,
                                    'desc'=>$gift_project,
                                    'currency'=>Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$gift_content['points_currency']])->first()->currency_symbol_standard,
                                    'price'=>'0.00'
                                ];
                                $data[$k]['services']['additional'][] = $gift_arr;
                            }
                        }

                        if (!empty($goods['noinclude_content'])) {
                            #4、价格未含
                            $noinclude_content = json_decode($goods['noinclude_content'], true);

                            foreach ($noinclude_content['name'] as $k3=>$v3) {
                                if (!empty($v3['name']) || !empty($v3['desc']) || !empty($v3['price'])) {
                                    $data[$k]['services']['additional'][] = [
                                        'name'=>$v3,
                                        'desc'=>$noinclude_content['desc'][$k3],
                                        'currency'=>Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$noinclude_content['currency']])->first()->currency_symbol_standard,
                                        'price'=>number_format($noinclude_content['price'][$k3], 2)
                                    ];
                                    $data[$k]['services']['additional_money'] += $noinclude_content['price'][$k3];
                                }
                            }
                        }
                    }
                }
                #附加费用=======================================end

                #潜在费用=======================================start
                if ($goods['shop_id']==0) {
                    $services_ids = Db::table('cost_service')->where(['pid' => 3, 'company_id' => 0])->get();
                    $services_ids = objtoarr($services_ids);
                    $service_ids_arr = '';
                    foreach ($services_ids as $sk => $sv) {
                        $service_ids_arr .= $sv['id'] . ',';
                    }

                    $data[$k]['services']['potential'] = Db::table('goods_services')->whereRaw('company_id=0 and find_in_set(service_id,"' . rtrim($service_ids_arr, ',') . '")')->get();
                    $data[$k]['services']['potential'] = objtoarr($data[$k]['services']['potential']);
                    foreach ($data[$k]['services']['potential'] as $k3 => $v3) {
                        $data[$k]['services']['potential'][$k3]['currency'] = Db::connection('shop_db')->table('centralize_currency')->where(['id' => $v3['currency']])->first()->currency_symbol_standard;
                        if ($v3['is_select'] == 1) {
                            $data[$k]['services']['potential_money'] += $v3['price'];
                        }
                    }
                } else {
                    #商户企业id
                    if (empty($goods['potential_content'])) {
                        $data[$k]['services']['potential'] = [];
                    } else {
                        if (!empty($goods['potential_content'])) {
                            #1、潜在收费判断
                            $data[$k]['services']['potential'] = [];
                            $potential_content = json_decode($goods['potential_content'], true);

                            foreach ($potential_content['name'] as $k3 => $v3) {
                                if (!empty($v3['name']) || !empty($v3['desc']) || !empty($v3['price'])) {
                                    $data[$k]['services']['potential'][] = [
                                        'name' => $v3,
                                        'desc' => $potential_content['desc'][$k3],
                                        'currency' => Db::connection('shop_db')->table('centralize_currency')->where(['id' => $potential_content['currency'][$k3]])->first()->currency_symbol_standard,
                                        'price' => number_format($potential_content['price'][$k3], 2)
                                    ];
                                    $data[$k]['services']['potential_money'] += $potential_content['price'][$k3];
                                }
                            }
                        }
                    }
                }
                #潜在费用=======================================end
            }

            #商品附加费用：卖家运费/卖家要的费用
            #增值服务=======================================start
            $data[$k]['services']['increment_money'] = 0;

            $services_ids = Db::table('cost_service')->where(['pid'=>1,'company_id'=>0])->get();
            $services_ids = objtoarr($services_ids);
            $service_ids_arr = '';
            foreach ($services_ids as $sk=>$sv) {
                $service_ids_arr .= $sv['id'].',';
            }

            $data[$k]['services']['increment'] = Db::table('goods_services')->whereRaw('company_id=0 and find_in_set(service_id,"'.rtrim($service_ids_arr, ',').'")')->get();
            $data[$k]['services']['increment'] = objtoarr($data[$k]['services']['increment']);

            foreach ($data[$k]['services']['increment'] as $k2=>$v2) {
                if ($v2['type']==1) {
                    $data[$k]['services']['increment'][$k2]['photonum'] = 0;
                }
                $data[$k]['services']['increment'][$k2]['currency'] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$v2['currency']])->first()->currency_symbol_standard;
                if ($v2['is_select']==1) {
                    $data[$k]['services']['increment'][$k2]['final_money'] = $v2['price'];
                } else {
                    $data[$k]['services']['increment'][$k2]['final_money'] = '0.00';
                }
            }

            if (!empty($data[$k]['services_old'])) {
                #已选服务
                $data[$k]['services_old'] = json_decode($data[$k]['services_old'], true);

                foreach ($data[$k]['services_old'] as $k2=>$v2) {
                    $services = Db::table('goods_services')->where(['id'=>$v2['service_id']])->first();
                    $services = objtoarr($services);

                    if ($services['type']==1) {
                        #照片服务/价格递增
                        if ($v2['photonum']>=1) {
                            if ($v2['photonum']>=$services['num']) {
                                $services['price'] = $services['price'] + (($v2['photonum'] - $services['num']) * $services['interval_price']);
                                $data[$k]['services']['increment_money'] += $services['price'];
                            }
                        }
                    } else {
                        #其他服务
                        $data[$k]['services']['increment_money'] += $services['price'];
//                        $data[$k]['services']['increment'][$k2]['final_money'] = $services['price'];
                    }

                    foreach ($data[$k]['services']['increment'] as $k3=>$v3) {
                        if ($v3['id']==$v2['service_id']) {
                            $data[$k]['services']['increment'][$k3]['final_money'] = number_format($services['price'], 2);
                        }

                        if ($v3['id']==$v2['service_id'] && isset($v2['photonum'])) {
                            $data[$k]['services']['increment'][$k3]['photonum'] = $v2['photonum'];
                        }
                    }
                }
            } else {
                #未选服务
                foreach ($data[$k]['services']['increment'] as $k2=>$v2) {
                    if ($v2['is_select']==1) {
                        $data[$k]['services']['increment_money'] += $v2['price'];
                    }
                }
            }

            $data[$k]['services']['increment_money'] = number_format($data[$k]['services']['increment_money'], 2);
            #增值服务=======================================end

            #当前购物车id的商品（规格）总价（商品（规格）单价+各服务费用）
            $data[$k]['total_price'] = number_format($goods_price+$data[$k]['services']['additional_money']+$data[$k]['services']['increment_money']+$data[$k]['services']['potential_money'], 2);

            #所有购物清单的最终价格
            $final['final_price'] += $goods_price+$data[$k]['services']['additional_money']+$data[$k]['services']['increment_money']+$data[$k]['services']['potential_money'];
            $data[$k]['services']['additional_money'] = number_format($data[$k]['services']['additional_money'], 2);
            $data[$k]['services']['potential_money'] = number_format($data[$k]['services']['potential_money'], 2);
            
            #获取当前商品所在的仓库下的终端下的可选快递企业和可选的快递产品（然后计算产品体积与重量收取的运费）
            $g = Db::table('goods')->where(['goods_id'=>$v['goods_id']])->select(['express_info','wid'])->first();
            $g->express_info = json_decode($g->express_info,true);
            $express_list = [];
            foreach($g->express_info['express_info'] as $k2=>$v2){
                $express_info = Db::connection('shop_db')->table('centralize_warehouse_express')->where(['id'=>$v2['express_id']])->first();
                $express_name = Db::connection('shop_db')->table('centralize_express_product')->where(['id'=>$express_info->express_id])->select('name')->first()->name;
                
                #快递产品运费
                $freight_id = Db::connection('shop_db')->table('centralize_freight_config')->where(['warehouse_id'=>$g->wid,'printer_id'=>$g->express_info['printer_id'],'express_id'=>$express_info->id,'express_type'=>$express_info->express_type])->select('id')->first()->id;
                array_push($express_list,['id'=>$express_info->id,'express_name'=>$express_name,'express_typename'=>$express_info->express_type,'warehouse_id'=>$g->wid,'terminal_id'=>$g->express_info['printer_id'],'freight_id'=>$freight_id]);
            }
            // dd($express_list);
            $data[$k]['express_list'] = $express_list;
        }
        
        #计算立减金额（2026/02/06）到时候再做控件
        #1、（平台/卖家）订单金额*0.15（15%）
        $platform_money = ($final['final_price'] + $final['freight_price']) * 0.15;
        $platform_money = (float)sprintf("%.2f", $platform_money);
        
        #2、（账户）订单金额*0.2（20%）
        $member_coupon = Db::connection('shop_db')->table('website_user_coupon')->where(['type'=>3,'uid'=>$website_user->id])->first();
        $member_money = $member_coupon->price * 0.2;
        $member_money = (float)sprintf("%.2f", $member_money);
        
        #3、抵扣金额，谁小用谁
        $final['coupon_money'] = 0;
        if($platform_money>$member_money){$final['coupon_money'] = number_format($member_money, 2);}else{$final['coupon_money'] = number_format($platform_money,2);}
        
        #所有购物清单的最终价格
        $final['final_price'] = number_format($final['final_price'] + $final['freight_price'] - $final['coupon_money'], 2);
      
        $website = get_website();
        $page_info = get_pageinfo('/goods');
        $website['background'] = $page_info['content']['background'];
        $website['content'] = $page_info['content']['content'];
        $website['fontcolor'] = $page_info['content']['fontcolor'];
        $website['agentLink'] = $page_info['content']['agent_link'];

        if(1>2){
            #买家地址
            $addr = Db::connection('shop_db')->table('centralize_user_address')->where(['user_id'=>$website_user->id])->get();
            $addr = objtoarr($addr);
            foreach($addr as $k=>$v){
                #国家名称
                
                $addr[$k]['country_name'] = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['id'=>$v['country_id']])->select('param2')->first()->param2;
                
                if($v['country_id']==162){
                    #中国行政区域
                    if($v['have_postal_code']==1){
                        #有邮政编码
                        $addr[$k]['detail_addr'] = $v['pre_address'].$v['address1'].'('.$v['postal'].')';
                    }
                    elseif($v['have_postal_code']==2){
                        #无邮政编码
                        $province_name = $city_name = $district_name = $town_name = $village_name = '';
                        
                        if(!empty($v['province'])){
                            #省份
                            $province_name = Db::connection('shop_db')->table('centralize_country_areas')->where(['id'=>$v['province']])->select('name')->first()->name;    
                        }
                        
                        if(!empty($v['city'])){
                            #城市
                            $city_name = Db::connection('shop_db')->table('centralize_country_areas')->where(['id'=>$v['city']])->select('name')->first()->name;
                        }
                        
                        if(!empty($v['area'])){
                            #区域
                            $district_name = Db::connection('shop_db')->table('centralize_country_areas')->where(['id'=>$v['area']])->select('name')->first()->name;
                        }
                        
                        if(!empty($v['area2'])){
                            #镇街
                            $town_name = Db::connection('shop_db')->table('centralize_country_areas')->where(['id'=>$v['area2']])->select('name')->first()->name;
                        }
                        
                        if(!empty($v['area3'])){
                            #居委
                            $village_name = Db::connection('shop_db')->table('centralize_country_areas')->where(['id'=>$v['area3']])->select('name')->first()->name;
                        }
                        
                        $addr[$k]['detail_addr'] = $province_name . $city_name . $district_name . $town_name . $village_name . $v['address1'];
                    }
                }
                else{
                    #海外行政区域
                    $addr[$k]['detail_addr'] = $v['pre_address'].$v['address1'].'('.$v['postal'].')';
                }
            }
        }

        $is_inner=1;#内页打开首页头部，不显示消息轮播框
        $check_content = [];
        if($is_daifa==2){
            #代发需要勾选协议
            #协议确认与知悉、了解
            $check_content = $this->get_rule(['function_id'=>48]);
        }
        
        return view('goods.order_confirm', compact('data', 'origin_page', 'website', 'final', 'cart_id', 'is_inner', 'check_content','website_user','is_daifa'));
    }
    
    public function calc_freight($data,$freight_id){
        #总运费
        $freight_price = 0;
        
        if($freight_id>0){
            #线路费用
            $freight_info = Db::connection('shop_db')->table('centralize_freight_config')->where(['id'=>$freight_id])->first();
            $freight_info = objtoarr($freight_info);
            $freight_info['config_data'] = json_decode($freight_info['config_data'],true);
            
            // print_r($freight_info['config_data']);die;
            foreach ($data as $k=>$v) {
                $data[$k]['sku_info'] = Db::table('cart_sku')->where(['cart_id'=>$v['cart_id'],'selected'=>1,'is_buy'=>0])->get();
                $data[$k]['sku_info'] = objtoarr($data[$k]['sku_info']);
                
                $goods = Db::table('goods')->where(['goods_id'=>$data[$k]['goods_id']])->first();
                $goods = objtoarr($goods);
                
                foreach ($data[$k]['sku_info'] as $k2=>$v2) {
                    #这层相当于是该店铺下的各规格商品
                    $goods_sku = Db::table('goods_sku')->where(['sku_id'=>$v2['sku_id']])->first();
                    $goods_sku = objtoarr($goods_sku);
                    $goods_sku['sku_prices'] = json_decode($goods_sku['sku_prices'], true);
                    
                    #规格体积（cm）
                    $goods_sku['volume'] = explode('*',$goods_sku['volume']);
                    $long = isset($goods_sku['volume'][0])?$goods_sku['volume'][0]:0;
                    $width = isset($goods_sku['volume'][1])?$goods_sku['volume'][1]:0;
                    $height = isset($goods_sku['volume'][2])?$goods_sku['volume'][2]:0;
                    
                    $vw = 0;
                    #计算体积重（需算上所购规格数量）CM
                    if(!empty($long) && !empty($width) && !empty($height)){
                        $vw = number_format((($long * $width * $height) * $v2['goods_num']) / $freight_info['config_data']['rate'][0], 2, '.', '');
                    }
                    
                    $true_weight = 0;
                    $goods_weight = $goods_sku['weight'] * $v2['goods_num'];
                    #体积重 > OR < 商品重量（需算上所购规格数量），取最大值
                    if($vw >= $goods_weight){
                        $true_weight = &$vw;
                    }else{
                        $true_weight = &$goods_weight;
                    }
                    // print_r($freight_info['config_data']);die;
                    #计算重量费用
                    foreach($freight_info['config_data']['jf_method'][0] as $k=>$v){
                        foreach($v as $k2=>$v2){
                            #1、根据计费方式进行计费
                            #2、将计费重按照进阶重的格式变为可计算数值（目前只有这三种格式：100，100.5，100.1）
                            $true_weight2 = explode('.',$true_weight);
                            if(count($true_weight2)>1){
                                $true_weight = $true_weight2[0];
                                $true_weight2 = floatval('0.'.$true_weight2[1]);
                                if($true_weight2>0){
                                    if($true_weight2<$freight_info['config_data']['jinjie'][0][$k]){
                                        $true_weight2=$freight_info['config_data']['jinjie'][0][$k];
                                    }
                                }
                                $true_weight = floatval($true_weight) + floatval($true_weight2);
                            }
                            
                            #3、判断重量在哪个计费区间
                            if($freight_info['config_data']['qj2_method'][0][$k]==1){
                                #数值
                                if($true_weight>=$freight_info['config_data']['qj1'][0][$k] && $true_weight<=$freight_info['config_data']['qj2'][0][$k]){
                                    #7、开始计算费用
                                    if($v2==1){
                                        #7、首续重计费，计法：(100-1首重)/1续重*15续重额+30首重额
                                        $price = (($true_weight - $freight_info['config_data']['shouzhong'][0][$k][$k2]) / $freight_info['config_data']['xuzhong'][0][$k][$k2]) * $freight_info['config_data']['xuzhong_money'][0][$k][$k2] + $freight_info['config_data']['shouzhong_money'][0][$k][$k2];
                                        $freight_price += $price;
                                    }elseif($v2==2){
                                        #7、计量计费，计法：(100/1千克)*34元
                                        $price = ($true_weight / $freight_info['config_data']['anliang'][0][$k][$k2]) * $freight_info['config_data']['anliang_money'][0][$k][$k2];
                                        $freight_price += $price;
                                    }elseif($v2==3){
                                        #7、分段计费
                                        foreach($freight_info['config_data']['fenduan_num1'][0][$k][$k2] as $k4=>$v4){
                                            if($freight_info['config_data']['fenduan_method'][0][$k][$k2][$k4]){
                                                #数值
                                                if($true_weight>=$v4 && $true_weight<=$freight_info['config_data']['fenduan_num2'][0][$k][$k2]){
                                                    #8、重量在该区间的分段计费下，计法：（100/1进阶）*16
                                                    $price = ($true_weight / $freight_info['config_data']['jinjie'][0][$k]) * $freight_info['config_data']['fenduan_money'][0][$k][$k2][$k4];
                                                    $freight_price += $price;
                                                }
                                            }else{
                                                #以上
                                                if($true_weight>=$v4 && $true_weight<=$freight_info['config_data']['qj2'][0][$k]){
                                                    #8、重量在该区间的分段计费下，计法：（100/1进阶）*16
                                                    $price = ($true_weight / $freight_info['config_data']['jinjie'][0][$k]) * $freight_info['config_data']['fenduan_money'][0][$k][$k2][$k4];
                                                    $freight_price += $price;
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            elseif($freight_info['config_data']['qj2_method'][0][$k]==2){
                                #以上
                                if($true_weight>=$freight_info['config_data']['qj1'][0][$k]){
                                    #7、开始计算费用
                                    if($v2==1){
                                        #7、首续重计费，计法：(100-1首重)/1续重*15续重额+30首重额
                                        $price = (($true_weight - $freight_info['config_data']['shouzhong'][0][$k][$k2]) / $freight_info['config_data']['xuzhong'][0][$k][$k2]) * $freight_info['config_data']['xuzhong_money'][0][$k][$k2] + $freight_info['config_data']['shouzhong_money'][0][$k][$k2];
                                        $freight_price += $price;
                                    }elseif($v2==2){
                                        #7、计量计费，计法：(100/1千克)*34元
                                        $price = ($true_weight / $freight_info['config_data']['anliang'][0][$k][$k2]) * $freight_info['config_data']['anliang_money'][0][$k][$k2];
                                        $freight_price += $price;
                                    }elseif($v2==3){
                                        #7、分段计费
                                        foreach($freight_info['config_data']['fenduan_num1'][0][$k][$k2] as $k4=>$v4){
                                            if($freight_info['config_data']['fenduan_method'][0][$k][$k2][$k4]){
                                                #数值
                                                if($true_weight>=$v4 && $true_weight<=$freight_info['config_data']['fenduan_num2'][0][$k][$k2]){
                                                    #8、重量在该区间的分段计费下，计法：（100/1进阶）*16
                                                    $price = ($true_weight / $freight_info['config_data']['jinjie'][0][$k]) * $freight_info['config_data']['fenduan_money'][0][$k][$k2][$k4];
                                                    $freight_price += $price;
                                                }
                                            }else{
                                                #以上
                                                if($true_weight>=$v4 && $true_weight<=$freight_info['config_data']['qj2'][0][$k]){
                                                    #8、重量在该区间的分段计费下，计法：（100/1进阶）*16
                                                    $price = ($true_weight / $freight_info['config_data']['jinjie'][0][$k]) * $freight_info['config_data']['fenduan_money'][0][$k][$k2][$k4];
                                                    $freight_price += $price;
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $freight_price = number_format($freight_price,2,'.','');
        }
        
        return $freight_price;
    }

    #集运系统各功能确认同意内容列表
    public function get_rule($data=[])
    {
        $content = Db::connection('shop_db')->table('centralize_rule_list')->where(['system_id'=>2,'function_id'=>$data['function_id']])->first();
        $content = objtoarr($content);
        if (!empty($content)) {
            $content['confirm'] = json_decode($content['confirm'], true);
            $content['sure'] = json_decode($content['sure'], true);
            $content['knows'] = json_decode($content['knows'], true);
        }
        return $content;
    }

    #确认订单页-监听当前商品的数量变化
    public function order_confirm_calc(Request $request)
    {
        $data = $request->except(['_token']);

        $goods_id = intval($data['goods_id']);#变化的商品id
        $sku_id = intval($data['sku_id']);#变化的商品规格id
        $buy_num = intval($data['buy_num']);#变化的商品规格数量

        $cart_ids = trim($data['cart_ids']);#购物车ids
        $cart_id = intval($data['cart_id']);#购物车id
        $website_user = Db::connection('shop_db')->table('website_user')->where(['custom_id'=>session('user')['gogo_id']])->first();

        $data = Db::table('cart')->whereRaw('cart_id in ('.$cart_ids.') and user_id='.$website_user->id)->get();
        $data = objtoarr($data);

        #返回变化的单价
        $update['sku_price'] = 0;
        $update['all_sku_price'] = 0;
        $update['total_price'] = 0;
        $update['final_price'] = 0;

        foreach ($data as $k=>$v) {
            if (empty($v['services'])) {
                $data[$k]['services_old']=[];
                $data[$k]['services'] = [];
            } else {
                $data[$k]['services_old'] = $v['services'];
                $data[$k]['services'] = json_decode($v['services'], true);
            }
            $data[$k]['services_old'] = $v['services'];
            #这层相当于在店铺
            $data[$k]['sku_info'] = Db::table('cart_sku')->where(['cart_id'=>$v['cart_id'],'selected'=>1,'is_buy'=>0])->get();
            $data[$k]['sku_info'] = objtoarr($data[$k]['sku_info']);
            
            #查找商品
            $goods = Db::table('goods')->where(['goods_id'=>$v['goods_id']])->select(['shop_id','wid','goods_type'])->first();
            $goods = objtoarr($goods);
            
            #当前购物车的商品价格
            $goods_price = 0;

            $freight_num=0;
            $goods_freight_fee=0;
            $data[$k]['services']['additional_money'] = 0;#附加费用
            $data[$k]['services']['potential_money'] = 0;#潜在费用
            foreach ($data[$k]['sku_info'] as $k2=>$v2) {
                #这层相当于是该店铺下该商品下的各规格商品
                $goods_sku = Db::table('goods_sku')->where(['sku_id'=>$v2['sku_id']])->first();
                $goods_sku = objtoarr($goods_sku);
                $goods_sku['sku_prices'] = json_decode($goods_sku['sku_prices'], true);
                
                //获取商品可售库存
                if($goods['shop_id']>0){
                    $post = [
                        'goods_id' => $v['goods_id'],
                        'sku_id'   => $goods_sku['sku_id'],
                        'shop_id'  => $goods['shop_id'],
                        'wid'      => $goods['wid'],
                        'goods_type'=>$goods['goods_type']
                    ];
                    
                    $skunum = httpRequest('https://shop.gogo198.cn/collect_website/public/?s=api/func/get_goods_num', $post);
                    
                    #商品&规格可售库存
                    $goods_sku['sku_prices']['goods_number'] = $skunum;
                }
                
                $goods = Db::table('goods')->where(['goods_id'=>$goods_sku['goods_id']])->first();
                $goods = objtoarr($goods);
                $goods['other_shop'] = json_decode($goods['other_shop'], true);

                #店铺名称
                $data[$k]['shop_name'] = $goods['other_shop']['shopName'];
                #规格/商品图片
                if (!empty($goods_sku['sku_images'])) {
                    $data[$k]['goods_image'] = $goods_sku['sku_images'];
                } else {
                    $data[$k]['goods_image'] = $goods['goods_image'];
                }
                #商品名称
                $data[$k]['goods_name'] = $goods['goods_name'];
                #商品id
                $data[$k]['goods_id'] = $goods['goods_id'];

                #商品（规格）信息==============================start
                $data[$k]['sku_info'][$k2]['bgoods_name'] = $goods['goods_name'];
                if (empty($goods_sku['spec_names'])) {
                    #无规格商品
                    $data[$k]['sku_info'][$k2]['boption_name'] = $goods['goods_name'];
                } else {
                    #有规格商品
                    $data[$k]['sku_info'][$k2]['boption_name'] = $goods_sku['spec_names'];
                }
                #商品规格名称
                if (empty($goods_sku['spec_names'])) {
                    #无规格商品
                    $data[$k]['sku_info'][$k2]['soption_name'] = $goods['goods_name'];
                } else {
                    #有规格商品
                    $data[$k]['sku_info'][$k2]['soption_name'] = $goods_sku['spec_names'];
                }
                #商品（规格）币种&数量&价格（不用重复计算价格了，已经计算了）
                $data[$k]['sku_info'][$k2]['currency'] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$v2['currency']])->first()->currency_symbol_standard;
                $data[$k]['sku_info'][$k2]['price'] = $v2['price'];
                $data[$k]['sku_info'][$k2]['num'] = $v2['goods_num'];

                if ($goods_id==$goods['goods_id'] && $sku_id==$v2['sku_id']) {
                    #数量框+/-：更改商品价钱
                    #判断购买数量有无超过当前规格数量
                    if ($buy_num>$goods_sku['sku_prices']['goods_number']) {
                        return Response()->json(['code'=>-1,'msg'=>'当前购买数量>商品库存']);
                    }

                    foreach ($goods_sku['sku_prices']['start_num'] as $k3=>$v3) {
                        if ($goods_sku['sku_prices']['select_end'][$k3]==1) {
                            #数值
                            if ($buy_num>=$v3 and $buy_num<=$goods_sku['sku_prices']['end_num'][$k3]) {
                                $target_price = $goods_sku['sku_prices']['price'][$k3];
                                $data[$k]['sku_info'][$k2]['num'] = $buy_num;
                                $data[$k]['sku_info'][$k2]['price'] = $buy_num*$target_price;
                                break;
                            }
                        } elseif ($goods_sku['sku_prices']['select_end'][$k3]==2) {
                            #以上
                            if ($buy_num>=$v3) {
                                $target_price = $goods_sku['sku_prices']['price'][$k3];
                                $data[$k]['sku_info'][$k2]['num'] = $buy_num;
                                $data[$k]['sku_info'][$k2]['price'] = $buy_num*$target_price;
                                break;
                            }
                        }
                    }
                    #修改当前购物清单的清单规格表
                    Db::table('cart_sku')->where(['id'=>$v2['id']])->update([
                        'goods_num'=>$buy_num,
                        'price'=>$data[$k]['sku_info'][$k2]['price']
                    ]);

                    #返回的规格单价
                    $update['sku_price'] = number_format($data[$k]['sku_info'][$k2]['price'], 2);
                }
                #商品（规格）信息==============================end

                #附加费用（国内运费）=====================================start
                $freight_num += $v2['goods_num'];
                $goods_freight_fee += $goods['goods_freight_fee'];
                #附加费用（国内运费）=====================================end

                #当前购物车的商品价格
                $goods_price += $data[$k]['sku_info'][$k2]['price'];

//                $data[$k]['currency'] = $data[$k]['sku_info'][$k2]['currency'];
//                $data[$k]['price'] = number_format($goods_price,2);

                #返回的规格单价
                if ($cart_id==$v2['cart_id']) {
                    $update['all_sku_price'] = number_format($goods_price, 2);
                }

                #附加费用=======================================start
                if ($goods['shop_id']==0) {
                    $services_ids = Db::table('cost_service')->where(['pid' => 2, 'company_id' => 0])->get();
                    $services_ids = objtoarr($services_ids);
                    $service_ids_arr = '';
                    foreach ($services_ids as $sk => $sv) {
                        $service_ids_arr .= $sv['id'] . ',';
                    }

                    $data[$k]['services']['additional'] = Db::table('goods_services')->whereRaw('company_id=0 and find_in_set(service_id,"' . rtrim($service_ids_arr, ',') . '")')->get();
                    $data[$k]['services']['additional'] = objtoarr($data[$k]['services']['additional']);
                    foreach ($data[$k]['services']['additional'] as $k3 => $v3) {
                        $data[$k]['services']['additional'][$k3]['currency'] = Db::connection('shop_db')->table('centralize_currency')->where(['id' => $v3['currency']])->first()->currency_symbol_standard;
                        if ($v3['is_select'] == 1) {
                            $data[$k]['services']['additional_money'] += $v3['price'];
                        }
                    }
                } else {
                    #商户企业id
                    if (empty($goods['otherfees_content']) && empty($goods['reduction_content']) && empty($goods['gift_content']) && empty($goods['noinclude_content'])) {
                        $data[$k]['services']['additional'] = [];
                    } else {
                        if (!empty($goods['otherfees_content'])) {
                            #1、其他费用判断
                            $otherfees_content = json_decode($goods['otherfees_content'], true);

                            foreach ($otherfees_content['fees_name'] as $k3=>$v3) {
                                if ($otherfees_content['fees_condition'][$k3]==2) {
                                    #有条件触发

                                    if ($otherfees_content['fees_trigger'][$k3]==1) {
                                        #要素触发
                                        if ($otherfees_content['fees_trigger2_equal'][$k3]==1) {
                                            #少于

                                            #大于/等于就退出当前循环，进行下一个循环（不满足条件）
                                            if ($otherfees_content['fees_trigger2'][$k3]==1) {
                                                #购买数量
                                                if ($v2['goods_num']>=$otherfees_content['fees_trigger2_num'][$k3]) {
                                                    continue;
                                                }
                                            } elseif ($otherfees_content['fees_trigger2'][$k3]==2) {
                                                #购买金额
                                                if ($v2['price']>=$otherfees_content['fees_trigger2_num'][$k3]) {
                                                    continue;
                                                }
                                            }
                                        } elseif ($otherfees_content['fees_trigger2_equal'][$k3]==2) {
                                            #少于或等于

                                            #大于就退出当前循环，进行下一个循环（不满足条件）
                                            if ($otherfees_content['fees_trigger2'][$k3]==1) {
                                                #购买数量
                                                if ($v2['goods_num']>$otherfees_content['fees_trigger2_num'][$k3]) {
                                                    continue;
                                                }
                                            } elseif ($otherfees_content['fees_trigger2'][$k3]==2) {
                                                #购买金额
                                                if ($v2['price']>$otherfees_content['fees_trigger2_num'][$k3]) {
                                                    continue;
                                                }
                                            }
                                        } elseif ($otherfees_content['fees_trigger2_equal'][$k3]==3) {
                                            #等于

                                            #不等于就退出当前循环，进行下一个循环（不满足条件）
                                            if ($otherfees_content['fees_trigger2'][$k3]==1) {
                                                #购买数量
                                                if ($v2['goods_num']!=$otherfees_content['fees_trigger2_num'][$k3]) {
                                                    continue;
                                                }
                                            } elseif ($otherfees_content['fees_trigger2'][$k3]==2) {
                                                #购买金额
                                                if ($v2['price']!=$otherfees_content['fees_trigger2_num'][$k3]) {
                                                    continue;
                                                }
                                            }
                                        } elseif ($otherfees_content['fees_trigger2_equal'][$k3]==4) {
                                            #大于

                                            #少于/等于就退出当前循环，进行下一个循环（不满足条件）
                                            if ($otherfees_content['fees_trigger2'][$k3]==1) {
                                                #购买数量
                                                if ($v2['goods_num']<=$otherfees_content['fees_trigger2_num'][$k3]) {
                                                    continue;
                                                }
                                            } elseif ($otherfees_content['fees_trigger2'][$k3]==2) {
                                                #购买金额
                                                if ($v2['price']<=$otherfees_content['fees_trigger2_num'][$k3]) {
                                                    continue;
                                                }
                                            }
                                        } elseif ($otherfees_content['fees_trigger2_equal'][$k3]==5) {
                                            #大于或等于

                                            #少于就退出当前循环，进行下一个循环（不满足条件）
                                            if ($otherfees_content['fees_trigger2'][$k3]==1) {
                                                #购买数量
                                                if ($v2['goods_num']<$otherfees_content['fees_trigger2_num'][$k3]) {
                                                    continue;
                                                }
                                            } elseif ($otherfees_content['fees_trigger2'][$k3]==2) {
                                                #购买金额
                                                if ($v2['price']<$otherfees_content['fees_trigger2_num'][$k3]) {
                                                    continue;
                                                }
                                            }
                                        }
                                    } elseif ($otherfees_content['fees_trigger'][$k3]==2) {
                                        #型号触发
                                        if ($otherfees_content['fees_options'][$k3]==-1) {
                                            continue;
                                        }
                                        #首先找到商户商品表id和规格
                                        $goods_merchant = Db::table('goods_merchant')->where(['shelf_id'=>$v['goods_id']])->first();
                                        $goods_sku_merchant = Db::table('goods_sku_merchant')->where(['goods_id'=>$goods_merchant->id,'sku_id'=>$otherfees_content['fees_options'][$k3]])->first();
                                        $goods_sku_merchant = objtoarr($goods_sku_merchant);

                                        #不是当前规格就退出当前循环，进行下一个循环（不满足条件）
                                        if ($goods_sku['spec_names']!=$goods_sku_merchant['spec_names']) {
                                            continue;
                                        }
                                    } elseif ($otherfees_content['fees_trigger'][$k3]==3) {
                                        #物流触发（待做）
                                    }
                                }

                                #收费标准
                                if ($otherfees_content['fees_standard'][$k3]==1) {
                                    #定额计价
                                    $data[$k]['services']['additional'][] = [
                                        'name'=>$otherfees_content['fees_name'][$k3],
                                        'desc'=>$otherfees_content['fees_desc'][$k3],
                                        'currency'=>Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$otherfees_content['fees_standard_currency'][$k3]])->first()->currency_symbol_standard,
                                        'price'=>number_format($otherfees_content['fees_standard_price'][$k3], 2)
                                    ];
                                    $data[$k]['services']['additional_money'] += $otherfees_content['fees_standard_price'][$k3];
                                } elseif ($otherfees_content['fees_standard'][$k3]==2) {
                                    #比例计价
                                    if ($otherfees_content['fees_standard_ratio'][$k3]==1) {
                                        #计费基数
                                        $data[$k]['services']['additional'][] = [
                                            'name'=>$otherfees_content['fees_name'][$k3],
                                            'desc'=>$otherfees_content['fees_desc'][$k3],
                                            'currency'=>Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$otherfees_content['fees_standard_currency'][$k3]])->first()->currency_symbol_standard,
                                            'price'=>number_format($otherfees_content['fees_standard_ratio_price'][$k3], 2)
                                        ];
                                        $data[$k]['services']['additional_money'] += $otherfees_content['fees_standard_ratio_price'][$k3];
                                    } elseif ($otherfees_content['fees_standard_ratio'][$k3]==2) {
                                        #计费比率
                                        $ratio_price = ($otherfees_content['fees_standard_ratio_ratio'][$k3] / 100) * $v2['price'];
                                        $data[$k]['services']['additional'][] = [
                                            'name'=>$otherfees_content['fees_name'][$k3],
                                            'desc'=>$otherfees_content['fees_desc'][$k3],
                                            'currency'=>Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$otherfees_content['fees_standard_currency'][$k3]])->first()->currency_symbol_standard,
                                            'price'=>number_format($ratio_price, 2)
                                        ];
                                        $data[$k]['services']['additional_money'] += $ratio_price;
                                    }
                                }
                            }
                        }
                        if (!empty($goods['reduction_content'])) {
                            #2、销售优惠减免判断
                            $reduction_content = json_decode($goods['reduction_content'], true);

                            $reduction_strict = 0;
                            $reduction_arr = [];
                            foreach ($reduction_content['preferential_blong'] as $k3=>$v3) {
                                $rule_name = Db::table('ssl_reduction_rule')->where(['id'=>$reduction_content['type'][$k3]])->first();
                                $rule_name = objtoarr($rule_name);
                                $rule_name['content'] = json_decode($rule_name['content'], true);

                                $name = '';
                                if ($v3==1) {
                                    $name = '卖家优惠';
                                } elseif ($v3==2) {
                                    $name = '平台优惠';
                                } elseif ($v3==3) {
                                    $name = '他方优惠';
                                }

                                if ($reduction_content['strict'][$k3]==1 && $reduction_strict==0) {
                                    #单独
                                    if ($v2['price']>$reduction_content['price1'][$k3]) {
                                        $reduction_arr = [
                                            'name'=>$name,
                                            'desc'=>$rule_name['content'][0].$reduction_content['price1'][$k3].$rule_name['content'][2].$reduction_content['price2'][$k3],
                                            'currency'=>Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$reduction_content['currency1']])->first()->currency_symbol_standard,
                                            'price'=>'-'.number_format($reduction_content['price2'][$k3], 2)
                                        ];
                                        $data[$k]['services']['additional'][] = $reduction_arr;
                                        $data[$k]['services']['additional_money'] -= $reduction_content['price2'][$k3];
                                        break;
                                    }
                                    $reduction_strict=1;
                                } elseif ($reduction_content['strice'][$k3]==2 && ($reduction_strict==0 || $reduction_strict==2)) {
                                    #叠加
                                    if ($v2['price']>$reduction_content['price1'][$k3]) {
                                        $reduction_arr = [
                                            'name' => $name,
                                            'desc' => $rule_name['content'][0] . $reduction_content['price1'][$k3] . $rule_name['content'][2] . $reduction_content['price2'][$k3],
                                            'currency' => Db::connection('shop_db')->table('centralize_currency')->where(['id' => $reduction_content['currency1']])->first()->currency_symbol_standard,
                                            'price' => '-'.number_format($reduction_content['price2'][$k3], 2)
                                        ];
                                        $data[$k]['services']['additional'][] = $reduction_arr;
                                        $data[$k]['services']['additional_money'] -= $otherfees_content['price2'][$k3];
                                    }
                                    $reduction_strict=2;
                                }
                            }
                        }
                        if (!empty($goods['gift_content'])) {
                            #3、随赠优惠判断
                            $gift_content = json_decode($goods['gift_content'], true);

                            $gift_strict = 0;
                            foreach ($gift_content['preferential_blong'] as $k3=>$v3) {
                                $name = '';
                                if ($v3==1) {
                                    $name = '卖家优惠';
                                } elseif ($v3==2) {
                                    $name = '平台优惠';
                                } elseif ($v3==3) {
                                    $name = '他方优惠';
                                }

                                if ($gift_content['strict'][$k3]==1 && $gift_strict==0) {
                                    #单独
                                    $gift_strict=1;
                                } elseif ($gift_content['strict'][$k3]==2 && ($gift_strict==0 || $gift_strict==2)) {
                                    #叠加
                                    $gift_strict=2;
                                } else {
                                    continue;
                                }

                                $gift_project = '随赠项目：';
                                if ($gift_content['type'][$k3]==1) {
                                    $gift_project .= '积分；';

                                    if ($gift_content['points_type'][$k3]==1) {
                                        $gift_project .= '按每订单/次，赠送'.$gift_content['points_send'][$k3].'积分；';
                                    } elseif ($gift_content['points_type'][$k3]==2) {
                                        if ($v2['price']>=$gift_content['points_money'][$k3]) {
                                            $points_currency = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$gift_content['points_currency']])->first()->currency_symbol_standard;
                                            $gift_project .= '按金额满 '.$points_currency.' '.number_format($gift_content['points_money'][$k3], 2).'，赠送'.$gift_content['points_send'][$k3].'积分；';
                                        }
                                    }
                                } elseif ($gift_content['type'][$k3]==2) {
                                    $gift_project .= '卡券；';
                                    $coupon_currency = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$gift_content['coupon_currency']])->first()->currency_symbol_standard;
                                    $gift_project .= '赠送价值 '.$coupon_currency.' '.$gift_content['coupon_money'][$k3].' *'.$gift_content['coupon_num'][$k].'张；';
                                } elseif ($gift_content['type'][$k3]==3) {
                                    $gift_project .= '随赠；';

                                    if ($gift_content['accgift_type'][$k3]==1) {
                                        $gift_project .= '虚拟物品：'.$gift_content['accgift_content'][$k3].' *'.$gift_content['accgift_num'][$k3].'个';
                                    } elseif ($gift_content['accgift_type'][$k3]==2) {
                                        $gift_project .= '额外服务：'.$gift_content['accgift_content'][$k3].' *'.$gift_content['accgift_num'][$k3].'次';
                                    } elseif ($gift_content['accgift_type'][$k3]==3) {
                                        $gift_project .= '实物赠品：'.$gift_content['accgift_content'][$k3].' *'.$gift_content['accgift_num'][$k3].'个';
                                    }
                                }

                                $gift_arr = [
                                    'name'=>$name,
                                    'desc'=>$gift_project,
                                    'currency'=>Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$gift_content['points_currency']])->first()->currency_symbol_standard,
                                    'price'=>'0.00'
                                ];
                                $data[$k]['services']['additional'][] = $gift_arr;
                            }
                        }
                        if (!empty($goods['noinclude_content'])) {
                            #4、价格未含
                            $noinclude_content = json_decode($goods['noinclude_content'], true);
                            foreach ($noinclude_content['name'] as $k3=>$v3) {
                                $data[$k]['services']['additional'][] = [
                                    'name'=>$v3,
                                    'desc'=>$noinclude_content['desc'][$k3],
                                    'currency'=>Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$noinclude_content['currency']])->first()->currency_symbol_standard,
                                    'price'=>number_format($noinclude_content['price'][$k3], 2)
                                ];
                                $data[$k]['services']['additional_money'] += $noinclude_content['price'][$k3];
                            }
                        }
                    }
                }
                #附加费用=======================================end

                #潜在费用=======================================start
                if ($goods['shop_id']==0) {
                    $services_ids = Db::table('cost_service')->where(['pid' => 3, 'company_id' => 0])->get();
                    $services_ids = objtoarr($services_ids);
                    $service_ids_arr = '';
                    foreach ($services_ids as $sk => $sv) {
                        $service_ids_arr .= $sv['id'] . ',';
                    }

                    $data[$k]['services']['potential'] = Db::table('goods_services')->whereRaw('company_id=0 and find_in_set(service_id,"' . rtrim($service_ids_arr, ',') . '")')->get();
                    $data[$k]['services']['potential'] = objtoarr($data[$k]['services']['potential']);
                    foreach ($data[$k]['services']['potential'] as $k3 => $v3) {
                        $data[$k]['services']['potential'][$k3]['currency'] = Db::connection('shop_db')->table('centralize_currency')->where(['id' => $v3['currency']])->first()->currency_symbol_standard;
                        if ($v3['is_select'] == 1) {
                            $data[$k]['services']['potential_money'] += $v3['price'];
                        }
                    }
                } else {
                    #商户企业id

                    if (empty($goods['potential_content'])) {
                        $data[$k]['services']['potential'] = [];
                    } else {
                        if (!empty($goods['potential_content'])) {
                            #1、潜在收费判断
                            $potential_content = json_decode($goods['potential_content'], true);

                            foreach ($potential_content['name'] as $k3 => $v3) {
                                $data[$k]['services']['potential'][] = [
                                    'name' => $v3,
                                    'desc' => $potential_content['desc'][$k3],
                                    'currency' => Db::connection('shop_db')->table('centralize_currency')->where(['id' => $potential_content['currency']])->first()->currency_symbol_standard,
                                    'price' => number_format($potential_content['price'][$k3], 2)
                                ];
                                $data[$k]['services']['potential_money'] += $potential_content['price'][$k3];
                            }
                        }
                    }
                }
                #潜在费用=======================================end
            }

            #商品附加费用：卖家运费/卖家要的费用
            #增值服务=======================================start
            $data[$k]['services']['increment_money'] = 0;

            $services_ids = Db::table('cost_service')->where(['pid'=>1,'company_id'=>0])->get();
            $services_ids = objtoarr($services_ids);
            $service_ids_arr = '';
            foreach ($services_ids as $sk=>$sv) {
                $service_ids_arr .= $sv['id'].',';
            }

            $data[$k]['services']['increment'] = Db::table('goods_services')->whereRaw('company_id=0 and find_in_set(service_id,"'.rtrim($service_ids_arr, ',').'")')->get();
            $data[$k]['services']['increment'] = objtoarr($data[$k]['services']['increment']);

            foreach ($data[$k]['services']['increment'] as $k2=>$v2) {
                $data[$k]['services']['increment'][$k2]['currency'] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$v2['currency']])->first()->currency_symbol_standard;
                if ($v2['is_select']==1) {
                    $data[$k]['services']['increment'][$k2]['final_money'] = $v2['price'];
                } else {
                    $data[$k]['services']['increment'][$k2]['final_money'] = '0.00';
                }
            }

            if (!empty($data[$k]['services_old'])) {
                #已选服务
                $data[$k]['services_old'] = json_decode($data[$k]['services_old'], true);

                foreach ($data[$k]['services_old'] as $k2=>$v2) {
                    $services = Db::table('goods_services')->where(['id'=>$v2['service_id']])->first();
                    $services = objtoarr($services);

                    if ($services['type']==1) {
                        #照片服务/价格递增
                        if ($v2['photonum']>=1) {
                            if ($v2['photonum']>=$services['num']) {
                                $services['price'] = $services['price'] + (($v2['photonum'] - $services['num']) * $services['interval_price']);
                                $data[$k]['services']['increment_money'] += $services['price'];
                                $data[$k]['services']['increment'][$k2]['final_money'] = $services['price'];
                            }
                        }
                    } else {
                        #其他服务
                        $data[$k]['services']['increment_money'] += $services['price'];
                        $data[$k]['services']['increment'][$k2]['final_money'] = $services['price'];
                    }
                }
            } else {
                #未选服务
                foreach ($data[$k]['services']['increment'] as $k2=>$v2) {
                    if ($v2['is_select']==1) {
                        $data[$k]['services']['increment_money'] += $v2['price'];
                    }
                }
            }

            $data[$k]['services']['increment_money'] = number_format($data[$k]['services']['increment_money'], 2);
            #增值服务=======================================end

            #当前购物车id的商品（规格）总价（商品（规格）单价+各服务费用）
            if ($cart_id==$v['cart_id']) {
                $data[$k]['total_price'] = number_format($goods_price+$data[$k]['services']['additional_money']+$data[$k]['services']['increment_money']+$data[$k]['services']['potential_money'], 2);
                #返回的购物车总价
                $update['total_price'] = $data[$k]['total_price'];
            }
            #所有清单的最终价格
            $update['final_price'] += $goods_price+$data[$k]['services']['additional_money']+$data[$k]['services']['increment_money']+$data[$k]['services']['potential_money'];
        }
        #所有清单的最终价格
        $update['final_price'] = number_format($update['final_price'], 2);

        return Response()->json(['code'=>0,'data'=>$update]);
    }

    #更新购物清单的各种费用
    public function update_cart_fees_info($datas)
    {
        $data = Db::table('cart')->whereRaw('cart_id in ('.$datas['cart_id'].') and user_id='.$datas['user_id'])->get();
        $data = objtoarr($data);

        $shop_money = 0;
        foreach ($data as $k=>$v) {
            #这层相当于在店铺
            $data[$k]['sku_info'] = Db::table('cart_sku')->where(['cart_id'=>$v['cart_id'],'selected'=>1,'is_buy'=>0])->get();
            $data[$k]['sku_info'] = objtoarr($data[$k]['sku_info']);

            foreach ($data[$k]['sku_info'] as $k2=>$v2) {
                #这层相当于是该店铺下的各规格商品
                $goods_sku = Db::table('goods_sku')->where(['sku_id'=>$v2['sku_id']])->first();
                $goods_sku = objtoarr($goods_sku);
                $goods_sku['sku_prices'] = json_decode($goods_sku['sku_prices'], true);
                $goods = Db::table('goods')->where(['goods_id'=>$goods_sku['goods_id']])->first();
                $goods = objtoarr($goods);

                if ($goods['shop_id']>0) {
                    #附加费用=======================================start
                    if (!empty($goods['otherfees_content'])) {
                        #1、其他费用判断
                        $otherfees_content = json_decode($goods['otherfees_content'], true);

                        $real_otherfees_content = [];
                        $real_otherfees_money=0;
                        foreach ($otherfees_content['fees_name'] as $k3=>$v3) {
                            if ($otherfees_content['fees_condition'][$k3]==2) {
                                #有条件触发

                                if ($otherfees_content['fees_trigger'][$k3]==1) {
                                    #要素触发
                                    if ($otherfees_content['fees_trigger2_equal'][$k3]==1) {
                                        #少于

                                        #大于/等于就退出当前循环，进行下一个循环（不满足条件）
                                        if ($otherfees_content['fees_trigger2'][$k3]==1) {
                                            #购买数量
                                            if ($v2['goods_num']>=$otherfees_content['fees_trigger2_num'][$k3]) {
                                                continue;
                                            }
                                        } elseif ($otherfees_content['fees_trigger2'][$k3]==2) {
                                            #购买金额
                                            if ($v2['price']>=$otherfees_content['fees_trigger2_num'][$k3]) {
                                                continue;
                                            }
                                        }
                                    } elseif ($otherfees_content['fees_trigger2_equal'][$k3]==2) {
                                        #少于或等于

                                        #大于就退出当前循环，进行下一个循环（不满足条件）
                                        if ($otherfees_content['fees_trigger2'][$k3]==1) {
                                            #购买数量
                                            if ($v2['goods_num']>$otherfees_content['fees_trigger2_num'][$k3]) {
                                                continue;
                                            }
                                        } elseif ($otherfees_content['fees_trigger2'][$k3]==2) {
                                            #购买金额
                                            if ($v2['price']>$otherfees_content['fees_trigger2_num'][$k3]) {
                                                continue;
                                            }
                                        }
                                    } elseif ($otherfees_content['fees_trigger2_equal'][$k3]==3) {
                                        #等于

                                        #不等于就退出当前循环，进行下一个循环（不满足条件）
                                        if ($otherfees_content['fees_trigger2'][$k3]==1) {
                                            #购买数量
                                            if ($v2['goods_num']!=$otherfees_content['fees_trigger2_num'][$k3]) {
                                                continue;
                                            }
                                        } elseif ($otherfees_content['fees_trigger2'][$k3]==2) {
                                            #购买金额
                                            if ($v2['price']!=$otherfees_content['fees_trigger2_num'][$k3]) {
                                                continue;
                                            }
                                        }
                                    } elseif ($otherfees_content['fees_trigger2_equal'][$k3]==4) {
                                        #大于

                                        #少于/等于就退出当前循环，进行下一个循环（不满足条件）
                                        if ($otherfees_content['fees_trigger2'][$k3]==1) {
                                            #购买数量
                                            if ($v2['goods_num']<=$otherfees_content['fees_trigger2_num'][$k3]) {
                                                continue;
                                            }
                                        } elseif ($otherfees_content['fees_trigger2'][$k3]==2) {
                                            #购买金额
                                            if ($v2['price']<=$otherfees_content['fees_trigger2_num'][$k3]) {
                                                continue;
                                            }
                                        }
                                    } elseif ($otherfees_content['fees_trigger2_equal'][$k3]==5) {
                                        #大于或等于

                                        #少于就退出当前循环，进行下一个循环（不满足条件）
                                        if ($otherfees_content['fees_trigger2'][$k3]==1) {
                                            #购买数量
                                            if ($v2['goods_num']<$otherfees_content['fees_trigger2_num'][$k3]) {
                                                continue;
                                            }
                                        } elseif ($otherfees_content['fees_trigger2'][$k3]==2) {
                                            #购买金额
                                            if ($v2['price']<$otherfees_content['fees_trigger2_num'][$k3]) {
                                                continue;
                                            }
                                        }
                                    }
                                } elseif ($otherfees_content['fees_trigger'][$k3]==2) {
                                    #型号触发
                                    if ($otherfees_content['fees_options'][$k3]==-1) {
                                        continue;
                                    }
                                    #首先找到商户商品表id和规格
                                    $goods_merchant = Db::table('goods_merchant')->where(['shelf_id'=>$v['goods_id']])->first();
                                    $goods_sku_merchant = Db::table('goods_sku_merchant')->where(['goods_id'=>$goods_merchant->id,'sku_id'=>$otherfees_content['fees_options'][$k3]])->first();
                                    $goods_sku_merchant = objtoarr($goods_sku_merchant);

                                    #不是当前规格就退出当前循环，进行下一个循环（不满足条件）
                                    if ($goods_sku['spec_names']!=$goods_sku_merchant['spec_names']) {
                                        continue;
                                    }
                                } elseif ($otherfees_content['fees_trigger'][$k3]==3) {
                                    #物流触发（待做）
                                }
                            }

                            #收费标准
                            if ($otherfees_content['fees_standard'][$k3]==1) {
                                #定额计价
                                $real_otherfees_content[] = [
                                    'name'=>$otherfees_content['fees_name'][$k3],
                                    'desc'=>$otherfees_content['fees_desc'][$k3],
                                    'currency'=>Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$otherfees_content['fees_standard_currency'][$k3]])->first()->currency_symbol_standard,
                                    'price'=>number_format($otherfees_content['fees_standard_price'][$k3], 2)
                                ];
                                $real_otherfees_money += $otherfees_content['fees_standard_price'][$k3];
                            } elseif ($otherfees_content['fees_standard'][$k3]==2) {
                                #比例计价
                                if ($otherfees_content['fees_standard_ratio'][$k3]==1) {
                                    #计费基数
                                    $real_otherfees_content[] = [
                                        'name'=>$otherfees_content['fees_name'][$k3],
                                        'desc'=>$otherfees_content['fees_desc'][$k3],
                                        'currency'=>Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$otherfees_content['fees_standard_currency'][$k3]])->first()->currency_symbol_standard,
                                        'price'=>number_format($otherfees_content['fees_standard_ratio_price'][$k3], 2)
                                    ];
                                    $real_otherfees_money += $otherfees_content['fees_standard_ratio_price'][$k3];
                                } elseif ($otherfees_content['fees_standard_ratio'][$k3]==2) {
                                    #计费比率
                                    $ratio_price = ($otherfees_content['fees_standard_ratio_ratio'][$k3] / 100) * $v2['price'];
                                    $real_otherfees_content[] = [
                                        'name'=>$otherfees_content['fees_name'][$k3],
                                        'desc'=>$otherfees_content['fees_desc'][$k3],
                                        'currency'=>Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$otherfees_content['fees_standard_currency'][$k3]])->first()->currency_symbol_standard,
                                        'price'=>number_format($ratio_price, 2)
                                    ];
                                    $real_otherfees_money += $ratio_price;
                                }
                            }
                        }

                        #更改购物清单其他费用的信息
                        $shop_money += $real_otherfees_money;
                        Db::table('cart')->where(['cart_id'=>$v['cart_id']])->update([
                            'otherfee_content'=>json_encode($real_otherfees_content, true),
                            'otherfee_currency'=>$goods['goods_currency'],
                            'otherfee_total'=>$real_otherfees_money
                        ]);
                    }

                    if (!empty($goods['reduction_content'])) {
                        #2、销售优惠减免判断
                        $reduction_content = json_decode($goods['reduction_content'], true);

                        $real_reduction_content = [];
                        $real_reduction_money=0;
                        $reduction_strict = 0;
                        $reduction_arr = [];
                        foreach ($reduction_content['preferential_blong'] as $k3=>$v3) {
                            $rule_name = Db::table('ssl_reduction_rule')->where(['id'=>$reduction_content['type'][$k3]])->first();
                            $rule_name = objtoarr($rule_name);
                            $rule_name['content'] = json_decode($rule_name['content'], true);

                            $name = '';
                            if ($v3==1) {
                                $name = '卖家优惠';
                            } elseif ($v3==2) {
                                $name = '平台优惠';
                            } elseif ($v3==3) {
                                $name = '他方优惠';
                            }

                            if ($reduction_content['strict'][$k3]==1 && $reduction_strict==0) {
                                #单独
                                if ($v2['price']>$reduction_content['price1'][$k3]) {
                                    $reduction_arr = [
                                        'name'=>$name,
                                        'desc'=>$rule_name['content'][0].$reduction_content['price1'][$k3].$rule_name['content'][2].$reduction_content['price2'][$k3],
                                        'currency'=>Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$reduction_content['currency1']])->first()->currency_symbol_standard,
                                        'price'=>'-'.number_format($reduction_content['price2'][$k3], 2)
                                    ];
                                    $real_reduction_content[] = $reduction_arr;
                                    $real_reduction_money += $reduction_content['price2'][$k3];
                                    break;
                                }
                                $reduction_strict=1;
                            } elseif ($reduction_content['strice'][$k3]==2 && ($reduction_strict==0 || $reduction_strict==2)) {
                                #叠加
                                if ($v2['price']>$reduction_content['price1'][$k3]) {
                                    $reduction_arr = [
                                        'name' => $name,
                                        'desc' => $rule_name['content'][0] . $reduction_content['price1'][$k3] . $rule_name['content'][2] . $reduction_content['price2'][$k3],
                                        'currency' => Db::connection('shop_db')->table('centralize_currency')->where(['id' => $reduction_content['currency1']])->first()->currency_symbol_standard,
                                        'price' => '-'.number_format($reduction_content['price2'][$k3], 2)
                                    ];
                                    $real_reduction_content[] = $reduction_arr;
                                    $real_reduction_money += $otherfees_content['price2'][$k3];
                                }
                                $reduction_strict=2;
                            }
                        }

                        #更改购物清单其他费用的信息
                        $shop_money -= $real_reduction_money;
                        Db::table('cart')->where(['cart_id'=>$v['cart_id']])->update([
                            'reduction_content'=>json_encode($real_reduction_content, true),
                            'reduction_money'=>$real_reduction_money
                        ]);
                    }

                    if (!empty($goods['gift_content'])) {
                        #3、随赠优惠判断
                        $gift_content = json_decode($goods['gift_content'], true);

                        $real_gift_content = [];
                        $real_gift_money=0;
                        $gift_strict = 0;
                        foreach ($gift_content['preferential_blong'] as $k3=>$v3) {
                            $name = '';
                            if ($v3==1) {
                                $name = '卖家优惠';
                            } elseif ($v3==2) {
                                $name = '平台优惠';
                            } elseif ($v3==3) {
                                $name = '他方优惠';
                            }

                            if ($gift_content['strict'][$k3]==1 && $gift_strict==0) {
                                #单独
                                $gift_strict=1;
                            } elseif ($gift_content['strict'][$k3]==2 && ($gift_strict==0 || $gift_strict==2)) {
                                #叠加
                                $gift_strict=2;
                            } else {
                                continue;
                            }

                            $gift_project = '随赠项目：';
                            if ($gift_content['type'][$k3]==1) {
                                $gift_project .= '积分；';

                                if ($gift_content['points_type'][$k3]==1) {
                                    $gift_project .= '按每订单/次，赠送'.$gift_content['points_send'][$k3].'积分；';
                                } elseif ($gift_content['points_type'][$k3]==2) {
                                    if ($v2['price']>=$gift_content['points_money'][$k3]) {
                                        $points_currency = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$gift_content['points_currency']])->first()->currency_symbol_standard;
                                        $gift_project .= '按金额满 '.$points_currency.' '.number_format($gift_content['points_money'][$k3], 2).'，赠送'.$gift_content['points_send'][$k3].'积分；';
                                    }
                                }
                            } elseif ($gift_content['type'][$k3]==2) {
                                $gift_project .= '卡券；';
                                $coupon_currency = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$gift_content['coupon_currency']])->first()->currency_symbol_standard;
                                $gift_project .= '赠送价值 '.$coupon_currency.' '.$gift_content['coupon_money'][$k3].' *'.$gift_content['coupon_num'][$k].'张；';
                            } elseif ($gift_content['type'][$k3]==3) {
                                $gift_project .= '随赠；';

                                if ($gift_content['accgift_type'][$k3]==1) {
                                    $gift_project .= '虚拟物品：'.$gift_content['accgift_content'][$k3].' *'.$gift_content['accgift_num'][$k3].'个';
                                } elseif ($gift_content['accgift_type'][$k3]==2) {
                                    $gift_project .= '额外服务：'.$gift_content['accgift_content'][$k3].' *'.$gift_content['accgift_num'][$k3].'次';
                                } elseif ($gift_content['accgift_type'][$k3]==3) {
                                    $gift_project .= '实物赠品：'.$gift_content['accgift_content'][$k3].' *'.$gift_content['accgift_num'][$k3].'个';
                                }
                            }

                            $real_gift_content[] = [
                                'name'=>$name,
                                'desc'=>$gift_project,
                                'currency'=>Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$gift_content['points_currency']])->first()->currency_symbol_standard,
                                'price'=>'0.00'
                            ];
                        }

                        #更改购物清单其他费用的信息
                        $shop_money += $real_gift_money;
                        Db::table('cart')->where(['cart_id'=>$v['cart_id']])->update([
                            'prefe_gift'=>json_encode($real_gift_content, true),
                            'gift_money'=>$real_gift_money
                        ]);
                    }

                    if (!empty($goods['noinclude_content'])) {
                        #4、价格未含
                        $noinclude_content = json_decode($goods['noinclude_content'], true);

                        $real_noinclude_content = [];
                        $real_noinclude_money=0;
                        foreach ($noinclude_content['name'] as $k3=>$v3) {
                            $real_noinclude_content[] = [
                                'name'=>$v3,
                                'desc'=>$noinclude_content['desc'][$k3],
                                'currency'=>Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$noinclude_content['currency']])->first()->currency_symbol_standard,
                                'price'=>number_format($noinclude_content['price'][$k3], 2)
                            ];
                            $real_noinclude_money += $noinclude_content['price'][$k3];
                        }

                        #更改购物清单其他费用的信息
                        $shop_money += $real_noinclude_money;
                        Db::table('cart')->where(['cart_id'=>$v['cart_id']])->update([
                            'noinclude_content'=>json_encode($real_noinclude_content, true),
                            'noinclude_money'=>$real_noinclude_money
                        ]);
                    }
                    #附加费用=======================================end

                    #潜在费用=======================================start
                    if (!empty($goods['potential_content'])) {
                        $potential_content = json_decode($goods['potential_content'], true);

                        $real_potential_content = [];
                        $real_potential_money = 0;
                        foreach ($potential_content['name'] as $k3 => $v3) {
                            $real_potential_content[] = [
                                'name' => $v3,
                                'desc' => $potential_content['desc'][$k3],
                                'currency' => Db::connection('shop_db')->table('centralize_currency')->where(['id' => $potential_content['currency'][$k3]])->first()->currency_symbol_standard,
                                'price' => number_format($potential_content['price'][$k3], 2)
                            ];
                            $real_potential_money += $potential_content['price'][$k3];
                        }

                        #更改购物清单其他费用的信息
                        $shop_money += $real_potential_money;
                        Db::table('cart')->where(['cart_id'=>$v['cart_id']])->update([
                            'potential_content'=>json_encode($real_potential_content, true),
                            'potential_money'=>$real_potential_money
                        ]);
                    }
                    #潜在费用=======================================end
                }
            }
        }

        return $shop_money;
    }

    #申请订购（代发的仓库商品才需要申请订购）
    public function apply_order(Request $request)
    {
        $data = $request->except(['_token']);
        
        $cart_id = explode(',', rtrim($data['cart_id'], ','));
        $addr_id = isset($data['addr_id'])?intval($data['addr_id']):0;
        $is_daifa = isset($data['is_daifa'])?intval($data['is_daifa']):2;#1正常仓库发货，2代发
        $company_id = 0;#订单归属商户id
        
        $website_user = Db::connection('shop_db')->table('website_user')->where(['custom_id'=>session('user')['gogo_id']])->first();

        #正式修改购物清单里含商户商品的已判断符合条件的费用信息
        $shop_goods_money = $this->update_cart_fees_info(['cart_id'=>rtrim($data['cart_id'], ','),'user_id'=>$website_user->id]);
        
        DB::beginTransaction();
        try {
            $user = get_userid();#官网用户id
            $ordersn = get_ordersn(2);#订购单编号

            #订购单总价格
            $true_price = $shop_goods_money;
            
            #订购单信息
            $content = ['goods_info' => [], 'warehouse_id' => 16,'delivery_method'=>0,'gather_method'=>0,'line_id'=>0,'address_id'=>0];
            $cart_info = [];
            
            #不包邮的运费
            $carts = Db::table('cart')->whereRaw('cart_id in ('.rtrim($data['cart_id'], ',').') and user_id='.$website_user->id)->get();
            $carts = objtoarr($carts);
            $freight_money = $this->calc_freight($carts,$carts[0]['freight_id']);#计算运费
            
            foreach ($cart_id as $k => $v) {
                $cart_sku = Db::table('cart_sku')->where(['cart_id' => $v,'selected'=>1])->get();
                $cart_sku = objtoarr($cart_sku);
                
                $cart = Db::table('cart')->where(['cart_id' => $v])->first();
                #收货方式
                $content['delivery_method'] = $cart->delivery_method;
                $content['gather_method'] = $cart->gather_method;
                $content['line_id'] = $cart->line_id;
                $addr_id = $content['address_id'] = $cart->address_id;
                
                foreach ($cart_sku as $k2=>$v2) {
                    $true_price = $true_price + $v2['price'];

                    #组装订购清单商品数据
                    $cart = Db::table('cart')->where(['cart_id' => $v])->first();
                    
                    #商品归属商户id
                    $ginfo = Db::table('goods')->where(['goods_id'=>$cart->goods_id])->select('shop_id')->first();
                    $company_id = $ginfo->shop_id;
                    
                    if (empty($content['goods_info'])) {
                        $content['goods_info'] = array_merge($content['goods_info'], [[
                            'good_id' => $cart->goods_id,
                            #其他费用
                            'otherfee_content' => $cart->otherfee_content,
                            'otherfee_currency' => $cart->otherfee_currency,
                            'otherfee_total' => $cart->otherfee_total,
                            #优惠减免
                            'reduction_content'=>$cart->reduction_content,
                            'reduction_money' => $cart->reduction_money,
                            #随赠优惠
                            'prefe_gift'=>$cart->prefe_gift,
                            'prefe_reduction' => $cart->prefe_reduction,#废弃
                            'gift_money' => $cart->gift_money,
                            #价格未含
                            'noinclude_content'=>$cart->noinclude_content,
                            'noinclude_money'=>$cart->noinclude_money,
                            #潜在收费
                            'potential_content'=>$cart->potential_content,
                            'potential_money'=>$cart->potential_money,
                            #监管文件
                            'file' => $cart->file,
                            #其他+增值服务费用（第三方平台的商品所有的服务都在这里，商户商品除外）
                            'services' => $cart->services,
                            'sku_info' => []
                        ]]);
                    } else {
                        $is_have = 0;
                        foreach ($content['goods_info'] as $k3 => $v3) {
                            if ($v3['good_id'] == $cart->goods_id) {
                                $is_have = 1;
                            }
                        }

                        if ($is_have == 0) {
                            #没出现相同商品id
                            $content['goods_info'] = array_merge($content['goods_info'], [[
                                'good_id' => $cart->goods_id,
                                #其他费用
                                'otherfee_content' => $cart->otherfee_content,
                                'otherfee_currency' => $cart->otherfee_currency,
                                'otherfee_total' => $cart->otherfee_total,
                                #优惠减免
                                'reduction_content'=>$cart->reduction_content,
                                'reduction_money' => $cart->reduction_money,
                                #随赠优惠
                                'prefe_gift'=>$cart->prefe_gift,
                                'prefe_reduction' => $cart->prefe_reduction,#废弃
                                'gift_money' => $cart->gift_money,
                                #价格未含
                                'noinclude_content'=>$cart->noinclude_content,
                                'noinclude_money'=>$cart->noinclude_money,
                                #潜在收费
                                'potential_content'=>$cart->potential_content,
                                'potential_money'=>$cart->potential_money,
                                #监管文件
                                'file' => $cart->file,
                                #其他+增值服务费用（第三方平台的商品所有的服务都在这里，商户商品除外
                                'services' => $cart->services,
                                'sku_info' => []
                            ]]);
                        }
                    }

                    #在响应商品id下插入规格信息
                    foreach ($content['goods_info'] as $k3 => $v3) {
                        if ($v3['good_id'] == $cart->goods_id) {
                            $cart_info = array_merge($cart_info, [$v]);
                            $content['goods_info'][$k3]['sku_info'] = array_merge($content['goods_info'][$k3]['sku_info'], [[
                                'sku_id' => $v2['sku_id'],
                                'goods_num' => $v2['goods_num'],
                                'price' => $v2['price'],
                                'currency' => $v2['currency'],
                                'cart_id' => $v2['cart_id'],
                            ]]);
                        }
                    }

                    #选购清单下的规格商品修改为已订购
                    Db::table('cart_sku')->where(['id'=>$v2['id']])->update(['is_buy'=>1]);
                }
            }

            sleep(1);

            #更改当前选购清单为已买/未买
            $cart_info = array_values(array_unique($cart_info));
            foreach ($cart_info as $k=>$v) {
                #更改当前选购清单为已买/未买
                $is_buy = 1;
                $cart_sku = Db::table('cart_sku')->where(['cart_id' => $v])->get();
                $cart_sku = objtoarr($cart_sku);
                foreach ($cart_sku as $k2=>$v2) {
                    if ($v2['is_buy']==0) {
                        $is_buy = 0;
                    }
                }
                Db::table('cart')->where(['cart_id' => $v])->update(['is_buy'=>$is_buy]);

                #计算服务费用
                $cart = Db::table('cart')->where(['cart_id' => $v])->first();
                $cart = objtoarr($cart);
                $cart['services'] = json_decode($cart['services'], true);
                $services_money = 0;

                foreach ($cart['services'] as $k2=>$v2) {
                    $services = Db::table('goods_services')->where(['id'=>$v2['service_id']])->first();
                    $services = objtoarr($services);
                    if ($services['type']==1) {
                        if ($v2['photonum']>$services['num']) {
                            $services_money += $services['price'] + (($v2['photonum'] - 1) * $services['interval_price']);
                        } else {
                            $services_money += $services['price'];
                        }
                    } else {
                        $services_money += $services['price'];
                    }
                }

//                - $cart['reduction_money'] - $cart['gift_money'] + $cart['otherfee_total']
                $true_price = $true_price + $services_money;
            }

            $status = -2;#代发：待确认有无货
            if($is_daifa==1){
                #不是代发，系统直接发货
                $status = 0;
            }
            
            #计算立减金额（2026/02/06）到时候再做控件
            #1、（平台/卖家）订单金额*0.15（15%）
            $platform_money = ($true_price + $freight_money) * 0.15;
            $platform_money = (float)sprintf("%.2f", $platform_money);
            
            #2、（账户）订单金额*0.2（20%）
            $member_coupon = Db::connection('shop_db')->table('website_user_coupon')->where(['type'=>3,'uid'=>$website_user->id])->first();
            $member_money = $member_coupon->price * 0.2;
            $member_money = (float)sprintf("%.2f", $member_money);
            
            #3、抵扣金额，谁小用谁
            $coupon_money = 0;
            $use_member_coupon = 0;
            if($platform_money>$member_money){
                #用户账户卡券
                $coupon_money = number_format($member_money, 2);
                $totalAmount = $member_coupon->price - $member_money;
                Db::connection('shop_db')->table('website_user_coupon')->where(['type'=>3,'uid'=>$website_user->id])->update(['price'=>$totalAmount]);
                $use_member_coupon = 1;
                
            }else{$coupon_money = number_format($platform_money,2);}
            
            $time = time();
            $orderid = Db::connection('shop_db')->table('website_order_list')->insertGetId([
                'user_id' => $user->id,
                'ordersn' => $ordersn,
                'company_id' => $company_id,#订单归属商户（商品由谁创建）
                'order_type' => 1,
                'pay_method' => 1,
                'freight_id' => $carts[0]['freight_id'],#不包邮的商品才有数据
                'freight_money' => $freight_money,
                'coupon_money' => $coupon_money,
                'true_money' => $true_price + $freight_money - $coupon_money,
                'content' => json_encode($content, true),
                'is_daifa' => $is_daifa,
                'address_id' => $addr_id,
                'status' => $status,#待确认有无货
                'createtime' => $time,
            ]);

            if($use_member_coupon==1){
                #使用了会员账户卡券，记录
                Db::connection('shop_db')->table('website_user_coupon_log')->insert([
                    'coupon_id'=>$member_coupon->id,
                    'uid'=>$member_coupon->uid,
                    'type'=>1,
                    'order_id'=>$orderid,
                    'multiple'=>0,
                    'opera'=>1,
                    'price'=>$coupon_money,
                    'desc'=>'卡券余额支付下单：-￥'.$coupon_money,
                    'status'=>0,
                    'createtime'=>$time
                ]);
            }

            if($is_daifa==1){
                #不是代发
                return Response()->json(['code'=>0,'msg'=>'正在跳转收银台，请稍等...','data'=>['orderid'=>$orderid]]);
            }elseif($is_daifa==2){
                #是代发
                if ($orderid > 0) {
                    shuntWechat([
                        'first' => '订购清单[' . $ordersn . ']',
                        'keyword1' => '订购清单[' . $ordersn . ']',
                        'keyword2' => '申请订购',
                        'remark' => '查看详情',
                        'url' => 'https://www.gogo198.net/?s=shop/audit',
                        'temp_id' => 'SVVs5OeD3FfsGwW0PEfYlZWetjScIT8kDxht5tlI1V8'
                    ]);
                    DB::commit();
                    return Response()->json(['code'=>0,'msg'=>'申请订购成功，请等待消息','data'=>['ordersn'=>$ordersn]]);
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            echo $e->getCode();
            return Response()->json(['code'=>-1,'msg'=>'系统错误，请联系管理员']);
        }
    }

    #立即订购（废弃）
    public function buy_goods(Request $request)
    {
        $data = $request->except(['_token']);
//        $datas = $data['data'];
        
//        DB::beginTransaction();
//        try {
        #1、获取商品信息
        $goods = Db::table('goods')->where(['goods_id'=>$data['good_id']])->first();
        $goods = objtoarr($goods);

        #1.1、平台监管文件
        $file = [];
//            for($i=0;$i<9;$i++){
//                if(isset($data['data']['supervise_file['.$i])){
//                    array_push($file,$data['data']['supervise_file['.$i]);
//                }
//            }
        if (isset($data['data']['supervise_file'])) {
            foreach ($data['data']['supervise_file'] as $k=>$v) {
                array_push($file, $v['file']);
            }
        }

        #2、整理规格的数量+总价
        $content = ['good_id'=>$data['good_id'],'shop_id'=>$data['shop_id'],'good_num'=>0,'good_price'=>0,'buy_attr'=>$data['buy_attr']];
        foreach ($data['buy_attr'] as $k=>$v) {
            $content['good_num'] += $v['buy_num'];
            $content['good_price'] += $v['now_gprice'];
        }

        #3、其他费用
        $goods['otherfee_content'] = json_decode($goods['otherfee_content'], true);
        $goods['otherfee_total'] = 0;
        $goods['otherfee_currency'] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$goods['otherfee_content']['currency'][0]])->first()->currency_symbol_standard;
        foreach ($goods['otherfee_content']['standard'] as $k=>$v) {
            if ($v==1) {
                #按订单数量(1张)
                $goods['otherfee_total'] += $goods['otherfee_content']['price'][$k];
                $goods['otherfee_content']['otherfee_standard_name'][$k] = '按订单数量';
            } elseif ($v==2) {
                #按包裹数量（1个）
                $goods['otherfee_total'] += $goods['otherfee_content']['price'][$k];
                $goods['otherfee_content']['otherfee_standard_name'][$k] = '按包裹数量';
            } elseif ($v==3) {
                #按商品数量
                $goods['otherfee_content']['price'][$k] = str_replace(',', '', number_format(intval($content['good_num']) * $goods['otherfee_content']['price'][$k], 2));
                $goods['otherfee_total'] += $goods['otherfee_content']['price'][$k];
                $goods['otherfee_content']['otherfee_standard_name'][$k] = '按商品数量';
            } elseif ($v==4) {
                #按服务次数（1次）
                $goods['otherfee_total'] += $goods['otherfee_content']['price'][$k];
                $goods['otherfee_content']['otherfee_standard_name'][$k] = '按服务次数';
            } elseif ($v==5) {
                #按商品总价比率
                $goods['otherfee_content']['price'][$k] = str_replace(',', '', number_format($content['good_price'] * $goods['otherfee_content']['price'][$k], 2));
                $goods['otherfee_total'] += $goods['otherfee_content']['price'][$k];
                $goods['otherfee_content']['otherfee_standard_name'][$k] = '按商品总价比率';
            }
        }
        $content['other_fee'] = ['otherfee_content'=>$goods['otherfee_content'],'otherfee_total'=>$goods['otherfee_total'],'otherfee_currency'=>$goods['otherfee_currency']];

        #4、减免优惠
        $content['reduction_money'] = 0;
        if (isset($data['prefe_reduction'])) {
            foreach ($data['prefe_reduction'] as $k=>$v) {
                $content['reduction_money'] += $v['reduction_price'];
            }
        }

        #5、随赠优惠
        $content['gift_money'] = 0;
        $prefe_gift = [];
        if (isset($data['prefe_gift'])) {
            foreach ($data['prefe_gift'] as $k => $v) {
                if ($v['type'] == 1) {
                    #积分
                    $content['gift_money'] += $v['points_send'];
                } elseif ($v['type'] == 2) {
                    #卡券
                    $content['gift_money'] += $v['coupon_money'] * $v['coupon_num'];
                } elseif ($v['type'] == 3) {
                    #随赠(不需要计算)
                    $name = '';
                    if ($v['accgift_type'] == 1) {
                        $name = '虚拟';
                    } elseif ($v['accgift_type'] == 2) {
                        $name = '服务';
                    } elseif ($v['accgift_type'] == 3) {
                        $name = '实物';
                    }

                    array_push($prefe_gift, ['strict' => $v['strict'], 'type' => $v['type'], 'accgift_type' => $v['accgift_type'], 'accgift_typeName' => $name, 'accgift_content' => $v['accgift_content'], 'accgift_num' => $v['accgift_num']]);
                }
            }
        }
        $content['prefe_gift'] = $prefe_gift;

        #5.1、业务服务
        $content['services'] = [];
        $services_money = 0;
        if (isset($data['services_attr'])) {
            foreach ($data['services_attr'] as $k=>$v) {
                $services = Db::table('goods_services')->where(['id'=>$v['service_id']])->first();
                $services = objtoarr($services);
                if ($v['service_id']==1) {
                    $data['services_attr'][$k]['photoRequest'] = explode('@@@', rtrim($v['photoRequest'], '@@@'));
                    if ($v['photonum']>1) {
                        $services_money += $services['price'] + (($v['photonum'] - 1) * $services['interval_price']);
                    }
                } else {
                    $services_money += $services['price'];
                }
            }
            $content['services'] = $data['services_attr'];
        }

        #5.2、收货地址
//            $content['address_id'] = $data['address_id'];

        #6、实付费用
        $content['true_price'] = ($content['good_price'] + $content['other_fee']['otherfee_total'] + $services_money) - ($content['reduction_money'] + $content['gift_money']);
        #6.1、平台监管文件
        $content['file'] = $file;

        #7、保存入数据表（购购网订单表+国内结算表）
        DB::beginTransaction();
        try {
            $user = Db::table('user')->where(['user_id' => session('user')['user_id']])->first();
            $user2 = Db::connection('shop_db')->table('website_user')->where(['custom_id' => $user->gogo_id])->first();
            $time = time();
            $ordersn = 'GP' . date('YmdH', $time) . str_pad(
                mt_rand(1, 999999),
                6,
                '0',
                STR_PAD_LEFT
            ) . substr(microtime(), 2, 6);
            $orderid = Db::connection('shop_db')->table('website_order_list')->insertGetId([
                    'user_id' => $user2->id,
                    'ordersn' => $ordersn,
                    'order_type' => 1,
                    'pay_method' => 1,
                    'true_money' => $content['true_price'],
                    'content' => json_encode($content, true),
                    'status' => $data['isapply']==1 ? -1 : 0,
                    'createtime' => $time,
                ]);

            $system = Db::connection('shop_db')->table('centralize_system_notice')->where(['uid'=>0])->first();
            $system = objtoarr($system);

            $ordersn2 = 'GP' . date('YmdH', $time) . str_pad(
                mt_rand(1, 999999),
                6,
                '0',
                STR_PAD_LEFT
            ) . substr(microtime(), 2, 6);
            $collect_id = Db::connection('shop_db')->table('customs_collection')->insertGetId([
                    'uniacid' => 3,
                    'openid' => $user2->openid,
                    'send_openid' => $system['account'],#到时候换老板的微信
                    'ordersn' => $ordersn2,
                    'trade_price' => $content['true_price'],
                    'trade_type' => 1,
                    'order_type'=>1,
                    'good_id' => $data['good_id'],
                    'payer_name' => !empty($user2->realname) ? $user2->realname : $user2->nickname,
                    'payer_tel' => !empty($user2->phone) ? $user2->phone : '',
                    'pay_term' => 0,
                    'pay_fee' => 0,
                    'overdue' => '',
                    'overdue_money' => 0,
                    'total_money' => $content['true_price'],
                    'trans_form' => 1,
                    'status' => 0,
                    'basic'=>2,
                    'createtime' => $time,
                    'orderno' => $ordersn,
                    'orderurl' => 'https://www.gogo198.net/?s=index/tb_order_detail&id=' . $orderid
                ]);

            sleep(1);
            $res = Db::connection('shop_db')->table('website_order_list')->where(['id' => $orderid])->update([
                    'pay_id' => $collect_id
                ]);

            DB::commit();
            if ($res) {
                #创建国内结算二维码
                $code_url = $this->create_code(1, $collect_id, $data['good_id']);
                sleep(1);
                Db::connection('shop_db')->table('website_order_list')->where(['id' => $orderid])->update([
                        'code_url' => $code_url
                    ]);
                if ($data['isapply']==1) {
                    return response()->json(['code'=>0,'msg'=>'正在跳转','data'=>['order_id'=>$orderid]]);
                }
                return response()->json(['code'=>0,'msg'=>'生成订单成功','data'=>['code_url'=>$code_url,'pay_method'=>1]]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            echo $e->getCode();
            return response()->json(['code'=>-1,'msg'=>'系统错误，请联系管理员']);
        }
//        }catch(\Exception $e){
//            DB::rollBack();
//            echo $e->getMessage();
//            echo $e->getCode();
//            return response()->json(['code'=>-1,'msg'=>'系统错误，请联系管理员']);
//        }
    }

    #收银台
    public function cashier(Request $request)
    {
        $data = $request->except(['_token']);
        $orderid = intval($data['orderid']);
        $origin_page = '/cashier?orderid='.$orderid;

        $mid = !empty($data['mid']) ? base64_decode($data['mid']) : 0;
        if ($mid>0) {
            #默认登录
            $user = Db::connection('shop_db')->table('website_user')->where(['id'=>$mid])->first();

            $acc = Db::table('user')->where(['gogo_id'=>$user->custom_id])->first();
            $acc = objtoarr($acc);

            $request->session()->put('user', $acc);
            session('user', $acc);

            $loginField = 'email';
            $loginAcc = '';
            if (!empty($acc['email'])) {
                $loginField = 'email';
                $loginAcc = $acc['email'];
            } elseif (!empty($acc['mobile'])) {
                $loginField = 'mobile';
                $loginAcc = $acc['mobile'];
            }

            auth()->guard('user')->attempt(
                [$loginField=>$loginAcc,'password'=>'888888'],
                $request->filled('remember')
            );

            sleep(1);
        }

        $user = session('user');
        if (empty($user)) {
            header('Location: /login.html?open=4&param2='.base64_encode($origin_page));
        }

        #订单信息
        $order = Db::connection('shop_db')->table('website_order_list')->where(['id'=>$orderid])->first();
        $order = objtoarr($order);
        $order['content'] = json_decode($order['content'], true);
        // dd($order['content']);
        #订单币种
        $order['currency'] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$order['currency']])->first()->currency_symbol_standard;

        #查看商品的商家是否包含货到付款
        $cash_on_delivery = ['cash_on_delivery'=>1,'down_payment'=>1,'prepaid_method'=>1,'prepaid_percent'=>'','prepaid_currency'=>'','prepaid_amount'=>''];
        foreach ($order['content']['goods_info'] as $k=>$v) {
            $g = Db::table('goods')->where(['goods_id'=>$v['good_id']])->select('shop_id')->first();
            if ($g->shop_id > 0) {
                $basic = Db::connection('shop_db')->table('website_basic')->where(['company_id'=>$g->shop_id])->select(['cash_on_delivery','down_payment','prepaid_method','prepaid_percent','prepaid_currency','prepaid_amount'])->first();
                if ($basic->cash_on_delivery==2) {
                    #有商家支持货到付款
                    $currency = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$basic->prepaid_currency])->first()->currency_symbol_standard;
                    $cash_on_delivery = ['cash_on_delivery'=>2,'down_payment'=>$basic->down_payment,'prepaid_method'=>$basic->prepaid_method,'prepaid_percent'=>$basic->prepaid_percent,'prepaid_currency'=>$currency,'prepaid_amount'=>$basic->prepaid_amount];
                }
            }
        }

        if($order['content']['delivery_method']==1 || $order['content']['gather_method']==2){
            #中国收货&海外收货-自主集运，只能中国支付
            
            #国家
            $country = Db::connection('shop_db')->table('centralize_diycountry_content')->whereRaw('pid=5 and id=162')->get();
            $country = objtoarr($country);
        }
        elseif($order['content']['delivery_method']==2 && $order['content']['gather_method']==1){
            #海外收货-平台集运，只能海外支付
            
            #国家and id<>162
            $country = Db::connection('shop_db')->table('centralize_diycountry_content')->whereRaw('pid=5 ')->get();
            $country = objtoarr($country);
        }
        
        $is_inner=1;#内页打开首页头部，不显示消息轮播框

        $website = get_website();
        $page_info = get_pageinfo('/goods');
        $website['background'] = $page_info['content']['background'];
        $website['content'] = $page_info['content']['content'];
        $website['fontcolor'] = $page_info['content']['fontcolor'];
        $website['agentLink'] = $page_info['content']['agent_link'];

        return view('goods.cashier', compact('is_inner', 'origin_page', 'website', 'country', 'order', 'cash_on_delivery'));
    }

    #获取国家收银台配置
    public function get_cashier_country(Request $request)
    {
        $data = $request->except(['_token']);
        $country_id = intval($data['country']);
        $orderid = intval($data['orderid']);
        $cash_on_delivery_sel = intval($data['cash_on_delivery']);#货到付款，1不支持，2支持(货到付款按“定额”/按“比例”)

        #订单信息
        $order = Db::connection('shop_db')->table('website_order_list')->where(['id'=>$orderid])->first();
        $order = objtoarr($order);

        #商品的货到付款计费方式及金额======start
        $cash_on_delivery = ['cash_on_delivery'=>1,'down_payment'=>1,'prepaid_method'=>1,'prepaid_percent'=>'','prepaid_currency'=>'','prepaid_amount'=>'','shop_id'=>0];
        if ($cash_on_delivery_sel==2) {
            #支持货到付款
            $order['content'] = json_decode($order['content'], true);

            foreach ($order['content']['goods_info'] as $k=>$v) {
                $g = Db::table('goods')->where(['goods_id'=>$v['good_id']])->select('shop_id')->first();
                if ($g->shop_id > 0) {
                    $basic = Db::connection('shop_db')->table('website_basic')->where(['company_id'=>$g->shop_id])->select(['cash_on_delivery','down_payment','prepaid_method','prepaid_percent','prepaid_currency','prepaid_amount'])->first();
                    if ($basic->cash_on_delivery==2) {
                        #有商家支持货到付款
                        $currency = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$basic->prepaid_currency])->first()->currency_symbol_standard;
                        $cash_on_delivery = ['cash_on_delivery'=>2,'down_payment'=>$basic->down_payment,'prepaid_method'=>$basic->prepaid_method,'prepaid_percent'=>$basic->prepaid_percent,'prepaid_currency'=>$currency,'prepaid_amount'=>$basic->prepaid_amount,'shop_id'=>$g->shop_id];
                        break;
                    }
                }
            }
        }
        #商品的货到付款计费方式及金额======end

        $ishave = Db::table('cashier_country')->where(['country_id'=>$country_id])->first();
        $ishave = objtoarr($ishave);
        if (empty($ishave)) {
            return response()->json(['code'=>-1,'msg'=>'暂无该国家地区的收银台信息']);
        } else {
            #1、实付，各支付通道的总付金额==========start
            $shifu = ['currency'=>'','price'=>'','reduce_price'=>''];
            $category = Db::table('cashier_category')->where(['country_id'=>$ishave['id']])->get();
            $category = objtoarr($category);

            #会员优惠券信息
            $coupon = ['type'=>''];
            if (!empty($order['coupon_id'])) {
                $coupon = Db::connection('shop_db')->table('member_coupon_info')->where(['id' => $order['coupon_id']])->first();
                $coupon = objtoarr($coupon);
            }

            #会员优惠券信息
            if (!empty($order['coupon_id'])) {
                if ($coupon['type']==1) {
                    $order['true_money'] -= $coupon['price'];#订单金额
                }
            }

            foreach ($category as $k=>$v) {
                $category[$k]['children'] = Db::table('settlement')->where(['type_id'=>$v['id']])->get();
                $category[$k]['children'] = objtoarr($category[$k]['children']);

                if (!empty($category[$k]['children'])) {
                    #查询汇率
                    foreach ($category[$k]['children'] as $k2=>$v2) {
                        #通道汇率（订单币种:通道币种=汇率）
                        if ($order['currency'] == $v2['currency']) {
                            #订单币种=通道币种均为CNY
                            $category[$k]['children'][$k2]['rate'] = "1:1.000";
                        } else {
                            if ($order['currency']==5) {
                                #订单币种为CNY
                                #查找cny对换其他币种的汇率
                                $currency = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$v2['currency']])->first()->currency_symbol_standard;
                                $other_currency_rate = Db::connection('shop_db')->table('website_exchange_rate')->where(['symbol'=>$currency])->first();
                                if (!empty($other_currency_rate)) {
//                                    $dotPosition = strpos($other_currency_rate->rate, '.'); // 找到小数点的位置
//                                    if ($dotPosition !== false) {
//                                        $result = substr($other_currency_rate->rate, 0, $dotPosition + 4); // 从第0个字符开始，截取长度为小数点位置+4的子字符串
//
//                                        $category[$k]['children'][$k2]['rate'] = "1:".$result;
//                                    }
                                    preg_match('/^(\d+\.\d{3})/', $other_currency_rate->rate, $matches);
                                    $category[$k]['children'][$k2]['rate'] = "1:".$matches[1];
                                } else {
                                    $category[$k]['children'][$k2]['rate'] = "暂无数据";
                                }
                            } else {
                                #订单币种不为CNY
                                $category[$k]['children'][$k2]['rate'] = "暂无数据";
                            }
                        }

                        #通道币种
                        $category[$k]['children'][$k2]['currency'] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$v2['currency']])->first()->currency_symbol_standard;
                        #通道手续费
                        $category[$k]['children'][$k2]['service_charge'] = json_decode($v2['service_charge'], true);
                        #当前通道费率信息
                        $exchange_money=0;#将订单金额换算为通道金额后的金额
                        foreach ($category[$k]['children'][$k2]['service_charge'] as $k3=>$v3) {
                            if ($order['currency'] == $v2['currency']) {
                                #订单币种=通道币种均为CNY，无需换算
                                if ($v3['end_type']==1) {
                                    #数值
                                    if ($v3['start_money']<=$order['true_money'] && $order['true_money']<$v3['end_money']) {
                                        if ($v3['charge_type']==1) {
                                            #按额
                                            $category[$k]['children'][$k2]['rate_money'] = $order['true_money'] * ($v3['charge_num'] / 100);
                                        } elseif ($v3['charge_type']==2) {
                                            #按笔
                                            $category[$k]['children'][$k2]['rate_money'] = $v3['charge_num'];
                                        }
                                        break;
                                    }
                                } elseif ($v3['end_type']==2) {
                                    #以上
                                    if ($v3['start_money']<=$order['true_money']) {
                                        if ($v3['charge_type']==1) {
                                            #按额
                                            $category[$k]['children'][$k2]['rate_money'] = $order['true_money'] * ($v3['charge_num'] / 100);
                                        } elseif ($v3['charge_type']==2) {
                                            #按笔
                                            $category[$k]['children'][$k2]['rate_money'] = $v3['charge_num'];
                                        }
                                        break;
                                    } else {
                                        #不符合条件
                                        $category[$k]['children'][$k2]['rate_money'] = '金额不符合条件';
                                        break;
                                    }
                                } else {
                                    #不符合条件
                                    $category[$k]['children'][$k2]['rate_money'] = '金额不符合条件';
                                    break;
                                }
                            } else {
                                #订单币种!=通道币种
                                if ($order['currency']==5) {
                                    #订单币种为CNY，需要将订单币种换成通道币种金额
                                    $currency = Db::connection('shop_db')->table('centralize_currency')->where(['id' => $v2['currency']])->first()->currency_symbol_standard;
                                    $other_currency_rate = Db::connection('shop_db')->table('website_exchange_rate')->where(['symbol' => $currency])->first();

                                    #通道实付费用
                                    $category[$k]['children'][$k2]['true_money'] = 0;

                                    if (!empty($other_currency_rate)) {
                                        $exchange_money = $order['true_money'] * $other_currency_rate->rate;#换算为通道的金额

                                        #通道手续费
                                        if ($v3['end_type']==1) {
                                            #数值
                                            if ($v3['start_money']<=$exchange_money && $exchange_money<$v3['end_money']) {
                                                if ($v3['charge_type']==1) {
                                                    #按额
                                                    $category[$k]['children'][$k2]['rate_money'] = $exchange_money * ($v3['charge_num'] / 100);
                                                } elseif ($v3['charge_type']==2) {
                                                    #按笔
                                                    $category[$k]['children'][$k2]['rate_money'] = $v3['charge_num'];
                                                }
                                                break;
                                            }
                                        } elseif ($v3['end_type']==2) {
                                            #以上
                                            if ($v3['start_money']<=$exchange_money) {
                                                if ($v3['charge_type']==1) {
                                                    #按额
                                                    $category[$k]['children'][$k2]['rate_money'] = $exchange_money * ($v3['charge_num'] / 100);
                                                } elseif ($v3['charge_type']==2) {
                                                    #按笔
                                                    $category[$k]['children'][$k2]['rate_money'] = $v3['charge_num'];
                                                }
                                                break;
                                            } else {
                                                #不符合条件
                                                $category[$k]['children'][$k2]['rate_money'] = '金额不符合条件';
                                                break;
                                            }
                                        } else {
                                            #不符合条件
                                            $category[$k]['children'][$k2]['rate_money'] = '金额不符合条件';
                                            break;
                                        }
                                    }
                                } else {
                                    #订单币种为其他币种，暂时未有（待做）
                                    $category[$k]['children'][$k2]['rate_money'] = '暂无该国地币种兑换此通道币种汇率信息';
                                    break;
                                }
                            }
                        }

                        #通道实付费用=订单换算金额+订单换算手续费金额
                        if ($order['currency'] == $v2['currency']) {
                            #订单币种=通道币种
                            #实付费用
                            $category[$k]['children'][$k2]['true_money'] = $order['true_money'] + floatval($category[$k]['children'][$k2]['rate_money']);
                            #订单费用
                            $category[$k]['children'][$k2]['order_money'] = $order['true_money'];
                        } else {
                            #订单币种!=通道币种
                            #实付费用
                            $category[$k]['children'][$k2]['true_money'] = $exchange_money + floatval($category[$k]['children'][$k2]['rate_money']);
                            #订单费用
                            $category[$k]['children'][$k2]['order_money'] = $exchange_money;
                        }
                    }
                }
            }

            foreach ($category as $k=>$v) {
                foreach ($v['children'] as $k2=>$v2) {
                    $category[$k]['children'][$k2]['rate_money'] = number_format($v2['rate_money'], 2);
                    $category[$k]['children'][$k2]['true_money'] = number_format($v2['true_money'], 2);
                    $category[$k]['children'][$k2]['order_money'] = number_format($v2['order_money'], 2);
                }
            }

            $currency = Db::connection('shop_db')->table('centralize_currency')->where(['country_id'=>$country_id])->first();
            $country = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['id'=>$country_id])->first();
            $shifu['currency'] = $currency->currency_symbol_standard;

            #实付金额，换算为该国币种
            if ($currency->country_id == $country_id) {
                #会员优惠券信息
                if (!empty($order['coupon_id'])) {
                    if ($coupon['type']==1) {
                        $shifu['reduce_price'] = $coupon['price'];#抵扣金额
                    }
                }
                $shifu['price'] = $order['true_money'];
            } else {
                $other_currency_rate = Db::connection('shop_db')->table('website_exchange_rate')->where(['symbol'=>$currency->currency_symbol_standard])->first();
                preg_match('/^(\d+\.\d{3})/', $other_currency_rate->rate, $matches);

                #会员优惠券信息
                if (!empty($order['coupon_id'])) {
                    if ($coupon['type']==1) {
                        $order['true_money'] = number_format(($order['true_money']+$coupon['price']) * $matches[1], 2);#订单金额换汇
                        $coupon['price'] = number_format($coupon['price'] * $matches[1], 2);#抵扣金额换汇
                        $order['true_money'] -= $coupon['price'];#订单换汇后的金额
                        $shifu['reduce_price'] = $coupon['price'];#抵扣金额
                    }
                }

                $shifu['price'] = number_format($order['true_money'] * $matches[1], 2);
            }
            #1、实付，各支付通道的总付金额==========end

            #2、若是货到付款，则判断和计算================start
            if ($cash_on_delivery_sel==2) {
                #货到付款
                if ($cash_on_delivery['down_payment']==1) {
                    #不需要定金
                    foreach ($category as $k=>$v) {
                        foreach ($v['children'] as $k2=>$v2) {
                            $category[$k]['children'][$k2]['true_money'] = number_format(0, 2);
                        }
                    }
                } elseif ($cash_on_delivery['down_payment']==2) {
                    #需要定金
                    if ($cash_on_delivery['prepaid_method']==1) {
                        #按比例
                        #1、找到商品相应数量价格
                        $goods_total = 0;
                        foreach ($order['content']['goods_info'] as $k=>$v) {
                            foreach ($v['sku_info'] as $k2=>$v2) {
                                $goods_total += $v2['price'];
                            }
                        }
                        #2、计算定金
                        $goods_total = $goods_total * ($cash_on_delivery['prepaid_percent'] / 100);//100*0.03

                        #3、计算定金+各通道费用
                        foreach ($category as $k=>$v) {
                            $category[$k]['children'] = Db::table('settlement')->where(['type_id'=>$v['id']])->get();
                            $category[$k]['children'] = objtoarr($category[$k]['children']);

                            if (!empty($category[$k]['children'])) {
                                #查询汇率
                                foreach ($category[$k]['children'] as $k2=>$v2) {
                                    #通道汇率（订单币种:通道币种=汇率）
                                    if ($order['currency'] == $v2['currency']) {
                                        #订单币种=通道币种均为CNY
                                        $category[$k]['children'][$k2]['rate'] = "1:1.000";
                                    } else {
                                        if ($order['currency']==5) {
                                            #订单币种为CNY
                                            #查找cny对换其他币种的汇率
                                            $currency2 = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$v2['currency']])->first();
                                            $other_currency_rate = Db::connection('shop_db')->table('website_exchange_rate')->where(['symbol'=>$currency2->currency_symbol_standard])->first();
                                            if (!empty($other_currency_rate)) {
//                                    $dotPosition = strpos($other_currency_rate->rate, '.'); // 找到小数点的位置
//                                    if ($dotPosition !== false) {
//                                        $result = substr($other_currency_rate->rate, 0, $dotPosition + 4); // 从第0个字符开始，截取长度为小数点位置+4的子字符串
//
//                                        $category[$k]['children'][$k2]['rate'] = "1:".$result;
//                                    }
                                                preg_match('/^(\d+\.\d{3})/', $other_currency_rate->rate, $matches);
                                                $category[$k]['children'][$k2]['rate'] = "1:".$matches[1];
                                            } else {
                                                $category[$k]['children'][$k2]['rate'] = "暂无数据";
                                            }
                                        } else {
                                            #订单币种不为CNY
                                            $category[$k]['children'][$k2]['rate'] = "暂无数据";
                                        }
                                    }

                                    #通道币种
                                    $category[$k]['children'][$k2]['currency'] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$v2['currency']])->first()->currency_symbol_standard;
                                    #通道手续费
                                    $category[$k]['children'][$k2]['service_charge'] = json_decode($v2['service_charge'], true);
                                    #当前通道费率信息
                                    $exchange_money=0;#将订单金额换算为通道金额后的金额
                                    foreach ($category[$k]['children'][$k2]['service_charge'] as $k3=>$v3) {
                                        if ($order['currency'] == $v2['currency']) {
                                            #订单币种=通道币种均为CNY，无需换算
                                            if ($v3['end_type']==1) {
                                                #数值
                                                if ($v3['start_money']<=$goods_total && $goods_total<$v3['end_money']) {
                                                    if ($v3['charge_type']==1) {
                                                        #按额
                                                        $category[$k]['children'][$k2]['rate_money'] = $goods_total * ($v3['charge_num'] / 100);
                                                    } elseif ($v3['charge_type']==2) {
                                                        #按笔
                                                        $category[$k]['children'][$k2]['rate_money'] = $v3['charge_num'];
                                                    }
                                                    break;
                                                }
                                            } elseif ($v3['end_type']==2) {
                                                #以上
                                                if ($v3['start_money']<=$goods_total) {
                                                    if ($v3['charge_type']==1) {
                                                        #按额
                                                        $category[$k]['children'][$k2]['rate_money'] = $goods_total * ($v3['charge_num'] / 100);
                                                    } elseif ($v3['charge_type']==2) {
                                                        #按笔
                                                        $category[$k]['children'][$k2]['rate_money'] = $v3['charge_num'];
                                                    }
                                                    break;
                                                } else {
                                                    #不符合条件
                                                    $category[$k]['children'][$k2]['rate_money'] = '金额不符合条件';
                                                    break;
                                                }
                                            } else {
                                                #不符合条件
                                                $category[$k]['children'][$k2]['rate_money'] = '金额不符合条件';
                                                break;
                                            }
                                        } else {
                                            #订单币种!=通道币种
                                            if ($order['currency']==5) {
                                                #订单币种为CNY，需要将订单币种换成通道币种金额
                                                $currency2 = Db::connection('shop_db')->table('centralize_currency')->where(['id' => $v2['currency']])->first();
                                                $other_currency_rate = Db::connection('shop_db')->table('website_exchange_rate')->where(['symbol' => $currency2->currency_symbol_standard])->first();

                                                #通道实付费用
                                                $category[$k]['children'][$k2]['true_money'] = 0;

                                                if (!empty($other_currency_rate)) {
                                                    $exchange_money = $goods_total * $other_currency_rate->rate;#换算为通道的金额

                                                    #通道手续费
                                                    if ($v3['end_type']==1) {
                                                        #数值
                                                        if ($v3['start_money']<=$exchange_money && $exchange_money<$v3['end_money']) {
                                                            if ($v3['charge_type']==1) {
                                                                #按额
                                                                $category[$k]['children'][$k2]['rate_money'] = $exchange_money * ($v3['charge_num'] / 100);
                                                            } elseif ($v3['charge_type']==2) {
                                                                #按笔
                                                                $category[$k]['children'][$k2]['rate_money'] = $v3['charge_num'];
                                                            }
                                                            break;
                                                        }
                                                    } elseif ($v3['end_type']==2) {
                                                        #以上
                                                        if ($v3['start_money']<=$exchange_money) {
                                                            if ($v3['charge_type']==1) {
                                                                #按额
                                                                $category[$k]['children'][$k2]['rate_money'] = $exchange_money * ($v3['charge_num'] / 100);
                                                            } elseif ($v3['charge_type']==2) {
                                                                #按笔
                                                                $category[$k]['children'][$k2]['rate_money'] = $v3['charge_num'];
                                                            }
                                                            break;
                                                        } else {
                                                            #不符合条件
                                                            $category[$k]['children'][$k2]['rate_money'] = '金额不符合条件';
                                                            break;
                                                        }
                                                    } else {
                                                        #不符合条件
                                                        $category[$k]['children'][$k2]['rate_money'] = '金额不符合条件';
                                                        break;
                                                    }
                                                }
                                            } else {
                                                #订单币种为其他币种，暂时未有（待做）
                                                $category[$k]['children'][$k2]['rate_money'] = '暂无该国地币种兑换此通道币种汇率信息';
                                                break;
                                            }
                                        }
                                    }

                                    #通道实付费用=订单换算金额+订单换算手续费金额
                                    if ($order['currency'] == $v2['currency']) {
                                        #订单币种=通道币种
                                        #实付费用
                                        $category[$k]['children'][$k2]['true_money'] = $goods_total + floatval($category[$k]['children'][$k2]['rate_money']);
                                        #订单费用
                                        $category[$k]['children'][$k2]['order_money'] = $goods_total;
                                    } else {
                                        #订单币种!=通道币种
                                        #实付费用
                                        $category[$k]['children'][$k2]['true_money'] = $exchange_money + floatval($category[$k]['children'][$k2]['rate_money']);
                                        #订单费用
                                        $category[$k]['children'][$k2]['order_money'] = $exchange_money;
                                    }
                                }
                            }
                        }

                        foreach ($category as $k=>$v) {
                            foreach ($v['children'] as $k2=>$v2) {
                                $category[$k]['children'][$k2]['rate_money'] = number_format($v2['rate_money'], 2);
                                $category[$k]['children'][$k2]['true_money'] = number_format($v2['true_money'], 2);
                                $category[$k]['children'][$k2]['order_money'] = number_format($v2['order_money'], 2);
                            }
                        }
                    } elseif ($cash_on_delivery['prepaid_method']==2) {
                        #按定额
                        foreach ($category as $k=>$v) {
                            foreach ($v['children'] as $k2=>$v2) {
                                $category[$k]['children'][$k2]['true_money'] = number_format($cash_on_delivery['prepaid_amount'], 2);
                            }
                        }
                    }
                }
            }
            #2、若是货到付款，则判断================end

            return response()->json(['code'=>0,'data'=>$category,'currency'=>$currency->currency_symbol_standard,'country_code'=>$country->param5,'shifu'=>$shifu]);
        }
    }

    #在线申请
    public function apply(Request $request)
    {
        $data = $request->except(['_token']);
        $orderid = intval($data['oid']);

        if (isset($data['pa'])) {
            $time = time();
            DB::beginTransaction();
            try {
                #1、处方信息
                $starttime = strtotime(date('Y-m-d 00:00:00', $time));
                $endtime = strtotime(date('Y-m-d 23:59:59', $time));
                $number = Db::table('user_prescription')->whereRaw('createtime>='.$starttime.' and createtime<='.$endtime)->count();
                $number += 1;
                $number = str_pad($number, 3, '0', STR_PAD_LEFT);
                $ordersn = 'GRP'.date('Ymd').$number;
                $prescription_id = Db::table('user_prescription')->insertGetId([
                    'uid'=>session('user.gogo_id'),
                    'patient_id'=>$data['patient_id'],
                    'order_id'=>$orderid,
                    'ordersn'=>$ordersn,
                    'status'=>0,
                    'createtime'=>$time
                ]);

                #2、通知总后台
                $system = Db::connection('shop_db')->table('centralize_system_notice')->where(['uid'=>0])->first();
                $system = objtoarr($system);
                if ($system['notice_type']==1) {
                    $post = json_encode([
                        'call' => 'confirmCollectionNotice',
                        'first' => '处方申请消息，请打开查看！',
                        'keyword1' => '处方申请消息，请打开查看！',
                        'keyword2' => '已提交待分配',
                        'keyword3' => date('Y-m-d H:i:s', $time),
                        'remark' => '点击查看详情',
                        'url' => 'https://gadmin.gogo198.cn',
//                    'url' => 'https://shopping.gogo198.cn/check_prescription?prescription_id='.$prescription_id,
                        'openid' => $system['account'],
                        'temp_id' => 'SVVs5OeD3FfsGwW0PEfYlZWetjScIT8kDxht5tlI1V8'
                    ]);
                    httpRequest('https://shop.gogo198.cn/api/sendwechattemplatenotice.php', $post);
                }
                DB::commit();
                return Response()->json(['code'=>0,'msg'=>'提交申请成功']);
            } catch (\Exception $e) {
                DB::rollback();//事务回滚
//            echo $e->getMessage();die;
//            echo $e->getCode();
                return Response()->json(['code'=>0,'msg'=>'添加失败']);
            }
        } else {
            $account = Db::connection('shop_db')->table('website_user')->where(['custom_id'=>session('user.gogo_id')])->first();
            $account = objtoarr($account);

            $order = Db::connection('shop_db')->table('website_order_list')->where(['user_id'=>$account['id'],'id'=>$orderid])->first();
            $order = objtoarr($order);
            $order['content'] = json_decode($order['content'], true);

            #过敏史
            $allergy = Db::connection('shop_db')->table('prescription_allergy')->where(['pid'=>0])->get();
            $allergy = objtoarr($allergy);
            foreach ($allergy as $k=>$v) {
                $allergy[$k]['children'] = Db::connection('shop_db')->table('prescription_allergy')->where(['pid'=>$v['id']])->get();
                $allergy[$k]['children'] = objtoarr($allergy[$k]['children']);
            }
            $allergy = json_encode($allergy, true);

            #疾病
            $good = Db::table('goods')->where(['goods_id'=>$order['content']['good_id']])->first();
            $good = objtoarr($good);
            $disease = Db::table('category')->where(['parent_id'=>$good['cat_id1']])->get();
            $disease = objtoarr($disease);
            foreach ($disease as $k=>$v) {
                $disease[$k]['children'] = Db::table('category')->where(['parent_id'=>$v['cat_id']])->get();
                $disease[$k]['children'] = objtoarr($disease[$k]['children']);
            }
            $disease = json_encode($disease, true);

            #当前账号的患者信息
            $patient = Db::table('patient')->where(['uid'=>session('user.gogo_id')])->get();
            $patient = objtoarr($patient);

            if (empty($patient)) {
                header('Location: /save_patient?oid='.$orderid);
            }

            #科目
            $value = Db::table('ssl_platform_value')->where(['cat_id'=>$good['cat_id1'],'cat_id1'=>$good['cat_id'],'cross_catId'=>$good['crossb_cate1']])->first();
            $value = objtoarr($value);
            $value['drug'] = json_decode($value['drug'], true);
            $tag = '';
            if (!empty($value['drug']['value']['value2'])) {
                if ($value['drug']['value']['value2']==5) {
                    $tag = '普通';
                } elseif ($value['drug']['value']['value2']==6) {
                    $tag = '儿科';
                }
            } else {
                if ($value['drug']['value']['value']==7) {
                    $tag = '麻';
                } elseif ($value['drug']['value']['value']==8) {
                    $tag = '精';
                } elseif ($value['drug']['value']['value']==9) {
                    $tag = '毒';
                } elseif ($value['drug']['value']['value']==10) {
                    $tag = '射';
                } elseif ($value['drug']['value']['value']==11) {
                    $tag = '外';
                }
            }

            return view('goods.apply', compact('orderid', 'allergy', 'disease', 'patient', 'tag'));
        }
    }

    #保存用药人信息
    public function save_patient(Request $request)
    {
        $data = $request->except(['_token']);
        $orderid = intval($data['oid']);

        if (isset($data['pa'])) {
            if (session('verify_code') != trim($data['code'])) {
                return Response()->json(['code'=>-1,'msg'=>'手机验证码错误']);
            }

            $time = time();
            DB::beginTransaction();
            try {
                #1、患者信息
                $department = Db::table('category')->where(['cat_id'=>$data['disease_id']])->first()->parent_id;
                $patient_id = Db::table('patient')->insertGetId([
                    'uid'=>session('user.gogo_id'),
                    'name'=>trim($data['name']),
                    'idcard'=>trim($data['idcard']),
                    'age'=>trim($data['age']),
                    'height'=>trim($data['height']),
                    'weight'=>trim($data['weight']),
                    'mobile'=>trim($data['mobile']),
                    'department'=>$department,
                    'disease'=>$data['disease_id'],
                    'is_allergy'=>$data['is_allergy'],
                    'allergy_id'=>$data['is_allergy']==1 ? $data['allergy_id'] : '',
                    'createtime'=>$time
                ]);

                #2、处方信息
                $starttime = strtotime(date('Y-m-d 00:00:00', $time));
                $endtime = strtotime(date('Y-m-d 23:59:59', $time));
                $number = Db::table('user_prescription')->whereRaw('createtime>='.$starttime.' and createtime<='.$endtime)->count();
                if ($number==0) {
                    $number = 1;
                }
                $number = str_pad($number, 3, '0', STR_PAD_LEFT);
                $ordersn = 'GRP'.date('Ymd').$number;
                $prescription_id = Db::table('user_prescription')->insertGetId([
                    'uid'=>session('user.gogo_id'),
                    'patient_id'=>$patient_id,
                    'order_id'=>$orderid,
                    'ordersn'=>$ordersn,
                    'status'=>0,
                    'createtime'=>$time
                ]);

                #3、通知总后台
                $system = Db::connection('shop_db')->table('centralize_system_notice')->where(['uid'=>0])->first();
                $system = objtoarr($system);
                $post = json_encode([
                    'call'=>'confirmCollectionNotice',
                    'first' =>'处方申请消息，请打开查看！',
                    'keyword1' => '处方申请消息，请打开查看！',
                    'keyword2' => '已提交待分配',
                    'keyword3' => date('Y-m-d H:i:s', $time),
                    'remark' => '点击查看详情',
                    'url' => 'https://gadmin.gogo198.cn',
//                    'url' => 'https://shopping.gogo198.cn/check_prescription?prescription_id='.$prescription_id,
                    'openid' => $system['account'],
                    'temp_id' => 'SVVs5OeD3FfsGwW0PEfYlZWetjScIT8kDxht5tlI1V8'
                ]);
                httpRequest('https://shop.gogo198.cn/api/sendwechattemplatenotice.php', $post);

                DB::commit();
                return Response()->json(['code'=>0,'msg'=>'添加成功，已提交申请']);
            } catch (\Exception $e) {
                DB::rollback();//事务回滚
                echo $e->getMessage();
                die;
//            echo $e->getCode();
                return Response()->json(['code'=>0,'msg'=>'添加失败']);
            }
        } else {
            $account = Db::connection('shop_db')->table('website_user')->where(['custom_id'=>session('user.gogo_id')])->first();
            $account = objtoarr($account);

            $order = Db::connection('shop_db')->table('website_order_list')->where(['user_id'=>$account['id'],'id'=>$orderid])->first();
            $order = objtoarr($order);
            $order['content'] = json_decode($order['content'], true);

            #过敏史
            $allergy = Db::connection('shop_db')->table('prescription_allergy')->where(['pid'=>0])->get();
            $allergy = objtoarr($allergy);
            foreach ($allergy as $k=>$v) {
                $allergy[$k]['children'] = Db::connection('shop_db')->table('prescription_allergy')->where(['pid'=>$v['id']])->get();
                $allergy[$k]['children'] = objtoarr($allergy[$k]['children']);
            }
            $allergy = json_encode($allergy, true);

            #疾病
            $good = Db::table('goods')->where(['goods_id'=>$order['content']['good_id']])->first();
            $good = objtoarr($good);
            $disease = Db::table('category')->where(['parent_id'=>$good['cat_id1']])->get();
            $disease = objtoarr($disease);
            foreach ($disease as $k=>$v) {
                $disease[$k]['children'] = Db::table('category')->where(['parent_id'=>$v['cat_id']])->get();
                $disease[$k]['children'] = objtoarr($disease[$k]['children']);
            }
            $disease = json_encode($disease, true);

            return view('goods.save_patient', compact('orderid', 'allergy', 'disease'));
        }
    }

    #获取用药人信息
    public function get_patient_info(Request $request)
    {
        $data = $request->except(['_token']);

        #用药人信息
        $patient = Db::table('patient')->where(['id'=>$data['id']])->first();
        $patient = objtoarr($patient);
        $patient['department'] = Db::table('category')->where(['cat_id'=>$patient['department']])->first()->cat_name;
        $patient['disease'] = Db::table('category')->where(['cat_id'=>$patient['disease']])->first()->cat_name;

        if ($patient['is_allergy']==1) {
            #有过敏史
            $patient['allergy_info'] = Db::connection('shop_db')->table('prescription_allergy')->whereRaw('find_in_set(id,?)', [$patient['allergy_id']])->select('name')->get();
            $patient['allergy_info'] = objtoarr($patient['allergy_info']);
            $patient['allergy'] = '';
            foreach ($patient['allergy_info'] as $k=>$v) {
                $patient['allergy'] .= $v['name'].',';
            }
            $patient['allergy'] = rtrim($patient['allergy'], ',');
        } else {
            $patient['allergy'] = '未发现';
        }

        #处方编号
        $time = time();
        $starttime = strtotime(date('Y-m-d 00:00:00', $time));
        $endtime = strtotime(date('Y-m-d 23:59:59', $time));
        $number = Db::table('user_prescription')->whereRaw('createtime>='.$starttime.' or createtime<='.$endtime)->count();
        if ($number==0) {
            $number = 1;
        }
        $number = str_pad($number, 3, '0', STR_PAD_LEFT);
        $ordersn = 'GRP'.date('Ymd').$number;

        return Response()->json(['code'=>0,'data'=>$patient,'ordersn'=>$ordersn]);
    }

    #医师开具处方
    public function check_prescription(Request $request)
    {
        $data = $request->except(['_token']);
        $id = intval($data['id']);
        if (isset($data['pa'])) {
            #确认签署
            $prescription = Db::table('user_prescription')->where(['id'=>$id])->first();
            $prescription = objtoarr($prescription);

            #1、更新处方
            Db::table('user_prescription')->where(['id'=>$id])->update([
                'status'=>2,
                'content'=>json_encode(['opt'=>$data['opt'],'opt_unit'=>$data['opt_unit'],'used_unit'=>$data['used_unit'],'used'=>$data['used']], true)
            ]);

            #2、更新签名
            if (isset($data['sign_file'])) {
                $user = Db::connection('shop_db')->table('website_user')->where(['id'=>$prescription['doctor_id']])->first();
                $user = objtoarr($user);
                $user['role_content'] = json_decode($user['role_content'], true);
                $user['role_content']['sign_file'][0] = $data['sign_file'][0];
                Db::connection('shop_db')->table('website_user')->where(['id'=>$prescription['doctor_id']])->update([
                    'role_content'=>json_encode($user['role_content'], true)
                ]);
            }

            #3、更新支付单(website_order_list)
            Db::connection('shop_db')->table('website_order_list')->where(['id'=>$prescription['order_id']])->update([
                'status'=>0
            ]);

            #4.1、通知总后台
            $time = time();
            $system = Db::connection('shop_db')->table('centralize_system_notice')->where(['uid'=>0])->first();
            $system = objtoarr($system);
            if ($system['notice_type']==1) {
                $post = json_encode([
                    'call'=>'confirmCollectionNotice',
                    'first' =>'处方开具消息，请打开查看！',
                    'keyword1' => '处方开具消息，请打开查看！',
                    'keyword2' => '已开具',
                    'keyword3' => date('Y-m-d H:i:s', $time),
                    'remark' => '点击查看详情',
                    'url' => 'https://gadmin.gogo198.cn',
//                    'url' => 'https://shopping.gogo198.cn/check_prescription?prescription_id='.$prescription_id,
                    'openid' => $system['account'],
                    'temp_id' => 'SVVs5OeD3FfsGwW0PEfYlZWetjScIT8kDxht5tlI1V8'
                ]);
                httpRequest('https://shop.gogo198.cn/api/sendwechattemplatenotice.php', $post);
            }

            #4.2、通知买家
            $user = Db::connection('shop_db')->table('website_user')->where(['id'=>$prescription['doctor_id']])->first();
            $user = objtoarr($user);
            if (!empty($user['openid'])) {
                $post = json_encode([
                    'call'=>'confirmCollectionNotice',
                    'first' =>'处方开具消息，请打开查看！',
                    'keyword1' => '处方开具消息，请打开查看！',
                    'keyword2' => '已开具',
                    'keyword3' => date('Y-m-d H:i:s', $time),
                    'remark' => '点击查看详情',
                    'url' => 'https://www.gogo198.net/?s=index/tradeflow_buyer&gogo_id='.session('user')['gogo_id'],
//                    'url' => 'https://shopping.gogo198.cn/check_prescription?prescription_id='.$prescription_id,
                    'openid' => $user['openid'],
                    'temp_id' => 'SVVs5OeD3FfsGwW0PEfYlZWetjScIT8kDxht5tlI1V8'
                ]);
                httpRequest('https://shop.gogo198.cn/api/sendwechattemplatenotice.php', $post);
            } elseif (!empty($user['phone'])) {
                $post_data = [
                    'spid'=>'254560',
                    'password'=>'J6Dtc4HO',
                    'ac'=>'1069254560',
                    'mobiles'=>$user['phone'],
                    'content'=>'处方开具消息，请打开链接查看：https://www.gogo198.net/?s=index/tradeflow_buyer&gogo_id='.session('user')['gogo_id'].'【GOGO】',
                ];
                $post_data = json_encode($post_data, true);
                httpRequest('https://decl.gogo198.cn/api/sendmsg_jumeng', $post_data, [
                    'Content-Type: application/json; charset=utf-8',
                    'Content-Length:' . strlen($post_data),
                    'Cache-Control: no-cache',
                    'Pragma: no-cache'
                ]);
            }

            return Response()->json(['code'=>0,'msg'=>'签署成功']);
        } else {
            #处方
            $prescription = Db::table('user_prescription')->where(['id'=>$id])->first();
            $prescription = objtoarr($prescription);
            if ($prescription['status']==2) {
                $prescription['content'] = json_decode($prescription['content'], true);
            }

            #患者
            $patient = Db::table('patient')->where(['id'=>$prescription['patient_id']])->first();
            $patient = objtoarr($patient);
            $patient['department'] = Db::table('category')->where(['cat_id'=>$patient['department']])->first()->cat_name;
            $patient['disease'] = Db::table('category')->where(['cat_id'=>$patient['disease']])->first()->cat_name;
            if ($patient['is_allergy']==1) {
                #有过敏史
                $patient['allergy_info'] = Db::connection('shop_db')->table('prescription_allergy')->whereRaw('find_in_set(id,?)', [$patient['allergy_id']])->select('name')->get();
                $patient['allergy_info'] = objtoarr($patient['allergy_info']);
                $patient['allergy'] = '';
                foreach ($patient['allergy_info'] as $k=>$v) {
                    $patient['allergy'] .= $v['name'].',';
                }
                $patient['allergy'] = rtrim($patient['allergy'], ',');
            } else {
                $patient['allergy'] = '未发现';
            }

            #订单
            $order = Db::connection('shop_db')->table('website_order_list')->where(['id'=>$prescription['order_id']])->first();
            $order = objtoarr($order);
            $order['content'] = json_decode($order['content'], true);
            #商品
            $good = Db::table('goods')->where(['goods_id'=>$order['content']['good_id']])->first();
            $good = objtoarr($good);
            $good_unit = Db::table('goods_sku')->where(['sku_id'=>$good['sku_id']])->first();
            $good_unit = objtoarr($good_unit);
            $good_unit['sku_prices'] = json_decode($good_unit['sku_prices'], true);
            $good_unit['unit'] = Db::connection('shop_db')->table('unit')->where(['code_value'=>$good_unit['sku_prices']['unit'][0]])->first()->code_name;

            #科目
            $value = Db::table('ssl_platform_value')->where(['cat_id'=>$good['cat_id1'],'cat_id1'=>$good['cat_id'],'cross_catId'=>$good['crossb_cate1']])->first();
            $value = objtoarr($value);
            $value['drug'] = json_decode($value['drug'], true);
            $tag = '';
            if (!empty($value['drug']['value']['value2'])) {
                if ($value['drug']['value']['value2']==5) {
                    $tag = '普通';
                } elseif ($value['drug']['value']['value2']==6) {
                    $tag = '儿科';
                }
            } else {
                if ($value['drug']['value']['value']==7) {
                    $tag = '麻';
                } elseif ($value['drug']['value']['value']==8) {
                    $tag = '精';
                } elseif ($value['drug']['value']['value']==9) {
                    $tag = '毒';
                } elseif ($value['drug']['value']['value']==10) {
                    $tag = '射';
                } elseif ($value['drug']['value']['value']==11) {
                    $tag = '外';
                }
            }

            #数量
            $unit['num_unit'] = Db::connection('shop_db')->table('prescription_language')->where(['pid'=>16])->get();
            $unit['num_unit'] = objtoarr($unit['num_unit']);
            $unit['unit'] = Db::connection('shop_db')->table('unit')->get();
            $unit['unit'] = objtoarr($unit['unit']);
            #间隔
            $unit['interval_unit'] = Db::connection('shop_db')->table('prescription_language')->where(['pid'=>30])->get();
            $unit['interval_unit'] = objtoarr($unit['interval_unit']);
            #途径
            $unit['road_unit'] = Db::connection('shop_db')->table('prescription_language')->where(['pid'=>49])->get();
            $unit['road_unit'] = objtoarr($unit['road_unit']);
            #服用时间
            $unit['eat_unit'] = Db::connection('shop_db')->table('prescription_language')->where(['pid'=>44])->get();
            $unit['eat_unit'] = objtoarr($unit['eat_unit']);

            #处方签署
            $doctor = Db::connection('shop_db')->table('website_user')->where(['id'=>$prescription['doctor_id']])->first();
            $doctor = objtoarr($doctor);
            $doctor['role_content'] = json_decode($doctor['role_content'], true);
            if ($prescription['status']==2) {
                $image_data = file_get_contents("https://shop.gogo198.cn/".$doctor['role_content']['sign_file'][0]);
                $doctor['role_content']['sign_file'][0] = "data:image/jpeg;base64,".base64_encode($image_data);
            }

            return view('goods.check_prescription', compact('id', 'prescription', 'patient', 'order', 'good', 'tag', 'good_unit', 'unit', 'value', 'doctor'));
        }
    }

    public function verifyTel($tel)
    {
        if (preg_match("/^1[34578]\d{9}$/", $tel)) {
            return true;
        }
        return false;
    }

    #发送验证码
    public function send_code(Request $request)
    {
        $dat = $request->except(['_token']);


        $code = mt_rand(11, 99) . mt_rand(11, 99);
        $res = '';
        if ($dat['type']==1) {
            $request->session()->put('verify_code', $code);
            #手机号码
            $tel = trim($dat['number']);
            if (!$this->verifyTel($tel)) {
                return Response()->json(['code'=>-1,'msg'=>'手机格式错误！']);
            }

            $post_data = [
                'spid'=>'254560',
                'password'=>'J6Dtc4HO',
                'ac'=>'1069254560',
                'mobiles'=>$tel,
                'content'=>'您正在校验手机号码，验证码为：'.$code.'【GOGO】',
            ];
            $post_data = json_encode($post_data, true);
            $res = httpRequest('https://decl.gogo198.cn/api/sendmsg_jumeng', $post_data, [
                'Content-Type: application/json; charset=utf-8',
                'Content-Length:' . strlen($post_data),
                'Cache-Control: no-cache',
                'Pragma: no-cache'
            ]);
        }

        if ($res) {
            return Response()->json(['code'=>0,'msg'=>'发送成功！']);
        } else {
            return Response()->json(['code'=>-1,'msg'=>'发送失败，请联系管理员！']);
        }
    }

    #收银台管理列表
    public function pay_list(Request $request)
    {
        $data = $request->except(['_token']);
        $ordersn = isset($data['key']) ? trim($data['key']) : '';
        $isframe = isset($data['isframe']) ? intval($data['isframe']) : 0;

        if (isset($data['pa'])) {
        } else {
            $order = Db::connection('shop_db')->table('website_order_list')->where(['ordersn'=>$ordersn])->first();
            $order = objtoarr($order);

            #获取配置信息
            $website = get_website();
            $page_info = get_pageinfo('/bill_list');
            $website['background'] = $page_info['content']['background'];
            $website['content'] = $page_info['content']['content'];
            $website['fontcolor'] = $page_info['content']['fontcolor'];

            return view('goods.pay_list', compact('isframe', 'website', 'order'));
        }
    }

    #账单管理中心
    public function bill_list(Request $request)
    {
        $data = $request->except(['_token']);
        $isframe = isset($data['isframe']) ? intval($data['isframe']) : 0;

        if (isset($data['pa'])) {
            $limit = $request->get('limit');
            $page = $request->get('page') - 1;

            if ($page != 0) {
                $page = $limit * $page;
            }

            $account = Db::connection('shop_db')->table('website_user')->where(['custom_id'=>session('user.gogo_id')])->first();
            $account = objtoarr($account);

            if (empty($account['openid'])) {
                $account['openid'] = 's';
            }
            if (empty($account['email'])) {
                $account['email'] = 's';
            }
            if (empty($account['phone'])) {
                $account['phone'] = 's';
            }

            $count = Db::connection('shop_db')->table('website_order_list')->where(['user_id'=>$account['id']])->whereRaw('status <> -1')->count();
            $rows = Db::connection('shop_db')->table('website_order_list')->where(['user_id'=>$account['id']])->whereRaw('status <> -1')->orderBy('id', 'desc')->offset($page)->limit($limit)->get();
            $rows = objtoarr($rows);

            foreach ($rows as $k=>$v) {
                $rows[$k]['createtime'] = date('Y-m-d H:i', $v['createtime']);
                $rows[$k]['status_name'] = $this->order_status($v['status']);
            }
            return response()->json(['code'=>0,'count'=>$count,'data'=>$rows]);
        } else {
            #获取配置信息
            $website = get_website();
            $page_info = get_pageinfo('/bill_list');
            $website['background'] = $page_info['content']['background'];
            $website['content'] = $page_info['content']['content'];
            $website['fontcolor'] = $page_info['content']['fontcolor'];

            return view('goods.bill_list', compact('isframe', 'website'));
        }
    }

    public function order_status($status)
    {
        if ($status==-1) {
            return '处方待申请';
        } elseif ($status==-2) {
            return '待确认';
        } elseif ($status==-3) {
            return '申请取消订购';
        } elseif ($status==-4) {
            return '已取消';
        } elseif ($status==-5) {
            return '申请退货';
        } elseif ($status==-6) {
            return '已退货';
        } elseif ($status==-7) {
            return '申请换货';
        } elseif ($status==-8) {
            return '已换货';
        } elseif ($status==0) {
            return '待付款';
        } elseif ($status==1) {
            return '待采购';
        } elseif ($status==2) {
            return '已发货';
        } elseif ($status==3) {
            return '待验货';
        } elseif ($status==4) {
            return '待入库';
        } elseif ($status==5) {
            return '待集货';
        } elseif ($status==6) {
            return '待转运';
        } elseif ($status==7) {
            return '待签收';
        } elseif ($status==8) {
            return '待评价';
        } elseif ($status==9) {
            return '已完成';
        }
    }

    #账单详情
    public function bill_detail(Request $request)
    {
        $data = $request->except(['_token']);
        $isframe = isset($data['isframe']) ? intval($data['isframe']) : 0;

        #1、获取账单信息
        $order = Db::connection('shop_db')->table('website_order_list')->where(['id'=>$data['id']])->first();
        $order = objtoarr($order);
        $order['content'] = json_decode($order['content'], true);

        if ($order['origin_type']==0) {
            #本商城订单
            $order['currency'] = '';
            #2、获取商品信息
            $goods = Db::table('goods')->where(['goods_id'=>$order['content']['good_id']])->first();
            $goods = objtoarr($goods);
            #3、获取商品规格
            $goods_sku = Db::table('goods_sku')->where(['sku_id'=>$goods['sku_id']])->first();
            $goods_sku = objtoarr($goods_sku);
            $goods_sku['sku_prices'] = json_decode($goods_sku['sku_prices'], true);

            $order['currency'] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$goods_sku['sku_prices']['currency'][0]])->first()->currency_symbol_standard;
            $order['unit'] = Db::connection('shop_db')->table('unit')->where(['code_value'=>$goods_sku['sku_prices']['unit'][0]])->first()->code_name;
            $order['total_num']=0;
            $order['total_price']=0;
            foreach ($order['content']['buy_attr'] as $k=>$v) {
                $order['total_num']+=$v['buy_num'];
                $order['total_price']+=$v['now_gprice'];
            }
        } elseif ($order['origin_type']==1) {
            #backydrop/其他订单
            $paylist = Db::connection('shop_db')->table('customs_collection')->where(['id'=>$order['pay_id']])->first();
            $paylist = objtoarr($paylist);
            $goods = Db::table('goods')->where(['goods_id'=>$paylist['good_id']])->first();
            $goods = objtoarr($goods);

            $goods_sku = [];
            if ($goods['have_specs']==1) {
                #看看买哪些商品规格
                $order['content']['good_num'] = explode('@@@', $order['content']['good_num']);
                $order['content']['good_price'] = explode('@@@', $order['content']['good_price']);
                $order['content']['value_name'] = explode('@@@', $order['content']['value_name']);
                $order['content']['skuCode'] = explode('@@@', $order['content']['skuCode']);
                foreach ($order['content']['good_num'] as $k => $v) {
                    if (!empty($v)) {
                        $goods_sku[$k]['value_name'] = $order['content']['value_name'][$k];
                        $goods_sku[$k]['good_num'] = $order['content']['good_num'][$k];
                        $goods_sku[$k]['good_price'] = $order['content']['good_price'][$k];
                        $goods_sku[$k]['skuCode'] = $order['content']['skuCode'][$k];
                    }
                }
            }
        }

        #获取配置信息
        $website = get_website();
        $page_info = get_pageinfo('/bill_list');
        $website['background'] = $page_info['content']['background'];
        $website['content'] = $page_info['content']['content'];
        $website['fontcolor'] = $page_info['content']['fontcolor'];

        return view('goods.bill_detail', compact('order', 'goods', 'goods_sku', 'website', 'isframe'));
    }

    #创建国内结算二维码
    public function create_code($type=0, $orderid=0, $good_id=0)
    {
        if ($type==1) {
            $url = 'https://shop.gogo198.cn/app/index.php?i=3&c=entry&do=member&p=custompayment&m=sz_yi&oid='.intval($orderid);
            #生成报价二维码
            $folder = $_SERVER['DOCUMENT_ROOT'].'/qrcode/pay_order_qrcode/';
            $name = 'order_'.session('user.user_id').'_'.$good_id;
            $img = $this->generate_code($name, $url, $folder);
            return $img;
        }
    }

    //生成二维码
    public function generate_code($name, $url, $folder)
    {
        //链接生成二维码
        $errorCorrectionLevel = 'L';//错误等级，忽略
        $matrixPointSize = 4;
//        require $_SERVER['DOCUMENT_ROOT'].'/qrcode/phpqrcode.php';
        require_once  __DIR__.'/phpqrcode.php';
        $path = $folder; //储存的地方
        if (!is_dir($path)) {
            mkdirs($path); //创建文件夹
        }

        $infourl = $url;
        $filename =  $path.$name.'.png'; //图片文件

        \QRcode::png($infourl, $filename, $errorCorrectionLevel, $matrixPointSize, 2); //生成图片

//        dd($infourl, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
//    $filename = str_replace('/www/wwwroot/gogo','https://shop.gogo198.cn',$filename);
        $logo = 'https://shop.gogo198.cn/collect_website/public/logo.png';//准备好的logo图片
        $QR = $filename;//已经生成的原始二维码图
        if ($logo !== false) {
            $QR = imagecreatefromstring(file_get_contents($QR));
            $logo = imagecreatefromstring(file_get_contents($logo));
            $QR_width = imagesx($QR);//二维码图片宽度
            $QR_height = imagesy($QR);//二维码图片高度
            $logo_width = imagesx($logo);//logo图片宽度
            $logo_height = imagesy($logo);//logo图片高度
            $logo_qr_width = $QR_width / 5; //logo图片在二维码图片中宽度大小
            $scale = $logo_width/$logo_qr_width;
            $logo_qr_height = $logo_height/$scale; //logo图片在二维码图片中高度大小
            $from_width = ($QR_width - $logo_qr_width) / 2;
            //重新组合图片并调整大小
            imagecopyresampled(
                $QR,
                $logo,
                $from_width,
                $from_width,
                0,
                0,
                $logo_qr_width,
                $logo_qr_height,
                $logo_width,
                $logo_height
            );
        }

        imagepng($QR, $filename); // 保存最终生成的二维码到本地

        //直接输出图片到浏览器
        Header("Content-type: image/png");

        $qrcode = str_replace('/www/wwwroot/shopping.gogo198.cn/public', 'https://api.gogo198.cn', $filename);
        return $qrcode;
    }

    #获取回复
    public function get_reply(Request $request)
    {
        $data = $request->except(['_token']);
        $reply = Db::table('ssl_chat_content')->where(['chat_pid'=>$data['id']])->first();
        $reply = objtoarr($reply);
        return response()->json(['code'=>0,'data'=>$reply]);
    }

    public function notice($arr)
    {
        $data = Db::connection('shop_db')->table('centralize_system_notice')->where(['uid'=>0,'system_type'=>1])->first();
        $data = objtoarr($data);
        $url = 'https://gadmin.gogo198.cn';

        if ($data['notice_type']==1) {
            #微信
            $post = json_encode([
                'call'=>'confirmCollectionNotice',
                'find' =>"用户[".$arr['gogo_id']."]发起了在线咨询，请打开查看！",
                'keyword1' => "用户[".$arr['gogo_id']."]发起了在线咨询，请打开查看！",
                'keyword2' => '已提交待操作',
                'keyword3' => date('Y-m-d H:i:s', time()),
                'remark' => '点击查看详情',
                'url' => $url,
                'openid' => $data['account'],
                'temp_id' => 'SVVs5OeD3FfsGwW0PEfYlZWetjScIT8kDxht5tlI1V8'
            ]);

            httpRequest('https://shop.gogo198.cn/api/sendwechattemplatenotice.php', $post);
        } elseif ($data['notice_type']==3) {
            $title = "管理员您好，用户[".$arr['gogo_id'].']发起了在线咨询，请进入总后台进行操作！';
            $post_data = json_encode(['email'=>$data['account'],'title'=>$title,'content'=>$url], true);
            $res = httpRequest('https://admin.gogo198.cn/collect_website/public/?s=api/sendemail/index', $post_data, [
                'Content-Type: application/json; charset=utf-8',
                'Content-Length:' . strlen($post_data),
                'Cache-Control: no-cache',
                'Pragma: no-cache'
            ]);
        }
    }

    #计算价格
    public function calc(Request $request)
    {
        $data = $request->except(['_token']);
        if (isset($data['attr_ids'])) {
            #有规格的

            #1、规格区间价格
            $attr_ids = explode('_', $data['attr_ids']);
            $attr_ids = array_reverse($attr_ids);
            $attr_ids = implode('|', $attr_ids);

            $sku = Db::table('goods_sku')->where(['goods_id'=>$data['gid'],'spec_vids'=>$attr_ids])->first();
            $sku = objtoarr($sku);
            if (empty($sku)) {
                $attr_ids = array_reverse(explode('|', $attr_ids));
                $attr_ids = implode('|', $attr_ids);
                $sku = Db::table('goods_sku')->where(['goods_id'=>$data['gid'],'spec_vids'=>$attr_ids])->first();
                $sku = objtoarr($sku);
            }
            if (empty($sku)) {
                return response()->json(['code'=>-1,'msg'=>'暂无此规格报价，请选择其他规格']);
            }

            $sku['sku_prices'] = json_decode($sku['sku_prices'], true);
            $sku_info = $sku['sku_prices'];
            $price = 0;
            foreach ($sku_info['start_num'] as $k=>$v) {
                if ($sku_info['select_end'][$k] == 1) {
                    #数值
                    if ($v<=$data['buy_num'] && $data['buy_num']<=$sku_info['end_num'][$k]) {
                        $price = number_format($data['buy_num'] * $sku_info['price'][$k], 2);
                        break;
                    }
                } elseif ($sku_info['select_end'][$k] == 2) {
                    #以上
                    $price = number_format($data['buy_num'] * $sku_info['price'][$k], 2);
                    break;
                }
            }
            $price = str_replace(',', '', $price);

            return result(0, ['price'=>$price], '');
        } else {
            #无规格的

            $sku = Db::table('goods_sku')->where(['goods_id'=>$data['gid']])->first();
            $sku = objtoarr($sku);
            $sku['sku_prices'] = json_decode($sku['sku_prices'], true);

            $sku_info = $sku['sku_prices'];
            $price = 0;
            foreach ($sku_info['start_num'] as $k=>$v) {
                if ($sku_info['select_end'][$k] == 1) {
                    #数值
                    if ($v<=$data['buy_num'] && $data['buy_num']<=$sku_info['end_num'][$k]) {
                        $price = number_format($data['buy_num'] * $sku_info['price'][$k], 2);
                        break;
                    }
                } elseif ($sku_info['select_end'][$k] == 2) {
                    #以上
                    $price = number_format($data['buy_num'] * $sku_info['price'][$k], 2);
                    break;
                }
            }
            $price = str_replace(',', '', $price);

            return result(0, ['price'=>$price], '');
        }
    }

    #商品详情页：计算其他费用+优惠减免+优惠随赠
    public function calc_otherfee(Request $request)
    {
        $data = $request->except(['_token']);

        $goods = Db::table('goods')->where(['goods_id'=>$data['gid']])->first();
        $goods = objtoarr($goods);

        $reduction_arr = [];
        $gift_arr = [];
        if ($goods['shop_id']>0 && empty($goods['drug_id'])) {
            #1、其他费用
            if (!empty($goods['otherfee_content'])) {
                $goods['otherfee_content'] = json_decode($goods['otherfee_content'], true);
                $goods['otherfee_total'] = 0;
                $goods['otherfee_currency'] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$goods['otherfee_content']['currency'][0]])->first()->currency_symbol_standard;

                foreach ($goods['otherfee_content']['standard'] as $k=>$v) {
                    if ($v==1) {
                        #按订单数量(1张)
                        $goods['otherfee_total'] += $goods['otherfee_content']['price'][$k];
                        $goods['otherfee_content']['otherfee_standard_name'][$k] = '按订单数量';
                    } elseif ($v==2) {
                        #按包裹数量（1个）
                        $goods['otherfee_total'] += $goods['otherfee_content']['price'][$k];
                        $goods['otherfee_content']['otherfee_standard_name'][$k] = '按包裹数量';
                    } elseif ($v==3) {
                        #按商品数量
                        $goods['otherfee_content']['price'][$k] = str_replace(',', '', number_format(intval($data['total']) * $goods['otherfee_content']['price'][$k], 2));
                        $goods['otherfee_total'] += $goods['otherfee_content']['price'][$k];
                        $goods['otherfee_content']['otherfee_standard_name'][$k] = '按商品数量';
                    } elseif ($v==4) {
                        #按服务次数（1次）
                        $goods['otherfee_total'] += $goods['otherfee_content']['price'][$k];
                        $goods['otherfee_content']['otherfee_standard_name'][$k] = '按服务次数';
                    } elseif ($v==5) {
                        #按商品总价比率
                        $goods['otherfee_content']['price'][$k] = str_replace(',', '', number_format($data['total_price'] * $goods['otherfee_content']['price'][$k], 2));
                        $goods['otherfee_total'] += $goods['otherfee_content']['price'][$k];
                        $goods['otherfee_content']['otherfee_standard_name'][$k] = '按商品总价比率';
                    }
                }
            } else {
                $goods['otherfee_content'] = [];
                $goods['otherfee_total'] = 0;
                $goods['otherfee_currency'] = '';
            }

            #2、优惠减免
            $reduction_arr = [];

            #废弃
            if (!empty($goods['reduction_content']) && 1>2) {
                $goods['reduction_content'] = json_decode($goods['reduction_content'], true);
                $reduction = $goods['reduction_content'];
                foreach ($reduction['type'] as $k=>$v) {
                    #减免项目名称
                    $rule = Db::table('ssl_reduction_rule')->where(['id'=>$v])->first();
                    $rule = json_decode(json_encode($rule, true), true);
                    $rule['content'] = json_decode($rule['content'], true);
                    $reduction['project_name'][$k] = $rule['name'];

                    #优惠归属类别
                    if ($reduction['preferential_blong'][$k]==1) {
                        $reduction['preferential_blong_name'][$k] = '商家优惠';
                    } elseif ($reduction['preferential_blong'][$k]==2) {
                        $reduction['preferential_blong_name'][$k] = '平台优惠';
                    } elseif ($reduction['preferential_blong'][$k]==3) {
                        $reduction['preferential_blong_name'][$k] = '其他优惠';
                    }

                    #判断当前总价是否大于等于第一个价格
                    if ($data['total_price'] >= $reduction['price1'][$k][0]) {
                        $reduction['currency1'][$k][0] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$reduction['currency1'][$k][0]])->first()->currency_symbol_standard;

                        #减免限制
                        if ($reduction['strict'][$k]==1) {
                            $reduction['strict_name'][$k] = '不能与其他优惠同时使用';
                        } elseif ($reduction['strict'][$k]==2) {
                            $reduction['strict_name'][$k] = '允许与其他优惠同时使用';
                        }

                        #判断当前总金额是否满足条件金额
                        array_push($reduction_arr, [
                            'preferential_blong'=>$reduction['preferential_blong'][$k],
                            'preferential_blong_name'=>$reduction['preferential_blong_name'][$k],
                            'type'=>$reduction['type'][$k],
                            'strict'=>$reduction['strict'][$k],
                            'strict_name'=>$reduction['strict_name'][$k],
                            'currency1'=>$reduction['currency1'][$k],
                            'price1'=>$reduction['price1'][$k],
                            'currency2'=>$reduction['currency2'][$k],
                            'price2'=>$reduction['price2'][$k],
                            'project_name'=>$reduction['project_name'][$k],
                            'content'=>$rule['content']
                        ]);
                    }
                }
            }

            #3、优惠随赠
            $gift_arr = [];
            if (!empty($goods['gift_content']) && 1>2) {
                $goods['gift_content'] = json_decode($goods['gift_content'], true);
                $gift_content = $goods['gift_content'];
                foreach ($gift_content['type'] as $k=>$v) {
                    #运营商
                    if ($gift_content['operaer'][$k]==1) {
                        $gift_content['operaer_name'][$k] = '平台';
                    } elseif ($gift_content['operaer'][$k]==2) {
                        $gift_content['operaer_name'][$k] = '卖家';
                    } elseif ($gift_content['operaer'][$k]==3) {
                        $gift_content['operaer_name'][$k] = '他方';
                    }
                    #优惠归属类别
                    if ($gift_content['preferential_blong'][$k]==1) {
                        $gift_content['preferential_blong_name'][$k] = '商家优惠';
                    } elseif ($gift_content['preferential_blong'][$k]==2) {
                        $gift_content['preferential_blong_name'][$k] = '平台优惠';
                    } elseif ($gift_content['preferential_blong'][$k]==3) {
                        $gift_content['preferential_blong_name'][$k] = '其他优惠';
                    }
                    #随赠限制
                    if ($gift_content['strict'][$k]==1) {
                        $gift_content['strict_name'][$k] = '不能与其他优惠同时使用';
                    } elseif ($gift_content['strict'][$k]==2) {
                        $gift_content['strict_name'][$k] = '允许与其他优惠同时使用';
                    }

                    if ($v==1) {
                        #积分
                        $gift_content['type_name'][$k] = '积分';
                        $gift_content['points_currency'][$k] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$gift_content['points_currency'][$k]])->first()->currency_symbol_standard;
                        if ($gift_content['points_type'][$k]==1) {
                            #按每订单/次送x积分
                            $gift_content['points_typeName'][$k] = '按每订单/次送';
                        } elseif ($gift_content['points_type'][$k]==2) {
                            #按每币种+金额送x积分
                            $gift_content['points_typeName'][$k] = '按每'.$gift_content['points_currency'][$k].$gift_content['points_money'][$k].'送';
                        }
                    } elseif ($v==2) {
                        #卡券
                        $gift_content['type_name'][$k] = '卡券';
                        $gift_content['coupon_currency'][$k] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$gift_content['coupon_currency'][$k]])->first()->currency_symbol_standard;
                    } elseif ($v==3) {
                        #赠品
                        $gift_content['type_name'][$k] = '随赠';
                        if ($gift_content['accgift_type'][$k]==1) {
                            $gift_content['accgift_typeName'][$k] = '虚拟';
                        } elseif ($gift_content['accgift_type'][$k]==2) {
                            $gift_content['accgift_typeName'][$k] = '服务';
                        } elseif ($gift_content['accgift_type'][$k]==3) {
                            $gift_content['accgift_typeName'][$k] = '实物';
                        }
                    }

                    array_push($gift_arr, [
                        'preferential_blong'=>$gift_content['preferential_blong'][$k],
                        'preferential_blong_name'=>isset($gift_content['preferential_blong_name'][$k]) ? $gift_content['preferential_blong_name'][$k] : '',
                        'type'=>$gift_content['type'][$k],
                        'type_name'=>$gift_content['type_name'][$k],
                        'operaer'=>$gift_content['operaer'][$k],
                        'operaer_name'=>$gift_content['operaer_name'][$k],
                        'points_type'=>$gift_content['points_type'][$k],
                        'points_typeName'=>isset($gift_content['points_typeName'][$k]) ? $gift_content['points_typeName'][$k] : '',
                        'points_currency'=>$gift_content['points_currency'][$k],
                        'points_money'=>$gift_content['points_money'][$k],
                        'points_send'=>$gift_content['points_send'][$k],
                        'coupon_currency'=>$gift_content['coupon_currency'][$k],
                        'coupon_money'=>$gift_content['coupon_money'][$k],
                        'coupon_num'=>$gift_content['coupon_num'][$k],
                        'accgift_type'=>$gift_content['accgift_type'][$k],
                        'accgift_typeName'=>isset($gift_content['accgift_typeName'][$k]) ? $gift_content['accgift_typeName'][$k] : '',
                        'accgift_content'=>$gift_content['accgift_content'][$k],
                        'accgift_num'=>$gift_content['accgift_num'][$k],
                        'strict'=>$gift_content['strict'][$k],
                        'strict_name'=>$gift_content['strict_name'][$k],
                    ]);
                }
            }
        } else {
            $goods['otherfee_content'] = [];
            $goods['otherfee_total'] = 0;
            $goods['otherfee_currency'] = '';
        }


//        dd($reduction_arr);

        return result(0, ['otherfee_content'=>$goods['otherfee_content'],'otherfee_total'=>str_replace(',', '', number_format($goods['otherfee_total'], 2)),'otherfee_currency'=>$goods['otherfee_currency'],'reduction'=>$reduction_arr,'gift'=>$gift_arr], '');
    }

    public function upload_file(Request $request)
    {
        $data = $request->except(['_token']);

        $file = $request->file('file');
        // 准备要上传的文件
        $file_name = $file->getClientOriginalName(); // 获取文件名
        $file_size = $file->getSize(); // 获取文件大小
        try {
            $file_data = [
                "name" => $file_name,
                "type" => $_FILES["file"]['type'],
                "tmp_name" => $_FILES['file']['tmp_name'],
                "error" => 0,
                "size" => $file_size,
            ];
            $post_data = json_encode(['folder' => $data['folder'], 'type' => $data['type'], 'file' => $file_data], true);
            $res = httpRequest('https://shop.gogo198.cn/collect_website/public/?s=api/uploadfile/index', $post_data, [
                'Content-Type: application/json; charset=utf-8',
                'Content-Length:' . strlen($post_data),
                'Cache-Control: no-cache',
                'Pragma: no-cache'
            ]);
            $res = json_decode($res, true);
            if ($res['code']==1) {
                return json_encode(["code" => 1, "message" => "上传成功", "file_path" => $res['file_path'] ], true);
            } else {
                return json_encode(["code" => 0, "message" => "上传失败", "path" => "" ], true);
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }

    #计算更多服务费用
    public function calc_services(Request $request)
    {
        $datas = $request->except(['_token']);
        #增值服务id
        $id = intval($datas['id']);
        #购物清单id
        $cart_id = intval($datas['now_cart_id']);
        #所有购物清单ids
        $cart_ids = trim($datas['cart_ids']);
        #拍照数量
        $num = isset($datas['num']) ? $datas['num'] : 0;
        #拍照要求
        $photoRequest = isset($datas['photoRequest']) ? rtrim($datas['photoRequest'], '@@@') : '';
        #已选1，未选0
        $val = isset($datas['val']) ? $datas['val'] : 0;
        #当前购物清单id的增值服务金额
        $price = FloatVal($datas['price']);

        #增值服务
        $services = Db::table('goods_services')->where(['id'=>$id])->first();
        $services = objtoarr($services);

        $parent_services = Db::table('cost_service')->where(['id'=>$services['service_id'],'company_id'=>0])->first();
        $parent_services = objtoarr($parent_services);
        $all_services = Db::table('cost_service')->where(['pid'=>$parent_services['pid']])->get();
        $all_services = objtoarr($all_services);
        $all_services_arr = '';
        foreach ($all_services as $sk=>$sv) {
            $all_services_arr .= $sv['id'].',';
        }

        #必选增值服务
        $must_selected_services = Db::table('goods_services')->whereRaw('company_id='.$services['company_id'].' and is_select=1 and find_in_set(service_id,"'.rtrim($all_services_arr, ',').'")')->get();
        $must_selected_services = objtoarr($must_selected_services);
        //插入例子到购物清单的增值服务（services）字段中
//        array:5 [
//          0 => array:3 [
//            "service_id" => "1"
//            "photonum" => "2"
//            "photoRequest" => "123@@@456@@@"
//          ]
//          1 => array:1 [
//            "service_id" => "2"
//          ]
//          2 => array:1 [
//            "service_id" => "3"
//          ]
//          3 => array:1 [
//            "service_id" => "4"
//          ]
//          4 => array:1 [
//            "service_id" => "5"
//          ]
//        ]

        $cart_info = Db::table('cart')->where(['cart_id'=>$cart_id])->first();
        $cart_info = objtoarr($cart_info);

        $servicesArr = [];
        if (!empty($cart_info['services'])) {
            #已选增值服务
            $cart_info['services'] = json_decode($cart_info['services'], true);
            $isAdd = 0;
            foreach ($cart_info['services'] as $k=>$v) {
                if ($val==0) {
                    #添加
                    if ($v['service_id']==$id) {
                        if ($services['type']==1) {
                            #重置拍照信息
                            $cart_info['services'][$k] = ['service_id'=>$id,'photonum'=>$num,'photoRequest'=>$photoRequest];
                        }
                        $isAdd = 1;
                    }
                } elseif ($val==1) {
                    #剔除
                    if ($v['service_id']==$id) {
                        if ($services['is_select']!=1) {
                            #非必选，可剔除
                            array_splice($cart_info['services'], $k, 1);
                        }
                    }
                    $isAdd = 1;
                }
            }

            #除拍照外，添加时需判断表中清单有无出现重复字段，出现时，不添加
            if ($isAdd==0) {
                if ($services['type']==1) {
                    array_push($cart_info['services'], ['service_id'=>$id,'photonum'=>$num,'photoRequest'=>$photoRequest]);
                } else {
                    array_push($cart_info['services'], ['service_id'=>$id]);
                }
            }

            #重新排序增值服务字段
            if (empty($cart_info['services'])) {
                $cart_info['services'] = '';
            } else {
                ksort($cart_info['services']);
                $cart_info['services'] = json_encode($cart_info['services'], true);
            }

            //选择了增值服务后，计算当前服务金额，当前增值服务总金额，当前购物清单金额，当前订单金额
            Db::table('cart')->where(['cart_id'=>$cart_id])->update([
                'services'=>$cart_info['services']
            ]);
        } else {
            #未选过增值服务
            if ($services['type']==1) {
                $servicesArr = [['service_id'=>$id,'photonum'=>$num,'photoRequest'=>$photoRequest]];
            } else {
                $servicesArr = [['service_id'=>$id]];
            }

            #必选增值服务(到时候加入清单/立即购买时默认选择)
            foreach ($must_selected_services as $k=>$v) {
                array_push($servicesArr, ['service_id'=>$v['id']]);
            }

            //选择了增值服务后，计算当前服务金额，当前增值服务总金额，当前购物清单金额，当前订单金额
            Db::table('cart')->where(['cart_id'=>$cart_id])->update([
                'services'=>json_encode($servicesArr, true)
            ]);
        }

        $website_user = Db::connection('shop_db')->table('website_user')->where(['custom_id'=>session('user')['gogo_id']])->first();

        $data = Db::table('cart')->whereRaw('cart_id in ('.$cart_ids.') and user_id='.$website_user->id)->get();
        $data = objtoarr($data);

        $final['final_price'] = 0;
        $final['final_currency']='';#此订单（包含已选购物清单）最终价格
        $final['freight_price'] = $this->calc_freight($data,$data[0]['freight_id']);#计算运费
        
        $goods_sumprice = 0;
        $services_sumprice = 0;
        $services_price = 0;
        foreach ($data as $k=>$v) {
            if (empty($v['services'])) {
                $data[$k]['services_old']=[];
                $data[$k]['services'] = [];
            } else {
                $data[$k]['services_old'] = $v['services'];
                $data[$k]['services'] = json_decode($v['services']);
            }

            #这层相当于在店铺
            $data[$k]['sku_info'] = Db::table('cart_sku')->where(['cart_id'=>$v['cart_id'],'selected'=>1,'is_buy'=>0])->get();
            $data[$k]['sku_info'] = objtoarr($data[$k]['sku_info']);

            #当前购物车的商品价格
            $goods_price = 0;
            #附加费用
            $data[$k]['services']['additional_money'] = 0;
            $freight_num=0;
            $goods_freight_fee=0;
            foreach ($data[$k]['sku_info'] as $k2=>$v2) {
                #这层相当于是该店铺下的各规格商品
                $goods_sku = Db::table('goods_sku')->where(['sku_id'=>$v2['sku_id']])->first();
                $goods_sku = objtoarr($goods_sku);
                $goods_sku['sku_prices'] = json_decode($goods_sku['sku_prices'], true);

                $goods = Db::table('goods')->where(['goods_id'=>$goods_sku['goods_id']])->first();
                $goods = objtoarr($goods);
                $goods['other_shop'] = json_decode($goods['other_shop'], true);

                #店铺名称
                $data[$k]['shop_name'] = $goods['other_shop']['shopName'];
                #规格/商品图片
                if (!empty($goods_sku['sku_images'])) {
                    $data[$k]['goods_image'] = $goods_sku['sku_images'];
                } else {
                    $data[$k]['goods_image'] = $goods['goods_image'];
                }
                #商品名称
                $data[$k]['goods_name'] = $goods['goods_name'];
                #商品id
                $data[$k]['goods_id'] = $goods['goods_id'];

                #商品（规格）信息==============================start
                $data[$k]['sku_info'][$k2]['bgoods_name'] = $goods['goods_name'];
                if (empty($goods_sku['spec_names'])) {
                    #无规格商品
                    $data[$k]['sku_info'][$k2]['boption_name'] = $goods['goods_name'];
                } else {
                    #有规格商品
                    $data[$k]['sku_info'][$k2]['boption_name'] = $goods_sku['spec_names'];
                }
                #商品规格名称
                if (empty($goods_sku['spec_names'])) {
                    #无规格商品
                    $data[$k]['sku_info'][$k2]['soption_name'] = $goods['goods_name'];
                } else {
                    #有规格商品
                    $data[$k]['sku_info'][$k2]['soption_name'] = $goods_sku['spec_names'];
                }
                #商品（规格）币种&数量&价格（不用重复计算价格了，已经计算了）
                $data[$k]['sku_info'][$k2]['currency'] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$v2['currency']])->first()->currency_symbol_standard;
                $data[$k]['sku_info'][$k2]['price'] = $v2['price'];
                $data[$k]['sku_info'][$k2]['num'] = $v2['goods_num'];
                #商品（规格）信息==============================end

                #附加费用（国内运费）=====================================start
                $freight_num += $v2['goods_num'];
                $goods_freight_fee += $goods['goods_freight_fee'];
                #附加费用（国内运费）=====================================end

                #当前购物车的商品价格
                $goods_price += $v2['price'];
                $data[$k]['currency'] = $data[$k]['sku_info'][$k2]['currency'];
                $data[$k]['price'] = number_format($goods_price, 2);

                #最终价格的币种
                $final['final_currency']=$data[$k]['currency'];
            }

            #商品附加费用：卖家运费/卖家要的费用
            #附加费用=======================================start
            $data[$k]['services']['additional_money'] = 0;
            if ($goods['shop_id']==0) {
                $services_ids = Db::table('cost_service')->where(['pid' => 2, 'company_id' => 0])->get();
                $services_ids = objtoarr($services_ids);
                $service_ids_arr = '';
                foreach ($services_ids as $sk => $sv) {
                    $service_ids_arr .= $sv['id'] . ',';
                }

                $data[$k]['services']['additional'] = Db::table('goods_services')->whereRaw('company_id=0 and find_in_set(service_id,"' . rtrim($service_ids_arr, ',') . '")')->get();
                $data[$k]['services']['additional'] = objtoarr($data[$k]['services']['additional']);
                foreach ($data[$k]['services']['additional'] as $k2 => $v2) {
                    $data[$k]['services']['additional'][$k2]['currency'] = Db::connection('shop_db')->table('centralize_currency')->where(['id' => $v2['currency']])->first()->currency_symbol_standard;
                    if ($v2['is_select'] == 1) {
                        $data[$k]['services']['additional_money'] += $v2['price'];
                    }
                }

//            $data[$k]['services']['additional222'] = [
//                ['name'=>'国内运费','num'=>1,'currency'=>'CNY','price'=>number_format($goods_freight_fee,2)]
//            ];
            } else {
                #商户企业id
                if (empty($goods['otherfees_content']) && empty($goods['reduction_content']) && empty($goods['gift_content']) && empty($goods['noinclude_content'])) {
                    $data[$k]['services']['additional'] = [];
                } else {
                    if (!empty($goods['otherfees_content'])) {
                        #1、其他费用判断
                        $otherfees_content = json_decode($goods['otherfees_content'], true);

                        foreach ($otherfees_content['fees_name'] as $k3=>$v3) {
                            if ($otherfees_content['fees_condition'][$k3]==2) {
                                #有条件触发

                                if ($otherfees_content['fees_trigger'][$k3]==1) {
                                    #要素触发
                                    if ($otherfees_content['fees_trigger2_equal'][$k3]==1) {
                                        #少于

                                        #大于/等于就退出当前循环，进行下一个循环（不满足条件）
                                        if ($otherfees_content['fees_trigger2'][$k3]==1) {
                                            #购买数量
                                            if ($v2['goods_num']>=$otherfees_content['fees_trigger2_num'][$k3]) {
                                                continue;
                                            }
                                        } elseif ($otherfees_content['fees_trigger2'][$k3]==2) {
                                            #购买金额
                                            if ($v2['price']>=$otherfees_content['fees_trigger2_num'][$k3]) {
                                                continue;
                                            }
                                        }
                                    } elseif ($otherfees_content['fees_trigger2_equal'][$k3]==2) {
                                        #少于或等于

                                        #大于就退出当前循环，进行下一个循环（不满足条件）
                                        if ($otherfees_content['fees_trigger2'][$k3]==1) {
                                            #购买数量
                                            if ($v2['goods_num']>$otherfees_content['fees_trigger2_num'][$k3]) {
                                                continue;
                                            }
                                        } elseif ($otherfees_content['fees_trigger2'][$k3]==2) {
                                            #购买金额
                                            if ($v2['price']>$otherfees_content['fees_trigger2_num'][$k3]) {
                                                continue;
                                            }
                                        }
                                    } elseif ($otherfees_content['fees_trigger2_equal'][$k3]==3) {
                                        #等于

                                        #不等于就退出当前循环，进行下一个循环（不满足条件）
                                        if ($otherfees_content['fees_trigger2'][$k3]==1) {
                                            #购买数量
                                            if ($v2['goods_num']!=$otherfees_content['fees_trigger2_num'][$k3]) {
                                                continue;
                                            }
                                        } elseif ($otherfees_content['fees_trigger2'][$k3]==2) {
                                            #购买金额
                                            if ($v2['price']!=$otherfees_content['fees_trigger2_num'][$k3]) {
                                                continue;
                                            }
                                        }
                                    } elseif ($otherfees_content['fees_trigger2_equal'][$k3]==4) {
                                        #大于

                                        #少于/等于就退出当前循环，进行下一个循环（不满足条件）
                                        if ($otherfees_content['fees_trigger2'][$k3]==1) {
                                            #购买数量
                                            if ($v2['goods_num']<=$otherfees_content['fees_trigger2_num'][$k3]) {
                                                continue;
                                            }
                                        } elseif ($otherfees_content['fees_trigger2'][$k3]==2) {
                                            #购买金额
                                            if ($v2['price']<=$otherfees_content['fees_trigger2_num'][$k3]) {
                                                continue;
                                            }
                                        }
                                    } elseif ($otherfees_content['fees_trigger2_equal'][$k3]==5) {
                                        #大于或等于

                                        #少于就退出当前循环，进行下一个循环（不满足条件）
                                        if ($otherfees_content['fees_trigger2'][$k3]==1) {
                                            #购买数量
                                            if ($v2['goods_num']<$otherfees_content['fees_trigger2_num'][$k3]) {
                                                continue;
                                            }
                                        } elseif ($otherfees_content['fees_trigger2'][$k3]==2) {
                                            #购买金额
                                            if ($v2['price']<$otherfees_content['fees_trigger2_num'][$k3]) {
                                                continue;
                                            }
                                        }
                                    }
                                } elseif ($otherfees_content['fees_trigger'][$k3]==2) {
                                    #型号触发
                                    if ($otherfees_content['fees_options'][$k3]==-1) {
                                        continue;
                                    }
                                    #首先找到商户商品表id和规格
                                    $goods_merchant = Db::table('goods_merchant')->where(['shelf_id'=>$v['goods_id']])->first();
                                    $goods_sku_merchant = Db::table('goods_sku_merchant')->where(['goods_id'=>$goods_merchant->id,'sku_id'=>$otherfees_content['fees_options'][$k3]])->first();
                                    $goods_sku_merchant = objtoarr($goods_sku_merchant);

                                    #不是当前规格就退出当前循环，进行下一个循环（不满足条件）
                                    if ($goods_sku['spec_names']!=$goods_sku_merchant['spec_names']) {
                                        continue;
                                    }
                                } elseif ($otherfees_content['fees_trigger'][$k3]==3) {
                                    #物流触发（待做）
                                }
                            }

                            #收费标准
                            if ($otherfees_content['fees_standard'][$k3]==1) {
                                #定额计价
                                $data[$k]['services']['additional'][] = [
                                    'name'=>$otherfees_content['fees_name'][$k3],
                                    'desc'=>$otherfees_content['fees_desc'][$k3],
                                    'currency'=>Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$otherfees_content['fees_standard_currency'][$k3]])->first()->currency_symbol_standard,
                                    'price'=>number_format($otherfees_content['fees_standard_price'][$k3], 2)
                                ];
                                $data[$k]['services']['additional_money'] += $otherfees_content['fees_standard_price'][$k3];
                            } elseif ($otherfees_content['fees_standard'][$k3]==2) {
                                #比例计价
                                if ($otherfees_content['fees_standard_ratio'][$k3]==1) {
                                    #计费基数
                                    $data[$k]['services']['additional'][] = [
                                        'name'=>$otherfees_content['fees_name'][$k3],
                                        'desc'=>$otherfees_content['fees_desc'][$k3],
                                        'currency'=>Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$otherfees_content['fees_standard_currency'][$k3]])->first()->currency_symbol_standard,
                                        'price'=>number_format($otherfees_content['fees_standard_ratio_price'][$k3], 2)
                                    ];
                                    $data[$k]['services']['additional_money'] += $otherfees_content['fees_standard_ratio_price'][$k3];
                                } elseif ($otherfees_content['fees_standard_ratio'][$k3]==2) {
                                    #计费比率
                                    $ratio_price = ($otherfees_content['fees_standard_ratio_ratio'][$k3] / 100) * $v2['price'];
                                    $data[$k]['services']['additional'][] = [
                                        'name'=>$otherfees_content['fees_name'][$k3],
                                        'desc'=>$otherfees_content['fees_desc'][$k3],
                                        'currency'=>Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$otherfees_content['fees_standard_currency'][$k3]])->first()->currency_symbol_standard,
                                        'price'=>number_format($ratio_price, 2)
                                    ];
                                    $data[$k]['services']['additional_money'] += $ratio_price;
                                }
                            }
                        }
                    }
                    if (!empty($goods['reduction_content'])) {
                        #2、销售优惠减免判断
                        $reduction_content = json_decode($goods['reduction_content'], true);

                        $reduction_strict = 0;
                        $reduction_arr = [];
                        foreach ($reduction_content['preferential_blong'] as $k3=>$v3) {
                            $rule_name = Db::table('ssl_reduction_rule')->where(['id'=>$reduction_content['type'][$k3]])->first();
                            $rule_name = objtoarr($rule_name);
                            $rule_name['content'] = json_decode($rule_name['content'], true);

                            $name = '';
                            if ($v3==1) {
                                $name = '卖家优惠';
                            } elseif ($v3==2) {
                                $name = '平台优惠';
                            } elseif ($v3==3) {
                                $name = '他方优惠';
                            }

                            if ($reduction_content['strict'][$k3]==1 && $reduction_strict==0) {
                                #单独
                                if ($v2['price']>$reduction_content['price1'][$k3]) {
                                    $reduction_arr = [
                                        'name'=>$name,
                                        'desc'=>$rule_name['content'][0].$reduction_content['price1'][$k3].$rule_name['content'][2].$reduction_content['price2'][$k3],
                                        'currency'=>Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$reduction_content['currency1']])->first()->currency_symbol_standard,
                                        'price'=>'-'.number_format($reduction_content['price2'][$k3], 2)
                                    ];
                                    $data[$k]['services']['additional'][] = $reduction_arr;
                                    $data[$k]['services']['additional_money'] -= $reduction_content['price2'][$k3];
                                    break;
                                }
                                $reduction_strict=1;
                            } elseif ($reduction_content['strice'][$k3]==2 && ($reduction_strict==0 || $reduction_strict==2)) {
                                #叠加
                                if ($v2['price']>$reduction_content['price1'][$k3]) {
                                    $reduction_arr = [
                                        'name' => $name,
                                        'desc' => $rule_name['content'][0] . $reduction_content['price1'][$k3] . $rule_name['content'][2] . $reduction_content['price2'][$k3],
                                        'currency' => Db::connection('shop_db')->table('centralize_currency')->where(['id' => $reduction_content['currency1']])->first()->currency_symbol_standard,
                                        'price' => '-'.number_format($reduction_content['price2'][$k3], 2)
                                    ];
                                    $data[$k]['services']['additional'][] = $reduction_arr;
                                    $data[$k]['services']['additional_money'] -= $otherfees_content['price2'][$k3];
                                }
                                $reduction_strict=2;
                            }
                        }
                    }
                    if (!empty($goods['gift_content'])) {
                        #3、随赠优惠判断
                        $gift_content = json_decode($goods['gift_content'], true);

                        $gift_strict = 0;
                        foreach ($gift_content['preferential_blong'] as $k3=>$v3) {
                            $name = '';
                            if ($v3==1) {
                                $name = '卖家优惠';
                            } elseif ($v3==2) {
                                $name = '平台优惠';
                            } elseif ($v3==3) {
                                $name = '他方优惠';
                            }

                            if ($gift_content['strict'][$k3]==1 && $gift_strict==0) {
                                #单独
                                $gift_strict=1;
                            } elseif ($gift_content['strict'][$k3]==2 && ($gift_strict==0 || $gift_strict==2)) {
                                #叠加
                                $gift_strict=2;
                            } else {
                                continue;
                            }

                            $gift_project = '随赠项目：';
                            if ($gift_content['type'][$k3]==1) {
                                $gift_project .= '积分；';

                                if ($gift_content['points_type'][$k3]==1) {
                                    $gift_project .= '按每订单/次，赠送'.$gift_content['points_send'][$k3].'积分；';
                                } elseif ($gift_content['points_type'][$k3]==2) {
                                    if ($v2['price']>=$gift_content['points_money'][$k3]) {
                                        $points_currency = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$gift_content['points_currency']])->first()->currency_symbol_standard;
                                        $gift_project .= '按金额满 '.$points_currency.' '.number_format($gift_content['points_money'][$k3], 2).'，赠送'.$gift_content['points_send'][$k3].'积分；';
                                    }
                                }
                            } elseif ($gift_content['type'][$k3]==2) {
                                $gift_project .= '卡券；';
                                $coupon_currency = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$gift_content['coupon_currency']])->first()->currency_symbol_standard;
                                $gift_project .= '赠送价值 '.$coupon_currency.' '.$gift_content['coupon_money'][$k3].' *'.$gift_content['coupon_num'][$k].'张；';
                            } elseif ($gift_content['type'][$k3]==3) {
                                $gift_project .= '随赠；';

                                if ($gift_content['accgift_type'][$k3]==1) {
                                    $gift_project .= '虚拟物品：'.$gift_content['accgift_content'][$k3].' *'.$gift_content['accgift_num'][$k3].'个';
                                } elseif ($gift_content['accgift_type'][$k3]==2) {
                                    $gift_project .= '额外服务：'.$gift_content['accgift_content'][$k3].' *'.$gift_content['accgift_num'][$k3].'次';
                                } elseif ($gift_content['accgift_type'][$k3]==3) {
                                    $gift_project .= '实物赠品：'.$gift_content['accgift_content'][$k3].' *'.$gift_content['accgift_num'][$k3].'个';
                                }
                            }

                            $gift_arr = [
                                'name'=>$name,
                                'desc'=>$gift_project,
                                'currency'=>Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$gift_content['points_currency']])->first()->currency_symbol_standard,
                                'price'=>'0.00'
                            ];
                            $data[$k]['services']['additional'][] = $gift_arr;
//                            $data[$k]['services']['additional_money'] = $gift_content['price2'][$k3];
                        }
                    }
                    if (!empty($goods['noinclude_content'])) {
                        #4、价格未含
                        $noinclude_content = json_decode($goods['noinclude_content'], true);

                        foreach ($noinclude_content['name'] as $k3=>$v3) {
                            $data[$k]['services']['additional'][] = [
                                'name'=>$v3,
                                'desc'=>$noinclude_content['desc'][$k3],
                                'currency'=>Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$noinclude_content['currency'][$k3]])->first()->currency_symbol_standard,
                                'price'=>number_format($noinclude_content['price'][$k3], 2)
                            ];
                            $data[$k]['services']['additional_money'] += $noinclude_content['price'][$k3];
                        }
                    }
//                    $data[$k]['services']['additional'] = $data[$k]['services']['additional'];
//                    dd($data[$k]['services']['additional']);
                }
//                dd($goods);
            }

            $data[$k]['services']['additional_money'] = number_format($data[$k]['services']['additional_money'], 2);
            #附加费用=======================================end

            #增值服务=======================================start
            $data[$k]['services']['increment_money'] = 0;

            $services_ids = Db::table('cost_service')->where(['pid'=>1,'company_id'=>0])->get();
            $services_ids = objtoarr($services_ids);
            $service_ids_arr = '';
            foreach ($services_ids as $sk=>$sv) {
                $service_ids_arr .= $sv['id'].',';
            }

            $data[$k]['services']['increment'] = Db::table('goods_services')->whereRaw('company_id=0 and find_in_set(service_id,"'.rtrim($service_ids_arr, ',').'")')->get();
            $data[$k]['services']['increment'] = objtoarr($data[$k]['services']['increment']);

            foreach ($data[$k]['services']['increment'] as $k2=>$v2) {
                $data[$k]['services']['increment'][$k2]['currency'] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$v2['currency']])->first()->currency_symbol_standard;
                if ($v2['is_select']==1) {
                    $data[$k]['services']['increment'][$k2]['final_money'] = $v2['price'];
                } else {
                    $data[$k]['services']['increment'][$k2]['final_money'] = '0.00';
                }
            }

            #查看当前购物清单的增值服务
            if (!empty($data[$k]['services_old'])) {
                #已选服务
                $data[$k]['services_old'] = json_decode($data[$k]['services_old'], true);

                foreach ($data[$k]['services_old'] as $k2=>$v2) {
                    $services = Db::table('goods_services')->where(['id'=>$v2['service_id']])->first();
                    $services = objtoarr($services);

                    if ($services['type']==1) {
                        #照片服务/价格递增
                        if ($v2['photonum']>=1) {
                            if ($v2['photonum']>=$services['num']) {
                                $services['price'] = $services['price'] + (($v2['photonum'] - $services['num']) * $services['interval_price']);
                                $data[$k]['services']['increment_money'] += $services['price'];
                                $data[$k]['services']['increment'][$k2]['final_money'] = $services['price'];

                                #只保留当前服务价格
                                if ($services_price==0 && $v2['service_id']==$id) {
                                    $services_price = $services['price'];
                                }
                            }
                        }
                    } else {
                        #其他服务
                        $data[$k]['services']['increment_money'] += $services['price'];
                        $data[$k]['services']['increment'][$k2]['final_money'] = $services['price'];

                        #只保留当前服务价格
                        if ($services_price==0 && $v2['service_id']==$id) {
                            $services_price = $services['price'];
                        }
                    }
                }
            } else {
                #未选服务
                foreach ($data[$k]['services']['increment'] as $k2=>$v2) {
                    if ($v2['is_select']==1) {
                        $data[$k]['services']['increment_money'] += $v2['price'];
                    }
                }
            }

            $data[$k]['services']['increment_money'] = number_format($data[$k]['services']['increment_money'], 2);
            #增值服务=======================================end

            #潜在费用=======================================start
            $data[$k]['services']['potential_money'] = 0;#到时候要循环获取金额（待改）

            if ($goods['shop_id']==0) {
                $services_ids = Db::table('cost_service')->where(['pid'=>3,'company_id'=>0])->get();
                $services_ids = objtoarr($services_ids);
                $service_ids_arr = '';
                foreach ($services_ids as $sk=>$sv) {
                    $service_ids_arr .= $sv['id'].',';
                }

                $data[$k]['services']['potential'] = Db::table('goods_services')->whereRaw('company_id=0 and find_in_set(service_id,"'.rtrim($service_ids_arr, ',').'")')->get();
                $data[$k]['services']['potential'] = objtoarr($data[$k]['services']['potential']);
                foreach ($data[$k]['services']['potential'] as $k2=>$v2) {
                    $data[$k]['services']['potential'][$k2]['currency'] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$v2['currency']])->first()->currency_symbol_standard;
                    if ($v2['is_select']==1) {
                        $data[$k]['services']['potential_money'] += $v2['price'];
                    }
                }
            } else {
                #商户企业id

                if (empty($goods['potential_content'])) {
                    $data[$k]['services']['potential'] = [];
                } else {
                    if (!empty($goods['potential_content'])) {
                        #1、潜在收费判断
                        $potential_content = json_decode($goods['potential_content'], true);

                        foreach ($potential_content['name'] as $k3 => $v3) {
                            $data[$k]['services']['potential'][] = [
                                'name' => $v3,
                                'desc' => $potential_content['desc'][$k3],
                                'currency' => Db::connection('shop_db')->table('centralize_currency')->where(['id' => $potential_content['currency'][$k3]])->first()->currency_symbol_standard,
                                'price' => number_format($potential_content['price'][$k3], 2)
                            ];
                            $data[$k]['services']['potential_money'] += $potential_content['price'][$k3];
                        }
                    }
                }
            }

            $data[$k]['services']['potential_money'] = number_format($data[$k]['services']['potential_money'], 2);
            #潜在费用=======================================end

            #当前购物车id的商品（规格）总价（商品（规格）单价+各服务费用）
            $data[$k]['total_price'] = number_format($goods_price+$data[$k]['services']['additional_money']+$data[$k]['services']['increment_money']+$data[$k]['services']['potential_money'], 2);

            #所有购物清单的最终价格
            $final['final_price'] += $goods_price+$data[$k]['services']['additional_money']+$data[$k]['services']['increment_money']+$data[$k]['services']['potential_money'];

            if ($cart_id==$v['cart_id']) {
                #避免下一个购物清单刷新
                if ($goods_sumprice==0) {
                    #商品总价
                    $goods_sumprice = number_format($goods_price+$data[$k]['services']['additional_money']+$data[$k]['services']['increment_money']+$data[$k]['services']['potential_money'], 2);
                    #增值服务总价
                    $services_sumprice = $data[$k]['services']['increment_money'];
                }
            }
        }

        #所有购物清单的最终价格
        $final['final_price'] = number_format($final['final_price'] + $final['freight_price'], 2);
        return Response()->json(['code'=>0,'data'=>['final'=>$final,'goods_sumprice'=>$goods_sumprice,'services_sumprice'=>$services_sumprice,'services_price'=>number_format($services_price, 2)]]);
    }
    public function calc_services2(Request $request)
    {
        $data = $request->except(['_token']);
        $id = intval($data['id']);
        $num = isset($data['num']) ? $data['num'] : 0;
        $val = isset($data['val']) ? $data['val'] : 0;
        $price = FloatVal($data['price']);

        $services = Db::table('goods_services')->where(['id'=>$id])->first();
        $services = objtoarr($services);

        if ($services['type']==1) {
            #照片服务/价格递增
            if ($num>1) {
                if ($num>=$services['num']) {
                    $services['price'] = $services['price'] + (($num - $services['num']) * $services['interval_price']);
                }
            }
        } else {
            #其他服务
            if ($val==0) {
                $services['price'] += $price;
            } elseif ($val==1) {
                $services['price'] = $price - $services['price'];
            }
        }

        return Response()->json(['code'=>0,'data'=>$services]);
    }
    //自定义请求方法-end

    /**
     * 商品描述
     *
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     */
    public function desc(Request $request)
    {
        $sku_id = $request->get('sku_id');

        $goods_id = GoodsSku::where('sku_id', $sku_id)->value('goods_id');
        $goods_info = $this->goods->getById($goods_id);

        $mobile_desc_render = null;
        $pc_desc_render = null;

//        if (is_mobile()) {
//            $mobile_desc = $goods_info->mobile_desc;
//            $mobile_desc_render = view('goods.mobile_desc', compact('mobile_desc'))->render();
//        } else {
//            $pc_desc = $goods_info->pc_desc;
//            $pc_desc_render = view('goods.pc_desc', compact('pc_desc'))->render();
//        }
        // 手机端图文
//        $mobile_desc = $goods_info->mobile_desc;
        $mobile_desc = $goods_info->pc_desc;

        // PC端图文
//        $pc_desc = json_encode($goods_info->pc_desc,true);
        $pc_desc = $goods_info->pc_desc;

        //改描述框
//        $pc_desc_render = view('goods.pc_desc', compact('pc_desc'))->render();
        $pc_desc_render = $pc_desc;

        if (is_mobile() && !is_app()) {
            // 微信端访问
            if (empty($mobile_desc)) { // 如果手机端图文为空 则使用PC端图文
                $desc_type = 0;
            } else {
                $desc_type = 1;
                foreach ($mobile_desc as $key=>$item) {
                    if ($mobile_desc[$key]['type'] == 1) {
                        $mobile_desc[$key]['content'] = get_image_url($item['content']);
                    }
                }
                $pc_desc_render = null;
            }
        } else {
            // PC端访问
            $desc_type = 0;
            $mobile_desc = null;
        }

        $extra = [
            'desc_type' => $desc_type,
            'mobile_desc' => $mobile_desc,
            'need_load' => 0,
            'pc_desc' => $pc_desc_render
        ];
        return result(0, null, '', $extra);
    }


    /**
     * 生成二维码
     * @param Request $request
     * @return mixed
     */
    public function qrCode(Request $request)
    {
        $id = $request->get('id', 0);
        return $this->goods->generateGoodsQrCode($id);
    }

    /**
     * 商品详情 选择规格
     * ajax加载sku相关信息
     *
     * @param Request $request
     * @return mixed
     */
    public function sku(Request $request)
    {
        $sku_id = $request->get('sku_id');
        $attr_id = ltrim($request->get('attr_id'), '|');
        $goods_id = $this->goods->getGoodsId($sku_id);
        $goods_info = $this->goods->getById($goods_id)->toArray();
        $shop_info = [];
        
        // if ($goods_info['shop_id']>0) {
            // 店铺信息
//            $shop_info = Shop::where('shop_id',$goods_info['shop_id'])->first()->toArray();
//            $shop_info['opening_hour'] = unserialize($shop_info['opening_hour']);
        // }
        
        // 默认sku
//        $default_sku = GoodsSku::where('sku_id',$sku_id)->first()->toArray();
        if ($goods_info['shop_id']>0) {
            $attr_id = implode('|', array_reverse(explode('|', $attr_id)));
            $default_sku = GoodsSku::where([['goods_id',$goods_id],['spec_vids',$attr_id]])->first()->toArray();
        } else {
            $attr_id = implode('|', array_reverse(explode('|', $attr_id)));
            $default_sku = GoodsSku::where([['goods_id', $goods_id], ['spec_vids', $attr_id]])->first();
            $default_sku = objtoarr($default_sku);

            if (empty($default_sku)) {
                $attr_id = implode('|', array_reverse(explode('|', $attr_id)));
                $default_sku = GoodsSku::where([['goods_id', $goods_id], ['spec_vids', $attr_id]])->first();
                $default_sku = objtoarr($default_sku);
            }
        }
        if (empty($default_sku)) {
            return response()->json(['code'=>-1,'msg'=>'暂无此规格报价，请选择其他规格']);
        }
        $sku_id = $default_sku['sku_id'];
        $spec_ids = explode('|', $default_sku['spec_ids']);
        $selected_spec_names = $default_sku['spec_names'];
        $selected_spec_id = explode('|', $default_sku['spec_vids'])[0];
        
        //这里是根据规格来更换图片
//        $selected_spec_id = Db::table('goods_spec')->where([['goods_id',$goods_id],['attr_vid',$selected_spec_id]])->first()->spec_id;
//        $goods_images = $this->goods->getGoodsImages($goods_id, $selected_spec_id);
//
//        // 商品图片相册
//        $goods_images = array_column($goods_images->toArray(), 'path');
        $goods_images_list = [];
//        foreach ($goods_images as $image) {
//            $goods_images_list[] = [
//                get_image_url($image).'?x-oss-process=image\/resize,m_pad,limit_0,h_80,w_80',
//                get_image_url($image).'?x-oss-process=image\/resize,m_pad,limit_0,h_450,w_450',
//                get_image_url($image)
//            ];
//        }

        $sku_image = '';
        if ($goods_info['shop_id']>0) {
//            $sku_image = $goods_images[0];
            $sku_image = [];
        }
        $sku_images = $goods_images_list;

        #===========================规格名称start
        $spec_attr_value = [];
        $ik = 0;
        $selected_spec_names = explode(' ', $selected_spec_names);
        $new_spec_names = [];
        foreach ($selected_spec_names as $key => $item) {
            if (count(explode(':', $item))==1) {
                $new_spec_names[$key-1] = $selected_spec_names[$ik-1].' '.$item;
            } else {
                array_push($new_spec_names, $item);
                $ik +=1;
            }
        }
        foreach ($new_spec_names as $item) {
            if (isset(explode(':', $item)[1])) {
                $spec_attr_value[] = explode(':', $item)[1];
            }
        }
        $spec_attr_value2 = implode(' ', $spec_attr_value);
//        $spec_attr_value = $spec_attr_value;
        $sku_name = $goods_info['goods_name'].' '.$spec_attr_value2;
        #===========================规格名称end

        #商品规格区间
        $sku_prices = json_decode($default_sku['sku_prices'], true);
        foreach ($sku_prices['unit'] as $k=>$v) {
            $sku_prices['unit'][$k] = Db::connection('shop_db')->table('unit')->where('code_value', $v)->first()->code_name;
            $sku_prices['currency'][$k] = Db::connection('shop_db')->table('centralize_currency')->where('id', $sku_prices['currency'][$k])->first()->currency_symbol_standard;
        }

        $low_price = $sku_prices['price'][0];
        foreach ($sku_prices['price'] as $k=>$v) {
            $sku_prices['price'][$k] = number_format($v, 2);
            if ($low_price>$v) {
                $low_price = $v;
            }
        }
        
        if ($goods_info['shop_id']>0) {
            try{
                $low_price = [$sku_prices['currency'][0],number_format($sku_prices['price'][0], 2)];
            }catch (\Exception $e){
                $low_price = [$sku_prices['currency'][0],$sku_prices['price'][0]];
            }
        } else {
            $low_price = [$sku_prices['currency'][0],number_format($low_price, 2)];
        }

        $data = [
            'act_id' => "0",
            'activity' => null,
            'button_content' => isset($shop_info['button_content']) ? $shop_info['button_content'] : '', // 购买按钮显示内容
            'button_url' => null,
            'buy_enable' => ['code'=>1],
            'freight_id' => $goods_info['freight_id'],
            'gift_list' => [],
            'sku_prices' => $sku_prices,
            'goods_audit' => $goods_info['goods_audit'],
            'goods_id' => $goods_info['goods_id'],
            'goods_image' => $goods_info['goods_image'],
            'goods_mix' => [],
            'goods_moq' => $goods_info['goods_moq'],
            'goods_number' => $default_sku['goods_number'],
            'goods_price' => number_format($default_sku['goods_price'], 2),
            'goods_price_format' => "￥".number_format($default_sku['goods_price'], 2),
            'goods_status' => $goods_info['goods_status'],
            'is_enable' => 1,
            'is_supply' => isset($shop_info['is_supply']) ? $shop_info['is_supply'] : '',
            'market_price' => number_format($default_sku['market_price'], 2),
            'market_price_format' => "￥".number_format($default_sku['market_price'], 2),
            'order_act_id' => "0",
            'order_activity' => null,
            'original_number' => 2, // 商品表添加字段
            'original_price' => "1.00", // 商品表添加字段
            'original_price_format' => "￥1.00",
            'price_show' => ['code'=>1],
            'purchase_num' => 0,
            'rank_prices' => null,
            'sales_model' => $goods_info['sales_model'],
            'shop_id' => $goods_info['shop_id'],
            'show_content' => isset($shop_info['show_content']) ? $shop_info['show_content'] : '', // 店铺价格显示内容
            'show_price' => isset($shop_info['show_price']) ? $shop_info['show_price'] : '', // 店铺价格是否显示
            'sku_id' => $sku_id,
            'sku_image' => $sku_image,
            'sku_images' => $sku_images,
            'sku_name' => $sku_name,
            'spec_attr_value' => $spec_attr_value,
            'spec_ids' => $spec_ids,
            'start_price' => isset($shop_info['start_price']) ? $shop_info['start_price'] : '', // 起送金额
            'unit_name' => $goods_info['goods_unit'], // 商品单位id
            'user_discount' => "0",
            'low_price' => $low_price
        ];
        
        //获取商品可售库存
        if($data['shop_id']>0){
            $post = [
                'goods_id' => $data['goods_id'],
                'sku_id'   => $data['sku_id'],
                'shop_id'  => $data['shop_id'],
                'wid'      => $goods_info['wid'],
                'goods_type'=>$goods_info['goods_type']
            ];
            
            $skunum = httpRequest('https://shop.gogo198.cn/collect_website/public/?s=api/func/get_goods_num', $post);
            
            #商品&规格可售库存
            $data['sku_prices']['goods_number'] = $skunum;
            $data['goods_number'] = $skunum;
        }

        return result(0, $data);
    }

    #有商户id的计算价格区间
    public function calc_price_interval(Request $request)
    {
        $data = $request->except(['_token']);

        $sku_id = intval($data['sku_id']);
        $num = intval($data['num']);

//        $goods_id = $this->goods->getGoodsId($sku_id);
//        $goods_info = $this->goods->getById($goods_id)->toArray();

        $sku = Db::table('goods_sku')->where(['sku_id'=>$sku_id])->first();
        $sku = objtoarr($sku);
        $sku['sku_prices'] = json_decode($sku['sku_prices'], true);

        $price = 0;
        foreach ($sku['sku_prices']['start_num'] as $k=>$v) {
            if ($sku['sku_prices']['select_end'][$k]==1) {
                #数值
                if ($num>=$v and $num<=$sku['sku_prices']['end_num'][$k]) {
                    $price = $sku['sku_prices']['price'][$k];
                    break;
                }
            } elseif ($sku['sku_prices']['select_end'][$k]==2) {
                #以上
                if ($num>=$v) {
                    $price = $sku['sku_prices']['price'][$k];
                    break;
                }
            }
        }

        return response()->json(['code'=>0,'price'=>number_format($price, 2)]);
    }

    /**
     * 修改配送至
     *
     * @param Request $request
     * @return array
     */
    public function changeLocation(Request $request)
    {
        $sku_id = $request->get('sku_id');
        $region_code = $request->get('region_code');
//        session('LRW_LAST_REGION_CODE', null);
        // 设置最近的地区code
        // SZY_LAST_REGION_CODE=82abf20d4117457546a12fd94ca5abbbc1aac3df8674d78f6dd78d7e9efcdccea:2:{i:0;s:20:"SZY_LAST_REGION_CODE";i:1;s:8:"21,08,82";};
        $lrw_last_region_code = session('LRW_LAST_REGION_CODE');
//        dd($region_code);
        if (empty($lrw_last_region_code) || !empty($region_code)) {
//            session('LRW_LAST_REGION_CODE',strtolower(Str::random(64)).serialize(['LRW_LAST_REGION_CODE',$region_code]));
            session(['LRW_LAST_REGION_CODE'=>strtolower(Str::random(64)).serialize(['LRW_LAST_REGION_CODE',$region_code])]);
        }
//        dd($lrw_last_region_code);

        $sku_info = $this->goodsSku->getById($sku_id);
//        dd($sku_info,$sku_id,$region_code,$lrw_last_region_code);
        $data = [
            'freight_fee' => 0,
            'freight_info' => '包邮',
            'limit_sale' => 0,
            'goods_number' => isset($sku_info->goods_number) ? $sku_info->goods_number : 0
        ];
        return result(0, $data);
    }

    public function comment(Request $request)
    {
        $sku_id = $request->get('sku_id');
        $output = $request->get('output');

        // 获取数据
        $goods_id = $this->goods->getGoodsId($sku_id);

        $page_output = $output ? true : false;

        // 查询条件
        $where[] = ['is_show', 1]; // 是否显示初次评价
        $where[] = ['add_is_show', 1]; // 是否显示追加评价
        $where[] = ['is_delete', 0];
        $where[] = ['goods_id', $goods_id];
        $condition = [
            'where' => $where,
            'limit' => 0,
            'sortname' => 'comment_id',
            'sortorder' => 'desc',
        ];
        list($list, $total) = $this->goodsComment->getList($condition);

        $desc_mark_avg = rand(3, 5); // 宝贝与描述相符 平均得分
        $service_avg = rand(3, 5); // 宝贝与描述相符 平均得分
        $delivery_avg = rand(3, 5); // 宝贝与描述相符 平均得分
        $comment_counts = [
            '1', // 全部评价
            '1', // 图片
            '0', // 好评
            '0', // 中评
            '0' // 差评
        ];

        // 分页
        $pageHtml = frontend_pagination($total);
        $page_array = frontend_pagination($total, true);
        $page_json = json_encode($page_array);

        $compact = compact(
            'page_output',
            'pageHtml',
            'list',
            'page_json',
            'sku_id',
            'goods_id',
            'desc_mark_avg',
            'comment_counts',
            'service_avg',
            'delivery_avg'
        );

        if (empty($page_output) && !is_app()) { // web端访问 ajax请求
            $render = view('goods.partials._comment_list', $compact)->render();
            return result(0, $render);
        }

        if (!is_app() && $page_output) { // web端访问
            //修改bug(已处理，路径在resources/views/下...)
            $render = view('goods.comment', $compact)->render();
//            $view_path = app_path('Modules'.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR.'Resources'.DIRECTORY_SEPARATOR.'Views');
            return result(0, $render);
//            return result(0, '');
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'page_output' => $page_output,
                'page' => $page_array,
                'list' => $list,
                'sku_id' => $sku_id,
                'goods_id' => $goods_id,
                'desc_mark_avg' => $desc_mark_avg,
                'service_avg' => $service_avg,
                'delivery_avg' => $delivery_avg,
                'comment_counts' => $comment_counts
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'goods.comment'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 自提点详情
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pickupInfo(Request $request)
    {
        $id = $request->get('id');
        if (empty($id)) {
            abort(200, '自提点不存在');
        }
        $info = $this->selfPickup->getById($id);
        if (empty($info)) {
            abort(200, '自提点不存在');
        }
        $seo_title = $info->pickup_name.' - '.sysconf('site_name');

        return view('goods.pickup_info', compact('info', 'seo_title'));
    }

    /**
     * 搜索自提点
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function searchPickup(Request $request)
    {
        $keyword = $request->post('keyword', '');
        $shop_id = $request->post('shop_id', 0);
        // 自提点
        if (!empty($keyword)) {
            $where[] = ['pickup_name', 'like', "%{$keyword}%"];
        }
        $where[] = ['is_show', 1];
        $where[] = ['shop_id', $shop_id];
        $condition = [
            'where' => $where,
            'limit' => 0,
            'sortname' => 'pickup_id',
            'sortorder' => 'asc',
        ];
        list($self_pickup_list, $self_pickup_total) = $this->selfPickup->getList($condition);
        $render = view('goods.partials._self_pickup_list', compact('self_pickup_list'))->render();

        return result(0, $render);
    }

    /**
     * 商品分享
     * 微商城用到
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function goodsShare(Request $request)
    {
        $goods_id = $request->get('goods_id');
        $qrcode_type = $request->get('qrcode_type');
        $mode = $request->get('mode');
        $read_cache = $request->get('read_cache');
        $uuid = make_uuid();

        $goods = $this->goods->getById($goods_id);
        $goods_qrcode = $this->goods->generateGoodsQrCode($goods_id);

        $render = view('goods.goods_share', compact('goods', 'uuid', 'goods_qrcode'))->render();

        return result(0, $render, '', ['uuid'=> $uuid]);
    }
    
    // 创建圆角图片函数
    private function create_rounded_image($image, $radius) {
        $width = imagesx($image);
        $height = imagesy($image);
        
        // 创建新图像
        $rounded = imagecreatetruecolor($width, $height);
        imagealphablending($rounded, false);
        $transparent = imagecolorallocatealpha($rounded, 0, 0, 0, 127);
        imagefill($rounded, 0, 0, $transparent);
        imagesavealpha($rounded, true);
        
        // 创建圆角遮罩
        $mask = imagecreatetruecolor($width, $height);
        $black = imagecolorallocate($mask, 0, 0, 0);
        $white = imagecolorallocate($mask, 255, 255, 255);
        imagefill($mask, 0, 0, $black);
        
        // 绘制圆角矩形
        imagefilledrectangle($mask, $radius, 0, $width - $radius - 1, $height - 1, $white);
        imagefilledrectangle($mask, 0, $radius, $width - 1, $height - $radius - 1, $white);
        imagefilledellipse($mask, $radius, $radius, $radius * 2, $radius * 2, $white);
        imagefilledellipse($mask, $width - $radius - 1, $radius, $radius * 2, $radius * 2, $white);
        imagefilledellipse($mask, $radius, $height - $radius - 1, $radius * 2, $radius * 2, $white);
        imagefilledellipse($mask, $width - $radius - 1, $height - $radius - 1, $radius * 2, $radius * 2, $white);
        
        // 应用遮罩
        for($x = 0; $x < $width; $x++) {
            for($y = 0; $y < $height; $y++) {
                $mask_pixel = imagecolorat($mask, $x, $y);
                if($mask_pixel == 0) { // 如果是黑色（遮罩外部）
                    imagesetpixel($rounded, $x, $y, $transparent);
                } else {
                    $source_pixel = imagecolorat($image, $x, $y);
                    imagesetpixel($rounded, $x, $y, $source_pixel);
                }
            }
        }
        
        imagedestroy($mask);
        return $rounded;
    }
    
    // 添加圆形图片创建函数
    private function create_circular_image($image, $radius) {
        $diameter = $radius * 2;
        
        // 创建新图像
        $circular = imagecreatetruecolor($diameter, $diameter);
        imagealphablending($circular, false);
        $transparent = imagecolorallocatealpha($circular, 0, 0, 0, 127);
        imagefill($circular, 0, 0, $transparent);
        imagesavealpha($circular, true);
        
        // 创建圆形遮罩
        $mask = imagecreatetruecolor($diameter, $diameter);
        $black = imagecolorallocate($mask, 0, 0, 0);
        $white = imagecolorallocate($mask, 255, 255, 255);
        imagefill($mask, 0, 0, $black);
        
        // 绘制圆形
        imagefilledellipse($mask, $radius, $radius, $diameter, $diameter, $white);
        
        // 调整原图尺寸以匹配圆形
        $resized_image = imagecreatetruecolor($diameter, $diameter);
        imagecopyresampled($resized_image, $image, 0, 0, 0, 0, $diameter, $diameter, imagesx($image), imagesy($image));
        
        // 应用圆形遮罩
        for($x = 0; $x < $diameter; $x++) {
            for($y = 0; $y < $diameter; $y++) {
                $mask_pixel = imagecolorat($mask, $x, $y);
                if($mask_pixel == 0) { // 如果是黑色（遮罩外部）
                    imagesetpixel($circular, $x, $y, $transparent);
                } else {
                    $source_pixel = imagecolorat($resized_image, $x, $y);
                    imagesetpixel($circular, $x, $y, $source_pixel);
                }
            }
        }
        
        imagedestroy($mask);
        imagedestroy($resized_image);
        return $circular;
    }
    
    #获取商品小程序码
    public function get_miniprogram(Request $request){
        $data = $request->except(['_token']);
        $time = time();
        $goods_id = intval($data['goods_id']);
        $method = isset($data['method'])?intval($data['method']):0;
        $share_uid = isset($data['share_uid'])?intval($data['share_uid']):0;
        $campaign_id = isset($data['campaign_id'])?intval($data['campaign_id']):0;
        
        if($method==2){
            //转发链接
            
            //任务操作日志
            task_campaign(['share_uid'=>$share_uid,'goods_id'=>$goods_id,'campaign_id'=>$campaign_id,'campaign_type'=>3]);
        }elseif($method==0){
            //分享海报图
            
            //任务操作日志
            task_campaign(['share_uid'=>$share_uid,'goods_id'=>$goods_id,'campaign_id'=>$campaign_id,'campaign_type'=>3]);
        }
        
        
        #1、获取商品名称、商品主图、币种和最低价
        $goods = Db::table('goods')->where(['goods_id'=>$goods_id])->select('goods_image','goods_name','goods_currency','shop_id')->first();
        $goods_currency = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$goods->goods_currency])->select('currency_symbol_standard')->first();
        $goods_sku = Db::table('goods_sku')->where(['goods_id'=>$goods_id])->get();
        $low_price = 0;// 最低价
        foreach($goods_sku as $k=>$v){
            $goods_sku[$k]->sku_prices = json_decode($v->sku_prices,true);
            foreach($goods_sku[$k]->sku_prices['price'] as $k2=>$v2){
                if(empty($low_price)){
                    $low_price = $v2;
                }else{
                    if($low_price>$v2){
                        $low_price = $v2;
                    }    
                }
            }
        }
        $true_low_price = $goods_currency->currency_symbol_standard.' '.$low_price;//最低价和币种
        
        #2、获取店铺logo和名称
        $shop_name = 'Gogo淘中国';
        $shop_logo = 'https://shop.gogo198.cn/collect_website/public/uploads/centralize/website_index/679357cc06e93.png';
        if($goods->shop_id>0){
            $shop_name = Db::connection('shop_db')->table('website_user_company')->where(['id'=>$goods->shop_id])->select('company')->first()->company;
            $shop_logo2 = Db::connection('shop_db')->table('website_basic')->where(['company_id'=>$goods->shop_id,'company_type'=>0])->select('logo')->first();
            if(!empty($shop_logo2)){
                $shop_logo = 'https://dtc.gogo198.net'.$shop_logo2->logo;
            }
        }
        
        #3、随机颜色
        $color = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['pid'=>12])->inRandomOrder()->select('param1','param2','param3')->first();
        
        #4、开始制作海报图
        header("Content-type: text/html; charset=utf-8");
        
        #4.1、 创建图像
        $height = 1700; //图像高度
        $width = 1000; //图像宽度
        $im = imagecreatetruecolor($width,$height); //创建一个真彩色的图像
        
        $random_color = imagecolorallocate($im, $color->param1, $color->param2, $color->param3);
        $font_color1 = imagecolorallocate($im, 255, 255, 255);//白
        $font_color2 = imagecolorallocate($im, 206, 0, 2);//红
        $font_color3 = imagecolorallocate($im, 0, 0, 0);//黑
        $font_color4 = imagecolorallocate($im, 106, 106, 106);//灰
        $font_color5 = imagecolorallocate($im, 71, 1, 2);//红
        $shadow_color = imagecolorallocatealpha($im, 0, 0, 0, 60); // 阴影颜色（半透明黑）
        
        //保存海报图路径
        $path = $_SERVER['DOCUMENT_ROOT'].'/images/goods_share/';
        if(!file_exists($path)) {
            mkdir($path,0777,true);
        }
        
        // 保存路径
        $savePath = $path.'goods_'.$goods_id.'_'.session('user.gogo_id').'.png';
        // 准备字体
        $font = $_SERVER['DOCUMENT_ROOT'].'/fonts/msyh.ttf';
        
        #4.2、将背景设置为白色
        imagefill($im, 0, 0, $random_color);
    
        #4.3、商品图片准备
        if(strpos($goods->goods_image,'https:') === false){
            $goods->goods_image = 'https:'.$goods->goods_image;
        }
        $goods_image = getimagesize($goods->goods_image);
        //判断png或jpg
        $judge_format = explode('.',$goods->goods_image)[3];
        $true_goods_image = '';
        if($judge_format=='jpg' || $judge_format=='jpeg'){
            $true_goods_image = imagecreatefromjpeg($goods->goods_image);
        }elseif($judge_format=='png'){
            $true_goods_image = imagecreatefrompng($goods->goods_image);
        }
        // 创建圆角商品图片
        // $rounded_goods_image = $this->create_rounded_image($true_goods_image, 15);
        // // 添加白色阴影效果
        // $shadow_offset = 3; // 白色阴影偏移量
        // for($i = 1; $i <= $shadow_offset; $i++) {
        //     // 绘制四个方向的白色边框来模拟阴影
        //     imagecopyresampled($im, $rounded_goods_image, 
        //         65 - $i, 65, 0, 0, 
        //         855, 855, 
        //         $goods_image[0], $goods_image[1]); // 左
            
        //     imagecopyresampled($im, $rounded_goods_image, 
        //         65 + $i, 65, 0, 0, 
        //         855, 855, 
        //         $goods_image[0], $goods_image[1]); // 右
            
        //     imagecopyresampled($im, $rounded_goods_image, 
        //         65, 65 - $i, 0, 0, 
        //         855, 855, 
        //         $goods_image[0], $goods_image[1]); // 上
            
        //     imagecopyresampled($im, $rounded_goods_image, 
        //         65, 65 + $i, 0, 0, 
        //         855, 855, 
        //         $goods_image[0], $goods_image[1]); // 下
        // }
        //组合商品图片到画布
        imagecopyresampled($im, $true_goods_image, 70, 70, 0, 0, 860, 860, $goods_image[0], $goods_image[1]);
        
        #4.4、店铺logo和名称展示位置
        //店铺logo展示
        $logo_image = getimagesize($shop_logo);
        //判断png或jpg
        $judge_format = explode('.',$shop_logo)[3];
        $true_logo_image = '';
        if($judge_format=='jpg' || $judge_format=='jpeg'){
            $true_logo_image = imagecreatefromjpeg($shop_logo);
        }elseif($judge_format=='png'){
            $true_logo_image = imagecreatefrompng($shop_logo);
        }
        imagecopyresampled($im, $true_logo_image, 120, 850, 0, 0, 50, 50, $logo_image[0], $logo_image[1]);
        imagettftext($im, 20, 0, 190, 885, $font_color3, $font, $shop_name);

        
        #4.5、商品名称位置
        // 将字符串分割为单个字符数组，然后每19个一组
        $characters = mb_str_split($goods->goods_name, 1, 'UTF-8');
        $result = array_chunk($characters, 19);
        // 将每组字符重新组合成字符串
        $result = array_map(function($chunk) {
            return implode('', $chunk);
        }, $result);
        if(count($result)==1){
            //商品名称只有一行
            imagettftext($im, 30, 0, 120+1, 1040, $font_color1, $font, $result[0]);   // 右
            imagettftext($im, 30, 0, 120-1, 1040, $font_color1, $font, $result[0]);   // 左
            imagettftext($im, 30, 0, 120, 1040+1, $font_color1, $font, $result[0]);   // 下
            imagettftext($im, 30, 0, 120, 1040-1, $font_color1, $font, $result[0]);   // 上
            imagettftext($im, 30, 0, 120, 1040, $font_color1, $font, $result[0]);     // 中心
        }
        elseif(count($result)==2){
            //商品名称只有一行
            imagettftext($im, 30, 0, 120+1, 1040, $font_color1, $font, $result[0]);   // 右
            imagettftext($im, 30, 0, 120-1, 1040, $font_color1, $font, $result[0]);   // 左
            imagettftext($im, 30, 0, 120, 1040+1, $font_color1, $font, $result[0]);   // 下
            imagettftext($im, 30, 0, 120, 1040-1, $font_color1, $font, $result[0]);   // 上
            imagettftext($im, 30, 0, 120, 1040, $font_color1, $font, $result[0]);     // 中心
            
            imagettftext($im, 30, 0, 120+1, 1100, $font_color1, $font, $result[1]);   // 右
            imagettftext($im, 30, 0, 120-1, 1100, $font_color1, $font, $result[1]);   // 左
            imagettftext($im, 30, 0, 120, 1100+1, $font_color1, $font, $result[1]);   // 下
            imagettftext($im, 30, 0, 120, 1100-1, $font_color1, $font, $result[1]);   // 上
            imagettftext($im, 30, 0, 120, 1100, $font_color1, $font, $result[1]);     // 中心
        }
        elseif(count($result)>=3){
            //商品名称只有三行
            imagettftext($im, 30, 0, 120+1, 1040, $font_color1, $font, $result[0]);   // 右
            imagettftext($im, 30, 0, 120-1, 1040, $font_color1, $font, $result[0]);   // 左
            imagettftext($im, 30, 0, 120, 1040+1, $font_color1, $font, $result[0]);   // 下
            imagettftext($im, 30, 0, 120, 1040-1, $font_color1, $font, $result[0]);   // 上
            imagettftext($im, 30, 0, 120, 1040, $font_color1, $font, $result[0]);     // 中心
            
            imagettftext($im, 30, 0, 120+1, 1100, $font_color1, $font, $result[1] . '...');   // 右
            imagettftext($im, 30, 0, 120-1, 1100, $font_color1, $font, $result[1] . '...');   // 左
            imagettftext($im, 30, 0, 120, 1100+1, $font_color1, $font, $result[1] . '...');   // 下
            imagettftext($im, 30, 0, 120, 1100-1, $font_color1, $font, $result[1] . '...');   // 上
            imagettftext($im, 30, 0, 120, 1100, $font_color1, $font, $result[1] . '...');     // 中心
        }
        
        #4.6、商品分享词
        $characters = mb_str_split($goods->goods_name, 1, 'UTF-8');
        $result2 = array_chunk($characters, 24);
        // 将每组字符重新组合成字符串
        $result2 = array_map(function($chunk) {
            return implode('', $chunk);
        }, $result2);
        if(count($result)==1){
            #商品名称一行
            if(count($result2)==1){
                imagettftext($im, 20, 0, 120, 1140, $font_color1, $font, $result2[0]);
            }
            elseif(count($result2)==2){
                imagettftext($im, 20, 0, 120, 1140, $font_color1, $font, $result2[0]);
                imagettftext($im, 20, 0, 120, 1200, $font_color1, $font, $result2[1]);
            }
            elseif(count($result2)==3){
                imagettftext($im, 20, 0, 120, 1140, $font_color1, $font, $result2[0]);
                imagettftext($im, 20, 0, 120, 1200, $font_color1, $font, $result2[1] . '...');
            }
        }
        elseif(count($result)>=2){
            #商品名称两行
            if(count($result2)==1){
                imagettftext($im, 24, 0, 120, 1200, $font_color1, $font, $result2[0]);
            }
            elseif(count($result2)==2){
                imagettftext($im, 24, 0, 120, 1200, $font_color1, $font, $result2[0]);
                imagettftext($im, 24, 0, 120, 1260, $font_color1, $font, $result2[1]);
            }
            elseif(count($result2)==3){
                imagettftext($im, 24, 0, 120, 1200, $font_color1, $font, $result2[0]);
                imagettftext($im, 24, 0, 120, 1260, $font_color1, $font, $result2[1] . '...');
            }
        }
        
        #4.7、商品价格
        $low_price_num = strlen(explode('.',$low_price)[0]);
        
        if($low_price_num==1){
            //9
            if(count($result)==1){
                imagettftext($im, 30, 0, 690+1, 1200, $font_color1, $font, "|");   // “|” 字符
                imagettftext($im, 30, 0, 690-1, 1200, $font_color1, $font, "|");
                imagettftext($im, 30, 0, 690, 1200+1, $font_color1, $font, "|");
                imagettftext($im, 30, 0, 690, 1200-1, $font_color1, $font, "|");
                imagettftext($im, 30, 0, 690, 1200, $font_color1, $font, "|");
                
                imagettftext($im, 30, 0, 710+1, 1200, $font_color1, $font, $true_low_price);   // 右
                imagettftext($im, 30, 0, 710-1, 1200, $font_color1, $font, $true_low_price);   // 左
                imagettftext($im, 30, 0, 710, 1200+1, $font_color1, $font, $true_low_price);   // 下
                imagettftext($im, 30, 0, 710, 1200-1, $font_color1, $font, $true_low_price);   // 上
                imagettftext($im, 30, 0, 710, 1200, $font_color1, $font, $true_low_price);     // 中心
            }
            elseif(count($result)>=2){
                imagettftext($im, 30, 0, 690+1, 1260, $font_color1, $font, "|");   // “|” 字符
                imagettftext($im, 30, 0, 690-1, 1260, $font_color1, $font, "|");
                imagettftext($im, 30, 0, 690, 1260+1, $font_color1, $font, "|");
                imagettftext($im, 30, 0, 690, 1260-1, $font_color1, $font, "|");
                imagettftext($im, 30, 0, 690, 1260, $font_color1, $font, "|");
                
                imagettftext($im, 30, 0, 710+1, 1260, $font_color1, $font, $true_low_price);   // 右
                imagettftext($im, 30, 0, 710-1, 1260, $font_color1, $font, $true_low_price);   // 左
                imagettftext($im, 30, 0, 710, 1260+1, $font_color1, $font, $true_low_price);   // 下
                imagettftext($im, 30, 0, 710, 1260-1, $font_color1, $font, $true_low_price);   // 上
                imagettftext($im, 30, 0, 710, 1260, $font_color1, $font, $true_low_price);     // 中心
            }
        }
        elseif($low_price_num==2){
            //99
            if(count($result)==1){
                imagettftext($im, 30, 0, 670+1, 1200, $font_color1, $font, "|");   // “|” 字符
                imagettftext($im, 30, 0, 670-1, 1200, $font_color1, $font, "|");
                imagettftext($im, 30, 0, 670, 1200+1, $font_color1, $font, "|");
                imagettftext($im, 30, 0, 670, 1200-1, $font_color1, $font, "|");
                imagettftext($im, 30, 0, 670, 1200, $font_color1, $font, "|");
                
                imagettftext($im, 30, 0, 690+1, 1200, $font_color1, $font, $true_low_price);   // 右
                imagettftext($im, 30, 0, 690-1, 1200, $font_color1, $font, $true_low_price);   // 左
                imagettftext($im, 30, 0, 690, 1200+1, $font_color1, $font, $true_low_price);   // 下
                imagettftext($im, 30, 0, 690, 1200-1, $font_color1, $font, $true_low_price);   // 上
                imagettftext($im, 30, 0, 690, 1200, $font_color1, $font, $true_low_price);     // 中心
            }
            elseif(count($result)>=2){
                imagettftext($im, 30, 0, 670+1, 1260, $font_color1, $font, "|");   // “|” 字符
                imagettftext($im, 30, 0, 670-1, 1260, $font_color1, $font, "|");
                imagettftext($im, 30, 0, 670, 1260+1, $font_color1, $font, "|");
                imagettftext($im, 30, 0, 670, 1260-1, $font_color1, $font, "|");
                imagettftext($im, 30, 0, 670, 1260, $font_color1, $font, "|");
                
                imagettftext($im, 30, 0, 690+1, 1260, $font_color1, $font, $true_low_price);   // 右
                imagettftext($im, 30, 0, 690-1, 1260, $font_color1, $font, $true_low_price);   // 左
                imagettftext($im, 30, 0, 690, 1260+1, $font_color1, $font, $true_low_price);   // 下
                imagettftext($im, 30, 0, 690, 1260-1, $font_color1, $font, $true_low_price);   // 上
                imagettftext($im, 30, 0, 690, 1260, $font_color1, $font, $true_low_price);     // 中心
            }
        }
        elseif($low_price_num==3){
            //999
            if(count($result)==1){
                imagettftext($im, 30, 0, 650+1, 1200, $font_color1, $font, "|");   // “|” 字符
                imagettftext($im, 30, 0, 650-1, 1200, $font_color1, $font, "|");
                imagettftext($im, 30, 0, 650, 1200+1, $font_color1, $font, "|");
                imagettftext($im, 30, 0, 650, 1200-1, $font_color1, $font, "|");
                imagettftext($im, 30, 0, 650, 1200, $font_color1, $font, "|");
                
                imagettftext($im, 30, 0, 670+1, 1200, $font_color1, $font, $true_low_price);   // 右
                imagettftext($im, 30, 0, 670-1, 1200, $font_color1, $font, $true_low_price);   // 左
                imagettftext($im, 30, 0, 670, 1200+1, $font_color1, $font, $true_low_price);   // 下
                imagettftext($im, 30, 0, 670, 1200-1, $font_color1, $font, $true_low_price);   // 上
                imagettftext($im, 30, 0, 670, 1200, $font_color1, $font, $true_low_price);     // 中心
            }
            elseif(count($result)>=2){
                imagettftext($im, 30, 0, 650+1, 1260, $font_color1, $font, "|");   // “|” 字符
                imagettftext($im, 30, 0, 650-1, 1260, $font_color1, $font, "|");
                imagettftext($im, 30, 0, 650, 1260+1, $font_color1, $font, "|");
                imagettftext($im, 30, 0, 650, 1260-1, $font_color1, $font, "|");
                imagettftext($im, 30, 0, 650, 1260, $font_color1, $font, "|");
                
                imagettftext($im, 30, 0, 670+1, 1260, $font_color1, $font, $true_low_price);   // 右
                imagettftext($im, 30, 0, 670-1, 1260, $font_color1, $font, $true_low_price);   // 左
                imagettftext($im, 30, 0, 670, 1260+1, $font_color1, $font, $true_low_price);   // 下
                imagettftext($im, 30, 0, 670, 1260-1, $font_color1, $font, $true_low_price);   // 上
                imagettftext($im, 30, 0, 670, 1260, $font_color1, $font, $true_low_price);     // 中心
            }
        }
        elseif($low_price_num==4){
            //9999
            if(count($result)==1){
                imagettftext($im, 30, 0, 630+1, 1200, $font_color1, $font, "|");   // “|” 字符
                imagettftext($im, 30, 0, 630-1, 1200, $font_color1, $font, "|");
                imagettftext($im, 30, 0, 630, 1200+1, $font_color1, $font, "|");
                imagettftext($im, 30, 0, 630, 1200-1, $font_color1, $font, "|");
                imagettftext($im, 30, 0, 630, 1200, $font_color1, $font, "|");
                
                imagettftext($im, 30, 0, 650+1, 1200, $font_color1, $font, $true_low_price);   // 右
                imagettftext($im, 30, 0, 650-1, 1200, $font_color1, $font, $true_low_price);   // 左
                imagettftext($im, 30, 0, 650, 1200+1, $font_color1, $font, $true_low_price);   // 下
                imagettftext($im, 30, 0, 650, 1200-1, $font_color1, $font, $true_low_price);   // 上
                imagettftext($im, 30, 0, 650, 1200, $font_color1, $font, $true_low_price);     // 中心
            }
            elseif(count($result)>=2){
                imagettftext($im, 30, 0, 630+1, 1260, $font_color1, $font, "|");   // “|” 字符
                imagettftext($im, 30, 0, 630-1, 1260, $font_color1, $font, "|");
                imagettftext($im, 30, 0, 630, 1260+1, $font_color1, $font, "|");
                imagettftext($im, 30, 0, 630, 1260-1, $font_color1, $font, "|");
                imagettftext($im, 30, 0, 630, 1260, $font_color1, $font, "|");
                
                imagettftext($im, 30, 0, 650+1, 1260, $font_color1, $font, $true_low_price);   // 右
                imagettftext($im, 30, 0, 650-1, 1260, $font_color1, $font, $true_low_price);   // 左
                imagettftext($im, 30, 0, 650, 1260+1, $font_color1, $font, $true_low_price);   // 下
                imagettftext($im, 30, 0, 650, 1260-1, $font_color1, $font, $true_low_price);   // 上
                imagettftext($im, 30, 0, 650, 1260, $font_color1, $font, $true_low_price);     // 中心
            }
        }
        elseif($low_price_num>=5){
            //9999
            if(count($result)==1){
                imagettftext($im, 30, 0, 610+1, 1200, $font_color1, $font, "|");   // “|” 字符
                imagettftext($im, 30, 0, 610-1, 1200, $font_color1, $font, "|");
                imagettftext($im, 30, 0, 610, 1200+1, $font_color1, $font, "|");
                imagettftext($im, 30, 0, 610, 1200-1, $font_color1, $font, "|");
                imagettftext($im, 30, 0, 610, 1200, $font_color1, $font, "|");
                
                imagettftext($im, 30, 0, 630+1, 1200, $font_color1, $font, $true_low_price);   // 右
                imagettftext($im, 30, 0, 630-1, 1200, $font_color1, $font, $true_low_price);   // 左
                imagettftext($im, 30, 0, 630, 1200+1, $font_color1, $font, $true_low_price);   // 下
                imagettftext($im, 30, 0, 630, 1200-1, $font_color1, $font, $true_low_price);   // 上
                imagettftext($im, 30, 0, 630, 1200, $font_color1, $font, $true_low_price);     // 中心
            }
            elseif(count($result)>=2){
                imagettftext($im, 30, 0, 610+1, 1260, $font_color1, $font, "|");   // “|” 字符
                imagettftext($im, 30, 0, 610-1, 1260, $font_color1, $font, "|");
                imagettftext($im, 30, 0, 610, 1260+1, $font_color1, $font, "|");
                imagettftext($im, 30, 0, 610, 1260-1, $font_color1, $font, "|");
                imagettftext($im, 30, 0, 610, 1260, $font_color1, $font, "|");
                
                imagettftext($im, 30, 0, 630+1, 1260, $font_color1, $font, $true_low_price);   // 右
                imagettftext($im, 30, 0, 630-1, 1260, $font_color1, $font, $true_low_price);   // 左
                imagettftext($im, 30, 0, 630, 1260+1, $font_color1, $font, $true_low_price);   // 下
                imagettftext($im, 30, 0, 630, 1260-1, $font_color1, $font, $true_low_price);   // 上
                imagettftext($im, 30, 0, 630, 1260, $font_color1, $font, $true_low_price);     // 中心
            }
        }
        
        #4.8、小程序二维码
        $mini_code = $_SERVER['DOCUMENT_ROOT'].'/images/goods_miniprogram/wxmini_to_shop_img_'.$goods_id.'_'.session('user.gogo_id').'.jpg';// 小程序码
        $true_mini_code = 'https://www.gogo198.cn/images/goods_miniprogram/wxmini_to_shop_img_'.$goods_id.'_'.session('user.gogo_id').'.jpg';
        if (!file_exists($mini_code)) {
            // 获取小程序码
            $res = $this->get_miniprogram_code($goods_id,session('user.user_id'));
            if($res['code'] == 0){
                $mini_code = $res['img'];
            }else{
                return Response()->json(['code'=>-1,'msg'=>$res['msg']]);
            }
            sleep(1);
        }
        
        // $true_mini_code = '';
        // $res = $this->get_miniprogram_code($goods_id,base64_encode(session('user.gogo_id')));
        // if($res['code'] == 0){
        //     $true_mini_code = $res['img'];
        // }else{
        //     return Response()->json(['code'=>-1,'msg'=>$res['msg']]);
        // }
        // sleep(2);
        
        $mini_image = getimagesize($true_mini_code);
        //判断png或jpg
        $judge_format = explode('.',$true_mini_code)[3];
        $true_mini_image = '';
        if($judge_format=='jpg' || $judge_format=='jpeg'){
            $true_mini_image = imagecreatefromjpeg($true_mini_code);
        }elseif($judge_format=='png'){
            $true_mini_image = imagecreatefrompng($true_mini_code);
        }
        // 创建圆角商品图片
        $rounded_mini_image = $this->create_rounded_image($true_mini_image, 210);
        imagecopyresampled($im, $rounded_mini_image, 400, 1400, 0, 0, 200, 200, $mini_image[0], $mini_image[1]);
        
        header("cotent-type:image/png"); //输出图像的MIME类型
        imagepng($im,$savePath); //输出一个png图像数据
        
        return Response()->json(['code'=>0,'msg'=>'生成推广图片成功','img'=>'/images/goods_share/goods_'.$goods_id.'_'.session('user.gogo_id').'.png']);
    }
    
    # 获取小程序码
    public function get_miniprogram_code($goods_id,$uid){
        $time = time();
        
        #获取accesstoken
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx6d1af256d76896ba&secret=d19a96d909c1a167c12bb899d0c10da6";
        $res = file_get_contents($url);
        $result = json_decode($res, true);
        
        if(!isset($result['access_token'])){
            $error_msg = isset($result['errmsg']) ? $result['errmsg'] : '未知错误';
            // 确保错误消息是UTF-8编码
            $error_msg = mb_convert_encoding($error_msg, 'UTF-8', 'auto');
            return ['code' => -1, 'msg' => '获取access_token失败: ' . $error_msg];
        }
        
        $access_token = $result['access_token'];
        
        #获取微信小程序码
        $url = "https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token=" . $access_token;
        $datas = array(
            "page" => "pages/agreement/index",
            "scene" => "goods_id=" . $goods_id . "&share_uid=". base64_encode($uid),
            "check_path" => false,
            "env_version" => 'release',//release develop trial体验
            'width' => 430,
        );
        
        // 使用改进的httpRequest函数
        $img = httpRequest_wx($url, json_encode($datas));
        
        // 首先检查是否是JSON错误响应
        if (substr($img, 0, 1) === '{') {
            $error_result = json_decode($img, true);
            if (isset($error_result['errcode'])) {
                $error_msg = isset($error_result['errmsg']) ? $error_result['errmsg'] : '未知错误';
                // 确保错误消息是UTF-8编码
                $error_msg = mb_convert_encoding($error_msg, 'UTF-8', 'auto');
                return ['code' => -1, 'msg' => '微信API错误: ' . $error_msg . ' (错误码: ' . $error_result['errcode'] . ')'];
            }
        }
        
        // 检查返回的是否是有效的图片数据
        if (empty($img) || strlen($img) < 100) {
            return ['code' => -1, 'msg' => '小程序码生成失败，返回数据异常，数据长度: ' . strlen($img)];
        }
        
        // 检查是否是PNG文件（PNG文件以特定字节开头）
        // $png_header = substr($img, 0, 8);
        // $expected_header = "\x89PNG\r\n\x1a\n";
        // if ($png_header !== $expected_header) {
        //     // 使用安全的调试信息，避免非UTF-8字符
        //     $debug_info = '文件头: ' . bin2hex($png_header) . ' (期望: ' . bin2hex($expected_header) . ')';
        //     return ['code' => -1, 'msg' => '生成的内容不是有效的PNG文件。' . $debug_info];
        // }
        
        $savepath = $_SERVER['DOCUMENT_ROOT'] . '/images/goods_miniprogram/wxmini_to_shop_img_'.$goods_id.'_'.session('user.gogo_id').'.jpg';
        
        // 确保目录存在
        $dir = dirname($savepath);
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
        
        // 保存文件
        if (file_put_contents($savepath, $img) === false) {
            return ['code' => -1, 'msg' => '保存小程序码文件失败'];
        }
        
        // 验证保存的文件
        if (!file_exists($savepath) || filesize($savepath) == 0) {
            return ['code' => -1, 'msg' => '小程序码文件保存失败'];
        }
        
        return ['code' => 0, 'img' => 'https://www.gogo198.cn/images/goods_miniprogram/wxmini_to_shop_img_'.$goods_id.'_'.session('user.gogo_id').'.jpg'];
    }
}
