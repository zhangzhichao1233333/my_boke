<?php

namespace App\Http\Middleware;

use Closure;

class EnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
	//三个判断：
	//1.如果用户已经登录
	//2.并且还未认证 Email
	//3.并且放的的不是 email 验证相关URL 或者推出的URL
	//return $next($request);
	if($request->user() &&!$request->user()->hasVerifiedEmail() && !$request->is('email/*','logout')){
		// 根据客户段返回对应的内容
		return $request->expectsJson() ? abort(403,'Your email address is not verified.'):redirect()->route('verification.notice');    	
	}
	return $next($request);
    }
}
