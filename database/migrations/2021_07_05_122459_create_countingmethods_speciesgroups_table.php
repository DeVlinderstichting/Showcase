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
        Schema::create('countingmethods_speciesgroups', function (Blueprint $table) 
        {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('speciesgroup_id');
            $table->foreign('speciesgroup_id')->references('id')->on('speciesgroups')->onDelete('cascade');
            $table->index('speciesgroup_id');
            $table->unsignedBigInteger('countingmethod_id');
            $table->foreign('countingmethod_id')->references('id')->on('countingmethods')->onDelete('cascade');
            $table->index('countingmethod_id');
            $table->unique(['speciesgroup_id', 'countingmethod_id']);
            $table->unsignedBigInteger('recordinglevel_id');
            $table->foreign('recordinglevel_id')->references('id')->on('recordinglevels')->onDelete('cascade');
            $table->index('recordinglevel_id');
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
