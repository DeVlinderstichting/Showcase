locationAttemptCounter = 0;

/*
countingmethodIds:
single = 1
timed = 2
transect = 3 
fit = 4
*/
function initAnyCount(countingMethod)
{
    visit = buildEmptyVisit();
    visit.countingmethod_id = countingMethod;
    trackedLocations = [];
}
function endAnyCount()
{
    synchWithServer();
}


function storeSingleObservation()
{
    readLocation();
    if (typeof currentLocation == "undefined")
    {
        locationAttemptCounter = locationAttemptCounter+1;
        if (locationAttemptCounter < 7)
        {
            setTimeout(storeSingleObservation, 500);
        }
        else 
        {
            locationAttemptCounter = 0; //reset to zero for the next observation that is processed (this is one disregarded as it has no location)
        }
    }
    else
    {
        locationAttemptCounter = 0;
        var speciesId = document.getElementById('special_selectSpecies').value;
        var amount = document.getElementById('special_inputAmount').value;

        if (parseInt(amount)>0)
        {
          //  visit = buildEmptyVisit();

            //testDate = new Date(2021, 10, 31, 12, 14, 45, 32);
            //visit.startdate = testDate;
            
            var obs = buildEmptyObservation();
            obs.observationtime = new Date().toISOString();
            obs.species_id = speciesId;
            obs.number = amount;
            obs.location = currentLocation;
            visit.observations.push(obs);
            storeVisit(visit);
        }
        endAnyCount();
        showHomeScreen();
    }
}

function storeTimedCount()
{
    visit.location = JSON.stringify(trackedLocations);
    storeVisit(visit);
    endAnyCount();
    showHomeScreen();
}

function storeFitCount()
{
    visit.location = JSON.stringify(trackedLocations);
    storeVisit(visit);
    endAnyCount();
    showHomeScreen();
}

function storeTransectCount()
{
    visit.location = JSON.stringify(trackedLocations);
    storeVisit(visit);
    endAnyCount();
    showHomeScreen();
}


// The stopwatch logic with location tracker
var stopwatchMinutes = 15;
var stopwatchCurrentTime;
var stopwatchFutureTime;
var stopWatchTimer;
var stopWatchRunning = false;
var stopWatchTimeLeft = stopwatchMinutes*60000;

function startTimer() 
{
    stopwatchCurrentTime = new Date();
    stopwatchFutureTime = new Date(stopwatchCurrentTime.getTime() + stopWatchTimeLeft);
    if (!stopWatchTimer || !stopWatchRunning)
    {
        stopWatchTimer = setInterval(timer, 100);
        stopWatchRunning = true;
        startTracking();
    }
}

function timer() 
{
    var d = new Date();
    stopWatchTimeLeft = stopwatchFutureTime - d;
    document.getElementById("stopwatch").innerHTML = msToTime(stopWatchTimeLeft);
    if (stopWatchTimeLeft < 0)
    {
        stopTimer();
        stopWatchTimeLeft = 0;
        document.getElementById("stopwatch").innerHTML = msToTime(stopWatchTimeLeft);
    }
}

function stopTimer() 
{
    clearInterval(stopWatchTimer)
    stopWatchRunning = false;
    stopTracking();
}

function resetTimer()
{
    stopWatchTimeLeft = stopwatchMinutes*60000;
    stopwatchCurrentTime = new Date();
    stopwatchFutureTime = new Date(stopwatchCurrentTime.getTime() + stopWatchTimeLeft);
    if(document.getElementById("stopwatch"))
    {
        document.getElementById("stopwatch").innerHTML = msToTime(stopWatchTimeLeft);
    }
    if (trackedLocations)
    {
        trackedLocations = [];
    }
    if (visit)
    {
        visit['observations'] = [];
    }
}

function pad(n, z) 
{
    z = z || 2;
    return ('00' + n).slice(-z);
}

function msToTime(s) 
{
    var ms = s % 1000;
    s = (s - ms) / 1000;
    var secs = s % 60;
    s = (s - secs) / 60;
    var mins = s % 60;
    var hrs = (s - mins) / 60;
    
    return  pad(mins) + ':' + pad(secs);
}

function dynamicSort(property) {
    var sortOrder = 1;
    if(property[0] === "-") {
        sortOrder = -1;
        property = property.substr(1);
    }
    return function (a,b) {
        /* next line works with strings and numbers, 
            * and you may want to customize it to your needs
            */
        var result = (a[property] < b[property]) ? -1 : (a[property] > b[property]) ? 1 : 0;
        return result * sortOrder;
    }
}

function getSpeciesName (id)
{
    settings = getUserSettings();
    var species = settings.species;
    spObject = Object.values(species).filter(obj => {return obj.id==id})[0]

    if (settings.userSettings.sci_names)
    {
        spName =  spObject.genus + ' ' + spObject.taxon;
    }
    else
    {
        spName = spObject.localName;
    }
    return spName;
}

function initializeApp()
{
    setupDatabase();
    //do stuff here 

    loadUserSettings(sendBackHome = true);

    document.addEventListener("DOMContentLoaded", showLoginScreen)
}

function logout()
{
    var settings = getUserSettings();
    loadVisits().then(function(result) 
    {
        visits = result;
        var thePackage = {'usersettings':'', 'visitdata': ''};
        thePackage['usersettings'] = settings;
        thePackage['visitdata'] = visits;
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
                var tempDat = [];
                tempDat['userSettings'] = {"accessToken": ""};
                tempDat['transects'] = [];
                var emtpySettings = {'name': 'settings', 'data': tempDat};
                storeUserPackage(emtpySettings);
                userSettings = tempDat;
                showLoginScreen();
            }
        });
    });
}


function preselectCountableSpecies (species, selectID)
{
    settings = getUserSettings();
    countLevelById = Object.values(settings.userSettings.speciesGroupsUsers).reduce((accum, currentVal) => {accum[currentVal.speciesgroup_id]= currentVal.recordinglevel_name; return accum} , {})
    
    $.each(species, function(key, value) {
        if (countLevelById[value['speciesgroupId']] == 'none' )
        {
            // Not included in list
        }
        if (countLevelById[value['speciesgroupId']] == 'group' )
        {
            if (value['taxon'] == '')
            {
                $('#' + selectID).append(`<option value="${key}">${spName = getSpeciesName(value['id'])}</option>`);
            }
            else
            {
            }
        }
        if (countLevelById[value['speciesgroupId']] == 'species' )
        {
            if (value['taxon'] != '')
            {
                $('#' + selectID).append(`<option value="${key}">${spName = getSpeciesName(value['id'])}</option>`);
            }
            else
            {
            }
        }

    });

}