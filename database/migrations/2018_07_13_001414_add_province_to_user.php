<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProvinceToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('add_ship_province')->nullable();
            $table->string('add_bill_province')->nullable();
            $table->string('add_ship_cap')->nullable();
            $table->string('add_bill_cap')->nullable();
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
            $table->dropColumn('add_ship_province');
            $table->dropColumn('add_bill_province');
            $table->dropColumn('add_ship_cap');
            $table->dropColumn('add_bill_cap');;
        });
    }
}
