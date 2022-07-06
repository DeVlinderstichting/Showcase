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
        $user2->isadmin = true; 
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


        $user = \App\Models\User::create([
            'email' => "Erik.Ockinger@slu.se", 
            'password' => Hash::make('DUj4zRmaM9'), 
            'name' => "Erik.Ockinger@slu.se", 
            'prefered_language' => "se", 
            'accesstoken' => Str::random(80)
        ]);
        $user->isadmin = true; //is admin is not in fillable 
        $user->setRandomAccessToken();
        $user->save();


        $user = \App\Models\User::create([
            'email' => "a.l.mauchline@reading.ac.uk", 
            'password' => Hash::make('oykgklEX2h'), 
            'name' => "a.l.mauchline@reading.ac.uk", 
            'prefered_language' => "en", 
            'accesstoken' => Str::random(80)
        ]);
        $user->isadmin = true;  
        $user->setRandomAccessToken();
        $user->save();


        $user = \App\Models\User::create([
            'email' => "a.s.hood@reading.ac.uk", 
            'password' => Hash::make('kjdLwZpnqm'), 
            'name' => "a.s.hood@reading.ac.uk", 
            'prefered_language' => "en", 
            'accesstoken' => Str::random(80)
        ]);
        $user->isadmin = true;  
        $user->setRandomAccessToken();
        $user->save();

    }
}
