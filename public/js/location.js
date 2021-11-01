var positionTracker;
var trackedLocations = [];
var currentLocation;

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
   
function trackingLocationUpdate(pos)
{
    var coor = pos.coords;
    var line = new Date().toISOString() + ", " + coor.latitude + ", " + coor.longitude;
    trackedLocations.push(line);
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
                enableHighAccuracy: false,
                timeout: 15000,
                maximumAge: 0
            });
        } 
    }
}
function stopTracking()
{
    navigator.geolocation.clearWatch(positionTracker); 
    positionTracker = undefined;
}