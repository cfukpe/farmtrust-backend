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
        Schema::create('corporative_members', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('farm_id');
            $table->string('member_farm_name');
            $table->string('member_name');
            $table->string('member_farm_location');
            $table->string('member_bvn');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('corporative_members');
    }
};
