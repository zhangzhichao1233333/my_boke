<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

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
	public function show(User $user)
	{
		return view('users.show',compact('user'));		
	}
	 /**数据展示信息
         * @function show
         * @author Zane
         * @data 2020/4/22
         * @param Object $user
         */
	public function store(Request $request)
	{
		$this->validate($request,[
			'name'     => 'required|unique:users|max:50',
			'email'    => 'required|email|unique:users|max:255',
			'password' => 'required|confirmed|min:6'
		
		]);
		return ;
	}
}
