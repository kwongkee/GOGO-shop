<?php

namespace App\Modules\Frontend\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    #跳转获取auth
    public function authorization_callback(Request $request)
    {
        $data = $request->all();

        $code = trim($data['code']);
        $state = trim($data['state']);

//        if($state==Cookie::get('token')){}
        $token = get_auth0_token(['code'=>$code,'callback'=>'https://www.gogo198.cn/auth/token_callback']);
        $token = json_decode($token, true);

        if (isset($token['token_type'])) {
            if ($token['token_type']=='Bearer') {
//                cookie('auth0_access_token',$token['access_token'],60*24);
//                cookie('auth0_scope',$token['scope'],60*24);
//                cookie('auth0_id_token',$token['id_token'],60*24);
//                cookie('auth0_token_type',$token['token_type'],60*24);

                $res = get_auth0_api(['accessToken'=>$token['access_token']]);

                if (!empty($res['account'])) {
//                    auth()->guard('user')->attempt(
//                        ['email'=>$res['account']['email'],'password'=>'888888']
//                        , $request->filled('remember')
//                    );

                    header('Location: https://www.gogo198.cn/login.html?email_code='.$res['account']['email']);
                }
            }
        }
    }

    #获取token回调
    public function token_callback(Request $request)
    {
        $data = $request->all();
    }

    #auth0注销回调
    public function protected_resource(Request $request)
    {
        $data = $request->all();

        header('Location: /login.html');
    }
}
