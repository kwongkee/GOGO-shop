<?php

#上传中心

namespace App\Modules\Frontend\Http\Controllers;

use Illuminate\Http\Request;

class UploadController
{
    #上传文件
    public function upload_file(Request $request)
    {
        header('Access-Control-Allow-Origin:*');
        date_default_timezone_set("Asia/chongqing");
        error_reporting(E_ERROR);
        header("Content-Type: text/html; charset=utf-8");
        set_time_limit(0);
        $dat = $request->except(['__token']);

        $path = ROOT_PATH . 'public' . DS . 'uploads' . DS . 'merch_file';
        // $this->mkdirs($path);
        $file = request()->file('file');

        if ($file) {
            $info = $file->rule('uniqid')->move($path);
            if ($info) {
                return json(["error" => 1, "message" => "上传成功", "file_path" => '/uploads/merch_file/'.$info->getSaveName() ]);
            } else {
                return json(["error" => 0, "message" => "上传失败", "path" => "" ]);
            }
        } else {
            return json(["error" => 0, "message" => "请先上传文件！"]);
        }
    }

    #上传自定义文件
    public function upload_diy_file(Request $request)
    {
        set_time_limit(0);

        $data = input();
        if (trim($data['upName'])=='') {
            return json(['code' => 0, 'msg' => '请输入文件名称后上传文件！']);
        }
        $path = ROOT_PATH.'public'.'/uploads/'.$data['folder'];
        try {
            $file = request()->file('file');

            $filename = $_FILES['file']['name']; // 假设这是上传文件的名称
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $return_name = trim($data['upName']).'.'.$ext;
            $filename = trim($data['upName']).'.'.$ext;

            $info = $file->rule('uniqid')->move($path, $filename);
            $files = 'uploads/'.$data['folder'].'/'.$filename;
        } catch (\Exception $e) {
            return json(['code' => 0, 'msg' => '文件上传失败！']);
        }

        return json(['code' => 1, 'msg' => '文件上传成功！' ,'file_path' => $files, 'filename' => $return_name]);
    }
}
