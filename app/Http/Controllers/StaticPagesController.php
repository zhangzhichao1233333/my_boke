<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
	/** 主页
	 * @function home
	 *@author zane
	 *@date  2020/4/17
	 */
	public function home()
	{
		return view('static_pages/home');
	}
	/** 帮助页
	 * @function help
	 * @author zane
	 * @data 2020/4/17
	 */
	public function help()
	{
		return view('static_pages/help');
	}
	/** 关于页
	 * @function about 
	 * @author zane 
	 * @dat3 2020/4/17
	 */
	public function about()
	{
		return view('static_pages/about');
	}
}
