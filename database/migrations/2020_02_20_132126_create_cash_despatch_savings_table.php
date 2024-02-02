<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashDespatchSavingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_despatch_savings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('savings_withdraw_id');
            $table->integer('cashier_id');
            $table->integer('total_despatched');
            $table->date('despatched_date');
            $table->text('note');
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('cash_despatch_savings');
    }
}
