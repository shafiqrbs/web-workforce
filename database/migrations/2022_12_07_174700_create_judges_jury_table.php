<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJudgesJuryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('judges_jury', function (Blueprint $table) {
            $table->id();
            $table->string('name_en',255)->nullable();
            $table->string('name_bn',255)->nullable();
            $table->string('mobile_en',20)->nullable();
            $table->string('mobile_bn',20)->nullable();
            $table->string('email',100)->nullable();
            $table->string('issf_license_no_en')->nullable();
            $table->string('issf_license_no_bn')->nullable();
            $table->date('license_valid_date')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('jury_class',50)->nullable();
            $table->longText('address_en')->nullable();
            $table->longText('address_bn')->nullable();
            $table->longText('remark_en')->nullable();
            $table->longText('remark_bn')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('e_signature')->nullable();
            $table->tinyInteger('is_rifle')->default(false);
            $table->tinyInteger('is_pistol')->default(false);
            $table->tinyInteger('is_short_gun')->default(false);
            $table->tinyInteger('is_running_target')->default(false);
            $table->tinyInteger('is_electronic_target')->default(false);


            $table->tinyInteger('is_default')->default(1);
            $table->tinyInteger('is_active')->default(1);

            $table->integer('sort_order')->default(9999);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('judges_jury');
    }
}
