<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('financial_partners', function (Blueprint $table) {
            // Change 'male' and 'female' to have default 0
            $table->integer('male')->default(0)->nullable(false)->change();
            $table->integer('female')->default(0)->nullable(false)->change();
        });
    }

    public function down()
    {
        Schema::table('financial_partners', function (Blueprint $table) {
            // Revert changes (example: back to nullable)
            $table->integer('male')->nullable()->change();
            $table->integer('female')->nullable()->change();
        });
    }
};
