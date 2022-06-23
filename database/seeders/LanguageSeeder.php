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
        \App\Models\Language::create(['key' => 'LandLabel', 'en'=>'Land characteristics']);
        \App\Models\Language::create(['key' => 'landTypeLabel', 'en'=>'Land type']);
        \App\Models\Language::create(['key' => 'landManagementLabel', 'en'=>'Land management']);
        
        
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

        \App\Models\Language::create(['key' => 'generalPageNewsTitle', 'en'=>'News']);
        \App\Models\Language::create(['key' => 'generalPageNewsHeader', 'en'=>'News']);
        \App\Models\Language::create(['key' => 'generalPageNewsSubHeader', 'en'=>'All showcase news']);
        \App\Models\Language::create(['key' => 'generalPageNewsReadMore', 'en'=>'Read more...']);
        \App\Models\Language::create(['key' => 'newsPageHeader', 'en'=>'News']);
        \App\Models\Language::create(['key' => 'newsPageReadMore', 'en'=>'Read more...']);
        \App\Models\Language::create(['key' => 'projectInfoHeader', 'en'=>'Project information']);
        \App\Models\Language::create(['key' => 'projectInfoSubHeader', 'en'=>'SHOWCASing synergies between agriculture, biodiversity and Ecosystem services to help farmers capitalising on native biodiversity.']);
        \App\Models\Language::create(['key' => 'projectInfoTitle', 'en'=>'Project information']);
        \App\Models\Language::create(['key' => 'projectInfoAboutTitle', 'en'=>'About SHOWCASE']);
        \App\Models\Language::create(['key' => 'projectInfoAboutSubTitle', 'en'=>'SHOWCASE is dedicated to the integration of biodiversity into farming practices. Biodiversity is closely interrelated with the development of the agricultural sector. Farmland biodiversity is steeply declining throughout Europe. Society at large is increasingly concerned about the loss of public goods, such as iconic wildlife and cultural landscapes.  Long-term monitoring of biodiversity across European countries is increasingly reliant on efforts by members of the public. ']);
        \App\Models\Language::create(['key' => 'projectInfoAboutParagraph1', 'en'=>'In the context of achieving the European goal of sustainable farming production, a bridge of knowledge between incentives of agricultural producers and biodiversity management practices is key. Various platforms allow people to volunteer biodiversity observations opportunistically, covering a wide range of species and habitats. ']);
        \App\Models\Language::create(['key' => 'projectInfoAboutParagraph2', 'en'=>'Yet, the unstructured and often closed nature of those data make it difficult to determine biodiversity trends, particularly when needing to appraise changes in land use in specific regions or landscape types. On this platform, citizen scientists and famers can record and share their data.']);
        \App\Models\Language::create(['key' => 'projectInfoReadMore', 'en'=>'More about Showcase?']);


        \App\Models\Language::create(['key' => 'monitoringGuideTitle', 'en'=>'Guide to monitoring']);
        \App\Models\Language::create(['key' => 'monitoringGuideHeader', 'en'=>'Guide to monitoring']);
        \App\Models\Language::create(['key' => 'monitoringGuideSubHeader', 'en'=>'Information on the supported monitoring techniques']);
        \App\Models\Language::create(['key' => 'monitoringGuideISawSomethingSpecialTitle', 'en'=>'I saw something special']);
        \App\Models\Language::create(['key' => 'monitoringGuide15mTitle', 'en'=>'15 minutes count']);
        \App\Models\Language::create(['key' => 'monitoringGuideTransectTitle', 'en'=>'Walk transect']);
        \App\Models\Language::create(['key' => 'monitoringGuideFitTitle', 'en'=>'Flowerpatch count']);
        \App\Models\Language::create(['key' => 'monitoringGuideISawSomethingSpecialText', 'en'=>'Imagine you are walking and suddenly you see something special.An insect or flower that you have never seen before, is very beautiful or perhaps even rare, but you are not monitoring it. In this case, there is the possibility to report a single observation in the Showcase app. ']);
        \App\Models\Language::create(['key' => 'monitoringGuide15mText', 'en'=>'A 15-minute count is a monitoring method that can be used at any place at any time. This method is mainly used to monitor insects. You either walk around or stay in one place and report all insects that you see in the 15-minute timeframe. You can put the time on hold if you need to spend time for identification. Your track is being recorded automatically. After 15 minutes you submit the observations. If you like to continue you can start a new count at a different location.']);
        \App\Models\Language::create(['key' => 'monitoringGuideTransectText', 'en'=>'Transect counts only apply to sites that are included in the <a href="https://butterfly-monitoring.net">European Butterfly Monitoring Scheme (EBMS)</a>. When monitoring by walking a transect you start by setting out a transect of approximately 1 kilometre and monitoring on this transect several times between April and September, taking in to account the weather conditions. During the observation you record all insects in the app. If possible, you include fewer occurring plants and flowers. Walking a transect is a way of monitoring that provides high quality data, because one specific route is monitored long-term and throughout the season. ']);
        \App\Models\Language::create(['key' => 'monitoringGuideFitText', 'en'=>'The Flowerpatch or Flower-Insect Timed (FIT) count is an easy way to observe insects and flowers in good weather. You select a flowerpatch of around 50x50 cm and note the flower type. Then you stand or sit down in one spot for 10 to 15 minutes and record all flowers and insects you observe in that timeframe.']);


        \App\Models\Language::create(['key' => 'generalPagesIdHelpTitle', 'en'=>'Species Identification']);
        \App\Models\Language::create(['key' => 'generalPagesIdHelpHeader', 'en'=>'Species Identification']);
        \App\Models\Language::create(['key' => 'generalPagesIdHelpSubHeader', 'en'=>'Species identification is fundamental when recording biodiversity data. There are many species identification guides, websites and apps available. We have listed them per country. Butterflies can be easily recorded at species level. Therefore, the focus is on this species group. For other groups of flower visitors, more specialist information is required. ']);


        //users home
        \App\Models\Language::create(['key' => 'userHomeTitle', 'en'=>'My Profile']);
        \App\Models\Language::create(['key' => 'userHomeHeader', 'en'=>'My Profile ']);
        \App\Models\Language::create(['key' => 'userHomeSettings', 'en'=>'Settings']);
        \App\Models\Language::create(['key' => 'userHomeSubTitle', 'en'=>'']);
        \App\Models\Language::create(['key' => 'userHomeStatistics', 'en'=>'Statistics']);
        \App\Models\Language::create(['key' => 'userHomeObsNum', 'en'=>'observations']);
        \App\Models\Language::create(['key' => 'userHomeSpNum', 'en'=>'Species seen']);
        \App\Models\Language::create(['key' => 'userHomeSpGroupNum', 'en'=>'Species groups seen']);
        \App\Models\Language::create(['key' => 'userHomeInsectsNum', 'en'=>'Total insects seen']);
        \App\Models\Language::create(['key' => 'userHomeMessages', 'en'=>'Messages']);
        \App\Models\Language::create(['key' => 'userHomeObservations', 'en'=>'Observations']);
        \App\Models\Language::create(['key' => 'userHomeModalCloseButton', 'en'=>'Close']);
        \App\Models\Language::create(['key' => 'userHomeSeeObsButton', 'en'=>'See my observations']);
        \App\Models\Language::create(['key' => 'userHomeMapMyObs', 'en'=>'My observations']);
        \App\Models\Language::create(['key' => 'userHomeMapAllObs', 'en'=>'All observations']);

        //user settings
        \App\Models\Language::create(['key' => 'userSettingsTitle', 'en'=>'User settings']);
        \App\Models\Language::create(['key' => 'userSettingsHeader', 'en'=>'User settings']);
        \App\Models\Language::create(['key' => 'userSettingsSubHeader', 'en'=>'']);
        \App\Models\Language::create(['key' => 'userSettingsGeneralSettings', 'en'=>'General settings']);
        \App\Models\Language::create(['key' => 'userSettingsUser', 'en'=>'User']);
        \App\Models\Language::create(['key' => 'userSettingsRegisteredAt', 'en'=>'Registered at']);
        \App\Models\Language::create(['key' => 'userSettingsSciNames', 'en'=>'Use scientific names']);
        \App\Models\Language::create(['key' => 'userSettingsPrevSeen', 'en'=>'Show previously seen']);
        \App\Models\Language::create(['key' => 'userSettingsShowCommonSp', 'en'=>'Show common species']);
        \App\Models\Language::create(['key' => 'userSettingsLogout', 'en'=>'Logout']);
        \App\Models\Language::create(['key' => 'userSettingsSpecificSettingsTitle', 'en'=>'Specific settings']);
        \App\Models\Language::create(['key' => 'userSettingsNoCounts', 'en'=>'No counts']);
        \App\Models\Language::create(['key' => 'userSettingsCountOnlyGroups', 'en'=>'Count only speciesgroups']);
        \App\Models\Language::create(['key' => 'userSettingsCountAll', 'en'=>'Count all species']);

        //visit create
        \App\Models\Language::create(['key' => 'visitCreateTitle', 'en'=>'Create visit']);
        \App\Models\Language::create(['key' => 'visitCreateHeader', 'en'=>'Create a new visit']);
        \App\Models\Language::create(['key' => 'visitEditHeader', 'en'=>'Edit a visit']);
        \App\Models\Language::create(['key' => 'visitCreateNoTransectsFound', 'en'=>'No transects found']);
        \App\Models\Language::create(['key' => 'visitCreateChangeTransect', 'en'=>'Transect change']);
        \App\Models\Language::create(['key' => 'visitCreateChangeTransectWarning', 'en'=>'You are about to change the transect. If you proceed all sections of your observations will be reset to the first section of the new transect. Press cancel if you wish to maintain the current data...']);
        \App\Models\Language::create(['key' => 'visitCreateCancel', 'en'=>'Cancel']);
        \App\Models\Language::create(['key' => 'visitCreateProceed', 'en'=>'Proceed']);
        \App\Models\Language::create(['key' => 'visitCreateSelectTransect', 'en'=>'Select transect']);
        \App\Models\Language::create(['key' => 'visitCreateDate', 'en'=>'Date']);
        \App\Models\Language::create(['key' => 'visitCreateTime', 'en'=>'Time']);
        \App\Models\Language::create(['key' => 'visitCreateStarttime', 'en'=>'Starttime']);
        \App\Models\Language::create(['key' => 'visitCreateEndtime', 'en'=>'Endtime']);
        \App\Models\Language::create(['key' => 'visitCreateChooseFlower', 'en'=>'Choose a flower']);
        \App\Models\Language::create(['key' => 'visitCreateNumFlowerheads', 'en'=>'Number of flowerheads']);
        \App\Models\Language::create(['key' => 'visitCreateNotes', 'en'=>'Notes']);
        \App\Models\Language::create(['key' => 'visitCreateCloudCover', 'en'=>'CloudCover']);
        \App\Models\Language::create(['key' => 'visitCreateWindSpeed', 'en'=>'Wind speed']);
        \App\Models\Language::create(['key' => 'visitCreateTemp', 'en'=>'Temperature']);
        \App\Models\Language::create(['key' => 'visitCreateLanduseType', 'en'=>'Select land use type']);
        \App\Models\Language::create(['key' => 'visitCreateLanduseTypeNotSelected', 'en'=>'Not selected...']);
        \App\Models\Language::create(['key' => 'visitCreateManagement', 'en'=>'Select land management']);
        \App\Models\Language::create(['key' => 'visitCreateManagementNotSelected', 'en'=>'Not selected...']);
        \App\Models\Language::create(['key' => 'visitCreateObservations', 'en'=>'Observations']);
        \App\Models\Language::create(['key' => 'visitCreateTableHeaderSpecies', 'en'=>'Species']);
        \App\Models\Language::create(['key' => 'visitCreateTableHeaderNumber', 'en'=>'Number']);
        \App\Models\Language::create(['key' => 'visitCreateTableHeaderTime', 'en'=>'Time']);
        \App\Models\Language::create(['key' => 'visitCreateTableHeaderSection', 'en'=>'Section']);
        \App\Models\Language::create(['key' => 'visitCreateNoObservations', 'en'=>'No observations']);
        \App\Models\Language::create(['key' => 'visitCreateAddSpecies', 'en'=>'Add species']);
        \App\Models\Language::create(['key' => 'visitCreateCheckSpGroups', 'en'=>'Check the speciesgroups that you counted']);
        \App\Models\Language::create(['key' => 'visitCreateSave', 'en'=>'Save']);

        //visit index
        \App\Models\Language::create(['key' => 'visitIndexTitle', 'en'=>'Visits']);
        \App\Models\Language::create(['key' => 'visitIndexSingleObsHeader', 'en'=>'Single observation']);
        \App\Models\Language::create(['key' => 'visitIndexAddNewSingleObs', 'en'=>'Add new single observation']);
        \App\Models\Language::create(['key' => 'visitIndexTableHeaderDate', 'en'=>'Date']);
        \App\Models\Language::create(['key' => 'visitIndexTableHeaderSpecies', 'en'=>'Species']);
        \App\Models\Language::create(['key' => 'visitIndexTableHeaderNumber', 'en'=>'Number']);
        \App\Models\Language::create(['key' => 'visitIndexTransectHeader', 'en'=>'Transect']);
        \App\Models\Language::create(['key' => 'visitIndexAddNewTransect', 'en'=>'Add new visit']);
        \App\Models\Language::create(['key' => 'visitIndexTableHeaderName', 'en'=>'Name']);
        \App\Models\Language::create(['key' => 'visitIndexTableHeaderDuration', 'en'=>'Duration']);
        \App\Models\Language::create(['key' => 'visitIndexFitHeader', 'en'=>'Flowerpatch observations']);
        \App\Models\Language::create(['key' => 'visitIndexAddNewFit', 'en'=>'Add new fit count']);
        \App\Models\Language::create(['key' => 'visitIndexTableHeaderFlower', 'en'=>'Flower']);
        \App\Models\Language::create(['key' => 'visitIndexTableHeaderSpNum', 'en'=>'Number of Species']);
        \App\Models\Language::create(['key' => 'visitIndexTimedCountsHeader', 'en'=>'Timed counts']);
        \App\Models\Language::create(['key' => 'visitIndexAddNewTimedCount', 'en'=>'Add new timed count']);
        \App\Models\Language::create(['key' => 'visitIndexTableHeaderStartDate', 'en'=>'Startdate']);
        \App\Models\Language::create(['key' => 'visitIndexTableHeaderEndDate', 'en'=>'Enddate']);
        \App\Models\Language::create(['key' => 'visitIndexTableHeaderObsNum', 'en'=>'Number of observations']);
        \App\Models\Language::create(['key' => 'visitIndexDataDownloadHeader', 'en'=>'Download data']);
        \App\Models\Language::create(['key' => 'visitIndexDataDownloadButton', 'en'=>'Download data']);
        \App\Models\Language::create(['key' => 'visitIndexDeleteVisit', 'en'=>'Delete visit']);
        \App\Models\Language::create(['key' => 'visitIndexDeleteVisitConfirmMessage', 'en'=>'Are you sure you want to delete this visit?']);
        \App\Models\Language::create(['key' => 'visitIndexDelete', 'en'=>'Delete']);
        \App\Models\Language::create(['key' => 'visitIndexClose', 'en'=>'Close']);


        //visit show
        \App\Models\Language::create(['key' => 'visitShowTitle', 'en'=>'Visits']);
        \App\Models\Language::create(['key' => 'visitShowHeader', 'en'=>'Visit details']);
        \App\Models\Language::create(['key' => 'visitShowEditButton', 'en'=>'Edit visit']);
        \App\Models\Language::create(['key' => 'visitShowGeneralInfoHeader', 'en'=>'General information']);
        \App\Models\Language::create(['key' => 'visitShowDate', 'en'=>'Date']);
        \App\Models\Language::create(['key' => 'visitShowNotes', 'en'=>'Notes']);
        \App\Models\Language::create(['key' => 'visitShowStartdate', 'en'=>'Startdate']);
        \App\Models\Language::create(['key' => 'visitShowEnddate', 'en'=>'Enddate']);
        \App\Models\Language::create(['key' => 'visitShowObsNum', 'en'=>'Number of observations']);
        \App\Models\Language::create(['key' => 'visitShowCloudCover', 'en'=>'Cloud coverage']);
        \App\Models\Language::create(['key' => 'visitShowTemperature', 'en'=>'Temperature']);
        \App\Models\Language::create(['key' => 'visitShowWind', 'en'=>'Wind']);
        \App\Models\Language::create(['key' => 'visitShowDuration', 'en'=>'Duration']);
        \App\Models\Language::create(['key' => 'visitShowObservedFlower', 'en'=>'Observed flower']);
        \App\Models\Language::create(['key' => 'visitShowObservationsHeader', 'en'=>'Observations']);
        \App\Models\Language::create(['key' => 'visitShowTableHeaderSpecies', 'en'=>'Species']);
        \App\Models\Language::create(['key' => 'visitShowTableHeaderNumber', 'en'=>'Number']);
        \App\Models\Language::create(['key' => 'visitShowTableHeaderSection', 'en'=>'Section']);
        \App\Models\Language::create(['key' => 'visitShowTableContentNoObservations', 'en'=>'No observations']);


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
        \App\Models\Language::create(['key' => 'preFitNumberLabel', 'en'=>'Amount of flowerheads']);
        
        
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
