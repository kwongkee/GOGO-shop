<?php

#会员中心

namespace App\Modules\Frontend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MembersController
{
    public $website_name = '';
    public $website_keywords = '';
    public $website_description = '';
    public $website_ico = '';
    public $website_sico = '';
    public $website_tel = '';
    public $website_email = '';
    public $website_copyright = '';
    public $website_color = '';
    public $website_color_inner = '';
    public $website_colorword = '';
    public $website_inpic = '';
    public $website_contact = [];

    #查询当前网址在系统中的配置
    public function __construct(Request $request)
    {
        $dat = $request->except(['__token']);

        $website = Db::connection('shop_db')->table('website_basic')->where(['id' => 3])->first();
        $website = objtoarr($website);

        #监测有无设置语言
        if (session('lang') == null) {
            session('lang', 'zh');
        }

        $website['name'] = json_decode($website['name'], true);
        $website['keywords'] = json_decode($website['keywords'], true);
        $website['desc'] = json_decode($website['desc'], true);
        $website['copyright'] = json_decode($website['copyright'], true);
        $this->website_name = $website['name'][session('lang')];
        $this->website_keywords = $website['keywords'][session('lang')];
        $this->website_description = $website['desc'][session('lang')];
        $this->website_ico = $website['logo'];
        $this->website_sico = $website['slogo'];
        $this->website_tel = $website['mobile'];
        $this->website_email = $website['email'];
        $this->website_copyright = $website['copyright'][session('lang')];
        $this->website_color = $website['color'];
        $this->website_color_inner = $website['color_inner'];
        $this->website_colorword = $website['color_word'];
        $this->website_inpic = $website['inpic'];
        $this->website_contact = Db::connection('shop_db')->table('website_contact')->where(['system_id' => 3])->get();
        $this->website_contact = objtoarr($this->website_contact);

        #日志记录
//        platform_log($request);
    }

    #会员中心
    public function member_center(Request $request)
    {
        $dat = $request->except(['__token']);
        $mid = isset($dat['mid']) ? intval($dat['mid']) : 0;
        $key = isset($dat['key']) ? trim($dat['key']) : '';
        if ($mid>0) {
            $user = Db::connection('shop_db')->table('website_user')->where(['id'=>$mid])->first();
            $user = objtoarr($user);
            session('account', $user);
        }
        if (empty(session('account'))) {
            header('Location:login.html');
            exit;
        }

        $menu = Db::connection('shop_db')->table('website_member_menu')->where(['pid'=>0,'status'=>0,'auth_type'=>0])->get();
        $menu = objtoarr($menu);
        foreach ($menu as $k=>$v) {
            $menu[$k]['children'] = Db::connection('shop_db')->table('website_member_menu')->where(['pid'=>$v['id']])->get();
            $menu[$k]['children'] = objtoarr($menu[$k]['children']);
        }

        $website['title'] = $this->website_name;
        $website['keywords'] = $this->website_keywords;
        $website['description'] = $this->website_description;
        $website['ico'] = $this->website_ico;
        $website['sico'] = $this->website_sico;
        $website['tel'] = $this->website_tel;
        $website['email'] = $this->website_email;
        $website['copyright'] = $this->website_copyright;
        $website['color'] = $this->website_color;
        $website['color_word'] = $this->website_colorword;
        $website['color_inner'] = $this->website_color_inner;
        $website['website_contact'] = $this->website_contact;

        $account = Db::connection('shop_db')->table('website_user')->where(['id'=>session('account.id')])->first();
        $account = objtoarr($account);

        if (count(explode('_', $account['nickname'])) > 1) {
            $account['nickname'] = explode('_', $account['nickname'])[1];
        }
        return view('', compact('website', 'menu', 'account'));
    }

    public function system_manage(Request $request)
    {
        $dat = $request->except(['__token']);
        $pid = isset($dat['pid']) ? intval($dat['pid']) : 0;

        $menu_list = Db::connection('shop_db')->table('website_member_menu')->where(['pid'=>$pid])->get();
        $menu_list = objtoarr($menu_list);

        $website['title'] = $this->website_name;
        $website['keywords'] = $this->website_keywords;
        $website['description'] = $this->website_description;
        $website['ico'] = $this->website_ico;
        $website['sico'] = $this->website_sico;
        $website['tel'] = $this->website_tel;
        $website['email'] = $this->website_email;
        $website['copyright'] = $this->website_copyright;
        $website['color'] = $this->website_color;
        $website['color_word'] = $this->website_colorword;
        $website['color_inner'] = $this->website_color_inner;
        $website['website_contact'] = $this->website_contact;

        return view('', compact('website', 'menu_list'));
    }

    #系统管理-二级
    public function system_manage2(Request $request)
    {
        $dat = $request->except(['__token']);
        $pid = isset($dat['pid']) ? intval($dat['pid']) : 0;

        $menu_list = Db::connection('shop_db')->table('website_member_menu')->where(['pid'=>$pid])->get();
        $menu_list = objtoarr($menu_list);

        $website['title'] = $this->website_name;
        $website['keywords'] = $this->website_keywords;
        $website['description'] = $this->website_description;
        $website['ico'] = $this->website_ico;
        $website['sico'] = $this->website_sico;
        $website['tel'] = $this->website_tel;
        $website['email'] = $this->website_email;
        $website['copyright'] = $this->website_copyright;
        $website['color'] = $this->website_color;
        $website['color_word'] = $this->website_colorword;
        $website['color_inner'] = $this->website_color_inner;
        $website['website_contact'] = $this->website_contact;

        return view('', compact('website', 'menu_list'));
    }

    #账户信息
    public function person_basic(Request $request)
    {
        $dat = $request->except(['__token']);
        if (isset($dat['pa'])) {
            $res = Db::connection('shop_db')->table('website_user')->where(['id'=>session('account.id')])->update(['nickname'=>trim($dat['nickname'])]);
            if ($res) {
                return Response()->json(['code'=>0,'msg'=>'保存成功']);
            }
        } else {
            #栏目
            $website['title'] = $this->website_name;
            $website['keywords'] = $this->website_keywords;
            $website['description'] = $this->website_description;
            $website['ico'] = $this->website_ico;
            $website['sico'] = $this->website_sico;
            $website['tel'] = $this->website_tel;
            $website['email'] = $this->website_email;
            $website['copyright'] = $this->website_copyright;
            $website['color'] = $this->website_color;
            $website['color_word'] = $this->website_colorword;
            $website['website_contact'] = $this->website_contact;

            $account = Db::connection('shop_db')->table('website_user')->where(['id'=>session('account.id')])->first();
            $account = objtoarr($account);

            return view('', compact('website', 'account'));
        }
    }

    #关联账户列表
    public function connect_account_list(Request $request)
    {
        $dat = $request->except(['__token']);

        if (isset($dat['pa'])) {
            $app_id = intval($dat['app_id']);
            $bind = intval($dat['bind']);
            if ($app_id==1) {
                #微信
                if ($bind==0) {
                    #绑定
                    $account = Db::connection('shop_db')->table('website_user')->where(['id'=>session('account.id')])->first();
                    $account = objtoarr($account);
                    if (!empty($account['unionid'])) {
                        $mc_fans = Db::connection('shop_db')->table('mc_mapping_fans')->where(['unionid'=>session('account.unionid')])->first();
                        $mc_fans = objtoarr($mc_fans);
                        Db::connection('shop_db')->table('website_user')->where(['id'=>session('account.id')])->update(['openid'=>$mc_fans['openid']]);
                        return Response()->json(['code'=>0,'msg'=>'绑定成功']);
                    }
                } elseif ($bind==1) {
                    #解绑
                    $res = Db::connection('shop_db')->table('website_user')->where(['id'=>session('account.id')])->update(['openid'=>'']);
                    return Response()->json(['code'=>0,'msg'=>'解绑成功']);
                }
            } elseif ($app_id==2) {
                #微信小程序
                if ($bind==0) {
                    #绑定
                    $account = Db::connection('shop_db')->table('website_user')->where(['id'=>session('account.id')])->first();
                    $account = objtoarr($account);
                    if (!empty($account['unionid'])) {
                        if (!empty($account['sns_openid'])) {
                            $mc_fans = Db::connection('shop_db')->table('mc_mapping_fans')->where(['unionid'=>session('account.unionid')])->first();
                            $mc_fans = objtoarr($mc_fans);
                            Db::connection('shop_db')->table('website_user')->where(['id'=>session('account.id')])->update(['openid'=>$mc_fans['openid']]);
                            return Response()->json(['code'=>0,'msg'=>'绑定成功']);
                        }
                    }
                } elseif ($bind==1) {
                    #解绑
                    $res = Db::connection('shop_db')->table('website_user')->where(['id'=>session('account.id')])->update(['sns_openid'=>'']);
                    return Response()->json(['code'=>0,'msg'=>'解绑成功']);
                }
            }
        } else {
            $website['title'] = $this->website_name;
            $website['keywords'] = $this->website_keywords;
            $website['description'] = $this->website_description;
            $website['ico'] = $this->website_ico;
            $website['sico'] = $this->website_sico;
            $website['tel'] = $this->website_tel;
            $website['email'] = $this->website_email;
            $website['copyright'] = $this->website_copyright;
            $website['color'] = $this->website_color;
            $website['color_word'] = $this->website_colorword;
            $website['color_inner'] = $this->website_color_inner;
            $website['website_contact'] = $this->website_contact;

            $list = Db::connection('shop_db')->table('website_authlogin_apps')->get();
            $list = objtoarr($list);
            $account = Db::connection('shop_db')->table('website_user')->where(['id'=>session('account.id')])->first();
            $account = objtoarr($account);
            foreach ($list as $k=>$v) {
                if ($v['id']==1) {
                    #微信
                    $list[$k]['is_bind']=0;
                    if (empty($account['openid'])) {
                        #解绑
                        $list[$k]['bind1_colorClass'] = 'r_grey';
                        $list[$k]['bind2_colorClass'] = 'r_blue';
                    } else {
                        #绑定
                        $list[$k]['is_bind']=1;
                        $list[$k]['bind2_colorClass'] = 'r_grey';
                        $list[$k]['bind1_colorClass'] = 'r_blue';
                    }
                } elseif ($v['id']==2) {
                    #微信小程序
                    $list[$k]['is_bind']=0;
                    if (empty($account['sns_openid'])) {
                        #解绑
                        $list[$k]['bind1_colorClass'] = 'r_grey';
                        $list[$k]['bind2_colorClass'] = 'r_blue';
                    } else {
                        #绑定
                        $list[$k]['is_bind']=1;
                        $list[$k]['bind2_colorClass'] = 'r_grey';
                        $list[$k]['bind1_colorClass'] = 'r_blue';
                    }
                }
            }

            return view('', compact('website', 'list', 'account'));
        }
    }

    #关联企业列表
    public function connect_enterprise_list(Request $request)
    {
        $dat = $request->except(['__token']);
        $pid = isset($dat['pid']) ? intval($dat['pid']) : 0;

        if (isset($dat['pa'])) {
            $id = intval($dat['id']);
            $res = Db::connection('shop_db')->table('website_user_company')->where(['id'=>$id])->update(['user_id'=>0]);
            if ($res) {
                return Response()->json(['code'=>0,'msg'=>'解绑成功']);
            }
        } else {
            $website['title'] = $this->website_name;
            $website['keywords'] = $this->website_keywords;
            $website['description'] = $this->website_description;
            $website['ico'] = $this->website_ico;
            $website['sico'] = $this->website_sico;
            $website['tel'] = $this->website_tel;
            $website['email'] = $this->website_email;
            $website['copyright'] = $this->website_copyright;
            $website['color'] = $this->website_color;
            $website['color_word'] = $this->website_colorword;
            $website['color_inner'] = $this->website_color_inner;
            $website['website_contact'] = $this->website_contact;

            $list = Db::connection('shop_db')->table('website_user_company')->where(['user_id'=>session('account.id')])->get();
            $list = objtoarr($list);
            $account = Db::connection('shop_db')->table('website_user')->where(['id'=>session('account.id')])->first();
            $account = objtoarr($account);

            return view('', compact('website', 'list', 'account', 'pid'));
        }
    }

    #国内认证
    public function auth_info(Request $request)
    {
        $dat = $request->except(['__token']);
        if ($request->ajax()) {
            $idcard = trim($dat['idcard']);
            $realname = trim($dat['realname']);
            $phone = trim($dat['phone']);

            $res = Db::connection('shop_db')->table('website_user')->where(['id'=>session('account')['id']])->update([
                'idcard'=>$idcard,
                'realname'=>$realname,
                'phone'=>$phone,
                'is_verify'=>0
            ]);
            if ($res) {
                return Response()->json(['code'=>0,'data'=>[$phone,$idcard,$realname]]);
            }
        } else {
            $website['title'] = $this->website_name;
            $website['keywords'] = $this->website_keywords;
            $website['description'] = $this->website_description;
            $website['ico'] = $this->website_ico;
            $website['sico'] = $this->website_sico;
            $website['tel'] = $this->website_tel;
            $website['email'] = $this->website_email;
            $website['copyright'] = $this->website_copyright;
            $website['color'] = $this->website_color;
            $website['color_word'] = $this->website_colorword;
            $website['website_contact'] = $this->website_contact;

            #个人信息
            $account = Db::connection('shop_db')->table('website_user')->where('id', session('account')['id'])->first();
            $account = objtoarr($account);

            return view('', compact('website', 'account'));
        }
    }

    #关联企业
    public function connect_enterprise(Request $request)
    {
        $dat = $request->except(['__token']);

        if ($request->ajax()) {
            if ($dat['reg_method']==2) {
                #境外企业
                $files = [];
                foreach ($dat['filename'] as $k=>$v) {
                    if (empty($v)) {
                        return Response()->json(['code'=>-1,'msg'=>'请输入文件名称']);
                    } else {
                        $files = array_merge($files, [['files'=>$dat['file'][$k],'filenames'=>trim($v)]]);
                    }
                }
                $files = json_encode($files, true);

                $type = $dat['type'];
                $type2 = $type==2 ? $dat['type2'] : 0;
                $company = trim($dat['company_name']);

                if (empty($company) || empty($dat['filename'])) {
                    return Response()->json(['code'=>-1,'msg'=>'请输入关联信息']);
                }

                #判断企业是否已被自己关联和自己是“超级管理员”还是“员工”
                $mehave_company = Db::connection('shop_db')->table('website_user_company')->where(['company'=>$company,'user_id'=>session('account')['id']])->first();
                $mehave_company = objtoarr($mehave_company);
                if (!empty($mehave_company['id'])) {
                    if ($mehave_company['status']==0) {
                        return Response()->json(['code'=>-1,'msg'=>'关联失败，您已认证此企业']);
                    } elseif ($mehave_company['status']==1) {
                        return Response()->json(['code'=>-1,'msg'=>'关联失败，您已注销此企业']);
                    }
                }
                $ishave_company = Db::connection('shop_db')->table('website_user_company')->whereRaw('company="'.$company.'" and user_id<>'.session('account')['id'])->first();
                $ishave_company = objtoarr($ishave_company);
                $is_manager = 1;#员工
                if (empty($ishave_company['id'])) {
                    $is_manager = 0;#管理员
                }

                $company_id = 0;
                if (empty($mehave_company['id'])) {
                    #插入认证信息
                    $company_id = Db::connection('shop_db')->table('website_user_company')->insertGetId([
                        'role'=>$is_manager,
                        'user_id'=>session('account.id'),
                        'reg_method'=>$dat['reg_method'],
                        'company'=>$company,
                        'reg_file'=>$files,
                        'type'=>$type,
                        'type2'=>$type==2 ? $type2 : 0,
                        'status'=>-1,
                        'createtime'=>time(),
                    ]);
                } else {
                    #修改认证信息
                    Db::connection('shop_db')->table('website_user_company')->where(['id'=>$mehave_company['id']])->update([
                        'reg_method'=>$dat['reg_method'],
                        'company'=>$company,
                        'reg_file'=>$files,
                        'type'=>$type,
                        'type2'=>$type==2 ? $type2 : 0,
                        'status'=>-1,
                    ]);
                    $company_id = $mehave_company['id'];
                }

                #通知O端
                $system = Db::connection('shop_db')->table('centralize_system_notice')->where(['uid'=>0])->first();
                $system = objtoarr($system);

                if ($system['notice_type']==1) {
                    #微信
                    $post = json_encode([
                        'call'=>'confirmCollectionNotice',
                        'first' =>'用户['.session('account.custom_id').']提交境外商户认证',
                        'keyword1' => '用户['.session('account.custom_id').']提交境外商户认证',
                        'keyword2' => '已提交待认证',
                        'keyword3' => date('Y-m-d H:i:s', time()),
                        'remark' => '点击查看详情',
                        'url' => 'https://gadmin.gogo198.cn/',
                        'openid' => $system['account'],
                        'temp_id' => 'SVVs5OeD3FfsGwW0PEfYlZWetjScIT8kDxht5tlI1V8'
                    ]);

                    httpRequest('https://shop.gogo198.cn/api/sendwechattemplatenotice.php', $post);
                } elseif ($system['notice_type']==3) {
                    #邮箱通知
                    httpRequest('https://shop.gogo198.cn/collect_website/public/?s=/api/sendemail/index', ['email'=>$system['account'],'title'=>'用户['.session('account.custom_id').']提交境外商户认证','content'=>'请登录总后台，进入商户管理进行审批：https://gadmin.gogo198.cn/']);
                }

                return Response()->json(['code'=>0,'msg'=>'提交成功，请等待管理人员审批，感谢支持！']);
            } elseif ($dat['reg_method']==1) {
                #境内企业

                $company = trim($dat['company']);
                $realname = trim($dat['realname']);
                $idcard = trim($dat['idcard']);
                $mobile = trim($dat['phone']);
                $type = trim($dat['type']);
                $type2 = trim($dat['type2']);

                if (empty($company) || empty($realname) || empty($idcard) || empty($mobile)) {
                    return Response()->json(['code'=>-1,'msg'=>'请输入关联信息']);
                }

                #判断企业是否已被自己关联和自己是“超级管理员”还是“员工”
                $mehave_company = Db::connection('shop_db')->table('website_user_company')->where(['company'=>$company,'user_id'=>session('account')['id']])->first();
                $mehave_company = objtoarr($mehave_company);
                if (!empty($mehave_company['id'])) {
                    if ($mehave_company['status']==0) {
                        return Response()->json(['code'=>-1,'msg'=>'关联失败，您已认证此企业名']);
                    } elseif ($mehave_company['status']==1) {
                        return Response()->json(['code'=>-1,'msg'=>'关联失败，您已注销此企业']);
                    }
                }
                $ishave_company = Db::connection('shop_db')->table('website_user_company')->whereRaw('company="'.$company.'" and user_id<>'.session('account')['id'])->first();
                $ishave_company = objtoarr($ishave_company);
                $is_manager = 1;#员工
                if (empty($ishave_company['id'])) {
                    $is_manager = 0;#管理员
                }

                $company_id = 0;
                if (empty($mehave_company['id'])) {
                    #插入认证信息
                    if ($mehave_company['status']==-1) {
                        Db::connection('shop_db')->table('website_user_company')->where(['id'=>$mehave_company['id']])->update([
                            'reg_method'=>$dat['reg_method'],
                            'realname'=>$realname,
                            'mobile'=>$mobile,
                            'company'=>$company,
                            'idcard'=>$idcard,
                            'type'=>$type,
                            'type2'=>$type==2 ? $type2 : 0,
                            'status'=>-1,
                        ]);
                        $company_id = $mehave_company['id'];
                    } else {
                        $company_id = Db::connection('shop_db')->table('website_user_company')->insertGetId([
                            'role'=>$is_manager,
                            'user_id'=>session('account.id'),
                            'reg_method'=>$dat['reg_method'],
                            'realname'=>$realname,
                            'mobile'=>$mobile,
                            'company'=>$company,
                            'idcard'=>$idcard,
                            'type'=>$type,
                            'type2'=>$type==2 ? $type2 : 0,
                            'status'=>-1,
                            'createtime'=>time(),
                        ]);
                    }
                } else {
                    #修改认证信息
                    Db::connection('shop_db')->table('website_user_company')->where(['id'=>$mehave_company['id']])->update([
                        'reg_method'=>$dat['reg_method'],
                        'realname'=>$realname,
                        'mobile'=>$mobile,
                        'company'=>$company,
                        'idcard'=>$idcard,
                        'type'=>$type,
                        'type2'=>$type==2 ? $type2 : 0,
                        'status'=>-1,
                    ]);
                    $company_id = $mehave_company['id'];
                }

                return Response()->json(['code'=>0,'data'=>[$mobile,$realname,$idcard,$company_id],'msg'=>'关联成功，请等待管理员审核']);
            }
        } else {
            $website['title'] = $this->website_name;
            $website['keywords'] = $this->website_keywords;
            $website['description'] = $this->website_description;
            $website['ico'] = $this->website_ico;
            $website['sico'] = $this->website_sico;
            $website['tel'] = $this->website_tel;
            $website['email'] = $this->website_email;
            $website['copyright'] = $this->website_copyright;
            $website['color'] = $this->website_color;
            $website['color_word'] = $this->website_colorword;
            $website['color_inner'] = $this->website_color_inner;
            $website['website_contact'] = $this->website_contact;

            $account = Db::connection('shop_db')->table('website_user')->where('id', session('account')['id'])->first();
            $account = objtoarr($account);

            if ($account['is_verify']==0) {
                #未认证时跳转到认证信息页
                header('Location: /members/auth_info');
            }
            session('account', $account);
            return view('', compact('website', 'account'));
        }
    }

    #联系信息
    public function contact_info(Request $request)
    {
        $dat = $request->except(['__token']);

        if ($request->ajax()) {
            $phone_code = trim($dat['phone_code']);
            $email_code = trim($dat['email_code']);
            $upd_phone = trim($dat['upd_phone']);
            $upd_email = trim($dat['upd_email']);
            if (empty($dat['phone']) || empty($dat['email'])) {
                return Response()->json(['code'=>-1,'msg'=>'请输入信息']);
            }
            if ($upd_phone==1) {
                if ($phone_code!=session('phone_verify_code')) {
                    return Response()->json(['code'=>-1,'msg'=>'手机验证码错误']);
                }
            }
            if ($upd_email==1) {
                if ($email_code!=session('email_verify_code')) {
                    return Response()->json(['code'=>-1,'msg'=>'邮箱验证码错误']);
                }
            }

            #对碰群组是否已有该邮箱
            Db::connection('shop_db')->table('decision_group_member')->where(['user_id'=>0,'email'=>trim($dat['email'])])->update(['user_id'=>session('account.id')]);

            $res = Db::connection('shop_db')->table('website_user')->where('id', session('account.id'))->update([
                'phone'=>trim($dat['phone']),
                'email'=>trim($dat['email']),
            ]);

            if ($res) {
                $account = Db::connection('shop_db')->table('website_user')->where('id', session('account.id'))->first();
                $account = objtoarr($account);

                session('account', $account);
                return Response()->json(['code'=>0,'msg'=>'保存成功！']);
            }
        } else {
            $website['title'] = $this->website_name;
            $website['keywords'] = $this->website_keywords;
            $website['description'] = $this->website_description;
            $website['ico'] = $this->website_ico;
            $website['sico'] = $this->website_sico;
            $website['tel'] = $this->website_tel;
            $website['email'] = $this->website_email;
            $website['copyright'] = $this->website_copyright;
            $website['color'] = $this->website_color;
            $website['color_word'] = $this->website_colorword;
            $website['color_inner'] = $this->website_color_inner;
            $website['website_contact'] = $this->website_contact;

            $account = Db::connection('shop_db')->table('website_user')->where('id', session('account')['id'])->first();
            $account = objtoarr($account);
            #国家地区号码
            $country_code = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['pid'=>5])->get();
            $country_code = objtoarr($country_code);

            return view('', compact('website', 'account', 'country_code'));
        }
    }

    #收货信息
    public function receive_list(Request $request)
    {
        $dat = $request->except(['__token']);

        if ($request->ajax()) {
        } else {
            $website['title'] = $this->website_name;
            $website['keywords'] = $this->website_keywords;
            $website['description'] = $this->website_description;
            $website['ico'] = $this->website_ico;
            $website['sico'] = $this->website_sico;
            $website['tel'] = $this->website_tel;
            $website['email'] = $this->website_email;
            $website['copyright'] = $this->website_copyright;
            $website['color'] = $this->website_color;
            $website['color_word'] = $this->website_colorword;
            $website['color_inner'] = $this->website_color_inner;
            $website['website_contact'] = $this->website_contact;

            $list = Db::connection('shop_db')->table('centralize_user_address')->where(['type'=>0,'user_id'=>session('account.id')])->get();
            $list = objtoarr($list);

            return view('', compact('website', 'list'));
        }
    }

    public function save_receive(Request $request)
    {
        $dat = $request->except(['__token']);
        $id = isset($dat['id']) ? intval($dat['id']) : 0;

        if ($request->ajax()) {
            if (!empty(session('account'))) {
                $name = trim($dat['user_name1']) . ' ' . trim($dat['user_name2']) . ' ' . trim($dat['user_name3']);

                $address2 = [];
                if (isset($dat['address2'])) {
                    foreach ($dat['address2'] as $k=>$v) {
                        array_push($address2, $v);
                    }
                }

                $post = [];
                if (isset($dat['postal_code'])) {
                    foreach ($dat['postal_code'] as $k=>$v) {
                        array_push($post, $v);
                    }
                }

                $province = '0';
                if (isset($data['province'])) {
                    $province = $dat['province'];
                }

                $city = '0';
                if (isset($dat['city'])) {
                    $city = $dat['city'];
                }

                $area = '0';
                if (isset($dat['area'])) {
                    $area = $dat['area'];
                }
                $area2 = '0';
                if (isset($dat['area2'])) {
                    $area2 = $dat['area2'];
                }
                $area3 = '0';
                if (isset($dat['area3'])) {
                    $area3 = $dat['area3'];
                }
                $area4 = '0';
                if (isset($dat['area4'])) {
                    $area4 = $dat['area4'];
                }

                if ($province == '自定义') {
                    $total_area = [];
                    if (isset($dat['diycountry'])) {
                        foreach ($dat['diycountry'] as $k=>$v) {
                            if (!empty($v)) {
                                array_push($total_area, $v);
                            }
                        }
                    }

                    if (!empty($total_area)) {
                        $pid = 0;
                        foreach ($total_area as $k => $v) {
                            $pid = Db::connection('shop_db')->table('centralize_adminstrative_area')->insertGetId([
                                'country_id' => $dat['country'],
                                'pid' => $pid,
                                'code_name' => trim($v)
                            ]);
                            if ($k == 0) {
                                $province = $pid;
                            } elseif ($k == 1) {
                                $city = $pid;
                            } elseif ($k == 2) {
                                $area = $pid;
                            } elseif ($k == 3) {
                                $area2 = $pid;
                            } elseif ($k == 4) {
                                $area3 = $pid;
                            } elseif ($k == 5) {
                                $area4 = $pid;
                            }
                        }
                    }
                } else {
                    if ($city == '自定义') {
                        $total_area = [];
                        if (isset($dat['diycountry'])) {
                            foreach ($dat['diycountry'] as $k=>$v) {
                                if (!empty($v)) {
                                    array_push($total_area, $v);
                                }
                            }
                        }
                        if (!empty($total_area)) {
                            $pid = $province;
                            foreach ($total_area as $k => $v) {
                                $pid = Db::connection('shop_db')->table('centralize_adminstrative_area')->insertGetId([
                                    'country_id' => $dat['country'],
                                    'pid' => $pid,
                                    'code_name' => trim($v)
                                ]);
                                if ($k == 0) {
                                    $city = $pid;
                                } elseif ($k == 1) {
                                    $area = $pid;
                                } elseif ($k == 2) {
                                    $area2 = $pid;
                                } elseif ($k == 3) {
                                    $area3 = $pid;
                                } elseif ($k == 4) {
                                    $area4 = $pid;
                                }
                            }
                        }
                    } else {
                        if ($area == '自定义') {
                            $total_area = [];
                            if (isset($dat['diycountry'])) {
                                foreach ($dat['diycountry'] as $k=>$v) {
                                    if (!empty($v)) {
                                        array_push($total_area, $v);
                                    }
                                }
                            }

                            if (!empty($total_area)) {
                                $pid = $city;
                                foreach ($total_area as $k => $v) {
                                    $pid = Db::connection('shop_db')->table('centralize_adminstrative_area')->insertGetId([
                                        'country_id' => $dat['country'],
                                        'pid' => $pid,
                                        'code_name' => trim($v)
                                    ]);
                                    if ($k == 0) {
                                        $area = $pid;
                                    } elseif ($k == 1) {
                                        $area2 = $pid;
                                    } elseif ($k == 2) {
                                        $area3 = $pid;
                                    } elseif ($k == 3) {
                                        $area4 = $pid;
                                    }
                                }
                            }
                        } else {
                            if ($area2 == '自定义') {
                                $total_area = [];
                                if (isset($dat['diycountry'])) {
                                    foreach ($dat['diycountry'] as $k=>$v) {
                                        if (!empty($v)) {
                                            array_push($total_area, $v);
                                        }
                                    }
                                }
                                if (!empty($total_area)) {
                                    $pid = $area;
                                    foreach ($total_area as $k => $v) {
                                        $pid = Db::connection('shop_db')->table('centralize_adminstrative_area')->insertGetId([
                                            'country_id' => $dat['country'],
                                            'pid' => $pid,
                                            'code_name' => trim($v)
                                        ]);
                                        if ($k == 0) {
                                            $area2 = $pid;
                                        } elseif ($k == 2) {
                                            $area3 = $pid;
                                        } elseif ($k == 3) {
                                            $area4 = $pid;
                                        }
                                    }
                                }
                            } else {
                                if ($area3 == '自定义') {
                                    $total_area = [];
                                    if (isset($dat['diycountry'])) {
                                        foreach ($dat['diycountry'] as $k=>$v) {
                                            if (!empty($v)) {
                                                array_push($total_area, $v);
                                            }
                                        }
                                    }

                                    if (!empty($total_area)) {
                                        $pid = $area;
                                        foreach ($total_area as $k => $v) {
                                            $pid = Db::connection('shop_db')->table('centralize_adminstrative_area')->insertGetId([
                                                'country_id' => $dat['country'],
                                                'pid' => $pid,
                                                'code_name' => trim($v)
                                            ]);
                                            if ($k == 0) {
                                                $area3 = $pid;
                                            } elseif ($k == 1) {
                                                $area4 = $pid;
                                            }
                                        }
                                    }
                                } else {
                                    if ($area4 == '自定义') {
                                        $total_area = [];
                                        if (isset($dat['diycountry'])) {
                                            foreach ($dat['diycountry'] as $k=>$v) {
                                                if (!empty($v)) {
                                                    array_push($total_area, $v);
                                                }
                                            }
                                        }

                                        if (!empty($total_area)) {
                                            $pid = $area;
                                            foreach ($total_area as $k => $v) {
                                                $pid = Db::connection('shop_db')->table('centralize_adminstrative_area')->insertGetId([
                                                    'country_id' => $dat['country'],
                                                    'pid' => $pid,
                                                    'code_name' => trim($v)
                                                ]);
                                                if ($k == 0) {
                                                    $area4 = $pid;
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                if ($dat['is_default'] == 1) {
                    Db::connection('shop_db')->table('centralize_user_address')->where(['user_id'=> session('account.id'),'is_default'=>1])->update(['is_default' => 0]);
                }

                if ($id>0) {
                    $res = Db::connection('shop_db')->table('centralize_user_address')->where(['user_id'=>session('account.id'),'id'=>$id])->update([
                        'user_name' => $name,
                        'mobile' => trim($dat['mobile']),
                        'mobile2' => trim($dat['mobile2']),
                        'email' => $dat['email'],
                        'address1' => $dat['address1'],
                        'address2' => json_encode($address2, true),
                        'is_default' => $dat['is_default'],
                    ]);
                } else {
                    $res = Db::connection('shop_db')->table('centralize_user_address')->insert([
                        'user_id' => session('account.id'),
                        'country_id' => $dat['country'],
                        'province' => $province,
                        'city' => $city,
                        'area' => $area,
                        'area2' => $area2,
                        'area3' => $area3,
                        'area4' => $area4,
                        'user_name' => $name,
                        'area_mobile' => trim($dat['area_mobile']),
                        'mobile' => trim($dat['mobile']),
                        'mobile2' => trim($dat['mobile2']),
                        'email' => $dat['email'],
                        'postal_code' => json_encode($post, true),
                        'address1' => $dat['address1'],
                        'createtime' => time(),
                        'address2' => json_encode($address2, true),
                        'is_default' => $dat['is_default'],
                    ]);
                }


                if ($res) {
                    return Response()->json(['code' => 0, 'msg' => '保存成功']);
                }
            }
        } else {
            $website['title'] = $this->website_name;
            $website['keywords'] = $this->website_keywords;
            $website['description'] = $this->website_description;
            $website['ico'] = $this->website_ico;
            $website['sico'] = $this->website_sico;
            $website['tel'] = $this->website_tel;
            $website['email'] = $this->website_email;
            $website['copyright'] = $this->website_copyright;
            $website['color'] = $this->website_color;
            $website['color_word'] = $this->website_colorword;
            $website['color_inner'] = $this->website_color_inner;
            $website['website_contact'] = $this->website_contact;

            $country = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['pid'=>5])->get();
            $country = objtoarr($country);

            $address = ['country_id'=>'','province'=>'','city'=>'','area'=>'','area2'=>'','area3'=>'','area4'=>'','area_mobile'=>'','mobile'=>'','mobile2'=>'','address1'=>'','address2'=>[],'email'=>'','postal_code'=>'','user_name'=>['','',''],'is_default'=>0];
            if ($id>0) {
                $address = Db::connection('shop_db')->table('centralize_user_address')->where(['id' => $id, 'user_id' => session('account.id')])->first();
                $address = objtoarr($address);
                #收货国地--start
                $address['detail_area'] = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['id'=>$address['country_id']])->first()->param2;
                $province = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$address['province']])->first()->code_name;
                $address['detail_area'] .= ' '.$province;
                if (!empty($address['city'])) {
                    $city = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$address['city']])->first()->code_name;
                    $address['detail_area'] .= ' '.$city;
                }
                if (!empty($address['area'])) {
                    $area = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$address['area']])->first()->code_name;
                    $address['detail_area'] .= ' '.$area;
                }
                if (!empty($address['area2'])) {
                    $area2 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$address['area2']])->first()->code_name;
                    $address['detail_area'] .= ' '.$area2;
                }
                if (!empty($address['area3'])) {
                    $area3 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$address['area3']])->first()->code_name;
                    $address['detail_area'] .= ' '.$area3;
                }
                if (!empty($v['area4'])) {
                    $area4 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$address['area4']])->first()->code_name;
                    $address['detail_area'] .= ' '.$area4;
                }
                #收货国地--end

                #收货人姓名
                $address['user_name'] = explode(' ', $address['user_name']);
                if (count($address['user_name'])==2) {
                    $uname2 = $address['user_name'][1];
                    $address['user_name'][1] = '';
                    $address['user_name'][2] = $uname2;
                }

                #邮政编码
                $address['postal_code'] = implode("", json_decode($address['postal_code'], true));

                #更多收货地址
                if (!empty($address['address2'])) {
                    $address['address2'] = json_decode($address['address2'], true);
                }
            }

            return view('', compact('website', 'address', 'id', 'country'));
        }
    }

    public function del_receive(Request $request)
    {
        $dat = $request->except(['__token']);
        $id = isset($dat['id']) ? intval($dat['id']) : 0;

        $res = Db::connection('shop_db')->table('centralize_user_address')->where(['id'=>$id,'user_id'=>session('account.id')])->delete();
        if ($res) {
            return Response()->json(['code'=>0,'msg'=>'删除成功']);
        }
    }

    public function getphonenum(Request $request)
    {
        $dat = $request->except(['__token']);
        if ($dat['pa']==1) {
            // $area = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$data['id']])->first();
            $phone = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['id'=>$dat['id']])->first();
            $phone = objtoarr($phone);
            $post = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['pid'=>4,'param1'=>$phone['param5']])->first();
            $post = objtoarr($post);

            $post_temp = '';
            if (!empty($post)) {
                $post_temp = $post['param3'];
            }
            $province = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['country_id'=>$dat['id'],'pid'=>0])->get();
            $province = objtoarr($province);

            return Response()->json(['code'=>0,'phone'=>$phone['param8'],'post'=>$post_temp,'province'=>$province]);
        } elseif ($dat['pa']==2) {
            $city = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['pid'=>$dat['id']])->get();
            $city = objtoarr($city);

            return Response()->json(['code'=>0,'area'=>$city]);
        }
    }

    #发货信息
    public function send_list(Request $request)
    {
        $dat = $request->except(['__token']);

        if ($request->ajax()) {
        } else {
            $website['title'] = $this->website_name;
            $website['keywords'] = $this->website_keywords;
            $website['description'] = $this->website_description;
            $website['ico'] = $this->website_ico;
            $website['sico'] = $this->website_sico;
            $website['tel'] = $this->website_tel;
            $website['email'] = $this->website_email;
            $website['copyright'] = $this->website_copyright;
            $website['color'] = $this->website_color;
            $website['color_word'] = $this->website_colorword;
            $website['color_inner'] = $this->website_color_inner;
            $website['website_contact'] = $this->website_contact;

            $list = Db::connection('shop_db')->table('centralize_user_address')->where(['type'=>1,'user_id'=>session('account.id')])->get();
            $list = objtoarr($list);

            return view('', compact('website', 'list'));
        }
    }

    public function save_send(Request $request)
    {
        $dat = $request->except(['__token']);
        $id = isset($dat['id']) ? intval($dat['id']) : 0;

        if ($request->ajax()) {
            if (!empty(session('account'))) {
                $name = trim($dat['user_name1']) . ' ' . trim($dat['user_name2']) . ' ' . trim($dat['user_name3']);

                $address2 = [];
                if (isset($dat['address2'])) {
                    foreach ($dat['address2'] as $k=>$v) {
                        array_push($address2, $v);
                    }
                }

                $post = [];
                if (isset($dat['postal_code'])) {
                    foreach ($dat['postal_code'] as $k=>$v) {
                        array_push($post, $v);
                    }
                }

                $province = '0';
                if (isset($data['province'])) {
                    $province = $dat['province'];
                }

                $city = '0';
                if (isset($dat['city'])) {
                    $city = $dat['city'];
                }

                $area = '0';
                if (isset($dat['area'])) {
                    $area = $dat['area'];
                }
                $area2 = '0';
                if (isset($dat['area2'])) {
                    $area2 = $dat['area2'];
                }
                $area3 = '0';
                if (isset($dat['area3'])) {
                    $area3 = $dat['area3'];
                }
                $area4 = '0';
                if (isset($dat['area4'])) {
                    $area4 = $dat['area4'];
                }

                if ($province == '自定义') {
                    $total_area = [];
                    if (isset($dat['diycountry'])) {
                        foreach ($dat['diycountry'] as $k=>$v) {
                            if (!empty($v)) {
                                array_push($total_area, $v);
                            }
                        }
                    }

                    if (!empty($total_area)) {
                        $pid = 0;
                        foreach ($total_area as $k => $v) {
                            $pid = Db::connection('shop_db')->table('centralize_adminstrative_area')->insertGetId([
                                'country_id' => $dat['country'],
                                'pid' => $pid,
                                'code_name' => trim($v)
                            ]);
                            if ($k == 0) {
                                $province = $pid;
                            } elseif ($k == 1) {
                                $city = $pid;
                            } elseif ($k == 2) {
                                $area = $pid;
                            } elseif ($k == 3) {
                                $area2 = $pid;
                            } elseif ($k == 4) {
                                $area3 = $pid;
                            } elseif ($k == 5) {
                                $area4 = $pid;
                            }
                        }
                    }
                } else {
                    if ($city == '自定义') {
                        $total_area = [];
                        if (isset($dat['diycountry'])) {
                            foreach ($dat['diycountry'] as $k=>$v) {
                                if (!empty($v)) {
                                    array_push($total_area, $v);
                                }
                            }
                        }
                        if (!empty($total_area)) {
                            $pid = $province;
                            foreach ($total_area as $k => $v) {
                                $pid = Db::connection('shop_db')->table('centralize_adminstrative_area')->insertGetId([
                                    'country_id' => $dat['country'],
                                    'pid' => $pid,
                                    'code_name' => trim($v)
                                ]);
                                if ($k == 0) {
                                    $city = $pid;
                                } elseif ($k == 1) {
                                    $area = $pid;
                                } elseif ($k == 2) {
                                    $area2 = $pid;
                                } elseif ($k == 3) {
                                    $area3 = $pid;
                                } elseif ($k == 4) {
                                    $area4 = $pid;
                                }
                            }
                        }
                    } else {
                        if ($area == '自定义') {
                            $total_area = [];
                            if (isset($dat['diycountry'])) {
                                foreach ($dat['diycountry'] as $k=>$v) {
                                    if (!empty($v)) {
                                        array_push($total_area, $v);
                                    }
                                }
                            }

                            if (!empty($total_area)) {
                                $pid = $city;
                                foreach ($total_area as $k => $v) {
                                    $pid = Db::connection('shop_db')->table('centralize_adminstrative_area')->insertGetId([
                                        'country_id' => $dat['country'],
                                        'pid' => $pid,
                                        'code_name' => trim($v)
                                    ]);
                                    if ($k == 0) {
                                        $area = $pid;
                                    } elseif ($k == 1) {
                                        $area2 = $pid;
                                    } elseif ($k == 2) {
                                        $area3 = $pid;
                                    } elseif ($k == 3) {
                                        $area4 = $pid;
                                    }
                                }
                            }
                        } else {
                            if ($area2 == '自定义') {
                                $total_area = [];
                                if (isset($dat['diycountry'])) {
                                    foreach ($dat['diycountry'] as $k=>$v) {
                                        if (!empty($v)) {
                                            array_push($total_area, $v);
                                        }
                                    }
                                }
                                if (!empty($total_area)) {
                                    $pid = $area;
                                    foreach ($total_area as $k => $v) {
                                        $pid = Db::connection('shop_db')->table('centralize_adminstrative_area')->insertGetId([
                                            'country_id' => $dat['country'],
                                            'pid' => $pid,
                                            'code_name' => trim($v)
                                        ]);
                                        if ($k == 0) {
                                            $area2 = $pid;
                                        } elseif ($k == 2) {
                                            $area3 = $pid;
                                        } elseif ($k == 3) {
                                            $area4 = $pid;
                                        }
                                    }
                                }
                            } else {
                                if ($area3 == '自定义') {
                                    $total_area = [];
                                    if (isset($dat['diycountry'])) {
                                        foreach ($dat['diycountry'] as $k=>$v) {
                                            if (!empty($v)) {
                                                array_push($total_area, $v);
                                            }
                                        }
                                    }

                                    if (!empty($total_area)) {
                                        $pid = $area;
                                        foreach ($total_area as $k => $v) {
                                            $pid = Db::connection('shop_db')->table('centralize_adminstrative_area')->insertGetId([
                                                'country_id' => $dat['country'],
                                                'pid' => $pid,
                                                'code_name' => trim($v)
                                            ]);
                                            if ($k == 0) {
                                                $area3 = $pid;
                                            } elseif ($k == 1) {
                                                $area4 = $pid;
                                            }
                                        }
                                    }
                                } else {
                                    if ($area4 == '自定义') {
                                        $total_area = [];
                                        if (isset($dat['diycountry'])) {
                                            foreach ($dat['diycountry'] as $k=>$v) {
                                                if (!empty($v)) {
                                                    array_push($total_area, $v);
                                                }
                                            }
                                        }

                                        if (!empty($total_area)) {
                                            $pid = $area;
                                            foreach ($total_area as $k => $v) {
                                                $pid = Db::connection('shop_db')->table('centralize_adminstrative_area')->insertGetId([
                                                    'country_id' => $dat['country'],
                                                    'pid' => $pid,
                                                    'code_name' => trim($v)
                                                ]);
                                                if ($k == 0) {
                                                    $area4 = $pid;
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                if ($dat['is_default'] == 1) {
                    Db::connection('shop_db')->table('centralize_user_address')->where(['user_id'=> session('account.id'),'is_default'=>1])->update(['is_default' => 0]);
                }

                if ($id>0) {
                    $res = Db::connection('shop_db')->table('centralize_user_address')->where(['user_id'=>session('account.id'),'id'=>$id])->update([
                        'user_name' => $name,
                        'mobile' => trim($dat['mobile']),
                        'mobile2' => trim($dat['mobile2']),
                        'email' => $dat['email'],
                        'address1' => $dat['address1'],
                        'address2' => json_encode($address2, true),
                        'is_default' => $dat['is_default'],
                    ]);
                } else {
                    $res = Db::connection('shop_db')->table('centralize_user_address')->insert([
                        'type'=>1,
                        'user_id' => session('account.id'),
                        'country_id' => $dat['country'],
                        'province' => $province,
                        'city' => $city,
                        'area' => $area,
                        'area2' => $area2,
                        'area3' => $area3,
                        'area4' => $area4,
                        'user_name' => $name,
                        'area_mobile' => trim($dat['area_mobile']),
                        'mobile' => trim($dat['mobile']),
                        'mobile2' => trim($dat['mobile2']),
                        'email' => $dat['email'],
                        'postal_code' => json_encode($post, true),
                        'address1' => $dat['address1'],
                        'createtime' => time(),
                        'address2' => json_encode($address2, true),
                        'is_default' => $dat['is_default'],
                    ]);
                }


                if ($res) {
                    return Response()->json(['code' => 0, 'msg' => '保存成功']);
                }
            }
        } else {
            $website['title'] = $this->website_name;
            $website['keywords'] = $this->website_keywords;
            $website['description'] = $this->website_description;
            $website['ico'] = $this->website_ico;
            $website['sico'] = $this->website_sico;
            $website['tel'] = $this->website_tel;
            $website['email'] = $this->website_email;
            $website['copyright'] = $this->website_copyright;
            $website['color'] = $this->website_color;
            $website['color_word'] = $this->website_colorword;
            $website['color_inner'] = $this->website_color_inner;
            $website['website_contact'] = $this->website_contact;

            $country = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['pid'=>5])->get();
            $country = objtoarr($country);

            $address = ['country_id'=>'','province'=>'','city'=>'','area'=>'','area2'=>'','area3'=>'','area4'=>'','area_mobile'=>'','mobile'=>'','mobile2'=>'','address1'=>'','address2'=>[],'email'=>'','postal_code'=>'','user_name'=>['','',''],'is_default'=>0];
            if ($id>0) {
                $address = Db::connection('shop_db')->table('centralize_user_address')->where(['id' => $id, 'user_id' => session('account.id')])->first();
                $address = objtoarr($address);

                #收货国地--start
                $address['detail_area'] = Db::connection('shop_db')->table('centralize_diycountry_content')->where(['id'=>$address['country_id']])->first()->param2;
                $province = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$address['province']])->first()->code_name;
                $address['detail_area'] .= ' '.$province;
                if (!empty($address['city'])) {
                    $city = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$address['city']])->first()->code_name;
                    $address['detail_area'] .= ' '.$city;
                }
                if (!empty($address['area'])) {
                    $area = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$address['area']])->first()->code_name;
                    $address['detail_area'] .= ' '.$area;
                }
                if (!empty($address['area2'])) {
                    $area2 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$address['area2']])->first()->code_name;
                    $address['detail_area'] .= ' '.$area2;
                }
                if (!empty($address['area3'])) {
                    $area3 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$address['area3']])->first()->code_name;
                    $address['detail_area'] .= ' '.$area3;
                }
                if (!empty($v['area4'])) {
                    $area4 = Db::connection('shop_db')->table('centralize_adminstrative_area')->where(['id'=>$address['area4']])->first()->code_name;
                    $address['detail_area'] .= ' '.$area4;
                }
                #收货国地--end

                #收货人姓名
                $address['user_name'] = explode(' ', $address['user_name']);
                if (count($address['user_name'])==2) {
                    $uname2 = $address['user_name'][1];
                    $address['user_name'][1] = '';
                    $address['user_name'][2] = $uname2;
                }

                #邮政编码
                $address['postal_code'] = implode("", json_decode($address['postal_code'], true));

                #更多收货地址
                if (!empty($address['address2'])) {
                    $address['address2'] = json_decode($address['address2'], true);
                }
            }

            return view('', compact('website', 'address', 'id', 'country'));
        }
    }

    #生成该网站的二维码
    public function get_website_qrcode(Request $request)
    {
        $dat = $request->except(['__token']);
        $folder = $_SERVER['DOCUMENT_ROOT'].'/qrcode/share_qrcode/';
        $img = generate_code('website_qrcode', 'https://www.gogo198.net/?s=members/member_center', $folder);
        return Response()->json(['code'=>0,'img'=>$img]);
    }

    #转移到其他页面
    public function transfer_website(Request $request)
    {
        $dat = $request->except(['__token']);

        $url = isset($dat['url']) ? trim($dat['url']) : '';
        $have_child = isset($dat['have_child']) ? intval($dat['have_child']) : 0;

        $list = [];
        if ($have_child==1) {
            $pid = intval($dat['pid']);

            $list = Db::connection('shop_db')->table('website_member_menu')->where(['pid'=>$pid])->get();
            $list = objtoarr($list);
        }

        $website['title'] = $this->website_name;
        $website['keywords'] = $this->website_keywords;
        $website['description'] = $this->website_description;
        $website['ico'] = $this->website_ico;
        $website['sico'] = $this->website_sico;
        $website['tel'] = $this->website_tel;
        $website['email'] = $this->website_email;
        $website['copyright'] = $this->website_copyright;
        $website['color'] = $this->website_color;
        $website['color_word'] = $this->website_colorword;
        $website['color_inner'] = $this->website_color_inner;
        $website['website_contact'] = $this->website_contact;

        return view('', compact('website', 'url', 'have_child', 'list'));
    }

    #优惠卡券列表
    public function coupon_list(Request $request)
    {
        $dat = $request->except(['__token']);
        echo '<h2>正在开发中...</h2>';
        exit;
    }

    #预付账单列表
    public function prepaid_list(Request $request)
    {
        $dat = $request->except(['__token']);
        echo '<h2>正在开发中...</h2>';
        exit;
    }

    #我确认的（列表）
    public function sure_list(Request $request)
    {
        $dat = $request->except(['__token']);

//        $list = [];

        #群组确认
        $list = Db::connection('shop_db')->table('decision_group_member')
            ->alias('a')
            ->join('decision_group b', 'a.group_id=b.id')
            ->where(['a.user_id'=>session('account.id'),'a.status'=>1])
            ->field(['a.*','b.name as group_name','b.createtime'])
            ->get();
        $list = objtoarr($list);

        $website['title'] = $this->website_name;
        $website['keywords'] = $this->website_keywords;
        $website['description'] = $this->website_description;
        $website['ico'] = $this->website_ico;
        $website['sico'] = $this->website_sico;
        $website['tel'] = $this->website_tel;
        $website['email'] = $this->website_email;
        $website['copyright'] = $this->website_copyright;
        $website['color'] = $this->website_color;
        $website['color_word'] = $this->website_colorword;
        $website['color_inner'] = $this->website_color_inner;
        $website['website_contact'] = $this->website_contact;

        return view('', compact('website', 'list'));
    }

    #开发中
    public function processing()
    {
        echo '<h2>正在开发中...</h2>';
        exit;
    }
}
