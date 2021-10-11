<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class buildMui extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'buildMui';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make multiple versions of app.js';

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
        $theLang = ['nl', 'en','fr','es','pt','it','de','dk','no','se','fi','ee','lv','lt','pl','cz','sk','hu','au','ch','si','hr','ba','rs','me','al','gr','bg','ro'];
        foreach($theLang as $lang)
        {
          //  $jsSourceLoc = '\\App\\public\\js\\';
            $jsSourceLoc = "C:\\code\\laravel\\showcase\\Showcase\\public\\js\\";

            if (file_exists($jsSourceLoc . $lang . '_app.js'))
            {
                unlink($jsSourceLoc . $lang . '_app.js');
            }
            $theFile = fopen($jsSourceLoc . $lang . '_app.js', "w");

            $sourceFile = fopen($jsSourceLoc . 'app.js', "r");
            if ($sourceFile) 
            {
                while (($line = fgets($sourceFile)) !== false) 
                {
                    $pattern = "{@{(.*?)}@}";
                    $res = [];
                    if (preg_match_all($pattern, $line, $res))
                    {
                        foreach($res[1] as $gottcha)
                        {
                            $newString = str_replace(['{@{', '}@}'], "", $gottcha);
                            $translation = \App\Models\Language::where('key', $newString)->first();
                            if ($translation != null)
                            {
                                $newItem = $translation->$lang;
                                if ($newItem == "")
                                {
                                    $newItem = $translation->en;
                                }
                                $line = str_replace('{@{' . $gottcha . '}@}', $newItem , $line);
                            }
                        }
                    }
                    fwrite($theFile, $line);
                }
                fclose($sourceFile);
            } 
            else 
            {
                dd("could not open source file");
            }
        }
    }
}
