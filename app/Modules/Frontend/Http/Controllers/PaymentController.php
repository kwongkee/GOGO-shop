<?php

namespace App\Modules\Frontend\Http\Controllers;

use App\Models\OrderInfo;
use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\OrderInfoRepository;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Yansongda\Pay\Pay;

class PaymentController extends Frontend
{
    protected $orderInfo;

    /**
     * 支付宝支付 正式环境配置
     * @var array
     */
    protected $alipay_config = [
        'app_id' => '2017102809571592',
        'notify_url' => 'http://www.kanglecha.com/notify/front-alipay', // 异步回调
        'return_url' => 'http://www.kanglecha.com/respond/front-alipay', // 同步回调
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA8WxdMUt6bkcly0o6lZXuyp81YEIXNYgj0S4T5Tir+7yQbSD7BBtSZOIcXI8eIMW6GaNSGw0WTt55Z/vB9bj78lkcGXJqJiFnifJpIWj2FztCethCfJft3oLLuA91rPJ4CtSlBO8FvS7a+alzottwy6UXeIxMh0+BBftuSAFCUPJKETrkeiDi6WhnPRkbUGt26kd9pN5i7c6twCqDC5ZWIEvbC/gknp69PHGYWt0MEmuAkEHv8uVn4FfUEiznK/udW+6+DtYqRenVL1C4tnI+OuIr08y7PMYr5l6LmsBPoSFr4Nxu84reJ3PYQJHXv3y+hwigTNHyM00RN4OARBasGwIDAQAB',
        // 加密方式： **RSA2**
        'private_key' => 'MIIEpQIBAAKCAQEA8WxdMUt6bkcly0o6lZXuyp81YEIXNYgj0S4T5Tir+7yQbSD7BBtSZOIcXI8eIMW6GaNSGw0WTt55Z/vB9bj78lkcGXJqJiFnifJpIWj2FztCethCfJft3oLLuA91rPJ4CtSlBO8FvS7a+alzottwy6UXeIxMh0+BBftuSAFCUPJKETrkeiDi6WhnPRkbUGt26kd9pN5i7c6twCqDC5ZWIEvbC/gknp69PHGYWt0MEmuAkEHv8uVn4FfUEiznK/udW+6+DtYqRenVL1C4tnI+OuIr08y7PMYr5l6LmsBPoSFr4Nxu84reJ3PYQJHXv3y+hwigTNHyM00RN4OARBasGwIDAQABAoIBAQCFGw7ij8/Hn1h6FcnpEUof0tmV4bp0HERLH1F+ztkbqSIj2MwsvneWAYhLi+i7fuiVHBO3sGZ9Q3HCX+7XcI8QVgsFCKz3qvEwAEPwVLNhqZ2Ep1k44ncWeByjtXpWyTRgHE+DQdlzLbMzdTa5Mq2kybgAEbJb4/yp9K8f6fnLMEh314p+2ngCfGFQFKUga687qNqsO7UIIntVmfPMIBuva5BHxkydsqgTAyxOIhDiCSD/3wNr/8q9EePTD7sQUTuS7tgXmTXIwowtqAyVN5zI7LiAzIsk349dtYFIgm3VmtQdOFt4FDg1PPslJlDq2yFH2Wr0OU8nP1irm4d+kMfJAoGBAPvHIzzLq9LGpcD2yBKljniq4P8AjIAMbRG4CPFKM59Go6xRBmM6d53tI8q3ByqQime9Z1l1UtymiozpeixPla7R900W3GXuQGNSbxasJq4hWbxC/l8Q3alaLA6jWLYqAcRde4RuCpxu+kdOUzkyKZTDgLnnLpaLttlne3EVgBD9AoGBAPV4xmU+RH8r1Vkb/56QHnQNtL0GLJ/r+gngQx0bxNBJ2i0MeUQobMTSxS6lDvxAk8zRAv29PHTm8jg1yYVyf14TbsBdzFe81uqU48VbUv62ieRrwGVi1TAI2bpmWYiPeEn0zhjgCNaM9TW0ndclMnyHuNKnYmwCguXh+7lE9ej3AoGAGWHvFH73+IzcQwLeErssDNA1VJ/qijI2gLXL+P9hCuqlL4cPnMtVKc+xbwtappjhyymWFLe2PdZwW1piXbs8PN6gDt6CI6iMRzcVSfTbBW0JTeh3GoBpyFv12xfuppa/jNtby3MIkNLDWpLz4u1CseOvw44h7T1ylqJPGIxxV8UCgYEA89qMNK2b/D2+TyyqTonbRu0KvLEyiZgyJ7d61KLubQDA1fnLSjNiglDkA8eDUIKSkWidsRZZxcRbog2E6aXp87oYTs+fnRWC5z0L3NYxZ8pMx/dnBREeuf5A1ZSxoyDrnYStbTa6cPFM85I/LyjLs7xcliAkfSotgVNy7wUbydcCgYEA5RiO2roGwVCZn+cP7eCySDWwNPVlD8M2i1llJnMtRtDzzXmVRHYizHfW0OD4GpTOFGIV53f4nbRF4TgEkG7GlLt67G/3A7QMQ5rAYf8bxt82o/MX7FG6NRJX87tr7b/ARVD3W8p4e3IRT5TTZ5Kmq6l62E9HNw5nnwBzAGfmdng=',
        'log' => [ // optional
            'file' => './logs/alipay.log',
            'level' => 'info', // 建议生产环境等级调整为 info，开发环境为 debug
            'type' => 'single', // optional, 可选 daily.
            'max_file' => 30, // optional, 当 type 为 daily 时有效，默认 30 天
        ],
        'http' => [ // optional
            'timeout' => 5.0,
            'connect_timeout' => 5.0,
            // 更多配置项请参考 [Guzzle](https://guzzle-cn.readthedocs.io/zh_CN/latest/request-options.html)
        ],
        'mode' => 'dev', // optional, dev; 设置此参数，将进入沙箱模式
    ];

    /**
     * 支付宝支付 沙盒环境配置
     * @var array
     */
    protected $sandbox_alipay_config = [
        'app_id' => '2016100100638545',
        'notify_url' => 'http://www.kanglecha.com/notify/front-alipay', // 异步回调
        'return_url' => 'http://www.kanglecha.com/respond/front-alipay', // 同步回调
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAistVNEy1jkblKozJib1rxRdhZbdgovXWpXIxsgZhPSncoFY99TMNp+Bjr3RF6cBon1Upc7OrgqcWczQww9sFptN8NzVyJldg6XeXOdSxecYZSQYo01yLVhSlNv3P00VUSUaUj1tSSBATxyiyFiXhuOINkUnj7IzA32knvxk2I/m8L76+EfzJl0dg6Vhe9687IxdhbPYgVnDmsVnkVeaVipTHIAOQMGjnqm37KwsIcttPhN4vV1cj/F9wUkXLB27Xj+Zu7/l9P8pCph3teMc1PsLjHr7lN+nNk8fRG1e1W5tbDZ7nI0zcL1BsQ+GqJp5ZOOwILL1YtbIx9e3W1rbstwIDAQAB',
        // 加密方式： **RSA2**
        'private_key' => 'MIIEvwIBADANBgkqhkiG9w0BAQEFAASCBKkwggSlAgEAAoIBAQDEdSCblSpw1BIaKRyyHEkoGAWGDbJV6N04aLc6nmfeYJ5t6fS3l+o5HVm1LO5NnuBI0trc+JcYZVR9dIN/u6yPWIFZVLPYZ2KGLofH7M5L6e76HdOI2ll6upZYeC9jxlhXS+o1uMMj7Fkb2MU+OPaEKjuekJDKNAXoPCuTzLUHEhOu89ygILLZ2cX90nGof8Orcq4xdgMoqhFg+8rwIHLRdxS3FJlh9QW81xzRlOZsUh16iG8ofaLg9bmQHgfW+k936ZKf89LPRUAFvA2CarFScR2zo0uT923EHRD3QtQ2v0+W7B+fpTMLZZx3J1MqtXMNl1s0UxfpaXwJgCff8AwlAgMBAAECggEAATVDLRG+wBDdx6FnFsVLwd5b8lYVOagD7DvgnJCqzNhFQSHGKnbZrt46Vf3fvURz1p7NT7yLmU/ONDNKN7fcuMjvirAVpwgDuBWDKjyPjDH1ET6rtVS6ZiHNmN+sUu2+T1MdLpVjRc5HQf+UPuy0v11PHot/CG9HdgUgs3j3yAJWqv6QSoBvwlA/u9QXPMra8k+zjVybXSb0MuHssWBETahuyXfBsPtlld4gIndGs0zmKdRbGf7VRGdTwRdyo8tJfC6CTnRtLhCE/X67wRXJF77GOp5l1NX5UrfY599vrB19TAGgTTXCdhEF4XJkwpwA9i+rAmm8ehPdqAxeF/26gQKBgQD+SOG9PrtSsepj2oR+KKm88zeCvj1pVZ4U6QxS+DQewY75rG7eRb0UoeoLuGLYWaP7G9yv1X67e5bxTkDxBKsDlmzfmxSG3F8/nHwNbB/3PNf0xvSMYEiG5ICx74Rz15mI0gVBGdI20BI8BrGrclsgWpbG1j76eReiVUV+/dKXxQKBgQDFyGKdwDgbtZZrngQ40HO7BVF9WvsoRS/4wtCcnwQJJvFZ/juLojJ/3X3mKXNg7C9tgAIu5wwTtk2H1Rwl6dwkMs0Qa/M4lHByvowR/SzCAVrsU9PwmhRwR65lj3eE3XTrTEGDJyKZPtRc9vSSHsaV6d4nDjNPvZnNDcg6H9iI4QKBgQDFb0c+zedaNOP9tdvrrJzmJZ3zOMyr7Zs5Nx2niinFu5nMh7LpiBJgY7s6cGbm/urQfPij2ct1vGcdYxoPSQWTWoecMmgEsjSOSm0TauGC8M3os1WLbPLDMcYu4f7ghwUh85e6zVan0nRmAPiQWtEgVNX++riZd83+7+Bu0pth1QKBgQCNv/I90VflNB3cf2HTPkLTlRo0V5KN6Bhbl3Rf6+++h3SO5RDUIKlEzv++h5KzslLDje0CpIEZV5z1bx0/Zv5pyycBT/z/XhPBiSNmeScs3D/IBMRvOl7PofAxxcMJLJbxVLPXRaMcZdVZ03yxhPEa3IRlRV4tFlw2hFwunEhawQKBgQDuHmaQ6LC1hcZFyi7HHTRy8JkA/wcuSAugAmYN/BTwcCb4Us+cCXPU6N9+X7hAlDbvICX7fynglAka6ke45zu2oXUUedvf3ttJmK43IFMif3Wy+gvVKajGyD4G9dvW6I0RER+/lfcEUAjrxsxym8z0LIhbr6WrBzZZLTKjJW5scA==',
        'log' => [ // optional
            'file' => './logs/alipay.log',
            'level' => 'info', // 建议生产环境等级调整为 info，开发环境为 debug
            'type' => 'single', // optional, 可选 daily.
            'max_file' => 30, // optional, 当 type 为 daily 时有效，默认 30 天
        ],
        'http' => [ // optional
            'timeout' => 5.0,
            'connect_timeout' => 5.0,
            // 更多配置项请参考 [Guzzle](https://guzzle-cn.readthedocs.io/zh_CN/latest/request-options.html)
        ],
        'mode' => 'dev', // optional, dev; 设置此参数，将进入沙箱模式
    ];

    protected $wx_config = [
        'appid' => 'wxb75fbbbd66d8036e', // APP APPID
        'app_id' => 'wxccf534554adf5313', // 公众号 APPID
        'miniapp_id' => 'wxb3fxxxxxxxxxxx', // 小程序 APPID
        'mch_id' => '1488375262',
        'key' => 'kanglechakanglechakanglecha12345',
        'notify_url' => 'http://www.laravelvip.com/notify',
        'cert_client' => './cert/apiclient_cert.pem', // optional，退款等情况时用到
        'cert_key' => './cert/apiclient_key.pem',// optional，退款等情况时用到
        'log' => [ // optional
            'file' => './logs/wechat.log',
            'level' => 'info', // 建议生产环境等级调整为 info，开发环境为 debug
            'type' => 'single', // optional, 可选 daily.
            'max_file' => 30, // optional, 当 type 为 daily 时有效，默认 30 天
        ],
        'http' => [ // optional
            'timeout' => 5.0,
            'connect_timeout' => 5.0,
            // 更多配置项请参考 [Guzzle](https://guzzle-cn.readthedocs.io/zh_CN/latest/request-options.html)
        ],
        'mode' => 'hk', // optional, dev/hk;当为 `hk` 时，为香港 gateway。
    ];

    public function __construct()
    {
        parent::__construct();


        $this->orderInfo = new OrderInfoRepository();
    }

    /**
     * 支付页面
     *
     * @param Request $request
     * @return mixed
     */
    public function payment(Request $request)
    {
        $order_sn = $request->get('order_sn', '');

        $seo_title = '微信支付';

        // 获取数据

        if (!preg_match('/^\d{20}$/', $order_sn)) {
            abort(200, '无效的订单');
        }

        $order_info = OrderInfo::where([
            ['order_sn', $order_sn],
            ['user_id',$this->user_id]
        ])->first();

        if (empty($order_info)) {
            abort(200, '无效的订单');
        }

        $order_info = $order_info->toArray();

        // todo 需要写一个方法 判断支付方式参数
//        abort(200, '银联支付参数错误：商户号不能为空！');

        $subject = sysconf('site_name').'-订单支付';
        $total_amount = $order_info['order_amount'];


        // pay_info:"<img src='http://qr.liantu.com/api.php?text=weixin://wxpay/bizpayurl?pr=q0uPrZb' alt='扫码支付'>"

        // 支付宝支付
        $order = [
            'out_trade_no' => $order_sn,
            'total_amount' => $total_amount, // ** 微信支付的单位：分** **其他支付的单位：元** todo 暂时固定为微信支付
            'subject' => $subject,
        ];
        $alipay = Pay::alipay($this->sandbox_alipay_config)->web($order);

        return $alipay;// laravel 框架中请直接 `return $alipay`



        // 微信支付
//        $order = [
//            'out_trade_no' => $order_sn,
//            'total_fee' => $total_fee * 100, // ** 微信支付的单位：分** **其他支付的单位：元** todo 暂时固定为微信支付
//            'body' => $subject,
//            'openid' => 'o4Kp800BMtwNp8K7fc84c0ypdlqs', // 云 我的微信
//        ];
//
//
//
//        /**
//         * // 微信扫码支付 ok
//         *  "return_code" => "SUCCESS"
//            "return_msg" => "OK"
//            "appid" => "wxccf534554adf5313"
//            "mch_id" => "1488375262"
//            "nonce_str" => "hGWOGpryJhQf3rhO"
//            "sign" => "748530F9F110F665F307741EDD089BE2"
//            "result_code" => "SUCCESS"
//            "prepay_id" => "wx12225855621265b7f273e2172035324477"
//            "trade_type" => "NATIVE"
//            "code_url" => "weixin://wxpay/bizpayurl?pr=zU16z6U"
//         */
//        $pay = Pay::wechat($this->wx_config)->scan($order);

        /**
         * // 微信公众号支付 ok
         * "appId" => "wxccf534554adf5313"
            "timeStamp" => "1552402566"
            "nonceStr" => "B6On3S5btRWRKeqG"
            "package" => "prepay_id=wx12225610573212f85f517c8f2497436640"
            "signType" => "MD5"
            "paySign" => "9FF0E87371F17EC55F8DBF104DA73DE5"
         */
//        $pay = Pay::wechat($this->wx_config)->mp($order);

//        dd($pay);

        // $pay->appId
        // $pay->timeStamp
        // $pay->nonceStr
        // $pay->package
        // $pay->signType


        $wxpay_code_url = $pay['code_url']; // 'weixin://wxpay/bizpayurl?pr=zU16z6U';
        $pay_info = '<img src="'.route('pc_qrcode', ['url'=>$wxpay_code_url]).'" alt="扫码支付">';
        $pay_type = 0;

        // 根据不同支付方式 返回不同的 app_prefix_data
        $app_prefix_data = [
            'pay_info' => $pay_info,
            'subject' => $subject,
            'total_fee' => $total_fee,
            'order_sn' => $order_sn,
            'order_info' => $order_info,
            'pay_type' => $pay_type
        ];

        $compact = compact('seo_title', 'pay_info', 'subject', 'total_fee', 'order_sn', 'order_info', 'pay_type');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => $app_prefix_data,
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'payment.payment'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function checkIsPay(Request $request)
    {
        $order_sn = $request->get('order_sn');

        // 检查支付状态 当支付成功 则返回支付成功
        $is_paid = false; // 是否已完成支付
        if (!$is_paid) {
            return result(1, null); // 未支付
        }

        // 完成支付 跳转到支付结果页面
        // key 订单信息加密后的key todo ??
        $redirect_url = url('/checkout/result.html?key='.uuid());
        return result(0, null, '支付成功', ['url'=>$redirect_url]);
    }

    public function qrCode(Request $request)
    {
        $url = $request->get('url');
        $qrCode = QrCode::errorCorrection('L')
            ->format('png')
            ->size(124)
//            ->merge('/public/qrcodes/water.png',.15) // 合并水印图片到二维码
            ->margin(0)
//            ->color(255,0,255)
//            ->backgroundColor(125,245,0)
            ->encoding('UTF-8')
            ->generate($url);
        return response()->make($qrCode, 200, ['Content-Type' => 'image/png']);
    }
}
