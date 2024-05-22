<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddedMemberIdIntoNewsNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news_and_notices', function (Blueprint $table) {
            $table->unsignedBigInteger('member_id')->unsigned()->nullable();
            $table->foreign('member_id')->references('id')->on('committee_members');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news_and_notices', function (Blueprint $table) {
            $table->dropColumn('member_id');
        });
    }
}
