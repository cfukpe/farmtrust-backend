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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('other_names')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('role')->default(AppConstants::$INVESTOR);
            $table->boolean('is_trust_member')->default(false);
            $table->string('password');
            $table->string('status')->default(AppConstants::$ACTIVE);
            $table->double('investment_balance')->default(0.00);
            $table->double('food_bank_balance')->default(0.00);
            $table->double('savings_balance')->default(0.00);
            $table->double('outstanding_loan')->default(0.00);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
