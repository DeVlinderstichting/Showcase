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

        $l = \App\Models\Language::where('key', 'userSettingsPreferedLanguage')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "userSettingsPreferedLanguage";
            $l->en = "Prefered language";
            $l->nl = "Voorkeurstaal";
            $l->save();
        }

        $l = \App\Models\Language::where('key', 'userSettingsChangePassword')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "userSettingsChangePassword";
            $l->en = "Change password";
            $l->nl = "Wachtwoord aanpassen";
            $l->save();
        }

        $l = \App\Models\Language::where('key', 'email')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "email";
            $l->en = "Email address";
            $l->nl = "Email adres";
            $l->save();
        }

        $l = \App\Models\Language::where('key', 'passwordNew')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "passwordNew";
            $l->en = "New password";
            $l->nl = "Nieuw wachtwoord";
            $l->save();
        }

        $l = \App\Models\Language::where('key', 'passwordNewRepeat')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "passwordNewRepeat";
            $l->en = "New password (repeat)";
            $l->nl = "Nieuw wachtwoord (herhalen)";
            $l->save();                    
        }
    
        $l = \App\Models\Language::where('key', 'passwordOld')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "passwordOld";
            $l->en = "Old password";
            $l->nl = "Oud wachtwoord";
            $l->save();
        }

        $l = \App\Models\Language::where('key', 'visitCreateSectionSameSpecies')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "visitCreateSectionSameSpecies";
            $l->en = "It is not possible to have the same species multiple times on the same section";
            $l->nl = "Het is niet mogelijk om dezelfde soort meerdere keren op dezelfde sectie in te voeren";
            $l->save();
        }

        $l = \App\Models\Language::where('key', 'visitCreateInvalidStartdate')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "visitCreateInvalidStartdate";
            $l->en = "Start date or time is invalid.";
            $l->nl = "Startdatum of starttijd is niet geldig";
            $l->save();
        }

        $l = \App\Models\Language::where('key', 'visitCreateInvalidEnddate')->first();
        if ($l == null)
        {    
            $l = new \App\Models\Language(); 
            $l->key = "visitCreateInvalidEnddate";
            $l->en = "End time is invalid.";
            $l->nl = "De eindtijd is ongeldig";
            $l->save();
        }

        $l = \App\Models\Language::where('key', 'userHomeNoMessages')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "userHomeNoMessages";
            $l->en = "There are no messages.";
            $l->nl = "Er zijn geen berichten";
            $l->save();
        }

        $l = \App\Models\Language::where('key', 'dataInfoButtonHeader')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "dataInfoButtonHeader";
            $l->en = "Additional information about the information overview";
            $l->nl = "Aanvullende informatie over het gegevensoverzicht.";
            $l->save();
        }

        $l = \App\Models\Language::where('key', 'dataInfoButtonContent')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "dataInfoButtonContent";
            $l->en = "Here more information on the information overview can be presented.";
            $l->nl = "Hier is meer informatie te vinden over het gegevensoverzicht.";
            $l->save();
        }
    }
}
