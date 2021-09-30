<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMethodSpeciesgroupRecordinglevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('method_speciesgroup_recordinglevels', function (Blueprint $table) 
        {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('method_id')->nullable();
            $table->foreign('method_id')->references('id')->on('methods')->onDelete('cascade');
            $table->index('method_id');
            $table->unsignedBigInteger('speciesgroup_id')->nullable();
            $table->foreign('speciesgroup_id')->references('id')->on('speciesgroups')->onDelete('cascade');
            $table->index('speciesgroup_id');
            $table->unsignedBigInteger('recordinglevel_id')->nullable();
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
        Schema::dropIfExists('method_speciesgroup_recordinglevels');
    }
}
