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
            $table->date('application_date');
            $table->string('present_district');
            $table->string('present_thana');
            $table->string('present_post_code');
            $table->string('present_village');
            $table->integer('mobile_one');
            $table->integer('mobile_two')->nullable();
            $table->integer('nominee_account_1');
            $table->integer('nominee_account_2');
            $table->integer('field_officer_id');
            $table->string('slug');
            $table->tinyInteger('status')->default(0);
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
