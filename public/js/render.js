var renderNav = function()
{
    var nav = document.getElementById("nav");
    nav.innerHTML =`
    <div class="container-fluid">
        <a class="navbar-brand" href="#" onclick="showHomeScreen()">Showcase</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#toggle" aria-controls="toggle" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="toggle">
            <ul class="navbar-nav ms-auto mb-2 mb-md-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#" onclick="showDataScreen('observationSettings/messages.txt');"><i class="fas fa-chart-pie"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#" onclick="showSettingsScreen();"><i class="fas fa-cog"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#" onclick="showMessagesScreen('observationSettings/messages.txt');"><i class="far fa-envelope"></i></a>
            </li>
            </ul>
        </div>
    </div>`;
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
    mb.innerHTML = `

        <div>
            <label for="emailField">Email address: 
            <input type="text" id="emailField" name="emailField" required size="10">
        </div>
        <div>
            <label for="emailField">Password: 
            <input type="password" id="passField" name="passField" required size="10">
        </div>
        <div>
            <input type="checkbox" id="rememberField" name="rememberField">
            <label for="rememberField">Remember me</label>
        </div>
        
        <button type="button" onclick="attemptLogin();">Inloggen</button> 

        `;
}

const showHomeScreen = () => 
{
    renderNav();

    var mb = document.getElementById('mainBody');
    mb.innerHTML = `
    <div class="container mt-5 mb-3">
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col">
                <div class="card" onclick="showEnterObservationScreen('observationSettings/settings_opportunistic.txt', 'observationSettings/species.txt');">
                    <img src="images/ijsvogel.jpg" class="card-img-top" alt="...">
                    <div class="card-img-overlay">
                        <h5 class="card-title text-white">I saw something special</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Opportunistic observation</p>
                        <a onclick="showEnterObservationScreen('observationSettings/settings_opportunistic.txt', 'observationSettings/species.txt');" class="btn btn-primary" style="z-index: 9; position: sticky;">Enter observation</a>                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" onclick="showEnterObservationScreen('observationSettings/settings_15m.txt', 'observationSettings/species.txt');">
                <img src="images/time-839884_1920.jpg" class="card-img-top" alt="...">
                <div class="card-img-overlay">
                    <h5 class="card-title text-white">15 minute count</h5>
                </div>
                    <div class="card-body">
                        <p class="card-text">Count everything you see for 15 minutes</p>
                        <a onclick="showEnterObservationScreen('observationSettings/settings_15m.txt', 'observationSettings/species.txt');" class="btn btn-primary" style="z-index: 9; position: sticky;">Start 15m</a>
                       </div>
                </div>
            </div>
            <div class="col">
                <div class="card" onclick="showEnterObservationScreen('observationSettings/settings_transect.txt', 'observationSettings/species.txt');">
                <img src="images/mountaineering-455338_1280.jpg" class="card-img-top" alt="...">
                <div class="card-img-overlay">
                    <h5 class="card-title text-white">Walk transect</h5>
                </div>
                    <div class="card-body">
                        <p class="card-text">Walk a predefined transect and record everything you see</p>
                        <a onclick="showEnterObservationScreen('observationSettings/settings_transect.txt', 'observationSettings/species.txt');" class="btn btn-primary" style="z-index: 9; position: sticky;">Start transect</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" onclick="showEnterObservationScreen('observationSettings/settings_fit.txt', 'observationSettings/species.txt');">
                    <img src="images/Sanguisorba_minor_01AK.jpg" class="card-img-top" alt="...">
                    <div class="card-img-overlay">
                        <h5 class="card-title text-white">Fit count</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Observe a single flower, record everything you see interacting with that flower</p>
                        <a onclick="showEnterObservationScreen('observationSettings/settings_fit.txt', 'observationSettings/species.txt');" class="btn btn-primary" style="z-index: 9; position: sticky;">Start counting</a>
                    </div>
                </div>
            </div>
        </div>
    </container>`;
}