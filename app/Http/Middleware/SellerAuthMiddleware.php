<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SellerAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        #2024-06-20修改
        #判断是否从商家中心跳转，携带uid参数
        $data = $request->except(['_token']);
        $uid = isset($data['uid']) ? $data['uid'] : 0;

        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return result(99, null, '需要登录');
//                return response('Unauthorized', 401);
            } else {
                return redirect()->guest('login?uid='.$uid);
//                return redirect()->guest('login');
            }
        }
        return $next($request);
    }
}
