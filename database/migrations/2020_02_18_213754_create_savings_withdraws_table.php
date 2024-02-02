<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSavingsWithdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('savings_withdraws', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_id');
            $table->integer('supervisor_id');
            $table->float('percentage');
            $table->integer('savings_amount');
            $table->integer('profit')->nullable();
            $table->integer('bonus')->nullable();
            $table->integer('total');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('savings_withdraws');
    }
}
