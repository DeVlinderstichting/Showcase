@extends('layouts.app')

@section('meta')
    @include('layouts.forceReload',[])
@endsection

@section('title')
    Register
@endsection

@section('sidebar')
    @include('layouts.navbar',['menuActive'=>'users'])
@endsection

@section('content')
    <div class="container mt-4">
        <div class="card mb-2">
            <h5 class="card-header">
                Register an account
            </h5>

            <div class="card-body">
                <form action="/registerUser" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name">
                            @if($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('name')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
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
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                            @if($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('password')}}</strong>
                                </span>
                            @endif
                        </div>  
                    </div>

                    <div class="form-group row">
                        <label for="regions" class="col-sm-2 col-form-label">Region(s)</label>
                        <div class="col-sm-10"> <!-- add grouping with <optgroup>-->
                            <select class="js-example-basic-multiple" name="regions[]" id='regions' multiple="multiple" style="width: 100%;">
                                @foreach ($regions as $region)
                                    <option value="{{$region->id}}">{{$region->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('regions'))
                                <span class="invalid-feedback" role="alert" style="display: inline;">
                                    <strong>{{$errors->first('regions')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="share_data" class="col-sm-2 col-form-label">Share your observations within InsectsCount</label>
                        <div class="col-sm-10">
                            <input type="checkbox" class="@error('share_data') is-invalid @enderror" id="share_data" name="share_data" value="share_data">
                            @if($errors->has('share_data'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('share_data')}}</strong>
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

    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
                placeholder: "Select a region",
                closeOnSelect: false
            });
        });
    </script>
@endsection