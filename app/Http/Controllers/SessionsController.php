<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
	/* 创建登录
	 * @function create
	 * @author zane
	 * @date 2020/4/26
	 * */
	public function create()
	{
		return view('sesstions.create');
	}
}
