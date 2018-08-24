<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('card_type');
            $table->string('card_number');
            $table->integer('cvv');
            $table->string('expiry');
            $table->string('name');
            $table->string('surname');
            $table->string('address1');
            $table->string('address2');
            $table->string('province');
            $table->string('city');
            $table->string('country');
            $table->integer('box_id');
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
        Schema::dropIfExists('subscriptions');
    }
}
