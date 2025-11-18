<?php

namespace App\Modules\Seller\Http\Controllers\Func;

use App\Modules\Base\Http\Controllers\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TradeController extends Seller
{
    public function get_merchant()
    {
        #获取当前商户的企业
        $manage = Db::connection('shop_db')->table('centralize_manage_person')->where(['id'=>Session('seller.mid')])->first();
        return $manage;
    }

    public function book_manage(Request $request)
    {
        $data = $request->except(['_token']);

        if (isset($data['pa'])) {
            $limit = $request->get('limit');
            $page = $request->get('page') - 1;
            if ($page != 0) {
                $page = $limit * $page;
            }
            $keyword = $request->get('keywords') ? $request->get('keywords') : '';

            $manage = $this->get_merchant();

            $where = [];
            $where[] = ['shop_id', session('shop_info')->shop_id];
            $where[] = ['is_delete', 0]; // 查询删除状态为0的商品

            // $count = Db::table('goods')->where($where)->count();
            $count = 0;
            // $rows = DB::table('goods')->where($where)
            //     ->offset($page)
            //     ->limit($limit)
            //     ->orderBy('goods_id', 'desc')
            //     ->get()
            //     ->toArray();

            // $rows = objtoarr($rows);
            $rows = [];

            foreach ($rows as &$item) {
                // $item['status_name'] = $_status[$item['goods_status']];
                // if($item['goods_audit']==0 && $item['goods_status']==1){
                //     $item['status_name'] .= '待审核';
                // }
            }

            return response()->json(['code'=>0,'count'=>$count,'data'=>$rows]);
        } else {
            return view('func.trade.book_manage', compact(''));
        }
    }

    public function order_manage(Request $request)
    {
        $data = $request->except(['_token']);

        if (isset($data['pa'])) {
            $limit = $request->get('limit');
            $page = $request->get('page') - 1;
            if ($page != 0) {
                $page = $limit * $page;
            }
            $keyword = $request->get('keywords') ? $request->get('keywords') : '';

            $manage = $this->get_merchant();

            $where = [];
            $where[] = ['shop_id', session('shop_info')->shop_id];
            $where[] = ['is_delete', 0]; // 查询删除状态为0的商品

            // $count = Db::table('goods')->where($where)->count();
            $count = 0;
            // $rows = DB::table('goods')->where($where)
            //     ->offset($page)
            //     ->limit($limit)
            //     ->orderBy('goods_id', 'desc')
            //     ->get()
            //     ->toArray();

            // $rows = objtoarr($rows);
            $rows = [];

            foreach ($rows as &$item) {
                // $item['status_name'] = $_status[$item['goods_status']];
                // if($item['goods_audit']==0 && $item['goods_status']==1){
                //     $item['status_name'] .= '待审核';
                // }
            }

            return response()->json(['code'=>0,'count'=>$count,'data'=>$rows]);
        } else {
            return view('func.trade.order_manage', compact(''));
        }
    }
}
