<?php

namespace App\Modules\Frontend\Http\Controllers;

use App\Modules\Base\Http\Controllers\Frontend;
use Yansongda\Pay\Log;
use Yansongda\Pay\Pay;

/**
 * 支付异步回调
 *
 * Class RespondController
 * @package App\Modules\Frontend\Http\Controllers
 */
class NotifyController extends Frontend
{
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


    public function frontAlipay()
    {
        $alipay = Pay::alipay($this->sandbox_alipay_config);

        try {
            $data = $alipay->verify(); // 是的，验签就这么简单！

            // 请自行对 trade_status 进行判断及其它逻辑进行判断，在支付宝的业务通知中，只有交易通知状态为 TRADE_SUCCESS 或 TRADE_FINISHED 时，支付宝才会认定为买家付款成功。
            // 1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号；
            // 2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额）；
            // 3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）；
            // 4、验证app_id是否为该商户本身。
            // 5、其它业务逻辑情况

            Log::debug('Alipay notify', $data->all());
        } catch (\Exception $e) {
            // $e->getMessage();
        }

        return $alipay->success();// laravel 框架中请直接 `return $alipay->success()`
    }
}
