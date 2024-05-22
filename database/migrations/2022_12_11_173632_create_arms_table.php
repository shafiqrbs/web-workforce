<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arms', function (Blueprint $table) {
            $table->id();
            $table->longText('name_en')->nullable();
            $table->longText('name_bn')->nullable();

            $table->string('arms_image')->nullable();

            $table->string('bullet_size_bn',255)->nullable();
            $table->string('bullet_size_en',255)->nullable();

            $table->integer('quantity_bn')->nullable();
            $table->integer('quantity_en')->nullable();

            $table->string('max_velocity_bn',50)->nullable();
            $table->string('max_velocity_en',50)->nullable();

            $table->string('overall_length_bn',50)->nullable();
            $table->string('overall_length_en',50)->nullable();

            $table->string('buttplate_bn',50)->nullable();
            $table->string('buttplate_en',50)->nullable();

            $table->string('function_bn',255)->nullable();
            $table->string('function_en',255)->nullable();

            $table->string('weight_bn',50)->nullable();
            $table->string('weight_en',50)->nullable();

            $table->string('trigger_pull_bn',50)->nullable();
            $table->string('trigger_pull_en',50)->nullable();

            $table->string('scopeable_bn',20)->nullable();
            $table->string('scopeable_en',20)->nullable();

            $table->string('safety_bn',20)->nullable();
            $table->string('safety_en',20)->nullable();

            $table->string('suggested_for_bn',255)->nullable();
            $table->string('suggested_for_en',255)->nullable();

            $table->string('caliber_bn',50)->nullable();
            $table->string('caliber_en',50)->nullable();

            $table->string('muzzle_energy_bn',50)->nullable();
            $table->string('muzzle_energy_en',50)->nullable();

            $table->string('loudness_bn',50)->nullable();
            $table->string('loudness_en',50)->nullable();

            $table->string('barrel_length_bn',20)->nullable();
            $table->string('barrel_length_en',20)->nullable();

            $table->string('barrel_bn',100)->nullable();
            $table->string('barrel_en',100)->nullable();

            $table->longText('front_sight_bn')->nullable();
            $table->longText('front_sight_en')->nullable();

            $table->longText('rear_sight_bn')->nullable();
            $table->longText('rear_sight_en')->nullable();

            $table->longText('trigger_bn')->nullable();
            $table->longText('trigger_en')->nullable();

            $table->longText('action_bn')->nullable();
            $table->longText('action_en')->nullable();

            $table->longText('power_plant_bn')->nullable();
            $table->longText('power_plant_en')->nullable();

            $table->string('max_shots_per_fill_bn',20)->nullable();
            $table->string('max_shots_per_fill_en',20)->nullable();

            $table->longText('operating_pressuer_bn')->nullable();
            $table->longText('operating_pressuer_en')->nullable();

            $table->string('body_type_bn',20)->nullable();
            $table->string('body_type_en',20)->nullable();

            $table->string('fixed_adj_power_bn',20)->nullable();
            $table->string('fixed_adj_power_en',20)->nullable();

            $table->string('shot_capacity_bn',10)->nullable();
            $table->string('shot_capacity_en',10)->nullable();

            $table->tinyInteger('is_default')->default(1);
            $table->tinyInteger('is_active')->default(1);

            $table->integer('sort_order')->default(9999);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arms');
    }
}
