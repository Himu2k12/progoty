<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinalLoanVerificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('final_loan_verifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('loan_id');
            $table->integer('final_amount');
            $table->text('note')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('cashier_status')->default(0);
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
        Schema::dropIfExists('final_loan_verifications');
    }
}
