<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBadgeLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('badge_levels', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('sequence')->default(0); //higher is better (4=crown, 3=gold, 2=silver, 1=bronze)
            $table->text("image_location")->nullable();
            $table->text("description_key")->nullable();
            $table->unsignedBigInteger('badge_id');
            $table->foreign('badge_id')->references('id')->on('badges')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('badge_levels');
    }
}
