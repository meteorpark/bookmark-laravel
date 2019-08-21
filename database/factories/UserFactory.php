<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {

    $sns = [
        'kakao',
        'facebook',
        'google',
    ];
    return [
        'name' => $faker->name,
        'join_type' => $sns[rand(0, count($sns))],
        'sns_id' => Str::random(5),
        'profile_image' => $faker->imageUrl(),
    ];
});
