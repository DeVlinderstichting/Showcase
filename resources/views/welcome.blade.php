<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Layout JS -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/theme-vendors.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

    <!-- favicon icon -->
    <link rel="shortcut icon" href="img/favicon.png">
    <link rel="apple-touch-icon" href="img/favicon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/favicon.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/favicon.png">


    
    <!-- style sheets and font icons  -->
    <link rel="stylesheet" type="text/css" href="css/font-icons.min.css">
    <link rel="stylesheet" type="text/css" href="css/theme-vendors.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/responsive.css" />

    <link rel="manifest" href="manifest.json" />

    <link href='/css/select2.min.css' rel='stylesheet' />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <meta name="apple-mobile-web-app-status-bar" content="#db4938" />
    <meta name="theme-color" content="#db4938" />



    <title>Showcase</title>
  </head>
  <body data-mobile-nav-style="classic">
    <main>
        <nav class="navbar navbar-expand-md" id='nav'>
            Navbar
        </nav>
        <div id = "mainBody">
            Mainbody
        </div>
    </main>

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