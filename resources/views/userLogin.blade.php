@extends('layouts.app')

@section('title')
Users
@endsection

@section('sidebar')
    @include('layouts.navbar',['menuActive'=>'users'])
@endsection

@section('content')
    <body style="background-color: #f1f1f1;">
    <!-- titlebar -->
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">De Vlinderstichting Meetnetten</a>
    </nav>

    <!-- Main content -->

    <main role="main" class="container">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <h1 class="h2">Welkom bij de Vlinderstichting</h1>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Waarnemingen doorgeven</h5>
                <p class="card-text">
                    Geef hier uw waarnemingen door van het Meetnet Vlinders en het Meetnet Libellen. Alle waarnemingen worden opgenomen in het centrale bestand en gebruikt door De Vlinderstichting. Uw waarnemingen dragen bij aan bescherming! 
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
                                    <form method="POST" action="{{ route('userLogin') }}">
                                        @csrf

                                        <div class="form-group row">
                                            <label for="username"
                                                class="col-md-4 col-form-label text-md-right">{{ __('welcome.E-Mail Address Or Username') }}</label>

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
                                                class="col-md-4 col-form-label text-md-right">{{ __('welcome.Password') }}</label>

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
                                                        {{ __('welcome.Remember Me') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-8 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('welcome.Login') }}
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
                            Wilt u ook meetellen? <a href="/participate" class="btn-link">Meld u nu aan...</a>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row justify-content-center" id="myFooter">
            <div class="card-deck mt-4">
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
        </div>
    </main>

</body>
@endsection