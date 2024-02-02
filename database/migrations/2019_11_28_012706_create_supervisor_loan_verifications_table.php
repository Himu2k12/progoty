<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupervisorLoanVerificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supervisor_loan_verifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('loan_id');
            $table->string('check_no')->nullable();
            $table->string('bank_name')->nullable();
            $table->integer('loan_suggest');
            $table->text('note');
            $table->integer('supervisor_id');
            $table->tinyInteger('status');
            // status 1 for approve and 0 for cancel
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
        Schema::dropIfExists('supervisor_loan_verifications');
    }
}
