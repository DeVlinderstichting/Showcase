<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class addUnknownLandusetype extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'addUnknownLandusetype';

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
        $unknonwType = new \App\Models\LanduseType();
        $unknonwType->name = "unknown";
        $unknonwType->description = "unknown";
        $unknonwType->save();

        $unknownType = new \App\Models\ManagementType();
        $unknownType->name = "unknown";
        $unknownType->description = "unknown";
        $unknownType->save();

        $unknownTranslation = new \App\Models\Language();
        $unknownTranslation->key = "unknown";
        $unknownTranslation->nl = "Onbekend";
        $unknownTranslation->en = "Unknown";
        $unknownTranslation->save();
    }
}
