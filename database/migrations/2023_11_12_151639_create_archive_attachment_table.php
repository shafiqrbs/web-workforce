<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchiveAttachmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archive_attachment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('archive_id')->unsigned();
            $table->string('caption',255)->nullable();
            $table->string('attachment',20)->nullable();
            $table->timestamps();
            $table->foreign('archive_id')->references('id')->on('archives')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('archive_attachment');
    }
}
