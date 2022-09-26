@extends('layouts.app')

@section('title')
Login
@endsection

@section('sidebar')
    @include('layouts.navbar',['menuActive'=>'users'])
@endsection

@section('content')
<div class="container-fluid background-container d-flex">
    <div class="central-container">
        <h1>Welcome</h1>
        @if($errors->has('username'))
            <div class="alert alert-danger" role="alert">
                {{$errors->first('username')}}
            </div>
        @endif
        <form method="POST" action=" {{route('userLogin') }}">
            @csrf

            <label for="username"
                class="">Email</label>

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
                class="">Password</label>

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
                        Remember Me
                    </label>
                </div>
            </div>

            <div class="">
                <button type="submit" class="btn btn-primary">
                    Login
                </button>
            </div>
            <a type="btn-link" href="/forgotPassword">
                Forgot your password
            </a>

            <div>
                <a type="btn btn-link" href="/register">
                    Create an account
                </a>
            </div>

        </form>
    </div>
</div>
@endsection