@extends('layouts.app')

@section('title')
    {{\App\Models\Language::getItem('generalPageNewsTitle')}} 
@endsection

@section('content')
<div class="container mb-3">
    <h1 class="p-4 news-title-header">{{\App\Models\Language::getItem('generalPageNewsHeader')}}</h1>
    <h2 class="px-4 news-title-sub">{{\App\Models\Language::getItem('generalPageNewsSubHeader')}}</h2>
</div>
@foreach($newsItems as $newsItem)
<div class="container mb-3" id="special">
    <div class="row @if($loop->even)switch-direction @endif">
        <div class="col-md d-flex p-4">
            @if($newsItem->image1)
                <img src="{{ $newsItem->image1 }}" class="img-fluid news-section-image">
            @else
                <img src="images/bf6.jpg" class="img-fluid news-section-image">
            @endif
        </div>
        <div class="col-md d-flex flex-column p-4">
            <h2 class="news-section-title">{{ $newsItem->title }}</h2>
            <p class="news-section-intro">{{ Str::words($newsItem->introduction,75, ' (...)' )}}</p>
            <p class="news-section-more"><a href="/news/{{ $newsItem->id }}">{{\App\Models\Language::getItem('generalPageNewsReadMore')}}</a></p>
        </div>
    </div>
</div>
@endforeach
@endsection