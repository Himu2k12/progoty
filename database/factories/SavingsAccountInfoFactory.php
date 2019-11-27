<?php

use Faker\Generator as Faker;




$factory->define(App\SavingsAccountInfo::class, function (Faker $faker) {
    return [
        'applicant_name'=>$faker->name,
        'applicants_father_name'=>$faker->name,
        'national_id'=>$faker->numberBetween(1000000000,2000000000),
        'gender'=>$faker->numberBetween(1,3),
        'marital_status'=>$faker->numberBetween(2,5),
        'religion'=>$faker->randomLetter,
        'husband_name'=>$faker->secondaryAddress,
        'yearly_scheme'=>$faker->numberBetween(2,5),
        'deposite_type'=>$faker->randomLetter,
        'amount_of_money'=>$faker->numberBetween(5,500),
        'form_fee'=>$faker->numberBetween(5,500),
        'present_dist'=>$faker->numberBetween(1,5),
        'present_upa'=>$faker->numberBetween(1,5),
        'present_post_code'=>$faker->numberBetween(1000,5000),
        'present_village'=>$faker->address,


        'permanent_dist'=>$faker->numberBetween(1,5),
        'permanent_upa'=>$faker->numberBetween(1,5),
        'permanent_post_code'=>$faker->numberBetween(1000,5000),
        'permanent_village'=>$faker->address,


        'nomine_nid'=>$faker->numberBetween(1000000000,2000000000),
        'nominee_name'=>$faker->name,
        'relation'=>$faker->name,
        'nominee_dist'=>$faker->numberBetween(1,5),
        'nominee_upazila'=>$faker->numberBetween(1,5),
        'nominee_post_code'=>$faker->numberBetween(1000,5000),
        'nominee_address'=>$faker->address,
        'applicant_nid'=>$faker->imageUrl,
        'applicant_photo'=>$faker->imageUrl,
        'applicant_signature'=>$faker->imageUrl,
        'field_man_id'=>$faker->numberBetween(1,2000),
    ];
});
