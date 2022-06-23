@extends('layouts.app')

@section('title')
Pushmessages
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
                Messages
            </h5>
            <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <th>Title</th>
                            <th>Region</th>
                            <th>Content</th>
                        </tr>
                        @foreach($messages as $mes)
                            <tr>
                                <td><a href="/pushmessage/create/{{ $mes->id }}">{{ $mes->header }}</a></td>
                                <td>{{ $mes->region_id }}</td>
                                <td>{{ substr($mes->content, 0, 100) }} . . . </td>
                            </tr>
                        @endforeach
                    </table>
                <a href="/adminHome" class="btn btn-secondary m-1">Close</a>
            </div>
        </div>
    </div>
@endsection
