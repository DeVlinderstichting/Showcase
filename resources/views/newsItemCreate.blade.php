@extends('layouts.app')

@section('title')
    News
@endsection

@section('content')

<div class="container mt-4">
    <div class="card mb-2">
        <h5 class="card-header">
            Create news item
        </h5>
        <div class="card-body">
            <form action="/newsItem/create/{{$newsItem->id}}" method="post">
                @csrf
                <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @if($errors->has('title')) is-invalid @endif" id="title" name="title" value="{{old('title', $newsItem->title)}}">
                        @if($errors->has('title')) <div class="invalid-feedback"> {{$errors->first('title')}} </div>@endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="introduction" class="col-sm-2 col-form-label">Introduction</label>
                    <div class="col-sm-10">
                       <textarea cols="40" rows="5" class="form-control @if($errors->has('introduction')) is-invalid @endif" id="introduction" name="introduction">{{old('introduction', $newsItem->introduction)}}</textarea>
                        @if($errors->has('introduction')) <div class="invalid-feedback"> {{$errors->first('introduction')}} </div>@endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="maintext" class="col-sm-2 col-form-label">Maintext</label>
                    <div class="col-sm-10">
                       <textarea cols="40" rows="5" class="form-control @if($errors->has('maintext')) is-invalid @endif" id="maintext" name="maintext">{{old('maintext', $newsItem->maintext)}}</textarea>
                        @if($errors->has('maintext')) <div class="invalid-feedback"> {{$errors->first('maintext')}} </div>@endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="moreinfo" class="col-sm-2 col-form-label">Moreinfo (URL)</label>
                    <div class="col-sm-10">
                       <textarea cols="40" rows="5" class="form-control @if($errors->has('moreinfo')) is-invalid @endif" id="moreinfo" name="moreinfo">{{old('moreinfo', $newsItem->moreinfo)}}</textarea>
                        @if($errors->has('moreinfo')) <div class="invalid-feedback"> {{$errors->first('moreinfo')}} </div>@endif
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