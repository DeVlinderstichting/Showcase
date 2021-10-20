var renderNav = function()
{
    var nav = document.getElementById("nav");
    // Build the DOM
    nav.innerHTML =`
    <a class="navbar-brand" id="nav_homeLink" href="#">Showcase</a>
    <a class="nav-link active" id="nav_dataLink" aria-current="page" href="#"><i class="fas fa-chart-pie"></i></a>
    <a class="nav-link active" id="nav_settingsLink" aria-current="page" href="#"><i class="fas fa-cog"></i></a>
    <a class="nav-link active" id="nav_messagesLink" aria-current="page" href="#"><i class="far fa-envelope"></i></a>
    <a class="nav-link active" id="nav_logoutLink" aria-current="page" href="#"><i class="fas fa-sign-out-alt"></i></a>
    `
    // Attach the events 
    document.getElementById("nav_homeLink").onclick = function () {showHomeScreen(); };
    document.getElementById("nav_dataLink").onclick = function () {showDataScreen('observationSettings/messages.txt'); };
    document.getElementById("nav_settingsLink").onclick = function () {showSettingsScreen(); };
    document.getElementById("nav_messagesLink").onclick = function () {showMessagesScreen('observationSettings/messages.txt'); };
    document.getElementById("nav_logoutLink").onclick = function () {showLoginScreen(); };
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
    var nav = document.getElementById("nav");
    nav.innerHTML = `
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Showcase</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#toggle" aria-controls="toggle" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="toggle">
            <ul class="navbar-nav ms-auto mb-2 mb-md-0">
            <li class="nav-item">
                <a class="nav-link active" id="installButton" aria-current="page" href="#">Add to home screen</a>
            </li>
            </ul>
        </div>
    </div>`;

var mb = document.getElementById('mainBody');
    // Build the DOM
    mb.innerHTML = `
        <div>
            <label for="login_emailField">Email address: 
            <input type="text" id="login_emailField" name="login_emailField" required size="10">
        </div>
        <div>
            <label for="login_emailField">Password: 
            <input type="password" id="login_passField" name="login_passField" required size="10">
        </div>
        <div>
            <input type="checkbox" id="login_rememberField" name="login_rememberField">
            <label for="login_rememberField">Remember me</label>
        </div>
        
        <button type="button" id="login_loginButton">Inloggen</button>`;

    // Attach the events
    document.getElementById("login_loginButton").onclick = function () {attemptLogin(); };
}

const showHomeScreen = () => 
{
    renderNav();

    // Build the DOM
    var mb = document.getElementById('mainBody');
    mb.innerHTML = `
    <div>
        <button id="home_specialButton">Something special</button>
    </div>
    <div>
        <button id="home_15Button">15 min</button>
    </div>
    <div>
        <button id="home_transectButton">Transect</button>
    </div>
    <div>
        <button id="home_fitButton">Fit</button>
    </div>`;

    // Attach the events
    document.getElementById("home_specialButton").onclick = function () { showSpecialObservationScreen(); };
    document.getElementById("home_15Button").onclick = function () { show15mObservationScreen(); };
    document.getElementById("home_fitButton").onclick = function () { showFitPreObservationScreen(); };
    document.getElementById("home_transectButton").onclick = function () { showTransectObservationScreen(); };
}

const showSpecialObservationScreen = () =>
{
    initAnyCount(1);
    // Get the settings and species
    var settings = getUserSettings();
    var species = settings.species;
    var translations = settings.translations;
    var speciesGroups = settings.speciesGroups;
    var countIds =  Object.values(speciesGroups).filter(obj => {return obj.userCanCount === true}).map( function (el) { return el.id; });

    renderNav();
    // Build the DOM
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
        if (countIds.includes(value['speciesgroupId']))
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
    initAnyCount(2);

    // Get the settings and species
    var settings = getUserSettings();
    var species = settings.species;
    var translations = settings.translations;
    var speciesGroups = settings.speciesGroups;
    var countIds =  Object.values(speciesGroups).filter(obj => {return obj.userCanCount === true}).map( function (el) { return el.id; });

    renderNav();
    // Build the DOM
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
    
    // Attach the modal
    mb.innerHTML += renderModal(translations['123key'],translations['456key']);
    mb.innerHTML += renderModal('Note','Please start the count first to track your location...', 'no_loc');

    // Populate the list of species and attach the chosen selector
    $.each(species, function(key, value) 
    {
        if (countIds.includes(value['speciesgroupId']))
        {
            $('#15m_selectSpecies').append(`<option value="${key}">${value['localName']}</option>`);
        }
    });
    $('.chosen-select').select2();

    // Attach the events
    document.getElementById("15m_buttonSave").onclick = function () {  stopTimer(); storeTimedCount(); }; //stopTimer, just in case it was still going
    document.getElementById("15m_buttonCancel").onclick = function () { stopTimer(); showHomeScreen(); }; //stopTimer, just in case it was still going
    document.getElementById("startTimer").onclick = function () { startTimer(); };
    document.getElementById("pauseTimer").onclick = function () { stopTimer(); };
    document.getElementById("resetTimer").onclick = function () { resetTimer(); };
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
                console.log(timeToDelete);
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

const showFitPreObservationScreen = () =>
{
    initAnyCount(4);
    // Get the settings and species
    var settings = getUserSettings();
    var species = settings.species;
    var translations = settings.translations;
    var speciesGroups = settings.speciesGroups;
    var countIds =  Object.values(speciesGroups).filter(obj => {return obj.userCanCount === true}).map( function (el) { return el.id; });

    renderNav();
    // Build the DOM
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
        if (value['speciesgroupId'] == 4) // Note that the ID might change in the future
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
    var countIds =  Object.values(speciesGroups).filter(obj => {return obj.userCanCount === true}).map( function (el) { return el.id; });
    obsfit = [];
    renderNav();
    // Build the DOM
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
    
    // Attach the modal
    mb.innerHTML += renderModal(translations['123key'],translations['456key']);

    // Populate the list of species and attach the chosen selector
    $.each(species, function(key, value) {
        if (countIds.includes(value['speciesgroupId']))
        {
            $('#fit_selectSpecies').append(`<option value="${key}">${value['localName']}</option>`);
        }
    });

    $('.chosen-select').select2();

    document.getElementById("fit_buttonSave").onclick = function () {  stopTimer(); storeFitCount(); }; //stopTimer, just in case it was still going
    document.getElementById("fit_buttonCancel").onclick = function () { stopTimer(); showHomeScreen(); }; //stopTimer, just in case it was still going
    document.getElementById("startTimer").onclick = function () { startTimer(); };
    document.getElementById("pauseTimer").onclick = function () { stopTimer(); };
    document.getElementById("resetTimer").onclick = function () { resetTimer(); };

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



    $(`#fit_plusAmount_${speciesInfo['id']}`).click( function () 
    {
        var spId = $(this).get(0).id.replace("fit_plusAmount_", "");
        var num = document.getElementById('fit_inputAmount_' . spId).value;
        addObservationToVisit(spId, num, trackedLocations[trackedLocations.length - 1]);
    });    
}

const showTransectObservationScreen = () =>
{
    initAnyCount(3);
    // Get the settings and species
    var settings = getUserSettings();
    var species = settings.species;
    var translations = settings.translations;
    var speciesGroups = settings.speciesGroups;
    var countIds =  Object.values(speciesGroups).filter(obj => {return obj.userCanCount === true}).map( function (el) { return el.id; });

    renderNav();
    // Build the DOM
    var mb = document.getElementById('mainBody');
    mb.innerHTML = `
    <h2 id="transect_title">Title</h2>
    <h3 id="transect_subtitle">Subtitle</h3>
    <div>
        <button id="transect_buttonInfo" data-bs-toggle="modal" data-bs-target="#modal_id">Info</button>
    </div>
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

    // Populate the list of species and attach the chosen selector
    $.each(species, function(key, value) {
        if (countIds.includes(value['speciesgroupId']))
        {
            $('#transect_selectSpecies').append(`<option value="${key}">${value['localName']}</option>`);
        }
    });
    $('.chosen-select').select2();

    // Attach the events
    document.getElementById("transect_buttonSave").onclick = function () { }; 
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
        });
    }
}