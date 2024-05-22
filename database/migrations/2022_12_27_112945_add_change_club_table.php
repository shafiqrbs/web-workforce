<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChangeClubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shooting_sport_clubs', function (Blueprint $table) {
            $table->renameColumn('name', 'name_en');
            $table->string('name_bn',255)->nullable()->after('name');
            $table->renameColumn('registration_number', 'registration_number_en');
            $table->string('registration_number_bn',255)->nullable()->after('registration_number');
            $table->renameColumn('mobile', 'mobile_en');
            $table->string('mobile_bn',255)->nullable()->after('mobile');
            $table->renameColumn('address', 'address_en');
            $table->string('address_bn',255)->nullable()->after('address');
            $table->renameColumn('short_name', 'short_name_en');
            $table->string('short_name_bn',255)->nullable()->after('short_name');
            $table->renameColumn('about_club', 'about_club_en');
            $table->longText('about_club_bn')->nullable()->after('about_club');
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
            $table->dropColumn('name_en');
            $table->dropColumn('name_bn');
            $table->dropColumn('registration_number_en');
            $table->dropColumn('registration_number_bn');
            $table->dropColumn('mobile_en');
            $table->dropColumn('mobile_bn');
            $table->dropColumn('address_en');
            $table->dropColumn('address_bn');
            $table->dropColumn('short_name_en');
            $table->dropColumn('short_name_bn');
            $table->dropColumn('about_club_en');
            $table->dropColumn('about_club_bn');
        });
    }
}
