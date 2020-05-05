<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Auth;

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

		$user = User::create([
			'name'     => $request->name,
			'email'    => $request->email,
			'password' => bcrypt($request->password),
		]);

		Auth::login($user);
		session()->flash('success','欢迎，您将在这里开启一段新的旅程~');
		return redirect()->route('users.show',[$user]);
	}

	public function edit(User $user)
	{
		return view('users.edit',compact('user'));
	}
	public function update(User $user, Request $request)
	{
		$this->validate($request,[
			'name' => 'required|max:50',
			'password' => 'nullable|confirmed|min:6'
		]);

		$data = [];
		$data['name'] = $request->name;
		if($request->password){
			$data['password'] = bcrypt($request->password);
		}
		$user->update($data);

		session()->flash('success','个人资料更新成功！');

		return redirect()->route('users.show',$user); 
	}
}
