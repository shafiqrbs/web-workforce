<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddedDistrictApproveIntoAthleteUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('athlete_users', function (Blueprint $table) {
            $table->unsignedBigInteger('district_id')->unsigned()->nullable()->after('sort_order');
//            $table->tinyInteger('is_approved')->default(0)->after('district_id');
//            $table->string('athlete_id',50)->nullable()->after('is_approved');

            $table->foreign('district_id')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('athlete_users', function (Blueprint $table) {
            $table->dropColumn('district_id');
            $table->dropColumn('is_approved');
            $table->dropColumn('athlete_id');
        });
    }
}
