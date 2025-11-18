<?php

namespace App\Modules\Seller\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\CopyrightAuthRepository;
use App\Repositories\ShopRepository;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;

class PassportController extends Controller
{
    use AuthenticatesUsers;

//    protected $redirectTo = '/main';
//    protected $username;
    protected $copyrightAuth;

    public function __construct()
    {
        $this->copyrightAuth = new CopyrightAuthRepository();

        $this->middleware('guest:seller')->except('logout');
    }

    public function showLoginForm(Request $request)
    {
        if ($request->ajax()) {
            $uuid = make_uuid();
            $render = view('passport.ajax_login', compact('uuid'))->render();
            return result(0, $render);
        }
        $data = $request->except(['_token']);
        $uid = isset($data['uid']) ? base64_decode($data['uid']) : 0;
        $mid = isset($data['mid']) ? base64_decode($data['mid']) : 0;

        // 底部资质导航
        $copyCondition = [
            'where' => [
                ['is_show', 1]
            ],
            'sortname' => 'auth_sort',
            'sortorder' => 'asc'
        ];
        list($copyright_auth, $copyright_auth_total) = $this->copyrightAuth->getList($copyCondition);
        $auto_login=0;
        if ($uid>0) {
            $user = $this->auto_login($uid);
            $auto_login = $user;
            $auto_login['password'] = 888888;
        }

        return view('passport.login', compact('copyright_auth', 'auto_login'));
    }
    public function auto_login($gogoid)
    {
        $id = intval($gogoid);
        $user = Db::table('user')->where(['user_id'=>$id])->first();
        $user = objtoarr($user);
        return $user;
    }

    public function auto_login_backup($gogoid)
    {
        $id = intval($gogoid);
        $user = User::where('gogo_id', $id)->first();

        if (empty($user)) {
            $website_user = Db::connection('shop_db')->table('website_user')->where(['custom_id'=>$id])->first();
            $user_id = Db::table('user')->insertGetId([
                'role_id'=>1,
                'gogo_id'=>$website_user->custom_id,
                'user_name'=>$website_user->realname,
                'nickname'=>$website_user->nickname,
                'password'=>bcrypt('888888'),
                'rank_id'=>1,
                'status'=>1,
                'shopping_status'=>1,
                'comment_status'=>1,
                'mobile_validated'=>1,
                'shop_id'=>1,#到时候要改变
                'is_seller'=>1,
                'reg_from'=>1,
                'security_level'=>2,
                'reg_time'=>date('Y-m-d H:i:s'),
                'created_at'=>date('Y-m-d H:i:s'),
                'mobile'=>$website_user->phone,
                'email'=>$website_user->email,
            ]);
            $shop_id = Db::table('shop')->insertGetId([
                'user_id'=>$user_id,
                'shop_name'=>$website_user->company.'的店铺',
                'cat_id'=>1,
                'open_time'=>time(),
                'goods_status'=>1,
                'shop_status'=>1,
                'shop_sort'=>255,
                'shop_audit'=>1,
                'start_price'=>1,
                'created_at'=>date('Y-m-d H:i:s'),
                'service_tel'=>$website_user->phone,
            ]);
            Db::table('image_dir')->insert([
                'shop_id'=>$shop_id,
                'dir_name'=>'默认相册',
                'dir_group'=>'shop',
                'is_default'=>1,
                'created_at'=>date('Y-m-d H:i:s', time())
            ]);
            User::where('user_id', $user_id)->update(['shop_id'=>$shop_id]);
            sleep(2);
            $user = User::where('user_id', $user_id)->first();
        }
        return $user;
    }

    public function wuserlogin(Request $request)
    {
        $data = $request->except(['_token']);

        $id = intval($data['gogoid']);
        $user = User::where('gogo_id', $id)->first();

        if (empty($user)) {
            $website_user = Db::connection('shop_db')->table('website_user')->where(['custom_id'=>$id])->first();
            $user_id = Db::table('user')->insertGetId([
                'role_id'=>1,
                'gogo_id'=>$website_user->custom_id,
                'user_name'=>$website_user->realname,
                'nickname'=>$website_user->nickname,
                'password'=>bcrypt('888888'),
                'rank_id'=>1,
                'status'=>1,
                'shopping_status'=>1,
                'comment_status'=>1,
                'mobile_validated'=>1,
                'shop_id'=>1,#到时候要改变
                'is_seller'=>1,
                'reg_from'=>1,
                'security_level'=>2,
                'reg_time'=>date('Y-m-d H:i:s'),
                'created_at'=>date('Y-m-d H:i:s'),
                'mobile'=>$website_user->phone,
                'email'=>$website_user->email,
            ]);
            $shop_id = Db::table('shop')->insertGetId([
                'user_id'=>$user_id,
                'shop_name'=>$website_user->company.'的店铺',
                'cat_id'=>1,
                'open_time'=>time(),
                'goods_status'=>1,
                'shop_status'=>1,
                'shop_sort'=>255,
                'shop_audit'=>1,
                'start_price'=>1,
                'created_at'=>date('Y-m-d H:i:s'),
                'service_tel'=>$website_user->phone,
            ]);

            User::where('user_id', $user_id)->update(['shop_id'=>$shop_id]);
            sleep(2);
            $user = User::where('user_id', $user_id)->first();
        }

        // 登录成功 更新登录信息
        User::where('user_id', $user->user_id)->update(['last_login' => date('Y-m-d H:i:s', time()), 'last_ip' => $request->ip()]);

        $user = User::where('user_id', $user->user_id)->first();

        $loginData = ['mobile' => $user->mobile, 'password' => md5(111111)];
        $this->guard()->attempt($loginData);
        // 存user到session
        $request->session()->put('seller', $user);

        // ajax 登录
        $ajax_layout = $request->post('ajax_layout', 0);
        $user_info = auth('seller')->user();
        dd($user_info);
//        $user_info = $user;
        $shopRep = new ShopRepository();

        $shop_id = $user_info->shop_id;
        $shop_info = $shopRep->getById($shop_id);

        session()->put('shop_info', $shop_info);
//        session('shop_info', $shop_info->toArray()); // 将店铺信息存入session

        // 记录日志
        shop_log('卖家管理员【'.seller_info()->user_name.'】登录卖家中心。');
        $back_url = \request()->post('back_url', '/index');
        header('Location:'.$back_url);
    }

    protected function redirectPath()
    {
        // 登录成功 记录shop_id session
        $user_info = auth('seller')->user();
        $shopRep = new ShopRepository();
//        $shop_info = $shopRep->getByField('user_id', $user_info->user_id);

        $shop_id = $user_info->shop_id;
        $shop_info = $shopRep->getById($shop_id);
//        dd($shop_info->toArray());
        session()->put('shop_info', $shop_info);
//        session('shop_info', $shop_info->toArray()); // 将店铺信息存入session

        // 记录日志
        shop_log('卖家管理员【'.seller_info()->user_name.'】登录卖家中心。');
        $back_url = \request()->post('back_url', '/index');
        return $back_url;
    }

    /**
     * 重写登陆验证方法
     *
     * @param Request $request
     */
    protected function validateLogin(Request $request)
    {
//        $this->validate($request, [
//            'LoginModel.username' => 'required|string',
//            'LoginModel.password' => 'required|string',
//        ],[
//            'LoginModel.username.required' => '用户名不能为空',
//            'LoginModel.password.required' => '密码不能为空',
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
        // 登录前验证 是否是商家账号
        $userRep = new UserRepository();

        $loginData = [];
        if (Input::get('SmsLoginModel.mobile')) {
            // 动态密码登录
            if ($data['SmsLoginModel']['mobile']!='13119893380' && $data['SmsLoginModel']['mobile']!='13809703680' && $data['SmsLoginModel']['mobile']!='947960547@qq.com' && $data['SmsLoginModel']['mobile']!='13119893381') {
                #非公司内部成员，需验证
                if ($request->session()->get('login_code')==null || $request->session()->get('login_code')=='') {
                    return false;
//                    return result(-1,['back_url'=>''],'登录请先获取验证码');
                }

                if ($data['SmsLoginModel']['smsCaptcha']!=$request->session()->get('login_code')) {
                    return false;
//                    return result(-1,['back_url'=>''],'请输入正确的验证码');
                }
            }

            #重写截断登录方式-start
            $username_field='';
            if (strpos($data['SmsLoginModel']['mobile'], '@') !== false) {
                $username_field = 'email';
                $user = Db::table('user')->where(['email'=>$data['SmsLoginModel']['mobile']])->first();
            } else {
                $username_field = 'mobile';
                $user = Db::table('user')->where(['mobile'=>$data['SmsLoginModel']['mobile']])->first();
            }

            $loginData = [$username_field => $data['SmsLoginModel']['mobile'], 'password' => '888888' ];
        #重写截断登录方式-end
        } elseif ($username = Input::get('LoginModel.username')) {
            // 普通密码登录

            if (check_is_mobile($username)) { // 手机号登录
                $username_field = 'mobile';
            } elseif (check_is_email($username)) { // 邮箱登录
                $username_field = 'email';
            } else { // 默认用户名登录
                $username_field = 'user_name';
            }

            $condition[] = [$username_field, $username];
            $isSeller = $userRep->checkIsSeller($condition);
            if (!$isSeller) {
                // 如果不是卖家 则返回错误
                return false;
            }
            $loginData = [$username_field => Input::get('LoginModel.username'), 'password' => Input::get('LoginModel.password')];
        }

        $res = $this->guard()->attempt(
            $loginData,
            $request->filled('remember')
        );
        return $res;
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        // 登录成功 更新登录信息
        User::where('user_id', auth('seller')->id())->update(['last_login' => date('Y-m-d H:i:s', time()), 'last_ip' => $request->ip(), 'visit_count'=>($user->visit_count+1)]);

        $user = User::where('user_id', $user->user_id)->first();

        // 存user到session
        $request->session()->put('seller', $user);
//        $request->session()->put('manager', $user);

        // ajax 登录
        $ajax_layout = $request->post('ajax_layout', 0);

        if ($ajax_layout) {
            $back_url = $request->post('back_url', '');
            return result(0, ['back_url'=>$back_url], '登录成功');
        }
    }

    /**
     * 重写guard方法
     *
     * @return mixed
     */
    protected function guard()
    {
        return auth()->guard('seller');
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
     * 重写退出登录
     *
     * @param Request $request
     * @return string
     */
    protected function loggedOut(Request $request)
    {
        return redirect('/login');
    }
}
