<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class addExtraEn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'addExtraEn';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add extra translations for English to the database.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // mass assignment not allowed! --> fillable maken?
        
        $l = new \App\Models\Language(); 
        $l->key = "userSettingsPreferedLanguage";
        $l->en = "Prefered language";
        $l->save();

        $l = new \App\Models\Language(); 
        $l->key = "userSettingsChangePassword";
        $l->en = "Change password";
        $l->save();
        
        $l = new \App\Models\Language(); 
        $l->key = "email";
        $l->en = "Email address";
        $l->save();

        $l = new \App\Models\Language(); 
        $l->key = "passwordNew";
        $l->en = "New password";
        $l->save();

        $l = new \App\Models\Language(); 
        $l->key = "passwordNewRepeat";
        $l->en = "New password (repeat)";
        $l->save();                    
    
        $l = new \App\Models\Language(); 
        $l->key = "passwordOld";
        $l->en = "Old password";
        $l->save();

        $l = new \App\Models\Language(); 
        $l->key = "visitCreateSectionSameSpecies";
        $l->en = "It is not possible to have the same species multiple times on the same section";
        $l->save();

        $l = new \App\Models\Language(); 
        $l->key = "visitCreateInvalidStartdate";
        $l->en = "Start date or time is invalid.";
        $l->save();    
    
        $l = new \App\Models\Language(); 
        $l->key = "visitCreateInvalidEnddate";
        $l->en = "End time is invalid.";
        $l->save();
    }
}
