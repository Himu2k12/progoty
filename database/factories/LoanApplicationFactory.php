<?php

use Faker\Generator as Faker;

$factory->define(App\LoanApplication::class, function (Faker $faker) {
    return [
        'account_no'=>$faker->numberBetween(2,200),
        'loan_amount'=>$faker->numberBetween(20000,200000),
        'total_deposite'=>$faker->numberBetween(200,20000),
        'application_date'=>$faker->date('y-m-d'),
        'present_district'=>$faker->address,
        'present_thana'=>$faker->address,
        'present_post_code'=>$faker->address,
        'present_village'=>$faker->address,
        'mobile_one'=>$faker->phoneNumber,
        'mobile_two'=>$faker->phoneNumber,
        'nominee_account_1'=>$faker->numberBetween(1,5000),
        'savings_amount_1'=>$faker->numberBetween(100,50000),
        'nominee_mob_1'=>$faker->phoneNumber,
        'nominee_account_2'=>$faker->numberBetween(1,5000),
        'savings_amount_2'=>$faker->numberBetween(100,5000),
        'nominee_mob_2'=>$faker->phoneNumber,
        'field_officer_id'=>$faker->numberBetween(2,4),
        'slug'=>$faker->slug(2,4),
        'status'=>$faker->numberBetween(-2,4)
    ];
});
