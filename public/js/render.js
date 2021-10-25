var renderNav = function(clear=false)
{
    var nav = document.getElementById("nav");
    if(!clear)
    {
        // Build the DOM
        nav.innerHTML =`
        <a class="navbar-brand" id="nav_homeLink" href="#">Showcase</a>
        <a class="nav-link active" id="nav_dataLink" aria-current="page" href="#"><i class="fas fa-chart-pie"></i></a>
        <a class="nav-link active" id="nav_settingsLink" aria-current="page" href="#"><i class="fas fa-cog"></i></a>
        <a class="nav-link active" id="nav_messagesLink" aria-current="page" href="#"><i class="far fa-envelope"></i></a>
        <a class="nav-link active" id="nav_logoutLink" aria-current="page" href="#"><i class="fas fa-sign-out-alt"></i></a>
        `
        nav.style.display = "flex";
        // Attach the events 
        document.getElementById("nav_homeLink").onclick = function () {showHomeScreen(); };
        document.getElementById("nav_dataLink").onclick = function () {showDataScreen(); };
        document.getElementById("nav_settingsLink").onclick = function () {showSettingsScreen(); };
        document.getElementById("nav_messagesLink").onclick = function () {showMessagesScreen('observationSettings/messages.txt'); };
        document.getElementById("nav_logoutLink").onclick = function () {showLoginScreen(); };
        
    
    } 
    else
    {
        nav.innerHTML = '';
        nav.style.display = "none"; 
    }
}

var renderModal = function(title, body, postid='')
{
    html = `
        <!-- Modal -->
            <div class="modal fade" id="modal_id${postid}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-md-down modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">${title}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal_body")>
                    ${body}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>`
    return html
}

const showLoginScreen = () => 
{
    // STILL KEEPING THIS AS COMMENTS TO KEEP THE installButton !!!

    // var nav = document.getElementById("nav");
    // nav.innerHTML = `
    // <div class="container-fluid">
    //     <a class="navbar-brand" href="#">Showcase</a>
    //     <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#toggle" aria-controls="toggle" aria-expanded="false" aria-label="Toggle navigation">
    //         <span class="navbar-toggler-icon"></span>
    //     </button>

    //     <div class="collapse navbar-collapse" id="toggle">
    //         <ul class="navbar-nav ms-auto mb-2 mb-md-0">
    //         <li class="nav-item">
    //             <a class="nav-link active" id="installButton" aria-current="page" href="#">Add to home screen</a>
    //         </li>
    //         </ul>
    //     </div>
    // </div>`;

    renderNav(clear=true);

    var mb = document.getElementById('mainBody');
    // Build the DOM
    mb.innerHTML = `
        <!-- start section -->
        <section class="cover-background" style="background-image:url('img/background_1920x1080_v2.png');">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12 text-center">
                        <h1>PLEASE, SIGN IN</h1>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 col-xl-5 col-lg-10 col-md-10">
                            <label class=""><h5>Email address*</h5></label>
                            <input class="small-input" type="text" id="login_emailField" name="login_emailField" placeholder="">
                            <label class=""><h5>Password*</h5></label>
                            <input class="small-input" type="password" id="login_passField" name="login_passField" placeholder="">
                        
                            <button class="btn" id="login_loginButton">Login</button>
                            <h6><a href="#">Lost your password?</a></h6>
                    </div>
                </div>
            </div>
        </section>
        <!-- end section -->`;

    // Attach the events
    document.getElementById("login_loginButton").onclick = function () {attemptLogin(); };
}

const showHomeScreen = () => 
{
    renderNav();

    // Build the DOM
    var mb = document.getElementById('mainBody');
    theHtml = `
        <div>
            <button id="home_specialButton">Something special</button>
        </div>
        <div>
            <button id="home_15Button">15 min</button>
        </div>`;

    var settings = getUserSettings();
    if (!($.isEmptyObject(settings.transects)))
    {
        theHtml += `
            <div>
                <button id="home_transectButton">Transect</button>
            </div>`;
    }
    theHtml += `
        <div>
            <button id="home_fitButton">Fit</button>
        </div>`;
    mb.innerHTML = theHtml;

    // Attach the events; initialize the count and show the specific observation screen
    document.getElementById("home_specialButton").onclick = function () { initAnyCount(1); showSpecialObservationScreen(); };
    document.getElementById("home_15Button").onclick = function () { initAnyCount(2); show15mObservationScreen(); };
    if (!($.isEmptyObject(settings.transects)))
    {
        document.getElementById("home_transectButton").onclick = function () { initAnyCount(3); showTransectPreObservationScreen(); };
    }
    document.getElementById("home_fitButton").onclick = function () { initAnyCount(4); showFitPreObservationScreen(); };
}

const showSpecialObservationScreen = () =>
{
    // Get the settings and species
    var settings = getUserSettings();
    var species = settings.species;
    var translations = settings.translations;
    var speciesGroups = settings.speciesGroups;
    var speciesGroupsUsers = Object.values(settings.userSettings.speciesGroupsUsers).map(obj => {return obj.speciesgroup_id});
    var countIds =  Object.values(speciesGroups).filter(    
        obj => {return obj.userCanCount === true}).filter(  //Filter by only countable species (e.g. not plants)
        obj => {return speciesGroupsUsers.includes(obj.id)}).map(  //Filter by species in user settings
             function (el) { return el.id; });              //Return ID

    // Build the DOM
    renderNav(clear=true);

    var mb = document.getElementById('mainBody');
    mb.innerHTML = `
    <h2 id="special_title">Title</h2>
    <h3 id="special_subtitle">Subtitle</h3>
    <div>
        <button id="special_buttonInfo" data-bs-toggle="modal" data-bs-target="#modal_id">Info</button>
    </div>
    <div>
        <label for="special_selectSpecies">Species</label>
        <select class="chosen-select" name="special_selectSpecies" id="special_selectSpecies">
        </select>
    </div>
    <div>
        <label for="special_inputAmount">Amount</label>
        <button id="special_minAmount" onclick="$('#special_inputAmount').get(0).value--; $('#special_inputAmount').change();">-</button>
        <input id="special_inputAmount" name="special_inputAmount" value=0>
        <button id="special_plusAmount" onclick="$('#special_inputAmount').get(0).value++; $('#special_inputAmount').change();">+</button>
    </div>
    <div>
        <button id="special_buttonSave">Save</button>
        <button id="special_buttonCancel">Cancel</button>
    </div>
    `;

    // Attach the modal
    mb.innerHTML += renderModal(translations['123key'],translations['456key']);
    
    // Populate the list of species (if in usercancount) and attach the chosen selector
    $.each(species, function(key, value) {
        if (countIds.includes(value['speciesgroupId']) && value['taxon'] != '')
        {
            $('#special_selectSpecies').append(`<option value="${key}">${value['localName']}</option>`);
        }
    });
    $('.chosen-select').select2();

    // Attach the events
    document.getElementById("special_buttonSave").onclick = function () { storeSingleObservation(); };
    document.getElementById("special_buttonCancel").onclick = function () { showHomeScreen(); };

    // Make sure we get proper input on change of the number input
    $('#special_inputAmount').change( function () 
    {
        elem = $(this).get(0);
        if (!isNaN(elem.value))
        {
            elem.value = parseInt(elem.value);
        }
        if (elem.value < 0)
        {
            elem.value = 0;
        }
        elem.value = elem.value.replace(/\D/g,'');
    });
}

const show15mObservationScreen = () =>
{
    // Get the settings and species
    var settings = getUserSettings();
    var species = settings.species;
    var translations = settings.translations;
    var speciesGroups = settings.speciesGroups;
    var speciesGroupsUsers = Object.values(settings.userSettings.speciesGroupsUsers).map(obj => {return obj.speciesgroup_id});
    var countIds =  Object.values(speciesGroups).filter(    
        obj => {return obj.userCanCount === true}).filter(  //Filter by only countable species (e.g. not plants)
        obj => {return speciesGroupsUsers.includes(obj.id)}).map(  //Filter by species in user settings
             function (el) { return el.id; });              //Return ID

    // Build the DOM
    renderNav(clear=true);

    var mb = document.getElementById('mainBody');
    mb.innerHTML = `
    <h2 id="15m_title">Title</h2>
    <h3 id="15m_subtitle">Subtitle</h3>
    <div>
        <button id="15m_buttonInfo" data-bs-toggle="modal" data-bs-target="#modal_id">Info</button>
    </div>
    <h3 id="15m_stopwatchText">Start counting</h3>
    <div>
        <i class="fas fa-stopwatch"></i> <span id="stopwatch">15:00</span> <i class="fas fa-play" id="startTimer"></i> <i class="fas fa-pause" id="pauseTimer"></i> <i class="fas fa-undo" id="resetTimer"></i>
    </div>
    <h3 id="15m_speciesText">Species</h3>
    <div>
        <select class="chosen-select" name="15m_selectSpecies" id="15m_selectSpecies" data-placeholder="Select a species..." tabindex="1">
            <option value=""></option>
        </select>
    </div>
    <ul id="15m_listSpecies">

    </ul>
    <div>
        <button id="15m_buttonSave">Save</button>
        <button id="15m_buttonCancel">Cancel</button>
    </div>
    `;
    
    // Attach the modals
    // Info
    mb.innerHTML += renderModal(translations['123key'],translations['456key']);
    // No tracking message
    mb.innerHTML += renderModal('Note','Please start the count first to track your location...', 'no_loc');
    // Restart timer question
    mb.innerHTML += renderModal('Note',
    `
        Are you sure you want to restart the timer? The location track and the observations will be lost...
        <br>
        <center><button class="btn btn-danger" id="restartTimerButton">Restart</button></center>
    `
    , 'restart_timer');

    // Populate the list of species and attach the chosen selector
    $.each(species, function(key, value) 
    {
        if (countIds.includes(value['speciesgroupId']) && value['taxon'] != '')
        {
            $('#15m_selectSpecies').append(`<option value="${key}">${value['localName']}</option>`);
        }
    });
    $('.chosen-select').select2();

    // Attach the events
    document.getElementById("15m_buttonSave").onclick = function () {  stopTimer(); show15mPostObservationScreen(); }; //stopTimer, just in case it was still going
    document.getElementById("15m_buttonCancel").onclick = function () { stopTimer(); showHomeScreen(); }; //stopTimer, just in case it was still going
    document.getElementById("startTimer").onclick = function () { startTimer(); };
    document.getElementById("pauseTimer").onclick = function () { stopTimer(); };
    document.getElementById("resetTimer").onclick = function () { $(`#modal_idrestart_timer`).modal('show'); };
    document.getElementById("restartTimerButton").onclick = function () { resetTimer(); $(`#modal_idrestart_timer`).modal('hide');};
    $("#15m_selectSpecies").change( function () { addSpeciesToList($(this)); } );

    function addSpeciesToList (element)
    {
        var settings = getUserSettings();
        var species = settings.species;
        var speciesId = element[0].value;
        var speciesInfo = species[speciesId];
        $('#15m_listSpecies').append(`
            <li>${speciesInfo['localName']}
                <button id="15m_plusAmount_${speciesInfo['id']}">+</button>
                <button id="15m_editAmount_${speciesInfo['id']}">edit</button>
            </li>
        `)
        $(`#15m_selectSpecies option[value='${speciesInfo['id']}']`).remove();

        
        $(`#15m_editAmount_${speciesInfo['id']}`).click( function () {
            $(`#modal_id_${speciesInfo['id']}`).remove()

            speciesObservations = visit['observations'].filter(obj => {return obj.species_id === String(speciesInfo['id'])});

            modalContent = '<ul>';
            speciesObservations.forEach(element => {
                location1 = element.location.split(',')[1].replace(' ','');
                location2 = element.location.split(',')[2].replace(' ','');
                modalContent += `<li>${element.observationtime} - ${location1} ${location2} <button class="delete_obs" data_time="${element.observationtime}" data_speciesid="${element.species_id}">delete</button></li>`;
            } );
            modalContent += '</ul>';

            $("#mainBody").append(renderModal(`Edit observations ${speciesInfo['localName']}`,modalContent, `_${speciesInfo['id']}`));

            $('.delete_obs').click( function () {
                timeToDelete = $(this).get(0).attributes.data_time.value;
                speciesToDelete = $(this).get(0).attributes.data_speciesid.value;
                canDelete = true;
                visit['observations'] = visit['observations'].filter(obj => {
                    if (canDelete)
                    {
                        if (obj.observationtime == timeToDelete && obj.species_id == speciesToDelete)
                        {
                            canDelete = false;
                            return false
                        }
                        else
                        {
                            return true
                        }
                    }
                    return true
                });
                $(this).parent().remove();
            })

            $(`#modal_id_${speciesInfo['id']}`).modal('show');
        });
        
        
        $(`#15m_plusAmount_${speciesInfo['id']}`).click( function () {
            if (trackedLocations.length == 0)
            {
                $(`#modal_idno_loc`).modal('show');
            }
            else 
            {
                obs15m = buildEmptyObservation();
                obs15m['species_id'] = $(this).get(0).id.replace("15m_plusAmount_", "");
                obs15m['number'] = 1;
                obs15m['location'] = trackedLocations[trackedLocations.length - 1];
                obs15m['observationtime'] = Date().toString();
                visit['observations'].push(obs15m);
            }
        });

    }
}

const show15mPostObservationScreen = () =>
{
    // Get the settings and species
    var settings = getUserSettings();
    var species = settings.species;
    var translations = settings.translations;
    var speciesGroups = settings.speciesGroups;
    var speciesGroupsUsers = Object.values(settings.userSettings.speciesGroupsUsers);
    // Get the observer species and groups to make a preselection
    var observedSpeciesIds = [...new Set(visit['observations'].map( function (el) { return el.species_id; }))];
    var observedGroupIds = [... new Set(Object.values(species).filter(obj => {return observedSpeciesIds.includes(String(obj.id))}).map( function (el) { return el.speciesgroupId; }))];

    // Build the DOM
    renderNav(clear=true);
    
    var mb = document.getElementById('mainBody');
    mb.innerHTML = `
    <h2 id="15mpost_title">Title</h2>
    <h3 id="15mpost_subtitle">Subtitle</h3>
    <div>
        <button id="15mpost_buttonInfo" data-bs-toggle="modal" data-bs-target="#modal_id">Info</button>
    </div>
    <h3 id="15mpost_countedGroupsText">Counted groups</h3>
    <div id="15mpost_countedGroupsContainer"></div>
    <h3 id="15mpost_weatherText">Weather</h3>
    <div id="15mpost_weatherContainer"></div>
    <h3 id="15mpost_notesText">Notes</h3>
    <textarea id="15mpost_textareaNotes" name="15mpost_textareaNotes" rows="4" cols="50"></textarea>
    <div>
        <button id="15mpost_buttonSave">Save</button>
        <button id="15mpost_buttonCancel">Cancel</button>
    </div>
    `
    // Attach the modals
    // Info
    mb.innerHTML += renderModal(translations['123key'],translations['456key']);

    // Attach the contents of the species group container
    speciesGroupsHtml = '<ul>';
    Object.values(speciesGroups).filter(obj => {return obj.userCanCount === true}).forEach(element => {

        if (speciesGroupsUsers.map(obj => {return obj.speciesgroup_id}).includes(element.id))
        {
            if (observedGroupIds.includes(element.id))
            {
                speciesGroupsHtml += `  <li>
                    <input type="checkbox" id="15mpost_checkSpeciesGroup_${element.id}" name="15mpost_checkSpeciesGroup_${element.id}" checked disabled>
                    <label for="15mpost_checkSpeciesGroup_${element.id}">${element.name}</label>
                </li>`
            }
            else
            {
                speciesGroupsHtml += `  <li>
                    <input type="checkbox" id="15mpost_checkSpeciesGroup_${element.id}" name="15mpost_checkSpeciesGroup_${element.id}">
                    <label for="15mpost_checkSpeciesGroup_${element.id}">${element.name}</label>
                </li>`
            }
        }
    });
    speciesGroupsHtml += '</ul>';
    $('#15mpost_countedGroupsContainer').html(speciesGroupsHtml);

    // Attach the contents of the weather container
    weatherHtml = 
    `
    <h4 id="15mpost_temperatureText">Temperature</h4>
    <button id="15mpost_minTemperature" onclick="$('#15mpost_inputTemperature').get(0).value--; $('#15mpost_inputTemperature').change();">-</button>
    <input id="15mpost_inputTemperature" name="15mpost_inputTemperature" value=0>
    <button id="15mpost_plusTemperature" onclick="$('#15mpost_inputTemperature').get(0).value++; $('#15mpost_inputTemperature').change();">+</button>
    <h4 id="15mpost_windText">Wind</h4>
    <select name="15mpost_selectWind" id="15mpost_selectWind" data-placeholder="Select a wind conditions..." tabindex="1">
        <option value=1>1</option>
        <option value=2>2</option>
        <option value=3>3</option>
        <option value=4>4</option>
        <option value=5>5</option>
        <option value=6>6</option>
        <option value=7>7</option>
        <option value=8>8</option>
    </select>
    <h4 id="15mpost_cloudsText">Clouds</h4>
    <select name="15mpost_selectClouds" id="15mpost_selectClouds" data-placeholder="Select a wind conditions..." tabindex="1">
        <option value=1>1/8</option>
        <option value=2>2/8</option>
        <option value=3>3/8</option>
        <option value=4>4/8</option>
        <option value=5>5/8</option>
        <option value=6>6/8</option>
        <option value=7>7/8</option>
        <option value=8>8/8</option>
    </select>
    `;

    $('#15mpost_weatherContainer').html(weatherHtml);

    // Make sure we get proper input on change of the number input
    $(`#15mpost_inputTemperature`).change( function () 
    {
        elem = $(this).get(0);
        if (!isNaN(elem.value))
        {
            elem.value = parseInt(elem.value);
        }
        if (elem.value.match(/^-?[0-9]+/g))
        {
            elem.value = elem.value.match(/^-?[0-9]+/g);
        }
        else
        {
            elem.value = '';
        }
    });

    // Attach the events
    document.getElementById("15mpost_buttonSave").onclick = function () 
    {  
        var wind = document.getElementById('15mpost_selectWind').value;
        var cloud = document.getElementById('15mpost_selectClouds').value;
        var temp = document.getElementById('15mpost_inputTemperature').value;
        var notes = document.getElementById('15mpost_textareaNotes').value;

        var settings = getUserSettings();
        var speciesGroups = settings.speciesGroups;
        var speciesGroupsUsers = settings.userSettings.speciesGroupsUsers;
        var method = [];

        Object.values(speciesGroups).filter(obj => {return obj.userCanCount === true}).forEach(element => 
        {
            if (Object.values(speciesGroupsUsers).map(obj => {return obj.speciesgroup_id}).includes(element.id))
            {
                var id = "15mpost_checkSpeciesGroup_"+element.id;
                var isChecked = document.getElementById(id).checked;
                if (isChecked)
                {
                    var recordingLevel = "all";
                    for (var i = 0; i < speciesGroupsUsers.length; i++)
                    {
                        if (speciesGroupsUsers[i].speciesgroup_id == id)
                        {
                            recordingLevel = speciesGroupsUsers[i].recordinglevel_name;
                        }
                    }
                    
                    var methodLine = {'speciesGroupId': id, 'recordingLevel': recordingLevel};
                    method.push(methodLine);
                }
            }
        });
        visit.method = method;
        visit.notes = notes;
        visit.wind = wind;
        visit.temperature = temp;
        visit.cloud = cloud;

        storeTimedCount();
    }; 
    document.getElementById("15mpost_buttonCancel").onclick = function () { show15mObservationScreen() };
}

const showFitPreObservationScreen = () =>
{
    // Get the settings and species
    var settings = getUserSettings();
    var species = settings.species;
    var translations = settings.translations;
    var speciesGroups = settings.speciesGroups;
    var countIds =  Object.values(speciesGroups).filter(obj => {return obj.userCanCount === true}).map( function (el) { return el.id; });

    // Build the DOM
    renderNav(clear=true);

    var mb = document.getElementById('mainBody');
    mb.innerHTML = `
    <h2 id="prefit_title">Title</h2>
    <h3 id="prefit_subtitle">Subtitle</h3>
    <div>
        <button id="prefit_buttonInfo" data-bs-toggle="modal" data-bs-target="#modal_id">Info</button>
    </div>
    <div>
        <label for="prefit_selectSpecies">Species</label>
        <select class="chosen-select" name="prefit_selectSpecies" id="prefit_selectSpecies">
        </select>
    </div>
    <div>
        <button id="prefit_buttonSave">Save</button>
        <button id="prefit_buttonCancel">Cancel</button>
    </div>
    `;

    // Attach the modal
    mb.innerHTML += renderModal(translations['123key'],translations['456key']);
    
    // Populate the list of species (if in usercancount) and attach the chosen selector
    $.each(species, function(key, value) {
        if (value['speciesgroupId'] == 4 && value['taxon'] != '') // Note that the ID might change in the future
        {
            $('#prefit_selectSpecies').append(`<option value="${key}">${value['localName']}</option>`);
        }
    });
    $('.chosen-select').select2();

    // Attach the events
    document.getElementById("prefit_buttonSave").onclick = function () { showFitObservationScreen(); };
    document.getElementById("prefit_buttonCancel").onclick = function () { showHomeScreen(); };
}

const showFitObservationScreen = () =>
{
    var settings = getUserSettings();
    var species = settings.species;
    var translations = settings.translations;
    var speciesGroups = settings.speciesGroups;
    var speciesGroupsUsers = Object.values(settings.userSettings.speciesGroupsUsers).map(obj => {return obj.speciesgroup_id});
    var countIds =  Object.values(speciesGroups).filter(    
        obj => {return obj.userCanCount === true}).filter(  //Filter by only countable species (e.g. not plants)
        obj => {return speciesGroupsUsers.includes(obj.id)}).map(  //Filter by species in user settings
             function (el) { return el.id; });              //Return ID
    obsfit = [];
    
    // Build the DOM
    renderNav(clear=true);

    var mb = document.getElementById('mainBody');
    mb.innerHTML = `
    <h2 id="15m_title">Title</h2>
    <h3 id="15m_subtitle">Subtitle</h3>
    <div>
        <button id="fit_buttonInfo" data-bs-toggle="modal" data-bs-target="#modal_id">Info</button>
    </div>
    <h3 id="fit_stopwatchText">Start counting</h3>
    <div>
        <i class="fas fa-stopwatch"></i> <span id="stopwatch">15:00</span> <i class="fas fa-play" id="startTimer"></i> <i class="fas fa-pause" id="pauseTimer"></i> <i class="fas fa-undo" id="resetTimer"></i>
    </div>
    <h3 id="fit_speciesText">Species</h3>
    <div>
        <select class="chosen-select" name="fit_selectSpecies" id="fit_selectSpecies" data-placeholder="Select a species..." tabindex="1">
            <option value=""></option>
        </select>
    </div>
    <ul id="fit_listSpecies">

    </ul>
    <div>
        <button id="fit_buttonSave">Save</button>
        <button id="fit_buttonCancel">Cancel</button>
    </div>
    `;
    
    // Attach the modals
    mb.innerHTML += renderModal(translations['123key'],translations['456key']);
    // No tracking message
    mb.innerHTML += renderModal('Note','Please start the count first to track your location...', 'no_loc');
    // Restart timer question
    mb.innerHTML += renderModal('Note',
    `
        Are you sure you want to restart the timer? The location track and the observations will be lost...
        <br>
        <center><button class="btn btn-danger" id="restartTimerButton">Restart</button></center>
    `
    , 'restart_timer');
    // Populate the list of species and attach the chosen selector
    $.each(species, function(key, value) {
        if (countIds.includes(value['speciesgroupId']) && value['taxon'] != '')
        {
            $('#fit_selectSpecies').append(`<option value="${key}">${value['localName']}</option>`);
        }
    });

    $('.chosen-select').select2();

    document.getElementById("fit_buttonSave").onclick = function () {  stopTimer(); showFitPostObservationScreen(); }; //stopTimer, just in case it was still going
    document.getElementById("fit_buttonCancel").onclick = function () { stopTimer(); showHomeScreen(); }; //stopTimer, just in case it was still going
    document.getElementById("startTimer").onclick = function () { startTimer(); };
    document.getElementById("pauseTimer").onclick = function () { stopTimer(); };
    document.getElementById("resetTimer").onclick = function () { $(`#modal_idrestart_timer`).modal('show'); };
    document.getElementById("restartTimerButton").onclick = function () { resetTimer(); $(`#modal_idrestart_timer`).modal('hide');};

    $("#fit_selectSpecies").change( function () { addSpeciesToList($(this)); } );

    function addSpeciesToList (element)
    {
        var settings = getUserSettings();
        var species = settings.species;
        var speciesId = element[0].value;
        var speciesInfo = species[speciesId];
        $('#fit_listSpecies').append(`
            <li>${speciesInfo['localName']}
                <button id="fit_minAmount_${speciesInfo['id']}" onclick="$('#fit_inputAmount_${speciesInfo['id']}').get(0).value--; $('#fit_inputAmount_${speciesInfo['id']}').change();">-</button>
                <input id="fit_inputAmount_${speciesInfo['id']}" name="fit_inputAmount_${speciesInfo['id']}" value=1>
                <button id="fit_plusAmount_${speciesInfo['id']}" onclick="$('#fit_inputAmount_${speciesInfo['id']}').get(0).value++; $('#fit_inputAmount_${speciesInfo['id']}').change();">+</button>
            </li>
        `)
        $(`#fit_selectSpecies option[value='${speciesInfo['id']}']`).remove();
        addObservationToVisit(speciesId, 1, trackedLocations[trackedLocations.length - 1]);

        // Make sure we get proper input on change of the number input
        $(`#fit_inputAmount_${speciesInfo['id']}`).change( function () 
        {
            elem = $(this).get(0);
            if (trackedLocations.length == 0)
            {
                $(`#modal_idno_loc`).modal('show');
                elem.value = 0;
                return
            }
            if (!isNaN(elem.value))
            {
                elem.value = parseInt(elem.value);
            }
            if (elem.value < 0)
            {
                elem.value = 0;
            }
            elem.value = elem.value.replace(/\D/g,'');
            addObservationToVisit(speciesInfo['id'], elem.value, trackedLocations[trackedLocations.length - 1], 'put');
        });
    }
}

const showFitPostObservationScreen = () =>
{
    // Get the settings and species
    var settings = getUserSettings();
    var species = settings.species;
    var translations = settings.translations;
    var speciesGroups = settings.speciesGroups;
    var speciesGroupsUsers = Object.values(settings.userSettings.speciesGroupsUsers);
    var observedSpeciesIds = [...new Set(visit['observations'].map( function (el) { return el.species_id; }))];
    var observedGroupIds = [... new Set(Object.values(species).filter(obj => {return observedSpeciesIds.includes(String(obj.id))}).map( function (el) { return el.speciesgroupId; }))];

    // Build the DOM
    renderNav(clear=true);
    
    var mb = document.getElementById('mainBody');
    mb.innerHTML = `
    <h2 id="fit_title">Title</h2>
    <h3 id="fit_subtitle">Subtitle</h3>
    <div>
        <button id="fit_buttonInfo" data-bs-toggle="modal" data-bs-target="#modal_id">Info</button>
    </div>
    <h3 id="fit_countedGroupsText">Counted groups</h3>
    <div id="fit_countedGroupsContainer"></div>
    <h3 id="fit_weatherText">Weather</h3>
    <div id="fit_weatherContainer"></div>
    <h3 id="fit_notesText">Notes</h3>
    <textarea id="fit_textareaNotes" name="fit_textareaNotes" rows="4" cols="50"></textarea>
    <div>
        <button id="fit_buttonSave">Save</button>
        <button id="fit_buttonCancel">Cancel</button>
    </div>
    `
    // Attach the modals
    // Info
    mb.innerHTML += renderModal(translations['123key'],translations['456key']);

    // Attach the contents of the species group container
    speciesGroupsHtml = '<ul>';
    Object.values(speciesGroups).filter(obj => {return obj.userCanCount === true}).forEach(element => {
        if (speciesGroupsUsers.map(obj => {return obj.speciesgroup_id}).includes(element.id))
        {
            if (observedGroupIds.includes(element.id))
            {
                speciesGroupsHtml += `  <li>
                    <input type="checkbox" id="fit_checkSpeciesGroup_${element.id}" name="fit_checkSpeciesGroup_${element.id}" checked disabled>
                    <label for="fit_checkSpeciesGroup_${element.id}">${element.name}</label>
                </li>`
            }
            else
            {
                speciesGroupsHtml += `  <li>
                    <input type="checkbox" id="fit_checkSpeciesGroup_${element.id}" name="fit_checkSpeciesGroup_${element.id}">
                    <label for="fit_checkSpeciesGroup_${element.id}">${element.name}</label>
                </li>`
            }
        }
    });
    speciesGroupsHtml += '</ul>';
    $('#fit_countedGroupsContainer').html(speciesGroupsHtml);

    // Attach the contents of the weather container
    weatherHtml = 
    `
    <h4 id="fit_temperatureText">Temperature</h4>
    <button id="fit_minTemperature" onclick="$('#fit_inputTemperature').get(0).value--; $('#fit_inputTemperature').change();">-</button>
    <input id="fit_inputTemperature" name="fit_inputTemperature" value=0>
    <button id="fit_plusTemperature" onclick="$('#fit_inputTemperature').get(0).value++; $('#fit_inputTemperature').change();">+</button>
    <h4 id="fit_windText">Wind</h4>
    <select name="fit_selectWind" id="fit_selectWind" data-placeholder="Select a wind conditions..." tabindex="1">
        <option value=1>1</option>
        <option value=2>2</option>
        <option value=3>3</option>
        <option value=4>4</option>
        <option value=5>5</option>
        <option value=6>6</option>
        <option value=7>7</option>
        <option value=8>8</option>
    </select>
    <h4 id="fit_cloudsText">Clouds</h4>
    <select name="fit_selectClouds" id="fit_selectClouds" data-placeholder="Select a wind conditions..." tabindex="1">
        <option value=1>1/8</option>
        <option value=2>2/8</option>
        <option value=3>3/8</option>
        <option value=4>4/8</option>
        <option value=5>5/8</option>
        <option value=6>6/8</option>
        <option value=7>7/8</option>
        <option value=8>8/8</option>
    </select>
    `;

    $('#fit_weatherContainer').html(weatherHtml);

    // Make sure we get proper input on change of the number input
    $(`#fit_inputTemperature`).change( function () 
    {
        elem = $(this).get(0);
        if (!isNaN(elem.value))
        {
            elem.value = parseInt(elem.value);
        }
        if (elem.value.match(/^-?[0-9]+/g))
        {
            elem.value = elem.value.match(/^-?[0-9]+/g);
        }
        else
        {
            elem.value = '';
        }
    });

    // Attach the events
    document.getElementById("fit_buttonSave").onclick = function () 
    {  
        var wind = document.getElementById('fit_selectWind').value;
        var cloud = document.getElementById('fit_selectClouds').value;
        var temp = document.getElementById('fit_inputTemperature').value;
        var notes = document.getElementById('fit_textareaNotes').value;

        var settings = getUserSettings();
        var speciesGroups = settings.speciesGroups;
        var speciesGroupsUsers = settings.userSettings.speciesGroupsUsers;
        var method = [];

        Object.values(speciesGroups).filter(obj => {return obj.userCanCount === true}).forEach(element => 
        {
            if (Object.values(speciesGroupsUsers).map(obj => {return obj.speciesgroup_id}).includes(element.id))
            {
                var id = "fit_checkSpeciesGroup_"+element.id;
                var isChecked = document.getElementById(id).checked;
                if (isChecked)
                {
                    var recordingLevel = "all";
                    for (var i = 0; i < speciesGroupsUsers.length; i++)
                    {
                        if (speciesGroupsUsers[i].speciesgroup_id == id)
                        {
                            recordingLevel = speciesGroupsUsers[i].recordinglevel_name;
                        }
                    }
                    
                    var methodLine = {'speciesGroupId': id, 'recordingLevel': recordingLevel};
                    method.push(methodLine);
                }
            }
            
        });
        visit.method = method;
        visit.notes = notes;
        visit.wind = wind;
        visit.temperature = temp;
        visit.cloud = cloud;

        storeFitCount();
    }; 
    document.getElementById("fit_buttonCancel").onclick = function () {  showFitObservationScreen() }; 
}

const showTransectPreObservationScreen = () => 
{
    // Get the settings and species
    var settings = getUserSettings();
    var transects = settings.transects;
    var translations = settings.translations;

    // Build the DOM
    renderNav(clear=true);

    var mb = document.getElementById('mainBody');
    mb.innerHTML = `
    <h2 id="pretransect_title">Title</h2>
    <h3 id="pretransect_subtitle">Subtitle</h3>
    <div>
        <button id="pretransect_buttonInfo" data-bs-toggle="modal" data-bs-target="#modal_id">Info</button>
    </div>
    <div>
        <label for="pretransect_selectTransects">Transects</label>
        <select class="chosen-select" name="pretransect_selectTransects" id="pretransect_selectTransects">
        </select>
    </div>
    <div>
        <button id="pretransect_buttonSave">Save</button>
        <button id="pretransect_buttonCancel">Cancel</button>
    </div>
    `;

    // Attach the modal
    mb.innerHTML += renderModal(translations['123key'], translations['456key']);
    
    for (var i = 0 ; i < transects.length; i++)
    {
        $('#pretransect_selectTransects').append(`<option value="` + transects[i].id + `">` + transects[i].name + `</option>`); 
    }
    $.each(transects, function(key, value) 
    {
    });
    $('.chosen-select').select2();

    // Attach the events
    document.getElementById("pretransect_buttonSave").onclick = function () 
    {
        visit.transect_id = document.getElementById('pretransect_selectTransects').value;
        showTransectObservationScreen(); 
    };
    document.getElementById("pretransect_buttonCancel").onclick = function () { showHomeScreen(); };
}

const showTransectObservationScreen = () =>
{
    // Get the settings and species
    var settings = getUserSettings();
    var species = settings.species;
    var translations = settings.translations;
    var speciesGroups = settings.speciesGroups;
    var speciesGroupsUsers = Object.values(settings.userSettings.speciesGroupsUsers).map(obj => {return obj.speciesgroup_id});
    var countIds =  Object.values(speciesGroups).filter(    
        obj => {return obj.userCanCount === true}).filter(  //Filter by only countable species (e.g. not plants)
        obj => {return speciesGroupsUsers.includes(obj.id)}).map(  //Filter by species in user settings
             function (el) { return el.id; });              //Return ID
    var transectSections = settings.transects.filter(obj => {return obj.id == visit.transect_id})[0]['sections'];
    var transectSections = Object.values(transectSections).sort(dynamicSort('sequence'));

    renderNav();
    // Build the DOM
    var mb = document.getElementById('mainBody');
    mb.innerHTML = `
    <h2 id="transect_title">Title</h2>
    <h3 id="transect_subtitle">Subtitle</h3>
    <div>
        <button id="transect_buttonInfo" data-bs-toggle="modal" data-bs-target="#modal_id">Info</button>
    </div>
    <h3 id="transect_speciesText">Section</h3>
    <button id="transect_prevTransButton" disabled> < </button>
    <span id="transect_transLabel" data_id="${transectSections[0].id}">${transectSections[0].name}</span>
    <button id="transect_nextTransButton"> > </button>
    <h3 id="transect_speciesText">Species</h3>
    <div>
        <select class="chosen-select" name="transect_selectSpecies" id="transect_selectSpecies" data-placeholder="Select a species..." tabindex="1">
            <option value=""></option>
        </select>
    </div>
    <ul id="transect_listSpecies">

    </ul>
    <div>
        <button id="transect_buttonSave">Save</button>
        <button id="transect_buttonCancel">Cancel</button>
    </div>
    `;
    
    // Attach the modal
    mb.innerHTML += renderModal(translations['123key'],translations['456key']);

    // Build the transect selector logic

    function transectChange() {
        transectObs = Object.values(visit.observations).filter(obj => {return obj.transect_section_id == $('#transect_transLabel').attr('data_id')});
        $('[id*=transect_inputAmount]').each(function () {
            $(this).val('');
        });
        transectObs.forEach(element => {
            $('#transect_inputAmount_'+element.species_id).val(element.number);
        });
    }

    var sectionIndex = 0;
    $('#transect_prevTransButton').click( function () {
        if (sectionIndex == 0)
        {
            return
        }
        else
        {
            sectionIndex--;
            $('#transect_transLabel').html(transectSections[sectionIndex].name);
            $('#transect_transLabel').attr('data_id', transectSections[sectionIndex].id);
            $('#transect_nextTransButton').removeAttr("disabled");
            transectChange();
            if (sectionIndex == 0)
            {
                $(this).prop('disabled', true);
            }

        }
    });
    $('#transect_nextTransButton').click( function () {
        if (sectionIndex == transectSections.length-1)
        {
            return
        }
        else
        {
            sectionIndex++;
            $('#transect_transLabel').html(transectSections[sectionIndex].name);
            $('#transect_transLabel').attr('data_id', transectSections[sectionIndex].id);
            $('#transect_prevTransButton').removeAttr("disabled");
            transectChange();
            if (sectionIndex == transectSections.length-1)
            {
                $(this).prop('disabled', true);
            }
        }
    });

    // Populate the list of species and attach the chosen selector
    $.each(species, function(key, value) 
    {
        if (countIds.includes(value['speciesgroupId']) && value['taxon'] != '')
        {
            $('#transect_selectSpecies').append(`<option value="${key}">${value['localName']}</option>`);
        }
    });
    $('.chosen-select').select2();

    // Attach the events
    document.getElementById("transect_buttonSave").onclick = function () { showTransectPostObservationScreen(); }; 
    document.getElementById("transect_buttonCancel").onclick = function () { showHomeScreen(); };

    $("#transect_selectSpecies").change( function () { addSpeciesToList($(this)); } );

    function addSpeciesToList (element)
    {
        var settings = getUserSettings();
        var species = settings.species;
        var speciesId = element[0].value;
        var speciesInfo = species[speciesId];
        $('#transect_listSpecies').append(`
            <li>${speciesInfo['localName']}
                <button id="transect_minAmount_${speciesInfo['id']}" onclick="$('#transect_inputAmount_${speciesInfo['id']}').get(0).value--; $('#transect_inputAmount_${speciesInfo['id']}').change();">-</button>
                <input id="transect_inputAmount_${speciesInfo['id']}" name="transect_inputAmount_${speciesInfo['id']}" value=0>
                <button id="transect_plusAmount_${speciesInfo['id']}" onclick="$('#transect_inputAmount_${speciesInfo['id']}').get(0).value++; $('#transect_inputAmount_${speciesInfo['id']}').change();">+</button>
            </li>
        `)
        $(`#transect_selectSpecies option[value='${speciesInfo['id']}']`).remove();

        // Make sure we get proper input on change of the number input
        $(`#transect_inputAmount_${speciesInfo['id']}`).change( function () 
        {
            elem = $(this).get(0);
            if (!isNaN(elem.value))
            {
                elem.value = parseInt(elem.value);
            }
            if (elem.value < 0)
            {
                elem.value = 0;
            }
            elem.value = elem.value.replace(/\D/g,'');
            transectSectionId = $('#transect_transLabel').get(0).attributes.data_id.value;
            addObservationToVisit(speciesInfo['id'], elem.value, trackedLocations[trackedLocations.length - 1], 'put', transectSectionId = transectSectionId);
        });
    }
}

const showTransectPostObservationScreen = () =>
{
    // Get the settings and species
    var settings = getUserSettings();
    var species = settings.species;
    var translations = settings.translations;
    var speciesGroups = settings.speciesGroups;
    var speciesGroupsUsers = Object.values(settings.userSettings.speciesGroupsUsers);
    var observedSpeciesIds = [...new Set(visit['observations'].map( function (el) { return el.species_id; }))];
    var observedGroupIds = [... new Set(Object.values(species).filter(obj => {return observedSpeciesIds.includes(obj.id)}).map( function (el) { return el.speciesgroupId; }))];

    // Build the DOM
    renderNav(clear=true);
    
    var mb = document.getElementById('mainBody');
    mb.innerHTML = `
    <h2 id="transect_title">Title</h2>
    <h3 id="transect_subtitle">Subtitle</h3>
    <div>
        <button id="transect_buttonInfo" data-bs-toggle="modal" data-bs-target="#modal_id">Info</button>
    </div>
    <h3 id="transect_countedGroupsText">Counted groups</h3>
    <div id="transect_countedGroupsContainer"></div>
    <h3 id="transect_weatherText">Weather</h3>
    <div id="transect_weatherContainer"></div>
    <h3 id="transect_notesText">Notes</h3>
    <textarea id="transect_textareaNotes" name="transect_textareaNotes" rows="4" cols="50"></textarea>
    <div>
        <button id="transect_buttonSave">Save</button>
        <button id="transect_buttonCancel">Cancel</button>
    </div>
    `
    // Attach the modals
    // Info
    mb.innerHTML += renderModal(translations['123key'],translations['456key']);

    // Attach the contents of the species group container
    speciesGroupsHtml = '<ul>';
    Object.values(speciesGroups).filter(obj => {return obj.userCanCount === true}).forEach(element => {
        if (speciesGroupsUsers.map(obj => {return obj.speciesgroup_id}).includes(element.id))
        {
            if (observedGroupIds.includes(element.id))
            {
                speciesGroupsHtml += `  <li>
                    <input type="checkbox" id="transect_checkSpeciesGroup_${element.id}" name="transect_checkSpeciesGroup_${element.id}" checked disabled>
                    <label for="transect_checkSpeciesGroup_${element.id}">${element.name}</label>
                </li>`
            }
            else
            {
                speciesGroupsHtml += `  <li>
                    <input type="checkbox" id="transect_checkSpeciesGroup_${element.id}" name="transect_checkSpeciesGroup_${element.id}">
                    <label for="transect_checkSpeciesGroup_${element.id}">${element.name}</label>
                </li>`
            }
        }
    });
    speciesGroupsHtml += '</ul>';
    $('#transect_countedGroupsContainer').html(speciesGroupsHtml);

    // Attach the contents of the weather container
    weatherHtml = 
    `
    <h4 id="transect_temperatureText">Temperature</h4>
    <button id="transect_minTemperature" onclick="$('#transect_inputTemperature').get(0).value--; $('#transect_inputTemperature').change();">-</button>
    <input id="transect_inputTemperature" name="transect_inputTemperature" value=0>
    <button id="transect_plusTemperature" onclick="$('#transect_inputTemperature').get(0).value++; $('#transect_inputTemperature').change();">+</button>
    <h4 id="transect_windText">Wind</h4>
    <select name="transect_selectWind" id="transect_selectWind" data-placeholder="Select a wind conditions..." tabindex="1">
        <option value=1>1</option>
        <option value=2>2</option>
        <option value=3>3</option>
        <option value=4>4</option>
        <option value=5>5</option>
        <option value=6>6</option>
        <option value=7>7</option>
        <option value=8>8</option>
    </select>
    <h4 id="transect_cloudsText">Clouds</h4>
    <select name="transect_selectClouds" id="transect_selectClouds" data-placeholder="Select a wind conditions..." tabindex="1">
        <option value=1>1/8</option>
        <option value=2>2/8</option>
        <option value=3>3/8</option>
        <option value=4>4/8</option>
        <option value=5>5/8</option>
        <option value=6>6/8</option>
        <option value=7>7/8</option>
        <option value=8>8/8</option>
    </select>
    `;

    $('#transect_weatherContainer').html(weatherHtml);

    // Make sure we get proper input on change of the number input
    $(`#transect_inputTemperature`).change( function () 
    {
        elem = $(this).get(0);
        if (!isNaN(elem.value))
        {
            elem.value = parseInt(elem.value);
        }
        if (elem.value.match(/^-?[0-9]+/g))
        {
            elem.value = elem.value.match(/^-?[0-9]+/g);
        }
        else
        {
            elem.value = '';
        }
    });

    // Attach the events
    document.getElementById("transect_buttonSave").onclick = function () 
    {  
        var wind = document.getElementById('transect_selectWind').value;
        var cloud = document.getElementById('transect_selectClouds').value;
        var temp = document.getElementById('transect_inputTemperature').value;
        var notes = document.getElementById('transect_textareaNotes').value;

        var settings = getUserSettings();
        var speciesGroups = settings.speciesGroups;
        var speciesGroupsUsers = settings.userSettings.speciesGroupsUsers;
        var method = [];

        Object.values(speciesGroups).filter(obj => {return obj.userCanCount === true}).forEach(element => 
        {
            if (Object.values(speciesGroupsUsers).map(obj => {return obj.speciesgroup_id}).includes(element.id))
            {
                var id = "transect_checkSpeciesGroup_"+element.id;
                console.log(id);
                var isChecked = document.getElementById(id).checked;
                if (isChecked)
                {
                    var recordingLevel = "all";
                    for (var i = 0; i < speciesGroupsUsers.length; i++)
                    {
                        if (speciesGroupsUsers[i].speciesgroup_id == id)
                        {
                            recordingLevel = speciesGroupsUsers[i].recordinglevel_name;
                        }
                    }
                    
                    var methodLine = {'speciesGroupId': id, 'recordingLevel': recordingLevel};
                    method.push(methodLine);
                }
            }
        });
        visit.method = method;
        visit.notes = notes;
        visit.wind = wind;
        visit.temperature = temp;
        visit.cloud = cloud;

        storeTransectCount();
    }; 
    document.getElementById("transect_buttonCancel").onclick = function () {  showTransectObservationScreen() }; 
}

const showDataScreen = () =>
{
    
    // Get the settings and species
    var settings = getUserSettings();
    var species = settings.species;
    var translations = settings.translations;
    var speciesGroups = settings.speciesGroups;
    var speciesGroupsUsers = Object.values(settings.userSettings.speciesGroupsUsers).map(obj => {return obj.speciesgroup_id});
    var countIds =  Object.values(speciesGroups).filter(    
        obj => {return obj.userCanCount === true}).filter(  //Filter by only countable species (e.g. not plants)
        obj => {return speciesGroupsUsers.includes(obj.id)}).map(  //Filter by species in user settings
                function (el) { return el.id; });              //Return ID

    // Build the DOM
    renderNav();

    var mb = document.getElementById('mainBody');
    mb.innerHTML = `
    <h2 id="data_title">Title</h2>
    <h3 id="data_subtitle">Subtitle</h3>
    <div>
        <button id="data_buttonInfo" data-bs-toggle="modal" data-bs-target="#modal_id">Info</button>
    </div>
    <h3 id="data_stopwatchText">Data overview</h3>
    <table>
        <tr>
            <th>Data entries</th>
            <td id="data_nrDataEntries"></td>
        </tr>
        <tr>
            <th>Observations</th>
            <td id="data_nrObservations"></td>
        </tr>
        <tr>
            <th>Insects seen</th>
            <td id="data_nrInsectsSeen"></td>
        </tr>
        <tr>
            <th>Species groups seen</th>
            <td id="data_nrSpeciesGroupsSeen"></td>
        </tr>                
    </table>
    <h3 id="data_userActivityText">User activity</h3>
    <canvas id="bar-chart" width="400" height="300"></canvas>
    <h3 id="data_userObservations">Observations</h3>
    <table id="obsTable">
        <thead>
            <td>Date</td>
            <td>Species</td>
            <td>Count</td>
            <td>Details</td>
        </thead>
        <tbody>
        </tbody>
    <table>

    `
    // Attach the modal
    mb.innerHTML += renderModal(translations['123key'],translations['456key']);


    loadVisits().then(function(result) 
    {
        visits = result;
        document.getElementById('data_nrDataEntries').innerHTML = visits.length;
    });

    
    
    $(document).ready( function () {
        $('#obsTable').DataTable(
            {
                ajax: 
                {
                    url: 'observationSettings/observations.txt',
                    dataSrc: 'data'
                },
                columns: [
                    { data: 'Date' },
                    { data: 'Species' },
                    { data: 'Count' },
                    { data: 'Details' },
                ],
                "scrollX": true,
                columnDefs: [
                    {
                        targets: 3,
                        render: function (data, type, row, meta)
                        {
                            datastring = `'This will redirect to website with details on ${data}'`;
                            data = '<a href="#" onclick="alert(' + datastring + '); return false;">' + data + '</a>';
                            return data;
                        }
                    }
                ]

            }
        );
    } );

    new Chart(document.getElementById("bar-chart"), {
        type: 'bar',
        data: {
          labels: ["April", "May", "June", "July", "August"],
          datasets: [
            {
              label: "Observations",
              backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
              data: [375,530,739,784,245]
            }
          ]
        },
        options: {
          legend: { display: false },
          title: {
            display: true,
            text: 'Number of observations'
          }
        }
    });

}