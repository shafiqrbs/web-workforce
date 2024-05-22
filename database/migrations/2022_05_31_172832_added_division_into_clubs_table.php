<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddedDivisionIntoClubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shooting_sport_clubs', function (Blueprint $table) {
            $table->unsignedBigInteger('division_id')->unsigned()->nullable();
            $table->foreign('division_id')->references('id')->on('division')->onDelete('cascade');

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
            Schema::dropIfExists('division_id');
        });
    }
}
