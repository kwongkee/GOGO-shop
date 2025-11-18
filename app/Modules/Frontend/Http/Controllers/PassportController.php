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
// | Date:2018-08-17
// | Description: 登录注册
// +----------------------------------------------------------------------

namespace App\Modules\Frontend\Http\Controllers;

use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\UserRepository;
use App\Services\ConnectApi;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

/**
 * 登录注册
 * todo ok
 *
 * Class PassportController
 * @package App\Modules\Frontend\Http\Controllers
 */
class PassportController extends Frontend
{
    use AuthenticatesUsers;//login在这里

//    protected $redirectTo = '/main';
//    protected $username;

    protected $userRep;
    protected $connectApi;

    public function __construct()
    {
        parent::__construct();

        $this->userRep = new UserRepository();
        $this->connectApi = new ConnectApi();

        $this->middleware('guest:user')->except('logout');
    }

    /**
     * 登录界面
     */
    public function showLoginForm(Request $request)
    {
        $data = $request->except(['_token']);

        if (isset($data['email_code'])) {
            $user = Db::table('user')->where(['email'=>$data['email_code']])->first();
            $user = objtoarr($user);

            $request->session()->put('user', objtoarr($user));
            session('user', objtoarr($user));

            auth()->guard('user')->attempt(
                ['email'=>$data['email_code'],'password'=>'888888'],
                $request->filled('remember')
            );

            header('Location: //www.gogo198.cn/');
        }

        $uuid = make_uuid();
        if ($request->ajax()) {
            $render = view('passport.ajax_login', compact('uuid'))->render();
            return result(0, $render);
        }
        $seo_title = '登录 - '.sysconf('site_name');

        #获取配置信息
        $website = get_website();
        $page_info = get_pageinfo('/member_login');
        $website['background'] = $page_info['content']['background'];
        $website['content'] = $page_info['content']['content'];
        $website['fontcolor'] = $page_info['content']['fontcolor'];

        #国家地区号码
        $country_code = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['pid'=>5])->get();
        $country_code = objtoarr($country_code);
        #授权应用
        $authlogin_apps = Db::connection('shop_db')->table('website_authlogin_apps')->where(['isshow'=>0])->get();
        $authlogin_apps = objtoarr($authlogin_apps);

        $open = isset($data['open']) ? intval($data['open']) : 0;
        $param = isset($data['param']) ? json_decode($data['param'], true) : ['','','','','',''];#其它页面的携带参数
        $param2 = isset($data['param2']) ? base64_decode($data['param2']) : '';#其它页面的携带参数

        #解决网页弹框警告问题
        $param2 = str_replace('*', '', $param2);
//        $param2 = str_replace('-','',$param2);
        $param2 = str_replace('>', '', $param2);
        $param2 = str_replace('\'', '', $param2);
        $param2 = str_replace('"', '', $param2);

        #当前页面
        $origin_page = '/login.html?open='.$open.'&param2='.$param2;

        #授权应用（最新）
        $autologin_apps2 = Db::connection('shop_db')->table('website_login_apps')->orderBy('id', 'asc')->get();
        $autologin_apps2 = objtoarr($autologin_apps2);

        $login_content = Db::connection('shop_db')->table('website_login_content')->where(['system_id'=>1])->first();
        $login_content = objtoarr($login_content);
        $login_content['content'] = json_decode($login_content['content'], true);

        return view('passport.login', compact('uuid', 'seo_title', 'website', 'page_info', 'country_code', 'authlogin_apps', 'open', 'param2', 'origin_page', 'autologin_apps2', 'login_content'));
    }

    //邮箱、手机验证码
    public function verify_code(Request $request)
    {
        $dat = $request->except(['_token']);

        $code = mt_rand(11, 99) . mt_rand(11, 99) . mt_rand(11, 99);
        $request->session()->put('login_code', $code);
        $res = '';
        if ($dat['code_type']==1) {
            #手机号码
            $tel = trim($dat['number']);
            if (!preg_match("/^1[34578]\d{9}$/", $tel)) {
                return result(-1, null, '手机格式错误！');
            }
            $country_code = intval($dat['country_code']);
            Db::connection('shop_db')->table('send_msg_list')->insert(['phone'=>$tel,'code'=>$code,'createtime'=>time(),'ip'=>$_SERVER['REMOTE_ADDR'],'type'=>3]);
            $post_data = [
                'country_code'=>$country_code,
                'mobiles'=>$tel,
                'content'=>'您正在登录淘中国，手机验证码为：'.$code.'【GOGO】',
                'code'=>$code,
                'type'=>'login'
            ];
            $post_data = json_encode($post_data, true);
            $res = httpRequest('https://decl.gogo198.cn/api/sendmsg_jumeng', $post_data, [
                'Content-Type: application/json; charset=utf-8',
                'Content-Length:' . strlen($post_data),
                'Cache-Control: no-cache',
                'Pragma: no-cache'
            ]);
            $res = json_decode($res, true);
            if ($res['code']==-1) {
                $request->session()->put('login_code', $res['verify_code']);
            } elseif ($res['code']==2) {
                #查看信息状态
                $post_data = json_encode([
                    'taskid'=>$res['taskid'],
                    'mobile'=>$tel
                ], true);
                $res = httpRequest('https://decl.gogo198.cn/api/getstatus_jumeng', $post_data, [
                    'Content-Type: application/json; charset=utf-8',
                    'Content-Length:' . strlen($post_data),
                    'Cache-Control: no-cache',
                    'Pragma: no-cache'
                ]);
                $res = json_decode($res, true);

                return result($res['code'], null, $res['msg']);
            }
            return result($res['code'], null, $res['msg']);
        } elseif ($dat['code_type']==2) {
            #邮箱
//            <br/><p>或直接点击：<a href="https://www.gogo198.cn/?s=index/customer_login&email='.trim($dat['number']).'&code='.$code.'&open='.intval($dat['open']).'&param2='.$dat['param2'].'" style="text-decoration: underline;">立即登录/注册</a> ,完成网站的登录/注册</p>
            $res=httpRequest('https://shop.gogo198.cn/collect_website/public/?s=/api/sendemail/index', ['email'=>trim($dat['number']),'title'=>'一次性代码','content'=>'<p>你好，您的一次性代码为
Hello, Your one-time code is:</p><br/><p>'.$code.'</p><br/><p>请在登录时输入这个代码，以验证是您本人在登录。请注意，出于安全原因，这个代码将在 20 分钟后过期。</p><p>Please enter this code when logging in to verify that it is you logging in. Please note that for security reasons, this code will expire after 20 minutes.</p><br/><p>我们很乐意倾听用户的意见！如果您有任何意见或问题，请电邮至：</p><p>We are very willing to listen to the opinions of users! If you have any opinions or problems, please email to:</p><p>198@gogo198.net</p><br/><p>谢谢 Thank you!</p><br/><p>购购网 | Gogo</p>']);
        }

        return result(0, null, '发送成功');
    }

    protected function redirectPath()
    {
        $back_url = \request()->post('back_url', '/');
        return $back_url;
    }

    /**
     * 重写登陆验证方法
     *
     * @param Request $request
     */
    protected function validateLogin(Request $request)
    {
//        $dat = $request->except(['_token']);
//        $this->validate($request, [
//            'LoginModel.account' => 'required|string',
//            'LoginModel.smsCaptcha' => 'required|string',
//        ], [
//            'LoginModel.account.required' => '账号不能为空',
//            'LoginModel.smsCaptcha.required' => '验证码不能为空',
//        ]);
    }

    /**
     * 重写登陆方法
     *
     * @param Request $request
     * @return mixed
     */
    protected function attemptLogin(Request $request)
    {
        $data = $request->except(['_token']);
//        dd(bcrypt('888888'));
        $reg_method = isset($data['reg_method']) ? $data['reg_method'] : 1;
        $country_code = isset($data['country_code']) ? $data['country_code'] : 162;

        if ($data['SmsLoginModel']['account']!='13119893380' && $data['SmsLoginModel']['account']!='13809703680' && $data['SmsLoginModel']['account']!='947960547@qq.com' && $data['SmsLoginModel']['account']!='13119893382' && $data['SmsLoginModel']['account']!='13202629133' && $data['SmsLoginModel']['account']!='18566883843' && $data['SmsLoginModel']['account']!='15816772124' && $data['SmsLoginModel']['account']!='hejunxin@gogo198.net' && $data['SmsLoginModel']['account']!='yushanfang@qq.com' && $data['SmsLoginModel']['account']!='13129043380@qq.com') {
            #非公司内部成员，需验证
            if ($request->session()->get('login_code')==null || $request->session()->get('login_code')=='') {
                return result(-1, ['back_url'=>''], '登录请先获取验证码');
            }

            if ($data['SmsLoginModel']['smsCaptcha']!=$request->session()->get('login_code')) {
                return result(-1, ['back_url'=>''], '请输入正确的验证码');
            }
        }
//        dd($data);
        #重写截断登录方式-start
        $username_field='';
        if ($reg_method==2) {
            $username_field = 'email';
            $user = Db::table('user')->where(['email'=>trim($data['SmsLoginModel']['account'])])->first();
        } else {
            $username_field = 'mobile';
            $user = Db::table('user')->where(['mobile'=>trim($data['SmsLoginModel']['account'])])->first();
        }

        // ajax 登录
        if (!empty($user)) {
            // 存user到session
            $request->session()->put('user', objtoarr($user));
            session('user', objtoarr($user));
            Db::table('user')->where(['user_id'=>$user->user_id])->update([
                'last_login'=>date('Y-m-d H:i:s'),
            ]);
            // 登录成功 记录登录日志
            //        user_log(is_login(), 1);
            $ajax_layout = $request->post('ajax_layout', 0);
        } else {
            #无感注册
            $account = Db::connection('shop_db')->table('website_user')->where(['phone'=>$data['SmsLoginModel']['account']])->first();
            $account = objtoarr($account);
            if (empty($account)) {
                $account = Db::connection('shop_db')->table('website_user')->where(['email'=>$data['SmsLoginModel']['account']])->first();
                $account = objtoarr($account);
            }
            $time = time();

            if (empty($account)) {
                #无感注册，请求生成会员接口
                if ($reg_method==2) {
                    $postData = ['phone'=>'','email'=>$data['SmsLoginModel']['account'],'area_code'=>''];
                } elseif ($reg_method==1) {
                    $postData = ['phone'=>$data['SmsLoginModel']['account'],'email'=>'','area_code'=>$country_code];
                }

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://shop.gogo198.cn/collect_website/public/?s=api/func/generate_member"); // 目标URL
                curl_setopt($ch, CURLOPT_POST, 1); // 设置为POST请求
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postData); // POST数据
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 将响应结果作为字符串返回
                $account_id = curl_exec($ch);
                if (curl_errno($ch)) {
                    echo 'Error:' . curl_error($ch);
                    die;
                }
                curl_close($ch);

                $account = Db::connection('shop_db')->table('website_user')->where('id', $account_id)->first();
                $account = objtoarr($account);

                if ($reg_method==1) {
                    #通知用户
                    $post_data = [
                        'mobiles' => $data['SmsLoginModel']['account'],
                        'content' => '尊敬的客户，您好！您已成功注册成为购购网会员，感谢您的支持！【GOGO】',
                    ];
                    $post_data = json_encode($post_data, true);
                    httpRequest('https://decl.gogo198.cn/api/sendmsg_jumeng', $post_data, [
                        'Content-Type: application/json; charset=utf-8',
                        'Content-Length:' . strlen($post_data),
                        'Cache-Control: no-cache',
                        'Pragma: no-cache'
                    ]);
                } elseif ($reg_method==2) {
                    httpRequest('https://shop.gogo198.cn/collect_website/public/?s=/api/sendemail/index', ['email'=>$data['SmsLoginModel']['account'],'title'=>'注册成功','content'=>'<p>注册成功电邮内容：</p><p>尊敬的GoFriend：</p><p>欢迎使用购购网服务，感谢您注册购购网账户。</p><p>Welcome to use the Gogo198 Service. Thank you for registering an Gogo account.</p><br/><p>以下是您的用户名，请保留此电子邮件，日后您可能需要参考它。</p><p>The following is your username. Please keep this email as you may need to refer to it in the future.</p><br/><p>用户名 Username：'.$account['nickname'].'</p><br/><p>现在您可以登录您的账户</p><p>Now you can log in to your account：</p><p>https://www.gogo198.net</p><br/><p>我们很乐意倾听用户的意见！如果您有任何意见或问题，请电邮至：</p><p>We are very willing to listen to the opinions of users! If you have any opinions or problems, please email to:</p><p>198@gogo198.net</p><br/><p>谢谢 Thank you!</p><br/><p>购购网 | Gogo</p>']);
                }
            } else {
                #新商城会员（新的）
                Db::table('user')->insert([
                    'gogo_id'=>$account['custom_id'],
                    'user_name'=>empty($account['realname']) ? $account['phone'] : $account['realname'],
                    'nickname'=>$account['nickname'],
                    'password'=>bcrypt('888888'),
                    'mobile'=>$account['phone'],
                    'email'=>$account['email'],
                    'status'=>1,
                    'shopping_status'=>1,
                    'comment_status'=>1,
                    'created_at'=>date('Y-m-d H:i:s')
                ]);
            }

            $ajax_layout = $request->post('ajax_layout', 0);
//            $ajax_layout = -1;
        }

        if ($ajax_layout==1) {
            $back_url = $request->post('back_url', '');
            return $this->guard()->attempt(
                [$username_field=>$data['SmsLoginModel']['account'],'password'=>'888888'],
                $request->filled('remember')
            );
//            return result(0, ['back_url'=>$back_url], '登录成功');
        } else {
            $back_url = 'www.gogo198.cn';
            return result(1, ['back_url'=>$back_url], '登录失败');
        }
        #重写截断登录方式-end

//        $loginData = [];
//        if (Input::get('SmsLoginModel.account')) { // 动态密码登录
//            $loginData = []; // todo
//        } elseif($username = Input::get('LoginModel.username')) { // 普通登录
//            if (check_is_mobile($username)) { // 手机号登录
//                $username_field = 'mobile';
//            } elseif (check_is_email($username)) { // 邮箱登录
//                $username_field = 'email';
//            } else { // 默认用户名登录
//                $username_field = 'user_name';
//            }
//            $loginData = [$username_field => Input::get('LoginModel.username'), 'password' => Input::get('LoginModel.password')];
//        }
//
//        return $this->guard()->attempt(
//            $loginData
//            , $request->filled('remember')
//        );
    }

    #小程序授权登录
    public function getminiprogramcode(Request $request)
    {
        $data = $request->except(['_token']);

        if ($data['pa']==1) {
            #小程序二维码
            $time = time();
//        if($time > (session('expires_time') + 3600)){
            #获取accesstoken
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx6d1af256d76896ba&secret=d19a96d909c1a167c12bb899d0c10da6";
            $res = file_get_contents($url);
            $result = json_decode($res, true);
            $access_token = $result['access_token'];
            $expires_time = $time;
//            session('access_token', $result["access_token"]);
//            session('expires_time', $time);
//        }

            $auth_id = Db::connection('shop_db')->table('website_authlogin')->insertGetId([
                'timestamp' => $time,
                'status' => 0,
                'ip' => $_SERVER['REMOTE_ADDR']
            ]);

            #获取微信小程序码
            $url = "https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token=" . $access_token;
            $datas = [
//            'path' => 'pages/index/index?id='.intval($data['id']),
                "page" => "pages/login/index",
                "scene" => "authid=" . $auth_id,
                "check_path" => true,
                "env_version" => 'release',//release develop trial体验
                'width' => 430,
            ];
            $img = httpRequest($url, json_encode($datas));
//            Log::info('生成授权小程序码：');
//            Log::info(json_encode($img, true));
            $savepath = $_SERVER['DOCUMENT_ROOT'] . '/images/wxmini_img.png';
            file_put_contents($savepath, $img);
            $img = 'https://www.gogo198.cn/images/wxmini_img.png?v=' . $time;
            return Response()->json(['code' => 0, 'img' => $img, 'auth_id' => $auth_id]);
        } elseif ($data['pa']==2) {
            #查询是否已授权登录
            $auth = Db::connection('shop_db')->table('website_authlogin')->where(['id'=>intval($data['auth_id'])])->first();
            $auth = objtoarr($auth);

            if ($auth['status']==1) {
                if ($auth['uid']>0) {
                    $acc2 = Db::connection('shop_db')->table('website_user')->where(['id'=>$auth['uid']])->first();
                    $acc = Db::table('user')->where(['gogo_id'=>$acc2->custom_id])->first();
                    $acc = objtoarr($acc);
                    $request->session()->put('user', $acc);
                    session('user', $acc);
                    $is_company=0;#没用
                    $loginField = 'email';
                    $loginAcc = '';
                    if (!empty($acc['email'])) {
                        $loginField = 'email';
                        $loginAcc = $acc['email'];
                    } elseif (!empty($acc['mobile'])) {
                        $loginField = 'mobile';
                        $loginAcc = $acc['mobile'];
                    }
                    auth()->guard()->attempt(
                        [$loginField=>$loginAcc,'password'=>'888888'],
                        $request->filled('remember')
                    );

                    return Response()->json(['code'=>1,'msg'=>'授权成功，正在跳转','uid'=>$auth['uid'],'company'=>$is_company]);
                } else {
                    return Response()->json(['code'=>-2,'msg'=>'授权失败，系统暂无此用户','uid'=>0,'company'=>0]);
                }
            } elseif ($auth['status']==-1) {
                return Response()->json(['code'=>-1,'msg'=>'授权失败，正在刷新','uid'=>$auth['uid'],'company'=>0]);
            } elseif ($auth['status']==0) {
                return Response()->json(['code'=>0,'msg'=>'正在刷新','uid'=>$auth['uid'],'company'=>0]);
            }
        } elseif ($data['pa']==3) {
            #微信登录
            $type = isset($data['type']) ? intval($data['type']) : 0;
            if ($type==6) {
                #官网登录
                $acc = Db::connection('shop_db')->table('website_user')->where(['openid'=>$data['openid']])->first();
                $acc = objtoarr($acc);
                if (!empty($acc)) {
                    #已有账号
                    session('account', $acc);

                    $ishave = Db::connection('shop_db')->table('website_user_company')->where(['user_id'=>$acc['id'],'status'=>0])->first();
                    $ishave = objtoarr($ishave);
                    if (!empty($ishave)) {
                        header("Location: /?s=index/change_identity");
                    } else {
                        header("Location: /?s=index/account_manage");
                    }
                } else {
                    #未有账号
                    #跳转到补充基本信息页
                    header("Location: /?s=index/save_contact&app_type=".$data['pa']."&openid=".$data['openid'].'&unionid='.$data['unionid']);
                }
            } elseif ($type==7) {
                #医讯网登录
                $acc = Db::connection('shop_db')->table('website_user')->where(['openid'=>$data['openid']])->first();
                $acc = objtoarr($acc);
                header("Location: https://healink.gogo198.com/?s=index/customer_login&uid=".base64_encode($acc['id']));
            }
        } elseif ($data['pa']==4) {
            $d = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['id'=>$data['id']])->first();
            $d = objtoarr($d);

            return Response()->json(['code'=>0,'data'=>$d['param8']]);
        }
    }

    /**
     * The user has been authenticated.(用户已通过身份验证。)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        $data = $request->except(['_token']);
        $reg_method = isset($data['reg_method']) ? $data['reg_method'] : 1;

        if ($reg_method==2) {
            $user = Db::table('user')->where(['email'=>$data['SmsLoginModel']['account']])->first();
        } elseif ($reg_method==1) {
            $user = Db::table('user')->where(['mobile'=>$data['SmsLoginModel']['account']])->first();
        }

        // ajax 登录
        if (!empty($user)) {
            // 存user到session
            $request->session()->put('user', objtoarr($user));
            session('user', objtoarr($user));
            // 登录成功 记录登录日志
            //        user_log(is_login(), 1);
            $ajax_layout = $request->post('ajax_layout', 0);
        } else {
            $ajax_layout = -1;
        }
        if ($ajax_layout==1) {
            $back_url = $request->post('back_url', '');
            return result(0, ['back_url'=>$back_url], '登录成功');
        } else {
            $back_url = 'www.gogo198.cn';
            return result(-1, ['back_url'=>$back_url], '登录失败');
        }
        #重写截断登录方式-end

        // 存user到session
//        $request->session()->put('user', $user);

        // 登录成功 记录登录日志
//        user_log(is_login(), 1);

        // ajax 登录
//        $ajax_layout = $request->post('ajax_layout', 0);
//        if ($ajax_layout) {
//            $back_url = $request->post('back_url', '');
//            return result(0, ['back_url'=>$back_url], '登录成功');
//        }
    }

    /**
     * 重写guard方法
     *
     * @return mixed
     */
    protected function guard()
    {
        return auth()->guard('user');
    }

    /**
     * 重写username方法
     *
     * @return string
     */
    public function username()
    {
        return 'user_name';
    }

    /**
     * 注册
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRegisterForm(Request $request)
    {
        $seo_title = sysconf('site_name').' - 注册';

        $reg_type = 'mobile';
        if ($request->path() == 'register/email.html') {
            $reg_type = 'email';
        }

        if ($request->method() == 'POST') {
            $ref_url = route('pc_home'); // 暂时默认跳转回网站首页

            if ($reg_type == 'mobile') {
                // 手机注册
                $MobileRegisterModel = $request->input('MobileRegisterModel');

                // 验证图片验证码
                if (isset($MobileRegisterModel['captcha'])) {
                    $inputImgCaptcha = $MobileRegisterModel['captcha'];
                    $imgCaptcha = session('laravelvipcaptcha'); // 图片验证码
                    if ($inputImgCaptcha != $imgCaptcha) {
                        flash('error', '验证码不正确。');

                        return redirect('/register.html')->withInput($MobileRegisterModel);
                    }
                }

                // todo 验证手机验证码

                // 保存注册信息
                $ret = $this->userRep->register($MobileRegisterModel, 1);
                if ($ret['code'] < 0) {
                    flash('error', '注册信息保存失败。');
                    return redirect('/register.html')->withInput($MobileRegisterModel);
                }
                flash('success', '注册成功。');

                // 登录
                $this->guard()->attempt(
                    ['mobile' => Input::get('MobileRegisterModel.mobile'), 'password' => Input::get('MobileRegisterModel.password')],
                    $request->filled('remember')
                );
                // 存user到session
                $request->session()->put('user', auth('user')->user());
                return redirect($ref_url);
            } elseif ($reg_type == 'email') {
                // 邮箱注册
                $EmailRegisterModel = $request->input('EmailRegisterModel');

                // todo 验证手机验证码

                // 保存注册信息
                $ret = $this->userRep->register($EmailRegisterModel, 1);
                if ($ret['code'] < 0) {
                    flash('error', '注册信息保存失败。');
                    return redirect('/register.html')->withInput($EmailRegisterModel);
                }
                flash('success', '注册成功。');

                // 登录
                $this->guard()->attempt(
                    ['email' => Input::get('EmailRegisterModel.email'), 'password' => Input::get('EmailRegisterModel.password')],
                    $request->filled('remember')
                );
                // 存user到session
                $request->session()->put('user', auth('user')->user());
                return redirect($ref_url);
            }
            $remember = $request->input('remember', 0); // 是否同意用户注册协议

            // 注册验证参数

            // 注册保存数据

            flash('error', '注册失败');
            redirect('/');
//            return result(0, '', '注册成功');
        }

        return view('passport.register_' . $reg_type, compact('seo_title'));
    }

    /**
     * 手机号/邮箱验证是否重复
     * @param Request $request
     * @return array
     */
    public function clientValidate(Request $request)
    {
        $attribute = $request->get('attribute');
        $requestModel = '';
        if ($attribute == 'mobile') {
            $requestModel = 'MobileRegisterModel';
        } elseif ($attribute == 'email') {
            $requestModel = 'EmailRegisterModel';
        }
        $result = $this->userRep->clientValidate($request, $requestModel);
        if (!$result['code']) {
            return result(-1, '', $result['message']);
        }
        return result(0);
    }

    /**
     * 发送短信验证码
     *
     * @param Request $request
     * @return mixed
     */
    public function smsCaptcha(Request $request)
    {
        $account = trim($request->get('mobile'));
        $captcha = $request->get('captcha');
        if (empty($account)) {
            return result(-1, null, '发送失败');
        }
        $log_type = 1; // 注册会员

        #发送验证码
        $code = mt_rand(11, 99) . mt_rand(11, 99) . mt_rand(11, 99);
//        $code = 999999;
        $request->session()->put('login_code', $code);
        if (strpos($account, '@') !== false) {
            #邮箱
            $res=httpRequest('//shop.gogo198.cn/collect_website/public/?s=/api/sendemail/index', ['email'=>$account,'title'=>'登录Gogo购购网','content'=>'验证码：'.$code.'，您正在登录Gogo购购网。']);
        } else {
            #手机
            $post_data = [
                'mobiles'=>$account,
                'content'=>'您正在登录GOGO购购网，手机验证码为：'.$code.'【GOGO】',
            ];
            $post_data = json_encode($post_data, true);
            $res = httpRequest('https://decl.gogo198.cn/api/sendmsg_jumeng', $post_data, [
                'Content-Type: application/json; charset=utf-8',
                'Content-Length:' . strlen($post_data),
                'Cache-Control: no-cache',
                'Pragma: no-cache'
            ]);
        }
        // 发送频繁
//        return result(-1, ['show_captcha'=>1], '每60秒内只能发送一次短信验证码，请稍候重试', ['errors'=>['mobile' => ['每60秒内只能发送一次短信验证码，请稍候重试']]]);
//        $ret = $this->connectApi->sendCaptcha($account, $log_type);
//        if (!$ret['code']) {
//            return result(-1, null, $ret['message']);
//        }
        return result(0, null, '发送成功');
    }

    public function emailCaptcha(Request $request)
    {
        $message = 'test';
        $to = '410284576@qq.com';
        $subject = '测试邮件';
        Mail::send(
            'emails.register_tpl', // 邮件模板
            ['content' => $message],
            function ($message) use ($to, $subject) {
                $message->to($to)->subject($subject);
            }
        );
        // 返回的一个错误数组，利用此可以判断是否发送成功
        dd(Mail::failures());
//        $ret = false;
//        if (!$ret) {
//            return result(-1, null, '邮箱验证码发送失败');
//        }
//        return result(0, null, '邮箱验证码发送成功');
    }

    /**
     * 退出登录，继承父类方法
     *
     * @param Request $request
     * @return string
     */
    protected function loggedOut(Request $request)
    {
//        $account = $request->session()->get('user');
        $data = $request->all();
        $user = Db::table('user')->where(['user_id'=>base64_decode($data['shop_uid'])])->first();
        $account = Db::connection('shop_db')->table('website_user')->where(['custom_id'=>$user->gogo_id])->first();
        $account = objtoarr($account);

        $this->guard()->logout();
        $request->session()->invalidate();

        if (!empty($account['auth0_info'])) {
            header('Location: https://gogo198.us.auth0.com/v2/logout?client_id=3LuZWceTu0CTzV5z4VBXfDWMaEE3yIVF&returnTo=https://www.gogo198.net'.urlencode('/?s=api/protected_resource&redirect_url=https://www.gogo198.cn'));
            exit;
        }

        return redirect('/login.html');
    }

    public function login_log(Request $request)
    {
        $dat = $request->all();
        $ip = $_SERVER['REMOTE_ADDR'];
        $device = $_SERVER['HTTP_USER_AGENT'];
        $link = $_SERVER['HTTP_HOST'];

        $insertId = Db::connection('shop_db')->table('website_login_log')->insertGetId([
            'app_id'=>intval($dat['app_id']),
            'account'=>trim($dat['account']),
            'ip'=>$ip,
            'device'=>$device,
            'link'=>'//'.$link,
            'status'=>0,
            'createtime'=>time()
        ]);

        $app = Db::connection('shop_db')->table('website_login_apps')->where(['id'=>intval($dat['app_id'])])->first();

        return Response()->json(['code'=>0,'msg'=>'正在跳转','insertId'=>$insertId,'app'=>$app]);
    }
}
