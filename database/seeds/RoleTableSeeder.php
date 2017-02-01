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
        $role = 'Administrator';

        DB::table('roles')->insert([
            'name' => $role,
            'slug' => \Illuminate\Support\Str::slug($role)
        ]);

        if (env('APP_ENV') != 'production') {

            factory(\App\Role::class, 10)->create()->each(function($role){
                $role->users()->save(factory(App\User::class)->make());
            });
        }
    }
}
