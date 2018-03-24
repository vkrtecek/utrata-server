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
$factory->define(App\Model\Entity\Member::class, function (Faker\Generator $faker) {
    static $password;

    return [
    	'firstName' => $faker->firstName,
		'lastName' => $faker->lastName,
		'login' => str_random(),
        'passwordHash' => $password ?: $password = bcrypt('secret'),
		'sendMonthly' => TRUE,
		'sendByOne' => FALSE,
		'motherMail' => $faker->unique()->safeEmail,
		'myMail' => $faker->unique()->safeEmail,
		'admin' => FALSE,
		'logged' => 1,
        'token' => bin2hex(random_bytes(44)),
		'expiration' => (new \DateTime('+ 14 days'))->format('Y-m-d H:i:s'),
		'created' => (new \DateTime())->format('Y-m-d H:i:s'),
		'facebook' => FALSE,
		'access' => (new \DateTime())->format('Y-m-d H:i:s'),
		'LanguageCode' => 'CZK',
		'CurrencyID' => 1,
    ];
});
