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
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Budget::class, function (Faker\Generator $faker) {
    return [
        'title'   => $faker->sentence,
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
    ];
});

$factory->define(App\Income::class, function (Faker\Generator $faker) {
    static $budget_id;

    return [
        'title'          => $faker->sentence,
        'value_planned'  => $faker->numberBetween(1000, 10000),
        'value_received' => $faker->numberBetween(1000, 10000),
        'budget_id'      => $budget_id ?: function () {
            return factory(App\Budget::class)->create()->id;
        },
    ];
});
