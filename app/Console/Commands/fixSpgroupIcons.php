<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class fixSpgroupIcons extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fixSpgroupIcons';

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
        $datArr = [];
        $datArr[] = ['butterflies', "img/butterflies.png"];
        $datArr[] = ['moths', 'img/moths.png'];
        $datArr[] = ['bumblebees', 'img/bumblebees.png'];
        $datArr[] = ['solitarybees', 'img/solitarybees.png'];
        $datArr[] = ['honeybees', 'img/honeybees.png'];
        $datArr[] = ['hoverflies', 'img/hoverflies.png'];
        $datArr[] = ['flies', 'img/flies.png'];
        $datArr[] = ['beetles', 'img/beetles.png'];
        $datArr[] = ['bugs', 'img/bugs.png'];
        $datArr[] = ['wasps', 'img/wasps.png'];

        foreach($datArr as $item)
        {
            $spGroup = \App\Models\Speciesgroup::where('name', $item[0])->first(); 
            $spGroup->imageLocation = $item[1];
            $spGroup->save();
        }
        
    }
}
