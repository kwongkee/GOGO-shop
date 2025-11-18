<?php

namespace App\Modules\Frontend\Http\Controllers\User;

use App\Modules\Base\Http\Controllers\UserCenter;
use App\Repositories\BackOrderRepository;
use Illuminate\Http\Request;

class BackOrderController extends UserCenter
{
    protected $backOrder;

    public function __construct(BackOrderRepository $backOrder)
    {
        parent::__construct();

        $this->backOrder = $backOrder;
    }

    public function lists(Request $request)
    {
        $seo_title = '用户中心';

        $params = $request->all();


        // 获取数据
        $where = [];
        // 搜索条件 订单编号/退款退货单编号
        $search_arr = ['order_sn', 'back_sn'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'name') { // todo
//                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        $where[] = ['user_id', $this->user_id];

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'back_id',
            'sortorder' => 'desc'
        ];

        list($list, $total) = $this->backOrder->getList($condition);
        $pageHtml = frontend_pagination($total);
        $page_array = frontend_pagination($total, true);
        $page_json = json_encode($page_array);

        $nav_default = 'back';

        $compact = compact('seo_title', 'pageHtml', 'list', 'page_json', 'nav_default');

        if ($request->ajax() && !is_app()) { // web端访问 ajax请求
            $render = view('user.back-order.partials._list', $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'page' => $page_array,
                'list' => $list,
                'nav_default' => $nav_default,
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.back-order.list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 详情
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function info(Request $request)
    {
        $seo_title = '用户中心';

        $id = $request->get('id');


        // 获取数据

        $back_info = $this->backOrder->getById($id);
//        if (empty($info)) {
//            abort(200, '退款信息不存在！');
//        }

        $back_schedules = [

        ];
        $shop_info = [];
        $order_info = [];
        $goods_info = [];
        $user_info = [];
        $back_seller_term = 7;
        $back_logs = [];
        $default_user_portrait = get_image_url(sysconf('default_user_portrait'));
        $right_title = '申请售后';
        $nav_default = 'service';
        $addr_info = '浙江省哈哈哈 台州市 椒江区啦啦啦（右右收）13325660000';
        $service_name = '换货';

        $compact = compact(
            'seo_title',
            'back_info',
            'back_schedules',
            'back_schedules',
            'shop_info',
            'order_info',
            'goods_info',
            'user_info',
            'back_seller_term',
            'back_logs',
            'default_user_portrait',
            'right_title',
            'nav_default',
            'addr_info',
            'service_name'
        );

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'back_info' => $back_info,
                'back_schedules' => $back_schedules,
                'shop_info' => $shop_info,
                'order_info' => $order_info,
                'goods_info' => $goods_info,
                'user_info' => $user_info,
                'back_seller_term' => $back_seller_term,
                'back_logs' => $back_logs,
                'default_user_portrait' => $default_user_portrait,
                'right_title' => $right_title,
                'nav_default' => $nav_default,
                'addr_info' => $addr_info,
                'service_name' => $service_name,
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.back-order.info'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }
}
