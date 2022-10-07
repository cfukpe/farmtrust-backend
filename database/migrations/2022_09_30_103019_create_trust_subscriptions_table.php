<?php

use App\Utilities\AppConstants;
use Carbon\Carbon;
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
        Schema::create('trust_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->double('subscription_amount');
            $table->timestamp('expiry_date')->default(Carbon::now()->addYear(1)); //Default subscripton is one year
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
        Schema::dropIfExists('trust_subscriptions');
    }
};
