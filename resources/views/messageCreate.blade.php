@extends('layouts.app')

@section('meta')
    @include('layouts.forceReload',[])
@endsection

@section('title')
    Create message
@endsection

@section('sidebar')
    @include('layouts.navbar',['menuActive'=>'messages'])
@endsection

@section('content')
    <div class="container mt-4">
        <div class="card mb-2">
            <h5 class="card-header">
                Create message
            </h5>

            <div class="card-body">
                <form action="/pushmessage/create/{{$message->id}}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="region_id" class="col-sm-2 col-form-label">Region</label>
                        <select name="region_id" id="region_id">
                            @foreach (\App\Models\Region::all() as $region)
                                <option @if($message->region_id == $region->id) selected @endif value="{{$region->id}}">{{$region->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="header" class="col-sm-2 col-form-label">Header</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @if($errors->has('header')) is-invalid @endif" id="header" name="header" value="{{old('header', $message->header)}}">
                            @if($errors->has('header')) <div class="invalid-feedback"> {{$errors->first('header')}} </div>@endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="content" class="col-sm-2 col-form-label">Content</label>
                        <div class="col-sm-10">
                           <textarea cols="40" rows="5" class="form-control @if($errors->has('content')) is-invalid @endif" id="content" name="content">{{old('content', $message->content)}}</textarea>
                            @if($errors->has('content')) <div class="invalid-feedback"> {{$errors->first('content')}} </div>@endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="/adminHome" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection