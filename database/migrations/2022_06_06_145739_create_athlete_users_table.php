<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAthleteUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('athlete_users', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('athlete_id',50)->nullable();
            $table->string('athlete_name',150)->nullable();
            $table->string('profile_image')->nullable();
            $table->enum('athlete_type', ['Pistol','Rifle','Short','Disabled'])->nullable();
            $table->string('mobile',20)->nullable();
            $table->string('email',40)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->integer('age')->nullable();
            $table->integer('gender_id')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->longText('address')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->unsignedBigInteger('blood_group_id')->unsigned();
            $table->unsignedBigInteger('profession_id')->unsigned();
            $table->unsignedBigInteger('club_id')->unsigned()->nullable();
            $table->string('start_of_competition')->nullable();
            $table->string('practicing_shooter_sign')->nullable();
            $table->string('name_of_national_coach')->nullable();
            $table->string('handedness')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('hometown')->nullable();
//            $table->unsignedBigInteger('district_id')->unsigned()->nullable();

            $table->enum('marital_status', [1=>'Single',2=>'Married',3=>'Widowed',4=>'Divorced',5=>'Separated'])->nullable();
            $table->string('event')->nullable();
            $table->longText('higher_education')->nullable();
            $table->string('hobbies')->nullable();
            $table->string('parent_full_name')->nullable();
            $table->string('relationship')->nullable();
            $table->string('parent_mobile')->nullable();
            $table->longText('parent_address')->nullable();
            $table->tinyInteger('is_default')->default(1);
            $table->tinyInteger('is_active')->default(1);
            $table->tinyInteger('is_approved')->default(0);

            $table->integer('sort_order')->default(9999);

            $table->timestamps();
            $table->softDeletes();

//            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
//            $table->foreign('gender_id')->references('id')->on('genders')->onDelete('cascade');
//            $table->foreign('district_id')->references('id')->on('cities');
            $table->foreign('club_id')->references('id')->on('shooting_sport_clubs');
            $table->foreign('blood_group_id')->references('id')->on('blood_groups')->onDelete('cascade');
            $table->foreign('profession_id')->references('id')->on('professions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('athlete_users');
    }
}
