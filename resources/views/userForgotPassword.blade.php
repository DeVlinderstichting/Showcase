@extends('layouts.app')

@section('meta')
    @include('layouts.forceReload',[])
@endsection

@section('title')
    Forgot password
@endsection

@section('sidebar')
    @include('layouts.navbar',['menuActive'=>'users'])
@endsection

@section('content')
    <div class="container mt-4">
        <div class="card mb-2">
            <h5 class="card-header">
                Request a new password
            </h5>

            <div class="card-body">
                <form action="/forgotPassword" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email address</label>
                        <div class="col-sm-10">
                           <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email">
                            @if($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('email')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Send me a new password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection