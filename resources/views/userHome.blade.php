@extends('layouts.app')

@section('title')
Admin home
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
                My data 
            </h5>
            <div class="card-body">
                <a class="btn btn-primary btn-sm" role="button" href="/user/create/-1">My visits</a>
                <a class="btn btn-primary btn-sm" role="button" href="/user/create/-1">Data download</a>
                <a class="btn btn-primary btn-sm" role="button" href="/user">Data summary</a>
                <a class="btn btn-primary btn-sm" role="button" href="/user">Map</a>
            </div>
        </div>
        <div class="card mb-2">
            <h5 class="card-header">
                Personal information
            </h5>
            <div class="card-body">
                <a class="btn btn-primary btn-sm" role="button" href="/showUserPushMessages">My messages</a>
                <a class="btn btn-primary btn-sm" role="button" href="/pushmessage/create/-1">My settings</a>
                <a class="btn btn-primary btn-sm" role="button" href="/pushmessage/create/-1">News</a>
            </div>
        </div>
        <div class="card mb-2">
            <h5 class="card-header">
                Help
            </h5>
            <div class="card-body">
                <a class="btn btn-primary btn-sm" role="button" href="/showProjectInfo">About showcase</a>
                <a class="btn btn-primary btn-sm" role="button" href="/showRecordingMethodExplanation">Recording methods</a>
                <a class="btn btn-primary btn-sm" role="button" href="/showIdHelp">Species identification help</a>
            </div>
        </div>
    </div>
@endsection
