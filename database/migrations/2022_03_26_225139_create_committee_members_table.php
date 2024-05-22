<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommitteeMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('committee_members', function (Blueprint $table) {
            $table->id();
            $table->string('name',150)->nullable();
            $table->string('profile_image')->nullable();
            $table->string('mobile',20)->nullable();
            $table->string('email',40)->nullable();
            $table->unsignedBigInteger('designation_id')->unsigned();
            $table->string('address')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->text('short_message')->nullable();
            $table->enum('committee_type', ['EXECUTIVE_COMMITTEE','SUB_COMMITTEE','CAMP_COMMANDANT_COACH','OFFICE_ADMINISTRATION'])->default('SUB_COMMITTEE');
            $table->string('sub_committee_group',60)->nullable();
            $table->tinyInteger('is_default')->default(1);
            $table->tinyInteger('is_active')->default(1);
            $table->integer('sort_order')->default(9999);
            $table->timestamps();

            $table->foreign('designation_id')->references('id')->on('career_levels')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('committee_members');
    }
}
