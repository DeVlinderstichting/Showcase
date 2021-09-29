<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountingmethodsSpeciesgroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countingmethods_speciesgroups', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('species_id');
            $table->foreign('species_id')->references('id')->on('species')->onDelete('cascade');
            $table->index('species_id');
            $table->unsignedBigInteger('countingmethod_id');
            $table->foreign('countingmethod_id')->references('id')->on('countingmethod')->onDelete('cascade');
            $table->index('countingmethod_id');
            $table->unique(['species_id', 'countingmethod_id']);
            $table->unsignedBigInteger('recordinglevel');
            $table->foreign('recording_level')->references('id')->on('recordinglevels')->onDelete('cascade');
            $table->index('recordinglevel');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('measurements_species');
    }
}
