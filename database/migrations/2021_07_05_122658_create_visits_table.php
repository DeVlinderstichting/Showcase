<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('countingmethod_id')->nullable();
            $table->foreign('countingmethod_id')->references('id')->on('countingmethods')->onDelete('cascade');
            $table->index('countingmethod_id');
            $table->geom('location')->nullable();

            $table->dateTime('startdate', 0);
            $table->dateTime('enddate', 0)->nullable(); //nullable to accept ongoing visits

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index('user_id');
            $table->text('notes');
            $table->text('wind');
            $table->text('temperature');
            $table->text('clouds');

            $table->unsignedBigInteger('transect_id')->nullable();
            $table->foreign('transect_id')->references('id')->on('transects')->onDelete('cascade');
            $table->index('transect_id');
            $table->unsignedBigInteger('transect_section_id')->nullable();
            $table->foreign('transect_section_id')->references('id')->on('transect_sections')->onDelete('cascade');
            $table->index('transect_section_id');
            $table->unsignedBigInteger('flower_id')->nullable();
            $table->foreign('flower_id')->references('id')->on('species')->onDelete('cascade');
            $table->index('flower_id');

            $table->unsignedBigInteger('flower_id')->nullable();
            $table->foreign('flower_id')->references('id')->on('species')->onDelete('cascade');
            $table->index('flower_id');

            $table->unsignedBigInteger('measurement_id');
            $table->foreign('measurement_id')->references('id')->on('measurements');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visits');
    }
}
