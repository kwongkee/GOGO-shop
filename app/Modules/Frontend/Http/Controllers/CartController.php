<?php

namespace App\Modules\Frontend\Http\Controllers;

use App\Models\Cart;
use App\Models\GoodsSku;
use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\CartRepository;
use App\Repositories\GoodsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Frontend
{
    protected $goods; // 商品模型

    protected $cart;


    public function __construct()
    {
        parent::__construct();

        $this->goods = new GoodsRepository();
        $this->cart = new CartRepository();
    }

    /**
     * 选购/订购/已关闭/清单列表
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cartList(Request $request)
    {
//        $this->getCartListData();
        $dat = $request->except(['_token']);
        $isframe = isset($dat['isframe']) ? intval($dat['isframe']) : 0;
        $selected = isset($dat['selected']) ? intval($dat['selected']) : 0;

        #自动登录
        $mid = isset($dat['mid']) ? base64_decode($dat['mid']) : 0;
        if ($mid>0) {
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
        }

        $user = session('user');

        $cart_num = 0;#已选购数量
        $cart_delnum = 0;#购物车删除数量
        $cart_buynum = 0;#已订购数量
        $cart_closenum = 0;#已关闭数量
        $cart = [];
        $cart_buylist = [];
        $cart_closelist = [];
        $default_address = '';
        $address_id = 0;
        if (!empty($user)) {
            $user = Db::connection('shop_db')->table('website_user')->where(['custom_id'=>$user['gogo_id']])->first();
            #选购清单=================================================
            #收货地址--start
            $address = Db::connection('shop_db')->table('centralize_user_address')->where(['user_id'=>$user->id,'is_default'=>1])->first();
            $address = objtoarr($address);
            $address_id = $address['id'];
            if (!empty($address)) {
                $default_address = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['id'=>$address['country_id']])->first()->param2;

                if (!empty($address['province'])) {
                    $province = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$address['province']])->first()->code_name;
                    $default_address .= ' '.$province;

                    if (!empty($address['city'])) {
                        $city = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$address['city']])->first()->code_name;
                        $default_address .= ' '.$city;
                    }

                    if (!empty($address['area'])) {
                        $area = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$address['area']])->first()->code_name;
                        $default_address .= ' '.$area;
                    }

                    if (!empty($address['area2'])) {
                        $area2 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id' => $address['area2']])->first()->code_name;
                        $default_address .= ' ' . $area2;
                    }


                    if (!empty($address['area3'])) {
                        $area3 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id' => $address['area3']])->first()->code_name;
                        $default_address .= ' ' . $area3;
                    }


                    if (!empty($address['area4'])) {
                        $area4 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id' => $address['area4']])->first()->code_name;
                        $default_address .= ' ' . $area4;
                    }
                }

                $default_address .= $address['address1'];
            }
            #收货地址--end

            //获取选购清单数据
            $shop_cart_list = Db::table('cart')->where(['user_id'=>$user->id,'is_buy'=>0,'is_show'=>0])->orderBy('cart_id', 'desc')->get();
            $shop_cart_list = objtoarr($shop_cart_list);
            $shop_ids = [];
//             dd($shop_cart_list);
            foreach ($shop_cart_list as $k=>$v) {
                if (!in_array($v['shop_id'], $shop_ids)) {
                    array_push($shop_ids, $v['shop_id']);
                }
                if (!empty($v['file'])) {
                    $shop_cart_list[$k]['file'] = json_decode($v['file'], true);
                }
                if (!empty($v['otherfee_content'])) {
                    $shop_cart_list[$k]['otherfee_content'] = json_decode($v['otherfee_content'], true);
                }
                if (!empty($v['prefe_gift'])) {
                    $shop_cart_list[$k]['prefe_gift'] = json_decode($v['prefe_gift'], true);
                }
                if (!empty($v['prefe_reduction'])) {
                    $shop_cart_list[$k]['prefe_reduction'] = json_decode($v['prefe_reduction'], true);
                }

                $shop_cart_list[$k]['services'] = json_decode($v['services'], true);

                #商品信息
                $shop_cart_list[$k]['goods_info'] = Db::table('goods')->where(['goods_id'=>$v['goods_id']])->first();
                $shop_cart_list[$k]['goods_info'] = objtoarr($shop_cart_list[$k]['goods_info']);

                #商铺信息
                if (!empty($shop_cart_list[$k]['goods_info']['shop_id'])) {
                    $shop_cart_list[$k]['shop_info'] = Db::connection('shop_db')->table('website_user_company')->where(['id'=>$shop_cart_list[$k]['goods_info']['shop_id']])->first();
                    $shop_cart_list[$k]['shop_info'] = objtoarr($shop_cart_list[$k]['shop_info']);
                } else {
                    $shop_cart_list[$k]['goods_info']['other_shop'] = json_decode($shop_cart_list[$k]['goods_info']['other_shop'], true);
                }

                #增值服务
                if (!empty($shop_cart_list[$k]['services'])) {
                    $shop_cart_list[$k]['services_money'] = 0;
                    foreach ($shop_cart_list[$k]['services'] as $k2=>$v2) {
                        $services = Db::table('goods_services')->where(['id'=>$v2['service_id']])->first();
                        $services = objtoarr($services);
                        if ($services['type']==1) {
                            #递增模式
                            $shop_cart_list[$k]['services'][$k2]['photoRequest'] = explode('@@@', rtrim($v2['photoRequest'], '@@@'));
                            if ($v2['photonum']>$services['num']) {
                                $shop_cart_list[$k]['services_money'] += $services['price'] + (($v2['photonum'] - 1) * $services['interval_price']);
                            } else {
                                $shop_cart_list[$k]['services_money'] += $services['price'];
                            }
                        } else {
                            $shop_cart_list[$k]['services_money'] += $services['price'];
                        }
                        $shop_cart_list[$k]['services'][$k2]['info'] = $services;
                    }
                }

                #选购清单的规格信息里的selected刷新为0
                Db::table('cart_sku')->where(['cart_id'=>$v['cart_id'],'is_buy'=>0])->update(['selected'=>0]);

                #规格信息
                $sku_info = Db::table('cart_sku')->where(['cart_id'=>$v['cart_id'],'is_buy'=>0])->get();
                $sku_info = objtoarr($sku_info);
                foreach ($sku_info as $k2=>$v2) {
                    $sku_info[$k2]['info'] = Db::table('goods_sku')->where(['sku_id'=>$v2['sku_id']])->first();
                    $sku_info[$k2]['info'] = objtoarr($sku_info[$k2]['info']);
                    $sku_info[$k2]['info']['sku_prices'] = json_decode($sku_info[$k2]['info']['sku_prices'], true);
                    #判断区间价格

                    if (count($sku_info[$k2]['info']['sku_prices']['price'])>1) {
                        foreach ($sku_info[$k2]['info']['sku_prices']['start_num'] as $k3=>$v3) {
                            if ($sku_info[$k2]['info']['sku_prices']['select_end'][$k3]==1) {
                                #数值
                                if ($v2['goods_num']>=$v3 and $v2['goods_num']<=$sku_info[$k2]['info']['sku_prices']['end_num'][$k3]) {
                                    $sku_info[$k2]['info']['sku_prices']['target_key'] = $k3;
                                    $sku_info[$k2]['info']['sku_prices']['target_price'] = $sku_info[$k2]['info']['sku_prices']['price'][$k3];
                                    break;
                                }
                            } elseif ($sku_info[$k2]['info']['sku_prices']['select_end'][$k3]==2) {
                                #以上
                                if ($v2['goods_num']>=$v3) {
                                    $sku_info[$k2]['info']['sku_prices']['target_key'] = $k3;
                                    $sku_info[$k2]['info']['sku_prices']['target_price'] = $sku_info[$k2]['info']['sku_prices']['price'][$k3];
                                    break;
                                }
                            }
                        }
                    }

                    #单位
//                    foreach($sku_info[$k2]['info']['sku_prices']['unit'] as $k3=>$v3){
                    $sku_info[$k2]['info']['sku_prices']['unit'][0] = Db::connection('shop_db')->table('unit')->where(['code_value'=>$sku_info[$k2]['info']['sku_prices']['unit'][0]])->first()->code_name;
//                    }
                    #币种
//                    foreach($sku_info[$k2]['info']['sku_prices']['currency'] as $k3=>$v3){
                    $sku_info[$k2]['info']['sku_prices']['currency'][0] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$sku_info[$k2]['info']['sku_prices']['currency'][0]])->first()->currency_symbol_standard;
//                    }
                }
                $shop_cart_list[$k]['sku_info'] = $sku_info;
                $cart_num +=1;
            }

            $cart = [];
            foreach ($shop_ids as $k=>$v) {
                foreach ($shop_cart_list as $k2=>$v2) {
                    if ($v==$v2['shop_id']) {
                        if (empty($cart)) {
                            $cart[$v] = [$v2];
                        } else {
                            if (isset($cart[$v])) {
                                $cart[$v] = array_merge($cart[$v], [$v2]);
                            } else {
                                $cart[$v] = [$v2];
                            }
                        }
                    }
                }
            }
            #选购清单=================================================

            #已订购清单=================================================
            #已订购未结算数量
            $cart_buynum_nopay = Db::connection('shop_db')->table('website_order_list')->whereRaw('user_id='.$user->id.' and status<>-4 and status not in (1,2,3,4,5,6,7,8,9)')->count();
            #已订购数量
            $cart_buynum = Db::connection('shop_db')->table('website_order_list')->whereRaw('user_id='.$user->id.' and status in (1,2,3,4,5,6,7,8,9)')->count();
            if ($selected==1) {
                #待结算
                #已订购清单
                $cart_buylist = Db::connection('shop_db')->table('website_order_list')->whereRaw('user_id='.$user->id.' and status<>-4 and status not in (1,2,3,4,5,6,7,8,9)')->orderBy('id', 'desc')->get();
            } elseif ($selected==3) {
                #已结算
                #已订购清单
                $cart_buylist = Db::connection('shop_db')->table('website_order_list')->whereRaw('user_id='.$user->id.' and status in (1,2,3,4,5,6,7,8,9)')->orderBy('id', 'desc')->get();
            }

            $cart_buylist = objtoarr($cart_buylist);
            foreach ($cart_buylist as $k=>$v) {
                $cart_buylist[$k]['content'] = @json_decode($v['content'], true);

                #收货地址START=========================
//                if(!empty($v['edit_address'])){
//                    $cart_buylist[$k]['edit_address'] = json_decode($v['edit_address'],true);
//                }
//                else{
//                    $cart_buylist[$k]['address'] = Db::connection('shop_db')->table('centralize_user_address')->where(['id'=>$cart_buylist[$k]['content']['address_id']])->first();
//                    $cart_buylist[$k]['address'] = objtoarr($cart_buylist[$k]['address']);
//                    $cart_buylist[$k]['address']['postal_code'] = json_decode($cart_buylist[$k]['address']['postal_code'],true);
//                    $cart_buylist[$k]['address']['postal'] = '';
//                    foreach($cart_buylist[$k]['address']['postal_code'] as $k2=>$v2){
//                        $cart_buylist[$k]['address']['postal'] .= $v2;
//                    }
//                    $country = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['id'=>$cart_buylist[$k]['address']['country_id']])->first()->param2;#国
//                    $province = '';
//                    if(!empty($cart_buylist[$k]['address']['province'])){
//                        $province = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$cart_buylist[$k]['address']['province']])->first()->code_name;#省
//                    }
//                    $city = '';
//                    if(!empty($cart_buylist[$k]['address']['city'])){
//                        $city = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$cart_buylist[$k]['address']['city']])->first()->code_name;#市
//                    }
//                    $area_info = '';$area_info2 = '';$area_info3 = '';$area_info4 = '';
//                    if(!empty($cart_buylist[$k]['address']['area'])){
//                        $area_info = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$cart_buylist[$k]['address']['area']])->first()->code_name;#区1
//                    }
//                    if(!empty($cart_buylist[$k]['address']['area2'])) {
//                        $area_info2 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id' => $cart_buylist[$k]['address']['area2']])->first()->code_name;#区2
//                    }
//                    if(!empty($cart_buylist[$k]['address']['area3'])) {
//                        $area_info3 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id' => $cart_buylist[$k]['address']['area3']])->first()->code_name;#区3
//                    }
//                    if(!empty($cart_buylist[$k]['address']['area4'])) {
//                        $area_info4 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id' => $cart_buylist[$k]['address']['area4']])->first()->code_name;#区4
//                    }
//
//                    $cart_buylist[$k]['address']['address2'] = json_decode($cart_buylist[$k]['address']['address2'], true);
//                    $address2 = '';
//                    if (!empty($cart_buylist[$k]['address']['address2'])) {
//                        foreach ($cart_buylist[$k]['address']['address2'] as $k2 => $v2) {
//                            $address2 .= $v2;
//                        }
//                    }
//
//                    $cart_buylist[$k]['address']['address'] = $country.$province.$city.$area_info.$area_info2.$area_info3.$area_info4.$cart_buylist[$k]['address']['address1'].$address2;
//                }
                #收货地址END===========================

//                dd($cart_buylist);
                #清单信息START=========================
                foreach ($cart_buylist[$k]['content']['goods_info'] as $k2=>$v2) {
                    $cart_buylist[$k]['content']['goods_info'][$k2]['goods_info'] = Db::table('goods')->where(['goods_id'=>$v2['good_id']])->first();
                    $cart_buylist[$k]['content']['goods_info'][$k2]['goods_info'] = objtoarr($cart_buylist[$k]['content']['goods_info'][$k2]['goods_info']);
                    if (!empty($v2['prefe_reduction'])) {
                        $cart_buylist[$k]['content']['goods_info'][$k2]['prefe_reduction'] = json_decode($v2['prefe_reduction'], true);
                    }
                    if (!empty($v2['prefe_gift'])) {
                        $cart_buylist[$k]['content']['goods_info'][$k2]['prefe_gift'] = json_decode($v2['prefe_gift'], true);
                    }
                    if (!empty($v2['otherfee_content'])) {
                        $cart_buylist[$k]['content']['goods_info'][$k2]['otherfee_content'] = json_decode($v2['otherfee_content'], true);
                    }
                    if (!empty($v2['file'])) {
                        $cart_buylist[$k]['content']['goods_info'][$k2]['file'] = json_decode($v2['file'], true);
                    }

                    if (!empty($v2['services'])) {
                        $cart_buylist[$k]['content']['goods_info'][$k2]['services'] = json_decode($v2['services'], true);
                    }
                    foreach ($v2['sku_info'] as $k3=>$v3) {
                        $cart_buylist[$k]['content']['goods_info'][$k2]['sku_info'][$k3]['sku_info'] = Db::table('goods_sku')->where(['sku_id'=>$v3['sku_id']])->first();
                        $cart_buylist[$k]['content']['goods_info'][$k2]['sku_info'][$k3]['sku_info'] = objtoarr($cart_buylist[$k]['content']['goods_info'][$k2]['sku_info'][$k3]['sku_info']);
                        if (isset($v3['odd_skuid']) || isset($v3['odd_goods_num']) || isset($v3['odd_reduction_money']) || isset($v3['odd_gift_money']) || isset($v3['odd_otherfee_total']) || isset($v3['odd_services_money'])) {
                            #当前规格有修改
                            if (!isset($v3['is_edit'])) {
                                $cart_buylist[$k]['content']['goods_info'][$k2]['sku_info'][$k3]['is_edit']=1;
                            } else {
                                $cart_buylist[$k]['content']['goods_info'][$k2]['sku_info'][$k3]['is_edit']=0;
                            }
                        } else {
                            #当前规格无修改
                            $cart_buylist[$k]['content']['goods_info'][$k2]['sku_info'][$k3]['is_edit']=0;
                        }
                    }
                }
                #清单信息END===========================
            }
//            dd($cart_buylist);
            #已订购清单=================================================

            #已关闭清单=================================================
            $cart_closenum = Db::connection('shop_db')->table('website_order_list')->where(['user_id'=>$user->id,'status'=>'-4'])->count();
            $cart_closelist = Db::connection('shop_db')->table('website_order_list')->where(['user_id'=>$user->id,'status'=>'-4'])->get();
            $cart_closelist = objtoarr($cart_closelist);
            foreach ($cart_closelist as $k=>$v) {
                $cart_closelist[$k]['content'] = json_decode($v['content'], true);
                #收货地址START=========================
//                if(!empty($v['edit_address'])){
//                    $cart_closelist[$k]['edit_address'] = json_decode($v['edit_address'],true);
//                }
//                else{
//                    $cart_closelist[$k]['address'] = Db::connection('shop_db')->table('centralize_user_address')->where(['id'=>$v['content']['address_id']])->first();
//                    $cart_closelist[$k]['address'] = objtoarr($cart_closelist[$k]['address']);
//                    $cart_closelist[$k]['address']['postal_code'] = json_decode($cart_closelist[$k]['address']['postal_code'],true);
//                    $cart_closelist[$k]['address']['postal'] = '';
//                    foreach($cart_closelist[$k]['address']['postal_code'] as $k2=>$v2){
//                        $cart_closelist[$k]['address']['postal'] .= $v2;
//                    }
//                    $country = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['id'=>$cart_closelist[$k]['address']['country_id']])->first()->param2;#国
//                    $province = '';
//                    if(!empty($cart_closelist[$k]['address']['province'])){
//                        $province = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$cart_closelist[$k]['address']['province']])->first()->code_name;#省
//                    }
//                    $city = '';
//                    if(!empty($cart_closelist[$k]['address']['city'])){
//                        $city = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$cart_closelist[$k]['address']['city']])->first()->code_name;#市
//                    }
//                    $area_info = '';$area_info2 = '';$area_info3 = '';$area_info4 = '';
//                    if(!empty($cart_closelist[$k]['address']['area'])){
//                        $area_info = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$cart_closelist[$k]['address']['area']])->first()->code_name;#区1
//                    }
//                    if(!empty($cart_closelist[$k]['address']['area2'])) {
//                        $area_info2 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id' => $cart_closelist[$k]['address']['area2']])->first()->code_name;#区2
//                    }
//                    if(!empty($cart_closelist[$k]['address']['area3'])) {
//                        $area_info3 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id' => $cart_closelist[$k]['address']['area3']])->first()->code_name;#区3
//                    }
//                    if(!empty($cart_closelist[$k]['address']['area4'])) {
//                        $area_info4 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id' => $cart_closelist[$k]['address']['area4']])->first()->code_name;#区4
//                    }
//
//                    $cart_closelist[$k]['address']['address2'] = json_decode($cart_closelist[$k]['address']['address2'], true);
//                    $address2 = '';
//                    if (!empty($cart_closelist[$k]['address']['address2'])) {
//                        foreach ($cart_closelist[$k]['address']['address2'] as $k2 => $v2) {
//                            $address2 .= $v2;
//                        }
//                    }
//
//                    $cart_closelist[$k]['address']['address'] = $country.$province.$city.$area_info.$area_info2.$area_info3.$area_info4.$cart_closelist[$k]['address']['address1'].$address2;
//                }
                #收货地址END===========================

                #清单信息START=========================
                foreach ($cart_closelist[$k]['content']['goods_info'] as $k2=>$v2) {
                    $cart_closelist[$k]['content']['goods_info'][$k2]['goods_info'] = Db::table('goods')->where(['goods_id'=>$v2['good_id']])->first();
                    $cart_closelist[$k]['content']['goods_info'][$k2]['goods_info'] = objtoarr($cart_closelist[$k]['content']['goods_info'][$k2]['goods_info']);
                    if (!empty($v2['prefe_reduction'])) {
                        $cart_closelist[$k]['content']['goods_info'][$k2]['prefe_reduction'] = json_decode($v2['prefe_reduction'], true);
                    }
                    if (!empty($v2['prefe_gift'])) {
                        $cart_closelist[$k]['content']['goods_info'][$k2]['prefe_gift'] = json_decode($v2['prefe_gift'], true);
                    }
                    if (!empty($v2['otherfee_content'])) {
                        $cart_closelist[$k]['content']['goods_info'][$k2]['otherfee_content'] = json_decode($v2['otherfee_content'], true);
                    }
                    if (!empty($v2['file'])) {
                        $cart_closelist[$k]['content']['goods_info'][$k2]['file'] = json_decode($v2['file'], true);
                    }
                    if (!empty($v2['services'])) {
                        $cart_closelist[$k]['content']['goods_info'][$k2]['services'] = json_decode($v2['services'], true);
                    }
                    foreach ($v2['sku_info'] as $k3=>$v3) {
                        $cart_closelist[$k]['content']['goods_info'][$k2]['sku_info'][$k3]['sku_info'] = Db::table('goods_sku')->where(['sku_id'=>$v3['sku_id']])->first();
                        $cart_closelist[$k]['content']['goods_info'][$k2]['sku_info'][$k3]['sku_info'] = objtoarr($cart_closelist[$k]['content']['goods_info'][$k2]['sku_info'][$k3]['sku_info']);
                        if (isset($v3['odd_skuid']) || isset($v3['odd_goods_num']) || isset($v3['odd_reduction_money']) || isset($v3['odd_gift_money']) || isset($v3['odd_otherfee_total']) || isset($v3['odd_services_money'])) {
                            #当前规格有修改
                            if (!isset($v3['is_edit'])) {
                                $cart_closelist[$k]['content']['goods_info'][$k2]['sku_info'][$k3]['is_edit']=1;
                            } else {
                                $cart_closelist[$k]['content']['goods_info'][$k2]['sku_info'][$k3]['is_edit']=0;
                            }
                        } else {
                            #当前规格无修改
                            $cart_closelist[$k]['content']['goods_info'][$k2]['sku_info'][$k3]['is_edit']=0;
                        }
                    }
                }
                #清单信息END===========================
            }
            #已关闭清单=================================================

            $is_inner=1;#内页打开首页头部，不显示消息轮播框

            #获取配置信息
            $website = get_website();
            $page_info = get_pageinfo('/cart.html?selected=1');
            $website['background'] = $page_info['content']['background'];
            $website['content'] = $page_info['content']['content'];
            $website['fontcolor'] = $page_info['content']['fontcolor'];

            $origin_page = '/cart.html';

            $compact = compact('website', 'cart', 'cart_num', 'cart_delnum', 'cart_buynum_nopay', 'cart_buynum', 'default_address', 'address_id', 'isframe', 'cart_buylist', 'selected', 'cart_closenum', 'cart_closelist', 'origin_page', 'is_inner');

            return view('cart.cart_list', $compact);
        } else {
            header('Location: /login.html?open=4&param2='.base64_encode('/cart.html?selected='.$selected.'&isframe='.$isframe));
        }
    }

    #选购清单-计算订购清单所选价格
    public function calc_fee(Request $request)
    {
        $data = $request->except(['_token']);
        $type = intval($data['type']);
        $sku_ids = explode(',', rtrim($data['sku_ids'], ','));
        $cart_ids = explode(',', rtrim($data['cart_ids'], ','));
        $goods_ids = explode(',', rtrim($data['goods_ids'], ','));

        $sku_price = 0;#数值框变化时记录的商品规格（小计）价格
        if ($type==1) {
            #数值框变化，数据表也要发生变化
            $sku_nums = explode(',', rtrim($data['sku_nums'], ','));
            foreach ($sku_nums as $k=>$v) {
                $sku_info = Db::table('goods_sku')->where(['sku_id'=>$sku_ids[$k]])->first();
                $sku_info = objtoarr($sku_info);
                $sku_info['sku_prices'] = json_decode($sku_info['sku_prices'], true);

                if (count($sku_info['sku_prices']['price'])>1) {
                    #有阶级计价
                    foreach ($sku_info['sku_prices']['start_num'] as $k3=>$v3) {
                        if ($sku_info['sku_prices']['select_end'][$k3]==1) {
                            #数值
                            if ($v>=$v3 and $v<=$sku_info['sku_prices']['end_num'][$k3]) {
                                $sku_info['sku_prices']['target_price'] = $sku_info['sku_prices']['price'][$k3];
                                break;
                            }
                        } elseif ($sku_info['sku_prices']['select_end'][$k3]==2) {
                            #以上
                            if ($v>=$v3) {
                                $sku_info['sku_prices']['target_price'] = $sku_info['sku_prices']['price'][$k3];
                                break;
                            }
                        }
                    }
                } else {
                    #无阶级计价
                    $sku_info['sku_prices']['target_price'] = $sku_info['sku_prices']['price'][0];
                }

                #开始计算当前采购规格表价格
                $sku_price = sprintf('%.2f', $sku_info['sku_prices']['target_price']*$v);
                Db::table('cart_sku')->where(['cart_id'=>$cart_ids[$k],'sku_id'=>$sku_ids[$k]])->update(['goods_num'=>$v,'price'=>$sku_price]);
            }
        }

        $total_money = 0;
        if (!empty($sku_ids[0])) {
            foreach ($sku_ids as $k=>$v) {
                $cart_id = intval($cart_ids[$k]);
                $sku_id = intval($v);
                $goods_id = intval($goods_ids[$k]);
                $sku_info = Db::table('cart_sku')->where(['cart_id'=>$cart_id,'sku_id'=>$sku_id])->first();
                $sku_info = objtoarr($sku_info);

                #商品价格
                $total_money += $sku_info['price'];
            }

            #去除重复购物车id 和 计算所选购物车的费用（其他费用、减免优惠、随赠优惠、更多服务）
            $cart_ids = array_unique($cart_ids);
            foreach ($cart_ids as $k=>$v) {
                $cart_info = Db::table('cart')->where(['cart_id'=>$v])->first();
                $cart_info = objtoarr($cart_info);

                $services_money = 0;
//                if(!empty($cart_info['services'])){
//                    $cart_info['services'] = json_decode($cart_info['services'],true);
//                    foreach($cart_info['services'] as $k2=>$v2){
//                        $services = Db::table('goods_services')->where(['id'=>$v2['service_id']])->first();
//                        $services = objtoarr($services);
//                        if($services['type']==1){
//                            $shop_cart_list[$k]['services'][$k2]['photoRequest'] = explode('@@@',rtrim($v2['photoRequest'],'@@@'));
//                            if($v2['photonum']>$services['num']){
//                                $services_money += $services['price'] + (($v2['photonum'] - 1) * $services['interval_price']);
//                            }else{
//                                $services_money += $services['price'];
//                            }
//                        }else{
//                            $services_money += $services['price'];
//                        }
//                    }
//                }

                $total_money = sprintf('%.2f', $total_money - $cart_info['reduction_money'] - $cart_info['gift_money'] + $cart_info['otherfee_total'] + $services_money);
            }
        }


        return response()->json(['code'=>0,'price'=>$total_money,'sku_pirce'=>$sku_price]);
    }

    #订购清单-计算勾选的商品规格价格
    public function calc_fee2(Request $request)
    {
        $data = $request->except(['_token']);

        $order_id = intval($data['oid']);#订单id
        $type = intval($data['type']);
        $sku_ids = explode(',', rtrim($data['sku_ids'], ','));#规格id
        $cart_ids = explode(',', rtrim($data['cart_ids'], ','));#选购清单id
        $goods_ids = explode(',', rtrim($data['goods_ids'], ','));#商品id
        $sku_nums = explode(',', rtrim($data['sku_nums'], ','));#购买数量（废弃）

        $order = Db::connection('shop_db')->table('website_order_list')->where(['id'=>$order_id])->first();
        $order = objtoarr($order);
        $order['content'] = json_decode($order['content'], true);
//        dd($order['content']);

        $total_money = 0;
        $already_buy_goods = [];#已计算过服务费用的商品id
        foreach ($order['content']['goods_info'] as $k=>$v) {
            foreach ($v['sku_info'] as $k2=>$v2) {
                foreach ($sku_ids as $k3=>$v3) {
                    if ($v3==$v2['sku_id']) {
                        $reduction_money = 0;
                        $gift_money = 0;
                        $otherfee_total = 0;
                        $services_money = 0;
                        if (!in_array($v['good_id'], $already_buy_goods)) {
                            #减免金额
                            $reduction_money = $v['reduction_money'];
                            #随赠金额
                            $gift_money = $v['gift_money'];
                            #其他费用金额
                            $otherfee_total = $v['otherfee_total'];
                            #价格未含
                            $noinclude_money = 0;
                            if (isset($v['noinclude_money'])) {
                                $noinclude_money = $v['noinclude_money'];
                            }
                            #潜在收费
                            $potential_money = 0;
                            if (isset($v['potential_money'])) {
                                $potential_money = $v['potential_money'];
                            }
                            #服务费用金额
                            if (isset($v['services_money'])) {
                                $services_money = $v['services_money'];
                            } else {
                                $services = json_decode($v['services'], true);
                                $services_money = 0;
                                foreach ($services as $k4=>$v4) {
                                    $services2 = Db::table('goods_services')->where(['id'=>$v4['service_id']])->first();
                                    $services2 = objtoarr($services2);
                                    if ($v4['service_id']==1) {
                                        if ($v4['photonum']>1) {
                                            $services_money += $services2['price'] + (($v4['photonum'] - 1) * $services2['interval_price']);
                                        }
                                    } else {
                                        $services_money += $services2['price'];
                                    }
                                }
                            }
                            $already_buy_goods = array_merge($already_buy_goods, [$v['good_id']]);
                        }
                        $total_money += sprintf('%.2f', $v2['price'] - $reduction_money - $gift_money + $otherfee_total + $services_money + $noinclude_money + $potential_money);
                    }
                }
            }
        }
        return response()->json(['code'=>0,'price'=>number_format($total_money, 2)]);
    }

    #选购清单记录所选商品
    public function buy_goods(Request $request)
    {
        $data = $request->except(['_token']);
        $buy_skuid = explode(',', rtrim($data['buy_skuid'], ','));

//        $user = get_userid();#官网用户id
        if (empty($buy_skuid)) {
            return response()->json(['code'=>-1,'msg'=>'请勾选需要订购的商品']);
        }

        #查询是否有商家店铺
        #1、商家店铺只能单独下单；
        #2、爬虫商品可以一齐下单，但不能与商家店铺下单；
        $can_buy = 0;#第一个购物车决定后面的类型：0不能购买，1淘中国商品，2淘中国商家商品
        $shop_id = 0;#购买的商铺id
        foreach ($buy_skuid as $k=>$v) {
            #购物车sku信息
            $cart_sku = Db::table('cart_sku')->where(['id'=>$v])->first();
            #购物车信息
            $cart = Db::table('cart')->where(['cart_id'=>$cart_sku->cart_id])->first();
            #购物车店铺信息
            $shop = Db::connection('shop_db')->table('website_user_company')->where(['id'=>$cart->shop_id])->first();
            $shop = objtoarr($shop);
            if (empty($shop)) {
                $goods_sku = Db::table('goods_sku')->where(['sku_id'=>$cart_sku->sku_id])->first();
                $goods = Db::table('goods')->where(['goods_id'=>$goods_sku->goods_id])->first();
                $goods = objtoarr($goods);
                $shop_name = '淘中国';
                if (!empty($goods['other_shop'])) {
                    $goods['other_shop'] = json_decode($goods['other_shop'], true);
                    $shop_name = $goods['other_shop']['shopName'];
                }
                if ($can_buy==0) {
                    $can_buy = 1;
                } elseif ($can_buy==2) {
                    return Response()->json(['code'=>-1,'msg'=>'店铺['.$shop_name.']的商品请单独勾选下单']);
                }
            } else {
                if ($can_buy==0) {
                    $can_buy = 2;
                    $shop_id = $shop['id'];
                } elseif ($can_buy==1) {
                    $shop_name = $shop['company'];
                    return Response()->json(['code'=>-1,'msg'=>'店铺['.$shop_name.']的商品请单独勾选下单']);
                } elseif ($can_buy==2) {
                    if ($shop_id!=$shop['id']) {
                        $shop_name = $shop['company'];
                        return Response()->json(['code'=>-1,'msg'=>'店铺['.$shop_name.']的商品请单独勾选下单']);
                    }
                }
            }
        }

        foreach ($buy_skuid as $k=>$v) {
            Db::table('cart_sku')->where(['id' => $v])->update(['selected' => 1]);
        }

        return Response()->json(['code'=>0,'msg'=>'正在跳转确认下单页']);
    }

    #购买订购清单所选商品（废弃）
    public function buy_goods2(Request $request)
    {
        $data = $request->except(['_token']);
        $buy_skuid = explode(',', rtrim($data['buy_skuid'], ','));
        $addr_id = intval($data['addr_id']);
//        dd($data);

        DB::beginTransaction();
        try {
            $user = get_userid();#官网用户id
            $ordersn = get_ordersn(2);#订购单编号

            #订购单总价格
            $true_price = 0;
            #订购单信息

            $content = ['address_id' => $addr_id, 'goods_info' => [], 'warehouse_id' => 16];
            $cart_info = [];
            foreach ($buy_skuid as $k => $v) {
                $cart_sku = Db::table('cart_sku')->where(['id' => $v])->first();
                $true_price = number_format($true_price + $cart_sku->price, 2);

                #组装订购清单商品数据
                $cart = Db::table('cart')->where(['cart_id' => $cart_sku->cart_id])->first();
                if (empty($content['goods_info'])) {
                    $content['goods_info'] = array_merge($content['goods_info'], [[
                        'good_id' => $cart->goods_id,
                        'reduction_money' => $cart->reduction_money,
                        'prefe_reduction' => $cart->prefe_reduction,
                        'gift_money' => $cart->gift_money,
                        'prefe_gift' => $cart->prefe_gift,
                        'otherfee_content' => $cart->otherfee_content,
                        'otherfee_currency' => $cart->otherfee_currency,
                        'otherfee_total' => $cart->otherfee_total,
                        'file' => $cart->file,
                        'services' => $cart->services,
                        'sku_info' => []
                    ]]);
                } else {
                    $is_have = 0;
                    foreach ($content['goods_info'] as $k2 => $v2) {
                        if ($v2['good_id'] == $cart->goods_id) {
                            $is_have = 1;
                        }
                    }

                    if ($is_have == 0) {
                        #没出现相同商品id
                        $content['goods_info'] = array_merge($content['goods_info'], [[
                            'good_id' => $cart->goods_id,
                            'reduction_money' => $cart->reduction_money,
                            'prefe_reduction' => $cart->prefe_reduction,
                            'gift_money' => $cart->gift_money,
                            'prefe_gift' => $cart->prefe_gift,
                            'otherfee_content' => $cart->otherfee_content,
                            'otherfee_currency' => $cart->otherfee_currency,
                            'otherfee_total' => $cart->otherfee_total,
                            'file' => $cart->file,
                            'services' => $cart->services,
                            'sku_info' => []
                        ]]);
                    }
                }

                #在响应商品id下插入规格信息
                foreach ($content['goods_info'] as $k2 => $v2) {
                    if ($v2['good_id'] == $cart->goods_id) {
                        $cart_info = array_merge($cart_info, [$cart_sku->cart_id]);
                        $content['goods_info'][$k2]['sku_info'] = array_merge($content['goods_info'][$k2]['sku_info'], [[
                            'sku_id' => $cart_sku->sku_id,
                            'goods_num' => $cart_sku->goods_num,
                            'price' => $cart_sku->price,
                            'currency' => $cart_sku->currency,
                            'cart_id' => $cart_sku->cart_id,
                        ]]);
                    }
                }

                #选购清单下的规格商品修改为已订购
                Db::table('cart_sku')->where(['id'=>$v])->update(['is_buy'=>1]);
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
                $true_price = number_format($true_price - $cart['reduction_money'] - $cart['gift_money'] + $cart['otherfee_total'] + $services_money, 2);
            }

            $orderid = Db::connection('shop_db')->table('website_order_list')->insertGetId([
                'user_id' => $user->id,
                'ordersn' => $ordersn,
                'order_type' => 1,
                'pay_method' => 1,
                'true_money' => $true_price,
                'content' => json_encode($content, true),
                'status' => -2,#待确认有无货
                'createtime' => time(),
            ]);

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
                return response()->json(['code'=>0,'msg'=>'申请订购成功','data'=>['ordersn'=>$ordersn]]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            echo $e->getCode();
            return response()->json(['code'=>-1,'msg'=>'系统错误，请联系管理员']);
        }
    }

    #确认清单信息
    public function sure_order_info(Request $request)
    {
        $data = $request->except(['_token']);
        $type = intval($data['type']);
        $order_id = intval($data['order_id']);

        $order = Db::connection('shop_db')->table('website_order_list')->where(['id'=>$order_id])->first();
        $order = objtoarr($order);
        $order['content'] = json_decode($order['content'], true);

        if ($type==1) {
            #确认商品规格/数量/价格信息
            $gkey = intval($data['gkey']);
            $skey = intval($data['skey']);
            $sku_id = intval($data['sku_id']);

            $order['content']['goods_info'][$gkey]['sku_info'][$skey]['is_edit'] = 0;
            Db::connection('shop_db')->table('website_order_list')->where(['id'=>$order_id])->update([
                'content'=>json_encode($order['content'], true)
            ]);
            return Response()->json(['code'=>0,'msg'=>'确认成功，正在刷新页面']);
        } elseif ($type==2) {
            #确认地址信息
            $order['edit_address'] = json_decode($order['edit_address'], true);
            $order['edit_address']['is_sure'] = 1;
            Db::connection('shop_db')->table('website_order_list')->where(['id'=>$order_id])->update([
               'edit_address'=>json_encode($order['edit_address'], true)
            ]);
            return Response()->json(['code'=>0,'msg'=>'确认成功，正在刷新页面']);
        } elseif ($type==3) {
            #查看内容
            $gkey = intval($data['gkey']);
            $skey = intval($data['skey']);
            $sku_id = intval($data['sku_id']);

            $sku_data = $order['content']['goods_info'][$gkey]['sku_info'][$skey];
            $goods_data = $order['content']['goods_info'][$gkey];
            #其他费用
            if (!empty($goods_data['otherfee_content'])) {
                $goods_data['otherfee_content'] = json_decode($goods_data['otherfee_content'], true);
            }
            #减免优惠
            if (!empty($goods_data['reduction_content'])) {
                $goods_data['reduction_content'] = json_decode($goods_data['reduction_content'], true);
            }
            #随赠优惠
            if (!empty($goods_data['prefe_gift'])) {
                $goods_data['prefe_gift'] = json_decode($goods_data['prefe_gift'], true);
            }
            #价格未含
            if (!empty($goods_data['noinclude_content'])) {
                $goods_data['noinclude_content'] = json_decode($goods_data['noinclude_content'], true);
            }
            #潜在收费
            if (!empty($goods_data['potential_content'])) {
                $goods_data['potential_content'] = json_decode($goods_data['potential_content'], true);
            }
            #监管文件
            if (!empty($goods_data['file'])) {
                $goods_data['file'] = json_decode($goods_data['file'], true);
            }
            #废弃
            if (!empty($goods_data['prefe_reduction'])) {
                $goods_data['prefe_reduction'] = json_decode($goods_data['prefe_reduction'], true);
            }

            $goods_data['services'] = json_decode($goods_data['services'], true);

            #更多服务
            $goods_data['services_currency'] = '';
            $goods_data['services_money'] = 0;
            $edit_services_money = 0;
            foreach ($goods_data['services'] as $k2=>$v2) {
                $services = Db::table('goods_services')->where(['id'=>$v2['service_id']])->first();
                $services = objtoarr($services);
                $goods_data['services_currency'] = $services['currency'];
                if ($v2['service_id']==1) {
                    $goods_data['services'][$k2]['photoRequest'] = explode('@@@', rtrim($v2['photoRequest'], '@@@'));
                    if ($v2['photonum']>1) {
                        $goods_data['services_money'] += $services['price'] + (($v2['photonum'] - 1) * $services['interval_price']);
                    }
                } else {
                    $goods_data['services_money'] += $services['price'];
                }
                $goods_data['services'][$k2]['info'] = $services;
            }
            $goods_data['services_currency'] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$goods_data['services_currency']])->first()->currency_symbol_standard;
            if (is_numeric($goods_data['otherfee_currency'])) {
                $goods_data['otherfee_currency'] = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$goods_data['otherfee_currency']])->first()->currency_symbol_standard;
            }

            #原来选择的商品规格
            $origin_skuinfo = '';
            if (isset($sku_data['odd_skuid'])) {
                $origin_skuinfo = Db::table('goods_sku')->where(['sku_id'=>$sku_data['odd_skuid']])->first()->spec_names;
            }
            #新的商品规格
            $new_skuinfo = Db::table('goods_sku')->where(['sku_id'=>$sku_data['sku_id']])->first()->spec_names;

            #返回当前规格的信息
            $datas = [
                #其他费用和内容
                'otherfee_content'=>$goods_data['otherfee_content'],
                'otherfee_total'=>$goods_data['otherfee_total'],
                'odd_otherfee_total'=>isset($goods_data['odd_otherfee_total']) ? $goods_data['odd_otherfee_total'] : '',
                #减免优惠内容
                'reduction_content'=>$goods_data['reduction_content'],
                'reduction_money'=>$goods_data['reduction_money'],
                'odd_reduction_money'=>isset($goods_data['odd_reduction_money']) ? $goods_data['odd_reduction_money'] : '',
                #随赠金额和内容
                'prefe_gift'=>$goods_data['prefe_gift'],
                'gift_money'=>$goods_data['gift_money'],
                'odd_gift_money'=>isset($goods_data['odd_gift_money']) ? $goods_data['odd_gift_money'] : '',
                #价格未含内容
                'noinclude_content'=>$goods_data['noinclude_content'],
                'noinclude_money'=>$goods_data['noinclude_money'],
                'odd_noinclude_money'=>isset($goods_data['odd_noinclude_money']) ? $goods_data['odd_noinclude_money'] : '',
                #潜在收费内容
                'potential_content'=>$goods_data['potential_content'],
                'potential_money'=>$goods_data['potential_money'],
                'odd_potential_money'=>isset($goods_data['odd_potential_money']) ? $goods_data['odd_potential_money'] : '',
                #减免金额和内容(废弃)
//                'prefe_reduction'=>$goods_data['prefe_reduction'],
                #币种
                'otherfee_currency'=>$goods_data['otherfee_currency'],
                #其他服务费用
                'services_currency'=>$goods_data['services_currency'],
                'services_money'=>number_format($goods_data['services_money'], 2),
                'odd_services_money'=>isset($goods_data['odd_services_money']) ? $goods_data['odd_services_money'] : '',
                'services'=>$goods_data['services'],
                #所需文件
                'file'=>empty($goods_data['file']) ? '' : $goods_data['file'],
            ];

            return Response()->json(['code'=>0,'datas'=>$datas]);
        }
    }

    #关闭清单
    public function close_order(Request $request)
    {
        $data = $request->except(['_token']);
        $oid = intval($data['oid']);

        $res = Db::connection('shop_db')->table('website_order_list')->where(['id'=>$oid])->update([
           'status'=>-4
        ]);
        if ($res) {
            return Response()->json(['code'=>0,'msg'=>'关闭成功']);
        }
    }

    #订购单详情
    public function cart_detail(Request $request)
    {
        $data = $request->except(['_token']);
        $order_id = intval($data['id']);
        $isframe = isset($dat['isframe']) ? intval($data['isframe']) : 0;

        $user = session('user');
        if (empty($user)) {
            header('Location: /login.html?open=4&param2='.base64_encode('/cart/cart_detail?id='.$order_id));
        }

        $cart_buylist = Db::connection('shop_db')->table('website_order_list')->whereRaw('id=' . $order_id)->first();
        $cart_buylist = objtoarr($cart_buylist);
        $cart_buylist['content'] = json_decode($cart_buylist['content'], true);

        if (1>2) {
            #收货地址START=========================
            if (!empty($cart_buylist['edit_address'])) {
                $cart_buylist['edit_address'] = json_decode($cart_buylist['edit_address'], true);
            } else {
                $cart_buylist['address'] = Db::connection('shop_db')->table('centralize_user_address')->where(['id'=>$cart_buylist['content']['address_id']])->first();
                $cart_buylist['address'] = objtoarr($cart_buylist['address']);
                $cart_buylist['address']['postal_code'] = json_decode($cart_buylist['address']['postal_code'], true);
                $cart_buylist['address']['postal'] = '';
                foreach ($cart_buylist['address']['postal_code'] as $k2=>$v2) {
                    $cart_buylist['address']['postal'] .= $v2;
                }
                $country = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['id'=>$cart_buylist['address']['country_id']])->first()->param2;#国
                $province = '';
                if (!empty($cart_buylist['address']['province'])) {
                    $province = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$cart_buylist['address']['province']])->first()->code_name;#省
                }
                $city = '';
                if (!empty($cart_buylist['address']['city'])) {
                    $city = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$cart_buylist['address']['city']])->first()->code_name;#市
                }
                $area_info = '';
                $area_info2 = '';
                $area_info3 = '';
                $area_info4 = '';
                if (!empty($cart_buylist['address']['area'])) {
                    $area_info = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$cart_buylist['address']['area']])->first()->code_name;#区1
                }
                if (!empty($cart_buylist['address']['area2'])) {
                    $area_info2 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id' => $cart_buylist['address']['area2']])->first()->code_name;#区2
                }
                if (!empty($cart_buylist['address']['area3'])) {
                    $area_info3 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id' => $cart_buylist['address']['area3']])->first()->code_name;#区3
                }
                if (!empty($cart_buylist['address']['area4'])) {
                    $area_info4 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id' => $cart_buylist['address']['area4']])->first()->code_name;#区4
                }

                $cart_buylist['address']['address2'] = json_decode($cart_buylist['address']['address2'], true);
                $address2 = '';
                if (!empty($cart_buylist['address']['address2'])) {
                    foreach ($cart_buylist['address']['address2'] as $k2 => $v2) {
                        $address2 .= $v2;
                    }
                }

                $cart_buylist['address']['address'] = $country.$province.$city.$area_info.$area_info2.$area_info3.$area_info4.$cart_buylist['address']['address1'].$address2;
            }
            #收货地址END===========================
        }

        #供应商START===========================
        $shoper = [];
        foreach ($cart_buylist['content']['goods_info'] as $k => $v) {
            $goods = Db::table('goods')->where(['goods_id' => $v['good_id']])->first();
            $goods = objtoarr($goods);
            $goods_currency = Db::connection('shop_db')->table('centralize_currency')->where(['id'=>$goods['goods_currency']])->first()->currency_symbol_standard;

            if (!empty($goods['shop_id'])) {
//                $merchant = Db::table('shop')->where(['shop_id' => $goods['shop_id']])->first();
                $merchant = Db::connection('shop_db')->table('website_user_company')->where(['id'=>$goods['shop_id']])->first();
                $merchant = objtoarr($merchant);

                if (!empty($shoper)) {
                    $is_empty = 0;
                    foreach ($shoper as $k2 => $v2) {
                        if ($v2['shop_id'] == $merchant['shop_id']) {
                            $is_empty = 1;
                        }
                    }
                    if ($is_empty == 0) {
                        $shoper = array_merge($shoper, [['shop_id' => $merchant['id'], 'shop_name' => $merchant['company'],'goods_currency'=>$goods_currency]]);
                    }
                } else {
                    $shoper = array_merge($shoper, [['shop_id' => $merchant['id'], 'shop_name' => $merchant['company'],'goods_currency'=>$goods_currency]]);
                }
            } elseif (!empty($goods['other_shop'])) {
                $goods['other_shop'] = json_decode($goods['other_shop'], true);
                if (!empty($shoper)) {
                    $is_empty = 0;
                    foreach ($shoper as $k2 => $v2) {
                        if ($v2['shop_id'] == 'o_' . $goods['other_shop']['shopId']) {
                            $is_empty = 1;
                        }
                    }
                    if ($is_empty == 0) {
                        $shoper = array_merge($shoper, [['shop_id' => 'o_' . $goods['other_shop']['shopId'], 'shop_name' => $goods['other_shop']['shopName'],'goods_currency'=>$goods_currency]]);
                    }
                } else {
                    $shoper = array_merge($shoper, [['shop_id' => 'o_' . $goods['other_shop']['shopId'], 'shop_name' => $goods['other_shop']['shopName'],'goods_currency'=>$goods_currency]]);
                }
            } else {
                if (!empty($shoper)) {
                    $shoper = array_merge($shoper, [['shop_id' => '0', 'shop_name' => '淘中国','goods_currency'=>$goods_currency]]);
                } else {
                    $shoper = array_merge($shoper, [['shop_id' => '0', 'shop_name' => '淘中国','goods_currency'=>$goods_currency]]);
                }
            }
        }
        #供应商END=============================

        #供应商商品START=============================
        foreach ($shoper as $k3 => $v3) {
            foreach ($cart_buylist['content']['goods_info'] as $k2 => $v2) {
                $goods = Db::table('goods')->where(['goods_id' => $v2['good_id']])->first();
                $goods = objtoarr($goods);
                if (empty($goods['shop_id'])) {
                    if (!empty($goods['other_shop'])) {
                        $goods['other_shop'] = json_decode($goods['other_shop'], true);
                        if ('o_' . $goods['other_shop']['shopId'] == $v3['shop_id']) {
                            $children = [];
                            #其他费用
                            if (!empty($v2['otherfee_content'])) {
                                $children['otherfee_content'] = json_decode($v2['otherfee_content'], true);
                            }
                            #减免费用
                            if (!empty($v2['reduction_content'])) {
                                $children['reduction_content'] = json_decode($v2['reduction_content'], true);
                            }
                            #随赠优惠
                            if (!empty($v2['prefe_gift'])) {
                                $children['prefe_gift'] = json_decode($v2['prefe_gift'], true);
                            }
                            #价格未含
                            if (!empty($v2['noinclude_content'])) {
                                $children['noinclude_content'] = json_decode($v2['noinclude_content'], true);
                            }
                            #潜在收费
                            if (!empty($v2['potential_content'])) {
                                $children['potential_content'] = json_decode($v2['potential_content'], true);
                            }
                            #监管文件
                            if (!empty($v2['file'])) {
                                $children['file'] = json_decode($v2['file'], true);
                            }
                            #增值服务和其他费用（无商户的商品，此费用合并在同一列）
                            if (!empty($v2['services'])) {
                                $children['services'] = json_decode($v2['services'], true);
                            }
                            foreach ($v2['sku_info'] as $k4 => $v4) {
                                $children['sku_info'][$k4]['sku_info'] = Db::table('goods_sku')->where(['sku_id' => $v4['sku_id']])->first();
                                $children['sku_info'][$k4]['sku_info'] = objtoarr($children['sku_info'][$k4]['sku_info']);
                                if (isset($v4['odd_skuid']) || isset($v4['odd_goods_num']) || isset($v4['odd_reduction_money']) || isset($v4['odd_gift_money']) || isset($v4['odd_otherfee_total']) || isset($v4['odd_services_money'])) {
                                    #当前规格有修改
                                    if (!isset($v4['is_edit'])) {
                                        $children['sku_info'][$k4]['is_edit'] = 1;
                                    } else {
                                        $children['sku_info'][$k4]['is_edit'] = 0;
                                    }
                                } else {
                                    #当前规格无修改
                                    $children['sku_info'][$k4]['is_edit'] = 0;
                                }
                            }
                            if (isset($shoper[$k3]['children']['goods_info'])) {
                                $shoper[$k3]['children']['goods_info'] = array_merge($shoper[$k3]['children']['goods_info'], [$goods]);
                            } else {
                                $children['goods_info'][] = $goods;
                            }

                            $shoper[$k3]['children'] = $children;
                        }
                    } else {
                        $children = [];
                        #其他费用
                        if (!empty($v2['otherfee_content'])) {
                            $children['otherfee_content'] = json_decode($v2['otherfee_content'], true);
                        }
                        #减免费用
                        if (!empty($v2['reduction_content'])) {
                            $children['reduction_content'] = json_decode($v2['reduction_content'], true);
                        }
                        #随赠优惠
                        if (!empty($v2['prefe_gift'])) {
                            $children['prefe_gift'] = json_decode($v2['prefe_gift'], true);
                        }
                        #价格未含
                        if (!empty($v2['noinclude_content'])) {
                            $children['noinclude_content'] = json_decode($v2['noinclude_content'], true);
                        }
                        #潜在收费
                        if (!empty($v2['potential_content'])) {
                            $children['potential_content'] = json_decode($v2['potential_content'], true);
                        }
                        #监管文件
                        if (!empty($v2['file'])) {
                            $children['file'] = json_decode($v2['file'], true);
                        }
                        #增值服务和其他费用（无商户的商品，此费用合并在同一列）
                        if (!empty($v2['services'])) {
                            $children['services'] = json_decode($v2['services'], true);
                        }
                        foreach ($v2['sku_info'] as $k4 => $v4) {
                            $children['sku_info'][$k4]['sku_info'] = Db::table('goods_sku')->where(['sku_id' => $v4['sku_id']])->first();
                            $children['sku_info'][$k4]['sku_info'] = objtoarr($children['sku_info'][$k4]['sku_info']);
                            if (isset($v4['odd_skuid']) || isset($v4['odd_goods_num']) || isset($v4['odd_reduction_money']) || isset($v4['odd_gift_money']) || isset($v4['odd_otherfee_total']) || isset($v4['odd_services_money'])) {
                                #当前规格有修改
                                if (!isset($v4['is_edit'])) {
                                    $children['sku_info'][$k4]['is_edit'] = 1;
                                } else {
                                    $children['sku_info'][$k4]['is_edit'] = 0;
                                }
                            } else {
                                #当前规格无修改
                                $children['sku_info'][$k4]['is_edit'] = 0;
                            }
                        }
                        if (isset($shoper[$k3]['children']['goods_info'])) {
                            $shoper[$k3]['children']['goods_info'] = array_merge($shoper[$k3]['children']['goods_info'], [$goods]);
                        } else {
                            $children['goods_info'][] = $goods;
                        }

                        $shoper[$k3]['children'] = $children;
                    }
                } elseif ($goods['shop_id'] == $v3['shop_id']) {
                    #商户商品
                    $children = [];
                    #其他费用
                    if (!empty($v2['otherfee_content'])) {
                        $children['otherfee_content'] = json_decode($v2['otherfee_content'], true);
                    }
                    #减免费用
                    if (!empty($v2['reduction_content'])) {
                        $children['reduction_content'] = json_decode($v2['reduction_content'], true);
                    }
                    #随赠优惠
                    if (!empty($v2['prefe_gift'])) {
                        $children['prefe_gift'] = json_decode($v2['prefe_gift'], true);
                    }
                    #价格未含
                    if (!empty($v2['noinclude_content'])) {
                        $children['noinclude_content'] = json_decode($v2['noinclude_content'], true);
                    }
                    #潜在收费
                    if (!empty($v2['potential_content'])) {
                        $children['potential_content'] = json_decode($v2['potential_content'], true);
                    }
                    #监管文件
                    if (!empty($v2['file'])) {
                        $children['file'] = json_decode($v2['file'], true);
                    }
                    #增值服务
                    if (!empty($v2['services'])) {
                        $children['services'] = json_decode($v2['services'], true);
                    }
                    foreach ($v2['sku_info'] as $k4 => $v4) {
                        $children['sku_info'][$k4]['sku_info'] = Db::table('goods_sku')->where(['sku_id' => $v4['sku_id']])->first();
                        $children['sku_info'][$k4]['sku_info'] = objtoarr($children['sku_info'][$k4]['sku_info']);
                        if (isset($v4['odd_skuid']) || isset($v4['odd_goods_num']) || isset($v4['odd_reduction_money']) || isset($v4['odd_gift_money']) || isset($v4['odd_otherfee_total']) || isset($v4['odd_services_money'])) {
                            #当前规格有修改
                            if (!isset($v4['is_edit'])) {
                                $children['sku_info'][$k4]['is_edit'] = 1;
                            } else {
                                $children['sku_info'][$k4]['is_edit'] = 0;
                            }
                        } else {
                            #当前规格无修改
                            $children['sku_info'][$k4]['is_edit'] = 0;
                        }
                        $children['goods_info'] = $goods;
                    }
                    if (isset($shoper[$k3]['children']['goods_info'])) {
                        $shoper[$k3]['children']['goods_info'] = array_merge($shoper[$k3]['children']['goods_info'], [$goods]);
                    } else {
                        $children['goods_info'] = [$goods];
                    }

                    $shoper[$k3]['children'] = $children;
                }
            }
        }
        #供应商商品END===============================
//        dd($shoper);

        #清单信息START=========================
        foreach ($cart_buylist['content']['goods_info'] as $k2 => $v2) {
            $cart_buylist['content']['goods_info'][$k2]['goods_info'] = Db::table('goods')->where(['goods_id' => $v2['good_id']])->first();
            $cart_buylist['content']['goods_info'][$k2]['goods_info'] = objtoarr($cart_buylist['content']['goods_info'][$k2]['goods_info']);
            #其他费用
            if (!empty($v2['otherfee_content'])) {
                $cart_buylist['content']['goods_info'][$k2]['otherfee_content'] = json_decode($v2['otherfee_content'], true);
            }
            #减免优惠
            if (!empty($v2['reduction_content'])) {
                $cart_buylist['content']['goods_info'][$k2]['reduction_content'] = json_decode($v2['reduction_content'], true);
            }
            #随赠优惠
            if (!empty($v2['prefe_gift'])) {
                $cart_buylist['content']['goods_info'][$k2]['prefe_gift'] = json_decode($v2['prefe_gift'], true);
            }
            #价格未含
            if (!empty($v2['noinclude_content'])) {
                $cart_buylist['content']['goods_info'][$k2]['noinclude_content'] = json_decode($v2['noinclude_content'], true);
            }
            #潜在收费
            if (!empty($v2['potential_content'])) {
                $cart_buylist['content']['goods_info'][$k2]['potential_content'] = json_decode($v2['potential_content'], true);
            }
            #监管文件
            if (!empty($v2['file'])) {
                $cart_buylist['content']['goods_info'][$k2]['file'] = json_decode($v2['file'], true);
            }
            #增值服务
            if (!empty($v2['services'])) {
                $cart_buylist['content']['goods_info'][$k2]['services'] = json_decode($v2['services'], true);

                #更多服务
                $cart_buylist['content']['goods_info'][$k2]['services_money'] = 0;
                foreach ($cart_buylist['content']['goods_info'][$k2]['services'] as $k3 => $v3) {
                    $services = Db::table('goods_services')->where(['id' => $v3['service_id']])->first();
                    $services = objtoarr($services);
                    if ($services['type'] == 1) {
                        $cart_buylist['content']['goods_info'][$k2]['services'][$k3]['photoRequest'] = explode('@@@', rtrim($v3['photoRequest'], '@@@'));
                        if ($v3['photonum'] > $services['num']) {
                            $cart_buylist['content']['goods_info'][$k2]['services_money'] += $services['price'] + (($v3['photonum'] - 1) * $services['interval_price']);
                        }
                    } else {
                        $cart_buylist['content']['goods_info'][$k2]['services_money'] += $services['price'];
                    }
                }
            } else {
                $cart_buylist['content']['goods_info'][$k2]['services_money'] = 0;
            }

            foreach ($v2['sku_info'] as $k3 => $v3) {
                $cart_buylist['content']['goods_info'][$k2]['sku_info'][$k3]['sku_info'] = Db::table('goods_sku')->where(['sku_id' => $v3['sku_id']])->first();
                $cart_buylist['content']['goods_info'][$k2]['sku_info'][$k3]['sku_info'] = objtoarr($cart_buylist['content']['goods_info'][$k2]['sku_info'][$k3]['sku_info']);
                $cart_buylist['content']['goods_info'][$k2]['sku_info'][$k3]['sku_info']['sku_prices'] = json_decode($cart_buylist['content']['goods_info'][$k2]['sku_info'][$k3]['sku_info']['sku_prices'], true);
                if (isset($v3['odd_skuid']) || isset($v3['odd_goods_num']) || isset($v3['odd_reduction_money']) || isset($v3['odd_gift_money']) || isset($v3['odd_otherfee_total']) || isset($v3['odd_services_money'])) {
                    #当前规格有修改
                    if (!isset($v3['is_edit'])) {
                        $cart_buylist['content']['goods_info'][$k2]['sku_info'][$k3]['is_edit'] = 1;
                    } else {
                        $cart_buylist['content']['goods_info'][$k2]['sku_info'][$k3]['is_edit'] = 0;
                    }
                } else {
                    #当前规格无修改
                    $cart_buylist['content']['goods_info'][$k2]['sku_info'][$k3]['is_edit'] = 0;
                }
            }
        }
        #清单信息END===========================
//        dd($shoper,$cart_buylist);

        #获取配置信息
        $website = get_website();
        $page_info = get_pageinfo('/cart.html?selected=1');
        $website['background'] = $page_info['content']['background'];
        $website['content'] = $page_info['content']['content'];
        $website['fontcolor'] = $page_info['content']['fontcolor'];

        $origin_page = '/cart/cart_detail?id=' . $order_id;

        $is_inner=1;#内页打开首页头部，不显示消息轮播框

        $compact = compact('website', 'isframe', 'cart_buylist', 'shoper', 'origin_page', 'is_inner');
//        dd($shoper,$cart_buylist['content']['goods_info']);
        return view('cart.cart_detail', $compact);
    }

    #创建请求支付单
    public function create_order(Request $request)
    {
        $data = $request->except(['_token']);
        $order_id = intval($data['oid']);
        $type = intval($data['typ']);
        
        if ($type==1) {
            #申请订购
            $sku_ids = explode(',', rtrim($data['sku_ids'], ','));#购买的商品规格信息
            $order = Db::connection('shop_db')->table('website_order_list')->where(['id'=>$order_id])->first();
            $order = objtoarr($order);
            $order['content'] = json_decode($order['content'], true);

            #记录购买商品字段哪个要买哪个不买
            foreach ($order['content']['goods_info'] as $k=>$v) {
                foreach ($v['sku_info'] as $k2=>$v2) {
                    if (in_array($v2['sku_id'], $sku_ids)) {
                        $order['content']['goods_info'][$k]['sku_info'][$k2]['is_buy'] = 1;
                    } else {
                        $order['content']['goods_info'][$k]['sku_info'][$k2]['is_buy'] = 0;
                    }
                }
            }

            #1、将购买记录，记录在表中
            Db::connection('shop_db')->table('website_order_list')->where(['id'=>$order_id])->update(['content'=>json_encode($order['content'], true),'status'=>-13]);

            #2、通知管理员，下发支付消息
            shuntWechat([
                'first' => '订购清单[' . $order['ordersn'] . ']',
                'keyword1' => '订购清单[' . $order['ordersn'] . ']',
                'keyword2' => '请求支付',
                'remark' => '进入总后台，查看详情',
                'url' => 'https://gadmin.gogo198.cn',
                'temp_id' => 'SVVs5OeD3FfsGwW0PEfYlZWetjScIT8kDxht5tlI1V8'
            ]);

            return Response()->json(['code'=>0,'msg'=>'请求成功，请留意消息通知']);
        }
        elseif ($type==2) {
            #立即支付

            #用户身份认证
//            $token = objtoarr();
            $pay_id = intval($data['pay_id']);
            $cash_on_delivery_sel = intval($data['cash_on_delivery']);

            #订单信息
            $order = Db::connection('shop_db')->table('website_order_list')->where(['id'=>$order_id])->first();
            $order = objtoarr($order);

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

            $settlement = Db::table('settlement')->where(['id'=>$pay_id])->first();
            $settlement = objtoarr($settlement);
            $settlement['service_charge'] = json_decode($settlement['service_charge'], true);

            #当前通道费率信息
            $exchange_money=0;#将订单金额换算为通道金额后的金额
            foreach ($settlement['service_charge'] as $k3=>$v3) {
                if ($order['currency'] == $settlement['currency']) {
                    #订单币种=通道币种均为CNY，无需换算
                    if ($v3['end_type']==1) {
                        #数值
                        if ($v3['start_money']<=$order['true_money'] && $order['true_money']<$v3['end_money']) {
                            if ($v3['charge_type']==1) {
                                #按额
                                $settlement['rate_money'] = $order['true_money'] * ($v3['charge_num'] / 100);
                            } elseif ($v3['charge_type']==2) {
                                #按笔
                                $settlement['rate_money'] = $v3['charge_num'];
                            }
                            break;
                        }
                    } elseif ($v3['end_type']==2) {
                        #以上
                        if ($v3['start_money']<=$order['true_money']) {
                            if ($v3['charge_type']==1) {
                                #按额
                                $settlement['rate_money'] = $order['true_money'] * ($v3['charge_num'] / 100);
                            } elseif ($v3['charge_type']==2) {
                                #按笔
                                $settlement['rate_money'] = $v3['charge_num'];
                            }
                            break;
                        } else {
                            #不符合条件
                            $settlement['rate_money'] = 0;
//                            $settlement['rate_money'] = '金额不符合条件';
                            break;
                        }
                    } else {
                        #不符合条件
                        $settlement['rate_money'] = 0;
//                        $settlement['rate_money'] = '金额不符合条件';
                        break;
                    }
                } else {
                    #订单币种!=通道币种
                    if ($order['currency']==5) {
                        #订单币种为CNY，需要将订单币种换成通道币种金额
                        $currency = Db::connection('shop_db')->table('centralize_currency')->where(['id' => $settlement['currency']])->first()->currency_symbol_standard;
                        $other_currency_rate = Db::connection('shop_db')->table('website_exchange_rate')->where(['symbol' => $currency])->first();

                        #通道实付费用
                        $settlement['true_money'] = 0;

                        if (!empty($other_currency_rate)) {
                            $exchange_money = $order['true_money'] * $other_currency_rate->rate;#换算为通道的金额

                            #通道手续费
                            if ($v3['end_type']==1) {
                                #数值
                                if ($v3['start_money']<=$exchange_money && $exchange_money<$v3['end_money']) {
                                    if ($v3['charge_type']==1) {
                                        #按额
                                        $settlement['rate_money'] = $exchange_money * ($v3['charge_num'] / 100);
                                    } elseif ($v3['charge_type']==2) {
                                        #按笔
                                        $settlement['rate_money'] = $v3['charge_num'];
                                    }
                                    break;
                                }
                            } elseif ($v3['end_type']==2) {
                                #以上
                                if ($v3['start_money']<=$exchange_money) {
                                    if ($v3['charge_type']==1) {
                                        #按额
                                        $settlement['rate_money'] = $exchange_money * ($v3['charge_num'] / 100);
                                    } elseif ($v3['charge_type']==2) {
                                        #按笔
                                        $settlement['rate_money'] = $v3['charge_num'];
                                    }
                                    break;
                                } else {
                                    #不符合条件
                                    $settlement['rate_money'] = 0;
//                                    $settlement['rate_money'] = '金额不符合条件';
                                    break;
                                }
                            } else {
                                #不符合条件
                                $settlement['rate_money'] = 0;
//                                $settlement['rate_money'] = '金额不符合条件';
                                break;
                            }
                        }
                    } else {
                        #订单币种为其他币种，暂时未有（待做）
                        $settlement['rate_money'] = 0;
                        break;
                    }
                }
            }

            #通道实付费用=订单换算金额+订单换算手续费金额
            if ($order['currency'] == $settlement['currency']) {
                #订单币种=通道币种
                #实付费用
                $settlement['true_money'] = $order['true_money'] + floatval($settlement['rate_money']);
                #订单费用
                $settlement['order_money'] = $order['true_money'];
            } else {
                #订单币种!=通道币种
                #实付费用
                $settlement['true_money'] = $exchange_money + floatval($settlement['rate_money']);
                #订单费用
                $settlement['order_money'] = $exchange_money;
            }

            #若是货到付款，则判断和计算================start
            if ($cash_on_delivery_sel==2) {
                #货到付款
                if ($cash_on_delivery['down_payment'] == 1) {
                    #不需要定金/通道实付费用
                    $settlement['true_money2'] = 0;
                } elseif ($cash_on_delivery['down_payment']==2) {
                    #需要定金
                    if ($cash_on_delivery['prepaid_method'] == 1) {
                        #按比例
                        #1、找到商品相应数量价格
                        $goods_total = 0;
                        foreach ($order['content']['goods_info'] as $k=>$v) {
                            foreach ($v['sku_info'] as $k2=>$v2) {
                                $goods_total += $v2['price'];#已计算商品单价*数量=商品规格总价
                            }
                        }
                        #2、计算定金
                        $goods_total = $goods_total * ($cash_on_delivery['prepaid_percent'] / 100);//100*0.03
                        #3、计算定金+通道费用
                        foreach ($settlement['service_charge'] as $k3=>$v3) {
                            if ($order['currency'] == $settlement['currency']) {
                                #订单币种=通道币种均为CNY，无需换算
                                if ($v3['end_type']==1) {
                                    #数值
                                    if ($v3['start_money']<=$goods_total && $goods_total<$v3['end_money']) {
                                        if ($v3['charge_type']==1) {
                                            #按额
                                            $settlement['rate_money2'] = $goods_total * ($v3['charge_num'] / 100);
                                        } elseif ($v3['charge_type']==2) {
                                            #按笔
                                            $settlement['rate_money2'] = $v3['charge_num'];
                                        }
                                        break;
                                    }
                                } elseif ($v3['end_type']==2) {
                                    #以上
                                    if ($v3['start_money']<=$goods_total) {
                                        if ($v3['charge_type']==1) {
                                            #按额
                                            $settlement['rate_money2'] = $goods_total * ($v3['charge_num'] / 100);
                                        } elseif ($v3['charge_type']==2) {
                                            #按笔
                                            $settlement['rate_money2'] = $v3['charge_num'];
                                        }
                                        break;
                                    } else {
                                        #不符合条件
                                        $settlement['rate_money2'] = 0;
//                            $settlement['rate_money'] = '金额不符合条件';
                                        break;
                                    }
                                } else {
                                    #不符合条件
                                    $settlement['rate_money2'] = 0;
//                        $settlement['rate_money'] = '金额不符合条件';
                                    break;
                                }
                            } else {
                                #订单币种!=通道币种
                                if ($order['currency']==5) {
                                    #订单币种为CNY，需要将订单币种换成通道币种金额
                                    $currency = Db::connection('shop_db')->table('centralize_currency')->where(['id' => $settlement['currency']])->first()->currency_symbol_standard;
                                    $other_currency_rate = Db::connection('shop_db')->table('website_exchange_rate')->where(['symbol' => $currency])->first();

                                    #通道实付费用
                                    $settlement['true_money2'] = 0;

                                    if (!empty($other_currency_rate)) {
                                        $exchange_money = $goods_total * $other_currency_rate->rate;#换算为通道的金额

                                        #通道手续费
                                        if ($v3['end_type']==1) {
                                            #数值
                                            if ($v3['start_money']<=$exchange_money && $exchange_money<$v3['end_money']) {
                                                if ($v3['charge_type']==1) {
                                                    #按额
                                                    $settlement['rate_money2'] = $exchange_money * ($v3['charge_num'] / 100);
                                                } elseif ($v3['charge_type']==2) {
                                                    #按笔
                                                    $settlement['rate_money2'] = $v3['charge_num'];
                                                }
                                                break;
                                            }
                                        } elseif ($v3['end_type']==2) {
                                            #以上
                                            if ($v3['start_money']<=$exchange_money) {
                                                if ($v3['charge_type']==1) {
                                                    #按额
                                                    $settlement['rate_money2'] = $exchange_money * ($v3['charge_num'] / 100);
                                                } elseif ($v3['charge_type']==2) {
                                                    #按笔
                                                    $settlement['rate_money2'] = $v3['charge_num'];
                                                }
                                                break;
                                            } else {
                                                #不符合条件
                                                $settlement['rate_money2'] = 0;
//                                    $settlement['rate_money'] = '金额不符合条件';
                                                break;
                                            }
                                        } else {
                                            #不符合条件
                                            $settlement['rate_money2'] = 0;
//                                $settlement['rate_money'] = '金额不符合条件';
                                            break;
                                        }
                                    }
                                } else {
                                    #订单币种为其他币种，暂时未有（待做）
                                    $settlement['rate_money'] = 0;
                                    break;
                                }
                            }
                        }

                        #4、通道支付金额
                        $settlement['true_money2'] = round($goods_total + $settlement['rate_money2'], 2);
                    } elseif ($cash_on_delivery['prepaid_method']==2) {
                        #按定额
                        $settlement['true_money2'] = $cash_on_delivery['prepaid_amount'];
                    }
                }
            }
            #若是货到付款，则判断和计算================end

//            dd($settlement);
            DB::beginTransaction();
            try {
                #1.1、修改订购清单最终购买的商品、状态、金额、订单编号
                $user = get_userid();#官网用户id
                if (empty($user->openid) && empty($user->sns_openid)) {
                    return Response()->json(['code'=>-1,'msg'=>'请先关注“Gogo購購网”微信公众号']);
                }

                $new_ordersn = get_ordersn(3);#支付单编号
                $system = Db::connection('shop_db')->table('centralize_system_notice')->where(['uid'=>0])->first();
                $system = objtoarr($system);

                $pay_money = 0;#本次实际支付金额
                if ($cash_on_delivery_sel==2) {
                    #货到付款
                    $pay_money = $settlement['true_money2'];

                    Db::connection('shop_db')->table('website_order_list')->where(['id' => $order_id])->update([
                        'ordersn' => $new_ordersn,
                        'status' => 0,
                        'prepaid_money'=>$settlement['true_money2'],#预付金额
                        'remain_money'=>$settlement['true_money'] - $settlement['true_money2'],#剩余金额
                        'final_money' => $settlement['true_money'],#实际需付金额
                    ]);
                } else {
                    #不是货到付款
                    $pay_money = $settlement['true_money'];
                    Db::connection('shop_db')->table('website_order_list')->where(['id' => $order_id])->update([
                        'ordersn' => $new_ordersn,
                        'status' => 0,
                        'final_money' => $settlement['true_money']
                    ]);
                }

                #2、创建国内结算二维码
                $time = time();
                $ordersn = 'GP' . date('YmdH', $time) . str_pad(
                    mt_rand(1, 999999),
                    6,
                    '0',
                    STR_PAD_LEFT
                ) . substr(microtime(), 2, 6);
                $collect_id = Db::connection('shop_db')->table('customs_collection')->insertGetId([
                    'uniacid' => 3,
                    'openid' => $user->openid,
                    'send_openid' => $system['account'],#到时候换老板的微信
                    'ordersn' => $ordersn,
                    'trade_price' => $pay_money,
                    'trade_type' => 3,
                    'service_info' => json_encode(['订单支付,编号：' . $new_ordersn . ',' . $pay_money], true),
                    'order_type' => 1,
                    'good_id' => '',
                    'payer_name' => !empty($user->realname) ? $user->realname : $user->nickname,
                    'payer_tel' => !empty($user->phone) ? $user->phone : '',
                    'pay_term' => 0,
                    'pay_fee' => 0,
                    'overdue' => '',
                    'overdue_money' => 0,
                    'total_money' => $pay_money,
                    'trans_form' => 1,
                    'status' => 0,
                    'basic' => 2,
                    'pay_type'=>$settlement['pay_id'],#支付方式
                    'createtime' => $time,
                    'orderno' => $new_ordersn,
                    'orderurl' => 'https://www.gogo198.cn/cart/cart_detail?id=' . $order_id
                ]);

                sleep(1);
                $res = Db::connection('shop_db')->table('website_order_list')->where(['id' => $order_id])->update([
                    'pay_id' => $collect_id,
                ]);

                if ($res) {
                    $code_url = $this->create_code(1, $collect_id, $order_id);

                    sleep(1);
                    Db::connection('shop_db')->table('website_order_list')->where(['id' => $order_id])->update([
                        'code_url' => $code_url
                    ]);

                    Db::connection('shop_db')->table('member_coupon_info')->where(['id'=>$order['coupon_id']])->update(['status'=>1]);#创建订单后，将优惠券使用状态变成1（已使用）

                    DB::commit();
                    return response()->json(['code'=>0,'msg'=>'提交支付成功','data'=>['code_url'=>$code_url,'pay_id'=>$collect_id]]);
                }
            } catch (\Exception $e) {
                DB::rollBack();
                echo $e->getMessage();
                echo $e->getCode();
                return response()->json(['code'=>-1,'msg'=>'系统错误，请联系管理员']);
            }
        }
        elseif ($type==3) {
            #查看支付二维码
            $order = Db::connection('shop_db')->table('website_order_list')->where(['id'=>$order_id])->first();
            $order = objtoarr($order);
            return response()->json(['code'=>0,'msg'=>'提交支付成功','data'=>['code_url'=>$order['code_url']]]);
        }
        elseif ($type==4) {
            #查看是否已支付，则跳转
            $order = Db::connection('shop_db')->table('website_order_list')->where(['id'=>$order_id])->first();
            if($order->status==1){
                #已付款待采购
                return Response()->json(['code'=>0,'msg'=>'已支付，正在跳转订单详情页面']);
            }else{
                return Response()->json(['code'=>-1,'msg'=>'还没有支付，继续刷新']);
            }
        }
    }

    #创建请求支付单（废弃）
    public function create_order2(Request $request)
    {
        $data = $request->except(['_token']);
        $order_id = intval($data['oid']);
        $type = intval($data['typ']);
        
        if ($type==1) {
            $sku_ids = explode(',', rtrim($data['sku_ids'], ','));
            $cart_ids = explode(',', rtrim($data['cart_ids'], ','));
            $goods_ids = explode(',', rtrim($data['goods_ids'], ','));
            $sku_nums = explode(',', rtrim($data['sku_nums'], ','));

            #1、修改订购清单为商品订单，看看哪个商品规格下最终没有订购的，就设置is_close=1
            $order = Db::connection('shop_db')->table('website_order_list')->where(['id'=>$order_id])->first();
            $order = objtoarr($order);
            $order['content'] = json_decode($order['content'], true);
//        dd($order['content']);
            $total_money = 0;
            $already_buy_goods = [];#已计算过服务费用的商品id
            foreach ($order['content']['goods_info'] as $k=>$v) {
                foreach ($v['sku_info'] as $k2=>$v2) {
                    foreach ($sku_ids as $k3=>$v3) {
                        if (isset($order['content']['goods_info'][$k]['sku_info'][$k2])) {
                            if (!isset($order['content']['goods_info'][$k]['sku_info'][$k2]['is_close'])) {
                                $order['content']['goods_info'][$k]['sku_info'][$k2]['is_close']=1;
                            }
                            if ($v3==$v2['sku_id']) {
                                $order['content']['goods_info'][$k]['sku_info'][$k2]['is_close']=0;
                                $reduction_money = 0;
                                $gift_money = 0;
                                $otherfee_total = 0;
                                $services_money = 0;
                                if (!in_array($v['good_id'], $already_buy_goods)) {
                                    #减免金额
                                    $reduction_money = $v['reduction_money'];
                                    #随赠金额
                                    $gift_money = $v['gift_money'];
                                    #其他费用金额
                                    $otherfee_total = $v['otherfee_total'];
                                    #服务费用金额
                                    if (isset($v['services_money'])) {
                                        $services_money = $v['services_money'];
                                    } else {
                                        $services = json_decode($v['services'], true);
                                        $services_money = 0;
                                        foreach ($services as $k4=>$v4) {
                                            $services2 = Db::table('goods_services')->where(['id'=>$v4['service_id']])->first();
                                            $services2 = objtoarr($services2);
                                            if ($v4['service_id']==1) {
                                                if ($v4['photonum']>1) {
                                                    $services_money += $services2['price'] + (($v4['photonum'] - 1) * $services2['interval_price']);
                                                }
                                            } else {
                                                $services_money += $services2['price'];
                                            }
                                        }
                                    }
                                    $already_buy_goods = array_merge($already_buy_goods, [$v['good_id']]);
                                }
                                $total_money += sprintf('%.2f', $v2['price'] - $reduction_money - $gift_money + $otherfee_total + $services_money);
                            }
                        }
                    }
                }
            }

            DB::beginTransaction();
            try {
                #1.1、修改订购清单最终购买的商品、状态、金额、订单编号
                $user = get_userid();#官网用户id
                if (empty($user->openid) && empty($user->sns_openid)) {
                    return Response()->json(['code'=>-1,'msg'=>'请先关注“Gogo購購网”微信公众号']);
                }
                $new_ordersn = get_ordersn(3);#支付单编号
                Db::connection('shop_db')->table('website_order_list')->where(['id' => $order_id])->update([
                    'ordersn' => $new_ordersn,
                    'content' => json_encode($order['content'], true),
                    'status' => 0,
                    'true_money' => $total_money
                ]);

                $system = Db::connection('shop_db')->table('centralize_system_notice')->where(['uid'=>0])->first();
                $system = objtoarr($system);

                #2、创建国内结算二维码
                $time = time();
                $ordersn = 'GP' . date('YmdH', $time) . str_pad(
                    mt_rand(1, 999999),
                    6,
                    '0',
                    STR_PAD_LEFT
                ) . substr(microtime(), 2, 6);
                $collect_id = Db::connection('shop_db')->table('customs_collection')->insertGetId([
                    'uniacid' => 3,
                    'openid' => $user->openid,
                    'send_openid' => $system['account'],#到时候换老板的微信
                    'ordersn' => $ordersn,
                    'trade_price' => $total_money,
                    'trade_type' => 3,
                    'service_info' => json_encode(['订购清单支付,编号：' . $new_ordersn . ',' . $total_money], true),
                    'order_type' => 1,
                    'good_id' => '',
                    'payer_name' => !empty($user->realname) ? $user->realname : $user->nickname,
                    'payer_tel' => !empty($user->phone) ? $user->phone : '',
                    'pay_term' => 0,
                    'pay_fee' => 0,
                    'overdue' => '',
                    'overdue_money' => 0,
                    'total_money' => $total_money,
                    'trans_form' => 1,
                    'status' => 0,
                    'basic' => 2,
                    'createtime' => $time,
                    'orderno' => $new_ordersn,
                    'orderurl' => 'https://www.gogo198.cn/cart/cart_detail?id=' . $order_id
                ]);

                sleep(1);
                $res = Db::connection('shop_db')->table('website_order_list')->where(['id' => $order_id])->update([
                    'pay_id' => $collect_id
                ]);

                if ($res) {
                    $code_url = $this->create_code(1, $collect_id, $order_id);

                    sleep(1);
                    Db::connection('shop_db')->table('website_order_list')->where(['id' => $order_id])->update([
                        'code_url' => $code_url
                    ]);

                    DB::commit();
                    return response()->json(['code'=>0,'msg'=>'提交支付成功','data'=>['code_url'=>$code_url]]);
                }
            } catch (\Exception $e) {
                DB::rollBack();
                echo $e->getMessage();
                echo $e->getCode();
                return response()->json(['code'=>-1,'msg'=>'系统错误，请联系管理员']);
            }
        } elseif ($type==2) {
            #查看支付二维码
            $order = Db::connection('shop_db')->table('website_order_list')->where(['id'=>$order_id])->first();
            $order = objtoarr($order);
            return response()->json(['code'=>0,'msg'=>'提交支付成功','data'=>['code_url'=>$order['code_url']]]);
        }
    }

    #获取支付订单信息
    public function pay_order(Request $request)
    {
        $data = $request->except(['_token']);
        $order_id = intval($data['oid']);
        $isframe = isset($dat['isframe']) ? intval($data['isframe']) : 0;

        #临时加上====start
        $cart_buylist = Db::connection('shop_db')->table('website_order_list')->where(['id'=>$order_id])->first();
        $cart_buylist = objtoarr($cart_buylist);
        $cart_buylist['content'] = json_decode($cart_buylist['content'], true);
        #收货地址START=========================
        if (!empty($cart_buylist['edit_address'])) {
            $cart_buylist['edit_address'] = json_decode($cart_buylist['edit_address'], true);
        } else {
            $cart_buylist['address'] = Db::connection('shop_db')->table('centralize_user_address')->where(['id'=>$cart_buylist['content']['address_id']])->first();
            $cart_buylist['address'] = objtoarr($cart_buylist['address']);
            $cart_buylist['address']['postal_code'] = json_decode($cart_buylist['address']['postal_code'], true);
            $cart_buylist['address']['postal'] = '';
            foreach ($cart_buylist['address']['postal_code'] as $k2=>$v2) {
                $cart_buylist['address']['postal'] .= $v2;
            }
            $country = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['id'=>$cart_buylist['address']['country_id']])->first()->param2;#国
            $province = '';
            if (!empty($cart_buylist['address']['province'])) {
                $province = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$cart_buylist['address']['province']])->first()->code_name;#省
            }
            $city = '';
            if (!empty($cart_buylist['address']['city'])) {
                $city = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$cart_buylist['address']['city']])->first()->code_name;#市
            }
            $area_info = '';
            $area_info2 = '';
            $area_info3 = '';
            $area_info4 = '';
            if (!empty($cart_buylist['address']['area'])) {
                $area_info = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$cart_buylist['address']['area']])->first()->code_name;#区1
            }
            if (!empty($cart_buylist['address']['area2'])) {
                $area_info2 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id' => $cart_buylist['address']['area2']])->first()->code_name;#区2
            }
            if (!empty($cart_buylist['address']['area3'])) {
                $area_info3 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id' => $cart_buylist['address']['area3']])->first()->code_name;#区3
            }
            if (!empty($cart_buylist['address']['area4'])) {
                $area_info4 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id' => $cart_buylist['address']['area4']])->first()->code_name;#区4
            }

            $cart_buylist['address']['address2'] = json_decode($cart_buylist['address']['address2'], true);
            $address2 = '';
            if (!empty($cart_buylist['address']['address2'])) {
                foreach ($cart_buylist['address']['address2'] as $k2 => $v2) {
                    $address2 .= $v2;
                }
            }

            $cart_buylist['address']['address'] = $country.$province.$city.$area_info.$area_info2.$area_info3.$area_info4.$cart_buylist['address']['address1'].$address2;
        }
        #收货地址END===========================

        #清单信息START=========================
        foreach ($cart_buylist['content']['goods_info'] as $k2=>$v2) {
            $cart_buylist['content']['goods_info'][$k2]['goods_info'] = Db::table('goods')->where(['goods_id'=>$v2['good_id']])->first();
            $cart_buylist['content']['goods_info'][$k2]['goods_info'] = objtoarr($cart_buylist['content']['goods_info'][$k2]['goods_info']);
            if (!empty($v2['prefe_reduction'])) {
                $cart_buylist['content']['goods_info'][$k2]['prefe_reduction'] = json_decode($v2['prefe_reduction'], true);
            }
            if (!empty($v2['prefe_gift'])) {
                $cart_buylist['content']['goods_info'][$k2]['prefe_gift'] = json_decode($v2['prefe_gift'], true);
            }
            if (!empty($v2['otherfee_content'])) {
                $cart_buylist['content']['goods_info'][$k2]['otherfee_content'] = json_decode($v2['otherfee_content'], true);
            }
            if (!empty($v2['file'])) {
                $cart_buylist['content']['goods_info'][$k2]['file'] = json_decode($v2['file'], true);
            }
            if (!empty($v2['services'])) {
                $cart_buylist['content']['goods_info'][$k2]['services'] = json_decode($v2['services'], true);
            }
            foreach ($v2['sku_info'] as $k3=>$v3) {
                $cart_buylist['content']['goods_info'][$k2]['sku_info'][$k3]['sku_info'] = Db::table('goods_sku')->where(['sku_id'=>$v3['sku_id']])->first();
                $cart_buylist['content']['goods_info'][$k2]['sku_info'][$k3]['sku_info'] = objtoarr($cart_buylist['content']['goods_info'][$k2]['sku_info'][$k3]['sku_info']);
                if (isset($v3['odd_skuid']) || isset($v3['odd_goods_num']) || isset($v3['odd_reduction_money']) || isset($v3['odd_gift_money']) || isset($v3['odd_otherfee_total']) || isset($v3['odd_services_money'])) {
                    #当前规格有修改
                    if (!isset($v3['is_edit'])) {
                        $cart_buylist['content']['goods_info'][$k2]['sku_info'][$k3]['is_edit']=1;
                    } else {
                        $cart_buylist['content']['goods_info'][$k2]['sku_info'][$k3]['is_edit']=0;
                    }
                } else {
                    #当前规格无修改
                    $cart_buylist['content']['goods_info'][$k2]['sku_info'][$k3]['is_edit']=0;
                }
            }
        }
        #清单信息END===========================
//        foreach($order['content']['goods_info'] as $k=>$v){
//            foreach($v['sku_info'] as $k2=>$v2){
//                if($v2['is_close']==0){
//                    Db::table('order_goods_list')->insert([
//                        'order_id'=>$order_id,
//                        'goods_id'=>$v['good_id'],
//                        'sku_id'=>$v2['sku_id'],
//                        'goods_num'=>$v2['goods_num'],
//                        'goods_price'=>$v2['price'],
//                    ]);
//                }
//            }
//        }
        #临时加上====end

        #获取支付单
        $payorder = Db::connection('shop_db')->table('customs_collection')->where(['id'=>$cart_buylist['pay_id']])->first();
        $payorder = objtoarr($payorder);
        $payorder['paytime'] = date('Y-m-d H:i:s', $payorder['paytime']);
        $payorder['currency'] = 'CNY';
        if ($payorder['pay_type']==1) {
            $payorder['pay_methodName'] = '微信支付';
        } elseif ($payorder['pay_type']==2) {
            $payorder['pay_methodName'] = '支付宝支付';
        } elseif ($payorder['pay_type']==3) {
            $payorder['pay_methodName'] = '其他支付';
        }
        $payorder['weifu'] = 0;

        #获取配置信息
        $website = get_website();
        $page_info = get_pageinfo('/cart.html?selected=1');
        $website['background'] = $page_info['content']['background'];
        $website['content'] = $page_info['content']['content'];
        $website['fontcolor'] = $page_info['content']['fontcolor'];

        $compact = compact('website', 'isframe', 'cart_buylist', 'payorder');
        return view('cart.pay_order', $compact);
    }

    #创建国内结算二维码
    public function create_code($type=0, $orderid=0, $order_id=0)
    {
        if ($type==1) {
            $url = 'https://shop.gogo198.cn/app/index.php?i=3&c=entry&do=member&p=custompayment&m=sz_yi&oid='.intval($orderid);
            #生成报价二维码
            $folder = $_SERVER['DOCUMENT_ROOT'].'/qrcode/pay_order_qrcode/';
            $name = 'order_'.session('user.user_id').'_'.$order_id;
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
//        Header("Content-type: image/png");

        $qrcode = str_replace('/www/wwwroot/shopping.gogo198.cn/public', 'https://api.gogo198.cn', $filename);
        return $qrcode;
    }

    public function isParamIn2DArray($param, $array)
    {
        foreach ($array as $subArray) {
            if (in_array($param, $subArray)) {
                return true;
            }
        }
        return false;
    }

    /**
     * 购物车盒子数据
     *
     * todo 待完成 购物车表需要重建 2018.11.25
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function boxGoodsList(Request $request)
    {
        $this->cart->setUserId($this->user_id);
//            $this->cart->setUniqueId(session()->getId());
        $this->cart->setUniqueId($this->session_id);
        $cart_list = $this->cart->getCartList(); // 购物车数据
        $cart_price_info = $this->cart->getCartPriceInfo($cart_list);

        if (!is_mobile() && !is_app()) { // PC 端

            $renderTop = view('cart.dropdown_goods', compact('cart_list', 'cart_price_info'))->render(); // 顶部购物车
            $renderRight = view('cart.cart_pannel', compact('cart_list', 'cart_price_info'))->render(); // 右侧购物车
            $data = [
                $renderTop,
                $renderRight
            ];
            $extra = [
                'amount' => $cart_price_info['total_fee'],
                'count' => $this->cart_goods_num
            ];

            return result(0, $data, '', $extra);
        } elseif (is_mobile()) { // 微信端

            $extra = [
                'amount' => $cart_price_info['total_fee'],
                'count' => $this->cart_goods_num,
                'dif_price' => '-22221',
                'dif_price_format' => '￥-22221.00',
                'select_goods_number' => $cart_price_info['goods_number'],
                'start_price' => '1.00',
                'start_price_format' => '￥1.00'
            ];

            $render = view('cart.dropdown_goods', compact('cart_list', 'cart_price_info'))->render();


            return result(0, $render, '', $extra);
        }

        $compact = compact('seo_title');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [
                'count' => 2,
                'amount' => 23,
                'type' => 1,
                'cart_count' => 2,
                'select_goods_number' => 0,
                'select_goods_amount' => 0,
                'select_goods_amount_format' => '￥0',
                'amount_format' => '￥23',
                'cart_goods_list' => [],
                'start_price' => null,
                'start_price_format' => null,
                'dif_price' => null,
                'dif_price_format' => null
            ],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'brand.index'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 加入购物车
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function add(Request $request)
    {
        $goods_id = $request->post('goods_id', 0);
        $sku_id = $request->post('sku_id', 0);
        $number = $request->post('number');

        // 设置页面传入的参数
        $this->cart->setGoodsBuyNum($number);
        $this->cart->setUserId($this->user_id);
//        $this->cart->setUniqueId(session()->getId());
        $this->cart->setUniqueId($this->session_id);

        $goods_info = $this->goods->getById($goods_id);

        if ($sku_id) {
            // 有规格 选择了规格加入购物车操作
            $goods_id = $this->goods->getGoodsId($sku_id);
            $this->cart->setGoodsModel($goods_id);
            $this->cart->setGoodsSkuModel($sku_id);
            $data = [
                'sku_open' => 0
            ];
        } else {
            $this->cart->setGoodsModel($goods_id);
            $sku_id = $this->goods->getSkuId($goods_id);

            // 判断 如果有库存id 则弹出选择规格框
            if ($sku_id) {
                // 默认sku
                $default_sku = GoodsSku::where('sku_id', $sku_id)->first();
                $default_sku['specs'] = unserialize($default_sku['specs']);
                if (!empty($default_sku['specs'])) {
                    $uuid = make_uuid();
                    // 商品sku列表
                    $sku_list = $this->goods->getFrontendSkuList($goods_id);
                    $sku_list = json_encode($sku_list);

                    // 规格列表
                    $spec_list = $this->goods->getGoodsSpecList($goods_info);

                    $selected_spec_ids = !empty($default_sku['specs']) ? array_column($default_sku['specs'], 'attr_vid') : null;
                    $selected_spec_id = $selected_spec_ids[0];
                    $goods_images = $this->goods->getGoodsImages($goods_id, $selected_spec_id);
                    $default_sku['goods_image'] = $goods_images[0]['path'];

                    $compact = compact('uuid', 'default_sku', 'sku_list', 'spec_list', 'selected_spec_ids');
                    $render = view('cart.choose_sku', $compact)->render();
                    return result(98, $render);
                } else {
                    // 无规格 加入购物车操作
                    $data = null;
                }
            } else {
                // 无规格 加入购物车操作
                $data = null;
            }
        }

        $result = $this->cart->addGoodsToCart();

        if ($result['code'] != 0) {
            return result($result['code'], $data, $result['message']);
        }

        return result($result['code'], $data, $result['message']);
    }

    /**
     * 移除购物车
     *
     * @param Request $request
     * @return array
     */
    public function remove(Request $request)
    {
        $this->cart->setUserId($this->user_id);
//        $this->cart->setUniqueId(session()->getId());
        $this->cart->setUniqueId($this->session_id);

        $cart_ids = $request->input('cart_ids', 0);
        if (!$cart_ids) {
            return result(-1, null, '购物车编号错误');
        }
        $ret = $this->cart->delete($cart_ids);

        if ($ret === false) {
            return result(-1, null, '删除失败！');
        }
        $data = [
            'count' => 3,
            'goods_amount' => 5,
            'goods_number' => 1,
            'goods_price' => "5.00",
            'goods_price_format' => "￥0",
            'select_goods_amount' => 0,
            'select_goods_amount_format' => "￥0",
            'select_goods_number' => 0,
            'shop_delivery_enable' => [
                36 =>1
            ],
            'submit_enable' => 1
        ];
        return result(0, $data, '删除成功！');
    }

    public function delete(Request $request)
    {
        $data = $request->except(['_token']);
        $ip = $_SERVER['REMOTE_ADDR'];
        $user = $request->session()->get('user');
        $type = 4;

        if ($data['type']==0) {
            #从规格中删除
            $cart_id = intval($data['cart_id']);
            $sku_id = intval($data['sku_id']);

            $res = Db::table('cart_sku')->where(['cart_id'=>$cart_id,'sku_id'=>$sku_id])->delete();
            if ($res) {
                $count = Db::table('cart_sku')->where(['cart_id'=>$cart_id])->count();
                if (empty($count)) {
                    Db::table('cart')->where(['cart_id'=>$cart_id])->delete();
                }

                $sku_info = Db::table('goods_sku')->where(['sku_id'=>$sku_id])->first();
                log_user_behavior(['type'=>$type,'ip'=>$ip,'user'=>$user,'goods_id'=>$sku_info->goods_id]);

                return Response()->json(['code'=>0,'msg'=>'删除成功']);
            }
        } elseif ($data['type']==1) {
            #从购物车中删除
            $cart_id = intval($data['cart_id']);
            $res = Db::table('cart')->where(['cart_id'=>$cart_id])->delete();
            if ($res) {
                $all_sku = Db::table('cart_sku')->where(['cart_id'=>$cart_id])->get();
                $all_sku = objtoarr($all_sku);
                Db::table('cart_sku')->where(['cart_id'=>$cart_id])->delete();

                foreach ($all_sku as $k=>$v) {
                    $sku_info = Db::table('goods_sku')->where(['sku_id'=>$v['sku_id']])->first();
                    log_user_behavior(['type'=>$type,'ip'=>$ip,'user'=>$user,'goods_id'=>$sku_info->goods_id]);
                }

                return Response()->json(['code'=>0,'msg'=>'删除成功']);
            }
        } elseif ($data['type']==2) {
            #勾选sku删除
            $sku_ids = explode(',', rtrim($data['sku_ids'], ','));
            $cart_ids = explode(',', rtrim($data['cart_ids'], ','));
            foreach ($sku_ids as $k=>$v) {
                $cart_id = intval($cart_ids[$k]);
                $sku_id = intval($v);
                $res = Db::table('cart_sku')->where(['cart_id'=>$cart_id,'sku_id'=>$sku_id])->delete();
                if ($res) {
                    $count = Db::table('cart_sku')->where(['cart_id'=>$cart_id])->count();
                    if (empty($count)) {
                        Db::table('cart')->where(['cart_id'=>$cart_id])->delete();
                    }

                    $sku_info = Db::table('goods_sku')->where(['sku_id'=>$sku_id])->first();
                    log_user_behavior(['type'=>$type,'ip'=>$ip,'user'=>$user,'goods_id'=>$sku_info->goods_id]);
                }
            }
            return Response()->json(['code'=>0,'msg'=>'全部删除成功']);
        }
//        $this->cart->setUserId($this->user_id);
////        $this->cart->setUniqueId(session()->getId());
//        $this->cart->setUniqueId($this->session_id);
//
//        $cart_ids = $request->input('cart_ids', 0);
//        if (!$cart_ids) {
//            return result(-1, null, '购物车编号错误');
//        }
//        $ret = $this->cart->delete($cart_ids);
//
//        if ($ret === false) {
//            return result(-1, null, '删除失败！');
//        }
//        $this->getCartListData();
//
//        $render = view('cart.partials._cart_list')->render();
//        return result(0, $render, '删除成功！');
    }

    /**
     * 选中/取消选中购物车商品
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function select(Request $request)
    {
        $cart_ids = $request->post('cart_ids', '');

        $this->cart->setUserId($this->user_id);
//        $this->cart->setUniqueId(session()->getId());
        $this->cart->setUniqueId($this->session_id);
        // 选中购物车商品
        $selectRet = $this->cart->cartSelect($cart_ids);
        if ($selectRet['code'] == -1) {
            return result(-1, '', $selectRet['message']);
        }

        // 获取购物车信息
        $this->getCartListData();

        $render = view('cart.partials._cart_list')->render();
        $extra = [
            'params' => $selectRet['data']
        ];

        return result(0, $render, '', $extra);
    }

    /**
     * 获取购物车列表数据
     */
    private function getCartListData()
    {
        $this->cart->setUserId($this->user_id);
//        $this->cart->setUniqueId(session()->getId());
        $this->cart->setUniqueId($this->session_id);
        $cart_list = $this->cart->getCartList(); // 购物车数据
        // 购物车商品以店铺ID分组显示
        $shop_cart_list = [];
        foreach ($cart_list as $cart) {
            $cart['goods_total'] = $cart['goods_price'] * $cart['goods_number'];
            $shop_cart_list[$cart['shop_id']][] = $cart;
        }
        $cart_price_info = $this->cart->getCartPriceInfo($cart_list);
        view()->share('shop_cart_list', $shop_cart_list);
        view()->share('cart_price_info', $cart_price_info);
    }

    /**
     * 修改购物车商品数量
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function changeNumber(Request $request)
    {
        $sku_id = $request->input('sku_id');
        $number = $request->input('number');
        $cart_id = $request->input('cart_id');

        $ret = $this->cart->changeCartNum($sku_id, $number, $cart_id);
        if ($ret['code'] < 0) {
            $data = null;
        }
        $this->getCartListData();

        $data = view('cart.partials._cart_list')->render();
        return result($ret['code'], $data, $ret['message']);
    }

    /**
     * 购物车购买
     * 跳转到提交订单页面
     *
     * @param Request $request
     * @return array
     */
    public function goCheckout(Request $request)
    {
        if (!$this->user_id) {
            return result(99, null, '需要登录');
        }

        // 购买类型 0-加入购物车购买 1-立即购买 2-去结算 3-兑换 4-自由购 5-到店购 6-礼品提货
        // 将用户购买类型等信息存入session 方便checkout页面判断
        // 从购物车表中取当前登录用户的选中购物车商品列表
        $this->cart->setUserId($this->user_id);
//        $this->cart->setUniqueId(session()->getId());
        $this->cart->setUniqueId($this->session_id);
        $cart_list = $this->cart->getCartList(); // 购物车数据
//        $cart_price_info = $this->cart->getCartPriceInfo($cart_list);
        $cart_id = [];
        foreach ($cart_list as $v) {
            $cart_id[] = $v['cart_id'].'|'.$v['sku_id'].'|'.$v['goods_number'];
        }

        $userBuy = [
            'buy_type' => 0,
            'cart_id' => $cart_id
        ];
        session(['user_buy_'.$this->user_id => $userBuy]);
        $data = '/checkout.html'; // 提交订单页面url

        return result(0, $data);
    }

    /**
     * 直接购买
     * 跳转到提交订单页面
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function quickBuy(Request $request)
    {
        if (!$this->user_id) {
            return result(99, null, '需要登录');
        }

        $sku_id = $request->post('sku_id');
        $goods_id = $this->goods->getGoodsId($sku_id);
        $number = $request->post('number');
        $goods_info = $this->goods->getOnSaleGoodsInfo($goods_id, $sku_id, $number);

        if (empty($goods_info)) {
            // 商品不存在
            return result(-1, null, '商品不存在');
        }

//        return result(0,null,'请跳转到结算页！');


        $cart_id[] = $goods_id.'|'.$sku_id.'|'.$number;

        $userBuy = [
            'buy_type' => 1,
            'cart_id' => $cart_id
        ];

        // 购买类型 0-加入购物车购买 1-立即购买 2-去结算 3-兑换 4-自由购 5-到店购 6-礼品提货
        // 将用户购买类型等信息存入session 方便checkout页面判断
        session(['user_buy_'.$this->user_id => $userBuy]);

        $data = '/checkout.html'; // 提交订单页面url
        return result(0, $data);
    }

    /**
     * 将打包一口价商品加入到购物车
     * /frontend/web/index.php
     * /frontend/web_mobile/index.php
     *
     * @param Request $request
     * @return array
     */
    public function fixedPriceAdd(Request $request)
    {
        $goods_id_list = $request->post('goods_ids', []);
        $act_id = $request->post('act_id', null);
        if (empty($act_id) || empty($goods_id_list)) {
            abort(500, '无效的活动！');
        }
        $sku_ids = [];
        foreach ($goods_id_list as &$item) {
            $temp_list = explode(',', $item);
            foreach ($temp_list as &$value) {
                $temp_goods = explode('-', $value);
                $sku_ids[] = $temp_goods[1];
            }
        }

        $data = [
            'act_id' => $act_id,
            'sku_ids' => $sku_ids
        ];

        return result(0, $data, '加入购物车成功');
    }
}
