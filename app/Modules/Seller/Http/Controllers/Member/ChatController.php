<?php

namespace App\Modules\Seller\Http\Controllers\Member;

use App\Modules\Base\Http\Controllers\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Seller
{
    private $list_links = [
        ['url' => 'member/chat/list?type=0', 'text' => '未处理'],
        ['url' => 'member/chat/list?type=1', 'text' => '已处理'],
    ];

    public function objtoarr($arr)
    {
        return json_decode(json_encode($arr, true), true);
    }

    public function lists(Request $request)
    {
        $data = $request->except(['_token']);
        $type = $request->get('type', 0);
        $title = $this->list_links[$type]['text'];
        $this->sublink($this->list_links, $type, 'type');
        $shop_id = seller_shop_info()->shop_id;

//        $chat_obj = Db::table('ssl_chat_object')->where(['shopid'=>$shop_id])->get();
//        $chat_obj = $this->objtoarr($chat_obj);
//
//        foreach($chat_obj as $k=>$v){
//            $chat_obj[$k]['content'] = Db::table('ssl_chat_content')->where(['pid'=>$v['id'],'is_notice'=>1,'is_reply'=>0])->get();
//            $chat_obj[$k]['content'] = $this->objtoarr($chat_obj[$k]['content']);
//        }

        if (isset($data['pa'])) {
            $limit = $request->get('limit');
            $page = $request->get('page') - 1;
            if ($page != 0) {
                $page = $limit * $page;
            }

            $count = Db::table('ssl_chat_content as a1')
                ->leftJoin('ssl_chat_object as a2', 'a1.pid', 'a2.id')
                ->where(['a2.shopid' => $shop_id,'a1.is_notice'=>1,'a1.is_reply'=>$type])
                ->count();

            $rows = Db::table('ssl_chat_content as a1')
                ->leftJoin('ssl_chat_object as a2', 'a1.pid', 'a2.id')
                ->where(['a2.shopid' => $shop_id,'a1.is_notice'=>1,'a1.is_reply'=>$type])
                ->offset($page)
                ->limit($limit)
                ->orderBy('a1.id', 'desc')
                ->select('a1.content', 'a1.id', 'a1.is_reply', 'a1.createtime')
                ->get()
                ->toArray();

            $rows = $this->objtoarr($rows);

            foreach ($rows as &$item) {
                $item['createtime'] = date('Y-m-d H:i:s');
            }

            return response()->json(['code' => 0, 'count' => $count, 'data' => $rows]);
        } else {
            return view('member.chat.lists', compact('chat_obj', 'title', 'type'));
        }
    }

    public function reply(Request $request)
    {
        $data = $request->except(['_token']);

        Db::table('ssl_chat_content')->where(['id'=>$data['id']])->update(['is_reply'=>1]);

        Db::table('ssl_chat_content')->insert([
            'chat_pid'=>$data['id'],
            'user_id'=>auth('seller')->id(),
            'content'=>trim($data['content']),
            'createtime'=>time(),
            'task_type'=>0,
            'is_notice'=>0
        ]);

        $gogo_id = Db::table('user')->where(['user_id'=>auth('seller')->id()])->first()->gogo_id;
        $this->notice(['gogo_id'=>$gogo_id]);

        return response()->json(['code'=>0,'msg'=>'回复成功']);
    }

    public function notice($arr)
    {
        $data = Db::connection('shop_db')->table('centralize_system_notice')->where(['uid'=>0,'system_type'=>1])->first();
        $data = json_decode(json_encode($data, true), true);
        $url = 'https://gadmin.gogo198.cn';

        if ($data['notice_type']==1) {
            #微信
            $post = json_encode([
                'call'=>'confirmCollectionNotice',
                'find' =>"用户[".$arr['gogo_id']."]回复了咨询，请打开查看！",
                'keyword1' => "用户[".$arr['gogo_id']."]回复了咨询，请打开查看！",
                'keyword2' => '已提交待操作',
                'keyword3' => date('Y-m-d H:i:s', time()),
                'remark' => '点击查看详情',
                'url' => $url,
                'openid' => $data['account'],
                'temp_id' => 'SVVs5OeD3FfsGwW0PEfYlZWetjScIT8kDxht5tlI1V8'
            ]);

            $this->httpRequest('https://shop.gogo198.cn/api/sendwechattemplatenotice.php', $post);
        } elseif ($data['notice_type']==3) {
            $title = "管理员您好，用户[".$arr['gogo_id'].']回复了咨询，请进入总后台进行操作！';
            $post_data = json_encode(['email'=>$data['account'],'title'=>$title,'content'=>$url], true);
            $res = $this->httpRequest('https://admin.gogo198.cn/collect_website/public/?s=api/sendemail/index', $post_data, [
                'Content-Type: application/json; charset=utf-8',
                'Content-Length:' . strlen($post_data),
                'Cache-Control: no-cache',
                'Pragma: no-cache'
            ]);
        }
    }

    public function httpRequest($url, $data, $head=[])
    {
        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
        $output=curl_exec($ch);
        curl_close($ch);
        return $output;
    }
}
