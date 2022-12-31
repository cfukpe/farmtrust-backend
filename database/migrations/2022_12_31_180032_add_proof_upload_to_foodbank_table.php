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
        Schema::table('food_banks', function (Blueprint $table) {
            //
            $table->text('proof_upload_url')->nullable();
            $table->unsignedBigInteger('verified_by')->nullable();
            $table->timestamp('verified_on')->nullable();
            $table->string('status')->default(AppConstants::$PENDING);
            $table->foreign('verified_by')->references('id')->on('users');
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
            $table->dropColumn([
                'proof_upload_url',
                'verified_by',
                'verified_on',
                'status'
            ]);
        });
    }
};
