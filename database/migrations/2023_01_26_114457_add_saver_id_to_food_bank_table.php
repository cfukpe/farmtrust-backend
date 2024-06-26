<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('food_banks', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('saver_id')->nullable(true);

            $table->foreign('saver_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('food_banks', function (Blueprint $table) {
            //
            $table->dropColumn(['saver_id']);
        });
    }
};
