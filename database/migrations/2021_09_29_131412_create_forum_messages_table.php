<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForumMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_messages', function (Blueprint $table) 
        {
            $table->id();
            $table->timestamps();
            $table->dateTime('created_at', 0)->nullable();
            $table->unsignedBigInteger('thread_id');
            $table->foreign('thread_id')->references('id')->on('forum_threads')->onDelete('cascade');
            $table->index('thread_id');
            $table->unsignedBigInteger('createdby_userid');
            $table->foreign('createdby_userid')->references('id')->on('users')->onDelete('cascade');
            $table->index('createdby_userid');
            $table->string('content');
            $table->string('header');
            $table->string('image_primary');
            $table->string('image_secondary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forum_messages');
    }
}
