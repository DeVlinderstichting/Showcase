<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>


    <link rel="manifest" href="manifest.json" />
    <!-- ios support -->
    <link rel="apple-touch-icon" href="images/icons/icon72.png" />
    <link rel="apple-touch-icon" href="images/icons/icon96.png" />
    <link rel="apple-touch-icon" href="images/icons/icon128.png" />
    <link rel="apple-touch-icon" href="images/icons/icon144.png" />
    <link rel="apple-touch-icon" href="images/icons/icon152.png" />
    <link rel="apple-touch-icon" href="images/icons/icon192.png" />
    <link rel="apple-touch-icon" href="images/icons/icon384.png" />
    <link rel="apple-touch-icon" href="images/icons/icon512.png" />
    
    <link href='/css/select2.min.css' rel='stylesheet' />
    <link href='/css/login.css' rel='stylesheet' />
    <link href='/css/feature.css' rel='stylesheet' />

    
    <meta name="apple-mobile-web-app-status-bar" content="#db4938" />
    <meta name="theme-color" content="#db4938" />

    <title>Showcase</title>
  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <main>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark" id='nav'>
        </nav>
        <div id = "mainBody">
            <h5 class="card-title">Waarnemingen doorgeven</h5>
            <p class="card-text"></p>
        </div>
    </main>

<?php /* 
    <script> 
        function loadMainJs()
        {

            var po = document.querySelector('#links script');
            var s = document.querySelector('head'); 
            s.appendChild(po, s)
        }
        loadMainJs();
    </script> <script src="/requestUserPackage"></script> 


    procedure 
    -check if language in database
    -if so, load correct app.js 
    -if not, request user package || load en package 




    */ ?>


    <script>


        


        const DB_NAME = 'ShowcaseDatabase';
        const DB_VERSION = 4; // Use a int/long (long) for this value (don't use a float)
        const DB_STORE_NAME = 'showcaseSettings';
        var db;
        var userSettings;
        var lang;

function debugTestInit()
{
    var req = indexedDB.deleteDatabase(DB_NAME);
    req.onerror = function (evnt) 
    {
        console.error("openDb:", evnt.target.errorCode);
    };
}
debugTestInit();

        function loadUserSettings() 
        {
            var req = indexedDB.open(DB_NAME, DB_VERSION);
            
            req.onerror = function (evnt) 
            {
                console.error("openDb:", evnt.target.errorCode);
            };

            req.onupgradeneeded = function (evnt) 
            {
                db = req.result;
         //       console.log("openDb.onupgradeneeded");
                //var store = evnt.currentTarget.result.createObjectStore(DB_STORE_NAME, { keyPath: 'name'});
                var store = db.createObjectStore(DB_STORE_NAME, { keyPath: 'name'});
              //  store.onsuccess = function (evnt)
               // {
                    var emtpySettings = {'name': 'settings', 'data': ''};
                    store.add(emtpySettings);
                    userSettings = emtpySettings;
               //     console.log("user settings created");
                    var emtpyObservations = {'name': 'observations', 'data': ''};
                    store.add(emtpyObservations);
               // };
               // store.onerror = function (evnt) 
               // {
                //    console.error("create store error:", evnt.target.errorCode);
               // };


              //  store.transaction.oncomplete = function(event) 
             //   {
                //    var objectStore = getObjectStore(DB_STORE_NAME, 'readwrite'); // db.transaction(DB_STORE_NAME, "readwrite").objectStore(DB_STORE_NAME);
              //      var emtpySettings = {'name': 'settings', 'data': ''};
                //    objectStore.add(emtpySettings);
               // }
                //store.createIndex('biblioid', 'biblioid', { unique: true });
            };
            req.onsuccess = function (evnt) 
            {
          //      console.log("request done");
                db = req.result;
                tx = db.transaction(DB_STORE_NAME, "readwrite");
                store = tx.objectStore(DB_STORE_NAME);

                settingsRequest = store.get('settings');
                settingsRequest.onsuccess = function(evnt)
                {
                    userSettings = JSON.parse(settingsRequest.result.data);
                }
             //   var emtpySettings = {'name': 'settings', 'data': ''};
             //   store.add(emtpySettings);
                
                
            };
        }
        loadUserSettings();
        function storeData(key, data)
        {
            var req = indexedDB.open(DB_NAME, DB_VERSION);
            
            req.onerror = function (evnt) 
            {
                console.error("openDb:", evnt.target.errorCode);
            };

            req.onsuccess = function (evnt) 
            {
                db = req.result;
                tx = db.transaction(DB_STORE_NAME, "readwrite");
                store = tx.objectStore(DB_STORE_NAME);

                dat = {'name': key, 'data': data};
                userSettings = store.put(dat);
            };
        }

   //     function getObjectStore(store_name, mode) 
    //    {
      //      if (typeof db != 'undefined')
     //       {
      //          var tx = db.transaction(store_name, mode);
       //         return tx.objectStore(store_name);
       //     }
     //   }


  /*      function connectDatabase()
        {
            var db;
            var request = window.indexedDB.open(DB_NAME, DB_VERSION);

            request.onerror = function(event)
            {
                console.log('An error occured.')
            };
            console.log('iglo16');
            request.onsuccess = function(event) 
            {
                db = event.target.result;
            };
            request.onupgradeneeded = function(event) 
            {
                var objectStore = db.createObjectStore(dbNameSettings, { keyPath: "name" });
               // objectStore.transaction.oncomplete = function(event) 
                //{
                 //   var customerObjectStore = db.transaction(dbNameSettings, "readwrite").objectStore(dbNameSettings);
                    

                  // // customerData.forEach(function(customer) 
                   //// {
                  // //     customerObjectStore.add(customer);
                  ////  });
                
            }
            return db;
        }
        */

        function attemptLogin(token = "")
        {
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            var accessToken = "";

            if (password = "")
            {
                var settings = getUserSettings(); 
                accessToken = settings.userSettings['accesToken']; //this will fail if the user has no settings stored. However, this does not matter as the user has no accesstoken stored and provided an empty password, so the ajax is no longer required. 
            }

username= "test@vlinderstichting.nl";
password = "123test";
accesstoken = "kq0Tv6zha1gN75P2vz0s2hXMhFrqzW1dB5CiNc2K6KZhoHFxxm8AuDSzrtM53bHdmMioEomq6aVRgIy5";

            $.ajax({
                type: 'GET',
                url: '/requestUserPackage',
                data: 
                {
                    'username': username,
                    'accesstoken': accesstoken
                },
                success: function(data) 
                {
                    storeUserPackageInLocalDatabase(data);
                   // console.log(data);
                   // var dataJson = JSON.parse(data);
                   // console.log(dataJson['userSettings']['preferedLanguage']);
                   // localStorage.setItem("ShowcaseSettings", JSON.stringify(dataJson)); 
                   // testLocalDatabase();
                }
            });
        }

        function storeUserPackageInLocalDatabase(data)
        {

       ///     var request = window.indexedDB.open("ShowcaseDatabase", 1);
            storeData('settings', data);

            var settings = getUserSettings();
            console.log(data['language']);
         //   lang = data[''];



   //         console.log('-1 settings:' + settings.userSettings['name']);
    //        console.log("1 settings: " + JSON.stringify(userSettings));

      /*      if (typeof store == 'undefined')
                store = getObjectStore(DB_STORE_NAME, 'readwrite');
            var settingsData = {'name': 'settings', 'data': JSON.stringify(data)};
console.log('doing put');
            store.put(settingsData);
            req = store.get('settings');

            console.log(req.data);
            */
/*

            
            request.onerror = function(event)
            {
                console.log('An error occured.')
                console.log(request);
            };
            request.onupgradeneeded = function(event) 
            {
                var db = event.target.result;
                var objectStore = db.createObjectStore(dbNameSettings, { keyPath: "name" });
               // objectStore.transaction.oncomplete = function(event) 
                //{
                 //   var customerObjectStore = db.transaction(dbNameSettings, "readwrite").objectStore(dbNameSettings);
                    

                  // // customerData.forEach(function(customer) 
                   //// {
                  // //     customerObjectStore.add(customer);
                  ////  });
                
            }
            request.onsuccess = function(event) 
            {
             /*   db = event.target.result;
                var transaction = db.transaction([dbNameSettings]);
                var objectStore = transaction.objectStore(dbNameSettings);
                var request = objectStore.get("settings");
                request.onerror = function(event) 
                {
                    // Handle errors, ...or not :)
                    console.log(request.errors);


                };
                request.onsuccess = function(event) 
                {
                    console.log(request.result);
                    //call attemptLogin using token from database 
                };*/ /*

            };
            
            return db; */
        }

        function getUserSettings()
        {
            if (typeof userSettings == 'undefined') 
            {
                loadUserSettings();
            }
            return userSettings;
        }

    </script>

    <script>
        //keep these in a seperate script block, so if one fails, the rest of the functionality remains ok 

        function locationAvailable(pos)
        {
            var coor = pos.coords;
            console.log(coor.latitude + ", " + coor.longitude);
        }
        function locationError(err)
        {
            console.log('geolocation error');
        }

        function getLocation()
        {
            if ("geolocation" in navigator) 
            {
                navigator.geolocation.getCurrentPosition(locationAvailable, locationError);
            }
            else
            {
                console.log('geolocation not available');
            }
        }

      //  getLocation();

        


        var positionTracker;
        var locations = [];
        function trackingLocationUpdate(pos)
        {
            var coor = pos.coords;
            var line = coor.latitude + ", " + coor.longitude;
            locations.push(line);
            console.log(locations);
            if (locations.length > 15)
            {
                stopTracking();
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
                    geoWatch = navigator.geolocation.watchPosition(trackingLocationUpdate, trackingLocationError, 
                    { 
                        enableHighAccuracy: false,
                        timeout: 15000,
                        maximumAge: 0
                    });
                } 
            }
        }
        function stopTracking()
        {
            navigator.geolocation.clearWatch(positionTracker); 
            positionTracker = undefined;
        }
     //   startTracking();
    </script>
    

    <script src="js/app.js"></script>
    <script src='/js/select2.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.1/chart.min.js'></script>
    
  </body>
</html>