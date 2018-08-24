<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->integer('author')->nullable();
            $table->string('slug')->nullable();
            $table->text('excerpt')->nullable();
            $table->text('content')->nullable();
            $table->dateTime('published_at')->nullable()->index();
            $table->boolean('is_published')->nullable()->index();
            $table->integer('version')->nullable();
            $table->string('type', 50)->index();
            $table->json('extra')->nullable();
            $table->timestamps();
        });

        Schema::create('post_post', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id')->unsigned();
            $table->integer('relatedto_id')->unsigned();
            $table->string('relation')->nullable()->index();
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
        Schema::dropIfExists('posts');
        Schema::dropIfExists('post_post');
    }
}
