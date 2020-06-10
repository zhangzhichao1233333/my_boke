<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
//use Illuminate\Support\Facades\Gate;

use Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
		 \App\Models\Reply::class => \App\Policies\ReplyPolicy::class,
		 \App\Models\Topic::class => \App\Policies\TopicPolicy::class,
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];
    /**修改策略自动发现
     * Register any authentication / authorization services.
     * @function root
     * @return void
     * @author zane
     * @date 2020/5/6
     */
    public function boot()
    {
	$this->registerPolicies();
	// 修改策略自动发现的逻辑
//        Gate::guessPolicyNamesUsing(function ($modelClass){
		// 动态返回模型对应的策略名称，如： // 'App\Models\User' => 'App\Policies\UserPolicy'
//		return 'App\Policies\\'.class_basename($modelClass).'Policy';
//	});

	\Horizon::auth(function ($request) {
            // 是否是站长
            return \Auth::user()->hasRole('Founder');
        });
    }
}
