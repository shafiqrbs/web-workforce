<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChangeEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::table('shooting_sport_clubs', function (Blueprint $table) {
            $table->renameColumn('event_name', 'event_name_en');
            $table->string('event_name_bn',255)->nullable()->after('event_name');
            $table->renameColumn('event_type', 'event_type_en');
            $table->string('event_type_bn',255)->nullable()->after('event_type');
            $table->renameColumn('number_of_club', 'number_of_club_en');
            $table->integer('number_of_club_bn')->nullable()->after('number_of_club');
            $table->renameColumn('number_of_athlete', 'number_of_athlete_en');
            $table->integer('number_of_athlete_bn')->nullable()->after('number_of_athlete');
            $table->renameColumn('number_of_official', 'number_of_official_en');
            $table->integer('number_of_official_bn')->nullable()->after('number_of_official');
            $table->renameColumn('event_message', 'event_message_en');
            $table->longText('event_message_bn')->nullable()->after('event_message');
            $table->renameColumn('match_schedule_message', 'match_schedule_message_en');
            $table->longText('match_schedule_message_bn')->nullable()->after('match_schedule_message');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*Schema::table('shooting_sport_clubs', function (Blueprint $table) {
            $table->dropColumn('event_name_en');
            $table->dropColumn('event_name_bn');
            $table->dropColumn('event_type_en');
            $table->dropColumn('event_type_bn');
            $table->dropColumn('number_of_club_en');
            $table->dropColumn('number_of_club_bn');
            $table->dropColumn('number_of_athlete_en');
            $table->dropColumn('number_of_athlete_bn');
            $table->dropColumn('number_of_official_en');
            $table->dropColumn('number_of_official_bn');
            $table->dropColumn('event_message_en');
            $table->dropColumn('event_message_bn');
            $table->dropColumn('match_schedule_message_en');
            $table->dropColumn('match_schedule_message_bn');
        });*/
    }
}
