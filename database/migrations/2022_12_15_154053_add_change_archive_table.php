<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChangeArchiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('archives', function (Blueprint $table) {
            $table->renameColumn('archive_name', 'archive_name_en');
            $table->string('archive_name_bn',255)->nullable()->after('archive_name');
            $table->renameColumn('sub_title', 'sub_title_en');
            $table->longText('sub_title_bn')->nullable()->after('sub_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('archives', function (Blueprint $table) {
            $table->dropColumn('archive_name_en');
            $table->dropColumn('archive_name_bn');
            $table->dropColumn('sub_title_en');
            $table->dropColumn('sub_title_bn');
        });
    }
}
