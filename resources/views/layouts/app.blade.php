<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/favicon.ico">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="/css/fontawesome/5.14.0/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="{{ url('/css/dvs.css') }}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>
    <style>
        html,
        body,        <div class="card-group mt-4">
            <div class="card border-0" style="background-color: rgba(245, 245, 245, 0);">
              <img src="/images/logo-vlinderstichting.png" class="card-img-top logo">
            </div>
            <div class="card border-0" style="background-color: rgba(245, 245, 245, 0);">
              <img src="/images/cbs-brand.svg" class="card-img-top logo">
            </div>
            <div class="card border-0" style="background-color: rgba(245, 245, 245, 0);">
              <img src="/images/lnvmbkl.png" class="card-img-top logo">
            </div>
          </div>
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: "Roboto", sans-serif;
        }


    </style>
    <title>@yield('title')</title>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function submitExtraQuestion(postTo, answerValue) {
            $.ajax({
                type: 'POST',
                url: postTo,
                data: {
                    "answer": answerValue
                }
            });
        }

    </script>

</head>

<body>

    <!-- titlebar -->
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a href="/home" class="navbar-brand col-md-3 col-lg-2 mr-0 px-3"><i class="fa fa-home"></i> De Vlinderstichting Meetnetten</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
            data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <div class="container-fluid">
        <div class="row">
            @yield('sidebar')


            <!-- Main content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

                <div class="d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
                    <h2 class="h2">@yield('title')</h2>
                </div>

                @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </div>
                @endif
                
                @yield('content')
            <!-- END MAIN -->
            </main>
        </div>
    </div>
</body>

</html>
