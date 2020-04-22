<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
	/** 创建
	 * @function create 
	 * @author Zane
	 * @data 2020/4/22
	**/ 
	public function create() 
	{
		return view('users.create');
	}
	/**展示用户信息
	 * @function show
	 * @author Zane
	 * @data 2020/4/22
	 * @param Object $user  
	 */
	pubilc function show(User $user){
		echo"<pre>";print_r(compact('user'));exit;
		return view('users.show',compact('user'));		
	}
}
