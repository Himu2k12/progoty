<?php

use Faker\Generator as Faker;




$factory->define(App\SavingsAccountInfo::class, function (Faker $faker) {
    return [
        'applicant_name'=>$faker->name,
        'applicants_father_name'=>$faker->name,
        'national_id'=>$faker->numberBetween(1000000000,2000000000),
        'gender'=>$faker->numberBetween(1,3),
        'marital_status'=>'Unmarried',
        'religion'=>'Hindu',
        'yearly_scheme'=>$faker->numberBetween(2,5),
        'deposite_type'=>'Monthly',
        'amount_of_money'=>$faker->numberBetween(5,500),
        'form_fee'=>$faker->numberBetween(20,30),
        'present_dist'=>$faker->city,
        'present_upa'=>$faker->city,
        'present_post_code'=>$faker->numberBetween(1000,5000),
        'present_village'=>$faker->address,
        'mobile'=>$faker->phoneNumber,


        'permanent_dist'=>$faker->numberBetween(1,2),
        'permanent_upa'=>$faker->numberBetween(1,5),
        'permanent_post_code'=>$faker->numberBetween(1000,5000),
        'permanent_village'=>$faker->address,


        'nomine_nid'=>$faker->numberBetween(1000000000,2000000000),
        'nominee_name'=>$faker->name,
        'relation'=>$faker->name,
        'nominee_dist'=>$faker->numberBetween(1,2),
        'nominee_upazila'=>$faker->numberBetween(1,5),
        'nominee_post_code'=>$faker->numberBetween(1000,5000),
        'nominee_address'=>$faker->address,
        'applicant_nid'=>$faker->imageUrl,
        'applicant_photo'=>$faker->imageUrl,
        'applicant_signature'=>$faker->imageUrl,
        'field_man_id'=>$faker->numberBetween(1,2),
    ];
});
