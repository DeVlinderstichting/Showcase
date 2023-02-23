<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class update230119 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update230119';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '2023-01-19';

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
        $l = \App\Models\Language::where('key', 'homeSupportTitle')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "homeSupportTitle";
            $l->en = "Support";
            $l->nl = "Ondersteuning";
            $l->es = "Apoyo";
            $l->se = "Understöd";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'homeSupportDescription')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "homeSupportDescription";
            $l->en = "";
            $l->nl = "";
            $l->es = "";
            $l->se = "";
            $l->save();
        }
        $l = \App\Models\Language::where('key', 'homeSupportIdentificationHelp')->first();
        if ($l == null)
        {
            $l = new \App\Models\Language(); 
            $l->key = "homeSupportIdentificationHelp";
            $l->en = "Identification support";
            $l->nl = "Identificatie ondersteuning";
            $l->es = "Soporte de identificación";
            $l->se = "Identifieringsstöd";            
            $l->save();
        }
    }
}
