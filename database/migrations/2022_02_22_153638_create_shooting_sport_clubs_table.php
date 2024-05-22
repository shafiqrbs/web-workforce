<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShootingSportClubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shooting_sport_clubs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('club_logo')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('mobile')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->enum('club_type', ['SERVICE', 'GENERAL', 'DONATE', 'SPONSOR', 'OTHER'])->default('GENERAL');
            $table->string('address')->nullable();
            $table->string('website_url')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->tinyInteger('is_default')->default(1);
            $table->tinyInteger('is_active')->default(1);
            $table->integer('sort_order')->default(9999);
            $table->string('lang',10)->default('en');
            $table->unsignedBigInteger('district_id')->unsigned()->nullable();

            $table->timestamps();

            $table->foreign('district_id')->references('id')->on('cities')->onDelete('set null');

        });

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shooting_sport_clubs');
    }
}
