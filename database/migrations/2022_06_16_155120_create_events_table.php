<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_name',255)->nullable();
            $table->string('event_type',255)->nullable();
            $table->integer('number_of_club')->nullable();
            $table->integer('number_of_athlete')->nullable();
            $table->integer('number_of_official')->nullable();
            $table->longText('event_message')->nullable();
            $table->longText('match_schedule_message')->nullable();
            $table->string('event_image',50)->nullable();
            $table->string('match_schedule_pdf',50)->nullable();

            $table->tinyInteger('is_default')->default(1);
            $table->tinyInteger('is_active')->default(1);
            $table->integer('sort_order')->default(9999);
            $table->timestamps();
            $table->softDeletes();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
