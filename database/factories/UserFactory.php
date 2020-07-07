<?php

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

$factory->define(App\Model\SinhVien::class, function (Faker $faker) {
    return [
        'ten_sinh_vien' => App\Model\SinhVien::class->ten_sinh_vien,
        'ma_lop' => '1',
        'created_at' => new DateTime,
        'updated_at' => new DateTime,
    ];
});
