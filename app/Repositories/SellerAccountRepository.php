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
// | Date:2019-5-15
// | Description:店铺进出账明细
// +----------------------------------------------------------------------

namespace App\Repositories;

use App\Models\SellerAccount;

class SellerAccountRepository
{
    use BaseRepository;

    protected $model;


    public function __construct()
    {
        $this->model = new SellerAccount();
    }

    /*
     * 说明：
     * account_type：分类
     *  11-交易订单
        12-退款订单
        13-取消订单
        14-短信购买
        15-神码收银
        16-退还运费
        17-退还配送费和包装费
     */
}
