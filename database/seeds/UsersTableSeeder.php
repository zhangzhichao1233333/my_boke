<?php

use Illuminate\Database\Seeder;

use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    // 获取 Faker 实例
	   $faker = app(Faker\Generator::class);

	   // 头像假数据
        $avatars = [
            'https://cdn.learnku.com/uploads/images/201710/14/1/s5ehp11z6s.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/Lhd1SHqu86.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/LOnMrqbHJn.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/xAuDMxteQy.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/ZqM7iaP4CR.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/NDnzMutoxX.png',
        ];
	    
	   $users = factory(User::class)
		   ->times(50)
		   ->make()
		   ->each(function ($user, $index) use ($faker,$avatars)
		   {
		   	// 从头像数组中随机取出一个并赋值
		   	$user->avatar = $faker->randomElement($avatars); 
		   });

	   // 让隐藏字段可见，并将数据集合转换为一ige数据
	   $user_array = $users->makeVisible(['password','remember_token'])->toArray();
	   User::insert($user_array);
	   // 单独处理第一个用户的数据	   
	   $user = User::find(1);
	   $user->name  = 'Summer';
	   $user->is_admin = true;
	   $user->email = '314328449@qq.com';
        $user->password = bcrypt('zzchao1533');
	   $user->save(); 
    }
}
