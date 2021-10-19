<!doctype html>
<html lang="en">
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
        <nav class="navbar navbar-expand-md" id='nav'>
            Navbar
        </nav>
        <div id = "mainBody">
            Mainbody
        </div>
    </main>


    <script>
        
    </script>
    

    
    <script src="js/render.js"></script>
    <script src="js/app.js"></script>
    <script src="js/storage.js"></script>
    <script src="js/location.js"></script>
    <script src='/js/pageLogic.js'></script>
    <script src='/js/select2.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.1/chart.min.js'></script>

<script> 
    function initializeApp()
    {
        //REMOVE THIS::
        debugTestInit();

        setupDatabase();
        document.addEventListener("DOMContentLoaded", showLoginScreen)
    }
    initializeApp();
    
</script>




  </body>
</html>