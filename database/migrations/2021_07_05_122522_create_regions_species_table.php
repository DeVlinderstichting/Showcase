<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionsSpeciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regions_species', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('species_id');
            $table->foreign('species_id')->references('id')->on('species')->onDelete('cascade');
            $table->index('species_id');
            $table->unsignedBigInteger('region_id');
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
            $table->index('region_id');
            $table->unique(['user_id', 'region_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regions_users');
    }
}
