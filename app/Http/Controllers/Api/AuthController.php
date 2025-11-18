<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//废弃
class AuthController extends Controller
{
    #跳转获取auth
    public function authorization_callback2(Request $request)
    {
        $data = $request->all();

        $code = trim($data['code']);
        $state = trim($data['state']);

        if (!empty($state)) {
            $token = get_auth0_token(['code'=>$code,'callback'=>'https://api.gogo198.cn/api/auth/token_callback']);
            $token = json_decode($token, true);

            dd($token);
        }
    }

    #获取token
    public function token_callback2(Request $request)
    {
        $data = $request->all();
        $data = json_decode($data);
        dd($data);
    }
}
