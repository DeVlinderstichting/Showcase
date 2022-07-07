@extends('layouts.app')

@section('title')
    Create user
@endsection

@section('sidebar')
    @include('layouts.navbar',['menuActive'=>'users'])
@endsection

@section('content')
    <div class="container mt-4">
        <div class="card mb-2">
            <h5 class="card-header">
                Create user
            </h5>
            <div class="card-body">
                <form action="/user/create/{{$user->id}}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @if($errors->has('name')) is-invalid @endif" id="name" name="name" value="{{old('name', $user->name)}}">
                            @if($errors->has('name')) <div class="invalid-feedback"> {{$errors->first('name')}} </div>@endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email address</label>
                        <div class="col-sm-10">
                           <input type="text" class="form-control @if($errors->has('email')) is-invalid @endif" id="email" name="email" value="{{old('email', $user->email)}}">
                            @if($errors->has('email')) <div class="invalid-feedback"> {{$errors->first('email')}} </div>@endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @if($errors->has('password')) is-invalid @endif" id="password" name="password" value="{{old('password', '*****')}}">
                            @if($errors->has('password')) <div class="invalid-feedback"> {{$errors->first('password')}} </div>@endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="prefered_language" class="col-sm-2 col-form-label">Prefered language</label>
                        <select name="prefered_language" id="prefered_language">
                            <?php $theLanguages = ['nl','en','fr','es','pt','it','de','dk','no','se','fi','ee','lv','lt','pl','cz','sk','hu','au','ch','si','hr','ba','rs','me','al','gr','bg','ro']; ?>
                            @foreach ($theLanguages as $lan)
                                <option @if($user->prefered_language == $lan) selected @endif value="{{ $lan}}">{{$lan}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group row">
                        <label for="sci_names" class="col-md-3 col-form-label">Scientific names</label>
                        <div class="col-sm-10">
                            <input type="checkbox" class="form-check-input @if($errors->has('sci_names')) is-invalid @endif" name="sci_names" id="sci_names" {{$user->sci_names ? "checked" : ""}}> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="show_previous_observed_species" class="col-md-3 col-form-label">Show previous observations</label>
                        <div class="col-sm-10">
                            <input type="checkbox" class="form-check-input @if($errors->has('show_previous_observed_species')) is-invalid @endif" name="show_previous_observed_species" id="show_previous_observed_species" {{$user->show_previous_observed_species ? "checked" : ""}}> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="show_only_common_species" class="col-md-3 col-form-label">Show common species</label>
                        <div class="col-sm-10">
                            <input type="checkbox" class="form-check-input @if($errors->has('show_only_common_species')) is-invalid @endif" name="show_only_common_species" id="show_only_common_species" {{$user->show_only_common_species ? "checked" : ""}}> 
                        </div>
                    </div>

                    <div class="form-group row">
                        Linked to regions: 
                        <table class="table table-sm table-striped table-hover vertical-align">
                            <thead>
                                <th>Regions</th>
                                <th>User is active</th>
                            </thead>
                            <tbody>
                                <?php $userRegions = $user->regions()->pluck('region_id');   ?>
                                @foreach(\App\Models\Region::all() as $region)
                                    <tr><td>{{$region->name}}</td><td>
                                        <div class="col-sm-10">
                                            <input type="checkbox" class="form-check-input @if($errors->has('region')) is-invalid @endif" name="region_{{$region->id}}" id="region_{{$region->id}}"
                                            <?php 
                                                foreach($userRegions as $key => $value)
                                                {
                                                    if ($value == $region->id) 
                                                    { 
                                                        echo (' checked ');
                                                    }
                                                }
                                            ?>>
                                        </div>
                                    </td></tr>
                                @endforeach
                            </tbody>
                        </table>
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