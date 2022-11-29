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
    }
}
