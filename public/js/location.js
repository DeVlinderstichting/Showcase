var positionTracker;
var trackedLocations = [];
var locationTrack = [];

function locationAvailable(pos)
{
    var coor = pos.coords;
    currentLocation = new Date().toISOString() + ", " + coor.latitude + ", " + coor.longitude;
}
function locationError(err)
{
    console.log('geolocation error');
}

function readLocation()
{
    if ("geolocation" in navigator) 
    {
        navigator.geolocation.getCurrentPosition(locationAvailable, locationError);
    }
    else
    {
        console.log('geolocation not available');
    }
}

function measure(lat1, lon1, lat2, lon2)
{  // generally used geo measurement function
    var R = 6378.137; // Radius of earth in KM
    var dLat = lat2 * Math.PI / 180 - lat1 * Math.PI / 180;
    var dLon = lon2 * Math.PI / 180 - lon1 * Math.PI / 180;
    var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
    Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
    Math.sin(dLon/2) * Math.sin(dLon/2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
    var d = R * c;
    return d * 1000; // meters
}

function trackingLocationUpdate(pos)
{
    var testdiv = document.getElementById('locationtest');
    if (pos.coords.accuracy < 10) //was 10
    {

        let lat = pos.coords.latitude;
        let lon = pos.coords.longitude;

        var addLoc = false;
        if (locationTrack.length == 0)
        {
            addLoc = true;
        }
        else 
        {
            var prevLoc = locationTrack[locationTrack.length-1];
            var distance = measure(prevLoc[1], prevLoc[0], lat, lon);
            if (distance > 2)
            {
                addLoc = true;
            }
        }

        if(addLoc)
        {
            var line = new Date().toISOString() + ", " + lat + ", " + lon;
            trackedLocations.push(line);
            locationTrack.push([lon, lat]);
            if (testdiv !== null)
            {
                testdiv.innerHTML += line + '<br>';
            }
        }
    }
    else 
    {
        if (locationTrack.length == 0)
        {
            document.getElementById("stopwatch").innerHTML = "Waiting for exact location (precision is now: "+Math.floor(pos.coords.accuracy)+" m, start when <10m), turn on your gps or try moving a few steps. <br>";
        }
    }
}

function trackingLocationError()
{
    console.log('geolocation tracking error');
}
function startTracking() 
{
    if (!positionTracker) 
    {
        if ("geolocation" in navigator && "watchPosition" in navigator.geolocation) 
        {
            positionTracker = navigator.geolocation.watchPosition(trackingLocationUpdate, trackingLocationError, 
            { 
                enableHighAccuracy: true,
                maximumAge: 10000
            });
        } 
    }
}
function stopTracking()
{
    navigator.geolocation.clearWatch(positionTracker); 
    positionTracker = undefined;
}