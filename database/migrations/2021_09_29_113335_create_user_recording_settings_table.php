<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRecordingSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_recording_settings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('speciesgroup_id');
            $table->foreign('speciesgroup_id')->references('id')->on('speciesgroups')->onDelete('cascade');
            $table->index('speciesgroup_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index('user_id');
            $table->unsignedBigInteger('countingmethod_id');
            $table->foreign('countingmethod_id')->references('id')->on('countingmethods')->onDelete('cascade');
            $table->index('countingmethod_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_recording_settings');
    }
}
