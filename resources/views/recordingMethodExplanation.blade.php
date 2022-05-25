@extends('layouts.app')

@section('title')
Guide to monitoring
@endsection

@section('content')
<div class="container mb-3">
    <h1 class="p-4">Guide to monitoring</h1>
    <h2 class="px-4">Subtitle</h2>
</div>
<div class="container text-center mt-3 mb-3">
    <a href="#special" class="btn btn-primary">I saw something special</a>
    <a href="#15min" class="btn btn-primary">15 minutes count</a>
    <a href="#transect" class="btn btn-primary">Walk transect</a>
    <a href="#fit" class="btn btn-primary">Fit count</a>
</div>
<div class="container mb-3" id="special">
    <div class="row">
        <div class="col-md d-flex p-4">
            <img src="images/bf6.jpg" class="img-fluid"> 
        </div>
        <div class="col-md d-flex flex-column p-4">
            <h2>I saw something special</h2>
            <h4>Line 1</h4>
            <h4>Line 2</h4>
            <h4>Line 3</h4>
        </div>
    </div>
</div>
<div class="container mb-3" id="15min">
    <div class="row switch-direction">
        <div class="col-md d-flex p-4">
            <img src="images/bf6.jpg" class="img-fluid"> 
        </div>
        <div class="col-md d-flex flex-column p-4">
            <h2>15 minutes count</h2>
            <h4>Line 1</h4>
            <h4>Line 2</h4>
            <h4>Line 3</h4>
        </div>
    </div>
</div>
<div class="container mb-3" id="transect">
    <div class="row">
        <div class="col-md d-flex p-4">
            <img src="images/bf6.jpg" class="img-fluid"> 
        </div>
        <div class="col-md d-flex flex-column p-4">
            <h2>Walk transect</h2>
            <h4>Line 1</h4>
            <h4>Line 2</h4>
            <h4>Line 3</h4>
        </div>
    </div>
</div>
<div class="container mb-3" id="fit">
    <div class="row switch-direction">
        <div class="col-md d-flex p-4">
            <img src="images/bf6.jpg" class="img-fluid"> 
        </div>
        <div class="col-md d-flex flex-column p-4">
            <h2>Fit count</h2>
            <h4>Line 1</h4>
            <h4>Line 2</h4>
            <h4>Line 3</h4>
        </div>
    </div>
</div>

@endsection