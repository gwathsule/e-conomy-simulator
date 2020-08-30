<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Domains\User\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => Hash::make('123'),
        'is_admin' => false,
        'email_verified_at' => now(),
    ];
});
