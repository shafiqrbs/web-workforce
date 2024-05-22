<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddedTargetControlIntoJuryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('judges_jury', function (Blueprint $table) {
            $table->tinyInteger('is_target_control')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('judges_jury', function (Blueprint $table) {
            $table->dropColumn('is_target_control');
        });
    }
}
