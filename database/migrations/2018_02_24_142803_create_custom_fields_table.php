<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('customizable');
            $table->string('htmlid')->index();
            $table->integer('order')->nullable()->index();
            $table->string('label')->nullable()->index();
            $table->string('description')->nullable()->index();
            $table->string('type', 50)->index();
            $table->text('text')->nullable();
            $table->text('html')->nullable();
            $table->json('value')->nullable();
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
        Schema::dropIfExists('custom_fields');
    }
}
