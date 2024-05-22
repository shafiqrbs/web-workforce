<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutclubShortnameIntoClubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shooting_sport_clubs', function (Blueprint $table) {
            $table->string('short_name');
            $table->longText('about_club')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shooting_sport_clubs', function (Blueprint $table) {
            $table->dropColumn('short_name');
            $table->dropColumn('about_club');
        });
    }
}
