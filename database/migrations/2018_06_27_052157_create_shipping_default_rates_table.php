<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingDefaultRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_default_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->double('min_per_item', 4,2);
            $table->double('max_per_item', 4,2);
            $table->double('handling_per_item', 4,2);
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
        Schema::dropIfExists('shipping_default_rates');
    }
}
