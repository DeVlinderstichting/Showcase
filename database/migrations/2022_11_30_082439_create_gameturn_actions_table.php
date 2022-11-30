<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameTurnActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gameturn_actions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('gameturn_id');
            $table->foreign('gameturn_id')->references('id')->on('gameturns')->onDelete('cascade');
            $table->unsignedBigInteger('gameaction_id');
            $table->foreign('gameaction_id')->references('id')->on('gameactions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gameturn_actions');
    }
}
