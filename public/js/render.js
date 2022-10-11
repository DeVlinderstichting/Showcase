var renderNav = function(clear=false)
{
    $("#backgroundDiv").css("background", "linear-gradient(27deg, rgba(150,229,172,1) 50%, rgba(222,238,193,1) 100%)");

    var nav = document.getElementById("nav");
    if(!clear)
    {
        settings = getUserSettings();
        var translations = settings.translations;

        // Build the DOM
        nav.innerHTML =`
        <a class="navbar-brand" id="nav_homeLink" href="#"><img src="img/logo_Showcase_335x72.png" alt="" style="height: 20px; margin-left: 10px;"></a>
        <a class="nav-link active messagsMenuBar" style="margin-left: auto" id="nav_dataLink" aria-current="page" href="#">${translations['navStatistics']} <i class="fas fa-chart-pie"></i></a>
        <a class="nav-link active messagsMenuBar" id="nav_settingsLink" aria-current="page" href="#">${translations['navSettings']} <i class="fas fa-cog"></i></a>
        <a class="nav-link active messagsMenuBar" id="nav_messagesLink" aria-current="page" href="#">${translations['navMessages']} <i class="fas fa-comment-dots"></i></a>
        `
        nav.style.display = "flex";
        // Attach the events 
        document.getElementById("nav_homeLink").onclick = function () {showHomeScreen(); };
        document.getElementById("nav_dataLink").onclick = function () {showDataScreen(); };
        document.getElementById("nav_settingsLink").onclick = function () {showSettingsScreen(); };
        document.getElementById("nav_messagesLink").onclick = function () {showMessagesScreen(); };
        
    
    } 
    else
    {
        nav.innerHTML = '';
        nav.style.display = "none"; 
    }
}

var renderModal = function(title, body, postid='')
{
    settings = getUserSettings();
    var translations = settings.translations;

    html = `
        <!-- Modal -->
            <div class="modal fade" id="modal_id${postid}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-md-down modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h3 id="modal_title${postid}">${title}</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal_body${postid}")>
                    ${body}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">${translations['closeButton']}</button>
                </div>
                </div>
            </div>
        </div>`
    return html
}

const showLoginScreen = () => 
{
    renderNav(clear=true);

    var mb = document.getElementById('mainBody');
    // Build the DOM
    mb.innerHTML = `
        <!-- start section -->
        <section class="cover-background" style="background-image:url('img/background_1920x1080_v2.png'); height:100vh; padding-top: 200px;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12 text-center">
                        <h1>PLEASE, SIGN IN</h1>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 col-xl-5 col-lg-10 col-md-10">
                        <div id="error-div" class="alert alert-danger" style="display:none">Authentication failed</div>
                        <label class=""><h5>Email address*</h5></label>
                        <input class="small-input" type="text" id="login_emailField" name="login_emailField" placeholder="">
                        <label class=""><h5>Password*</h5></label>
                        <input class="small-input" type="password" id="login_passField" name="login_passField" placeholder="">
                    
                        <button class="btn" id="login_loginButton">Login</button>
                        <button class="btn" id="login_installButton" hidden>Install</button>
                        <h6><a href="#">Lost your password?</a></h6>
                        <div class="text-muted" style="text-align: center;margin-top: 3rem; font-style: italic;">© De Vlinderstichting 2021</div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end section -->`;

    // Attach the events
    document.getElementById("login_loginButton").onclick = function () {
        var username = document.getElementById('login_emailField').value;
        var password = document.getElementById('login_passField').value;
        retstr = attemptLogin(username, password); 
        if (retstr=='authentication failed')
        {
            var errorDiv = document.getElementById('error-div');
            errorDiv.style.display = errorDiv.style.display == "none" ? "block" : "none";
        }
    };

    let deferredPrompt; // Allows to show the install prompt

    // On rendering the login screen we need to know if we need the install button
    const installButton = document.getElementById("login_installButton");

    window.addEventListener("beforeinstallprompt", e => 
    {
        console.log("beforeinstallprompt fired");
        // Prevent Chrome 76 and earlier from automatically showing a prompt
        e.preventDefault();
        // Stash the event so it can be triggered later.
        deferredPrompt = e;
        // Show the install button
        installButton.hidden = false;
        installButton.addEventListener("click", installApp);
    });

    function installApp() 
    {
        // Show the prompt
        deferredPrompt.prompt();
        installButton.disabled = true;
    
        // Wait for the user to respond to the prompt
        deferredPrompt.userChoice.then(choiceResult => 
        {
            if (choiceResult.outcome === "accepted") 
            {
                console.log("PWA setup accepted");
                installButton.hidden = true;
            } 
            else 
            {
                console.log("PWA setup rejected");
            }
            installButton.disabled = false;
            deferredPrompt = null;
        });
    }
}

const showHomeScreen = () => 
{
    settings = getUserSettings();
    var translations = settings.translations;

    renderNav();

    // Unset any running timers
    stopTimer();

    // Build the DOM
    var mb = document.getElementById('mainBody');
    theHtml = `
    <section class="cover-background">
    <div class="container">
        
        <div class="row justify-content-center">
            <div class="col-12 col-xl-5 col-lg-10 col-md-10">
                <div class="box-background text-center" style="background-image:url('img/special-bg.svg');">
                    <h2>${translations['homeSpecialTitle']}</h2>
                    <p style="height: 2rem;">${translations['homeSpecialDescr']}</p>
                    <a href="#" id="home_specialButton" class="btn">${translations['startButton']}</a>
                </div>
            </div>
            <div class="col-12 col-xl-5 col-lg-10 col-md-10">
                <div class="box-background text-center" style="background-image:url('img/15-count-bg.svg');">
                    <h2>${translations['home15mTitle']}</h2>
                    <p style="height:2rem;">${translations['home15mDescr']}</p>
                    <a href="#" id="home_15Button" class="btn">${translations['startButton']}</a>
                </div>
            </div>    
        </div>
        <div class="row justify-content-center">
    `;

    if (!($.isEmptyObject(settings.transects)))
    {
        theHtml += `
        <div class="col-12 col-xl-5 col-lg-10 col-md-10">
                        <div class="box-background text-center" style="background-image:url('img/transect-bg.svg');">
                        <h2>${translations['homeTransectTitle']}</h2>
                        <p style="height: 2rem;">${translations['homeTransectDescr']}</p>
                        <a href="#" id="home_transectButton" class="btn">${translations['startButton']}</a>
                        </div>
                    </div>`;
    }
    theHtml += `
    <div class="col-12 col-xl-5 col-lg-10 col-md-10">
        <div class="box-background text-center" style="background-image:url('img/flower-count-bg.svg');">
            <h2>${translations['homeFitTitle']}</h2>
            <p style="height: 2rem;">${translations['homeFitDescr']}</p>
            <a href="#" id="home_fitButton" class="btn">${translations['startButton']}</a>
            </div>
            </div>
        </div>
    </div>
    </section>`;

    mb.innerHTML = theHtml;

    // Attach the events; initialize the count and show the specific observation screen
    document.getElementById("home_specialButton").onclick = function () { initAnyCount(1); showSpecialObservationScreen(); };
    document.getElementById("home_15Button").onclick = function () { resetTimer(); initAnyCount(2); show15mObservationScreen(); };
    if (!($.isEmptyObject(settings.transects)))
    {
        document.getElementById("home_transectButton").onclick = function () { initAnyCount(3); showTransectPreObservationScreen(); };
    }
    document.getElementById("home_fitButton").onclick = function () { initAnyCount(4); showFitPreObservationScreen(); };

    synchWithServer();
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
        obj => {return obj.userCanCount === true}).filter(         //Filter by only countable species (e.g. not plants)
        obj => {return speciesGroupsUsers.includes(obj.id)}).map(  //Filter by species in user settings
             function (el) { return el.id; });                     //Return ID

    // Build the DOM
    renderNav(clear=true);

    var mb = document.getElementById('mainBody');
    mb.innerHTML = `
    <div class="container">

        <div class="row justify-content-center pt-5">
            <div class="col-md-12 text-center">
                <h2>${translations['specialTitle']}</h2>
                <p>${translations['specialDescr']}</p>
                <button id="special_buttonInfo" class="btn-line-small" data-bs-toggle="modal" data-bs-target="#modal_id">${translations['infoButton']}</button>
            </div>
            <div class="separator">
            </div>
        </div>
        
        
        <div class="row justify-content-center pb-3">
            <h3 style="display: flex;"><i class="fas fa-bug" style="align-self: center;"></i> ${translations['searchSpeciesLabel']} <a href="#" id="special_speciesInfo" style="margin-left:auto;"><i class="fas fa-info"></i></a></h3>
            <select class="chosen-select" name="special_selectSpecies" id="special_selectSpecies">
            </select>
        </div>

       
        <h3 class="pt-2"><i class="fas fa-list-ol"></i> ${translations['specialNumberLabel']}</h3>

        <div class="input-group">
            <div class="input-group-btn w-100" style="display: flex;">
                <button id="special_minAmount" class="btn-counter" onclick="$('#special_inputAmount').get(0).value--; $('#special_inputAmount').change();">-</button>
                <input class="small-input" id="special_inputAmount" name="special_inputAmount" value=0 style="width:100%;">
                <button id="special_plusAmount" class="btn-counter" onclick="$('#special_inputAmount').get(0).value++; $('#special_inputAmount').change();">+</button>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <button id="special_buttonSave" class="btn">${translations['saveButton']}</button> <button id="special_buttonCancel" class="btn-line">${translations['cancelButton']}</button>
            </div>
        </div>

    </div>
    `;

    // Attach the modals
    mb.innerHTML += renderModal(translations['specialInfoModalTitle'],translations['specialInfoModalContents']);
    mb.innerHTML += renderModal(translations['specialInfoModalSpeciesTitle'], '', 'sp');
    
    // Populate the list of species to the chosen selector
    preselectCountableSpecies(species, 'special_selectSpecies');

    $('.chosen-select').select2();

    // Attach the events
    document.getElementById("special_buttonSave").onclick = function () { storeSingleObservation(); };
    document.getElementById("special_buttonCancel").onclick = function () { showHomeScreen(); };
    
    document.getElementById("special_speciesInfo").onclick = function () { 
        speciesId = document.getElementById('special_selectSpecies').value;
        modalText = `
        ${translations['specialInfoModalSpeciesContents']}<br>
        <div style="text-align:center;">
        <a class="btn-line-small" href="https://speciesinfo.vlinderstichting.nl/species/${speciesId}" target=”_blank”>${translations['infoButton']}</a>
        </div>
        `
        document.getElementById("modal_bodysp").innerHTML = modalText;
        $('#modal_idsp').modal('show');
    };

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
    <div class="container">
        <div class="row justify-content-center pt-5">
            <div class="col-md-12 text-center">
                <h2 id="15m_title">${translations['15mTitle']}</h2>
                <p id="15m_subtitle">${translations['15mDescr']}</p>
                <button class="btn-line-small" id="15m_buttonInfo" data-bs-toggle="modal" data-bs-target="#modal_id">${translations['infoButton']}</button>
            </div>     
            <div class="separator">
                            
            </div>  
        </div>

        <div class="row justify-content-center mb-3">
            <h3><i class="fas fa-stopwatch"></i> <span id="15m_stopwatchText">${translations['stopwatchLabel']}</span></h3>
            <p><span id="stopwatch" style="font-size:200%;">15:00</span> <i class="fas fa-play" style="font-size:200%;" id="startTimer"></i> <i class="fas fa-pause" style="font-size:200%;" id="pauseTimer"></i> <i class="fas fa-undo" style="font-size:200%;" id="resetTimer"></i></p>
        </div>   
        <div class="row justify-content-center mb-3"> 
            <h3><i class="fas fa-bug"></i> <span id="15m_speciesText">${translations['searchSpeciesLabel']}</span></h3>
            <div>
                <select class="chosen-select" name="15m_selectSpecies" id="15m_selectSpecies" data-placeholder="${translations['SelectSpeciesPlaceholder']}" tabindex="1">
                    <option value=""></option>
                </select>
            </div>
        </div>
            
        <div class="row justify-content-center mb-3"> 
            <div style="
                background: #FFFFFF 0% 0% no-repeat padding-box;
                background-position-x: 0%;
                background-position-y: 0%;
                box-shadow: 4px 3px 4px #00000029;
                border-radius: 10px;
                opacity: 0.8;
                background-position: bottom right !important;
                min-height: 46px;
                width: calc(100% - 30px);

                ">
                
                <ul id="15m_listSpecies" style="list-style-type:none;">
                </ul>

            </div>
        <div>


        <div class="row justify-content-center mb-3">
            <button class="btn" id="15m_buttonSave">${translations['saveButton']}</button>
            <button class="btn-line" id="15m_buttonCancel">${translations['cancelButton']}</button>
        </div>
    </div>


    `;
    
    // Attach the modals
    // Info
    mb.innerHTML += renderModal(translations['15mInfoModalTitle'],translations['15mInfoModalContents']);
    // No tracking message
    mb.innerHTML += renderModal(translations['NoTrackModalTitle'],translations['NoTrackModalContents'], 'no_loc');
    // Restart timer question
    mb.innerHTML += renderModal(translations['RestartTimerModalTitle'],
    `
        ${translations['RestartTimerModalContents']}
        <br>
        <center><button class="btn btn-danger" id="restartTimerButton">${translations['restartStopwatchLabel']}</button></center>
    `
    , 'restart_timer');

    // Populate the list of species and attach the chosen selector
    
    // Populate the list of species to the chosen selector
    preselectCountableSpecies(species, '15m_selectSpecies');

    $('.chosen-select').select2();

    // Attach the events
    document.getElementById("15m_buttonSave").onclick = function () {  stopTimer(); show15mPostObservationScreen(); }; //stopTimer, just in case it was still going
    document.getElementById("15m_buttonCancel").onclick = function () { stopTimer(); showHomeScreen(); }; //stopTimer, just in case it was still going
    document.getElementById("startTimer").onclick = function () { startTimer(); };
    document.getElementById("pauseTimer").onclick = function () { stopTimer(); };
    document.getElementById("resetTimer").onclick = function () { $(`#modal_idrestart_timer`).modal('show'); };
    document.getElementById("restartTimerButton").onclick = function () { resetTimer(); $(`#modal_idrestart_timer`).modal('hide'); show15mObservationScreen();};
    $("#15m_selectSpecies").change( function () { addSpeciesToList($(this)[0].value); } );

    oldObservations = [...new Set(visit.observations.map(obj => {return obj.species_id}))];

    function addSpeciesToList (id)
    {
        var settings = getUserSettings();
        var species = settings.species;
        var speciesId = id;
        var speciesInfo = species[speciesId];
        $('#15m_listSpecies').append(`
            <li class="mt-3 mb-3"><i>${getSpeciesName(speciesInfo['id'])}</i>
                <span style="float:right; height:20px;">
                    <span id="15m_amountText_${speciesInfo['id']}">${visit['observations'].filter(obj => {return obj.species_id == speciesId}).length}</span>
                    <button class="btn-counter" id="15m_plusAmount_${speciesInfo['id']}">+</button>
                    <button class="btn-counter" id="15m_editAmount_${speciesInfo['id']}"><i class="fas fa-pen"></i></button>
                </span>
            </li>
        `)
        $(`#15m_selectSpecies option[value='${speciesInfo['id']}']`).remove();

        
        $(`#15m_editAmount_${speciesInfo['id']}`).click( function () {
            $(`#modal_id_${speciesInfo['id']}`).remove()

            speciesObservations = visit['observations'].filter(obj => {return obj.species_id === String(speciesInfo['id'])});

            modalContent = '<ul>';
            speciesObservations.forEach(el => {
                location1 = el.location.split(',')[1].replace(' ','');
                location2 = el.location.split(',')[2].replace(' ','');
                modalContent += `
                    <li>
                        ${el.observationtime} - ${location1} ${location2} 
                        <button class="delete_obs" data_time="${el.observationtime}" data_speciesid="${el.species_id}">${translations['deleteButton']}</button>
                    </li>`;
            } );
            modalContent += '</ul>';

            $("#mainBody").append(renderModal(`${translations['15mDeleteModalSpeciesTitle']} ${getSpeciesName(speciesInfo['id'])}`,modalContent, `_${speciesInfo['id']}`));

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
                $(`#15m_amountText_${speciesToDelete}`).html(visit['observations'].filter(obj => {return obj.species_id == speciesToDelete}).length);
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
                obs15m['observationtime'] = new Date().toISOString();
                visit['observations'].push(obs15m);
            }
            $(`#15m_amountText_${speciesInfo['id']}`).html(visit['observations'].filter(obj => {return obj.species_id == speciesInfo['id']}).length);

        });

    }

    oldObservations.forEach(id => 
    {
        addSpeciesToList(id);
    });

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

    <div class="container">
        <div class="row justify-content-center pt-5">
            <div class="col-md-12 text-center">
                <h2 id="15mpost_title">${translations['15mPostTitle']}</h2>
                <p id="15mpost_subtitle">${translations['15mPostDescr']}</p>
                <button class="btn-line-small" id="15mpost_buttonInfo" data-bs-toggle="modal" data-bs-target="#modal_id">${translations['infoButton']}</button>
            </div>     
            <div class="separator">
                            
            </div>  
        </div>
        
        <div class="row justify-content-center mb-3">
            <h3><i class="fas fa-bug"></i> <span id="15mpost_countedGroupsText">${translations['countedGroupsLabel']}</span></h3>
            <div id="15mpost_countedGroupsContainer"></div>
        </div>

        <div class="row justify-content-center mb-3">
            <h3 id="15mpost_weatherText"><i class="fas fa-cloud-sun-rain"></i> ${translations['weatherLabel']}</h3>
            <div id="15mpost_weatherContainer"></div>
        </div>

        <div class="row justify-content-center mb-3">
            <h3 id="15mpost_landText"><i class="fas fa-mountain"></i> ${translations['LandLabel']}</h3>
            <div id="15mpost_landContainer"></div>
        </div>

        <div class="row justify-content-center mb-3">
            <h3 id="15mpost_notesText"><i class="fas fa-pen"></i> ${translations['notesLabel']}</h3>
            <textarea style="width: calc(100% - 30px);" id="15mpost_textareaNotes" name="15mpost_textareaNotes" rows="4" cols="50"></textarea>
        </div>

        <div class="row justify-content-center mb-3">
            <button class="btn" id="15mpost_buttonSave">${translations['saveButton']}</button>
            <button class="btn btn-line" id="15mpost_buttonCancel">${translations['cancelButton']}</button>
        </div>

    </div>
    `

    // Attach the modals
    // Info
    mb.innerHTML += renderModal(translations['15mPostInfoModalTitle'],translations['15mPostInfoModalContents']);

    // Attach the contents of the species group container
    speciesGroupsHtml = '<ul style="list-style-type:none;">';
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
    <div style="
    background: #FFFFFF 0% 0% no-repeat padding-box;
    background-position-x: 0%;
    background-position-y: 0%;
    box-shadow: 4px 3px 4px #00000029;
    border-radius: 10px;
    opacity: 0.8;
    background-position: bottom right !important;
    min-height: 46px;
    ">
        <ul style="list-style-type:none; padding: 1px;">
            <li class="m-3">
                ${translations['temperatureLabel']}
                <span style="float: right;  height: 20px;">
                    <button id="15mpost_minTemperature" class="btn-counter" onclick="$('#15mpost_inputTemperature').get(0).value--; $('#15mpost_inputTemperature').change();">-</button>
                    <input id="15mpost_inputTemperature" class="form-control input-number" name="15mpost_inputTemperature" value=15 style="display: inline-block; width: 100px;">
                    <button id="15mpost_plusTemperature" class="btn-counter" onclick="$('#15mpost_inputTemperature').get(0).value++; $('#15mpost_inputTemperature').change();">+</button>
                </span>
            </li>
            <li class="m-3">
                ${translations['windLabel']}
                <span style="float: right; height: 20px;">
                    <select name="15mpost_selectWind" id="15mpost_selectWind" class="form-control input-number" data-placeholder="${translations['windSelectorPlaceholder']}" tabindex="1" style="display: inline-block; width: 168px; margin-left: 5px; margin-right: 5px;">
                        <option value=1>1</option>
                        <option value=2>2</option>
                        <option value=3>3</option>
                        <option value=4>4</option>
                        <option value=5>5</option>
                        <option value=6>6</option>
                        <option value=7>7</option>
                        <option value=8>8</option>
                    </select>
                </span>
            </li>
            <li class="m-3">
                ${translations['cloudsLabel']}
                <span style="float: right; height: 20px;">
                    <select name="15mpost_selectClouds" id="15mpost_selectClouds" class="form-control input-number" data-placeholder="${translations['cloudSelectorPlaceholder']}" tabindex="1" style="display: inline-block; width: 168px; margin-left: 5px; margin-right: 5px;">
                        <option value=1>1/8</option>
                        <option value=2>2/8</option>
                        <option value=3>3/8</option>
                        <option value=4>4/8</option>
                        <option value=5>5/8</option>
                        <option value=6>6/8</option>
                        <option value=7>7/8</option>
                        <option value=8>8/8</option>
                    </select>
                </span>
            </li>
        </ul>
    </div>
    `;
    $('#15mpost_weatherContainer').html(weatherHtml);

       // Attach the contents of the land container
       landHhtml = 
       `
       <div style="
       background: #FFFFFF 0% 0% no-repeat padding-box;
       background-position-x: 0%;
       background-position-y: 0%;
       box-shadow: 4px 3px 4px #00000029;
       border-radius: 10px;
       opacity: 0.8;
       background-position: bottom right !important;
       min-height: 46px;
       ">
           <ul style="list-style-type:none; padding: 1px;">
               <li class="m-3">
                   ${translations['landTypeLabel']}
                   <span style="float: right; height: 20px;">
                       <select name="15mpost_selectLandType" id="15mpost_selectLandType" class="form-control input-number" tabindex="1" style="display: inline-block; width: 168px; margin-left: 5px; margin-right: 5px;">
                       </select>
                   </span>
               </li>
               <li class="m-3">
                   ${translations['landManagementLabel']}
                   <span style="float: right; height: 20px;">
                       <select name="15mpost_selectLandManagement" id="15mpost_selectLandManagement" class="form-control input-number" tabindex="1" style="display: inline-block; width: 168px; margin-left: 5px; margin-right: 5px;">
                       </select>
                   </span>
               </li>
           </ul>
       </div>
       `;
   
       $('#15mpost_landContainer').html(landHhtml);

       var landuses = settings.landuseTypes
       let optionList1 = document.getElementById('15mpost_selectLandType').options;
       landuses.forEach(option =>
        optionList1.add(
          new Option(option.description, option.id)
        )
      );

      var managements = settings.managementTypes
      let optionList2 = document.getElementById('15mpost_selectLandManagement').options;
      managements.forEach(option =>
        optionList2.add(
         new Option(option.description, option.id)
       )
     );

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
        var landtype = document.getElementById('15mpost_selectLandType').value;
        var management = document.getElementById('15mpost_selectLandManagement').value;

        var settings = getUserSettings();
        var speciesGroups = settings.speciesGroups;
        var speciesGroupsUsers = settings.userSettings.speciesGroupsUsers;
        var method = [];
        Object.values(speciesGroups).filter(obj => {return obj.userCanCount === true}).forEach(element => 
        {
            if (Object.values(speciesGroupsUsers).map(obj => {return obj.speciesgroup_id}).includes(element.id))
            {
                var elemid = "15mpost_checkSpeciesGroup_" + element.id;
                var isChecked = document.getElementById(elemid).checked;
                if (isChecked)
                {
                    var recordingLevel = "species";
                    for (var i = 0; i < Object.keys(speciesGroupsUsers).length; i++)
                    {
                        if (speciesGroupsUsers[Object.keys(speciesGroupsUsers)[i]].speciesgroup_id == element.id)
                        {
                            recordingLevel = speciesGroupsUsers[Object.keys(speciesGroupsUsers)[i]].recordinglevel_name;
                        }
                    }
                    
                    var methodLine = {'speciesgroup_id':  element.id, 'recordinglevel_name': recordingLevel};
                    method.push(methodLine);
                }
            }
        });
        visit.method = method;
        visit.notes = notes;
        visit.wind = wind;
        visit.temperature = temp;
        visit.cloud = cloud;
        visit.landtype = landtype;
        visit.management = management;
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
    <div class="container">
        <div class="row justify-content-center pt-5">
            <div class="col-md-12 text-center">
                <h2 id="prefit_title">${translations['fitPreTitle']}</h2>
                <p id="prefit_subtitle">${translations['fitPreDescr']}</p>
                <button class="btn-line-small" id="prefit_buttonInfo" data-bs-toggle="modal" data-bs-target="#modal_id">${translations['infoButton']}</button>
            </div>
            <div class="separator">     
            </div>
        </div>

        <div class="row justify-content-center pb-3">
            <h3 style="display: flex;"><i class="fas fa-bug" style="align-self: center;"></i> ${translations['searchSpeciesLabel']}</h3>
            <select class="chosen-select" name="prefit_selectSpecies" id="prefit_selectSpecies">
            </select>
        </div>

        <h3 class="pt-2"><i class="fas fa-list-ol"></i> ${translations['fitPreNumberLabel']}</h3>

        <div class="input-group">
            <div class="input-group-btn w-100" style="display: flex;">
                <button id="prefit_minAmount" class="btn-counter" onclick="$('#prefit_inputAmount').get(0).value--; $('#prefit_inputAmount').change();">-</button>
                <input class="small-input" id="prefit_inputAmount" name="prefit_inputAmount" value=0 style="width:100%;">
                <button id="prefit_plusAmount" class="btn-counter" onclick="$('#prefit_inputAmount').get(0).value++; $('#prefit_inputAmount').change();">+</button>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <button id="prefit_buttonSave" class="btn">${translations['saveButton']}</button> <button id="prefit_buttonCancel" class="btn-line">${translations['cancelButton']}</button>
            </div>
        </div>

    </div>
    `;

    // Attach the modal
    mb.innerHTML += renderModal(translations['fitPreInfoModalTitle'],translations['fitPreInfoModalContents']);
    
    // Populate the list of species (if in usercancount) and attach the chosen selector
    $.each(species, function(key, value) {
        if (value['speciesgroupId'] == 11 && value['taxon'] != '') // Note that the ID might change in the future
        {
            $('#prefit_selectSpecies').append(`<option value="${key}">${getSpeciesName(value['id'])}</option>`);
        }
    });
    $('.chosen-select').select2();

    // Attach the events
    $("#prefit_selectSpecies").change(function () 
    {
        visit.flower_id = document.getElementById("prefit_selectSpecies").value;
    });
    $("#prefit_selectSpecies").change();

    $("#prefit_inputAmount").change(function () 
    {
        visit.flower_count = document.getElementById("prefit_inputAmount").value;
    });
    $("#prefit_inputAmount").change();

    document.getElementById("prefit_buttonSave").onclick = function () { resetTimer(); showFitObservationScreen(); };
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
    <div class="container">
        <div class="row justify-content-center pt-5">
            <div class="col-md-12 text-center">
                <h2 id="prefit_title">${translations['fitTitle']}</h2>
                <p id="prefit_subtitle">${translations['fitDescr']}</p>
                <button class="btn-line-small" id="fit_buttonInfo" data-bs-toggle="modal" data-bs-target="#modal_id">${translations['infoButton']}</button>
            </div>     
            <div class="separator">
                            
            </div>  
        </div>

        <div class="row justify-content-center mb-3">
            <h3><i class="fas fa-stopwatch"></i> <span id="fit_stopwatchText">${translations['stopwatchLabel']}</span></h3>
            <p><span id="stopwatch">15:00</span> <i style="font-size:200%;" class="fas fa-play" id="startTimer"></i> <i style="font-size:200%;" class="fas fa-pause" id="pauseTimer"></i> <i style="font-size:200%;" class="fas fa-undo" id="resetTimer"></i></p>
        </div>  


        <div class="row justify-content-center mb-3"> 
            <h3><i class="fas fa-bug"></i> <span id="fit_speciesText">${translations['searchSpeciesLabel']}</span></h3>
            <div>
                <select class="chosen-select" name="fit_selectSpecies" id="fit_selectSpecies" data-placeholder="${translations['SelectSpeciesPlaceholder']}" tabindex="1">
                    <option value=""></option>
                </select>
            </div>
        </div>
            
        <div class="row justify-content-center mb-3"> 
            <div style="
                background: #FFFFFF 0% 0% no-repeat padding-box;
                background-position-x: 0%;
                background-position-y: 0%;
                box-shadow: 4px 3px 4px #00000029;
                border-radius: 10px;
                opacity: 0.8;
                background-position: bottom right !important;
                min-height: 46px;
                width: calc(100% - 30px);

                ">
                
                <ul id="fit_listSpecies" style="list-style-type:none;">
                </ul>

            </div>
        <div>


        <div class="row justify-content-center mb-3">
            <button class="btn" id="fit_buttonSave">${translations['saveButton']}</button>
            <button class="btn-line" id="fit_buttonCancel">${translations['cancelButton']}</button>
        </div>
    </div>

    `;
    
    // Attach the modals
    mb.innerHTML += renderModal(translations['fitInfoModalTitle'],translations['fitInfoModalContents']);
    // No tracking message
    mb.innerHTML += renderModal(translations['NoTrackModalTitle'],translations['NoTrackModalContents'], 'no_loc');
    // Restart timer question
    mb.innerHTML += renderModal(translations['RestartTimerModalTitle'],
    `
        ${translations['RestartTimerModalContents']}
        <br>
        <center><button class="btn btn-danger" id="restartTimerButton">${translations['restartStopwatchLabel']}</button></center>
    `
    , 'restart_timer');
    // Populate the list of species and attach the chosen selector
    preselectCountableSpecies(species, 'fit_selectSpecies');

    $('.chosen-select').select2();

    document.getElementById("fit_buttonSave").onclick = function () {  stopTimer(); showFitPostObservationScreen(); }; //stopTimer, just in case it was still going
    document.getElementById("fit_buttonCancel").onclick = function () { stopTimer(); showHomeScreen(); }; //stopTimer, just in case it was still going
    document.getElementById("startTimer").onclick = function () { startTimer(); };
    document.getElementById("pauseTimer").onclick = function () { stopTimer(); };
    document.getElementById("resetTimer").onclick = function () { $(`#modal_idrestart_timer`).modal('show'); };
    document.getElementById("restartTimerButton").onclick = function () { resetTimer(); $(`#modal_idrestart_timer`).modal('hide'); showFitObservationScreen();};

    $("#fit_selectSpecies").change( function () { addSpeciesToList($(this)[0].value); } );

    function addSpeciesToList (id, number=1)
    {
        var settings = getUserSettings();
        var species = settings.species;
        var speciesId = id;
        var speciesInfo = species[speciesId];
        $('#fit_listSpecies').append(`
            <li class="m-3">${getSpeciesName(speciesInfo['id'])}
                <span style="float: right;  height: 20px;">
                    <button id="fit_minAmount_${speciesInfo['id']}" class="btn-counter" onclick="$('#fit_inputAmount_${speciesInfo['id']}').get(0).value--; $('#fit_inputAmount_${speciesInfo['id']}').change();">-</button>
                    <input id="fit_inputAmount_${speciesInfo['id']}" class="form-control input-number" name="fit_inputAmount_${speciesInfo['id']}" value=${number} style="display: inline-block; width: 100px;">
                    <button id="fit_plusAmount_${speciesInfo['id']}" class="btn-counter" onclick="$('#fit_inputAmount_${speciesInfo['id']}').get(0).value++; $('#fit_inputAmount_${speciesInfo['id']}').change();">+</button>
                </span>
            </li>
        `)
        $(`#fit_selectSpecies option[value='${speciesInfo['id']}']`).remove();
        oldObservations = [...new Set(visit.observations.map(obj => {return obj.species_id}))];

        if(oldObservations.includes(id))
        {
            addObservationToVisit(speciesId, number, trackedLocations[trackedLocations.length - 1], 'put');
        }
        else
        {
            addObservationToVisit(speciesId, number, trackedLocations[trackedLocations.length - 1]);
        }

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
            addObservationToVisit(speciesInfo['id'], parseInt(elem.value), trackedLocations[trackedLocations.length - 1], 'put');
        });
    }
    oldObservations = [...new Set(visit.observations.map(obj => {return [obj.species_id, obj.number]}))];
    oldObservations.forEach(pair => 
    {
        addSpeciesToList(pair[0], pair[1]);
    });

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

    <div class="container">
        <div class="row justify-content-center pt-5">
            <div class="col-md-12 text-center">
                <h2 id="fitpost_title">${translations['fitPostTitle']}</h2>
                <p id="fitpost_subtitle">${translations['fitPostDescr']}</p>
                <button class="btn-line-small" id="fitpost_buttonInfo" data-bs-toggle="modal" data-bs-target="#modal_id">${translations['infoButton']}</button>
            </div>     
            <div class="separator">
                            
            </div>  
        </div>

        <div class="row justify-content-center mb-3">
            <h3><i class="fas fa-bug"></i> <span id="fit_countedGroupsText">${translations['countedGroupsLabel']}</span></h3>
            <div id="fit_countedGroupsContainer"></div>
        </div>

        <div class="row justify-content-center mb-3">
            <h3 id="fit_weatherText"><i class="fas fa-cloud-sun-rain"></i> ${translations['weatherLabel']}</h3>
            <div id="fit_weatherContainer"></div>
        </div>

        <div class="row justify-content-center mb-3">
            <h3 id="fit_landText"><i class="fas fa-mountain"></i> ${translations['LandLabel']}</h3>
            <div id="fit_landContainer"></div>
        </div>

        <div class="row justify-content-center mb-3">
            <h3 id="fit_notesText"><i class="fas fa-pen"></i> ${translations['notesLabel']}</h3>
            <textarea style="width: calc(100% - 30px);" id="fit_textareaNotes" name="fit_textareaNotes" rows="4" cols="50"></textarea>
        </div>

        <div class="row justify-content-center mb-3">
            <button class="btn" id="fit_buttonSave">${translations['saveButton']}</button>
            <button class="btn btn-line" id="fit_buttonCancel">${translations['cancelButton']}</button>
        </div>

    </div>

    `
    // Attach the modals
    // Info
    mb.innerHTML += renderModal(translations['fitPostInfoModalTitle'],translations['fitPostInfoModalContents']);

    // Attach the contents of the species group container
    speciesGroupsHtml = '<ul style="list-style-type:none;">';
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
    <div style="
    background: #FFFFFF 0% 0% no-repeat padding-box;
    background-position-x: 0%;
    background-position-y: 0%;
    box-shadow: 4px 3px 4px #00000029;
    border-radius: 10px;
    opacity: 0.8;
    background-position: bottom right !important;
    min-height: 46px;
    ">
        <ul style="list-style-type:none; padding: 1px;">
            <li class="m-3">
                ${translations['temperatureLabel']}
                <span style="float: right;  height: 20px;">
                    <button id="fit_minTemperature" class="btn-counter" onclick="$('#fit_inputTemperature').get(0).value--; $('#fit_inputTemperature').change();">-</button>
                    <input id="fit_inputTemperature" class="form-control input-number" name="fit_inputTemperature" value=15 style="display: inline-block; width: 100px;">
                    <button id="fit_plusTemperature" class="btn-counter" onclick="$('#fit_inputTemperature').get(0).value++; $('#fit_inputTemperature').change();">+</button>
                </span>
            </li>
            <li class="m-3">
                ${translations['windLabel']}
                <span style="float: right; height: 20px;">
                    <select name="fit_selectWind" id="fit_selectWind" class="form-control input-number" data-placeholder="${translations['windSelectorPlaceholder']}" tabindex="1" style="display: inline-block; width: 168px; margin-left: 5px; margin-right: 5px;">
                        <option value=1>1</option>
                        <option value=2>2</option>
                        <option value=3>3</option>
                        <option value=4>4</option>
                        <option value=5>5</option>
                        <option value=6>6</option>
                        <option value=7>7</option>
                        <option value=8>8</option>
                    </select>
                </span>
            </li>
            <li class="m-3">
                ${translations['cloudsLabel']}
                <span style="float: right; height: 20px;">
                    <select name="fit_selectClouds" id="fit_selectClouds" class="form-control input-number" data-placeholder="${translations['cloudSelectorPlaceholder']}" tabindex="1" style="display: inline-block; width: 168px; margin-left: 5px; margin-right: 5px;">
                        <option value=1>1/8</option>
                        <option value=2>2/8</option>
                        <option value=3>3/8</option>
                        <option value=4>4/8</option>
                        <option value=5>5/8</option>
                        <option value=6>6/8</option>
                        <option value=7>7/8</option>
                        <option value=8>8/8</option>
                    </select>
                </span>
            </li>
        </ul>
    </div>
    `;
    
    landHhtml = 
    `
    <div style="
    background: #FFFFFF 0% 0% no-repeat padding-box;
    background-position-x: 0%;
    background-position-y: 0%;
    box-shadow: 4px 3px 4px #00000029;
    border-radius: 10px;
    opacity: 0.8;
    background-position: bottom right !important;
    min-height: 46px;
    ">
        <ul style="list-style-type:none; padding: 1px;">
            <li class="m-3">
                ${translations['landTypeLabel']}
                <span style="float: right; height: 20px;">
                    <select name="fit_selectLandType" id="fit_selectLandType" class="form-control input-number" tabindex="1" style="display: inline-block; width: 168px; margin-left: 5px; margin-right: 5px;">
                    </select>
                </span>
            </li>
            <li class="m-3">
                ${translations['landManagementLabel']}
                <span style="float: right; height: 20px;">
                    <select name="fit_selectLandManagement" id="fit_selectLandManagement" class="form-control input-number" tabindex="1" style="display: inline-block; width: 168px; margin-left: 5px; margin-right: 5px;">
                    </select>
                </span>
            </li>
        </ul>
    </div>
    `;

    $('#fit_weatherContainer').html(weatherHtml);
    $('#fit_landContainer').html(landHhtml);

    var landuses = settings.landuseTypes
    let optionList1 = document.getElementById('fit_selectLandType').options;
    landuses.forEach(option =>
        optionList1.add(
        new Option(option.description, option.id)
        )
    );

    var managements = settings.managementTypes
    let optionList2 = document.getElementById('fit_selectLandManagement').options;
    managements.forEach(option =>
        optionList2.add(
        new Option(option.description, option.id)
        )
    );
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
        var landtype = document.getElementById('fit_selectLandType').value;
        var management = document.getElementById('fit_selectLandManagement').value;

        var settings = getUserSettings();
        var speciesGroups = settings.speciesGroups;
        var speciesGroupsUsers = settings.userSettings.speciesGroupsUsers;
        var method = [];

        Object.values(speciesGroups).filter(obj => {return obj.userCanCount === true}).forEach(element => 
        {
            if (Object.values(speciesGroupsUsers).map(obj => {return obj.speciesgroup_id}).includes(element.id))
            {
                var elemid = "fit_checkSpeciesGroup_" + element.id;
                var isChecked = document.getElementById(elemid).checked;
                if (isChecked)
                {
                    var recordingLevel = "species";
                    for (var i = 0; i < Object.keys(speciesGroupsUsers).length; i++)
                    {
                        if (speciesGroupsUsers[Object.keys(speciesGroupsUsers)[i]].speciesgroup_id == element.id)
                        {
                            recordingLevel = speciesGroupsUsers[Object.keys(speciesGroupsUsers)[i]].recordinglevel_name;
                        }
                    }
                    
                    var methodLine = {'speciesgroup_id':  element.id, 'recordinglevel_name': recordingLevel};
                    method.push(methodLine);
                }
            }
        });

        visit.method = method;
        visit.notes = notes;
        visit.wind = wind;
        visit.temperature = temp;
        visit.cloud = cloud;
        visit.landtype = landtype;
        visit.management = management;

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
    <div class="container">
        <div class="row justify-content-center pt-5">
            <div class="col-md-12 text-center">
                <h2 id="pretransect_title">${translations['transectPreTitle']}</h2>
                <p id="pretransect_subtitle">${translations['transectPreDescr']}</p>
                <button class="btn-line-small" id="pretransect_buttonInfo" data-bs-toggle="modal" data-bs-target="#modal_id">${translations['infoButton']}</button>
            </div>     
            <div class="separator">     
            </div>  
        </div>

        <div class="row justify-content-center pb-3">
            <h3 style="display: flex;"><i class="fas fa-route" style="align-self: center;"></i>  ${translations['transectPreSelectTransectLabel']}</h3>
            <select class="chosen-select" name="pretransect_selectTransects" id="pretransect_selectTransects">
            </select>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <button id="pretransect_buttonSave" class="btn">${translations['saveButton']}</button> <button id="pretransect_buttonCancel" class="btn-line">${translations['cancelButton']}</button>
            </div>
        </div>

    </div>
    `;

    // Attach the modal
    mb.innerHTML += renderModal(translations['transectPreInfoModalTitle'], translations['transectPreInfoModalContents']);
    
    for (var i = 0 ; i < transects.length; i++) 
    {
        $('#pretransect_selectTransects').append(`<option value="` + transects[i].id + `">` + transects[i].name + `</option>`); 
    }

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

    renderNav(clear=true);
    // Build the DOM
    var mb = document.getElementById('mainBody');
    mb.innerHTML = `
    <div class="container">
        <div class="row justify-content-center pt-5">
            <div class="col-md-12 text-center">
                <h2 id="transect_title">${translations['transectTitle']}</h2>
                <p id="transect_subtitle">${translations['transectDescr']}</p>
                <button class="btn-line-small" id="transect_buttonInfo" data-bs-toggle="modal" data-bs-target="#modal_id">${translations['infoButton']}</button>
            </div>     
            <div class="separator">     
            </div>  
        </div>

        <h3 style="display: flex;"><i class="fas fa-map-marked" style="align-self: center; margin-right: 2px;"></i> ${translations['transectSectionSelector']}</h3>
        <div class="input-group-btn w-100" style="display: flex;">
                <button class="btn-counter" id="transect_prevTransButton" disabled> < </button>
                <input id="transect_transLabel"  data_id="${transectSections[0].id}" class="small-input" style="width:100%;" value="${transectSections[0].name}" style="display: inline-block; width: 100px;">
                <button class="btn-counter" id="transect_nextTransButton"> > </button>
        </div>

        <div class="row justify-content-center mb-3"> 
            <h3><i class="fas fa-bug"></i> <span id="transect_speciesText">${translations['searchSpeciesLabel']}</span></h3>
            <div>
                <select class="chosen-select" name="transect_selectSpecies" id="transect_selectSpecies" data-placeholder="${translations['SelectSpeciesPlaceholder']}" tabindex="1">
                    <option value=""></option>
                </select>
            </div>
        </div>

        <div class="row justify-content-center mb-3"> 
            <div style="
                background: #FFFFFF 0% 0% no-repeat padding-box;
                background-position-x: 0%;
                background-position-y: 0%;
                box-shadow: 4px 3px 4px #00000029;
                border-radius: 10px;
                opacity: 0.8;
                background-position: bottom right !important;
                min-height: 46px;
                width: calc(100% - 30px);

                ">
                
                <ul id="transect_listSpecies" style="list-style-type:none;">
                </ul>

            </div>
        <div>

        <div class="row justify-content-center mb-3">
            <button class="btn" id="transect_buttonSave">${translations['saveButton']}</button>
            <button class="btn-line" id="transect_buttonCancel">${translations['cancelButton']}</button>
        </div>

    </div>
    `;
    
    // Attach the modal
    mb.innerHTML += renderModal(translations['transectInfoModalTitle'],translations['transectInfoModalContents']);

    // Build the transect selector logic
    function transectChange() 
    {
        transectObs = Object.values(visit.observations).filter(obj => {return obj.transect_section_id == $('#transect_transLabel').attr('data_id')});
        $('[id*=transect_inputAmount]').each(function () {
            $(this).val('');
        });
        transectObs.forEach(element => {
            $('#transect_inputAmount_'+element.species_id).val(element.number);
        });
    }

    var sectionIndex = 0;
    $('#transect_prevTransButton').click( function () 
    {
        if (sectionIndex == 0)
        {
            return
        }
        else
        {
            sectionIndex--;
            $('#transect_transLabel').val(transectSections[sectionIndex].name);
            $('#transect_transLabel').attr('data_id', transectSections[sectionIndex].id);
            $('#transect_nextTransButton').removeAttr("disabled");
            transectChange();
            if (sectionIndex == 0)
            {
                $(this).prop('disabled', true);
            }

        }
    });
    $('#transect_nextTransButton').click( function () 
    {
        if (sectionIndex == transectSections.length-1)
        {
            return
        }
        else
        {
            sectionIndex++;
            $('#transect_transLabel').val(transectSections[sectionIndex].name);
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
    preselectCountableSpecies(species, 'transect_selectSpecies');
    $('.chosen-select').select2();

    // Attach the events
    document.getElementById("transect_buttonSave").onclick = function () { showTransectPostObservationScreen(); }; 
    document.getElementById("transect_buttonCancel").onclick = function () { showHomeScreen(); };

    $("#transect_selectSpecies").change( function () { addSpeciesToList($(this)[0].value); } );

    function addSpeciesToList (id)
    {
        var settings = getUserSettings();
        var species = settings.species;
        var speciesId = id;
        var speciesInfo = species[speciesId];
        $('#transect_listSpecies').append(`
            <li class="m-3">${getSpeciesName(speciesInfo['id'])}
                <button id="transect_minAmount_${speciesInfo['id']}" class="btn-counter" onclick="$('#transect_inputAmount_${speciesInfo['id']}').get(0).value--; $('#transect_inputAmount_${speciesInfo['id']}').change();">-</button>
                <input id="transect_inputAmount_${speciesInfo['id']}" class="form-control input-number" name="transect_inputAmount_${speciesInfo['id']}" value=0 style="display: inline-block; width: 100px;">
                <button id="transect_plusAmount_${speciesInfo['id']}" class="btn-counter" onclick="$('#transect_inputAmount_${speciesInfo['id']}').get(0).value++; $('#transect_inputAmount_${speciesInfo['id']}').change();">+</button>
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
    
    oldObservations = [...new Set(visit.observations.map(obj => {return obj.species_id}))];

    oldObservations.forEach(id => 
    {
        addSpeciesToList(id);
    });

    transectChange();
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

    <div class="container">
        <div class="row justify-content-center pt-5">
            <div class="col-md-12 text-center">
                <h2 id="transect_title">${translations['transectPostTitle']}</h2>
                <p id="transect_subtitle">${translations['transectPostDescr']}</p>
                <button class="btn-line-small" id="transect_buttonInfo" data-bs-toggle="modal" data-bs-target="#modal_id">${translations['infoButton']}</button>
            </div>     
            <div class="separator">
                            
            </div>  
        </div>
        
        <div class="row justify-content-center mb-3">
            <h3><i class="fas fa-bug"></i> <span id="transect_countedGroupsText">${translations['countedGroupsLabel']}</span></h3>
            <div id="transect_countedGroupsContainer"></div>
        </div>

        <div class="row justify-content-center mb-3">
            <h3 id="transect_weatherText"><i class="fas fa-cloud-sun-rain"></i> ${translations['weatherLabel']}</h3>
            <div id="transect_weatherContainer"></div>
        </div>

        <div class="row justify-content-center mb-3">
            <h3 id="transect_landText"><i class="fas fa-mountain"></i> ${translations['LandLabel']}</h3>
            <div id="transect_landContainer"></div>
        </div>

        <div class="row justify-content-center mb-3">
            <h3 id="transect_notesText"><i class="fas fa-pen"></i> ${translations['notesLabel']}</h3>
            <textarea style="width: calc(100% - 30px);" id="transect_textareaNotes" name="transect_textareaNotes" rows="4" cols="50"></textarea>
        </div>

        <div class="row justify-content-center mb-3">
            <button class="btn" id="transect_buttonSave">${translations['saveButton']}</button>
            <button class="btn btn-line" id="transect_buttonCancel">${translations['cancelButton']}</button>
        </div>

    </div>
    `
    // Attach the modals
    // Info
    mb.innerHTML += renderModal(translations['transectPostInfoModalTitle'],translations['transectPostInfoModalContents']);

    // Attach the contents of the species group container
    speciesGroupsHtml = '<ul style="list-style-type:none;">';
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
    <div style="
    background: #FFFFFF 0% 0% no-repeat padding-box;
    background-position-x: 0%;
    background-position-y: 0%;
    box-shadow: 4px 3px 4px #00000029;
    border-radius: 10px;
    opacity: 0.8;
    background-position: bottom right !important;
    min-height: 46px;
    ">
        <ul style="list-style-type:none; padding: 1px;">
            <li class="m-3">
                ${translations['temperatureLabel']}
                <span style="float: right;  height: 20px;">
                    <button id="transect_minTemperature" class="btn-counter" onclick="$('#transect_inputTemperature').get(0).value--; $('#transect_inputTemperature').change();">-</button>
                    <input id="transect_inputTemperature" class="form-control input-number" name="transect_inputTemperature" value=15 style="display: inline-block; width: 100px;">
                    <button id="transect_plusTemperature" class="btn-counter" onclick="$('#transect_inputTemperature').get(0).value++; $('#transect_inputTemperature').change();">+</button>
                </span>
            </li>
            <li class="m-3">
                ${translations['windLabel']}
                <span style="float: right; height: 20px;">
                    <select name="transect_selectWind" id="transect_selectWind" class="form-control input-number" data-placeholder="${translations['windSelectorPlaceholder']}" tabindex="1" style="display: inline-block; width: 168px; margin-left: 5px; margin-right: 5px;">
                        <option value=1>1</option>
                        <option value=2>2</option>
                        <option value=3>3</option>
                        <option value=4>4</option>
                        <option value=5>5</option>
                        <option value=6>6</option>
                        <option value=7>7</option>
                        <option value=8>8</option>
                    </select>
                </span>
            </li>
            <li class="m-3">
                ${translations['cloudsLabel']}
                <span style="float: right; height: 20px;">
                    <select name="transect_selectClouds" id="transect_selectClouds" class="form-control input-number" data-placeholder="${translations['cloudSelectorPlaceholder']}" tabindex="1" style="display: inline-block; width: 168px; margin-left: 5px; margin-right: 5px;">
                        <option value=1>1/8</option>
                        <option value=2>2/8</option>
                        <option value=3>3/8</option>
                        <option value=4>4/8</option>
                        <option value=5>5/8</option>
                        <option value=6>6/8</option>
                        <option value=7>7/8</option>
                        <option value=8>8/8</option>
                    </select>
                </span>
            </li>
        </ul>
    </div>
    `;

    // Attach the contents of the land container
    landHhtml = 
    `
    <div style="
    background: #FFFFFF 0% 0% no-repeat padding-box;
    background-position-x: 0%;
    background-position-y: 0%;
    box-shadow: 4px 3px 4px #00000029;
    border-radius: 10px;
    opacity: 0.8;
    background-position: bottom right !important;
    min-height: 46px;
    ">
        <ul style="list-style-type:none; padding: 1px;">
            <li class="m-3">
                ${translations['landTypeLabel']}
                <span style="float: right; height: 20px;">
                    <select name="transect_selectLandType" id="transect_selectLandType" class="form-control input-number" tabindex="1" style="display: inline-block; width: 168px; margin-left: 5px; margin-right: 5px;">
                    </select>
                </span>
            </li>
            <li class="m-3">
                ${translations['landManagementLabel']}
                <span style="float: right; height: 20px;">
                    <select name="transect_selectLandManagement" id="transect_selectLandManagement" class="form-control input-number" tabindex="1" style="display: inline-block; width: 168px; margin-left: 5px; margin-right: 5px;">
                    </select>
                </span>
            </li>
        </ul>
    </div>
    `;

    $('#transect_weatherContainer').html(weatherHtml);
    $('#transect_landContainer').html(landHhtml);

    var landuses = settings.landuseTypes
    let optionList1 = document.getElementById('transect_selectLandType').options;
    landuses.forEach(option =>
        optionList1.add(
        new Option(option.description, option.id)
        )
    );

    var managements = settings.managementTypes
    let optionList2 = document.getElementById('transect_selectLandManagement').options;
    managements.forEach(option =>
        optionList2.add(
        new Option(option.description, option.id)
        )
    );

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
        var landtype = document.getElementById('transect_selectLandType').value;
        var management = document.getElementById('transect_selectLandManagement').value;

        var settings = getUserSettings();
        var speciesGroups = settings.speciesGroups;
        var speciesGroupsUsers = settings.userSettings.speciesGroupsUsers;
        var method = [];

        Object.values(speciesGroups).filter(obj => {return obj.userCanCount === true}).forEach(element => 
        {
            if (Object.values(speciesGroupsUsers).map(obj => {return obj.speciesgroup_id}).includes(element.id))
            {
                var elemid = "transect_checkSpeciesGroup_" + element.id;
                var isChecked = document.getElementById(elemid).checked;
                if (isChecked)
                {
                    var recordingLevel = "species";
                    for (var i = 0; i < Object.keys(speciesGroupsUsers).length; i++)
                    {
                        if (speciesGroupsUsers[Object.keys(speciesGroupsUsers)[i]].speciesgroup_id == element.id)
                        {
                            recordingLevel = speciesGroupsUsers[Object.keys(speciesGroupsUsers)[i]].recordinglevel_name;
                        }
                    }
                    
                    var methodLine = {'speciesgroup_id':  element.id, 'recordinglevel_name': recordingLevel};
                    method.push(methodLine);
                }
            }
        });

        visit.method = method;
        visit.notes = notes;
        visit.wind = wind;
        visit.temperature = temp;
        visit.cloud = cloud;
        visit.landtype = landtype;
        visit.management = management;

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
    $("#backgroundDiv").css("background-image", "url('img/background_1920x1080_screen-statistics.png')");

    var mb = document.getElementById('mainBody');
    mb.innerHTML = `
    <div class="container">
        <div class="row justify-content-center pt-5">
            <div class="col-md-12 text-center">
                <h2 id="data_title" style="color: #e8de24">${translations['dataTitle']}</h2>
                <p id="data_subtitle" style="color: #e8de24">${translations['dataDescr']}</p>
                <button class="btn-line-small" id="data_buttonInfo" data-bs-toggle="modal" data-bs-target="#modal_id" style="color: #e8de24; border: 2px solid #e8de24">${translations['infoButton']}</button>
            </div>     
            <div class="separator">
                            
            </div>  
        </div>

        <div class="row justify-content-center">
            <div class="row justify-content-center text-center"> 
                <h3><span style="color: #e8de24">${translations['dataOverviewTableHeader']}</span></h3>
                <div class="separator"></div>
                </div>
            </div>
            
            <div class="row justify-content-center"> 
                <div class="col-12 col-xl-5 col-lg-10 col-md-10">
                    <div class="">
                        <div class="box-background text-center" style="background-image:url('img/icondata.png');">
                            <p><span class="data-number" id="data_nrDataEntries">0</span> ${translations['dataDataEntries']}</p>
                        </div>
                    </div>    
                    <div class="">
                        <div class="box-background text-center" style="background-image:url('img/iconobservation.png');">
                            <p><span class="data-number" id="data_nrObservations">0</span> ${translations['dataObservations']}</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-5 col-lg-10 col-md-10">
                    <div class="">
                        <div class="box-background text-center" style="background-image:url('img/iconinsect.png');">
                            <p><span class="data-number" id="data_nrInsectsSeen">0</span> ${translations['dataInsectsSeen']}</p>
                        </div>
                    </div>    
                    <div class="">
                        <div class="box-background text-center" style="background-image:url('img/icongroups.png');">
                            <p><span class="data-number" id="data_nrSpeciesSeen">0</span> ${translations['dataSpeciesSeen']}</p>
                        </div>
                    </div>
                </div>
            </div>   

            <div class="separator"></div>
            </div>

            <div class="row justify-content-center text-center"> 
                <h3><span style="color: #e8de24">${translations['dataUserActivity']}</span></h3>
                <div class="separator"></div>
                </div>
            </div>
            
            <div class="row justify-content-center text-center"> 
                <div class="col-12 col-xl-5 col-lg-10 col-md-10">
                    <div class="">
                        <div class="box-background text-center">
                            <canvas id="bar-chart" width="400" height="300"></canvas>
                        </div>
                    </div>    
                </div>
            </div>

            <div class="separator"></div>
            </div>

            <div class="row justify-content-center text-center"> 
                <h3><span style="color: #e8de24">${translations['dataObservations']}</span></h3>
                <div class="separator"></div>
                </div>
            </div>

            <div class="row justify-content-center"> 
                <div class="col-12 col-xl-5 col-lg-10 col-md-10">
                    <div class="box-background">
                        <table id="obsTable" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>${translations['dataTableDate']}</th>
                                    <th>${translations['dataTableSpecies']}</th>
                                    <th>${translations['dataTableCount']}</th>
                                    <th>${translations['dataTableDetails']}</th>
                                </tr>

                            </thead>
                        </table>
                    </div>
                </div>
            </div>


        </div>

    </div>
    `
    // Attach the modal
    mb.innerHTML += renderModal(translations['123key'],translations['456key']);

    var dates = [];
    var monthCountArr = new Array(12).fill(0); 

    loadVisits().then(function(result) 
    {
        visits = result;
        console.log(visits);
        
        // Compute some statistics
        var total_observations = 0;
        var total_insects = 0;
        var total_species = 0;
        var species_id_list = [];
        var tableData = [];
        visits.forEach(elem => {
            total_observations += elem.data.observations.length;
            dates.push(elem.startdate);
            elem.data.observations.forEach(obs => {
                spName = getSpeciesName(obs.species_id);
                tableData.push([elem.startdate.slice(0, 10), spName, obs.number, obs.species_id]);
                total_insects += parseInt(obs.number);
                if(!species_id_list.includes(parseInt(obs.species_id)))
                {
                    species_id_list.push(parseInt(obs.species_id));
                    total_species++;
                }
            })
        });
        
        dates.forEach( date => {monthCountArr[new Date(date).getMonth()] += 1 }) ;
        document.getElementById('data_nrDataEntries').innerHTML = visits.length;
        document.getElementById('data_nrObservations').innerHTML = total_observations;
        document.getElementById('data_nrInsectsSeen').innerHTML = total_insects;
        document.getElementById('data_nrSpeciesSeen').innerHTML = total_species;

        new Chart(document.getElementById("bar-chart"), {
            type: 'bar',
            data: {
              labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
              datasets: [
                {
                  label: "Observations",
                  backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                  data: monthCountArr
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
        
        $(document).ready( function () {
            $('#obsTable').DataTable(
                {
                    data: tableData,
                    "scrollX": true,
                    columnDefs: [
                        {
                            targets: 3,
                            render: function (data, type, row, meta)
                            {
                                settings = getUserSettings();
                                datastring = `'This will redirect to website with details on ${data}'`;
                                data = '<a target="_blank" href="/userLoginWithToken?username='+settings.userSettings.email+'&token='+settings.userSettings.accessToken+'&redirect=/visit">edit</a>';
                                //data = '<a href="/userLoginWithToken?username='+settings.userSettings.email+'&token='+settings.userSettings.accessToken+'&redirect=https://showcase.vlinderstichting.nl/visit">edit</a>';
                                data = '<a href="#" onclick="alert(' + datastring + '); return false;">' + data + '</a>';
                                return data;
                            }
                        }
                    ]
                }
            );
        } );

    });
}

const showSettingsScreen = () =>
{
    // Get the settings and species
    var settings = getUserSettings();
    var translations = settings.translations;

    // Build the DOM
    renderNav();
    $("#backgroundDiv").css("background-image", "url('img/background_1920x1080_screen-statistics.png')");

    var happyButtonString = "";
    for (var i = 0; i < Object.keys(settings.speciesGroups).length; i++)
    {
        var sgu = settings.speciesGroups[Object.keys(settings.speciesGroups)[i]];
      //  var buttonName = "settings_selectButton_" + sgu.speciesgroup_id + "_" + sgu.recordinglevel_id;

        happyButtonString += `<div class="row" style="margin-top: 8px;"><img src="img/`+sgu.name+`.png" alt="" class="img-count-settings"><h3 style="text-align:center;color:black;font-size:200%;">`+sgu.name+`</h3><br>
                <div class="flex-radio-buttons mt-3">`;
                if (sgu.id == 1)
                {
                    happyButtonString += `<label class="container-radio-buttons"><i class="fas fa-bug" style="color: #fda230; font-size: 18px;"></i>
                        <input type="radio" data-sg="${sgu.name}" id="settings_selectButton_`+sgu.id + "_1" +`" name="`+sgu.name+`-check">
                        <span class="checkmark"></span>
                    </label>`;
                } 
                happyButtonString += `<label class="container-radio-buttons"><i class="fas fa-bug" style="color: #ffe421; font-size: 18px;"></i>
                        <input type="radio" data-sg="${sgu.name}" id="settings_selectButton_`+ sgu.id +`_2`+`" name="`+sgu.name+`-check">
                        <span class="checkmark"></span>
                    </label>
                    <label class="container-radio-buttons"><i class="fas fa-bug" style="color: #f5e590; opacity:0.5; font-size: 18px;"></i>
                        <input type="radio" data-sg="${sgu.name}" id="settings_selectButton_`+sgu.id + `_3" checked="checked" name="`+sgu.name+`-check">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>`;
    }

    var happyLangString = "";
    for(var i = 0; i < Object.keys(settings.availableTranslations).length;i++)
    {
        var lan = settings.availableTranslations[i];
        var selected = "";
        if (settings.availableTranslations[i] == settings.userSettings.preferedLanguage)
        {
            selected = " selected ";
        }
        happyLangString += '<option value="' + lan + '"'+selected+'>'+lan+'</option>';
    }

    var mb = document.getElementById('mainBody');
    mb.innerHTML = `
    <div class="container">
        <div class="row justify-content-center pt-5">
            <div class="col-md-12 text-center">
                <h2><span style="color: #ffe421" id="settings_title">${translations['settingsTitle']}</span></h2>
            
            </div>
            <div class="separator">
                
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-xl-5 col-lg-10 col-md-10">
                <h3><span style="color: #e8de24" id="settings_generalSettingsText">${translations['settingsGeneralTitle']}</span></h3>
                <div class="box-background">
                    <div class="row">
                        <p>${translations['settingsUser']} <span class="user-name" id="settings_userTable"></span></p>
                    </div>
                    <div class="row" style="margin-top: 8px;">
                        <p>${translations['settingsUseScientificNames']} <span class="user-name">   
                            <label class="switch">
                            <input type="checkbox" id="settings_useScientificNamesCheck">
                            <span class="slider round"></span>
                            </label>
                        </span>
                        </p>   
                    </div>
                    <div class="row" style="margin-top: 8px;">
                        <p>${translations['settingsShowPreviouslySeen']} <span class="user-name">   
                            <label class="switch">
                            <input type="checkbox" id="settings_showPreviouslySeenCheck">
                            <span class="slider round"></span>
                            </label>
                        </span>
                        </p>   
                    </div>
                    <div class="row" style="margin-top: 8px;">
                        <p>${translations['settingsShowCommonSpecies']} <span class="user-name">   
                            <label class="switch">
                            <input type="checkbox" id="settings_showCommonSpeciesCheck">
                            <span class="slider round"></span>
                            </label>
                        </span>
                        </p>   
                    </div>
                    <div class="row" style="margin-top: 8px;">
                        <p>Language <span class="user-name">   
                            <select name="setting_selectPreferedLanguage" id="setting_selectPreferedLanguage">
                            `+happyLangString+`
                            </select>
                        </span>
                        </p>   
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-12 text-center">
                            <button id="settings_logoutButton" class="btn-line">${translations['settingsLogOut']}</button><br><br>
                            <a href="/userLoginWithToken?username=`+settings.userSettings.email+`&token=`+settings.userSettings.accessToken+`&redirect=/settings">More settings (online)</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-5 col-lg-10 col-md-10 mb-3">
                <h3><span style="color: #e8de24">${translations['settingsWhatDoYouWantToCount']}</span></h3>
                <div class="">
                    <div class="row" style="margin-top: 8px;">   
                        <p><i class="fas fa-bug" style="color: #f5e590; opacity: 0.5; font-size: 18px;"></i> <span style="color: #B6F0BC; margin-bottom: 8px;">${translations['settingsNoCounts']}</span></p>
                    </div>
                    <div class="row">
                        <p><i class="fas fa-bug" style="color: #ffe421; font-size: 18px;"></i> <span style="color: #B6F0BC;">${translations['settingsCountGroup']}</span></p>
                    </div>
                    <div class="row">
                        <p><i class="fas fa-bug" style="color: #fda230; font-size: 18px;"></i> <span style="color: #B6F0BC;">${translations['settingsCountSpecies']}</span></p>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-6">
                        `+happyButtonString+`
                    </div>
                </div>
            </div>
        </div>
    </div>
    `
    // Populate the data
    $("#settings_userTable").html(settings.userSettings.name);
    $("#settings_registeredAtTable").html(settings.userSettings.settingsSynchedAt); //NOTE THIS IS NOT THE RIGHT FIELD, DOES NOT EXIST YET IN DATABASE
    if (settings.userSettings.sci_names)
    {
        $('#settings_useScientificNamesCheck').prop('checked', true);
    }
    if (settings.userSettings.showOnlyCommonSpecies)
    {
        $('#settings_showCommonSpeciesCheck').prop('checked', true);
    }
    if (settings.userSettings.showPreviouslyObservedSpecies)
    {
        $('#settings_showPreviouslySeenCheck').prop('checked', true);
    }

    // We can attach butterfly
//    var recButterfly = settings.userSettings.speciesGroupsUsers.butterflies.recordinglevel_id;
//        $('#settings_selectButtonButterflies'+recButterfly).prop('checked', true);
    // We can attach bees
//    var recBees = settings.userSettings.speciesGroupsUsers.bees.recordinglevel_id;
//        $('#settings_selectButtonBees'+recBees).prop('checked', true);
    // We can attach birds
//    var recBirds = settings.userSettings.speciesGroupsUsers.birds.recordinglevel_id;
//        $('#settings_selectButtonBirds'+recBirds).prop('checked', true);


    for (var i = 0; i < Object.keys(settings.speciesGroups).length; i++)
    {
        var sg = settings.speciesGroups[Object.keys(settings.speciesGroups)[i]];
        var sgu = settings.userSettings.speciesGroupsUsers[sg.name];
        var recId = 3;
        if (sgu != null)
        {
            recId = sgu.recordinglevel_id;
        }
        var elem = document.getElementById('settings_selectButton_'+sg.id + "_" + recId);
        if (elem==null)
        {
           // console.log("error with: " + 'settings_selectButton_'+sg.id + "_" + recId);
        }
        else 
        {
            elem.checked = true;
        }
    }


    // Attach the events
    $('#settings_useScientificNamesCheck').click( function () 
    {
        settings = getUserSettings();
        userSettings.userSettings.sci_names = $(this).is(':checked');
        storeSettingsInDatabase();
    });
    $('#settings_showCommonSpeciesCheck').click( function () 
    {
        currentSettings = getUserSettings().userSettings;
        currentSettings.showOnlyCommonSpecies = $(this).is(':checked');
        storeSettingsData('userSettings', currentSettings);

    });
    $('#settings_showPreviouslySeenCheck').click( function () 
    {
        currentSettings = getUserSettings().userSettings;
        currentSettings.showPreviouslyObservedSpecies = $(this).is(':checked');
        storeSettingsData('userSettings', currentSettings);
    });
    $('#setting_selectPreferedLanguage').change( function () 
    {
        var elem = document.getElementById('setting_selectPreferedLanguage');
        var selectedValue = elem.value;
        settings = getUserSettings();
        userSettings.userSettings.preferedLanguage = selectedValue;
        storeSettingsInDatabase();
        synchWithServer();
    });

    $('#settings_logoutButton').click( function () 
    {
        logout();
    })

    recordingLevelTranslator = {
            1: "species",
            2: "group",
            3: "none"
        };

     function setStuff(name, id) 
        {
            currentSettings = getUserSettings().userSettings;
            currentSettings.speciesGroupsUsers[name].recordinglevel_id = id; 
            currentSettings.speciesGroupsUsers[name].recordinglevel_name = recordingLevelTranslator[id];
            storeSettingsData('userSettings', currentSettings);
        }

    for (var i = 0; i < Object.keys(settings.speciesGroups).length; i++)
    {
        var sg = settings.speciesGroups[Object.keys(settings.speciesGroups)[i]];
        var elem = document.getElementById("settings_selectButton_" + sg.id + "_" + 1);
        if (elem != null)
        {
            elem.onclick = function() {setStuff(this.dataset.sg, 1)};
        }
        var elem = document.getElementById("settings_selectButton_" + sg.id + "_" + 2);
        if (elem != null)
        {
            elem.onclick = function() {setStuff(this.dataset.sg, 2)};
        }
        var elem = document.getElementById("settings_selectButton_" + sg.id + "_" + 3);
        if (elem != null)
        {
            elem.onclick = function() {setStuff(this.dataset.sg, 3)};
        }        
    }
}

function showMessage(message)
{
    data = JSON.parse(atob(message));
    $('#modal_title').text(data.header);
    mod_body = data.content;
    mod_body += '<hr>';
    if (data.image_primary != "")
    {
        mod_body += `
        <a href="${ data.image_primary }"><img src="${ data.image_primary }" class="img-thumbnail" alt="..." style="max-width:200px"></img></a>
        `;
    }
    if (data.image_secondary != "")
    {
        mod_body += `
        <a href="${ data.image_secondary }"><img src="${ data.image_secondary }" class="img-thumbnail" alt="..." style="max-width:200px"></img></a>
        `;
    }
    $('#modal_body').html(mod_body);
    var myModal = new bootstrap.Modal(document.getElementById('modal_id'));
    myModal.show();

}

const showMessagesScreen = () =>
{
    var settings = getUserSettings();
    var messages = Object.values(settings.messages);
    var translations = settings.translations;

    renderNav();
    $("#backgroundDiv").css("background-image", "url('img/background_1920x1080_screen-statistics.png')");

    var mb = document.getElementById('mainBody');

    messagesHTML = '';
    for(var i = 0; i < messages.length; i++)
    {
        if (messages[i].receivedate)
        {
            read = true;
            readdate = messages[i].receivedate;
            styling = '';
        }
        else
        {
            read = false;
            readdate = `${translations['messagesTitle']}`;
            styling = 'style="font-weight:bold;"';
        }
        messArg = JSON.stringify(messages[i])
        messagesHTML += 
            `<a onclick="showMessage( '${ btoa(messArg)}' );" class="list-group-item list-group-item-action" aria-current="true">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1" ${styling}>${ messages[i].header }</h5>
                    <small ${styling}>${ messages[i].senddate }</small>
                </div>
                <p class="mb-1" ${styling}>${ messages[i].content.truncate(80, true) }</p>
                <small ${styling}>${readdate}</small>
            </a>`
    }

    mb.innerHTML = renderModal('', '') + `
    <div class="container mt-5 mb-3">
        <div class="row">
            <div class="col">
                <div class="card">
                    <h5 class="card-header">${translations['messagesTitle']}</h5>
                    <div class="card-body">
                        <div class="list-group">
                            ${ messagesHTML }
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </container>`;
}
