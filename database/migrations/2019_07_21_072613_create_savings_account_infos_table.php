<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Cviebrock\EloquentSluggable\Sluggable;

class CreateSavingsAccountInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
      use Sluggable;

  
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'national_id'
            ]
        ];
    }
    public function up()
    {
        Schema::create('savings_account_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('applicant_name');
            $table->string('applicants_father_name');
            $table->string('national_id');
            $table->string('slug');
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
            $table->string('nomine_nid')->nullable();
            $table->string('applicant_photo');
            $table->string('applicant_nid');
            $table->string('applicant_signature');
            $table->integer('field_man_id');
            $table->string('mobile');
            $table->tinyInteger('verify')->default(0);
            //verify:: 0= application submitted for verify, 1=verified members, 5=closed after withdrawal
            $table->timestamps();
        });

        DB::statement("ALTER TABLE savings_account_infos AUTO_INCREMENT = 100001;");

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
