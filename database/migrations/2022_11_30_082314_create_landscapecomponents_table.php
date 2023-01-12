<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandscapeComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landscapecomponents', function (Blueprint $table) 
        {
            $table->id();
            $table->timestamps();
            $table->GEOMETRY('shape')->nullable();
            $table->GEOMETRY('position')->nullable();
            $table->text('texturelocation')->nullable();
            $table->text('element')->nullable();
            $table->double('frequency', 12,4)->default(0);
            $table->double('ecoscore', 8,2)->default(0);
            $table->unsignedBigInteger('landscape_id');
            $table->foreign('landscape_id')->references('id')->on('landscapes')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('landscapecomponents');
    }
}
