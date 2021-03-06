<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class SessionsController extends Controller
{
	/** 自动加载项目
	 * @function __construct
	 * @author zane
	 * @date 2020/5/6
	 */
	public function __construct()
	{
		$this->middleware('guest',[
			'only' => ['create']
		]);
	}
	/* 创建登录
	 * @function create
	 * @author zane
	 * @date 2020/4/26
	 * */
	public function create()
	{
		return view('sessions.create');
	}
	/* 验证
	 * @function store
	 * @author zane
	 * @data 2020/4/16
	 * */
	public function store(Request $request)
	{
		$credentials = $this->validate($request,[
			'email'    =>'required|email|max:255',
			'password' =>'required'
		]);

		if(Auth::attempt($credentials,$request->has('remember'))) {
			// 登录成功后的相关操作
			if(Auth::user()->activated) {
				session()->flash('success','欢迎回来！');
				$fallback = route('users.show',Auth::user());
	                        return redirect()->intended($fallback);
			} else {
				Auth::logout();
				session()->flash('warning','你的帐号未激活，请检查邮箱中的注册邮件进行激活。');
				return redirect('/');
			}
		} else {
			// 登录失败后的相关操作
			session()->flash('danger','很抱歉，您的邮箱和密码不匹配');
			return redirect()->back()->withInput();
		}

		return ;
	}
	
	/* 验证
         * @function store
         * @author zane
         * @data 2020/4/16
         * */
	public function destroy()
	{
		Auth::logout();
		session()->flash('success','您已成功退出！');
		return redirect('login');
	}

}
