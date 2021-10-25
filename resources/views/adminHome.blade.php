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
                Regions 
            </h5>
            <div class="card-body">
                <a class="btn btn-primary btn-sm" role="button" href="/regionCreate">Create new region</a>
                <a class="btn btn-primary btn-sm" role="button" href="/region">Manage region</a>
            </div>
        </div>
        <div class="card mb-2">
            <h5 class="card-header">
                Users
            </h5>
            <div class="card-body">
                <a class="btn btn-primary btn-sm" role="button" href="/user/create">Create new user</a>
                <a class="btn btn-primary btn-sm" role="button" href="/user">Manage users</a>
            </div>
        </div>
        <div class="card mb-2">
            <h5 class="card-header">
                Messages
            </h5>
            <div class="card-body">
                <a class="btn btn-primary btn-sm" role="button" href="/pushmessage/create/-1">Create new message</a>
                <a class="btn btn-primary btn-sm" role="button" href="/pushmessage/">Manage messages</a>
            </div>
        </div>
        <div class="card mb-2">
            <h5 class="card-header">
                Translations
            </h5>
            <div class="card-body">
                <a class="btn btn-primary btn-sm" role="button" href="/translationIndex">Edit translation</a>
            </div>
        </div>
    </div>
@endsection
