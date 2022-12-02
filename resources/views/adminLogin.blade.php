<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('layouts.forceReload',[])
    <link rel="shortcut icon" href="/favicon.ico">
    <title>InsectsCount</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="/css/fontawesome/5.14.0/all.min.css">
    {{--
    <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" /> --}}
    <link rel="stylesheet" type="text/css" href="{{ url('/css/dvs.css') }}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.4.4/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>
    <style>
        html,
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: "Roboto", sans-serif;
        }

    </style>
    <title>InsectsCount</title>
</head>

<body style="background-color: #f1f1f1;">
    <!-- titlebar -->
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">InsectsCount</a>
    </nav>

    <!-- Main content -->

    <main role="main" class="container">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <h1 class="h2">Welcome to the InsectsCount admin panel</h1>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Manage the InsectsCount application</h5>
                <p class="card-text">
                    This web portal will allow you to manage the InsectsCount application.  
                </p>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">{{ __('welcome.Login') }}</div>

                                <div class="card-body">
                                    @if($errors->has('username'))
                                        <div class="alert alert-danger" role="alert">
                                            {{$errors->first('username')}}
                                        </div>
                                    @endif
                                    <form method="POST" action="{{ route('adminLogin') }}">
                                        @csrf

                                        <div class="form-group row">
                                            <label for="username"
                                                class="col-md-4 col-form-label text-md-right">E-Mail Address Or Username</label>

                                            <div class="col-md-6">
                                                <input id="username" type="text"
                                                    class="form-control @error('username') is-invalid @enderror"
                                                    name="username" value="{{ old('username') }}" required
                                                    autocomplete="username" autofocus>

                                                @if($errors->has('username'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{$errors->first('date')}}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password"
                                                class="col-md-4 col-form-label text-md-right">Password</label>

                                            <div class="col-md-6">
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="current-password">

                                                @if($errors->has('username'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{$errors->first('date')}}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-6 offset-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remember"
                                                        id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                    <label class="form-check-label" for="remember">
                                                        Remember Me
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-8 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    Login
                                                </button>

                                                @if (Route::has('password.request'))
                                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                                        {{ __('welcome.Forgot Your Password?') }}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

</body>

</html>
