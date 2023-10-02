<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBadgeLevelRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('badgelevel_requirements', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('badgelevel_id');
            $table->text("description_key")->nullable();
            $table->foreign('badgelevel_id')->references('id')->on('badge_levels')->onDelete('cascade');
            $table->unsignedBigInteger('badgerequirementtype_id');
            $table->foreign('badgerequirementtype_id')->references('id')->on('badge_requirement_types')->onDelete('cascade');
            $table->double("requirement_value")->default(0);
            $table->double("additional_requirement_value")->default(0); //only used to specify recordinglevelid (i.e. fit counts, to allow for a check of 15 fit counts )
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('badgelevel_requirements');
    }
}
