
String.prototype.truncate = String.prototype.truncate || 
function ( n, useWordBoundary ){
  if (this.length <= n) { return this; }
  const subString = this.substr(0, n-1); // the original check
  return (useWordBoundary 
    ? subString.substr(0, subString.lastIndexOf(" ")) 
    : subString) + "&hellip;";
};

const container = document.querySelector(".container")
const butterflies = [
  { name: "bf1", image: "images/bf1.jpg" },
  { name: "fb2", image: "images/bf2.jpg" },
  { name: "bf3", image: "images/bf3.jpg" },
  { name: "bf4", image: "images/bf4.jpg" },
  { name: "bf5", image: "images/bf5.jpg" },
  { name: "bf6", image: "images/bf6.jpg" },
]

const showButterflies = () => 
{
    let output = ""
    butterflies.forEach(
    ({ name, image }) =>
        (output += `
            <div class="card">
                <img class="card--avatar" src=${image} />
                <h1 class="card--title">${name}</h1>
                <a class="card--link" href="#">This one is awesome</a>
            </div>
        `)
    )
    container.innerHTML = output
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
    <div class="logdiv text-center">
        <div class="form-signin">
            <form>
                <img class="mb-4" src="images/logo.png" alt="" width="72" height="57">
                <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

                <div class="form-floating">
                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>

                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
                <a role="button" onclick="showHomeScreen()" class="w-100 btn btn-lg btn-primary" type="submit">Login</a>
                <p class="mt-5 mb-3 text-muted">&copy; Deik ben een test Vlinderstichting ik ben bloedserieus 2021</p>
            </form>
        </div>
    </div>`;
}

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


function showMessage(message)
{
    data = JSON.parse(atob(message));
    $('#modal_title').text(data.header);
    mod_body = data.body;
    mod_body += '<hr>';
    if (data.main_image != "")
    {
        mod_body += `
        <a href="${ data.main_image }"><img src="${ data.main_image }" class="img-thumbnail" alt="..." style="max-width:200px"></img></a>
        `;
    }
    if (data.detail_image != "")
    {
        mod_body += `
        <a href="${ data.detail_image }"><img src="${ data.detail_image }" class="img-thumbnail" alt="..." style="max-width:200px"></img></a>
        `;
    }
    $('#modal_body').html(mod_body);
    var myModal = new bootstrap.Modal(document.getElementById('modal_id'));
    myModal.show();

}

async function showMessagesScreen (messagesFile)
{

    let response = await fetch(messagesFile);
    let responseText = await response.json();
    renderNav();

    var mb = document.getElementById('mainBody');

    messagesHTML = '';
    for(var i = 0; i < responseText.messages.length; i++)
    {
        act = '';
        if (i==0) act = 'active';
        messArg = JSON.stringify(responseText.messages[i])
        messagesHTML += 
            `<a onclick="showMessage( '${ btoa(messArg)}' );" class="list-group-item list-group-item-action ${ act }" aria-current="true">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">${ responseText.messages[i].header }</h5>
                    <small>${ responseText.messages[i].timestamp }</small>
                </div>
                <p class="mb-1">${ responseText.messages[i].body.truncate(80, true) }</p>
                <small>Unread</small>
            </a>`
    }

    mb.innerHTML = renderModal('', '') + `
    <div class="container mt-5 mb-3">
        <div class="row">
            <div class="col">
                <div class="card">
                    <h5 class="card-header">Messages</h5>
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

//const async showEnterObservationScreen = (settingsFile, speciesFile) =>
async function showEnterObservationScreen (settingsFile, speciesFile)
{
    let response = await fetch(settingsFile);
    let responseText = await response.json();

    renderNav();

    var mb = document.getElementById('mainBody');

    var html = `
    <div class="container mt-5 mb-3">
        <div class="col">
            <div class="card">
                <h5 class="card-header">Enter your data</h5>
                <div class="card-body">`
    
    if (responseText.name != "")
    {
        html += `<h5>` + responseText.name + `</h5>`;
    }
    
    html += `
        <form>
            <div class="row g-3 align-items-center mb-3">
        `;

    if (responseText.time != "0")
    {
        html += `
        <div class="col">
            <label  class="col-form-label">15:00:00</label>
            <button class="btn btn-primary btn-sm">Stop counting</button>

        </div>`;
    }
    else
    {
        html += `
        <div class="col">
            <label  class="col-form-label"></label>
        </div>`;
    }
    if (responseText.locations.length >1)
    {
        html += `
        <div class="col" style="display:flex">
            <button type='button' class="btn btn-primary btn-sm"><</button><input type="number" id="location_id" class="form-control"><button type='button' class="btn btn-primary btn-sm">></button></td>
        </div>`;
    }
    
    html += `
    <div class="col">
        <button class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#modal_id">Info</button>
    </div></div>`;

    html += `
    <div class="row g-3 align-items-center mb-3">
        <div class="col-2">
            <label for="searchField" class="col-form-label">Search</label>
        </div>
        <div class="col-10">
            <select name='species_id' id='species_id' class='form-select chosen-select'>`;
    
    spPrevSeen = "";
    for(var i = 0; i < responseText.species.length; i++)
    {        
        if (responseText.species[i].prevSeen == 0)
        {
            html += "<option value='" + responseText.species[i].id + "'>"+ responseText.species[i].name + "</option>";
        }
        else 
        {
            spPrevSeen += "<tr><td>" + responseText.species[i].name + `</td><td style="display:flex"><button class="btn btn-primary btn-sm" type='button'>-</button><input type="number" id=spec_"` + responseText.species[i].id + `id" class="form-control"><button class="btn btn-primary btn-sm" type='button'>+</button></td></tr>`;
        }
    }
    html += "</select></div></div>";

    html += `<div class="row g-3 align-items-center mb-3"><div class="col"><h5>Species</h5><table class="table table-borderless">`;
    html +=  spPrevSeen
    html += `</table></div></div>`;
    html += `<div class="row g-3 align-items-center mb-3"><div class="col-auto"><button onclick="showFinalizeObservationScreen();" class="btn btn-primary" type='button'>Save</button>`;
    html += `<button class="btn btn-primary ms-2" type='button' onclick="showHomeScreen()">Cancel</button></div></div>`;
    html += `</form></div></div></div></div>`;
    
    html += renderModal('Extra Information', responseText.infoblok);

   // html = responseText.name;
    mb.innerHTML = html;
    $('.chosen-select').select2({ width: '100%' });

}

function showFinalizeObservationScreen()
{
    renderNav();
    var mb = document.getElementById('mainBody');
    var html = `
    <div class="container mt-5 mb-3">
        <div class="row">
            <div class="col">
                <div class="card">
                    <h5 class="card-header">Finalize observation</h5>
                    <div class="card-body">
                        <table class="table table-borderless" id="obsTable">
                            <thead>
                                <th>Speciesgroup</th>
                                <th>Number</th>
                            </thead>
                            <tbody>
                                <tr><td>Butterflies</td><td>3</td>
                                <tr><td>Dragonflies</td><td id="dfRow">Not recorded  <i onclick="observationFinalizeToggleRow('dfRow');" class="fas fa-binoculars" style="font-size:24px;color:green"></i></td>
                                <tr><td>Moths</td><td>4</td>
                                <tr><td>Birds</td><td id="birdRow">Not recorded  <i onclick="observationFinalizeToggleRow('birdRow');" class="fas fa-binoculars" style="font-size:24px;color:green"></i></td>
                            </tbody>
                        <table>
                    </div>
                    <div class="card-body">
                        <b>Extra information</b>
                        <table class="table table-borderless" id="obsTable">
                            <thead>
                                <th>Question</th>
                                <th>Answer</th>
                            </thead>
                            <tbody>
                                <tr><td>Cloudcover</td><td><select class="form-select" id="cloudcover">
                                    <option value="1">1/8</option>
                                    <option value="2">2/8</option>
                                    <option value="3">3/8</option>
                                    <option value="4">4/8</option>
                                    <option value="5">5/8</option>
                                    <option value="6">6/8</option>
                                    <option value="7">7/8</option>
                                    <option value="8">8/8</option>
                                    </select></td>
                                <tr><td>Windspeed</td><td><select class="form-select" id="windspeed">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option></td>
                                <tr><td>Temperature</td><td><input type="number" class="form-control" id="temperature" name="temperature" min="-10" max="52"></td>
                            </tbody>
                        </table>
                        <button class="btn btn-primary ms-2" type='button' onclick="showHomeScreen()">Submit</button>
                        <button class="btn btn-primary ms-2" type='button' onclick="showHomeScreen()">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <script>function observationFinalizeToggleRow()
    </div>`;
    mb.innerHTML = html;
}
function observationFinalizeToggleRow(rowId)
{
    var item = document.getElementById(rowId);
    html = "";
    if (item.innerHTML.indexOf("Not recorded") !== -1) 
    {
        html = `Recorded, not seen  <i onclick='observationFinalizeToggleRow("`+rowId+`");' class='fas fa-binoculars' style='font-size:24px;color:red'></i>`;
    }
    else 
    {
        html = `Not recorded  <i onclick='observationFinalizeToggleRow("`+rowId+`");' class='fas fa-binoculars' style='font-size:24px;color:green'></i>`;
    }
    item.innerHTML = html;
}

function showDataScreen ()
{
    renderNav();

    var mb = document.getElementById('mainBody');

    var html = `
    <div class="container mt-5 mb-3">
        <div class="row">
            <div class="col">
                <div class="card">
                    <h5 class="card-header">Data overview</h5>
                    <div class="card-body">
                        <h1 class="visually-hidden">Features examples</h1>
                        <div class="container px-4 py-2" id="featured-3">
                            <div class="row g-4 py-2 row-cols-1 row-cols-lg-4">
                                <div class="feature col">
                                    <div class="feature-icon bg-primary bg-gradient">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                    <h2 style="display: inline">103</h2>
                                    <p>Data entries</p>
                                </div>
                                <div class="feature col">
                                    <div class="feature-icon bg-primary bg-gradient">
                                        <i class="fas fa-search"></i>
                                    </div>
                                    <h2 style="display: inline">472</h2>
                                    <p>Observations</p>
                                </div>
                                <div class="feature col">
                                    <div class="feature-icon bg-primary bg-gradient">
                                        <i class="fas fa-bug"></i>
                                    </div>
                                    <h2 style="display: inline">2673</h2>
                                    <p>Insects seen</p>
                                </div>
                                <div class="feature col">
                                    <div class="feature-icon bg-primary bg-gradient">
                                        <i class="fas fa-bug"></i>
                                    </div>
                                    <h2 style="display: inline">6</h2>
                                    <p>Species groups seen</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <div class="row row-cols-1 row-cols-md-2 g-4">
                <div class="col">
                    <div class="card h-100">
                    <h5 class="card-header">User activity</h5>
                    <div class="card-body">
                        <canvas id="bar-chart" width="400" height="300"></canvas>
                    </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <h5 class="card-header">Observations</h5>
                        <div class="card-body">
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
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>`

    mb.innerHTML = html;

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

const showSettingsScreen = () => 
{
    renderNav();

    var mb = document.getElementById('mainBody');

    var html = `
    <div class="container mt-5 mb-3">
        <div class="row mt-3">
            <div class="col">
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <div class="col">
                        <div class="card h-100">
                        <h5 class="card-header">General settings</h5>
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tr>
                                        <td>User</td>
                                        <td>A.J. de Vries</td>
                                    </tr>
                                    <tr>
                                        <td>Registerd at</td>
                                        <td>2021-04-01</td>
                                    </tr>
                                    <tr>
                                        <td>Logout</td>
                                        <td><button onclick="showLoginScreen();" class="btn btn-primary btn-sm"><i class="fas fa-sign-out-alt"></i> Logout</button></td>
                                    </tr>
                                    <tr>
                                        <td>Use scientific names</td>
                                        <td><div class="form-check form-switch"><input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"></div></td>
                                    </tr>
                                    <tr>
                                        <td>Show previously seen</td>
                                        <td><div class="form-check form-switch"><input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"></div></td>
                                    </tr>
                                    <tr>
                                        <td>Show common species</td>
                                        <td><div class="form-check form-switch"><input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"></div></td>
                                    </tr>                                               
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <h5 class="card-header">What do you want to count</h5>
                            <div class="card-body text-center">
                                <div class="alert alert-light" role="alert">
                                    Red (<span style="color: #f00c0c">&#x25A2</span>): no counts<br>
                                    Orange (<span style="color: #f0b70c">&#x25A2</span>): count number within group (not at species level)<br>
                                    Green (<span style="color: #29f00c">&#x25A2</span>); count species within group
                                </div>
                                <img onclick="toggleColor(this)" id="countSettingButterfly" src="images/bf5.jpg" class="img-tgl img-thumbnail" alt="..." style="margin: 3px; width: 200px; height:200px">
                                <img onclick="toggleColor(this)" id="countSettingBee" src="images/bij.jpg" class="img-tgl img-thumbnail" alt="..." style="margin: 3px; width: 200px; height:200px">
                                <img onclick="toggleColor(this)" id="countSettingFlower" src="images/plant.jpg" class="img-tgl img-thumbnail" alt="..." style="margin: 3px; width: 200px; height:200px">
                                <img onclick="toggleColor(this)" id="countSettingBird" src="images/vogel.jpg" class="img-tgl img-thumbnail" alt="..." style="margin: 3px; width: 200px; height:200px">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>`

    mb.innerHTML = html;
    setColor();

}

function hexToRgb(hex) {
  // Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")
  var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
  hex = hex.replace(shorthandRegex, function(m, r, g, b) {
    return r + r + g + g + b + b;
  });

  var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
  return result ? `rgb(${parseInt(result[1], 16)}, ${parseInt(result[2], 16)}, ${parseInt(result[3], 16)})` : null;
}

function toggleColor(elem)
{
    curCol = elem.style.backgroundColor;
    if (curCol==hexToRgb('#f00c0c'))
    {
        elem.style.backgroundColor = hexToRgb('#f0b70c');
    }
    if (curCol==hexToRgb('#f0b70c'))
    {
        elem.style.backgroundColor = hexToRgb('#29f00c');
    }
    if (curCol==hexToRgb('#29f00c'))
    {
        elem.style.backgroundColor = hexToRgb('#f00c0c');
    }    
}

function setColor()
{
    $('.img-tgl').each(function(){
        $(this).css('background-color', '#f00c0c');
    });
}

document.addEventListener("DOMContentLoaded", showLoginScreen)

if ("serviceWorker" in navigator) 
{
	window.addEventListener("load", function() 
	{
    	navigator.serviceWorker
			.register("/serviceWorker.js")
			.then(res => console.log("service worker registered"))
			.catch(err => console.log("service worker not registered", err))
  	})
}

let deferredPrompt; // Allows to show the install prompt
const installButton = document.getElementById("installButton");

window.addEventListener("beforeinstallprompt", e => 
{
    // console.log("beforeinstallprompt fired");
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



