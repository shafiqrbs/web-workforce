<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJudgesJuryEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('judges_jury_event', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jury_id')->unsigned()->nullable();
            $table->unsignedBigInteger('event_id')->unsigned()->nullable();
            $table->longText('event_name_en',255)->nullable();
            $table->longText('event_name_bn',255)->nullable();
            $table->longText('event_address_en')->nullable();
            $table->longText('event_address_bn')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->integer('sort_order')->default(9999);
            $table->timestamps();
            $table->foreign('jury_id')->references('id')->on('judges_jury');
            $table->foreign('event_id')->references('id')->on('events');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('judges_jury_event');
    }
}
