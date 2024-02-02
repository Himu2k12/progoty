<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_applications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_no');
            $table->integer('loan_amount');
            $table->integer('total_deposite');
            $table->date('application_date');
            $table->string('present_district');
            $table->string('present_thana');
            $table->string('present_post_code');
            $table->string('present_village');
            $table->string('mobile_one');
            $table->string('mobile_two')->nullable();
            $table->integer('nominee_account_1');
            $table->integer('savings_amount_1');
            $table->string('nominee_mob_1');
            $table->integer('nominee_account_2');
            $table->integer('savings_amount_2');
            $table->string('nominee_mob_2');
            $table->integer('field_officer_id');
            $table->string('slug');
            $table->tinyInteger('status')->default(0);
            // field officer will set the loan status 0, then if anybody refuse the loan the status will be -1,
            // the status will be 1 when supervisor accept the loan application. then super will approve and the status will be 2
            // when cashier dispass the amount the status will be 3.
            //when
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan_applications');
    }
}
