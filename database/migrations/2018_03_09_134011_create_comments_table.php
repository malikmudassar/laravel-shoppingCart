<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('authorId')->nullable()->index();
            $table->string('authorDisplayName')->nullable()->index();
            $table->string('authorProfileImageUrl')->nullable();
            $table->string('authorChannel')->nullable()->index();
            $table->string('authorChannelUrl')->nullable();
            $table->integer('likeCount')->nullable();
            $table->dateTime('publishedAt')->nullable();
            $table->dateTime('updatedAt')->nullable();
            $table->integer('totalReplyCount')->nullable();
            $table->boolean('isPublic')->nullable();
            $table->text('comment')->nullable();
            $table->morphs('commentable');
            $table->json('extra');
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
        Schema::dropIfExists('comments');
    }
}
