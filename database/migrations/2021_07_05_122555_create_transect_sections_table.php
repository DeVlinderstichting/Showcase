<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransectSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transect_sections', function (Blueprint $table) 
        {
            $table->id();
            $table->timestamps();
            $table->text('name');
            $table->unsignedBigInteger('transect_id');
            $table->foreign('transect_id')->references('id')->on('transects')->onDelete('cascade');
            $table->index('transect_id');
            $table->integer('sequence');
            $table->GEOMETRY('location')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transect_sections');
    }
}
