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
// | Date:2019-05-16
// | Description:提现管理
// +----------------------------------------------------------------------

namespace App\Modules\Backend\Http\Controllers\Finance;

use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\SystemConfigRepository;
use Illuminate\Http\Request;

class DepositController extends Backend
{
    private $links = [
        ['url' => 'finance/deposit/list', 'text' => '提现列表'],
        ['url' => 'finance/deposit/deposit-config', 'text' => '设置'],
    ];

    protected $systemConfig;

    public function __construct(SystemConfigRepository $systemConfig)
    {
        parent::__construct();

        $this->systemConfig = $systemConfig;
    }

    /**
     * 列表
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function lists(Request $request)
    {
        $title = '列表';
        $fixed_title = '提现管理 - '.$title;

        $this->sublink($this->links, 'list');
        $action_span = [];
        $explain_panel = [
            '提现流程：会员提交提现申请（状态为待审核）-&gt;平台方审核（状态变为审核通过 转账中）-&gt;平台方线下为会员提现账户打款（线下打款完成后）-&gt;平台方处理转账（状态为提现成功）',
            '微信提现自动转账流程：会员提交提现申请（状态为待审核）-&gt;平台方申请（审核通过后自动触发微信提现）-&gt;平台方提现成功'
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();
        $where = [];
        // 搜索条件
        $search_arr = [];
        /*foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'name') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }*/

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'id',
            'sortorder' => 'asc'
        ];

        list($list, $total) = [11, 2]; // todo

        $pageHtml = pagination($total);
        if ($request->ajax()) {
            $render = view('finance.deposit.partials._list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }

        return view('finance.deposit.list', compact('title', 'list', 'pageHtml'));
    }

    /**
     * 设置
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function depositConfig(Request $request)
    {
        $title = '设置';
        $fixed_title = '提现管理 - '.$title;

        $this->sublink($this->links, 'deposit-config');
        $action_span = [];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $group_info = $this->systemConfig->getSpecialConfigsByGroup('deposit', 'code');

        return view('finance.deposit.deposit_config', compact('title', 'group_info'));
    }
}
