<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancialPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financial_partners', function (Blueprint $table) {
            $table->id();
            $table->string('name',150)->nullable();
            $table->string('mobile',20)->nullable();
            $table->string('email',40)->nullable();
            $table->string('address')->nullable();
            $table->text('short_message')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('profile_image')->nullable();


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
        Schema::dropIfExists('financial_partners');
    }
}
