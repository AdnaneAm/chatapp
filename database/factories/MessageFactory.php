<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    $users = App\User::inRandomOrder()->take(2)->get();
    return [
        'from'=>$users[0]->id,
        'to'=>$users[1]->id,
        'text'=>$faker->sentence,
    ];
});
