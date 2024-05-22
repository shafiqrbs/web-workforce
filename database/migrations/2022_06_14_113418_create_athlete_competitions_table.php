<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAthleteCompetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('athlete_competitions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('athlete_id')->unsigned();
            $table->longText('competition_name')->nullable();
            $table->date('competition_date')->nullable();
            $table->string('competition_event',255)->nullable();
            $table->string('score',20)->nullable();
            $table->string('position',20)->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->integer('sort_order')->default(9999);
            $table->timestamps();
            $table->foreign('athlete_id')->references('id')->on('athlete_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('athlete_competitions');
    }
}
