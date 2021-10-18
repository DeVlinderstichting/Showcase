const DB_NAME = 'ShowcaseDatabase';
const DB_VERSION = 4; // Use a int/long (long) for this value (don't use a float)
const DB_STORE_NAME = 'showcaseSettings';
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

function requestUserPackage(username = "", password = "")
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
            storeUserPackage(data);
        }
    });
}

function storeUserPackage(data)
{
    storeData('settings', data);
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
        var store = db.createObjectStore(DB_STORE_NAME, { keyPath: 'name'});
        var emtpySettings = {'name': 'settings', 'data': ''};
        store.add(emtpySettings);
        userSettings = emtpySettings;
        var emtpyObservations = {'name': 'observations', 'data': ''};
        store.add(emtpyObservations);
    };
    req.onsuccess = function (evnt) 
    {
        db = req.result;
        tx = db.transaction(DB_STORE_NAME, "readwrite");
        store = tx.objectStore(DB_STORE_NAME);
        settingsRequest = store.get('settings');
        settingsRequest.onsuccess = function(evnt)
        {
            userSettings = JSON.parse(settingsRequest.result.data);
        }
    };
}

function storeData(key, data)
{
    var req = indexedDB.open(DB_NAME, DB_VERSION);
    
    req.onerror = function (evnt) 
    {
        console.error("openDb:", evnt.target.errorCode);
    };

    req.onsuccess = function (evnt) 
    {
        db = req.result;
        tx = db.transaction(DB_STORE_NAME, "readwrite");
        store = tx.objectStore(DB_STORE_NAME);

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




