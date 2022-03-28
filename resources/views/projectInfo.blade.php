@extends('layouts.app')

@section('title')
Users
@endsection

@section('sidebar')
    @include('layouts.navbar',['menuActive'=>'users'])
@endsection

@section('content')
<div class="container mb-3">
    <h1 class="p-4">Project information</h1>
    <h2 class="px-4">Subtitle</h2>
</div>
<div class="container mb-3">
    <div class="row">
        <div class="col-md d-flex p-4">
            <img src="images/bf6.jpg" class="img-fluid"> 
        </div>
        <div class="col-md d-flex flex-column p-4">
            <h2>Introduction</h2>
            <h4>Line 1</h4>
            <h4>Line 2</h4>
            <h4>Line 3</h4>
        </div>
    </div>
</div>
<div class="container mb-3">
    <div class="row">
        <div class="col-md p-4">
            <h2 class="px-4">Institutions</h2>
        </div>
        <div class="d-flex flex-nowrap" style="overflow-x: auto;">
            <div class="flex-shrink-0" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;"></div>
            <div class="flex-shrink-0" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;"></div>
            <div class="flex-shrink-0" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;"></div>
            <div class="flex-shrink-0" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;"></div>
            <div class="flex-shrink-0" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;"></div>
            <div class="flex-shrink-0" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;"></div>
            <div class="flex-shrink-0" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;"></div>
            <div class="flex-shrink-0" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;"></div>
            <div class="flex-shrink-0" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;"></div>

        </div>
    </div>
</div>
<div class="container mb-3">
    <div class="row">
        <div class="col-md p-4">
            <h2 class="px-4">Team</h2>
        </div>
        <div class="d-flex flex-wrap">
            <div class="flex-shrink-0 rounded-circle" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;"></div>
            <div class="flex-shrink-0 rounded-circle" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;"></div>
            <div class="flex-shrink-0 rounded-circle" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;"></div>
            <div class="flex-shrink-0 rounded-circle" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;"></div>
            <div class="flex-shrink-0 rounded-circle" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;"></div>
            <div class="flex-shrink-0 rounded-circle" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;"></div>
            <div class="flex-shrink-0 rounded-circle" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;"></div>
            <div class="flex-shrink-0 rounded-circle" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;"></div>
            <div class="flex-shrink-0 rounded-circle" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;"></div>
        </div>
    </div>
</div>

@endsection