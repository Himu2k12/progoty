<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSheetRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sheet_records', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sheet_no');
            $table->string('slug');
            $table->unsignedInteger('field_officer_id');
            $table->date('collection_date');
            $table->integer('savings_amount');
            $table->integer('loan_amount')->nullable();
            $table->integer('loan_service')->nullable();
            $table->integer('additional_collection')->nullable();
            $table->integer('total');
            $table->unsignedInteger('cashier_id');
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
        Schema::dropIfExists('sheet_records');
    }
}
