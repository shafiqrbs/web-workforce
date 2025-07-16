<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGainParticularsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gain__particulars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('particular_id')->unsigned();
            $table->string('name',100);
            $table->string('slug',100);
            $table->string('group',100)->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('particular_id')->references('id')->on('gain__particular_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gain_particulars');
    }
}
