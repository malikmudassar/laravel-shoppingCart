<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToShippingClasses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shipping_classes', function (Blueprint $table) {
            $table->string('rule_type');
            $table->double('fixed_rate',4,2);
            $table->string('town');
            $table->integer('min_cap');
            $table->integer('max_cap');
            $table->integer('cap');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shipping_classes', function (Blueprint $table)
        {
            //$table->dropColumn('shipping_class');
            $table->dropColumn('rule_type');
            $table->dropColumn('fixed_rate',4,2);
            $table->dropColumn('town');
            $table->dropColumn('min_cap');
            $table->dropColumn('max_cap');
            $table->dropColumn('cap');
        });

    }
}
