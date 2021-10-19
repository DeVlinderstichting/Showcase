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
        <input type="number" id="special_inputAmount" name="special_inputAmount" min=0>
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
    document.getElementById("special_buttonSave").onclick = function () { };
    document.getElementById("special_buttonCancel").onclick = function () { showHomeScreen(); };
}

const show15mObservationScreen = () =>
{
    // Get the settings and species
    var settings = getUserSettings();
    var species = settings.species;

    renderNav();
    // Build the DOM
    var mb = document.getElementById('mainBody');
    mb.innerHTML = `
    <div>
        <button id="special_buttonInfo">Info</button>
    </div>
    <div>
        <i class="fas fa-stopwatch"></i> <span id="stopwatch">15:00:00</span> <i class="fas fa-play" id="startTimer"></i> <i class="fas fa-pause" id="pauseTimer"></i> <i class="fas fa-undo" id="resetTimer"></i>
    </div>
    <div>
        <label for="special_selectSpecies">Species</label>
        <select class="chosen-select" name="special_selectSpecies" id="special_selectSpecies">
            <option value=1>Species 1</option>
            <option value=2>Species 2</option>
            <option value=3>Species 3</option>
            <option value=4>Species 4</option>
        </select>
    </div>
    <div>
        <label for="special_inputAmount">Amount</label>
        <input type="number" id="special_inputAmount" name="special_inputAmount" min=0>
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
    document.getElementById("special_buttonSave").onclick = function () { };
    document.getElementById("special_buttonCancel").onclick = function () { showHomeScreen(); };
    document.getElementById("startTimer").onclick = function () { startTimer(); };
    document.getElementById("pauseTimer").onclick = function () { stopTimer(); };
    document.getElementById("resetTimer").onclick = function () { resetTimer(); };

    // The stopwatch logic
    var stopwatchCurrentTime;
    var stopwatchFutureTime;
    var stopWatchTimer;

    function startTimer() {
        stopwatchCurrentTime = new Date();
        stopwatchFutureTime = new Date(stopwatchCurrentTime.getTime() + 15*60000);
        stopWatchTimer = setInterval(timer, 100);
    }

    function resumeTimer() {    
        stopWatchTimer = setInterval(start, 1000);
    }

    function timer() {
        var d = new Date();
        remTime = stopwatchFutureTime - d;
        document.getElementById("stopwatch").innerHTML = remTime;
    }

    function stopTimer() {
        clearInterval(stopWatchTimer)
    }
}



