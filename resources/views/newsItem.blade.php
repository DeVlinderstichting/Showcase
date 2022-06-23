@extends('layouts.app')

@section('title')
    News
@endsection

@section('content')
<div class="container mb-3">
    <h1 class="p-4">{{\App\Models\Language::getItem('newsPageHeader')}}</h1>
    <h2 class="px-4">{{ $newsItem->title }}</h2>
</div>
<div class="container mb-3" id="special">
    <div class="row">
        <div class="col-md-2 p-4">
            <p>{{ $newsItem->created_at->format('Y-m-d') }}</p>
            @if( $newsItem->moreinfo )
                <a href="{{ $newsItem->moreinfo }}" target="_blank">{{\App\Models\Language::getItem('newsPageHeader')}}</a>
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