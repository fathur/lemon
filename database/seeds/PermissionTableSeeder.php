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
        $tmp = [];
        foreach (Config::get('auth.permissions') as $slug => $text) {
            array_push($tmp, [
                'name'  => $text,
                'slug'  => $slug
            ]);
        }

        DB::table('permissions')->insert($tmp);
    }
}
