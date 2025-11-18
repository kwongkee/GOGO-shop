<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 2019/5/19
 * Time: 11:20
 */

namespace App\Api\Foundation\Controllers;

use App\Modules\Base\Http\Controllers\Frontend;

class Controller extends Frontend
{
    protected function resp($data, $code = 200)
    {
        $res = ['code'=>$code];
        if ($code!=200) {
            $res['message'] = $data;
        } else {
            $res['data'] = $data;
        }
        return response($res, $code)
            ->header('Content-Type', 'text/html; charset=UTF-8'); // 设置response头信息 否则会报错
    }

    protected function validate($args, $pattern)
    {
    }
}
