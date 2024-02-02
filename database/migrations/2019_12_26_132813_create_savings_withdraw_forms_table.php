<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSavingsWithdrawFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('savings_withdraw_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_no');
            $table->integer('total_savings');
            $table->string('mobile');
            $table->integer('form_fee');
            $table->text('note')->nullable();
            $table->string('days_of_saving');
            $table->integer('field_man_id');
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
        Schema::dropIfExists('savings_withdraw_forms');
    }
}
