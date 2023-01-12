<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameActionEffectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gameaction_effects', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('landscape_id');
            $table->foreign('landscape_id')->references('id')->on('landscapes')->onDelete('cascade');
            $table->unsignedBigInteger('newlandscape_id')->nullable();
            $table->foreign('newlandscape_id')->references('id')->on('landscapes')->onDelete('cascade');
            $table->unsignedBigInteger('newlandscapecomponent_id')->nullable();
            $table->foreign('newlandscapecomponent_id')->references('id')->on('landscapecomponents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gameaction_effects');
    }
}
