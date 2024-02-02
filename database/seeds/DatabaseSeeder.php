<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       factory(App\SavingsAccountInfo::class, 5000)->create();
        //factory(\App\LoanApplication::class,100)->create();
    }
}
