<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            [
                'name' => 'Can create user',
                'slug' => 'can-create-user'
            ],
            [
                'name' => 'Can edit user',
                'slug' => 'can-edit-user'
            ],
            [
                'name' => 'Can delete user',
                'slug' => 'can-delete-user'
            ],
            [
                'name' => 'Can view user',
                'slug' => 'can-view-user'
            ],
        ]);

        if (env('APP_ENV') != 'production') {

            factory(\App\Permission::class, 10)->create()->each(function($permissions){
                $permissions->roles()->save(factory(App\Role::class)->make());
            });
        }
    }
}
