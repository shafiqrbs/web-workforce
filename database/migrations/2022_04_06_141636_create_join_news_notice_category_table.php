<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJoinNewsNoticeCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_notice_category_join', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('news_notice_id')->unsigned();
            $table->unsignedBigInteger('category_id')->unsigned();
            $table->timestamps();

            $table->foreign('news_notice_id')->references('id')->on('news_and_notices')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('news_and_notice_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_notice_category_join');
    }
}
