<?php

#会员中心

namespace App\Modules\Frontend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MemberController
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
    public $apps = [];

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
        $this->website_contact = Db::connection('shop_db')->table('website_contact')->where(['system_id' => 3, 'company_id' => 0])->get();
        $this->website_contact = objtoarr($this->website_contact);
        $this->apps = Db::connection('shop_db')->table('website_list')->get();
        $this->apps = objtoarr($this->apps);

        #日志记录
//        platform_log($request);
    }

    #决策管理=================================================================START
    #决策列表
    public function business_list(Request $request)
    {
        $dat = $request->except(['__token']);
        $pid = isset($dat['pid']) ? intval($dat['pid']) : 0;

        if (isset($dat['pa'])) {
            $limit = $request->get('limit');
            $page = $request->get('page') - 1;
            if ($page != 0) {
                $page = $limit * $page;
            }
            $keyword = isset($dat['keywords']) ? trim($dat['keywords']) : '';

            if ($pid==237) {
                #订单咨询
//                $company = Db::connection('shop_db')->table('website_user_company')->where(['id'=>session('manage_person.company_id')])->first();
                $count = Db::connection('shop_db')->table('website_order_list')->where(['user_id'=>session('account.id')])->count();
                $rows = Db::connection('shop_db')->table('website_order_list')->where(['user_id'=>session('account.id')])
                    ->where('ordersn', 'like', '%'.$keyword.'%')
                    ->limit($page . ',' . $limit)
                    ->orderBy('id', 'asc')
                    ->get();
                $rows = objtoarr($rows);
            } elseif ($pid==238) {
                #商品咨询
//                $company = Db::connection('shop_db')->table('website_user_company')->where(['id'=>session('manage_person.company_id')])->first();
                $user = Db::connection('shop_db')->table('website_user')->where(['id'=>session('account.id')])->first();
                $user = objtoarr($user);
                $shopping_user = Db::table('user')->where(['gogo_id'=>$user['custom_id']])->first();
                $shopping_user = objtoarr($shopping_user);
                $count = Db::table('goods_history')->where(['user_id'=>$shopping_user['user_id']])->count();
                $rows = Db::table('goods_history as a')
                    ->leftJoin('goods b', 'b.goods_id', '=', 'a.goods_id')
                    ->where(['a.user_id'=>$shopping_user['user_id']])
                    ->where('b.goods_name', 'like', '%'.$keyword.'%')
                    ->limit($page . ',' . $limit)
                    ->orderBy('a.history_id', 'asc')
                    ->select(['b.goods_id','b.goods_name'])
                    ->get();
                $rows = objtoarr($rows);
            } elseif ($pid==239) {
                #决策咨询
                $all_group = Db::connection('shop_db')->table('decision_group_member')->where(['user_id'=>session('account.id'),'status'=>1])->select(['group_id'])->get();
                $all_group = objtoarr($all_group);
                $group_id = '';
                $group_id_arr = [];
                foreach ($all_group as $k=>$v) {
                    $group_id .= $v['group_id'].',';
                    array_push($group_id_arr, $v['group_id']);
                }
                $group_id = rtrim($group_id, ',');

//                ->whereRaw('find_in_set(group_id,?)',[$group_id])
                $count = Db::connection('shop_db')->table('decision_topics')->whereIn('group_id', $group_id_arr)->where('name', 'like', '%'.$keyword.'%')->count();
                $rows = Db::connection('shop_db')->table('decision_topics')->whereIn('group_id', $group_id_arr)
                    ->where('name', 'like', '%'.$keyword.'%')
                    ->limit($page . ',' . $limit)
                    ->orderBy('id', 'desc')
                    ->get();
                $rows = objtoarr($rows);
            } else {
                $count = 3;
                $rows = [['id' => 1, 'ordersn' => '123456'], ['id' => 2, 'ordersn' => '456789'], ['id' => 3, 'ordersn' => '123789']];
            }
            return Response()->json(['code'=>0,'count'=>$count,'data'=>$rows]);
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
            $website['apps'] = $this->apps;

            return view('', compact('website', 'pid'));
        }
    }
    #群组列表
    public function group_list(Request $request)
    {
        $dat = $request->except(['__token']);
        if (isset($dat['pa'])) {
            $limit = $request->get('limit');
            $page = $request->get('page') - 1;
            if ($page != 0) {
                $page = $limit * $page;
            }
            $where =['a.user_id'=>session('account.id'),'a.status'=>1];
            $keyword = isset($dat['keywords']) ? trim($dat['keywords']) : '';

            $count = Db::connection('shop_db')->table('decision_group_member as a')
                ->leftJoin('decision_group b', 'b.id', '=', 'a.group_id')
                ->where($where)
                ->where('b.name', 'like', '%'.$keyword.'%')
                ->count();
            $rows = Db::connection('shop_db')->table('decision_group_member as a')
                ->leftJoin('decision_group b', 'b.id', '=', 'a.group_id')
                ->where($where)
                ->where('b.name', 'like', '%'.$keyword.'%')
                ->limit($page . ',' . $limit)
                ->orderBy('b.id', 'desc')
                ->select(['b.*'])
                ->get();
            $rows = objtoarr($rows);

            foreach ($rows as &$item) {
//                $item['createtime'] = date('Y-m-d H:i:s', $item['createtime']);
            }

            return Response()->json(['code'=>0,'count'=>$count,'data'=>$rows]);
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
            $website['apps'] = $this->apps;

            return view('', compact('website'));
        }
    }
    #保存群组
    public function save_group(Request $request)
    {
        $dat = $request->except(['__token']);
        $id = isset($dat['id']) ? intval($dat['id']) : 0;

        if ($request->ajax()) {
            if ($id>0) {
                Db::connection('shop_db')->table('decision_group')->where(['id'=>$id])->update(['name'=>trim($dat['name'])]);
            } else {
                $insert_id = Db::connection('shop_db')->table('decision_group')->insertGetId([
//                    'company_id'=>session('manage_person.company_id'),
                    'user_id'=>session('account.id'),
                    'name'=>trim($dat['name']),
                    'createtime'=>time()
                ]);

                $insert_data = [];
                foreach ($dat['type'] as $k=>$v) {
                    if ($v==1) {
                        if (empty($dat['user_id'][$k])) {
                            return Response()->json(['code'=>-1,'msg'=>'选择组员不能为空']);
                        }
                    } elseif ($v==2) {
                        if (empty($dat['email'][$k])) {
                            return Response()->json(['code'=>-1,'msg'=>'组员邮箱不能为空']);
                        }
                    }
                    $insert_data = array_merge($insert_data, [['type'=>$v,'user_id'=>$dat['user_id'][$k],'email'=>trim($dat['email'][$k]),'title'=>trim($dat['title'][$k])]]);
                }

                foreach ($insert_data as $k=>$v) {
                    Db::connection('shop_db')->table('decision_group_member')->insert([
                        'group_id'=>$insert_id,
                        'type'=>$v['type'],
                        'user_id'=>$v['user_id'],
                        'email'=>$v['email'],
                        'title'=>$v['title'],
                        'status'=>0
                    ]);

                    if ($v['type']==1) {
                        $data = Db::connection('shop_db')->table('website_user')->where(['id'=>$v['user_id']])->first();
                        $data = objtoarr($data);
                        $name = '';
                        if (!empty($data['realname'])) {
                            $name = $data['realname'];
                        } elseif (!empty($data['nickname'])) {
                            $name = $data['nickname'];
                        } elseif (!empty($data['email'])) {
                            $name = $data['email'];
                        }
                        common_notice2($data, [
                            'title'=>session('account.realname').'邀请你加入群组',
                            'msg'=>'<p>'.$name.'，你好，你的好友'.session('account.realname').'现正式邀请您加入Ta组建的“'.trim($dat['name']).'”互动聊天、商议事务。</p><br/><p>若你，认识'.session('account.realname').'及同意入群聊天，请点击以下链接加入：</p><p>'.'https://www.gogo198.net/?s=member/member_center&tz_url='.base64_encode('https://www.gogo198.net/?s=member/join_group&group_id='.base64_encode($insert_id)).'&footer=1'.'</p><br/><p>若你，不认识'.session('account.realname').'，或认识但不愿意加入有关群组，或对此邮件有疑问，可随时邮件联系我们，或不予理会此邮件，或直接与邀请人联系处理。</p><br/><p>购购网 | Gogo</p>',
                            'opera'=>'待入组',
                            'url'=>'https://www.gogo198.net/?s=member/member_center&tz_url='.base64_encode('https://www.gogo198.net/?s=member/join_group&group_id='.base64_encode($insert_id)).'&footer=1'
                        ]);
//                        kefu_auth_setting($data);
                    } elseif ($v['type']==2) {
                        #邮箱通知
                        common_notice2(['id'=>'','openid'=>'','phone'=>'','email'=>trim($v['email'])], [
                            'title'=>session('account.realname').'邀请你加入群组',
                            'msg'=>'<p>'.$v['email'].'，你好，你的好友'.session('account.realname').'现正式邀请您加入Ta组建的“'.trim($dat['name']).'”互动聊天、商议事务。</p><br/><p>若你，认识'.session('account.realname').'及同意入群聊天，请点击以下链接加入：</p><p>'.'https://www.gogo198.net/?s=member/member_center&tz_url='.base64_encode('https://www.gogo198.net/?s=member/join_group&group_id='.base64_encode($insert_id)).'&footer=1'.'</p><br/><p>若你，不认识'.session('account.realname').'，或认识但不愿意加入有关群组，或对此邮件有疑问，可随时邮件联系我们，或不予理会此邮件，或直接与邀请人联系处理。</p><br/><p>购购网 | Gogo</p>','opera'=>'待入组',
                            'url'=>'https://www.gogo198.net/?s=member/member_center&tz_url='.base64_encode('https://www.gogo198.net/?s=member/join_group&group_id='.base64_encode($insert_id)).'&footer=1'
                        ]);
                    }
                }
            }
            return Response()->json(['code'=>0,'msg'=>'操作成功']);
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
            $website['apps'] = $this->apps;

            $data = ['name'=>''];

            if ($id>0) {
                $data = Db::connection('shop_db')->table('decision_group')->where(['id'=>$id])->first();
                $data = objtoarr($data);
            }

            return view('', compact('id', 'website', 'data'));
        }
    }
    #发起议题
    public function save_topics(Request $request)
    {
        $dat = $request->except(['__token']);
        $id = isset($dat['id']) ? intval($dat['id']) : 0;
        $method = isset($dat['method']) ? $dat['method'] : 0;

        if ($request->ajax()) {
            if ($dat['pa']==1) {
                if ($id>0) {
                    if ($method==3) {
                        #修改议题
                        $starttime = strtotime($dat['starttime']);
                        $endtime = strtotime($dat['endtime']);
                        if ($endtime<=$starttime) {
                            return Response()->json(['code'=>-1,'msg'=>'结束时间不能小于开始时间']);
                        }

                        Db::connection('shop_db')->table('decision_topics')->where(['id'=>$id])->update([
//                            'name'=>trim($dat['name']),
                            'content'=>trim($dat['content']),
                            'files'=>isset($dat['files']) ? json_encode($dat['files'], true) : '',
                            'pass_method'=>intval($dat['pass_method']),
//                            'starttime'=>$starttime,
                            'endtime'=>$endtime,
                            'is_pdf'=>0
                        ]);

                        foreach ($dat['options_name'] as $k=>$v) {
                            if (!empty(trim($v))) {
                                if (isset($dat['options_id'][$k])) {
                                    Db::connection('shop_db')->table('decision_topics_option')->where(['topics_id'=>$id,'id'=>$dat['options_id'][$k]])->update([
                                        'name'=>trim($v),
                                        'content'=>trim($dat['options_remark'][$k])
                                    ]);
                                } else {
                                    Db::connection('shop_db')->table('decision_topics_option')->insert([
                                        'topics_id'=>$id,
                                        'name'=>trim($v),
                                        'content'=>trim($dat['options_remark'][$k])
                                    ]);
                                }
                            }
                        }
                    } elseif ($method==4) {
                        #修改时效
                        $starttime = strtotime($dat['starttime']);
                        $endtime = strtotime($dat['endtime']);
                        if ($endtime<=$starttime) {
                            return Response()->json(['code'=>-1,'msg'=>'结束时间不能小于开始时间']);
                        }

                        Db::connection('shop_db')->table('decision_topics')->where(['id'=>$id])->update([
//                            'starttime'=>$starttime,
                            'endtime'=>$endtime,
                            'is_pdf'=>0
                        ]);
                    }
                } else {
                    $starttime = strtotime($dat['starttime']);
                    $endtime = strtotime($dat['endtime']);
                    if ($endtime<=$starttime) {
                        return Response()->json(['code'=>-1,'msg'=>'结束时间不能小于开始时间']);
                    }

                    #议题编号，这个组当天的顺序号
                    $starttime = strtotime(date('Y-m-d 00:00:00', time()));
                    $endtime = strtotime(date('Y-m-d 23:59:59', time()));
                    $ordersn = Db::connection('shop_db')->table('decision_topics')->whereRaw('group_id='.$dat['group_id'].' and (createtime >= '.$starttime.' and createtime <= '.$endtime.')')->count();
                    $ordersn = sprintf('%03d', $ordersn+1);
//                    dd('BO'.intval($dat['group_id']).date('Ymd').$ordersn);
                    $topics_id = Db::connection('shop_db')->table('decision_topics')->insertGetId([
//                        'company_id'=>session('manage_person.company_id'),
                        'user_id'=>session('account.id'),
                        'ordersn'=>'BO'.intval($dat['group_id']).date('Ymd').$ordersn,
                        'name'=>trim($dat['name']),
                        'group_id'=>intval($dat['group_id']),
                        'cc_member2'=>rtrim($dat['cc_member2']),
                        'content'=>trim($dat['content']),
                        'files'=>isset($dat['files']) ? json_encode($dat['files'], true) : '',
                        'pass_method'=>intval($dat['pass_method']),
                        'starttime'=>$starttime,
                        'endtime'=>$endtime,
                        'createtime'=>time()
                    ]);

                    foreach ($dat['options_name'] as $k=>$v) {
                        if (!empty(trim($v))) {
                            Db::connection('shop_db')->table('decision_topics_option')->insert([
                                'topics_id'=>$topics_id,
                                'name'=>trim($v),
                                'content'=>trim($dat['options_remark'][$k])
                            ]);
                        }
                    }

                    #通知组员,'a.status'=>1
                    $gm = Db::connection('shop_db')->table('decision_group_member as a')
                        ->leftJoin('website_user b', 'b.id', '=', 'a.user_id')
                        ->where(['a.group_id'=>intval($dat['group_id'])])
                        ->select(['b.*'])
                        ->get();
                    $gm = objtoarr($gm);
                    foreach ($gm as $k=>$v) {
//                        common_notice($v,['msg'=>session('manage_person.name').'邀请您参与决策['.trim($dat['name']).']','opera'=>'待参与','url'=>'https://www.gogo198.net/?s=merchant/topics_detail&id='.$topics_id.'&is_edit='.base64_encode('1')]);
//                        common_notice($v,['msg'=>session('manage_person.name').'邀请您参与决策['.trim($dat['name']).']','opera'=>'待参与','url'=>'https://www.gogo198.net/?s=member/topics_detail&id='.$topics_id.'&is_edit='.base64_encode('1')]);
                        common_notice2($v, ['title'=>session('account.realname').'邀请您查看决策['.trim($dat['name']).']','msg'=>session('account.realname').'邀请您参与决策['.trim($dat['name']).']','opera'=>'待参与','url'=>'https://www.gogo198.net/?s=member/member_center&tz_url='.base64_encode('https://www.gogo198.net/?s=member/topics_list&id='.$topics_id.'&is_edit='.base64_encode('1')).'&footer=2']);
                    }

                    #通知抄送人员
                    $cc_member2 = explode('、', rtrim($dat['cc_member2']));
                    foreach ($cc_member2 as $k=>$v) {
//                        common_notice(['id'=>'','email'=>$v,'openid'=>'','phone'=>''],['msg'=>session('manage_person.name').'邀请您查看决策['.trim($dat['name']).']','opera'=>'待查看','url'=>'https://www.gogo198.net/?s=member/topics_detail&id='.$topics_id.'&is_edit='.base64_encode('0')]);
                        common_notice2(['id'=>'','email'=>$v,'openid'=>'','phone'=>''], ['title'=>session('account.realname').'邀请您查看决策['.trim($dat['name']).']','opera'=>'待查看','msg'=>'请点击链接查看：https://www.gogo198.net/?s=member/member_center&tz_url='.base64_encode('https://www.gogo198.net/?s=member/topics_list&id='.$topics_id.'&is_edit='.base64_encode('0')).'&footer=2']);
                    }
                }
            }

            return Response()->json(['code'=>0,'msg'=>'操作成功']);
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
            $website['apps'] = $this->apps;

            #群组
            $group = Db::connection('shop_db')->table('decision_group')->where(['user_id'=>session('account.id')])->get();
            $group = objtoarr($group);

            $data = ['name'=>'','group_id'=>0,'cc_member2'=>'','content'=>'','files'=>[],'pass_method'=>1,'starttime'=>date('Y-m-d H:i', time()),'endtime'=>date('Y-m-d H:i', time()+3600)];
            if ($id>0) {
                $data = Db::connection('shop_db')->table('decision_topics')->where(['id'=>$id])->first();
                $data = objtoarr($data);
                if (!empty($data['files'])) {
                    $data['files'] = json_decode($data['files'], true);
                }
                $data['starttime'] = date('Y-m-d H:i', $data['starttime']);
                $data['endtime'] = date('Y-m-d H:i', $data['endtime']);

                $data['options'] = Db::connection('shop_db')->table('decision_topics_option')->where(['topics_id'=>$id])->get();
                $data['options'] = objtoarr($data['options']);
            }

            return view('', compact('website', 'id', 'group', 'data', 'method'));
        }
    }
    #删除选项
    public function del_options(Request $request)
    {
        $dat = $request->except(['__token']);
        $res=Db::connection('shop_db')->table('decision_topics_option')->where(['topics_id'=>intval($dat['topics_id']),'name'=>trim($dat['name'])])->delete();
        if ($res) {
            return Response()->json(['code'=>0,'msg'=>'删除成功']);
        }
    }
    #管理议题
    public function topics_manage(Request $request)
    {
        $dat = $request->except(['__token']);
        $pa = isset($dat['pa']) ? $dat['pa'] : 0;
        $group_id = isset($dat['group_id']) ? intval($dat['group_id']) : 0;

        if (isset($dat['pa2'])) {
            $limit = $request->get('limit');
            $page = $request->get('page') - 1;
            if ($page != 0) {
                $page = $limit * $page;
            }

            $keyword = isset($dat['keywords']) ? trim($dat['keywords']) : '';

            if ($dat['pa2']==1) {
                #我发起的
                $where =['user_id'=>session('account.id')];
                $count = Db::connection('shop_db')->table('decision_topics')->where($where)->where('name', 'like', '%'.$keyword.'%')->count();
                $rows = Db::connection('shop_db')->table('decision_topics')->where($where)
                    ->where('name', 'like', '%'.$keyword.'%')
                    ->limit($page . ',' . $limit)
                    ->orderBy('id', 'desc')
                    ->get();
            } elseif ($dat['pa2']==2) {
                #我参与的
                if ($group_id>0) {
                    $all_group = Db::connection('shop_db')->table('decision_group_member')->where(['user_id'=>session('account.id'),'status'=>1,'group_id'=>$group_id])->select(['group_id'])->get();
                    $all_group = objtoarr($all_group);
                } else {
                    $all_group = Db::connection('shop_db')->table('decision_group_member')->where(['user_id'=>session('account.id'),'status'=>1])->select(['group_id'])->get();
                    $all_group = objtoarr($all_group);
                }
//                $group_id = '';
                $group_id_arr = [];
                foreach ($all_group as $k=>$v) {
//                    $group_id .= $v['group_id'].',';
                    array_push($group_id_arr, $v['group_id']);
                }
//                $group_id = rtrim($group_id,',');

//                ->whereRaw('find_in_set(group_id,?)',[$group_id])
                $count = Db::connection('shop_db')->table('decision_topics')->whereIn('group_id', $group_id_arr)->where('name', 'like', '%'.$keyword.'%')->count();
                $rows = Db::connection('shop_db')->table('decision_topics')->whereIn('group_id', $group_id_arr)
                    ->where('name', 'like', '%'.$keyword.'%')
                    ->limit($page . ',' . $limit)
                    ->orderBy('id', 'desc')
                    ->get();
                $rows = objtoarr($rows);
            }

            foreach ($rows as &$item) {
                if ($item['status']==0) {
                    $item['status_name'] = '进行中';
                } elseif ($item['status']==-1) {
                    $item['status_name'] = '不通过';
                } elseif ($item['status']==1) {
                    $item['status_name'] = '通过';
                }
//                $item['createtime'] = date('Y-m-d H:i:s', $item['createtime']);
            }
            return Response()->json(['code'=>0,'count'=>$count,'data'=>$rows]);
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
            $website['apps'] = $this->apps;

            return view('', compact('website', 'pa', 'group_id'));
        }
    }
    #管理决策
    public function topics_manage2(Request $request)
    {
        $dat = $request->except(['__token']);

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
        $website['apps'] = $this->apps;

        #议题id
        $topics_id = intval($dat['id']);
        #1、参与决策0/更改决策1
        $topics = Db::connection('shop_db')->table('decision_topics')->where(['id'=>$topics_id])->first();
        $topics = objtoarr($topics);
        #判断当前人是否在该群组
        $is_ingroup = Db::connection('shop_db')->table('decision_group_member')->where(['group_id'=>$topics['group_id'],'user_id'=>session('account.id')])->first();
        $is_ingroup = objtoarr($is_ingroup);
        if (empty($is_ingroup)) {
            $info['is_ending'] = 0;
        } else {
            if (time()>$topics['endtime']) {
                #已结束
                $info['is_ending'] = 0;
            } else {
                #决策进行中
                $info['is_ending'] = 1;
                $is_join = Db::connection('shop_db')->table('decision_topics_selected')->where(['topics_id'=>$topics_id,'uid'=>session('account.id')])->first();
                $is_join = objtoarr($is_join);
                $info['is_join'] = empty($is_join) ? 0 : 1;
            }
        }


        #2、查看该议题是否“我发起的”
        $is_me = Db::connection('shop_db')->table('decision_topics')->where(['user_id'=>session('account.id')])->first();
        $is_me = objtoarr($is_me);
        if (!empty($is_me)) {
            #3、更改议题
            $is_empty = Db::connection('shop_db')->table('decision_topics_selected')->where(['topics_id'=>$topics_id])->first();
            $is_empty = objtoarr($is_empty);
            $info['is_empty'] = empty($is_empty) ? 1 : 0;
            #4、更改时效
            $info['is_date'] = 1;
            #5、分享决策
            $info['is_share_topics'] = 1;
            #6、分享决议
            if (time()>$is_me['endtime']) {
                #已结束
                $info['is_share_chat'] = 1;
            } else {
                $info['is_share_chat'] = 0;
            }
        } else {
            #3、更改议题
            $info['is_empty'] = 0;
            #4、更改时效
            $info['is_date'] = 0;
            #5、分享决策
            $info['is_share_topics'] = 0;
            #6、分享决议
            $info['is_share_chat'] = 0;
        }

        return view('', compact('topics_id', 'website', 'info'));
    }
    #参与决策
    public function topics_detail(Request $request)
    {
        $dat = $request->except(['__token']);
//        session(null);
        if (empty(session('account'))) {
            $url_this = '//www.gogo198.cn'.$_SERVER["REQUEST_URI"];
            header('Location:/login.html?open=4&param2='.base64_encode($url_this));
            exit;
        }

        $id = isset($dat['id']) ? intval($dat['id']) : 0;
        $is_edit = isset($dat['is_edit']) ? base64_decode($dat['is_edit']) : 0;

        if ($request->ajax()) {
            $ishave = Db::connection('shop_db')->table('decision_topics_selected')->where(['topics_id'=>intval($dat['id']),'uid'=>session('account.id')])->first();
            if (!empty($ishave)) {
                Db::connection('shop_db')->table('decision_topics_selected')->where(['topics_id'=>intval($dat['id']),'uid'=>session('account.id')])->update(['option_id'=>intval($dat['option_id'])]);
            } else {
                Db::connection('shop_db')->table('decision_topics_selected')->insert([
                    'topics_id'=>intval($dat['id']),
                    'option_id'=>intval($dat['option_id']),
                    'uid'=>session('account.id'),
                    'createtime'=>time()
                ]);
            }
            return Response()->json(['code'=>0,'msg'=>'操作成功']);
        } else {
//            $arr = [];
//            $counts = array_count_values($arr);
//            // 找到出现次数最多的元素的值
//            $maxCount = max($counts);
//            $mostFrequentValue = array_search($maxCount, $counts);
//            dd($maxCount);
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
            $website['apps'] = $this->apps;

            #议题
            $data = Db::connection('shop_db')->table('decision_topics')->where(['id'=>$id])->first();
            $data = objtoarr($data);
            #查看有无入组
            $is_join = Db::connection('shop_db')->table('decision_group_member')->where(['group_id'=>$data['group_id'],'user_id'=>session('account.id')])->first();
            $is_join = objtoarr($is_join);

            $data['files'] = json_decode($data['files'], true);
            $data['options'] = Db::connection('shop_db')->table('decision_topics_option')->where(['topics_id'=>$id])->get();
            $data['options'] = objtoarr($data['options']);

            #已选选项
            $data['selected'] = Db::connection('shop_db')->table('decision_topics_selected')->where(['topics_id'=>$id,'uid'=>session('account.id')])->first();
            $data['selected'] = objtoarr($data['selected']);

            #议题状态
            #5、判断议题是否“已结束”或“进行中”
            $data['is_ending'] = 0;
            if (time() > $data['endtime']) {
                #已结束
                $data['is_ending'] = 1;
                $data['is_pass'] = topics_result($data);
            }

            $data['starttime'] = date('Y-m-d H:i', $data['starttime']);
            $data['endtime'] = date('Y-m-d H:i', $data['endtime']);

            return view('', compact('id', 'website', 'data', 'is_edit', 'is_join'));
        }
    }
    #议题列表和当前发起议题id排在最上面
    public function topics_list(Request $request)
    {
        $dat = $request->except(['__token']);
        $url_this = '//www.gogo198.cn'.$_SERVER["REQUEST_URI"];

        if (empty(session('account'))) {
            header('Location:/login.html?open=4&param2='.base64_encode($url_this));
            exit;
        }

        #判断组员有无微信公众号openid，无就跳转到补充“基本信息页”
        $member = Db::connection('shop_db')->table('website_user')->where(['id'=>session('account.id')])->first();
        $member = objtoarr($member);

        if (empty($member['openid'])) {
            header('Location: /member/save_basic&param2='.base64_encode($url_this));
        }

        $id = isset($dat['id']) ? intval($dat['id']) : 0;
        $is_edit = isset($dat['is_edit']) ? base64_decode($dat['is_edit']) : 0;

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
        $website['apps'] = $this->apps;

        $is_join = ['status'=>1,'group_id'=>0];
        if ($is_edit==0) {
            #抄送人员，查找该议题结果
            $topics_list = Db::connection('shop_db')->table('decision_topics')->where(['id' => $id])->get();
            $topics_list = objtoarr($topics_list);

            foreach ($topics_list as $k => $v) {
                #3、查看该议题有多少人投票的
                $total_people = Db::connection('shop_db')->table('decision_group_member')->where(['group_id' => $v['group_id'], 'status' => 1])->count();

                #4、判断议题是否已全员投票,0未全员，1已全员
                $topics_list[$k]['is_quanyuan'] = 0;
                $selected_num = Db::connection('shop_db')->table('decision_topics_selected')->where(['topics_id' => $v['id']])->count();
                if ($selected_num == $total_people) {
                    #已全员
                    $topics_list[$k]['is_quanyuan'] = 1;
                }

                #5、判断议题是否“已结束”或“进行中”
                $topics_list[$k]['is_ending'] = 0;
                if (time() > $v['endtime']) {
                    #已结束
                    $topics_list[$k]['is_ending'] = 1;
                }

                if ($topics_list[$k]['is_quanyuan'] == 1) {
                    #已全员投票
                    #6、判断议题是否符合要求，0不符合，1符合
                    $topics_list[$k]['is_pass'] = topics_result($v);
                }
            }
        } elseif ($is_edit==1) {
            #1、查找本人参与过的议题
            $topics_list = Db::connection('shop_db')->table('decision_group_member as a')
                ->leftJoin('decision_topics b', 'b.group_id', '=', 'a.group_id')
                ->where(['a.user_id' => session('account.id')])
                ->select(['b.*'])
                ->orderBy('b.id', 'desc')
                ->get();
            $topics_list = objtoarr($topics_list);

            $origin_key = 0;
            foreach ($topics_list as $k => $v) {
                #2、如有议题id时当前议题排第一
                if ($id > 0) {
                    if ($v['id'] == $id) {
                        $origin_key = $k;
                    }
                }

                #3、查看该议题有多少人投票的
                $total_people = Db::connection('shop_db')->table('decision_group_member')->where(['group_id' => $v['group_id'], 'status' => 1])->count();

                #4、判断议题是否已全员投票,0未全员，1已全员
                $topics_list[$k]['is_quanyuan'] = 0;
                $selected_num = Db::connection('shop_db')->table('decision_topics_selected')->where(['topics_id' => $v['id']])->count();
                #4.1、该议题是否已发生投票
                $topics_list[$k]['already_resolution'] = $selected_num;
                if ($selected_num == $total_people) {
                    #已全员
                    $topics_list[$k]['is_quanyuan'] = 1;
                }

                #5、判断议题是否“已结束”或“进行中”
                $topics_list[$k]['is_ending'] = 0;
                if (time() > $v['endtime']) {
                    #已结束
                    $topics_list[$k]['is_ending'] = 1;
                }

                if ($topics_list[$k]['is_quanyuan'] == 1) {
                    #已全员投票
                    #6、判断议题是否符合要求，0不符合，1符合
                    $topics_list[$k]['is_pass'] = topics_result($v);
                }

                #7、查看自己有无决议
                $is_resolution = Db::connection('shop_db')->table('decision_topics_selected')->where(['uid'=>session('account.id'),'topics_id'=>$v['id']])->first();
                $is_resolution = objtoarr($is_resolution);
                $topics_list[$k]['is_resolution'] = 0;
                if (!empty($is_resolution)) {
                    $topics_list[$k]['is_resolution'] = 1;
                }
            }

            if ($origin_key > 0) {
                #如有议题id时当前议题排第一，第一的替换为本议题原位置
                $topics_data = $topics_list[0];
                $topics_list[0] = $topics_list[$origin_key];
                $topics_list[$origin_key] = $topics_data;
            }

            if ($id>0) {
                #查看有无入组
                $is_join = Db::connection('shop_db')->table('decision_topics as a')
                    ->leftJoin('decision_group_member b', 'b.group_id', '=', 'a.group_id')
                    ->where(['b.user_id'=>session('account.id'),'a.id'=>$id])
                    ->select(['b.*'])
                    ->first();
                $is_join = objtoarr($is_join);
            }
        }

        return view('', compact('id', 'website', 'data', 'is_edit', 'topics_list', 'is_join'));
    }
    #我发起的
    public function send_topics_list(Request $request)
    {
        $dat = $request->except(['__token']);

        if (empty(session('account'))) {
            $url_this = '//www.gogo198.cn'.$_SERVER["REQUEST_URI"];
            header('Location:/login.html?open=4&param2='.base64_encode($url_this));
            exit;
        }

        #1、查找本人发起的议题
        $topics_list = Db::connection('shop_db')->table('decision_topics')
            ->where(['user_id' => session('account.id')])
            ->orderBy('id', 'desc')
            ->get();
        $topics_list = objtoarr($topics_list);

        foreach ($topics_list as $k=>$v) {
            #3、查看该议题有多少人投票的
            $total_people = Db::connection('shop_db')->table('decision_group_member')->where(['group_id' => $v['group_id'], 'status' => 1])->count();

            #4、判断议题是否已全员投票,0未全员，1已全员
            $topics_list[$k]['is_quanyuan'] = 0;
            $selected_num = Db::connection('shop_db')->table('decision_topics_selected')->where(['topics_id' => $v['id']])->count();
            #4.1、该议题是否已发生投票
            $topics_list[$k]['already_resolution'] = $selected_num;
            if ($selected_num == $total_people) {
                #已全员
                $topics_list[$k]['is_quanyuan'] = 1;
            }

            #5、判断议题是否“已结束”或“进行中”
            $topics_list[$k]['is_ending'] = 0;
            if (time() > $v['endtime']) {
                #已结束
                $topics_list[$k]['is_ending'] = 1;
            }

            if ($topics_list[$k]['is_quanyuan'] == 1) {
                #已全员投票
                #6、判断议题是否符合要求，0不符合，1符合
                $topics_list[$k]['is_pass'] = topics_result($v);
            }
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
        $website['apps'] = $this->apps;

        return view('', compact('id', 'website', 'topics_list'));
    }
    #群组列表
    public function join_group(Request $request)
    {
        $dat = $request->except(['__token']);
//        session(null);
        $page_id = isset($dat['page_id']) ? intval($dat['page_id']) : 0;
        $url_this = '//www.gogo198.net'.$_SERVER["REQUEST_URI"];

        if (empty(session('account'))) {
            header('Location:/?s=index/customer_login&open=4&param2='.base64_encode($url_this));
            exit;
        }

        $group_id = isset($dat['group_id']) ? base64_decode($dat['group_id']) : 0;

        if ($request->ajax()) {
            $res = Db::connection('shop_db')->table('decision_group_member')->where(['group_id'=>intval($dat['group_id']),'user_id'=>session('account.id')])->update(['status'=>intval($dat['status'])]);
            if ($res) {
                return Response()->json(['code'=>0,'msg'=>'操作成功']);
            }
        } else {
            $menu = $this->menu();
            $menu_footer = $this->menu_footer();
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
            $website['apps'] = $this->apps;

            #记录发送“邮箱”方式时，记录组员id
            if (!empty($group_id)) {
                $is_group_member = Db::connection('shop_db')->table('decision_group_member')->where(['group_id'=>$group_id,'user_id'=>session('account.id')])->first();
                $is_group_member = objtoarr($is_group_member);
                if (empty($is_group_member)) {
                    if (!empty(session('account.email'))) {
                        $is_group_member = Db::connection('shop_db')->table('decision_group_member')->where(['group_id'=>$group_id,'email'=>session('account.email')])->first();
                        $is_group_member = objtoarr($is_group_member);

                        if (empty($is_group_member['user_id'])) {
                            Db::connection('shop_db')->table('decision_group_member')->where(['id'=>$is_group_member['id']])->update(['user_id'=>session('account.id')]);
                            Db::connection('shop_db')->table('platform_notice_list')->where(['email'=>session('account.email')])->update(['uid'=>session('account.id')]);
                        }
                    }
                }
            }

            #判断组员有无微信公众号openid，无就跳转到补充“基本信息页”
            $member = Db::connection('shop_db')->table('website_user')->where(['id'=>session('account.id')])->first();
            $member = objtoarr($member);
            if (empty($member['openid']) || empty($member['email'])) {
                header('Location: /member/save_basic&param2='.base64_encode($url_this));
            }


            #1、查找当前用户的所有群组
            $group = Db::connection('shop_db')->table('decision_group_member as a')
                ->leftJoin('decision_group b', 'b.id', '=', 'a.group_id')
                ->leftJoin('website_user c', 'c.id', '=', 'b.user_id')
                ->where(['a.user_id'=>session('account.id')])
                ->select(['b.*','a.status','c.nickname as grouper_name'])
                ->get();
            $group = objtoarr($group);

            $origin_key=0;
            foreach ($group as $k=>$v) {
                #2、如有群组id时当前群组排第一
                if ($group_id > 0) {
                    if ($v['id'] == $group_id) {
                        $origin_key = $k;
                    }
                }

                #3、查看该群组有无议题
                $group[$k]['topics_id'] = Db::connection('shop_db')->table('decision_topics')->where(['group_id'=>$v['id']])->select('id')->first()->id;
            }
            if ($origin_key > 0) {
                #如有议题id时当前议题排第一，第一的替换为本议题原位置
                $group_data = $group[0];
                $group[0] = $group[$origin_key];
                $group[$origin_key] = $group_data;
            }

            return view('', compact('website', 'group', 'menu', 'menu_footer', 'page_id', 'is_group_member'));
        }
    }
    #获取名称
    public function get_name(Request $request)
    {
        $dat = $request->except(['__token']);
        $val = trim($dat['val']);
        $type = intval($dat['type']);

        $list = [];
        if ($val != '') {
            if ($type==1) {
                #通用名称
                $array = Db::table('goods')->whereRaw('goods_name like "%'.$val.'%"')->select(['goods_name'])->get();
                $array = objtoarr($array);
//                $list2 = Db::connect($this->medical_config)->name('goods_temp')->whereRaw('name like "%'.$val.'%"')->select('name,en_name')->get();
//                $array = array_merge($list1,$list2);
                foreach ($array as $item) {
                    if (!in_array($item, $list)) {
                        $list[] = $item;
                    }
                }
            } elseif ($type==2) {
                #英文名称
                $array = Db::table('goods')->whereRaw('goods_name like "%'.$val.'%"')->select(['goods_name'])->get();
                $array = objtoarr($array);
//                $list1 = Db::connect($this->medical_config)->name('goods')->whereRaw('en_name like "%'.$val.'%"')->select('name,en_name')->get();
//                $list2 = Db::connect($this->medical_config)->name('goods_temp')->whereRaw('en_name like "%'.$val.'%"')->select('name,en_name')->get();
//                $array = array_merge($list1,$list2);
                foreach ($array as $item) {
                    if (!in_array($item, $list)) {
                        $list[] = $item;
                    }
                }
            } elseif ($type==3) {
                #通过“手机”或“邮箱号”搜索组员
                $list = Db::connection('shop_db')->table('website_user')->whereRaw('phone like "%'.$val.'%" or email like "%'.$val.'%"')->get();
                foreach ($list as $k=>$v) {
                    $name = '';
                    if (!empty($v['realname'])) {
                        $name = $v['realname'];
                    } elseif (!empty($v['nickname'])) {
                        $name = $v['nickname'];
                    }

                    if (!empty($v['phone'])) {
                        $name .= '-'.$v['phone'];
                    } elseif (!empty($v['email'])) {
                        $name .= '-'.$v['email'];
                    }
                    $list[$k]['name'] = $name;
                }
            }

            if (!empty($list)) {
                return Response()->json(['code'=>0,'list'=>$list]);
            } else {
                return Response()->json(['code'=>-1,'list'=>$list]);
            }
        } else {
            return Response()->json(['code'=>-1,'list'=>$list]);
        }
    }
    #我的基本信息页
    public function save_basic(Request $request)
    {
        $dat = $request->except(['__token']);
        $param2 = isset($dat['param2']) ? base64_decode($dat['param2']) : '';
        if ($request->ajax()) {
            $info = ['realname'=>trim($dat['realname']),'nickname'=>trim($dat['nickname'])];

            if (isset($dat['area_code'])) {
                $info = array_merge($info, ['area_code'=>$dat['area_code']]);
            }
            if (isset($dat['phone'])) {
                $info = array_merge($info, ['phone'=>trim($dat['phone'])]);
            }
            if (isset($dat['email'])) {
                $info = array_merge($info, ['email'=>trim($dat['email'])]);
                #对碰群组是否已有该邮箱
                Db::connection('shop_db')->table('decision_group_member')->where(['user_id'=>0,'email'=>trim($dat['email'])])->update(['user_id'=>session('account.id')]);
            }

            Db::connection('shop_db')->table('website_user')->where(['id'=>session('account.id')])->update($info);
            return Response()->json(['code'=>0,'msg'=>'提交成功']);
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
            $website['apps'] = $this->apps;

            $info = Db::connection('shop_db')->table('website_user')->where(['id'=>session('account.id')])->first();
            $info = objtoarr($info);
            return view('', compact('website', 'info', 'param2'));
        }
    }
    #查看用户有无关注公众号
    public function check_follow(Request $request)
    {
        $dat = $request->except(['__token']);

        $user = Db::connection('shop_db')->table('website_user')->where(['id'=>session('account.id')])->first();
        $user = objtoarr($user);
        if (!empty($user['openid'])) {
            session('account', $user);
            return Response()->json(['code'=>0,'msg'=>'已关注公号，正在跳转...']);
        } else {
            return Response()->json(['code'=>-1,'msg'=>'未关注公号，等待操作...']);
        }
    }
    #聊天列表
    public function chat_list(Request $request)
    {
        $dat = $request->except(['__token']);
        if (isset($dat['pid2'])) {
            $dat['pid'] = $dat['pid2'];
        }
        $list = Db::connection('shop_db')->table('centralize_manage_menu')->where(['pid'=>intval($dat['pid']),'status'=>0])->get();
        $list = objtoarr($list);
        foreach ($list as $k=>$v) {
            if ($v['id']==237) {
                #订单
                $list[$k]['list'] = Db::connection('shop_db')->table('website_order_list')->where(['user_id'=>session('account.id')])->orderBy('id desc')->get();
                $list[$k]['list'] = objtoarr($list[$k]['list']);
            } elseif ($v['id']==238) {
                #商品
                $shopping_user = Db::table('user')->where(['gogo_id'=>session('account.custom_id')])->first();
                $shopping_user = objtoarr($shopping_user);
                $list[$k]['list'] = Db::table('goods_history as a')
                    ->leftJoin('goods b', 'b.goods_id', '=', 'a.goods_id')
                    ->where(['a.user_id'=>$shopping_user['user_id']])
                    ->orderBy('a.history_id', 'desc')
                    ->select(['b.goods_id','b.goods_name'])
                    ->get();
                $list[$k]['list'] = objtoarr($list[$k]['list']);
            } elseif ($v['id']==239) {
                #决策
                $all_group = Db::connection('shop_db')->table('decision_group_member')->where(['user_id'=>session('account.id'),'status'=>1])->select(['group_id'])->get();
                $all_group = objtoarr($all_group);
//                $group_id = '';
                $group_id_arr = [];
                foreach ($all_group as $k2=>$v2) {
//                    $group_id .= $v2['group_id'].',';
                    array_push($group_id_arr, $v2['group_id']);
                }
//                $group_id = rtrim($group_id,',');
                $list[$k]['list'] = Db::connection('shop_db')->table('decision_topics')->whereIn('group_id', $group_id_arr)
                    ->orderBy('id', 'desc')
                    ->get();
                $list[$k]['list'] = objtoarr($list[$k]['list']);
            }
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
        $website['apps'] = $this->apps;

        return view('', compact('website', 'list'));
    }
    #分享议题
    public function share_topics(Request $request)
    {
        $dat = $request->except(['__token']);
        $id = $dat['id'];
        $folder = $_SERVER['DOCUMENT_ROOT'].'/qrcode/topics_code/';
        $img = generate_code('topics_'.$id, 'https://www.gogo198.net/?s=member/member_center&tz_url='.base64_encode('https://www.gogo198.net/?s=member/topics_detail&id='.$id.'&is_edit='.base64_encode(0)).'&footer=2', $folder);
        return Response()->json(['code'=>0,'img'=>$img]);
    }

    #建议咨询
    public function advice_list(Request $request)
    {
        $dat = $request->except(['__token']);

        $list = Db::connection('shop_db')->table('website_message')->where(['uid'=>session('account.id')])->orderBy('id desc')->get();
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
        $website['apps'] = $this->apps;

        return view('', compact('website', 'list'));
    }

    public function save_advice(Request $request)
    {
        $dat = $request->except(['__token']);
        $id = isset($dat['id']) ? intval($dat['id']) : 0;

        if (isset($dat['pa'])) {
            $res = Db::connection('shop_db')->table('website_message')->insert([
                'uid'=>session('account.id'),
                'name'=>session('account.nickname'),
                'tel'=>session('account.phone'),
                'email'=>session('account.email'),
                'remark'=>trim($dat['remark']),
                'createtime'=>time()
            ]);

            if ($res) {
                return Response()->json(['code'=>0,'msg'=>'提交成功']);
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
            $website['apps'] = $this->apps;

            $data = ['remark'=>''];
            if ($id>0) {
                $data = Db::connection('shop_db')->table('website_message')->where(['id'=>$id])->first();
                $data = objtoarr($data);
            }

            return view('', compact('website', 'data', 'id'));
        }
    }

    #社媒账户
    public function social_list(Request $request)
    {
        $dat = $request->except(['__token']);

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
        $website['apps'] = $this->apps;

        return view('', compact('website', 'info', 'param2'));
    }
    #决策管理=================================================================END
}
