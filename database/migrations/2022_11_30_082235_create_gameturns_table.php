<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameTurnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gameturns', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('turnnr')->default(0);
            $table->unsignedBigInteger('game_id');
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->unsignedBigInteger('landscape_id');
            $table->foreign('landscape_id')->references('id')->on('landscapes')->onDelete('cascade');
            $table->unique(['game_id', 'turnnr']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gameturns');
    }
}
