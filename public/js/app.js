
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

function attemptLogin()
{
    username= "test@vlinderstichting.nl";
    password = "123test";
    requestUserPackage(username, password, sendBackHome=true);
}

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

// const showSettingsScreen = () => 
// {
//     renderNav();

//     var mb = document.getElementById('mainBody');

//     var html = `
//     <div class="container mt-5 mb-3">
//         <div class="row mt-3">
//             <div class="col">
//                 <div class="row row-cols-1 row-cols-md-2 g-4">
//                     <div class="col">
//                         <div class="card h-100">
//                         <h5 class="card-header">General settings</h5>
//                             <div class="card-body">
//                                 <table class="table table-borderless">
//                                     <tr>
//                                         <td>User</td>
//                                         <td>A.J. de Vries</td>
//                                     </tr>
//                                     <tr>
//                                         <td>Registerd at</td>
//                                         <td>2021-04-01</td>
//                                     </tr>
//                                     <tr>
//                                         <td>Logout</td>
//                                         <td><button onclick="showLoginScreen();" class="btn btn-primary btn-sm"><i class="fas fa-sign-out-alt"></i> Logout</button></td>
//                                     </tr>
//                                     <tr>
//                                         <td>Use scientific names</td>
//                                         <td><div class="form-check form-switch"><input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"></div></td>
//                                     </tr>
//                                     <tr>
//                                         <td>Show previously seen</td>
//                                         <td><div class="form-check form-switch"><input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"></div></td>
//                                     </tr>
//                                     <tr>
//                                         <td>Show common species</td>
//                                         <td><div class="form-check form-switch"><input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"></div></td>
//                                     </tr>                                               
//                                 </table>
//                             </div>
//                         </div>
//                     </div>
//                     <div class="col">
//                         <div class="card h-100">
//                             <h5 class="card-header">What do you want to count</h5>
//                             <div class="card-body text-center">
//                                 <div class="alert alert-light" role="alert">
//                                     Red (<span style="color: #f00c0c">&#x25A2</span>): no counts<br>
//                                     Orange (<span style="color: #f0b70c">&#x25A2</span>): count number within group (not at species level)<br>
//                                     Green (<span style="color: #29f00c">&#x25A2</span>); count species within group
//                                 </div>
//                                 <img onclick="toggleColor(this)" id="countSettingButterfly" src="images/bf5.jpg" class="img-tgl img-thumbnail" alt="..." style="margin: 3px; width: 200px; height:200px">
//                                 <img onclick="toggleColor(this)" id="countSettingBee" src="images/bij.jpg" class="img-tgl img-thumbnail" alt="..." style="margin: 3px; width: 200px; height:200px">
//                                 <img onclick="toggleColor(this)" id="countSettingFlower" src="images/plant.jpg" class="img-tgl img-thumbnail" alt="..." style="margin: 3px; width: 200px; height:200px">
//                                 <img onclick="toggleColor(this)" id="countSettingBird" src="images/vogel.jpg" class="img-tgl img-thumbnail" alt="..." style="margin: 3px; width: 200px; height:200px">
//                             </div>
//                         </div>
//                     </div>
//                 </div>
//             </div>
//         </div>
//     </div>`

//     mb.innerHTML = html;
//     setColor();

// }

function hexToRgb(hex) 
{
    // Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")
    var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
    hex = hex.replace(shorthandRegex, function(m, r, g, b) 
    {
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



function testLocalStorage()
{
    var dat = JSON.parse(localStorage.getItem("ShowcaseSettings"));
    console.log(dat['userSettings']['preferedLanguage']);

}






