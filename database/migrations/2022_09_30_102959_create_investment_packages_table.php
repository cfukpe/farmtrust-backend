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
        Schema::create('investment_packages', function (Blueprint $table) {
            $table->id();
            $table->string('package_name');
            $table->text('package_description')->nullable();
            $table->string('package_image_url')->nullable();
            $table->double('unit_price');
            $table->string('duration');
            $table->double('return_rate');
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
        Schema::dropIfExists('investment_packages');
    }
};
