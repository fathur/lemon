<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username'       => 'lemon',
            'name'           => 'Lemon Manis',
            'email'          => 'admin@lemon.com',
            'password'       => bcrypt('manis'),
            'role_id'        => \App\Model\Role::where('name', 'Administrator')->first()->id,
            'active'         => true,
            'remember_token' => str_random(10)
        ]);

        if (env('APP_ENV') != 'production') {
            // ..
        }
    }
}
