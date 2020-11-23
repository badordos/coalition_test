<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Author;
use Faker\Generator as Faker;


$factory->define(Author::class, function (Faker $faker) {

    $birth_year = $faker->numberBetween(1910, 2000);
    $death_year = $faker->numberBetween(1930, 2020);
    $death_year = $death_year <= $birth_year || $death_year - $birth_year < 18
        ? null
        : $death_year;
    return [
        'name' => $faker->firstName,
        'surname' => $faker->lastName,
        'patronymic' => $faker->firstName,
        'birth_year' => $birth_year,
        'death_year' => $death_year,
    ];
});
