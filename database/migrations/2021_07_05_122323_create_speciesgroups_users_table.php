<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpeciesgroupsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('speciesgroups_users', function (Blueprint $table) 
        {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index('user_id');
            $table->unsignedBigInteger('speciesgroup_id');
            $table->foreign('speciesgroup_id')->references('id')->on('speciesgroups')->onDelete('cascade');
            $table->index('speciesgroup_id');
            $table->unique(['user_id', 'speciesgroup_id']);
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
        Schema::dropIfExists('speciesgroups_users');
    }
}
