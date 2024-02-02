<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanPayAmountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_pay_amounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('loan_id');
            $table->integer('account_no');
            $table->integer('field_man_id');
            $table->integer('amount');
            $table->integer('service_charge');
            $table->integer('sheet_no');
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
        Schema::dropIfExists('loan_pay_amounts');
    }
}
