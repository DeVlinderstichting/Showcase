<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountobjectLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countobject_locations', function (Blueprint $table) 
        {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('location_id');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
            $table->index('location_id');
            $table->unsignedBigInteger('countobject_id');
            $table->foreign('countobject_id')->references('id')->on('countobjects')->onDelete('cascade');
            $table->index('countobject_id');
            $table->integer('sequence');
            $table->unique(['sequence', 'countobject_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countobject_locations');
    }
}
