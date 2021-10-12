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
        function connectDatabase()
        {
            var db;
            const dbNameSettings = "showcaseSettings";
            var request = window.indexedDB.open("ShowcaseDatabase", 1);
            request.onerror = function(event)
            {
                console.log('An error occured.')
            };
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

            var transaction = db.transaction([dbNameSettings]);
            var objectStore = transaction.objectStore(dbNameSettings);
            var request = objectStore.get("settings");
            request.onerror = function(event) 
            {
                // Handle errors, ...or not :)

            };
            request.onsuccess = function(event) 
            {
                console.log(request.result);
                //call attemptLogin using token from database 
            };
        }

        function attemptLogin(token = "")
        {
            var email = document.getElementById('email');
            var password = document.getElementById('password');

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

        }

    </script>
    

    <script src="js/app.js"></script>
    <script src='/js/select2.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.1/chart.min.js'></script>
    
  </body>
</html>