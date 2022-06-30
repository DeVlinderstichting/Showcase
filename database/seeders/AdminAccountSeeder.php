<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Hash;

class AdminAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::create([
            'email' => "michiel.wallisdevries@vlinderstichting.nl", 
            'password' => Hash::make('MfnW2wjz7T'), 
            'name' => "michielwallisdevries", 
            'prefered_language' => "nl", 
            'accesstoken' => Str::random(80)
        ]);
        $user->isadmin = true; //is admin is not in fillable 
        $user->setRandomAccessToken();
        $user->save();

        $user2 = \App\Models\User::create(['name'=> 'admin','email'=> 'bas.oteman@vlinderstichting.nl', 'password'=> Hash::make('showcase41#'), 'accesstoken' => '123token']);
        $user2->setRandomAccessToken();
        $user2->save();

        $user = \App\Models\User::create([
            'email' => "nacho.bartomeus@gmail.com", 
            'password' => Hash::make('oW5cywaRf1'), 
            'name' => "nachobartomeus", 
            'prefered_language' => "es", 
            'accesstoken' => Str::random(80)
        ]);
        $user->isadmin = true; //is admin is not in fillable 
        $user->setRandomAccessToken();
        $user->save();

        $user2 = \App\Models\User::create(['name'=> 'showcase','email'=> 'info@vlinderstichting.nl', 'password'=> Hash::make('showcase#admin54Xeu'), 'accesstoken' => '123token']);
        $user2->setRandomAccessToken();
        $user2->save();

    }
}
