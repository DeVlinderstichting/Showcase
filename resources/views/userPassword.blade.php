@extends('layouts.app')

@section('meta')
    @include('layouts.forceReload',[])
@endsection

@section('title')
    Change password
@endsection

@section('sidebar')
    @include('layouts.navbar',['menuActive'=>'users'])
@endsection

@section('content')
    <div class="container mt-4">
        <div class="card mb-2">
            <h5 class="card-header">
                Change password
            </h5>

            <div class="card-body">
                <form action="/savePassword" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="oldPassword" class="col-sm-2 col-form-label">Old password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control @error('oldPassword') is-invalid @enderror" id="oldPassword" name="oldPassword">
                            @if($errors->has('oldPassword'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('oldPassword')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="newPassword" class="col-sm-2 col-form-label">New password</label>
                        <div class="col-sm-10">
                           <input type="password" class="form-control @error('newPassword') is-invalid @enderror" id="newPassword" name="newPassword">
                            @if($errors->has('newPassword'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('newPassword')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="newPasswordCheck" class="col-sm-2 col-form-label">New password (repeat)</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control @error('newPasswordCheck') is-invalid @enderror" id="newPasswordCheck" name="newPasswordCheck">
                            @if($errors->has('newPasswordCheck'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('newPasswordCheck')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection