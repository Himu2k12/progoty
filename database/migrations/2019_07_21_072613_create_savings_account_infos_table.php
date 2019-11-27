<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSavingsAccountInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('savings_account_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('applicant_name');
            $table->string('applicants_father_name');
            $table->string('national_id');
            $table->text('slug');
            $table->string('gender');
            $table->string('marital_status');
            $table->string('religion');
            $table->string('husband_name')->nullable();
            $table->integer('yearly_scheme');
            $table->string('deposite_type');
            $table->double('amount_of_money');
            $table->double('form_fee');
            $table->string('present_dist');
            $table->string('present_upa');
            $table->string('present_post_code');
            $table->string('present_village');
            $table->integer('permanent_dist');
            $table->integer('permanent_upa');
            $table->string('permanent_post_code');
            $table->string('permanent_village');
            $table->string('nominee_name');
            $table->string('relation');
            $table->string('nominee_dist');
            $table->string('nominee_upazila');
            $table->string('nominee_post_code');
            $table->string('nominee_address');
            $table->string('nomine_nid');
            $table->string('applicant_photo');
            $table->string('applicant_nid');
            $table->string('applicant_signature');
            $table->integer('field_man_id');
            $table->tinyInteger('verify')->default(0);
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
        Schema::dropIfExists('savings_account_infos');
    }
}
