var positionTracker;
var trackedLocations = [];
var currentLocation;

function locationAvailable(pos)
{
    var coor = pos.coords;
    currentLocation = coor.latitude + ", " + coor.longitude;
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
    var line = coor.latitude + ", " + coor.longitude;
    trackedLocations.push(line);
    console.log(trackedLocations);
    if (trackedLocations.length > 15)
    {
        stopTracking();
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
            geoWatch = navigator.geolocation.watchPosition(trackingLocationUpdate, trackingLocationError, 
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