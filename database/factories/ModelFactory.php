<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'username'       => $faker->userName,
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'active'        => true,
        'role_id'        => function () {
            return factory(App\Role::class)->create()->id;
        }
    ];
});

$factory->define(App\Role::class, function (Faker\Generator $faker) {

    $name = $faker->name;

    return [
        'slug' => \Illuminate\Support\Str::slug($name),
        'name' => $name
    ];
});

$factory->define(App\Permission::class, function (Faker\Generator $faker) {

    $p = $faker->name;

    return [
        'slug' => \Illuminate\Support\Str::slug($p),
        'name' => $p
    ];
});