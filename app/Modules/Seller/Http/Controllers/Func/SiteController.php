<?php

namespace App\Modules\Seller\Http\Controllers\Func;

use App\Modules\Base\Http\Controllers\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteController extends Seller
{
    #上传文件
    public function upload_file(Request $request)
    {
        $data = $request->except(['_token']);

        $file = $request->file('file');
        // 准备要上传的文件
        $file_name = $file->getClientOriginalName(); // 获取文件名
        $file_size = $file->getSize(); // 获取文件大小
        try {
            $file_data = [
                "name" => $file_name,
                "type" => $_FILES["file"]['type'],
                "tmp_name" => $_FILES['file']['tmp_name'],
                "error" => 0,
                "size" => $file_size,
            ];
            $post_data = json_encode(['folder' => $data['folder'], 'type' => $data['type'], 'file' => $file_data], true);
            $res = httpRequest('https://shop.gogo198.cn/collect_website/public/?s=api/uploadfile/index', $post_data, [
                'Content-Type: application/json; charset=utf-8',
                'Content-Length:' . strlen($post_data),
                'Cache-Control: no-cache',
                'Pragma: no-cache'
            ]);
            $res = json_decode($res, true);
            if ($res['code']==1) {
                return json_encode(["code" => 1, "message" => "上传成功", "file_path" => $res['file_path'] ], true);
            } else {
                return json_encode(["code" => 0, "message" => "上传失败", "path" => "" ], true);
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function get_merchant()
    {
        #获取当前商户的企业
        $manage = Db::connection('shop_db')->table('centralize_manage_person')->where(['id'=>Session('seller.mid')])->first();
        return $manage;
    }

    #基本信息
    public function basic_info(Request $request)
    {
        $dat = $request->except(['_token']);

        #获取当前商户的企业
        $manage = Db::connection('shop_db')->table('centralize_manage_person')->where(['id'=>Session('seller.mid')])->first();

        $data = Db::connection('shop_db')->table('website_basic')->where(['company_id'=>$manage->company_id])->first();
        $data = objtoarr($data);

        if ($request->isMethod('post')) {
            if (!empty($data)) {
                $res = Db::connection('shop_db')->table('website_basic')->where(['company_id'=>$manage->company_id])->update([
                    'name'=>trim($dat['name']),
                    'desc'=>trim($dat['desc']),
                    'keywords'=>trim($dat['keywords']),
                    'mobile'=>trim($dat['mobile']),
                    'email'=>trim($dat['email']),
                    'service_time'=>trim($dat['service_time']),
                    'join_us'=>trim($dat['join_us']),
                    'service_rule'=>intval($dat['service_rule']),
                    'privacy_rule'=>intval($dat['privacy_rule']),
                    'slogo'=>$dat['slogo_file'][0],
                    'logo'=>$dat['logo_file'][0],
                    'inpic'=>isset($dat['inpic'][0]) ? $dat['inpic'][0] : '',//首页背景图
                    'copyright'=>json_encode($dat['copyright'], true),
                    'content'=>json_encode($dat['content'], true),
                ]);
            } else {
                $res = Db::connection('shop_db')->table('website_basic')->insert([
                    'company_id'=>$manage->company_id,
                    'name'=>trim($dat['name']),
                    'desc'=>trim($dat['desc']),
                    'keywords'=>trim($dat['keywords']),
                    'mobile'=>trim($dat['mobile']),
                    'email'=>trim($dat['email']),
                    'service_time'=>trim($dat['service_time']),
                    'join_us'=>trim($dat['join_us']),
                    'service_rule'=>intval($dat['service_rule']),
                    'privacy_rule'=>intval($dat['privacy_rule']),
                    'slogo'=>$dat['slogo_file'][0],
                    'logo'=>$dat['logo_file'][0],
                    'inpic'=>isset($dat['inpic'][0]) ? $dat['inpic'][0] : '',//首页背景图
                    'copyright'=>json_encode($dat['copyright'], true),
                    'content'=>json_encode($dat['content'], true),
                ]);
            }

            return Response()->json(['code' => 0, 'msg' => '保存成功！']);
        } else {
            if (!empty($data)) {
                $data['copyright'] = json_decode($data['copyright'], true);
                $data['content'] = json_decode($data['content'], true);
            } else {
                $data = ['slogo'=>'','logo'=>'','inpic'=>'','name'=>'','desc'=>'','keywords'=>'','mobile'=>'','email'=>'','service_time'=>'','join_us'=>'','service_rule'=>'','privacy_rule'=>'','content'=>['introduce'=>'','help'=>'','copyright'=>'']];
            }

            $rule = Db::connection('shop_db')->table('website_platform_rule')->get();
            $rule = objtoarr($rule);
            return view('func.site.basic_info', compact('data', 'rule'));
        }
    }

    #轮播图管理
    public function rotate_manage(Request $request)
    {
        $data = $request->except(['_token']);

        if (isset($data['pa'])) {
            $limit = $request->get('limit');
            $page = $request->get('page') - 1;
            if ($page != 0) {
                $page = $limit * $page;
            }
            $keyword = $request->get('keywords') ? $request->get('keywords') : '';

            $manage = $this->get_merchant();

            $count = Db::connection('shop_db')->table('website_rotate')->where(['company_id'=>$manage->company_id])->count();
            $rows = DB::connection('shop_db')->table('website_rotate')->where(['company_id'=>$manage->company_id])
                ->offset($page)
                ->limit($limit)
                ->orderBy('id', 'desc')
                ->get()
                ->toArray();

            $rows = objtoarr($rows);

            foreach ($rows as &$item) {
            }

            return response()->json(['code'=>0,'count'=>$count,'data'=>$rows]);
        } else {
            return view('func.site.rotate_manage', compact(''));
        }
    }

    public function save_rotate(Request $request)
    {
        $dat = $request->except(['_token']);
        $id = isset($dat['id']) ? intval($dat['id']) : 0;

        if ($request->isMethod('post')) {
            if ($id>0) {
                Db::connection('shop_db')->table('website_rotate')->where('id', $id)->update([
                    'title'=>$dat['title'],
                    'thumb'=>$dat['thumb'][0],
                    'go_other'=>$dat['go_other'],
                    'other_link'=>$dat['go_other']==1 ? trim($dat['other_link']) : '',
                    'other_navbar'=>$dat['go_other']==2 ? trim($dat['other_navbar']) : 0,
                    'other_pic'=>$dat['go_other']==3 ? trim($dat['other_pic']) : 0,
                    'other_msg'=>$dat['go_other']==4 ? trim($dat['other_msg']) : 0,
                ]);
            } else {
                $manage = $this->get_merchant();

                Db::connection('shop_db')->table('website_rotate')->insert([
                    'company_id'=>$manage->company_id,
                    'title'=>$dat['title'],
                    'thumb'=>$dat['thumb'][0],
                    'go_other'=>$dat['go_other'],
                    'other_link'=>$dat['go_other']==1 ? trim($dat['other_link']) : '',
                    'other_navbar'=>$dat['go_other']==2 ? trim($dat['other_navbar']) : 0,
                    'other_pic'=>$dat['go_other']==3 ? trim($dat['other_pic']) : 0,
                    'other_msg'=>$dat['go_other']==4 ? trim($dat['other_msg']) : 0,
                ]);
            }

            return Response()->json(['code'=>0,'msg'=>'保存成功！']);
        } else {
            $data = ['title'=>'','thumb'=>'','go_other'=>'','other_link'=>'','other_navbar'=>'','other_pic'=>'','other_msg'=>''];
            if ($id>0) {
                $data = Db::connection('shop_db')->table('website_rotate')->where('id', $id)->first();
                $data = objtoarr($data);
            }

            #应用链接
            $list = Db::table('guide_frame')->where(['type'=>1])->get();
            $list = objtoarr($list);

            #图文链接
            $pic_list = Db::connection('shop_db')->table('website_image_txt')->get();
            $pic_list = objtoarr($pic_list);
            foreach ($pic_list as $k=>$v) {
                $pic_list[$k]['name'] = json_decode($v['name'], true)['zh'];
            }

            #消息链接
            $msg_list = Db::connection('shop_db')->table('website_message_manage')->get();
            $msg_list = objtoarr($msg_list);

            return view('func.site.save_rotate', compact('data', 'id', 'list', 'pic_list', 'msg_list'));
        }
    }

    public function del_rotate(Request $request)
    {
        $data = $request->except(['_token']);
        $res = Db::connection('shop_db')->table('website_rotate')->where(['id'=>$data['id']])->delete();
        if ($res) {
            return response()->json(['code'=>0,'msg'=>'删除成功']);
        }
    }

    #搜索栏配置
    public function search_manage(Request $request)
    {
        $dat = $request->except(['_token']);

        $manage = $this->get_merchant();
        $data = Db::table('search_setting')->where(['company_id'=>$manage->company_id])->first();
        $data = objtoarr($data);

        if ($request->isMethod('post')) {
            if (!empty($data)) {
                $res = Db::table('search_setting')->where(['company_id'=>$manage->company_id])->update([
                    'title'=>trim($dat['title']),
                    'desc'=>trim($dat['desc']),
                    'search_title'=>trim($dat['search_title']),
                    'img'=>$dat['img'][0],
                    'back_img'=>$dat['back_img'][0],
                ]);
            } else {
                $res = Db::table('search_setting')->insert([
                    'company_id'=>$manage->company_id,
                    'title'=>trim($dat['title']),
                    'desc'=>trim($dat['desc']),
                    'search_title'=>trim($dat['search_title']),
                    'img'=>$dat['img'][0],
                    'back_img'=>$dat['back_img'][0],
                ]);
            }

            if ($res) {
                return response()->json(['code'=>0,'msg'=>'保存成功']);
            }
        } else {
            if (empty($data)) {
                $data = ['title'=>'','desc'=>'','search_title'=>'','img'=>'','back_img'=>''];
            }

            return view('func.site.search_manage', compact('data'));
        }
    }

    #信息管理（引用我们的，废弃）
    public function msg_manage(Request $request)
    {
    }

    #流程管理
    public function gather_process_manage(Request $request)
    {
        $dat = $request->except(['_token']);
        $pid = isset($dat['pid']) ? $dat['pid'] : 0;

        $manage = $this->get_merchant();
        if (isset($dat['pa'])) {
            $limit = $request->get('limit');
            $page = $request->get('page') - 1;
            if ($page != 0) {
                $page = $limit * $page;
            }
            $keyword = $request->get('keywords') ? $request->get('keywords') : '';


            $count = Db::connection('shop_db')->table('centralize_process_list')->where(['pid'=>$pid,'display'=>0,'company_id'=>$manage->company_id])->count();
            $rows = DB::connection('shop_db')->table('centralize_process_list')->where(['pid'=>$pid,'display'=>0,'company_id'=>$manage->company_id])
                ->offset($page)
                ->limit($limit)
                ->orderBy('id', 'desc')
                ->get()
                ->toArray();

            $rows = objtoarr($rows);

            foreach ($rows as &$item) {
                $item['createtime'] = date('Y-m-d H:i', $item['createtime']);
            }

            return Response()->json(['code'=>0,'count'=>$count,'data'=>$rows]);
        } else {
            return view('func.site.gather_process_manage', compact('pid'));
        }
    }

    public function save_process(Request $request)
    {
        $dat = $request->except(['_token']);
        $id = isset($dat['id']) ? $dat['id'] : 0;
        $pid = isset($dat['pid']) ? $dat['pid'] : 0;
        $displayorders = isset($dat['displayorders']) ? $dat['displayorders']+1 : 1;
        $manage = $this->get_merchant();

        if ($request->isMethod('post')) {
            $level = intval($dat['level']);
            if (empty($dat['displayorders'])) {
                return Response()->json(['code'=>-1,'msg'=>'请补充序号']);
            }

            if ($level==2) {
                if ($pid>0) {
                    $p_info = Db::connection('shop_db')->table('centralize_process_list')->where(['company_id'=>$manage->company_id,'id'=>$pid,'display'=>0])->first();
                    $p_info = objtoarr($p_info);
                    $pid = $p_info['pid'];
                }
            }

            #1、判断是否有重复序号
//            if($level==1){
            $ishave = Db::connection('shop_db')->table('centralize_process_list')->where(['company_id'=>$manage->company_id,'pid'=>$pid,'displayorders'=>$dat['displayorders'],'step'=>$dat['step'],'display'=>0])->first();
            $ishave = objtoarr($ishave);
            if ($ishave['id']>0 && $id!=$ishave['id']) {
                return Response()->json(['code'=>-1,'msg'=>'该序号或序号描述已重复']);
            }

            #2、判断该序号前面是否有缺号
            $step = trim($dat['step']);
            $step = explode('Step', $step);
            if (!isset($step[1])) {
                return Response()->json(['code'=>-1,'msg'=>'请输入正确的序号：Step+序号']);
            }
            for ($i=1;$i<$step[1];$i++) {
                $ishave = Db::connection('shop_db')->table('centralize_process_list')->where(['company_id'=>$manage->company_id,'pid'=>$pid,'step'=>'Step'.$i,'display'=>0])->first();
                $ishave = objtoarr($ishave);
                if (empty($ishave['id'])) {
                    return Response()->json(['code'=>-2,'msg'=>'该序号前缺号（Step'.$i.'），正在为你补缺','step'=>$i]);
                }
            }

            if ($id>0) {
                $res = Db::connection('shop_db')->table('centralize_process_list')->where(['company_id'=>$manage->company_id,'id'=>$id])->update([
                    'step'=>trim($dat['step']),
                    'displayorders'=>trim($dat['displayorders']),
                    'content'=>trim($dat['content']),
                    'go_other'=>$dat['go_other'],
                    'link'=>$dat['go_other']==1 ? trim($dat['link']) : '',
                    'other_navbar'=>$dat['go_other']==2 ? trim($dat['other_navbar']) : 0,
                    'other_pic'=>$dat['go_other']==3 ? trim($dat['other_pic']) : 0,
                    'other_msg'=>$dat['go_other']==4 ? trim($dat['other_msg']) : 0,
                    'icon'=>isset($dat['ico'][0]) ? $dat['ico'][0] : '',
                ]);
            } else {
                $res = Db::connection('shop_db')->table('centralize_process_list')->insert([
                    'company_id'=>$manage->company_id,
                    'pid'=>$pid,
                    'step'=>trim($dat['step']),
                    'displayorders'=>trim($dat['displayorders']),
                    'content'=>trim($dat['content']),
                    'go_other'=>$dat['go_other'],
                    'link'=>$dat['go_other']==1 ? trim($dat['link']) : '',
                    'other_navbar'=>$dat['go_other']==2 ? trim($dat['other_navbar']) : 0,
                    'other_pic'=>$dat['go_other']==3 ? trim($dat['other_pic']) : 0,
                    'other_msg'=>$dat['go_other']==4 ? trim($dat['other_msg']) : 0,
                    'icon'=>isset($dat['ico'][0]) ? $dat['ico'][0] : '',
                    'createtime'=>time(),
                ]);
            }

            if ($res) {
                return Response()->json(['code'=>0,'msg'=>'保存成功']);
            }
        } else {
            $data = ['step'=>'Step'.$displayorders,'title'=>'','icon'=>'','content'=>'','displayorders'=>$displayorders,'go_other'=>'','link'=>'','other_navbar'=>'','other_pic'=>'','other_msg'=>''];
            if ($pid>0) {
                $ishave = Db::connection('shop_db')->table('centralize_process_list')->where(['company_id'=>$manage->company_id,'pid'=>$pid,'display'=>0])->orderBy('displayorders', 'desc')->first();
                $ishave = objtoarr($ishave);
                if ($ishave['id']) {
                    $num = intval($ishave['displayorders'])+1;
                    $data['step'] = 'Step'.$num;
                    $data['displayorders'] = $num;
                }
            } else {
                $ishave = Db::connection('shop_db')->table('centralize_process_list')->where(['company_id'=>$manage->company_id,'pid'=>$pid,'display'=>0])->orderBy('displayorders', 'desc')->first();
                $ishave = objtoarr($ishave);
                if ($ishave['id']) {
                    $num = intval($ishave['displayorders'])+1;
                    $data['step'] = 'Step'.$num;
                    $data['displayorders'] = $num;
                }
            }
            if ($id>0) {
                $data = Db::connection('shop_db')->table('centralize_process_list')->where(['company_id'=>$manage->company_id,'id'=>$id,'display'=>0])->first();
                $data = objtoarr($data);
                $pid=$data['pid'];
            }

            $list = Db::table('guide_frame')->where(['type'=>1])->get();
            $list = objtoarr($list);

            #图文链接
            $pic_list = Db::connection('shop_db')->table('website_image_txt')->get();
            $pic_list = objtoarr($pic_list);
            foreach ($pic_list as $k=>$v) {
                $pic_list[$k]['name'] = json_decode($v['name'], true)['zh'];
            }

            #消息链接
            $msg_list = Db::connection('shop_db')->table('website_message_manage')->get();
            $msg_list = objtoarr($msg_list);

            return view('func.site.save_process', compact('id', 'pid', 'data', 'list', 'pic_list', 'msg_list'));
        }
    }

    public function del_process(Request $request)
    {
        $dat = $request->except(['_token']);
        $id = isset($dat['id']) ? $dat['id'] : 0;
        if ($request->isMethod('post')) {
            $res = Db::connection('shop_db')->table('centralize_process_list')->where(['id'=>$id])->delete();
            if ($res) {
                return Response()->json(['code'=>0,'msg'=>'删除成功']);
            }
        }
    }

    #导页管理
    public function guide_manage(Request $request)
    {
        $data = $request->except(['_token']);

        if (isset($data['pa'])) {
            $limit = $request->get('limit');
            $page = $request->get('page') - 1;
            if ($page != 0) {
                $page = $limit * $page;
            }
            $keyword = $request->get('keywords') ? $request->get('keywords') : '';

            $manage = $this->get_merchant();

            $count = Db::table('guide_body')->where(['company_id'=>$manage->company_id])->count();
            $rows = DB::table('guide_body')->where(['company_id'=>$manage->company_id])
                ->offset($page)
                ->limit($limit)
                ->orderBy('id', 'desc')
                ->get()
                ->toArray();

            $rows = objtoarr($rows);

            foreach ($rows as &$item) {
                $item['format'] = Db::table('guide_format')->where(['id'=>$item['content_id']])->first();
                $item['format'] = objtoarr($item['format']);
            }

            return response()->json(['code'=>0,'count'=>$count,'data'=>$rows]);
        } else {
            return view('func.site.guide_manage', compact(''));
        }
    }

    #保存导页
    public function save_guide(Request $request)
    {
        $dat = $request->except(['_token']);
        $id = isset($dat['id']) ? $dat['id'] : 0;
        $manage = $this->get_merchant();

        if ($request->isMethod('post')) {
            if ($id>0) {
                $res = Db::table('guide_body')->where(['id'=>$id])->update([
                    'displayorders'=>intval($dat['displayorders']),
//                    'name'=>trim($dat['name']),
                    'title'=>trim($dat['title']),
                    'desc'=>trim($dat['desc']),
                    'content_id'=>intval($dat['content_id']),
                    'gcateid'=>isset($dat['gcateid']) ? intval($dat['gcateid']) : '',
                    'gkeywords'=>isset($dat['gkeywords']) ? trim($dat['gkeywords']) : '',
                    'starttime'=>isset($dat['starttime']) ? trim($dat['starttime']) : '',
                    'endtime'=>isset($dat['endtime']) ? trim($dat['endtime']) : '',
                    'introduce'=>isset($dat['introduce']) ? json_encode($dat['introduce'], true) : '',
                    'more_id'=>intval($dat['more_id']),
//                    'format_type'=>intval($dat['format_type']),
//                    'format_content'=>intval($dat['format_type'])==1?json_encode($dat['format_content'],true):'',
                    'back_type'=>$dat['back_type'],
                    'back_content'=>$dat['back_type']==1 ? $dat['back_content'] : $dat['back_img'][0],
                ]);
            } else {
                $res = Db::table('guide_body')->insertGetId([
                    'company_id'=>$manage->company_id,
                    'displayorders'=>intval($dat['displayorders']),
//                    'name'=>trim($dat['name']),
                    'title'=>trim($dat['title']),
                    'desc'=>trim($dat['desc']),
                    'content_id'=>intval($dat['content_id']),
                    'gcateid'=>isset($dat['gcateid']) ? intval($dat['gcateid']) : '',
                    'gkeywords'=>isset($dat['gkeywords']) ? trim($dat['gkeywords']) : '',
                    'starttime'=>isset($dat['starttime']) ? trim($dat['starttime']) : '',
                    'endtime'=>isset($dat['endtime']) ? trim($dat['endtime']) : '',
                    'introduce'=>isset($dat['introduce']) ? json_encode($dat['introduce'], true) : '',
                    'more_id'=>intval($dat['more_id']),
//                    'format_type'=>intval($dat['format_type']),
//                    'format_content'=>intval($dat['format_type'])==1?json_encode($dat['format_content'],true):'',
                    'back_type'=>$dat['back_type'],
                    'back_content'=>$dat['back_type']==1 ? $dat['back_content'] : $dat['back_img'][0],
                    'createtime'=>time()
                ]);

                if (isset($dat['gkeywords']) && isset($dat['starttime']) && isset($dat['endtime'])) {
                    #新增时自动获取商品(队列服务)
                    $options = ['http' => ['timeout' => 7500]];
                    $context = stream_context_create($options);
                    file_get_contents('https://decl.gogo198.cn/api/v2/get_content_goods?type=1&id='.$res, false, $context);
                }
            }

            return Response()->json(['code'=>0,'msg'=>'保存成功']);
        } else {
            $data = ['name'=>'','title'=>'','desc'=>'','content_id'=>0,'gcateid'=>0,'gkeywords'=>'','starttime'=>'','endtime'=>'','more_id'=>0,'format_type'=>0,'format_content'=>['name'=>[''],'desc'=>['']],'back_type'=>1,'back_content'=>'','introduce'=>'','displayorders'=>1];
            if ($id>0) {
                $data = Db::table('guide_body')->where(['id'=>$id])->first();
                $data = objtoarr($data);
                #废弃
                if ($data['format_type']==1) {
                    $data['format_content'] = json_decode($data['format_content'], true);
                }
                if (!empty($data['introduce'])) {
                    $data['introduce'] = json_decode($data['introduce'], true);
                }
                #废弃
                $data['format_info'] = Db::table('guide_format')->where(['id'=>$data['content_id']])->first();
                $data['format_info'] = objtoarr($data['format_info']);
            } else {
                $num = Db::table('guide_body')->where(['company_id'=>$manage->company_id])->count();
                $data['displayorders'] = $num + 1;
            }

            $content = Db::table('guide_frame')->where(['type'=>1])->orderBy('order', 'asc')->get();
            $content = objtoarr($content);
            $content2 = Db::table('guide_format')->orderBy('id', 'asc')->get();
            $content2 = objtoarr($content2);
            $catearr = json_encode(get_category(), true);
//            $catearr = get_category();

            return view('func.site.save_guide', compact('data', 'id', 'content', 'content2', 'catearr'));
        }
    }

    public function del_guide(Request $request)
    {
        $dat = $request->except(['_token']);
        $id = intval($dat['id']);

        $res = Db::table('guide_body')->where(['id'=>$id])->delete();
        if ($res) {
            Db::table('guide_content')->where(['pid'=>$id])->delete();
            return Response()->json(['code'=>0,'msg'=>'删除成功']);
        }
    }

    #获取版式
    public function get_format_request(Request $request)
    {
        $dat = $request->except(['_token']);
        $id = intval($dat['format_id']);
        $format = Db::table('guide_format')->where(['id'=>$id])->first();
        $format = objtoarr($format);

        return Response()->json(['code'=>0,'format'=>$format]);
    }

    #导页内容管理
    public function guide_content_manage(Request $request)
    {
        $data = $request->except(['_token']);
        $pid = isset($data['pid']) ? intval($data['pid']) : 0;

        if (isset($data['pa'])) {
            $limit = $request->get('limit');
            $page = $request->get('page') - 1;
            if ($page != 0) {
                $page = $limit * $page;
            }
            $keyword = $request->get('keywords') ? $request->get('keywords') : '';

            $manage = $this->get_merchant();

            $count = Db::table('guide_content')->where(['pid'=>$pid])->count();
            $rows = DB::table('guide_content')->where(['pid'=>$pid])
                ->offset($page)
                ->limit($limit)
                ->orderBy('id', 'desc')
                ->get()
                ->toArray();

            $rows = objtoarr($rows);

            $_status = ['显示','隐藏'];
            foreach ($rows as &$item) {
                $item['show_status'] = $_status[$item['is_show']];
            }

            return response()->json(['code'=>0,'count'=>$count,'data'=>$rows]);
        } else {
            return view('func.site.guide_content_manage', compact('pid'));
        }
    }

    public function save_guide_content(Request $request)
    {
        $dat = $request->except(['_token']);
        $id = isset($dat['id']) ? $dat['id'] : 0;
        $pid = isset($dat['pid']) ? $dat['pid'] : 0;
        $manage = $this->get_merchant();

        if ($request->isMethod('post')) {
            $type = isset($dat['type']) ? intval($dat['type']) : 0;
            if ($type==1) {
                #大卡片
                $dat['gkeywords']='';
                $dat['starttime']='';
                $dat['endtime']='';
            } elseif ($type==0) {
                #小卡片
                $dat['other_pic']=0;
                $dat['other_navbar']=0;
            }

            if ($id>0) {
                $res = Db::table('guide_content')->where(['id'=>$id])->update([
                    'type'=>$type,
                    'name'=>trim($dat['name']),
                    'desc'=>trim($dat['desc']),
                    'gcateid'=>isset($dat['gcateid']) ? intval($dat['gcateid']) : '',
                    'gkeywords'=>isset($dat['gkeywords']) ? trim($dat['gkeywords']) : '',
                    'starttime'=>isset($dat['starttime']) ? trim($dat['starttime']) : '',
                    'endtime'=>isset($dat['endtime']) ? trim($dat['endtime']) : '',
                    'go_other'=>isset($dat['go_other']) ? intval($dat['go_other']) : 0,
                    'link'=>isset($dat['link']) ? trim($dat['link']) : '',
                    'other_navbar'=>isset($dat['other_navbar']) ? intval($dat['other_navbar']) : '',
                    'other_pic'=>isset($dat['other_pic']) ? intval($dat['other_pic']) : '',
                    'other_msg'=>isset($dat['other_msg']) ? intval($dat['other_msg']) : '',
                    'other_shop'=>isset($dat['other_shop']) ? intval($dat['other_shop']) : '',
                    'other_privacy'=>isset($dat['other_privacy']) ? intval($dat['other_privacy']) : '',
                    'back_type'=>$dat['back_type'],
                    'back_content'=>$dat['back_type']==1 ? $dat['back_content'] : $dat['back_img'][0],
                    'is_show'=>$dat['is_show'],
                    'displayorders'=>intval($dat['displayorders']),
                ]);
            } else {
                $res = Db::table('guide_content')->insertGetId([
                    'company_id'=>$manage->company_id,
                    'pid'=>$pid,
                    'type'=>$type,
                    'name'=>trim($dat['name']),
                    'desc'=>trim($dat['desc']),
                    'gcateid'=>isset($dat['gcateid']) ? intval($dat['gcateid']) : '',
                    'gkeywords'=>isset($dat['gkeywords']) ? trim($dat['gkeywords']) : '',
                    'starttime'=>isset($dat['starttime']) ? trim($dat['starttime']) : '',
                    'endtime'=>isset($dat['endtime']) ? trim($dat['endtime']) : '',
                    'go_other'=>isset($dat['go_other']) ? intval($dat['go_other']) : 0,
                    'link'=>isset($dat['link']) ? trim($dat['link']) : '',
                    'other_navbar'=>isset($dat['other_navbar']) ? intval($dat['other_navbar']) : '',
                    'other_pic'=>isset($dat['other_pic']) ? intval($dat['other_pic']) : '',
                    'other_msg'=>isset($dat['other_msg']) ? intval($dat['other_msg']) : '',
                    'other_shop'=>isset($dat['other_shop']) ? intval($dat['other_shop']) : '',
                    'other_privacy'=>isset($dat['other_privacy']) ? intval($dat['other_privacy']) : '',
                    'back_type'=>$dat['back_type'],
                    'back_content'=>$dat['back_type']==1 ? $dat['back_content'] : $dat['back_img'][0],
                    'is_show'=>$dat['is_show'],
                    'displayorders'=>intval($dat['displayorders']),
                ]);

                if (isset($dat['gkeywords']) && isset($dat['starttime']) && isset($dat['endtime'])) {
                    #新增时自动获取商品(队列服务)
                    $options = ['http' => ['timeout' => 7500]];
                    $context = stream_context_create($options);
                    file_get_contents('https://decl.gogo198.cn/api/v2/get_content_goods?type=2&id=' . $res, false, $context);
                }
            }

            return Response()->json(['code'=>0,'msg'=>'保存成功']);
        } else {
            $data = ['name'=>'','type'=>0,'desc'=>'','is_show'=>0,'gcateid'=>'','gkeywords'=>'','starttime'=>'','endtime'=>'','go_other'=>0,'link'=>'','other_navbar'=>0,'other_pic'=>0,'other_msg'=>0,'other_shop'=>0,'other_privacy'=>0,'back_type'=>1,'back_content'=>'','introduce'=>'','displayorders'=>1];
            if ($id>0) {
                $data = Db::table('guide_content')->where(['id'=>$id])->first();
                $data = objtoarr($data);
            } else {
                $num = Db::table('guide_content')->where(['pid'=>$pid])->count();
                $data['displayorders'] = $num + 1;
            }

            #导页信息
            $data['body_info'] = Db::table('guide_body')->where(['id'=>$pid])->first();
            $data['body_info'] = objtoarr($data['body_info']);
            #版式信息
            $data['format_info'] = Db::table('guide_format')->where(['id'=>$data['body_info']['content_id']])->first();
            $data['format_info'] = objtoarr($data['format_info']);

            $catearr = [];
            if ($data['format_info']['type2']==1) {
                #图文
                $data['pic_list'] = Db::connection('shop_db')->table('website_image_txt')->get();
                $data['pic_list'] = objtoarr($data['pic_list']);
                foreach ($data['pic_list'] as $k => $v) {
                    $data['pic_list'][$k]['name'] = json_decode($v['name'], true)['zh'];
                }
            } elseif ($data['format_info']['type2']==2) {
                #消息
                $data['msg_list'] = Db::connection('shop_db')->table('website_message_manage')->get();
                $data['msg_list'] = objtoarr($data['msg_list']);
            } elseif ($data['format_info']['type2']==3) {
                #商品类别
                $catearr = json_encode(get_category(), true);
                #图文
                $data['pic_list'] = Db::connection('shop_db')->table('website_image_txt')->get();
                $data['pic_list'] = objtoarr($data['pic_list']);
                foreach ($data['pic_list'] as $k => $v) {
                    $data['pic_list'][$k]['name'] = json_decode($v['name'], true)['zh'];
                }
            } elseif ($data['format_info']['type2']==4) {
                #商品关键词
                #图文
                $data['pic_list'] = Db::connection('shop_db')->table('website_image_txt')->get();
                $data['pic_list'] = objtoarr($data['pic_list']);
                foreach ($data['pic_list'] as $k => $v) {
                    $data['pic_list'][$k]['name'] = json_decode($v['name'], true)['zh'];
                }
            } elseif ($data['format_info']['type2']==5) {
                #店铺
                $data['shop_list'] = Db::table('shop')->get();
                $data['shop_list'] = objtoarr($data['shop_list']);
            } elseif ($data['format_info']['type2']==6) {
                #应用
                $data['app_list'] = Db::table('guide_frame')->where(['type'=>1])->get();
                $data['app_list'] = objtoarr($data['app_list']);
            } elseif ($data['format_info']['type2']==7) {
                #政策
                $data['privacy_list'] = Db::connection('shop_db')->table('policy_list')->where(['type'=>1])->get();
                $data['privacy_list'] = objtoarr($data['privacy_list']);
                foreach ($data['privacy_list'] as $k=>$v) {
                    $data['privacy_list'][$k]['name'] = json_decode($v['name'], true)['zh'];
                }
            }

            return view('func.site.save_guide_content', compact('data', 'id', 'pid', 'catearr'));
        }
    }

    public function del_guide_content(Request $request)
    {
        $dat = $request->except(['_token']);
        $id = intval($dat['id']);

        $res = Db::table('guide_content')->where(['id'=>$id])->delete();
        if ($res) {
            return Response()->json(['code'=>0,'msg'=>'删除成功']);
        }
    }

    #社交管理
    public function contact_manage(Request $request)
    {
        $data = $request->except(['_token']);
        $manage = $this->get_merchant();

        if (isset($data['pa'])) {
            $limit = $request->get('limit');
            $page = $request->get('page') - 1;
            if ($page != 0) {
                $page = $limit * $page;
            }
            $keyword = $request->get('keywords') ? $request->get('keywords') : '';

            $manage = $this->get_merchant();

            $count = Db::connection('shop_db')->table('website_contact')->where(['company_id'=>$manage->company_id])->count();
            $rows = DB::connection('shop_db')->table('website_contact')->where(['company_id'=>$manage->company_id])
                ->offset($page)
                ->limit($limit)
                ->orderBy('id', 'desc')
                ->get()
                ->toArray();

            $rows = objtoarr($rows);

            foreach ($rows as &$item) {
                $item['createtime'] = date('Y-m-d H:i', $item['createtime']);
            }

            return response()->json(['code'=>0,'count'=>$count,'data'=>$rows]);
        } else {
            return view('func.site.contact_manage', compact(''));
        }
    }

    public function save_contact(Request $request)
    {
        $dat = $request->except(['_token']);
        $id = isset($dat['id']) ? $dat['id'] : 0;
        $manage = $this->get_merchant();

        if ($request->isMethod('post')) {
            if ($id>0) {
                $res = Db::connection('shop_db')->table('website_contact')->where('id', $dat['id'])->update([
                    'name'=>trim($dat['name']),
                    'ico'=>$dat['ico'][0],
                    'type'=>$dat['type'],
                    'link'=>$dat['type']==1 ? trim($dat['link']) : '',
                    'img'=>$dat['type']==2 ? $dat['img'][0] : '',
                ]);
            } else {
                $res = Db::connection('shop_db')->table('website_contact')->insert([
                    'company_id'=>$manage->company_id,
                    'name'=>trim($dat['name']),
                    'ico'=>$dat['ico'][0],
                    'type'=>$dat['type'],
                    'link'=>$dat['type']==1 ? trim($dat['link']) : '',
                    'img'=>$dat['type']==2 ? $dat['img'][0] : '',
                    'createtime'=>time()
                ]);
            }

            if ($res) {
                return Response()->json(['code' => 0, 'msg' => '保存成功']);
            }
        } else {
            $data = ['name'=>'','type'=>'','link'=>'','img'=>'','ico'=>''];
            if ($id>0) {
                $data = Db::connection('shop_db')->table('website_contact')->where('id', $id)->first();
                $data = objtoarr($data);
            }
            return view('func.site.save_contact', compact('id', 'data'));
        }
    }

    public function del_contact(Request $request)
    {
        $dat = $request->except(['_token']);
        $id = intval($dat['id']);

        $res = Db::connection('shop_db')->table('website_contact')->where(['id'=>$id])->delete();
        if ($res) {
            return Response()->json(['code'=>0,'msg'=>'删除成功']);
        }
    }

    #页脚管理
    public function footer_manage(Request $request)
    {
        $data = $request->except(['_token']);
        $manage = $this->get_merchant();

        if (isset($data['pa'])) {
            $limit = $request->get('limit');
            $page = $request->get('page') - 1;
            if ($page != 0) {
                $page = $limit * $page;
            }
            $keyword = $request->get('keywords') ? $request->get('keywords') : '';

            $manage = $this->get_merchant();

            $count = Db::table('footer_body')->where(['company_id'=>$manage->company_id])->count();
            $rows = DB::table('footer_body')->where(['company_id'=>$manage->company_id])
                ->offset($page)
                ->limit($limit)
                ->orderBy('id', 'desc')
                ->get()
                ->toArray();

            $rows = objtoarr($rows);

            foreach ($rows as &$item) {
            }

            return response()->json(['code'=>0,'count'=>$count,'data'=>$rows]);
        } else {
            return view('func.site.footer_manage', compact(''));
        }
    }

    public function footer_child(Request $request)
    {
        $data = $request->except(['_token']);
        $manage = $this->get_merchant();
        $pid = isset($data['pid']) ? $data['pid'] : 0;

        if (isset($data['pa'])) {
            $limit = $request->get('limit');
            $page = $request->get('page') - 1;
            if ($page != 0) {
                $page = $limit * $page;
            }
            $keyword = $request->get('keywords') ? $request->get('keywords') : '';

            $manage = $this->get_merchant();

            $count = Db::table('footer_body')->where(['pid'=>$pid])->count();
            $rows = DB::table('footer_body')->where(['pid'=>$pid])
                ->offset($page)
                ->limit($limit)
                ->orderBy('id', 'desc')
                ->get()
                ->toArray();

            $rows = objtoarr($rows);

            foreach ($rows as &$item) {
            }

            return response()->json(['code'=>0,'count'=>$count,'data'=>$rows]);
        } else {
            return view('func.site.footer_child', compact('pid'));
        }
    }

    public function save_frame(Request $request)
    {
        $dat = $request->except(['_token']);
        $pid = isset($dat['pid']) ? $dat['pid'] : 0;
        $id = isset($dat['id']) ? $dat['id'] : 0;
        $manage = $this->get_merchant();

        if ($request->isMethod('post')) {
            $icon = '';
            if ($pid==0) {
                if ($dat['type']==2) {
                    $icon = $dat['icon'][0];
                }
            }
            if ($id>0) {
                Db::table('frame_body')->where('id', $id)->update([
                    'type'=>isset($dat['type']) ? $dat['type'] : 0,
                    'pid'=>$pid,
                    'name'=>trim($dat['name']),
                    'icon'=>$icon,
                    'have_child'=>isset($dat['have_child']) ? $dat['have_child'] : 2,
                    'app_id'=>$dat['app_id'],
                ]);
            } else {
                Db::table('frame_body')->insert([
                    'company_id'=>$manage->company_id,
                    'type'=>isset($dat['type']) ? $dat['type'] : 0,
                    'pid'=>$pid,
                    'name'=>trim($dat['name']),
                    'icon'=>$icon,
                    'have_child'=>isset($dat['have_child']) ? $dat['have_child'] : 2,
                    'app_id'=>$dat['app_id'],
                ]);
            }

            return Response()->json(['code'=>0,'msg'=>'保存成功！']);
        } else {
            $data = ['type'=>0,'name'=>'','icon'=>'','displayorder'=>'','have_child'=>1,'app_id'=>''];
            if ($id>0) {
                $data = Db::table('frame_body')->where('id', $id)->first();
                $data = objtoarr($data);
            }
            $content = Db::table('guide_frame')->where(['type'=>1])->orderBy('order', 'asc')->get();
            $content = objtoarr($content);

            return view('func.site.save_frame', compact('data', 'id', 'pid', 'content'));
        }
    }

    #保存页脚
    public function save_footer(Request $request)
    {
        $dat = $request->except(['_token']);
        $id = isset($dat['id']) ? $dat['id'] : 0;
        $pid = isset($dat['pid']) ? $dat['pid'] : 0;
        $manage = $this->get_merchant();

        if ($request->isMethod('post')) {
            $app_id = '';
            if (isset($dat['have_link'])) {
                if ($dat['have_link']==1) {
                    $app_id = $dat['app_id'];
                }
            }
            $content_id = 0;
            if (isset($dat['type'])) {
                if ($dat['type']==1) {
                    $content_id = $dat['content_id1'];
                } elseif ($dat['type']==2) {
                    $content_id = $dat['content_id2'];
                } elseif ($dat['type']==3) {
                    $content_id = $dat['content_id3'];
                } elseif ($dat['type']==4) {
                    $content_id = $dat['content_id4'];
                } elseif ($dat['type']==5) {
                    $content_id = $dat['content_id5'];
                }
            }

            if ($id>0) {
                $res = Db::table('footer_body')->where(['id'=>$id])->update([
                    'name'=>trim($dat['name']),
                    'type'=>isset($dat['type']) ? $dat['type'] : '',
                    'content_id'=>$content_id,
                    'have_link'=>isset($dat['have_link']) ? $dat['have_link'] : '',
                    'app_id'=>$app_id
                ]);
            } else {
                $res = DB::table('footer_body')->insert([
                    'company_id'=>$manage->company_id,
                    'pid'=>$pid,
                    'name'=>trim($dat['name']),
                    'type'=>isset($dat['type']) ? $dat['type'] : '',
                    'content_id'=>$content_id,
                    'have_link'=>isset($dat['have_link']) ? $dat['have_link'] : '',
                    'app_id'=>$app_id
                ]);
            }

            return Response()->json(['code'=>0,'msg'=>'保存成功']);
        } else {
            $data = ['name'=>'','type'=>1,'content_id'=>'','have_link'=>0,'app_id'=>''];
            if ($id>0) {
                $data = Db::table('footer_body')->where(['id'=>$id])->first();
                $data = objtoarr($data);
            }

            #应用链接
            $appLink = Db::table('guide_frame')->where(['type'=>1])->orderBy('order', 'asc')->get();
            $appLink = objtoarr($appLink);
            #政策链接
            $policyLink = Db::connection('shop_db')->table('policy_list')->whereRaw('cate_id in (12,13,14) ')->get();
            $policyLink = objtoarr($policyLink);
            foreach ($policyLink as $k=>$v) {
                $policyLink[$k]['name'] = json_decode($v['name'], true)['zh'];
            }
            #消息链接
            $msgLink = Db::connection('shop_db')->table('website_message_manage')->get();
            $msgLink = objtoarr($msgLink);
            #规则链接
            $ruleLink = Db::connection('shop_db')->table('website_platform_rule')->get();
            $ruleLink = objtoarr($ruleLink);
            #图文链接
            $imgLink = Db::connection('shop_db')->table('website_image_txt')->get();
            $imgLink = objtoarr($imgLink);
            foreach ($imgLink as $k=>$v) {
                $imgLink[$k]['name'] = json_decode($v['name'], true)['zh'];
            }

            return view('func.site.save_footer', compact('data', 'id', 'pid', 'appLink', 'policyLink', 'msgLink', 'ruleLink', 'imgLink'));
        }
    }

    public function del_footer(Request $request)
    {
        $dat = $request->except(['_token']);
        $id = intval($dat['id']);

        $res = Db::table('footer_body')->where(['id'=>$id])->delete();
        if ($res) {
            Db::table('footer_body')->where(['pid'=>$id])->delete();
            return Response()->json(['code'=>0,'msg'=>'删除成功']);
        }
    }

    #友情连接管理
    public function friendcate_manage(Request $request)
    {
        $data = $request->except(['_token']);
        $manage = $this->get_merchant();

        if (isset($data['pa'])) {
            $limit = $request->get('limit');
            $page = $request->get('page') - 1;
            if ($page != 0) {
                $page = $limit * $page;
            }
            $keyword = $request->get('keywords') ? $request->get('keywords') : '';

            $count = Db::connection('shop_db')->table('website_linkcategory')->where(['company_id'=>$manage->company_id])->count();
            $rows = DB::connection('shop_db')->table('website_linkcategory')->where(['company_id'=>$manage->company_id])
                ->offset($page)
                ->limit($limit)
                ->orderBy('id', 'desc')
                ->get()
                ->toArray();

            $rows = objtoarr($rows);

            foreach ($rows as &$item) {
                $item['name'] = json_decode($item['name'], true)['zh'];
                $item['show'] = $item['show']==1 ? '隐藏' : '显示';
            }

            return response()->json(['code'=>0,'count'=>$count,'data'=>$rows]);
        } else {
            return view('func.site.friendcate_manage', compact(''));
        }
    }

    public function save_friendcate(Request $request)
    {
        $dat = $request->except(['_token']);
        $id = isset($dat['id']) ? $dat['id'] : 0;
        $manage = $this->get_merchant();

        if ($request->isMethod('post')) {
            if ($id>0) {
                Db::connection('shop_db')->table('website_linkcategory')->where('id', $id)->update([
                    'name'=>json_encode(['zh'=>trim($dat['name']['zh'])], true),
                ]);
            } else {
                Db::connection('shop_db')->table('website_linkcategory')->insert([
                    'company_id'=>$manage->company_id,
                    'name'=>json_encode(['zh'=>trim($dat['name']['zh'])], true),
                    'show'=>2
                ]);
            }

            return Response()->json(['code'=>0,'msg'=>'保存成功！']);
        } else {
            $data = ['name'=>['zh'=>'','cht'=>'','en'=>'']];
            if ($id>0) {
                $data = Db::connection('shop_db')->table('website_linkcategory')->where('id', $id)->first();
                $data = objtoarr($data);
                $data['name'] = json_decode($data['name'], true);
            }
            return view('func.site.save_friendcate', compact('data', 'id'));
        }
    }

    public function del_friendcate(Request $request)
    {
        $dat = $request->except(['_token']);
        $msg = $dat['typ']==1 ? '隐藏' : '显示';
        $res = Db::connection('shop_db')->table('website_linkcategory')->where('id', $dat['id'])->update(['show'=>$dat['typ']]);
        if ($res) {
            return Response()->json(['code'=>0,'msg'=>$msg.'成功！']);
        }
    }

    public function friend_manage(Request $request)
    {
        $data = $request->except(['_token']);
        $manage = $this->get_merchant();
        $cate_id = $data['id'];

        if (isset($data['pa'])) {
            $limit = $request->get('limit');
            $page = $request->get('page') - 1;
            if ($page != 0) {
                $page = $limit * $page;
            }
            $keyword = $request->get('keywords') ? $request->get('keywords') : '';

            $count = Db::connection('shop_db')->table('website_link')->where(['cate_id'=>$cate_id,'company_id'=>$manage->company_id])->count();
            $rows = DB::connection('shop_db')->table('website_link')->where(['cate_id'=>$cate_id,'company_id'=>$manage->company_id])
                ->offset($page)
                ->limit($limit)
                ->orderBy('id', 'desc')
                ->get()
                ->toArray();

            $rows = objtoarr($rows);

            foreach ($rows as &$item) {
                $item['name'] = json_decode($item['name'], true)['zh'];
            }

            return response()->json(['code'=>0,'count'=>$count,'data'=>$rows]);
        } else {
            return view('func.site.friend_manage', compact('cate_id'));
        }
    }

    public function save_friend(Request $request)
    {
        $dat = $request->except(['_token']);
        $id = isset($dat['id']) ? $dat['id'] : 0;
        $cate_id = isset($dat['cate_id']) ? $dat['cate_id'] : 0;
        $cate_name = Db::connection('shop_db')->table('website_linkcategory')->where(['id'=>$cate_id])->first()->name;
        $cate_name = json_decode($cate_name, true)['zh'];
        $manage = $this->get_merchant();

        if ($request->isMethod('post')) {
            if ($id>0) {
                Db::connection('shop_db')->table('website_link')->where('id', $id)->update([
                    'name'=>json_encode(['zh'=>trim($dat['name']['zh'])], true),
                    'link'=>trim($dat['link'])
                ]);
            } else {
                Db::connection('shop_db')->table('website_link')->insert([
                    'company_id'=>$manage->company_id,
                    'cate_id'=>$cate_id,
                    'name'=>json_encode(['zh'=>trim($dat['name']['zh'])], true),
                    'link'=>trim($dat['link'])
                ]);
            }

            return Response()->json(['code'=>0,'msg'=>'保存成功！']);
        } else {
            $data = ['name'=>['zh'=>'','cht'=>'','en'=>''],'link'=>''];
            if ($id>0) {
                $data = Db::connection('shop_db')->table('website_link')->where('id', $id)->first();
                $data = objtoarr($data);
                $data['name'] = json_decode($data['name'], true);
            }
            return view('func.site.save_friend', compact('data', 'id', 'cate_name', 'cate_id'));
        }
    }

    public function del_friend(Request $request)
    {
        $dat = $request->except(['_token']);
        $res = Db::connection('shop_db')->table('website_link')->where('id', $dat['id'])->delete();
        if ($res) {
            return Response()->json(['code'=>0,'msg'=>'删除成功！']);
        }
    }
}
