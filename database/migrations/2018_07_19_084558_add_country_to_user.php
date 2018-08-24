<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCountryToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('add_ship_country')->nullable();
            $table->string('add_bill_country')->nullable();
            $table->string('add_ship_city')->nullable();
            $table->string('add_bill_city')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table)
        {
            $table->dropColumn('add_ship_country');
            $table->dropColumn('add_bill_country');
            $table->dropColumn('add_ship_city');
            $table->dropColumn('add_bill_city');;
        });

    }
}
