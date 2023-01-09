<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class addTranslations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'addTranslations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $l = \App\Models\Language::where('key', 'userSettingsMoreSettings')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "userSettingsMoreSettings";
            $l->en = "More settings (online)";
            $l->nl = "Meer instellingen (online)";
            $l->save();
        }

        $l = \App\Models\Language::where('key', 'butterflies')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "butterflies";
            $l->en = "butterflies";
            $l->nl = "vlinders";
            $l->es = "mariposas";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'moths')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "moths";
            $l->en = "moths";
            $l->nl = "nachtvlinders";
            $l->es = "polillas";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'bumblebees')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "bumblebees";
            $l->en = "bumblebees";
            $l->nl = "hommels";
            $l->es = "abejorros";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'solitarybees')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "solitarybees";
            $l->en = "solitary bees";
            $l->nl = "solitaire bijen";
            $l->es = "abejas silvestres";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'honeybees')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "honeybees";
            $l->en = "honeybees";
            $l->nl = "honingbijen";
            $l->es = "abeja de la miel";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'hoverflies')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "hoverflies";
            $l->en = "hoverflies";
            $l->nl = "zweefvliegen";
            $l->es = "sírfidos";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'flies')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "flies";
            $l->en = "flies";
            $l->nl = "vliegen";
            $l->es = "dípteros";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'beetles')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "beetles";
            $l->en = "beetles";
            $l->nl = "kevers";
            $l->es = "escarabajos";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'bugs')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "bugs";
            $l->en = "bugs";
            $l->nl = "wantsen";
            $l->es = "insectos";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'wasps')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "wasps";
            $l->en = "wasps";
            $l->nl = "wespen";
            $l->es = "avispas";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'plants')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "plants";
            $l->en = "plants";
            $l->nl = "planten";
            $l->es = "plantas";
            $l->save();
        }



        $l = \App\Models\Language::where('key', 'chartJanuary')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "chartJanuary";
            $l->en = "January";
            $l->nl = "January";
            $l->es = "January";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'chartFebruary')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "chartFebruary";
            $l->en = "February";
            $l->nl = "February";
            $l->es = "February";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'chartMarch')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "chartMarch";
            $l->en = "March";
            $l->nl = "March";
            $l->es = "March";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'chartApril')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "chartApril";
            $l->en = "April";
            $l->nl = "April";
            $l->es = "April";
            $l->save();
        }
         $l = \App\Models\Language::where('key', 'chartMay')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "chartMay";
            $l->en = "May";
            $l->nl = "May";
            $l->es = "May";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'chartJune')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "chartJune";
            $l->en = "June";
            $l->nl = "June";
            $l->es = "June";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'chartJuly')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "chartJuly";
            $l->en = "July";
            $l->nl = "July";
            $l->es = "July";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'chartAugust')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "chartAugust";
            $l->en = "August";
            $l->nl = "August";
            $l->es = "August";
            $l->save();
        }
         $l = \App\Models\Language::where('key', 'chartSeptember')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "chartSeptember";
            $l->en = "September";
            $l->nl = "September";
            $l->es = "September";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'chartOctober')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "chartOctober";
            $l->en = "October";
            $l->nl = "October";
            $l->es = "October";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'chartNovember')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "chartNovember";
            $l->en = "November";
            $l->nl = "November";
            $l->es = "November";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'chartDecember')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "chartDecember";
            $l->en = "December";
            $l->nl = "December";
            $l->es = "December";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'chartTitle')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "chartTitle";
            $l->en = "Observations";
            $l->nl = "Observations";
            $l->es = "Observations";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'chartAxisTitle')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "chartAxisTitle";
            $l->en = "Number of observations";
            $l->nl = "Number of observations";
            $l->es = "Number of observations";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'chartRedirect')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "chartRedirect";
            $l->en = "This will redirect to website with details on";
            $l->nl = "This will redirect to website with details on";
            $l->es = "This will redirect to website with details on";
            $l->save();
        }
    }
}
