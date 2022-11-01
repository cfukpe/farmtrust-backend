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
        Schema::create('investment_package_categories', function (Blueprint $table) {
            $table->id();
            $table->string('investment_category_name')->unique();
            $table->text('investment_category_description')->nullable();
            $table->text('investment_category_cover_image')->nullable();
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
        Schema::dropIfExists('investment_package_categories');
    }
};
