<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('staff_photo');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('fathers_name');
            $table->string('mothers_name');
            $table->text('present_address');
            $table->text('permanent_address');
            $table->date('date_of_birth');
            $table->date('joining_date');
            $table->string('designation');
            $table->string('blood_group');
            $table->string('cv_doc')->nullable();
            $table->text('description')->nullable();
            $table->string('bank_account_no')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('account_holder_name')->nullable();
            $table->string('salary_amount');
            $table->string('mobile_number');
            $table->string('status')->default(1);
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
        Schema::dropIfExists('staff_infos');
    }
}
