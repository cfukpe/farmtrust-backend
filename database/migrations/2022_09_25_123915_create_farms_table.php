<?php

use App\Utilities\AppConstants;
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
        Schema::create('farms', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("user_id");
            $table->bigInteger('investment_package_id');
            $table->string('farm_name');
            $table->string('farm_description')->nullable();
            $table->string('farm_location');
            $table->string('farm_state');
            $table->string('insurance_document')->nullable();
            $table->boolean('is_corporative')->default(false);
            $table->string('status')->default(AppConstants::$ACTIVE);
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
        Schema::dropIfExists('farms');
    }
};
