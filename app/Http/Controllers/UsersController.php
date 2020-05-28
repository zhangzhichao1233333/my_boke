<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Http\Requests\UserRequest;

use App\Handlers\ImageUploadHandler;

use Auth;

use Mail;

class UsersController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth',[
			'except' => ['show','create','store','index','confirmEmail']
		]);

		$this->middleware('guest',[
			'only' => ['create']
		]);
	}
	/** 用户列表
	 * @function index
	 * @author zane
	 * @date 2020/5/6
	 */
	public function index()
	{
		//$user = User::all();
		$users = User::paginate(10);
		return view('users.index',compact('users'));
	}

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
	//	$statuses = $user->statuses()
	//			 ->orderBy('created_at','desc')
	//			 ->paginate(10);
	//	return view('users.show',compact('user','statuses'));		
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
		
		$this->sendEmailConfirmationTo($user);
		session()->flash('success','验证邮件已发送到您的注册邮箱上，请注意查收。');
		return redirect('/');
		#Auth::login($user);
		#session()->flash('success','欢迎，您将在这里开启一段新的旅程~');
		#return redirect()->route('users.show',[$user]);
	}

	public function edit(User $user)
	{	
		$this->authorize('update',$user);
		return view('users.edit',compact('user'));
	}
	public function update(UserRequest $request, ImageUploadHandler $uploader, User $user)
	{
		dd($request->all());
		$this->authorize('update',$user);
//		$this->validate($request,[
//			'name' => 'required|max:50',
//			'password' => 'nullable|confirmed|min:6'
//		]);

//		$data = [];
//		$data['name'] = $request->name;
//		if($request->password){
//			$data['password'] = bcrypt($request->password);
//		
		
		$data = $request->all();
		dd($data);		
		if($request->avatar) {
			$result = $uploader->save($request->avatar,'avatars',$user->id,416);
			if($result) {
				$data['avatar'] = $result['path'];
			}
		}

		$user->update($data);

		return redirect()->route('users.show',$user->id)->with('success','个人资料更新成功');
	
	}

	/**删除用户
	 * @funciton destroy
	 * @author zane
	 * @date 2020/5/6
	 */
	public function destroy(User $user)
	{
		$this->authorize('destroy',$user);
		$user->delete();
		session()->flash('success','成功删除用户！');
		return back();
	}
	/**发送验证邮件
	 * @function sendEmailConfirmationTo
	 * @author zane
	 * @date 2020/5/8
	 */
	protected function sendEmailConfirmationTo($user)
	{
		$view   = "emails.confirm";
		$data   = compact('user');
		$from   = env('MAIL_FROM_ADDRESS');
		$name   = env('MAIL_FROM_NAME');
		$to     = $user->email;
		$subject = '感谢注册 My_boke应用！请确认您的邮箱。';
		Mail::send($view,$data,function ($message) use ($from,$name,$to,$subject) {
			$message->from($from,$name)->to($to)->subject($subject);
		});	
	}

	/**激活跳转
	 * @function confirmEmail
	 * @author zane
	 * @date 2020/5/8
	 */
	public function confirmEmail($token)
	{
		$user = User::where('activation_token',$token)->firstOrFail();

		$user->activated = true;
		$user->activation_token = null;
		$user->save();

		Auth::login($user);
		session()->flash('success','恭喜你，激活成功！');
		return redirect()->route('users.show',[$user]);
	}

	public function followings(User $user)
    	{
        	$users = $user->followings()->paginate(30);
        	$title = $user->name . '关注的人';
        	return view('users.show_follow', compact('users', 'title'));
    	}

    	public function followers(User $user)
    	{
        	$users = $user->followers()->paginate(30);
        	$title = $user->name . '的粉丝';
        	return view('users.show_follow', compact('users', 'title'));
    	}
}
