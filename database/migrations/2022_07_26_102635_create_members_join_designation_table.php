<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersJoinDesignationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members_join_designation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id')->unsigned();
            $table->enum('committee_type', ['EXECUTIVE_COMMITTEE','SUB_COMMITTEE','CAMP_COMMANDANT_COACH','OFFICE_ADMINISTRATION'])->default('SUB_COMMITTEE');
            $table->string('sub_committee_group',60)->nullable();
            $table->unsignedBigInteger('designation_id')->unsigned();
            $table->integer('sort_order')->default(9999);
            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
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
        Schema::dropIfExists('members_join_designation');
    }
}
