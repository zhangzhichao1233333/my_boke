<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class StaticPagesController extends Controller
{
	/** 主页
	 * @function home
	 *@author zane
	 *@date  2020/4/17
	 */
	public function home()
        {
            $feed_items = [];
            if (Auth::check()) {
                $feed_items = Auth::user()->feed()->paginate(30);
            }

            return view('static_pages/home', compact('feed_items'));
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
