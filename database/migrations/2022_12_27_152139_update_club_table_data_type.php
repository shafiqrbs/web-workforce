<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateClubTableDataType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shooting_sport_clubs', function (Blueprint $table) {
            $table->string('short_name_en',255)->nullable()->change();
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
            $table->dropColumn('short_name_en');
        });
    }
}
