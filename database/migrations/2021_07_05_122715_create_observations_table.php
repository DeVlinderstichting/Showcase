<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observations', function (Blueprint $table) 
        {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('species_id');
            $table->dateTime('observationtime', 0);
            $table->foreign('species_id')->references('id')->on('species')->onDelete('cascade');
            $table->index('species_id');
            $table->integer('number');
            $table->unsignedBigInteger('visit_id');
            $table->foreign('visit_id')->references('id')->on('visits')->onDelete('cascade');
            $table->index('visit_id');
            $table->unsignedBigInteger('transect_section_id')->nullable();
            $table->foreign('transect_section_id')->references('id')->on('transect_sections')->onDelete('cascade');
            $table->index('transect_section_id');
            $table->GEOMETRY('location');
        });
        DB::statement('ALTER TABLE observations ADD CONSTRAINT check_number CHECK (number > 0);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('observations');
    }
}
