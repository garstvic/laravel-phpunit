<?php

use Carbon\Carbon;

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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Concert::class, function (Faker\Generator $faker) {
    return [
        'title' => 'Example Band',
        'subtitle' => 'with The Openers',
        'date' => Carbon::parse('+2 weeks'),
        'ticket_price' => 2000,
        'venue' => 'The Theatre',
        'venue_address' => '123 Example Lane',
        'city' => 'Laraville',
        'state' => 'ON',
        'zip' => '17916',
        'additional_information' => 'Some sample additional information.'
    ];
});

$factory->defineAs(App\Concert::class, 'published', function (Faker\Generator $faker) use ($factory) {
    $issue = $factory->raw(App\Concert::class);
    
    return array_merge($issue, ['published_at' => Carbon::parse('-1 week')]);
});

$factory->defineAs(App\Concert::class, 'unpublished', function (Faker\Generator $faker) use ($factory) {
    $issue = $factory->raw(App\Concert::class);
    
    return array_merge($issue, ['published_at' => null]);
});