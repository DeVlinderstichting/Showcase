locationAttemptCounter = 0;
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

        visit = buildEmptyVisit();

testDate = new Date(2021, 10, 31, 12, 14, 45, 32);
visit.startdate = testDate;

        var obs = buildEmptyObservation();
        obs.species_id = speciesId;
        obs.number = amount;
        obs.location = currentLocation;
        visit.observations.push(obs);
        storeVisit(visit);
        console.log("visit stored????");
        loadVisits();

        console.log(visits);
        console.log("done");
        //showHomeScreen();
    }
}