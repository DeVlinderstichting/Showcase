const DB_NAME = 'ShowcaseDatabase';
const DB_VERSION = 4; // Use a int/long (long) for this value (don't use a float)
const DB_STORE_NAME_SETTINGS = 'showcaseSettings';
const DB_STORE_NAME_VISITS = 'showcaseVisits';
var db;
var userSettings;
var userLanguage;

function debugTestInit()
{
    var req = indexedDB.deleteDatabase(DB_NAME);
    req.onerror = function (evnt) 
    {
        console.error("openDb:", evnt.target.errorCode);
    };
}

function requestUserPackage(username = "", password = "", sendBackHome = false)
{
    if (username == "")
    {
        return "invalid username";
    }

    var accessToken = "";
    if (password == "")
    {
        var settings = getUserSettings(); 
        accessToken = settings.userSettings['accesToken']; //this will fail if the user has no settings stored. However, this does not matter as the user has no accesstoken stored and provided an empty password, so the ajax is no longer required. 
    }

    $.ajax({
        type: 'GET',
        url: '/requestUserPackage',
        data: 
        {
            'username': username,
            'password': password,
            'accesstoken': accessToken
        },
        success: function(data) 
        {
console.log(data);

            storeUserPackage(data);
            if (sendBackHome == true){
                //showHomeScreen();
            }
        }
    });
}

function storeUserPackage(data)
{
    storeSettingsData('settings', data);
    userSettings = getUserSettings();
}

function getUserSettings()
{
    if ((typeof userSettings === 'undefined') || (userSettings.userSettings['accessToken'].length < 30))
    {
        loadUserSettings();
    }
    return userSettings;
}

function loadUserSettings() 
{
    var req = indexedDB.open(DB_NAME, DB_VERSION);
    
    req.onerror = function (evnt) 
    {
        console.error("openDb:", evnt.target.errorCode);
    };

    req.onupgradeneeded = function (evnt) 
    {
        db = req.result;
        var store = db.createObjectStore(DB_STORE_NAME_SETTINGS, { keyPath: 'name'});
        var store = db.createObjectStore(DB_STORE_NAME_VISITS, { keyPath: 'startdate'});
        var emtpySettings = {'name': 'settings', 'data': ''};
        store.add(emtpySettings);
        userSettings = emtpySettings;;
    };
    req.onsuccess = function (evnt) 
    {
        db = req.result;
        tx = db.transaction(DB_STORE_NAME_SETTINGS, "readwrite");
        store = tx.objectStore(DB_STORE_NAME_SETTINGS);
        settingsRequest = store.get('settings');
        settingsRequest.onsuccess = function(evnt)
        {
            userSettings = JSON.parse(settingsRequest.result.data);
        }
    };
}

function storeSettingsData(key, data)
{
    var req = indexedDB.open(DB_NAME, DB_VERSION);
    
    req.onerror = function (evnt) 
    {
        console.error("openDb:", evnt.target.errorCode);
    };

    req.onsuccess = function (evnt) 
    {
        db = req.result;
        tx = db.transaction(DB_STORE_NAME_SETTINGS, "readwrite");
        store = tx.objectStore(DB_STORE_NAME_SETTINGS);

        dat = {'name': key, 'data': data};
        putRequest = store.put(dat);
    };
}

function getTranslation(key)
{
    var settings = getUserSettings(); 
    if (typeof userLanguage == 'undefined')
    {
        userLanguage = settings.userSettings['preferedLanguage'];
    }
    return settings.translations[key][userLanguage];
}

function buildEmptyVisit()
{
    var settings = getUserSettings(); 

    var theVisit =[];
    theVisit['countingmethod_id'] = '';
    theVisit['location'] = '';
    theVisit['startdate'] = new Date();;
    theVisit['enddate'] = '';
    theVisit['sendtoserverdate'] = '';
    theVisit['status'] = '1'; //1=incomplete, 2=completed, 3=sealed (once shipped to server it can only be changed online)
    theVisit['user_id'] = settings.userSettings['user_id'];
    theVisit['recorders'] = '1';
    theVisit['notes'] = '';
    theVisit['wind'] = '';
    theVisit['temperature'] = '';
    theVisit['cloud'] = '';
    theVisit['transect_id'] = '';
    theVisit['flower_id'] = '';
    theVisit['flower_id'] = '';
    $theVisit['observations'] = [];
    $theVisit['method'] = settings.userSettings['speciesGroupsUsers'];

    return theVisit;
}
function buildEmptyObservation(visit)
{
    var theObservation=[];
    theObservation['species_id'] = -1;
    theObservation['number'] = -1;
    theObservation['transect_section_id'] = '-1'
    theObservation['location'] = '';
    return theObservation;
}
function storeVisit(visit)
{
    var req = indexedDB.open(DB_NAME, DB_VERSION);
    req.onerror = function (evnt) 
    {
        console.error("openDb:", evnt.target.errorCode);
    };

    req.onsuccess = function (evnt) 
    {
        db = req.result;
        tx = db.transaction(DB_STORE_NAME_VISITS, "readwrite");
        store = tx.objectStore(DB_STORE_NAME_VISITS);

        dat = {'startdate': visit['startdate'], 'data': visit};
        putRequest = store.put(dat);
    };
}
function updateVisit(visit)
{

}
function deleteVisit(visit)
{
    var req = indexedDB.open(DB_NAME, DB_VERSION);
    req.onerror = function (evnt) 
    {
        console.error("openDb:", evnt.target.errorCode);
    };
    req.onsuccess = function (evnt)
    {
        db = req.result;
        tx = db.transaction(DB_STORE_NAME_VISITS, "readwrite");
        store = tx.objectStore(DB_STORE_NAME_VISITS);
        store.delete(visit['startdate']);
    }
}


