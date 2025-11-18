<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

#2024-12-26-设置全局cookie，让买家访问商家站点时记录cookie，不用到处传cid
class SetGlobalCookieMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $data = $request->except(['_token']);

        if (empty(Cookie::has('token'))) {
            $cookie = cookie('token', csrf_token(), 60*10);
            $response->cookie($cookie);
        }

        if (isset($data['cid'])) {
            if ($data['cid']>0) {
                // 创建 cookie
                $cookie = cookie('cid', (int)$data['cid'], 60*10);
                // 在响应中添加 cookie
                $response->cookie($cookie);
            }
        }
        return $response;
    }
}
