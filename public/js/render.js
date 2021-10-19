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

var renderModal = function(title, body)
{
    html = `
        <!-- Modal -->
            <div class="modal fade" id="modal_id" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
}

const showSpecialObservationScreen = () =>
{
    // Get the settings and species
    var settings = getUserSettings();
    var species = settings.species;
    var translations = settings.translations;

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
    
    // Populate the list of species and attach the chosen selector
    $.each(species, function(key, value) {
        $('#special_selectSpecies').append(`<option value="${key}">${value['localName']}</option>`);
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

    // Populate the list of species and attach the chosen selector
    $.each(species, function(key, value) {
        $('#15m_selectSpecies').append(`<option value="${key}">${value['localName']}</option>`);
    });
    $('.chosen-select').select2();

    // Attach the events
    document.getElementById("15m_buttonSave").onclick = function () { stopTimer(); }; //stopTimer, just in case it was still going
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
                <button id="15m_minAmount_${speciesInfo['id']}" onclick="$('#15m_inputAmount_${speciesInfo['id']}').get(0).value--; $('#15m_inputAmount_${speciesInfo['id']}').change();">-</button>
                <input id="15m_inputAmount_${speciesInfo['id']}" name="15m_inputAmount_${speciesInfo['id']}" value=0>
                <button id="15m_plusAmount_${speciesInfo['id']}" onclick="$('#15m_inputAmount_${speciesInfo['id']}').get(0).value++; $('#15m_inputAmount_${speciesInfo['id']}').change();">+</button>
            </li>
        `)
        $(`#15m_selectSpecies option[value='${speciesInfo['id']}']`).remove();

        // Make sure we get proper input on change of the number input
        $(`#15m_inputAmount_${speciesInfo['id']}`).change( function () 
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
    
    // The stopwatch logic
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
    }

    function resetTimer()
    {
        stopWatchTimeLeft = stopwatchMinutes*60000;
        stopwatchCurrentTime = new Date();
        stopwatchFutureTime = new Date(stopwatchCurrentTime.getTime() + stopWatchTimeLeft);
        document.getElementById("stopwatch").innerHTML = msToTime(stopWatchTimeLeft);
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
}