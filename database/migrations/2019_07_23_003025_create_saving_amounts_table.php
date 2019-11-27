<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSavingAmountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saving_amounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id');
            $table->string('slug');
            $table->integer('field_man_id');
            $table->integer('amount');
            $table->integer('sheet_no');
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
        Schema::dropIfExists('saving_amounts');
    }
}
