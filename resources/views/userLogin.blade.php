@extends('layouts.app')

@section('title')
Users
@endsection

@section('sidebar')
    @include('layouts.navbar',['menuActive'=>'users'])
@endsection

@section('content')
<div class="row background-container">
    <div class="col d-flex">
        <div class="sign-in-container">
            <h1>PLEASE, SIGN IN</h1>
            @if($errors->has('username'))
                <div class="alert alert-danger" role="alert">
                    {{$errors->first('username')}}
                </div>
            @endif
            <form method="POST" action="{{ route('userLogin') }}">
                @csrf
    
                <label for="username"
                    class="">{{ __('welcome.E-Mail Address Or Username') }}</label>

                <div class="">
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
    
                <label for="password"
                    class="">{{ __('welcome.Password') }}</label>

                <div class="">
                    <input id="password" type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password">

                    @if($errors->has('username'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$errors->first('date')}}</strong>
                        </span>
                    @endif
                </div>
                <div class="">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember"
                            id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('welcome.Remember Me') }}
                        </label>
                    </div>
                </div>
    
                <div class="">
                    <button type="submit" class="btn btn-primary">
                        {{ __('welcome.Login') }}
                    </button>

                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('welcome.Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
    
</div>
                                    
                                
@endsection