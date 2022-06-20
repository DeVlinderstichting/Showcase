var positionTracker;
var trackedLocations = [];
var locationTrack = [];

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
    if (pos.coords.accuracy < 10)
    {

        let lat = position.coords.latitude;
        let lon = position.coords.longitude;

        var addLoc = false;
        if (locationTrack.length  == 0)
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