<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = 'Administrator';
        $user = 'User';

        DB::table('roles')->insert([
            'name' => $admin,
            'slug' => \Illuminate\Support\Str::slug($admin)
        ]);

        DB::table('roles')->insert([
            'name' => $user,
            'slug' => \Illuminate\Support\Str::slug($user)
        ]);

//        if (env('APP_ENV') != 'production') {
//
//            factory(\App\Model\Role::class, 10)->create()->each(function($role){
//                $role->users()->save(factory(App\User::class)->make());
//            });
//        }
    }
}
