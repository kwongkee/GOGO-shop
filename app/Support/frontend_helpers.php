<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * 判断用户是否登录
 * 已登录 返回用户id
 *
 * @return bool|int|null
 */
function is_login()
{
    if (auth('user')->id()) {
        return auth('user')->id();
    } else {
        return false;
    }
}

/**
 * 获取商品一二三级分类
 *
 * @param int $parent_id 如果传入parent_id 则获取2 3级分类
 * @return array
 */
function get_goods_category_tree($parent_id = 0)
{
    $tree = $arr = $result = [];
    $query = \App\Models\Category::where('is_show', 1)
                ->select(['cat_id','cat_name','parent_id','cat_image','cat_letter','cat_level','take_rate','show_mode','show_virtual',
                    'keywords','discription','is_show','is_parent','cat_sort','ext_info','cat_link','image_link','code']);
    if ($parent_id) { // 获取1级分类下的2 3级分类
        $cat_ids = get_cat_grandson($parent_id);
        unset($cat_ids[0]);
        $query->whereIn('cat_id', $cat_ids);
    }

    $cat_list = $query->orderBy('cat_sort', 'asc')->get();
    if (!$cat_list->isEmpty()) {
        foreach ($cat_list as $val) {
            $val = $val->toArray();
            if ($val['cat_level'] == 2) {
                $arr[$val['parent_id']][] = $val;
            }
            if ($val['cat_level'] == 3) {
                $crr[$val['parent_id']][] = $val;
            }
            if ($val['cat_level'] == 1) {
                $tree[] = $val;
            }
        }

        foreach ($arr as $k=>$v) {
            foreach ($v as $kk=>$vv) {
                $arr[$k][$kk]['items'] = !empty($crr[$vv['cat_id']]) ? $crr[$vv['cat_id']] : [];
            }
        }

        foreach ($tree as $val) {
            $val['items'] = !empty($arr[$val['cat_id']]) ? $arr[$val['cat_id']] : [];
            $result[$val['cat_id']] = $val;
        }
    }
    if ($parent_id) { // 如果是获取1级分类的2 3级分类 返回
        return $arr;
    }
    return $result;
}

/**
 * 面包屑导航  用于前台商品
 * @param int $id 商品id  或者是 商品分类id
 * @param int $type 默认0是传递商品分类id  id 也可以传递 商品id type则为1
 * @return array
 */
function navigate_goods($id, $type = 0)
{
    $cat_id = $id;
    if ($type == 1) {
        $cat_id = \App\Models\Goods::where('cat_id', $id)->value('cat_id');
    }

    $catList = \App\Models\Category::where([['is_show', 1],['parent_id',0]])->select(['cat_id','cat_name','parent_id'])->get();

    $newCatList = [];

    foreach ($catList as $item) {
        $item = $item->toArray();

        $hasChild = \App\Models\Category::where([['is_show',1],['parent_id',$item['parent_id']],['cat_id', '!=', $item['cat_id']]])->select(['cat_id'])->get();

        $hasChild = count($hasChild) > 0 ? 1 : 0;
        $item['has_child'] = $hasChild;
        $newCatList[$item['cat_id']] = $item;
    }

    if ($type == 1) {
        $goods_name = \App\Models\Goods::where('cat_id', $id)->value('goods_name');
        $arr[] = [
            'cat_id' => $id,
            'cat_name' => $goods_name,
            'parent_id' => 0,
            'has_child' => 0,
            'type' => $type
        ];
    } else {
        $arr[] = [
            'cat_id' => $newCatList[$cat_id]['cat_id'],
            'cat_name' => $newCatList[$cat_id]['cat_name'],
            'parent_id' => $newCatList[$cat_id]['parent_id'],
            'has_child' => $newCatList[$cat_id]['has_child'],
            'type' => 0
        ];
    }

    while (true) {
        $cat_info = Db::table('category')->where('cat_id', $cat_id)->first();
//        $cat_id = $newCatList[$cat_id]['parent_id'];
        if ($cat_id > 0) {
            $arr[] = [
                'cat_id' => $cat_info->cat_id,
                'cat_name' => $cat_info->cat_name,
                'parent_id' => $cat_info->parent_id,
                'has_child' => 0,
                'type' => 0
            ];
            break;
        } else {
            break;
        }

//        $cat_id = $newCatList[$cat_id]['parent_id'];
//
//        if ($cat_id > 0) {
//            $arr[] = [
//                'cat_id' => $newCatList[$cat_id]['cat_id'],
//                'cat_name' => $newCatList[$cat_id]['cat_name'],
//                'parent_id' => $newCatList[$cat_id]['parent_id'],
//                'has_child' => $newCatList[$cat_id]['has_child'],
//                'type' => 0
//            ];
//        } else {
//            break;
//        }
    }
    $arr = array_values(array_reverse($arr, true));

    return $arr;
}

/**
 * 微信端 错误页面 获取底部导航菜单
 *
 * @return mixed
 */
function get_mobile_navigation()
{
    $template = new \App\Repositories\TemplateRepository();
    $navigation = $template->getNavigationData('m_site', 5, 3); // 底部导航菜单
    return $navigation;
}

/**
 * 检测是否使用手机访问
 * @access public
 * @return bool
 */
function is_mobile()
{
    return false;//20240228改
    if (isset($_SERVER['HTTP_VIA']) && stristr($_SERVER['HTTP_VIA'], "wap")) {
        return true;
    } elseif (isset($_SERVER['HTTP_ACCEPT']) && strpos(strtoupper($_SERVER['HTTP_ACCEPT']), "VND.WAP.WML")) {
        return true;
    } elseif (isset($_SERVER['HTTP_X_WAP_PROFILE']) || isset($_SERVER['HTTP_PROFILE'])) {
        return true;
    } elseif (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/(blackberry|configuration\/cldc|hp |hp-|htc |htc_|htc-|iemobile|kindle|midp|mmp|motorola|mobile|nokia|opera mini|opera |Googlebot-Mobile|YahooSeeker\/M1A1-R2D2|android|iphone|ipod|mobi|palm|palmos|pocket|portalmmm|ppc;|smartphone|sonyericsson|sqh|spv|symbian|treo|up.browser|up.link|vodafone|windows ce|xda |xda_)/i', $_SERVER['HTTP_USER_AGENT'])) {
        return true;
    } else {
        return false;
    }
}
function is_mobile2()
{
//    return false;//20240228改
    if (isset($_SERVER['HTTP_VIA']) && stristr($_SERVER['HTTP_VIA'], "wap")) {
        return true;
    } elseif (isset($_SERVER['HTTP_ACCEPT']) && strpos(strtoupper($_SERVER['HTTP_ACCEPT']), "VND.WAP.WML")) {
        return true;
    } elseif (isset($_SERVER['HTTP_X_WAP_PROFILE']) || isset($_SERVER['HTTP_PROFILE'])) {
        return true;
    } elseif (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/(blackberry|configuration\/cldc|hp |hp-|htc |htc_|htc-|iemobile|kindle|midp|mmp|motorola|mobile|nokia|opera mini|opera |Googlebot-Mobile|YahooSeeker\/M1A1-R2D2|android|iphone|ipod|mobi|palm|palmos|pocket|portalmmm|ppc;|smartphone|sonyericsson|sqh|spv|symbian|treo|up.browser|up.link|vodafone|windows ce|xda |xda_)/i', $_SERVER['HTTP_USER_AGENT'])) {
        return true;
    } else {
        return false;
    }
}

/**
 * 检测是否使用app访问
 *
 * @param string $clientType android-Android客户端、ios-iOS客户端、weapp-微信小程序端
 * @return bool
 */
function is_app($clientType = '')
{
    if ($clientType == 'android') {
        // Android
        if (
            (isset($_SERVER['HTTP_USER_AGENT']) && ($_SERVER['HTTP_USER_AGENT'] == 'lrwapp/android'))
            || (isset($_SERVER['HTTP_USER_ACCESS_AGENT']) && ($_SERVER['HTTP_USER_ACCESS_AGENT'] == 'lrwapp/android'))
        ) {
            return true;
        } else {
            return false;
        }
    } elseif ($clientType == 'ios') {
        // Ios
        if (
            (isset($_SERVER['HTTP_USER_AGENT']) && ($_SERVER['HTTP_USER_AGENT'] == 'lrwapp/ios'))
            || (isset($_SERVER['HTTP_USER_ACCESS_AGENT']) && ($_SERVER['HTTP_USER_ACCESS_AGENT'] == 'lrwapp/ios'))
        ) {
            return true;
        } else {
            return false;
        }
    } elseif ($clientType == 'weapp') {
        // weapp 微信小程序
        if (
            (isset($_SERVER['HTTP_USER_AGENT']) && ($_SERVER['HTTP_USER_AGENT'] == 'lrwapp/weapp'))
            || (isset($_SERVER['HTTP_USER_ACCESS_AGENT']) && ($_SERVER['HTTP_USER_ACCESS_AGENT'] == 'lrwapp/weapp'))
        ) {
            return true;
        } else {
            return false;
        }
    } else {
        // Android、Ios、weapp
        if (
            (isset($_SERVER['HTTP_USER_AGENT']) && ($_SERVER['HTTP_USER_AGENT'] == 'lrwapp/android'))
            || (isset($_SERVER['HTTP_USER_ACCESS_AGENT']) && ($_SERVER['HTTP_USER_ACCESS_AGENT'] == 'lrwapp/android'))
            || (isset($_SERVER['HTTP_USER_AGENT']) && ($_SERVER['HTTP_USER_AGENT'] == 'lrwapp/ios'))
            || (isset($_SERVER['HTTP_USER_ACCESS_AGENT']) && ($_SERVER['HTTP_USER_ACCESS_AGENT'] == 'lrwapp/ios'))
            || (isset($_SERVER['HTTP_USER_AGENT']) && ($_SERVER['HTTP_USER_AGENT'] == 'lrwapp/weapp'))
            || (isset($_SERVER['HTTP_USER_ACCESS_AGENT']) && ($_SERVER['HTTP_USER_ACCESS_AGENT'] == 'lrwapp/weapp'))
        ) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * 获取地区一二三级
 *
 * @param string $parent_code 如果传入 parent_code 则获取2 3级
 * @return array
 */
//function get_region_tree($parent_code = '')
//{
//    $tree = $arr = $result = [];
//    $query = \App\Models\Region::where('is_enable', 1);
//    if ($parent_code) { // 获取1级地区下的2 3级
//        $region_ids = get_region_grandson($parent_code);
//        unset($region_ids[0]);
//        $query->whereIn('region_id', $region_ids);
//    }
//
//    $region_list = $query->orderBy('sort','asc')->get();
//    if (!$region_list->isEmpty()) {
//
//        foreach ($region_list as $val) {
//            $val = $val->toArray();
//            if ($val['level'] == 2) {
//                $arr[$val['parent_code']][] = $val;
//            }
//            if ($val['level'] == 3) {
//                $crr[$val['parent_code']][] = $val;
//            }
//            if ($val['level'] == 1) {
//                $tree[] = $val;
//            }
//        }
//
//        foreach ($arr as $k=>$v) {
//            foreach ($v as $kk=>$vv) {
//                $arr[$k][$kk]['sub_menu'] = !empty($crr[$vv['region_id']]) ? $crr[$vv['region_id']] : [];
//            }
//        }
//
//        foreach ($tree as $val) {
//            $val['tmenu'] = !empty($arr[$val['region_id']]) ? $arr[$val['region_id']] : [];
//            $result[$val['region_id']] = $val;
//        }
//    }
//    if ($parent_code) { // 如果是获取1级地区的2 3级 返回
//        return $arr;
//    }
//    return $result;
//}

/**
 * 商品列表筛选 uri拼接
 *
 * @param array $params 所有参数
 * @param array $extra 选中参数
 * @return string
 */
function build_goods_uri($params, $extra = [])
{
    extract(array_merge($params, $extra));
    $uri = '/list.html';
    if (isset($cat_id) && !empty($cat_id)) {
        $uri .= '?cat_id='.$cat_id;
    } elseif (isset($keyword) && !empty($keyword)) {
        $uri .= '?keyword='.$keyword;
    } else {
        $uri .= '?s=1';
    }
    if (isset($go) && !empty($go)) {
        $uri .= '&go='.$go;
    }
    if (isset($sort) && !empty($sort)) {
        $uri .= '&sort='.$sort;
    }
    if (isset($price_min) && !empty($price_min)) {
        $uri .= '&price_min='.$price_min;
    }
    if (isset($is_stock) && !empty($is_stock)) {
        $uri .= '&is_stock='.$is_stock;
    }
    if (isset($brand_id) && !empty($brand_id)) {
        $uri .= '&brand_id='.$brand_id;
    }
    if (isset($filter_attr) && !empty($filter_attr)) {
        $uri .= '&filter_attr='.$filter_attr;
    }
    if (isset($is_free) && !empty($is_free)) {
        $uri .= '&is_free='.$is_free;
    }
    if (isset($is_cash) && !empty($is_cash)) {
        $uri .= '&is_cash='.$is_cash;
    }
    if (isset($is_self) && !empty($is_self)) {
        $uri .= '&is_self='.$is_self;
    }
    if (isset($price_max) && !empty($price_max)) {
        $uri .= '&price_max='.$price_max;
    }
    if (isset($sort) && !empty($sort)) {
        $uri .= '&sort='.$sort;
    }
    if (isset($order) && !empty($order)) {
        $uri .= '&order='.$order;
    }
    if (isset($region) && !empty($region)) {
        $uri .= '&region='.$region;
    }
    if (isset($style) && !empty($style)) {
        $uri .= '&style='.$style;
    }

    return $uri;
}

/**
 * 计算商品价格区间
 *
 * @param int $price_min
 * @param int $price_max
 * @param string $price_str
 * @return array
 */
function price_range($price_min = 0, $price_max = 0, $price_str = '')
{
    if (empty($price_min)) {
        $price_min = 0;
    }
    if (empty($price_max)) {
        $price_max = 0;
    }

    //算法:计算商品价格的七个区间
    $priceNumber=7;
    $sprice=ceil(($price_max-$price_min)/$priceNumber);
    $firsetPrice = $price_min;
    //接收七个区间的价格范围
    $_priceNumber=[];
    for ($i=0;$i<$priceNumber;$i++) {
        if ($i<($priceNumber-1)) {
            $start_price = floor($firsetPrice/10)*10;
            $end_price = floor(($firsetPrice+$sprice)/10)*10-1;
        } else {
            $start_price = floor($firsetPrice/10)*10;
            $end_price = ceil($price_max/10)*10;
        }
        $_priceNumber[] = [
            'start' => $start_price,
            'end'=> $end_price,
            'start_end' => $start_price.'&nbsp;-&nbsp;'.$end_price
        ];
        $firsetPrice+=$sprice;
    }
    //把从商品中取出来的价格字符串转化成数组后,
    $goodsPrice=explode(',', $price_str);
    sort($goodsPrice);
    //在价格区间中做比对，如果区间中有商品保存价格区间，否则删除
    foreach ($_priceNumber as $k => $v) {
        $panduan=[];
        foreach ($goodsPrice as $k1 => $v1) {
            $v1=floor($v1);
            //价格在此区间，把该价格保存在数组中
            if ($v1>=$v['start'] && $v1<=$v['end']) {
                $panduan[]=$v1;
            }
        }
        //如果取出的商品没有在此价格区间的，删除该区间范围
        if (empty($panduan)) {
            unset($_priceNumber[$k]);
        }
    }

    return $_priceNumber;
}

function get_goods_sort_array($value = '')
{
    $list = [
        [
            'name' => '综合',
            'param' => 'sort',
            'value' => 0,
            'sort' => 'goods_sort',
            'order' => null,
        ],
        [
            'name' => '销量',
            'param' => 'sort',
            'value' => 1,
            'sort' => 'sale_num',
            'order' => 'DESC',
        ],
        [
            'name' => '新品',
            'param' => 'sort',
            'value' => 2,
            'sort' => 'last_time',
            'order' => 'DESC',
        ],
        [
            'name' => '评论',
            'param' => 'sort',
            'value' => 3,
            'sort' => 'comment_num',
            'order' => 'DESC',
        ],
        [
            'name' => '价格',
            'param' => 'sort',
            'value' => 4,
            'sort' => 'goods_price',
            'order' => 'DESC',
        ],
        [
            'name' => '人气',
            'param' => 'sort',
            'value' => 5,
            'sort' => 'collect_num',
            'order' => 'DESC',
        ],
    ];

    if ($value != '') {
        foreach ($list as $v) {
            if ($v['value'] == $value) {
                return $v['sort'];
            }
        }
    }

    return $list;
}


/*
*function：计算两个日期相隔多少年，多少月，多少天
*param string $date1[格式如：2011-11-5]
*param string $date2[格式如：2012-12-01]
*return array array('年','月','日');
*/
function diffDate($date1, $date2)
{
    if (strtotime($date1) > strtotime($date2)) {
        $tmp = $date2;
        $date2 = $date1;
        $date1 = $tmp;
    }
    list($Y1, $m1, $d1) = explode('-', $date1);
    list($Y2, $m2, $d2) = explode('-', $date2);
    $Y = $Y2 - $Y1;
    $m = $m2 - $m1;
    $d = $d2 - $d1;
    if ($d < 0) {
        $d += (int)date('t', strtotime("-1 month $date2"));
        $m--;
    }
    if ($m < 0) {
        $m += 12;
        $Y--;
    }
    return ['year' => $Y, 'month' => $m, 'day' => $d];
}

/**
 * 计算开店时长
 * 时间格式为: 1年 4个月 8天
 *
 * @param $open_time
 * @param $end_time
 * @return null|string
 */
function calc_shop_duration($open_time, $end_time)
{
    $result = diffDate(date('Y-m-d', $end_time), date('Y-m-d', $open_time));
    $arr = [];
    if ($result['year'] > 0) {
        $arr[] = $result['year'].'年';
    }
    if ($result['month'] > 0) {
        $arr[] = $result['month'].'个月';
    }
    if ($result['day'] > 0) {
        $arr[] = $result['day'].'天';
    }

    if (empty($arr)) {
        return null;
    }

    $str = implode(' ', $arr);
    return $str;
}

//====自定义方法 START====
function addCountryPic($array)
{
    $names = [];

//    foreach ($array as $key=> &$item) {
//        if (isset($names[$item['en_name']])) {
//            if(empty($array[$names[$item['en_name']]['idx']]['country_pic'])){
//                $country = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['pid'=>5,'id'=>$array[$names[$item['en_name']]['idx']]['country_id']])->first();
//                $array[$names[$item['en_name']]['idx']]['country_pic'] = '//shop.gogo198.cn/collect_website/public/uploads/national_flag/svg/'.strtolower($country->param5).'.svg'; //找出当前国家的国旗
//            }
//            $country = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['pid'=>5,'id'=>$item['country_id']])->first();
//            $item['country_pic'] = '//shop.gogo198.cn/collect_website/public/uploads/national_flag/svg/'.strtolower($country->param5).'.svg'; //找出当前国家的国旗
//        }
//        else {
//            $item['country_pic'] = '';
    ////            $names[$item['en_name']] = true;
//            $names[$item['en_name']] = ['en_name'=>$item['en_name'],'idx'=>$key];
//        }
//    }

    foreach ($array as $key=> &$item) {
        if (isset($names[$item['en_name'].'@'.$item['date']])) {
            #已有重复国家，合并旗帜数组
            if (!empty($array[$names[$item['en_name'].'@'.$item['date']]['idx']]['national_flag'])) {
                $country = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['pid'=>5,'id'=>$item['country_id']])->first();
//                array_push($item['national_flag'],'//shop.gogo198.cn/collect_website/public/uploads/national_flag/svg/'.strtolower($country->param5).'.svg'); //找出当前国家的国旗
                array_push($array[$names[$item['en_name'].'@'.$item['date']]['idx']]['national_flag'], '//shop.gogo198.cn/collect_website/public/uploads/national_flag/svg/'.strtolower($country->param5).'.svg'); //找出当前国家的国旗
                array_push($array[$names[$item['en_name'].'@'.$item['date']]['idx']]['country_name'], $country->param2); //找出当前国家的名称
            }
            $item['is_deplicate'] = 1;#标志为是重复节日，前端不显示
        } else {
            #暂无重复国家，新建旗帜数组
            $country = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['pid'=>5,'id'=>$item['country_id']])->first();
            $national_flag = '//shop.gogo198.cn/collect_website/public/uploads/national_flag/svg/'.strtolower($country->param5).'.svg';
            $item['national_flag'] = [$national_flag];
            $item['country_name'] = [$country->param2];
            $names[$item['en_name'].'@'.$item['date']] = ['en_name'=>$item['en_name'],'idx'=>$key,'country_name'=>[$country->param2],'national_flag'=>[$national_flag]];
        }
    }
//    dd($array);
    return $array;
}

function objtoarr($arr)
{
    return json_decode(json_encode($arr, true), true);
}

//生成订单编号
function get_ordersn($type)
{
    $year = date('Y');
    $month = date('m');
    $days = date("t", mktime(0, 0, 0, $month, 1, $year));
    $ordersn = '';

    $starttime = strtotime($year.'-'.$month.'-1 00:00:00');
    $endtime = strtotime($year.'-'.$month.'-'.$days.' 23:59:59');

    if ($type==1) {
        #选购单编号(今年今月第N个选购单)
        $ordersn = $year.$month.'A';
        $times = Db::table('cart')->whereRaw('created_at>='.$starttime.' and created_at<='.$endtime)->count();
        $ordersn = $ordersn.str_pad($times+1, '4', '0', STR_PAD_LEFT);
    } elseif ($type==2) {
        #订购单编号(今年今月第N个订购单)
        $ordersn = $year.$month.'B';
        $times = Db::connection('shop_db')->table('website_order_list')->whereRaw('createtime>='.$starttime.' and createtime<='.$endtime)->count();
        $ordersn = $ordersn.str_pad($times+1, '4', '0', STR_PAD_LEFT);
    } elseif ($type==3) {
        #商品订单编号（今年今月今日今时第N个支付单）
        $date = date('d');
        $hour = date('H');
        $ordersn = $year.$month.'G'.$date.$hour;
        $starttime = strtotime($year.'-'.$month.'-'.$date.' '.$hour.':00:00');
        $endtime = strtotime($year.'-'.$month.'-'.$date.' '.$hour.':59:59');
        $times = Db::connection('shop_db')->table('website_order_list')->whereRaw('createtime>='.$starttime.' and createtime<='.$endtime)->count();
        $ordersn = $ordersn.str_pad($times+1, '4', '0', STR_PAD_LEFT);
    }


    return $ordersn;
}

//创建二维码
function create_code($type=0, $orderid=0, $good_id=0)
{
    if ($type==1) {
        $url = 'https://shop.gogo198.cn/app/index.php?i=3&c=entry&do=member&p=custompayment&m=sz_yi&oid='.intval($orderid);
        #生成报价二维码
        $folder = $_SERVER['DOCUMENT_ROOT'].'/qrcode/pay_order_qrcode/';
        $name = 'order_'.session('user.user_id').'_'.$good_id;
        $img = generate_code($name, $url, $folder);
        return $img;
    }
}

function generate_code($name, $url, $folder)
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

function isParamIn2DArray($param, $array)
{
    foreach ($array as $subArray) {
        if (in_array($param, $subArray)) {
            return true;
        }
    }
    return false;
}

//获取官网用户id
function get_userid()
{
    $user = Db::table('user')->where(['user_id' => session('user')['user_id']])->first();
    $user2 = Db::connection('shop_db')->table('website_user')->where(['custom_id' => $user->gogo_id])->first();
    return $user2;
}

function get_website()
{
    #基本信息
    $website = Db::connection('shop_db')->table('website_basic')->where(['id'=>3])->first();
    $website = objtoarr($website);
    $website['name'] = json_decode($website['name'], true)['zh'];
    $website['desc'] = json_decode($website['desc'], true)['zh'];
    $website['keywords'] = json_decode($website['keywords'], true)['zh'];
    $website['copyright'] = json_decode($website['copyright'], true)['zh'];
    $website['content'] = json_decode($website['content'], true);

    #社交信息
    $website['social'] = Db::connection('shop_db')->table('website_contact')->where(['system_id'=>3])->get();
    $website['social'] = objtoarr($website['social']);

    #页脚信息
    $website['footer'] = Db::table('footer_body')->where(['pid'=>0,'company_id'=>0,'system_id'=>3])->get();
    $website['footer'] = objtoarr($website['footer']);
    foreach ($website['footer'] as $k=>$v) {
        $website['footer'][$k]['children'] = Db::table('footer_body')->where(['pid'=>$v['id']])->get();
        $website['footer'][$k]['children'] = objtoarr($website['footer'][$k]['children']);
        foreach ($website['footer'][$k]['children'] as $k2=>$v2) {
            $website['footer'][$k]['children'][$k2]['link'] = getAppLink2($v2['type'], $v2, 'yejiao');
            if (strpos($website['footer'][$k]['children'][$k2]['link'], '?') !== false) {
                $website['footer'][$k]['children'][$k2]['link'] .= '&foid='.$v2['id'];
            } else {
                $website['footer'][$k]['children'][$k2]['link'] .= '?foid='.$v2['id'];
            }
        }
    }

    #右侧弹框
    $leftFrame = Db::table('frame_body')->where(['pid'=>0,'type'=>2])->orderBy('displayorder', 'asc')->get();
    $website['leftFrame'] = objtoarr($leftFrame);

    #搜索栏
    $search_list = Db::table('search_list')->get();
    $website['search_list'] = objtoarr($search_list);

    #应用
    $website['apps'] = Db::connection('shop_db')->table('website_list')->get();
    $website['apps'] = objtoarr($website['apps']);

    #菜单
    $website['menu'] = Db::connection('shop_db')->table('website_navbar')->where(['system_id'=>3,'pid'=>0])->limit(2)->get();
    $website['menu'] = objtoarr($website['menu']);
    foreach ($website['menu'] as $k=>$v) {
        $website['menu'][$k]['name'] = json_decode($v['name'], true)['zh'];
        $website['menu'][$k]['childMenu'] = getDownMenu($v['id']);
    }

    #搜索栏图片
    $website['search'] = Db::table('search_setting')->where(['id'=>1])->first();
    $website['search'] = objtoarr($website['search']);

    return $website;
}

#下级菜单
function getDownMenu($id)
{
    $cmenu = Db::connection('shop_db')->table('website_navbar')->where(['pid'=>$id])->get();
    $cmenu = objtoarr($cmenu);
    foreach ($cmenu as $k=>$v) {
        $cmenu[$k]['name'] = json_decode($v['name'], true)['zh'];
        $cmenu[$k]['childMenu'] = Db::connection('shop_db')->table('website_navbar')->where(['pid'=>$v['id']])->get();
        $cmenu[$k]['childMenu'] = objtoarr($cmenu[$k]['childMenu']);
        foreach ($cmenu[$k]['childMenu'] as $k2=>$v2) {
            $cmenu[$k]['childMenu'][$k2]['name'] = json_decode($v2['name'], true)['zh'];
            $cmenu[$k]['childMenu'][$k2]['childMenu'] = Db::connection('shop_db')->table('website_navbar')->where(['pid'=>$v2['id']])->get();
            $cmenu[$k]['childMenu'][$k2]['childMenu'] = objtoarr($cmenu[$k]['childMenu'][$k2]['childMenu']);
            foreach ($cmenu[$k]['childMenu'][$k2]['childMenu'] as $k3=>$v3) {
                $cmenu[$k]['childMenu'][$k2]['childMenu'][$k3]['name'] = json_decode($v3['name'], true)['zh'];
            }
        }
    }
    return $cmenu;
}

function get_pageinfo($page)
{
    $page = Db::table('guide_frame')->where(['link'=>$page])->first();
    $page = objtoarr($page);
    $page['content'] = json_decode($page['content'], true);

    return $page;
}

function getAppLink2($type=0, $val, $type2='')
{
    if ($type==1) {
        #应用
        $link = Db::table('guide_frame')->where(['id'=>$val['content_id']])->first();
        $link = objtoarr($link);
        return $link['link'];
    } elseif ($type==2) {
        #政策
        return '/policy_detail?id='.$val['content_id'];
    } elseif ($type==3) {
        #消息
        return '/msg_detail?id='.$val['content_id'];
    } elseif ($type==4) {
        #规则
        return '/rule_detail?id='.$val['content_id'];
    } elseif ($type==5) {
        #图文
        return '/txt_detail?id='.$val['content_id'].'&type='.$type2.'&oid='.$val['id'];
    }
}

function get_category()
{
    $catearr = [];
    if (empty(session('catearr'))) {
        $catearr2 = Db::table('category')->where(['parent_id'=>0])->get();
        $catearr2 = objtoarr($catearr2);
        foreach ($catearr2 as $k=>$v) {
            $catearr[$k]['value'] = $v['cat_id'];
            $catearr[$k]['name'] = $v['cat_name'];
            $catearr2[$k]['children'] = Db::table('category')->where(['parent_id'=>$v['cat_id']])->get();
            $catearr2[$k]['children'] = objtoarr($catearr2[$k]['children']);
            foreach ($catearr2[$k]['children'] as $k2=>$v2) {
                $catearr[$k]['children'][$k2]['value'] = $v2['cat_id'];
                $catearr[$k]['children'][$k2]['name'] = $v2['cat_name'];
                $catearr2[$k]['children'][$k2]['children'] = Db::table('category')->where(['parent_id'=>$v2['cat_id']])->get();
                $catearr2[$k]['children'][$k2]['children'] = objtoarr($catearr2[$k]['children'][$k2]['children']);
                foreach ($catearr2[$k]['children'][$k2]['children'] as $k3=>$v3) {
                    $catearr[$k]['children'][$k2]['children'][$k3]['value'] = $v3['cat_id'];
                    $catearr[$k]['children'][$k2]['children'][$k3]['name'] = $v3['cat_name'];
                    $catearr[$k]['children'][$k2]['children'][$k3]['children'] = [];
                }
            }
        }
        session('catearr', $catearr);
    } else {
        $catearr = session('catearr');
    }


    return $catearr;
}

//微信js分享功能
function weixin_share($data)
{
    $time = time();
    $appid = 'wx76d541cc3e471aeb';
    $secret = '3e3d16ccb63672a059d387e43ec67c95';
    if ($time > (session('expires_time') + 3600)) {
        #获取access_token
//        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret;
//        $res = file_get_contents($url);
        $url = "https://api.weixin.qq.com/cgi-bin/stable_token";
        $res = httpRequest($url, json_encode(['grant_type'=>'client_credential','appid'=>$appid,'secret'=>$secret], true));
        $result = json_decode($res, true);
        session('access_token', $result["access_token"]);
        session('expires_time', $time);
    }
    if ($time > (session('expires_tocket_time') + 3600)) {
        $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=" . session('access_token') . "&type=jsapi";
        $res = file_get_contents($url);
        $result = json_decode($res, true);
        session('ticket', $result);
        session('expires_tocket_time', $time);
    }
    if (isset(session('ticket')['ticket'])) {
        $jsapiTicket = session('ticket')['ticket'];
    } else {
        $jsapiTicket = '';
    }
    $timestamp = $time;
    $url = $data['url_this'];
    $nonceStr = createNonceStr();
    $string =  "jsapi_ticket=".$jsapiTicket."&noncestr=".$nonceStr."&timestamp=".$timestamp."&url=".$url;
    $signature = sha1($string);

    $signPackage = [
        "appId" => $appid,
        "nonceStr" => $nonceStr,
        "timestamp" => $timestamp,
        "url" => $url,
        "signature" => $signature,
        "rawString" => $string,
        "desc" => $data['desc'],
        "name" => $data['name']
    ];
    return $signPackage;
}

function createNonceStr($length = 16)
{
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++) {
        $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
}

#验证手机号码
function verifyTel($tel)
{
    if (preg_match("/^1[34578]\d{9}$/", $tel)) {
        return true;
    }
    return false;
}

function httpRequest($url, $data, $head=[])
{
    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
    $output=curl_exec($ch);
    curl_close($ch);
    return $output;
}

function httpRequest2($url, $data, $head=[])
{
    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
//    curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $output=curl_exec($ch);
    curl_close($ch);
    return $output;
}
function httpRequest_wx($url, $data = null) {
    $ch = curl_init();
    
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
        CURLOPT_ENCODING => 'gzip, deflate', // 处理压缩响应
    ]);
    
    if (!empty($data)) {
        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            ]
        ]);
    }
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);
    
    // 如果请求失败，返回空字符串而不是错误信息（避免编码问题）
    if ($httpCode !== 200) {
        return "";
    }
    
    return $response;
}
function sendWechat($msg=[])
{
    $time = time();
    $system = Db::connection('shop_db')->table('centralize_system_notice')->where(['uid'=>0])->first();
    $system = objtoarr($system);
    if ($system['notice_type']==1) {
        $post = json_encode([
            'call'=>'confirmCollectionNotice',
            'first' =>$msg['first'],
            'keyword1' => $msg['keyword1'],
            'keyword2' => $msg['keyword2'],
            'keyword3' => date('Y-m-d H:i:s', $time),
            'remark' => $msg['remark'],
            'url' => $msg['url'],
            'openid' => $system['account'],
            'temp_id' => $msg['temp_id']
        ]);
        httpRequest('https://shop.gogo198.cn/api/sendwechattemplatenotice.php', $post);
    }
}

#通知分流人员,（订购先通知管理员）
function shuntWechat($msg=[])
{
    $time = time();
    $shunter = Db::connection('shop_db')->table('website_shunter')->where(['is_verify'=>1,'id'=>1])->first();
    $shunter = objtoarr($shunter);

    $user = Db::connection('shop_db')->table('website_user')->where(['id'=>$shunter['uid']])->first();
    $user = objtoarr($user);

//    if(!empty($user['openid'])){
//        $user['openid']
    $system = Db::connection('shop_db')->table('centralize_system_notice')->where(['uid'=>0])->first();
    $system = objtoarr($system);

    $post = json_encode([
            'call'=>'confirmCollectionNotice',
            'first' =>$msg['first'],
            'keyword1' => $msg['keyword1'],
            'keyword2' => $msg['keyword2'],
            'keyword3' => date('Y-m-d H:i:s', $time),
            'remark' => $msg['remark'],
            'url' => $msg['url'],
            'openid' => $system['account'],
            'temp_id' => $msg['temp_id']
        ]);
    httpRequest('https://shop.gogo198.cn/api/sendwechattemplatenotice.php', $post);
//    }
}

function platform_log($request)
{
    #日志记录
    $time = time();
    $content = '访客@@';

    if ($request->session()->get('user')!=null) {
        $content = '用户【'.session('user')['gogo_id'].'】@@';
    }

    // 获取协议类型
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http';
    // 获取主机名(包括域名和端口)
    $host = $_SERVER['HTTP_HOST'];
    // 获取资源路径
    $uri = $_SERVER['REQUEST_URI'];
    // 组合完整的URL
    $url = $protocol . '://' . $host . $uri;

    $userAgent = '';
    if (isset($_SERVER['HTTP_USER_AGENT'])) {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
    } else {
        // 处理未定义的情况，例如设置默认值或记录错误
        $userAgent = '未知';
    }
    $content .= $_SERVER['REMOTE_ADDR'].'@@'.$userAgent.'@@'.date('Y-m-d H:i:s', $time).'@@'.$url;

    Db::connection('shop_db')->table('system_log')->insert([
        'type'=>2,
        'ip'=>$_SERVER['REMOTE_ADDR'],
        'content'=>$content,
        'createtime'=>$time
    ]);
}

//微信小程序、公众号、邮箱、手机通知
function common_notice($data, $msg)
{
    if (!empty($data['sns_openid'])) {
        #小程序
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx6d1af256d76896ba&secret=d19a96d909c1a167c12bb899d0c10da6";
        $res = file_get_contents($url);
        $result = json_decode($res, true);

        $post2 = json_encode([
            'template_id'=>'GRa2BGkGrqU8g7IgMAVh6vx2iDD08uJSdK316TINQ7s',
            'page'=>$msg['page'],
            'touser' =>$data['sns_openid'],
            'data'=>['thing1'=>['value'=>$msg['taskname']],'phrase2'=>['value'=>$msg['opera']],'time4'=>['value'=>date('Y年m月d日 H:i')]],
            'miniprogram_state'=>'formal',//developer为开发版；trial为体验版；formal为正式版
            'lang'=>'zh_CN',
        ]);
        $resu = httpRequest('https://api.weixin.qq.com/cgi-bin/message/subscribe/send?access_token='.$result['access_token'], $post2, ['Content-Type:application/json'], 1);
    } elseif (!empty($data['openid'])) {
        #微信
        $post = json_encode([
            'call'=>'confirmCollectionNotice',
            'find' =>$msg['msg']."请打开查看！",
            'keyword1' => $msg['msg']."请打开查看！",
            'keyword2' => $msg['opera'],
            'keyword3' => date('Y-m-d H:i:s', time()),
            'remark' => '点击查看详情',
            'url' => $msg['url'],
            'openid' => $data['openid'],
            'temp_id' => 'SVVs5OeD3FfsGwW0PEfYlZWetjScIT8kDxht5tlI1V8'
        ]);

        httpRequest('https://shop.gogo198.cn/api/sendwechattemplatenotice.php', $post);
    } elseif (!empty($data['email'])) {
        $title = $msg['msg']."请打开查看！";
        $post_data = json_encode(['email'=>$data['email'],'title'=>$title,'content'=>$msg['url']], true);
        $res = httpRequest('https://admin.gogo198.cn/collect_website/public/?s=api/sendemail/index', $post_data, [
            'Content-Type: application/json; charset=utf-8',
            'Content-Length:' . strlen($post_data),
            'Cache-Control: no-cache',
            'Pragma: no-cache'
        ]);
    } elseif (!empty($data['phone'])) {
        $post_data = [
            'spid'=>'254560',
            'password'=>'J6Dtc4HO',
            'ac'=>'1069254560',
            'mobiles'=>$data['phone'],
            'content'=>$msg['msg'].'请打开链接（'.$msg['url'].'）查看！【GOGO】',
        ];
        $post_data = json_encode($post_data, true);
        httpRequest('https://decl.gogo198.cn/api/sendmsg_jumeng', $post_data, [
            'Content-Type: application/json; charset=utf-8',
            'Content-Length:' . strlen($post_data),
            'Cache-Control: no-cache',
            'Pragma: no-cache'
        ]);
    }
}
//客服通知：公众号、邮箱、手机通知
function common_notice2($data, $msg)
{
    if (!empty($data['openid'])) {
        #微信
        $post = json_encode([
            'call'=>'workorderToMember',
            'thing20' => "你有一条消息处理，请打开查看！",
            'time48' => date('Y年m月d日 H:i:s', time()),
            'url' => $msg['url'],
            'openid' => $data['openid'],
            'temp_id' => 'HLTkX1DshQnHoJpHLaGTjQkygsZVyFDIn7luT6hcjOY'
        ]);

        $res = httpRequest('https://shop.gogo198.cn/api/sendwechattemplatenotice.php', $post);

    #记录平台通知
//        platform_notice(['type'=>1,'msg'=>$msg['msg'],'url'=>$msg['url'],'uid'=>$data['id'],'email'=>'']);
    } elseif (!empty($data['email'])) {
        $post_data = json_encode(['email'=>$data['email'],'title'=>$msg['title'],'content'=>$msg['msg']], true);
        $res = httpRequest('https://shop.gogo198.cn/collect_website/public/?s=api/sendemail/index', $post_data, [
            'Content-Type: application/json; charset=utf-8',
            'Content-Length:' . strlen($post_data),
            'Cache-Control: no-cache',
            'Pragma: no-cache'
        ]);

    #记录平台通知
//        platform_notice(['type'=>2,'msg'=>$msg['msg'],'url'=>$msg['url'],'uid'=>$data['id'],'email'=>$data['email']]);
    } elseif (!empty($data['phone'])) {
        $post_data = [
            'spid'=>'254560',
            'password'=>'J6Dtc4HO',
            'ac'=>'1069254560',
            'mobiles'=>$data['phone'],
            'content'=>$msg['msg'].'请打开链接（'.$msg['url'].'）查看！【GOGO】',
        ];
        $post_data = json_encode($post_data, true);
        httpRequest('https://decl.gogo198.cn/api/sendmsg_jumeng', $post_data, [
            'Content-Type: application/json; charset=utf-8',
            'Content-Length:' . strlen($post_data),
            'Cache-Control: no-cache',
            'Pragma: no-cache'
        ]);
    }
}
//议题结果
function topics_result($data)
{
    #1、查找该议题的参与组员
    $group_member = Db::connection('shop_db')->table('decision_group_member')->where(['group_id'=>$data['group_id'],'status'=>1])->get();
    $group_member = objtoarr($group_member);
    $group_member_num = count($group_member);
    if ($group_member_num>0) {
        #2、查找组员的选择
        $option = [];
        foreach ($group_member as $k=>$v) {
            $member_option = Db::connection('shop_db')->table('decision_topics_selected')->where(['topics_id'=>$data['id'],'uid'=>$v['user_id']])->select(['option_id'])->first()['option_id'];
            $member_option = objtoarr($member_option);
            if (!empty($member_option)) {
                array_push($option, $member_option);
            }
        }

        if (!empty($option)) {
            #3、判断选择中出现最多的值和次数
            // 计算每个元素出现的次数
            $counts = array_count_values($option);
            // 找到出现次数最多的元素的值
            $maxCount = max($counts);#最多的值一共出现n次
//            $mostFrequentValue = array_search($maxCount, $counts);#最多的值为X

            #4、用出现最多的次数÷组内人数，得出是否等于通过结果的方式
            #1一致决议=100%，2多数决议≥60%，3半数决议≥50%，4少数决议<50%
            $result = $maxCount / $group_member_num;
            if ($data['pass_method'] == 1) {
                if ($result == 1) {
                    return 1;
                }
            } elseif ($data['pass_method'] == 2) {
                if ($result >= 0.6) {
                    return 1;
                }
            } elseif ($data['pass_method'] == 3) {
                if ($result >= 0.5) {
                    return 1;
                }
            } elseif ($data['pass_method'] == 4) {
                if ($result < 0.5) {
                    return 1;
                }
            }
        }
    }

    return 0;
}


//获取auth0的token凭据
function get_auth0_token($data)
{
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://gogo198.us.auth0.com/oauth/token",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "grant_type=authorization_code&client_id=3LuZWceTu0CTzV5z4VBXfDWMaEE3yIVF&client_secret=vhgWu6iyAbbR2UHtuROT2_iPzgIjCWnlaQsANC6hu7NjAOUlzbZnAiO1KS0VG_LP&code=".$data['code']."&redirect_uri=".$data['callback'],
        CURLOPT_HTTPHEADER => [
            "content-type: application/x-www-form-urlencoded"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        return $response;
    }
}

//进行auth0的api调用
function get_auth0_api($data)
{
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://gogo198.us.auth0.com/userinfo",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "authorization: Bearer ".$data['accessToken'],
            "content-type: application/json"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        $response = json_decode($response, true);

        $account = Db::connection('shop_db')->table('website_user')->where(['email'=>$response['email']])->first();
        $account = objtoarr($account);
        if (!empty($account)) {
            return ['account'=>$account,'response'=>$response];
        } else {
            return ['account'=>[],'response'=>$response];
        }
    }
}

//记录用户行为
function log_user_behavior($data)
{
    Log::info('用户事件：'.json_encode($data, true));
    #记录用户浏览过哪些商品===========start
    if ($data['type']==1) {
        #浏览商品
        if ($data['goods_id']>0 and $data['second']>0) {
            $log_arr = ['ip'=>$data['ip'],'createtime'=>time(),'goods_id'=>$data['goods_id'],'watch_seconds'=>$data['second']];
            if (!empty($data['user'])) {
                $user_info = Db::connection('shop_db')->table('website_user')->where(['custom_id'=>$data['user']['gogo_id']])->first();
                $log_arr['uid'] = $user_info->id;
                Db::connection('shop_db')->table('user_behavior_record')->whereRaw('ip="'.$data['ip'].'" and uid=""')->update(['uid'=>$user_info->id]);
            }
            Db::connection('shop_db')->table('user_behavior_record')->insert($log_arr);
            Log::info('插入完毕，second：'.$data['second']);
        }
    } elseif ($data['type']==2) {
        #收藏商品
        if ($data['goods_id']>0) {
            $log_arr = ['ip'=>$data['ip'],'createtime'=>time(),'collect_goods_id'=>$data['goods_id']];
            if (!empty($data['user'])) {
                $user_info = Db::connection('shop_db')->table('website_user')->where(['custom_id'=>$data['user']['gogo_id']])->first();
                $log_arr['uid'] = $user_info->id;
                Db::connection('shop_db')->table('user_behavior_record')->whereRaw('ip="'.$data['ip'].'" and uid=""')->update(['uid'=>$user_info->id]);
            }
            Db::connection('shop_db')->table('user_behavior_record')->insert($log_arr);
        }
    } elseif ($data['type']==3) {
        #加购商品
        if ($data['goods_id']>0) {
            $log_arr = ['ip'=>$data['ip'],'createtime'=>time(),'join_goods_id'=>$data['goods_id']];
            if (!empty($data['user'])) {
                $user_info = Db::connection('shop_db')->table('website_user')->where(['custom_id'=>$data['user']['gogo_id']])->first();
                $log_arr['uid'] = $user_info->id;
                Db::connection('shop_db')->table('user_behavior_record')->whereRaw('ip="'.$data['ip'].'" and uid=""')->update(['uid'=>$user_info->id]);
            }
            Db::connection('shop_db')->table('user_behavior_record')->insert($log_arr);
        }
    } elseif ($data['type']==4) {
        #删减商品
        if ($data['goods_id']>0) {
            $log_arr = ['ip'=>$data['ip'],'createtime'=>time(),'remove_goods_id'=>$data['goods_id']];
            if (!empty($data['user'])) {
                $user_info = Db::connection('shop_db')->table('website_user')->where(['custom_id'=>$data['user']['gogo_id']])->first();
                $log_arr['uid'] = $user_info->id;
                Db::connection('shop_db')->table('user_behavior_record')->whereRaw('ip="'.$data['ip'].'" and uid=""')->update(['uid'=>$user_info->id]);
            }
            Db::connection('shop_db')->table('user_behavior_record')->insert($log_arr);
        }
    }
    #记录用户浏览过哪些商品===========end
}

#用户做任务
function task_campaign($data){
    $campaign_id = intval($data['campaign_id']);//用户参与活动的id
    $share_uid = intval($data['share_uid']);//用户的id
    $goods_id = intval($data['goods_id']);//商品的id
    $campaign_type = $data['campaign_type'];//任务类型
    
    if($campaign_id!=0 && $share_uid!=0 && $goods_id!=0){
        #1、查找分享人活动任务（无需检验登录）
        $campaign_info = Db::connection('shop_db')->table('website_campaign_user_list')->where(['user_id'=>$share_uid,'product_id'=>$goods_id,'id'=>$campaign_id])->first();
        if(!empty($campaign_info)){
            $campaign_info = objtoarr($campaign_info);
            $campaign_info['task_info'] = json_decode($campaign_info['task_info'],true);
            
            #2、判断任务类型
            foreach($campaign_info['task_info'] as $k=>$v){
                if($campaign_type==$v['task_type']){
                    $campaign_info['task_info'][$k]['status'] = 1;
                    break;
                }
            }
            
            #3、记录任务类型到活动中
            Db::connection('shop_db')->table('website_campaign_user_list')->where(['id'=>$campaign_info['id']])->update([
                'task_info'=>json_encode($campaign_info['task_info'],true)
            ]);   
        }
    }
}
//====自定义方法 END====
