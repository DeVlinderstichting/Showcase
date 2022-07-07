@extends('layouts.app')

@section('title')
    News
@endsection

@section('sidebar')
    @include('layouts.navbar',['menuActive'=>'adminhome'])
@endsection

@section('extraNavItems')
@endsection

@section('content')
    <div class="container mt-4">
        <div class="card mb-2">
            <h5 class="card-header">
                News items
            </h5>
            <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <th>Title</th>
                            <th>Introduction</th>
                            <th>Main text</th>
                            <th>More info</th>
                        </tr>
                        @foreach($newsitems as $item)
                            <tr>
                                <td><a href="/newsItem/create/{{ $item->id }}">{{ $item->title }}</a></td>
                                <td>{{ substr($item->introduction, 0, 100) }} . . . </td>
                                <td>{{ substr($item->maintext, 0, 100) }} . . . </td>
                                <td>{{ $item->moreinfo }} </td>
                            </tr>
                        @endforeach
                    </table>
                <a href="/adminHome" class="btn btn-secondary m-1">Back</a>
            </div>
        </div>
    </div>
@endsection
