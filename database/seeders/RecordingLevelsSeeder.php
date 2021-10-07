<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RecordingLevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\RecordingLevel::create(['name' => 'species']);
        \App\Models\RecordingLevel::create(['name' => 'group']);
        \App\Models\RecordingLevel::create(['name' => 'none']);
    }
}
