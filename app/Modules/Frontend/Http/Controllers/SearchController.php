<?php

namespace App\Modules\Frontend\Http\Controllers;

use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\GoodsRepository;
use Illuminate\Http\Request;

class SearchController extends Frontend
{
    protected $goods;

    public function __construct()
    {
        parent::__construct();

        $this->goods = new GoodsRepository();
    }

    public function index(Request $request)
    {
        $keyword = $request->get('keyword', '');
        $type = $request->get('type', 0); // 搜索类型 0商品 1店铺
        $display_model = $request->get('style', ''); // 空-大图模式  list-列表模式
        $display_model = $display_model == 'list' ? 1 : 0;
        if ($type == 1) {
            // 搜索店铺
            $tpl = 'search_shop';
            $list = [];
            $pageHtml = '';
        } else {
            // 默认搜索商品
            $tpl = 'search_goods';
            $where[] = ['goods_name', 'like', "%{$keyword}%"];
            $condition = [
                'where' => $where,
                'sortname' => 'goods_id',
                'sortorder' => 'desc'
            ];
            list($list, $total) = $this->goods->getList($condition, '', $this->user_id);
            $pageHtml = frontend_pagination($total);
        }
        $goods_total=$total;

        $search_records = !empty($_COOKIE['search_records']) ? unserialize($_COOKIE['search_records']) : [];

        if (!empty($search_records)) {
            // cookie不为空
            if (!in_array($keyword, $search_records)) {
                array_push($search_records, $keyword);
            }
        } else {
            // 没有cookie 写入
            $search_records = [$keyword];
        }

        // 将搜索词写入cookie
        setcookie('search_records', serialize($search_records), null, '/');

        $seo_title = $keyword.' - '.sysconf('site_name');
        $seo_keywords = $keyword.','.sysconf('site_name');
        $seo_discription = $keyword.','.sysconf('site_name');
        $seo_info = [
            1 => $seo_title,
            2 => $seo_keywords,
            3 => $seo_discription,
        ];

        // 新品推荐
        $new_goods = $this->goods->getNewGoods([], 4);

        // 排行榜-销售量
        $sale_top_list = $this->goods->getTopGoods('sale_num', [], 4);

        // 销量排行榜
//        $sale_rank_goods = $this->goods->getSaleRankGoods([], 4);

        // 浏览历史
        list($goods_history, $goods_history_total) = $this->goods->getGoodsHistory([], 6);

        $this->show_seo($seo_info, ['name' => $keyword]); // SEO

        // 重新设置params
        $params = [
            'filter_attr_vids' => isset($filter_attr_vids) ? $filter_attr_vids : null,
            'filter_attr_ids' => isset($filter_attr_ids) ? $filter_attr_ids : null,
            'filter_brand_ids' => isset($filter_brand_ids) ? $filter_brand_ids : null,
            'filter_goods_prices' => isset($filter_goods_prices) ? $filter_goods_prices : null,
            'cat_id' => isset($cat_id) ? $cat_id : 0,
            'cat_ids' => isset($cat_ids) ? $cat_ids : null,
            'type' => isset($type) ? $type : 0,
            'go' => isset($go) ? $go : 1,
            'brand_id' => isset($brand_id) ? $brand_id : 0,
            'filter_attr' => isset($filter_attr) ? $filter_attr : 0, // '1801-1784-1825-1738-1773'
            'price_min' => isset($price_min) ? $price_min : 0, // '1'
            'price_max' => isset($price_max) ? $price_max : 0, // '300'
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

        $compact = compact('keyword', 'display_model', 'list', 'pageHtml', 'total', 'goods_total', 'new_goods', 'sale_top_list', 'goods_history', 'params');

//        $goods_list = objtoarr($goods_list);
//        dd($display_model);
        return view('search.'.$tpl, $compact);
    }

    /**
     * 删除关键词搜索记录
     *
     * @param Request $request
     * @return array
     */
    public function deleteRecord(Request $request)
    {
        $key = $request->input('data', 0);
        $search_records = !empty($_COOKIE['search_records']) ? unserialize($_COOKIE['search_records']) : [];
        unset($search_records[$key]); // 删除cookie中的第几个
        // 将搜索词写入cookie
        setcookie('search_records', serialize(array_values($search_records)), null, '/');
        return result(0);
    }
}
