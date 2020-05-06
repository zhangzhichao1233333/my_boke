<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    /** 判断是否是登录的权限
     * @function update
     * @author zane
     * @date 2020/5/6
     */
    public function update(User $currentUser,User $user)
    {
    	return $currentUser->id === $user->id;
    }
    /** 删除用户权限
     * @function destroy
     * @author zane
     * @date 2020/5/6
     */
    public function destroy(User $currentUser, User $user)
    {
    	return $currentUser->is_admin && $currentUser->id !== $user->id;
    }
}
