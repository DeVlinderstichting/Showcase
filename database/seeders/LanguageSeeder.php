<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // General stuff
        \App\Models\Language::create(['key' => 'closeButton', 'en'=>'Close']);
        \App\Models\Language::create(['key' => 'saveButton', 'en'=>'Save']);
        \App\Models\Language::create(['key' => 'editButton', 'en'=>'Edit']);
        \App\Models\Language::create(['key' => 'deleteButton', 'en'=>'Delete']);
        \App\Models\Language::create(['key' => 'cancelButton', 'en'=>'Cancel']);
        \App\Models\Language::create(['key' => 'startButton', 'en'=>'Start']);
        \App\Models\Language::create(['key' => 'infoButton', 'en'=>'MORE INFO']);
        \App\Models\Language::create(['key' => 'searchSpeciesLabel', 'en'=>'SEARCH SPECIES']);
        \App\Models\Language::create(['key' => 'SelectSpeciesPlaceholder', 'en'=>'Select a species...']);
        \App\Models\Language::create(['key' => 'stopwatchLabel', 'en'=>'STOPWATCH']);
        \App\Models\Language::create(['key' => 'restartStopwatchLabel', 'en'=>'Restart']);
        \App\Models\Language::create(['key' => 'NoTrackModalTitle', 'en'=>'No location!']);
        \App\Models\Language::create(['key' => 'NoTrackModalContents', 'en'=>'Please start the count first to track your location...']);
        \App\Models\Language::create(['key' => 'RestartTimerModalTitle', 'en'=>'Restart timer']);
        \App\Models\Language::create(['key' => 'RestartTimerModalContents', 'en'=>'Are you sure you want to restart the timer? The location track and the observations will be lost...']);
        \App\Models\Language::create(['key' => 'countedGroupsLabel', 'en'=>'Counted groups']);
        \App\Models\Language::create(['key' => 'weatherLabel', 'en'=>'Weather']);
        \App\Models\Language::create(['key' => 'notesLabel', 'en'=>'Notes']);
        \App\Models\Language::create(['key' => 'temperatureLabel', 'en'=>'Temperature']);
        \App\Models\Language::create(['key' => 'windLabel', 'en'=>'Wind']);
        \App\Models\Language::create(['key' => 'windSelectorPlaceholder', 'en'=>'Select wind conditions...']);
        \App\Models\Language::create(['key' => 'cloudsLabel', 'en'=>'Clouds']);
        \App\Models\Language::create(['key' => 'cloudSelectorPlaceholder', 'en'=>'Select cloud conditions...']);

        // Nav Bar
        \App\Models\Language::create(['key' => 'navStatistics', 'en'=>'STATISTICS']);
        \App\Models\Language::create(['key' => 'navSettings', 'en'=>'SETTINGS']);
        \App\Models\Language::create(['key' => 'navMessages', 'en'=>'MESSAGES']);

        // Home Screen
        \App\Models\Language::create(['key' => 'homeSpecialTitle', 'en'=>'I SAW SOMETHING SPECIAL']);
        \App\Models\Language::create(['key' => 'homeSpecialDescr', 'en'=>'Opportunistic observation']);
        \App\Models\Language::create(['key' => 'home15mTitle', 'en'=>'15 MINUTES COUNT']);
        \App\Models\Language::create(['key' => 'home15mDescr', 'en'=>'Opportunistic observation']);
        \App\Models\Language::create(['key' => 'homeTransectTitle', 'en'=>'WALK TRANSECT']);
        \App\Models\Language::create(['key' => 'homeTransectDescr', 'en'=>'Walk a predifined transect and record everything you see']);
        \App\Models\Language::create(['key' => 'homeFitTitle', 'en'=>'FLOWERPATCH COUNT']);
        \App\Models\Language::create(['key' => 'homeFitDescr', 'en'=>'Observe a single flower, record everything you see interacting with that flower']);

        // Special Observation screen
        \App\Models\Language::create(['key' => 'specialTitle', 'en'=>'I SAW SOMETHING SPECIAL']);
        \App\Models\Language::create(['key' => 'specialDescr', 'en'=>'Opportunistic observation. <br>Enter your data!']);
        \App\Models\Language::create(['key' => 'specialNumberLabel', 'en'=>'NUMBER OBSERVED']);
        \App\Models\Language::create(['key' => 'specialInfoModalTitle', 'en'=>'More information']);
        \App\Models\Language::create(['key' => 'specialInfoModalContents', 'en'=>'Here is more information about opportunistic observations']);
        \App\Models\Language::create(['key' => 'specialInfoModalSpeciesTitle', 'en'=>'Species information']);
        \App\Models\Language::create(['key' => 'specialInfoModalSpeciesContents', 'en'=>'For extra info on this species see click the link underneath (opens outside of this application):']);

        // 15m screen
        \App\Models\Language::create(['key' => '15mTitle', 'en'=>'15 MINUTES COUNT']);
        \App\Models\Language::create(['key' => '15mDescr', 'en'=>'Count all species you see during 15 minutes. <br>Enter your data!']);
        \App\Models\Language::create(['key' => '15mNumberLabel', 'en'=>'NUMBER OBSERVED']);
        \App\Models\Language::create(['key' => '15mInfoModalTitle', 'en'=>'More information']);
        \App\Models\Language::create(['key' => '15mInfoModalContents', 'en'=>'Here is more information about 15 minute observations']);
        \App\Models\Language::create(['key' => '15mPostInfoModalTitle', 'en'=>'More information']);
        \App\Models\Language::create(['key' => '15mPostInfoModalContents', 'en'=>'Here is more information about 15 minute observations']);
        \App\Models\Language::create(['key' => '15mDeleteModalSpeciesTitle', 'en'=>'Edit observations']);
        \App\Models\Language::create(['key' => '15mPostTitle', 'en'=>'15 MINUTES COUNT']);
        \App\Models\Language::create(['key' => '15mPostDescr', 'en'=>'Please answer some additional questions. <br>Enter your data!']);
        
        // Fit screen
        \App\Models\Language::create(['key' => 'fitTitle', 'en'=>'FLOWERPATCH COUNT']);
        \App\Models\Language::create(['key' => 'fitDescr', 'en'=>'Observe a single flower, record everything you see interacting with that flower']);
        \App\Models\Language::create(['key' => 'fitPreTitle', 'en'=>'FLOWERPATCH COUNT']);
        \App\Models\Language::create(['key' => 'fitPreDescr', 'en'=>'Observe a single flower, record everything you see interacting with that flower, first select a flower']);
        \App\Models\Language::create(['key' => 'fitPreInfoModalTitle', 'en'=>'More information']);
        \App\Models\Language::create(['key' => 'fitPreInfoModalContents', 'en'=>'Here is more information about the preselection of the flowerpatch count']);
        \App\Models\Language::create(['key' => 'fitInfoModalTitle', 'en'=>'More information']);
        \App\Models\Language::create(['key' => 'fitInfoModalContents', 'en'=>'Here is more information about flowerpatch count']);
        \App\Models\Language::create(['key' => 'fitPostInfoModalTitle', 'en'=>'More information']);
        \App\Models\Language::create(['key' => 'fitPostInfoModalContents', 'en'=>'Here is more information about flowerpatch count']);
        \App\Models\Language::create(['key' => 'fitPostTitle', 'en'=>'FLOWERPATCH COUNT']);
        \App\Models\Language::create(['key' => 'fitPostDescr', 'en'=>'Please answer some additional questions. <br>Enter your data!']);
        
        // Transect screen
        \App\Models\Language::create(['key' => 'transectTitle', 'en'=>'WALK TRANSECT']);
        \App\Models\Language::create(['key' => 'transectDescr', 'en'=>'Walk a predifined transect and record everything you see']);
        \App\Models\Language::create(['key' => 'transectSectionSelector', 'en'=>'Section']);
        \App\Models\Language::create(['key' => 'transectPreTitle', 'en'=>'WALK TRANSECT']);
        \App\Models\Language::create(['key' => 'transectPreDescr', 'en'=>'Select a transect']);
        \App\Models\Language::create(['key' => 'transectPreSelectTransectLabel', 'en'=>'Select a transect']);
        \App\Models\Language::create(['key' => 'transectPreInfoModalTitle', 'en'=>'More information']);
        \App\Models\Language::create(['key' => 'transectPreInfoModalContents', 'en'=>'Here is more information about the preselection of the transect observation']);
        \App\Models\Language::create(['key' => 'transectInfoModalTitle', 'en'=>'More information']);
        \App\Models\Language::create(['key' => 'transectInfoModalContents', 'en'=>'Here is more information about transect observations']);
        \App\Models\Language::create(['key' => 'transectPostInfoModalTitle', 'en'=>'More information']);
        \App\Models\Language::create(['key' => 'transectPostInfoModalContents', 'en'=>'Here is more information about transect observations']);
        \App\Models\Language::create(['key' => 'transectPostTitle', 'en'=>'transect COUNT']);
        \App\Models\Language::create(['key' => 'transectPostDescr', 'en'=>'Please answer some additional questions. <br>Enter your data!']);
        
        // Data screen
        \App\Models\Language::create(['key' => 'dataTitle', 'en'=>'DATA OVERVIEW']);
        \App\Models\Language::create(['key' => 'dataDescr', 'en'=>'A overview of your visits and observations']);
        \App\Models\Language::create(['key' => 'dataOverviewTableHeader', 'en'=>'Data overview']);
        \App\Models\Language::create(['key' => 'dataDataEntries', 'en'=>'Data entries']);
        \App\Models\Language::create(['key' => 'dataInsectsSeen', 'en'=>'Insects seen']);
        \App\Models\Language::create(['key' => 'dataObservations', 'en'=>'Observations']);
        \App\Models\Language::create(['key' => 'dataSpeciesSeen', 'en'=>'Species seen']);
        \App\Models\Language::create(['key' => 'dataUserActivity', 'en'=>'User activity']);
        \App\Models\Language::create(['key' => 'dataTableDate', 'en'=>'User activity']);
        \App\Models\Language::create(['key' => 'dataTableSpecies', 'en'=>'User activity']);
        \App\Models\Language::create(['key' => 'dataTableCount', 'en'=>'User activity']);
        \App\Models\Language::create(['key' => 'dataTableDetails', 'en'=>'User activity']);

        // Settings screen
        \App\Models\Language::create(['key' => 'settingsTitle', 'en'=>'Settings']);
        \App\Models\Language::create(['key' => 'settingsGeneralTitle', 'en'=>'Settings']);
        \App\Models\Language::create(['key' => 'settingsUser', 'en'=>'User']);
        \App\Models\Language::create(['key' => 'settingsUseScientificNames', 'en'=>'Use scientific names']);
        \App\Models\Language::create(['key' => 'settingsShowPreviouslySeen', 'en'=>'Show previously seen']);
        \App\Models\Language::create(['key' => 'settingsShowCommonSpecies', 'en'=>'Show common species']);
        \App\Models\Language::create(['key' => 'settingsLogOut', 'en'=>'LOG OUT']);
        \App\Models\Language::create(['key' => 'settingsWhatDoYouWantToCount', 'en'=>'WHAT DO YOU WANT TO COUNT']);
        \App\Models\Language::create(['key' => 'settingsNoCounts', 'en'=>'No counts']);
        \App\Models\Language::create(['key' => 'settingsCountGroup', 'en'=>'Count number within group (not at species level)']);
        \App\Models\Language::create(['key' => 'settingsCountSpecies', 'en'=>'Count species within group']);

        // Messages screen
        \App\Models\Language::create(['key' => 'messagesTitle', 'en'=>'Messages']);
        \App\Models\Language::create(['key' => 'messagesUnread', 'en'=>'Unread']);


        foreach(\App\Models\ManagementType::all() as $mt)
        {
            \App\Models\Language::create(['key' => $mt->name, 'en'=>$mt->description]);
        }
        foreach(\App\Models\LanduseType::all() as $lt)
        {
            \App\Models\Language::create(['key' => $lt->name, 'en'=>$lt->description]);
        }

    }
}
