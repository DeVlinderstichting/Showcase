@extends('layouts.app')

@section('title')
    News
@endsection

@section('content')
<div class="container mb-3">
    <h1 class="p-4">News</h1>
    <h2 class="px-4">All showcase news</h2>
</div>
@foreach($newsItems as $newsItem)
<div class="container mb-3" id="special">
    <div class="row @if($loop->even)switch-direction @endif">
        <div class="col-md d-flex p-4">
            @if($newsItem->image1)
                <img src="{{ $newsItem->image1 }}" class="img-fluid">
            @else
                <img src="images/bf6.jpg" class="img-fluid">
            @endif
        </div>
        <div class="col-md d-flex flex-column p-4">
            <h2>{{ $newsItem->title }}</h2>
            <p>{{ $newsItem->introduction }}</p>

        </div>
    </div>
</div>
@endforeach
@endsection