<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/favicon.ico">
    @yield('meta')
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"
        integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="/js/localTimes.js"></script>

    <!-- Font awesome -->
    <link href="/css/all.css" rel="stylesheet">
    <!-- Showcase custom stylesheet -->
    <link href="/css/showcase_web.css" rel="stylesheet">

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- flags -->
    <link href="/flags/css/flag-icons.min.css" rel="stylesheet" />


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

</head>

<body class="general-body-class">
    <!-- navbar -->
    <div class="container general-navbar-class">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom general-navbar-title-class">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <img src="\img/logo_Insectscount_718x242.png" alt="InsectsCount logo" height="32">
            </a>

            <ul class="nav nav-pills general-navbar-buttons-class">
                <li class="nav-item"><a href="/regionPublicIndex"
                        class="nav-link {{ Request::is('showEbaInfo') ? 'active' : '' }}"
                        aria-current="page">EBAs</a></li>
                <li class="nav-item"><a href="/showProjectInfo"
                        class="nav-link {{ Request::is('showProjectInfo') ? 'active' : '' }}"
                        aria-current="page">About</a></li>
                <li class="nav-item"><a href="/showRecordingMethodExplanation"
                        class="nav-link {{ Request::is('showRecordingMethodExplanation') ? 'active' : '' }}">Monitoring</a>
                </li>
                <li class="nav-item"><a href="/showIdHelp"
                        class="nav-link {{ Request::is('showIdHelp') ? 'active' : '' }}">Identification</a></li>
                <li class="nav-item"><a href="/news"
                        class="nav-link {{ Request::is('news') ? 'active' : '' }}">News</a></li>
         <!--       <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="fi fi-gb"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#"><span class="fi fi-gb mx-2"></span>English</a></li>
                        <li><a class="dropdown-item" href="#"><span class="fi fi-nl mx-2"></span>Nederlands</a></li>
                        <li><a class="dropdown-item" href="#"><span class="fi fi-es mx-2"></span>Español</a></li>
                        <li><a class="dropdown-item" href="#"><span class="fi fi-de mx-2"></span>Deutsch</a></li>
                    </ul>
                </li> -->
                <li class="nav-item"><a href="/home" class="nav-link"><i class="fas fa-user"></i></a>
                </li>          
            </ul>
        </header>
    </div>

    @yield('content')

    <div class="container general-footer-class">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            
            <a href="https://www.vlinderstichting.nl/english/">
                <img src="{{ URL::to('/') }}/img/DVS_logo.png" alt="Logo Dutch Butterfly Conservation" style='height: 44px'><br>
                Website functionality and dataprocessing by Dutch Butterfly Conservation
            </a>
            <a href="https://scienseed.com/"> 
                <img src="{{ URL::to('/') }}/img/scienseed_logo.png" alt="Logo Scienseed" style='height: 44px'>
                <br>
                The design of this website was provided by SienceSeed
            </a> 
            
            <p class="col-md-12 mb-0 pt-3 text-muted general-footer-copyright-class">&copy;2022 Showcase<br>This project receives funding from the European Union's Horizon 2020 research and innovation programme under grant agreement No. 862480.</p>
        </footer>
    </div>

</body>

</html>
