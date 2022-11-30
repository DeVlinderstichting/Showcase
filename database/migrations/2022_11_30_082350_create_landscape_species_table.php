<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandscapeSpeciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landscape_species', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('landscape_id');
            $table->foreign('landscape_id')->references('id')->on('landscapes')->onDelete('cascade');
            $table->unsignedBigInteger('species_id');
            $table->foreign('species_id')->references('id')->on('species')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('landscape_species');
    }
}
