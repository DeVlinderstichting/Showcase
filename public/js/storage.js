const DB_NAME = 'ShowcaseDatabase';
const DB_VERSION = 4; // Use a int/long (long) for this value (don't use a float)
const DB_STORE_NAME_SETTINGS = 'showcaseSettings';
const DB_STORE_NAME_VISITS = 'showcaseVisits';
var db;
var userSettings;
var userLanguage;
var visit;
var visits;
var visitsLoadedAtDate;

function removeDatabase()
{
  //  var req = indexedDB.deleteDatabase(DB_NAME);
   // req.onerror = function (evnt) 
    //{
     //   console.log("error removing");
      //  console.error("openDb:", evnt.target.errorCode);
    //};
   // console.log('database deleted');

}

function setupDatabase()
{
    var req = indexedDB.open(DB_NAME, DB_VERSION);
    req.onerror = function (evnt) 
    {
        console.log("db set up error");
        console.error("openDb:", evnt.target.errorCode);
    };

    req.onupgradeneeded = function (evnt) 
    {
        console.log("starting with creating new database");
        db = req.result;
        var settingsStore = db.createObjectStore(DB_STORE_NAME_SETTINGS, { keyPath: 'name'});
        var visitsStore = db.createObjectStore(DB_STORE_NAME_VISITS, { keyPath: 'startdate'});
        var tempDat = [];
        tempDat['userSettings'] = {"accessToken": ""};
        tempDat['transects'] = [];
        var emtpySettings = {'name': 'settings', 'data': tempDat};
        settingsStore.add(emtpySettings);
        userSettings = tempDat;
    };
}

function requestUserPackage(username = "", password = "", sendBackHome = false)
{
    if (username == "")
    {
        return "authentication failed";
    }

    var accessToken = "";
    if (password == "")
    {
        var settings = getUserSettings(); 
        accessToken = settings.userSettings['accesToken']; //this will fail if the user has no settings stored. However, this does not matter as the user has no accesstoken stored and provided an empty password, so the ajax is no longer required. 
    }

    var data = $.ajax({
        type: 'POST',
        url: '/requestUserPackage',
        async: false,
        data: 
        {
            'username': username,
            'password': password,
            'accesstoken': accessToken
        },
        success: function(data) 
        {
            storeUserPackage(data, sendBackHome);
        }
    });
    return data.responseText;

}

function storeUserPackage(data, sendBackHome = false)
{
    storeSettingsData('settings', data);
    userSettings = getUserSettings(sendBackHome);
}

function getUserSettings(sendBackHome = false)
{
    if (typeof userSettings === 'undefined')
    {
        loadUserSettings(sendBackHome);
    }
    else if (userSettings.userSettings['accessToken'].length < 30)
    {
        loadUserSettings(sendBackHome);
    }
    return userSettings;
}

function storeSettingsInDatabase()
{
    var req = indexedDB.open(DB_NAME, DB_VERSION);
    
    req.onerror = function (evnt) 
    {
        console.log("Error opening database");
    };

    req.onsuccess = function (evnt) 
    {
        db = req.result;
        tx = db.transaction(DB_STORE_NAME_SETTINGS, "readwrite");
        store = tx.objectStore(DB_STORE_NAME_SETTINGS);

        dat = {'name': 'settings', 'data': JSON.stringify(userSettings)};
        putRequest = store.put(dat);
    };
}

function loadUserSettings(sendBackHome = false) 
{
    var req = indexedDB.open(DB_NAME, DB_VERSION);
    
    req.onerror = function (evnt) 
    {
        console.log("user settings");
        console.error("openDb:", evnt.target.errorCode);
    };

    req.onsuccess = function (evnt) 
    {
        db = req.result;
        tx = db.transaction(DB_STORE_NAME_SETTINGS, "readwrite");
        store = tx.objectStore(DB_STORE_NAME_SETTINGS);
        settingsRequest = store.get('settings');
        settingsRequest.onsuccess = function(evnt)
        {
            if((settingsRequest.result.data.length) > 0 && (settingsRequest.result.data !='authentication failed'))
            {
                userSettings = JSON.parse(settingsRequest.result.data);
            }
            else
            {
                return 'authentication failed';
            }
            
            if (sendBackHome == true)
            {
                var len = userSettings.userSettings['accessToken'].length;
                if (len > 25)
                {
                    showHomeScreen();
                }
                else 
                {
                    showLoginScreen();
                }
            }
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

    var theVisit ={};
    theVisit['countingmethod_id'] = '';
    theVisit['location'] = '';
    theVisit['startdate'] = new Date().toISOString();
    theVisit['enddate'] = '';
    theVisit['sendtoserverdate'] = '';
    theVisit['status'] = '1'; //1=incomplete, 2=completed, 3=sealed (once shipped to server it can only be changed online)
    theVisit['user_id'] = settings.userSettings['user_id'];
    theVisit['recorders'] = '1';
    theVisit['notes'] = '';
    theVisit['wind'] = '';
    theVisit['temperature'] = '';
    theVisit['cloud'] = '';
    theVisit['landtype'] = '';
    theVisit['management'] = '';
    theVisit['transect_id'] = '';
    theVisit['flower_id'] = '';
    theVisit['observations'] = [];
    theVisit['method'] = settings.userSettings['speciesGroupsUsers'];

    return theVisit;
}
function buildEmptyObservation(visit)
{
    var theObservation={};
    theObservation['species_id'] = -1;
    theObservation['number'] = -1;
    theObservation['transect_section_id'] = -1;
    theObservation['location'] = '';
    theObservation['observationtime'] = -1;
    return theObservation;
}
function addObservationToVisit(speciesId, amount, location, stackNumbers = "add", transectSectionId =-1)
{
    index = -1;
    speciesId = parseInt(speciesId);
    amount = parseInt(amount);
    if ((stackNumbers == "add") || (stackNumbers == "put"))
    {
        for (var i = 0 ; i < visit.observations.length; i++)
        {
            if (visit.observations[i].species_id == speciesId)
            {
                if (visit.observations[i].transect_section_id == transectSectionId)
                {
                    index = i;
                }
            }
        }
    }
    if (index >= 0)
    {
        if (stackNumbers == "add")
        {
            visit.observations[index].number = visit.observations[index].number + amount;
        }
        else if (stackNumbers == "put")
        {
            visit.observations[index].number = amount;
        }
        if (visit.observations[index].number < 1)
        {
            visit.observations.splice(index, 1);  // Remove observation
        }
    }
    else
    {
        var obs = buildEmptyObservation();
        obs.species_id = speciesId;
        obs.number = amount;
        obs.location = location;
        obs.observationtime  = new Date().toISOString();
        obs.transect_section_id = transectSectionId;
        visit.observations.push(obs);
    }
}

function storeVisit(visit)
{
    visit.enddate = new Date().toISOString();
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
        var cursorRequest = store.openCursor(visit['startdate']);

        cursorRequest.onsuccess = function(e) 
        {
            dat = {'startdate': visit['startdate'], 'data': visit};
            var cursor = e.target.result; 
            if (cursor)
            { // key already exist
                cursor.update(dat);
            }
            else 
            { // key not exist
                tx = db.transaction(DB_STORE_NAME_VISITS, "readwrite");
                store = tx.objectStore(DB_STORE_NAME_VISITS);
                putRequest = store.add(dat);
            }
        };
    };
}

function loadVisits()
{
    return new Promise (function(resolve)
    {
        var req = indexedDB.open(DB_NAME, DB_VERSION);
        
        req.onerror = function (evnt) 
        {
            console.error("loadVisits.openDb:", evnt.target.errorCode);
        };

        req.onsuccess = function (evnt) 
        {
            db = req.result;
            tx = db.transaction(DB_STORE_NAME_VISITS, "readwrite");
            store = tx.objectStore(DB_STORE_NAME_VISITS);
            visitsRequest = store.getAll();
            visitsRequest.onsuccess = function(evnt)
            {
                return resolve(evnt.target.result);
            }
            visitsRequest.onerror = function (evnt) 
            {
                console.error("Load visits error:", evnt.target.errorCode);
            };
        };
    });
}

/*function objectToString (object) //because to the southpole with JSON 
{
    var res = "";
    for (var i = 0; i < Object.keys(object).length; i++)
    {
        var theKey = Object.keys(object)[i];
        var theValue = object[theKey];
        var theSValue = "";
        if (typeof theValue == "object")
        {
            theSValue = objectToString(theValue);
        }
        else 
        {
            theSValue = JSON.stringify(theValue);
        }
        if (res != "")
        {
            res += ","
        }
        res += theKey + ":" + theSValue; 
    }
    return res;
}*/

function synchWithServer()
{
    var settings = getUserSettings();

    loadVisits().then(function(result) 
    {
        visits = result;
       
     //   console.log(JSON.stringify(visits));

       /* 
        var res = "";
        for (var visit = 0 ; visit < visits.length; visit++)
        {
            for (var i = 0; i < Object.keys(visits[visit].data).length; i++)
            {
                var theKey = Object.keys(visits[visit].data)[i];
                var theValue = visits[visit].data[theKey];
                console.log(theKey + " :: " + theValue);
            }
        }
        */
       // var line = objectToString(visits);

       // console.log("igloL " + line);


        var thePackage = {'usersettings':'', 'visitdata': ''};
        thePackage['usersettings'] = settings;
        thePackage['visitdata'] = visits;





    /*    theData = visits[0];
        console.log(theData.data);


        theData.data.method = "";
     //   theData.data.observations = "";
        theData.data.startdate = "";
        theData.data.enddate = "";
        theData.data.user_id = "15";

        console.log(visits.serialize());

        console.log("strinbgyfy: " + JSON.stringify(theData.data, ["cloud", "observations", "species_id"]));

    //    console.log(JSON.stringify(visits[0]));//.observations));

      //  console.log(thePackage); 
      */
        theJsonPackage = JSON.stringify(thePackage);
        $.ajax({
            type: 'POST',
            url: '/requestUserPackage',
            data: 
            {
                'username': settings.userSettings['email'],
                'accesstoken': settings.userSettings['accessToken'],
                'datapackage': theJsonPackage
            },
            success: function(data) 
            {
                storeUserPackage(data, sendBackHome);
            }
        });
    });
}


/*
function updateVisit(visit)
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
*/ 

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


