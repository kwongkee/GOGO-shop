<?php

namespace App\Modules\Frontend\Http\Controllers;

use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\GoodsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuessController extends Frontend
{
    protected $goods;

    public function __construct()
    {
        parent::__construct();

        $this->goods = new GoodsRepository();
    }

    /**
     * 猜你喜欢
     *
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     */
    public function like(Request $request)
    {
        $page = !empty($request->get('page')) ? $request->get('page') : 1;
        $num = $request->get('num', 6);
        $tpl = $request->get('tpl', '');
        if (empty($tpl)) {
            return result(-1, null, '模板不存在');
        }
        // 猜你喜欢
        list($guess_like_goods, $total) = $this->goods->getGuessLikeGoods($page, $num);


        #修改价格bug=====
        foreach ($guess_like_goods as $k=>&$v) {
            $sku_info = Db::table('goods_sku')->where('sku_id', $v->sku_id)->first();
            $sku_info->sku_prices = json_decode($sku_info->sku_prices, true);
            $low_price = '';
            foreach ($sku_info->sku_prices['price'] as $k2=>$v2) {
                if (empty($low_price)) {
                    $low_price = $v2;
                } else {
                    if ($v2<$low_price) {
                        $low_price = $v2;
                    }
                }
            }
            $v->goods_price = $low_price;
        }

        #修改价格bug=====

        $page_total = ceil($total / $num);
        $user_like_page = $page;
        if ($page_total > $user_like_page) {
            $user_like_page++;
        } else {
            $user_like_page--;
        }

        $render = view('frontend.web.modules.library.'.$tpl, compact('guess_like_goods', 'user_like_page'))->render();
        return result(0, $render, '');
    }
}
