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



    <div class="row">
        <div class="col-md-2 p-4">


            <p>{{ $newsItem->created_at->format('Y-m-d') }}</p>
            @if( $newsItem->moreinfo )
                <a href="{{ $newsItem->moreinfo }}" target="_blank">More info...</a>
            @endif
        </div>
        <div class="col-md-10 d-flex flex-column p-4">
            <p class="fw-bold">{{ $newsItem->introduction }}</p>
            @if( $newsItem->image1 )
                <img src="{{$newsItem->image1}}" class="img-fluid">
            @endif
            <p>{!! nl2br(e($newsItem->maintext)) !!}</p>
            @if( $newsItem->image2 )
                <img src="{{$newsItem->image2}}" class="img-fluid">
            @endif        
        </div>
    </div>
</div>
@endsection