<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) 
        {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('accesstoken');
            $table->rememberToken();
            $table->timestamps();
            $table->string('prefered_language');
            $table->boolean('sci_names');
            $table->boolean('show_previous_observed_species');
            $table->boolean('show_only_common_species');
            $table->dateTime('settings_synched_at', 0);
            $table->boolean('isadmin')->default(false);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }


}
