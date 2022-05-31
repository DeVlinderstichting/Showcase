@extends('layouts.app')

@section('title')
Guide to monitoring
@endsection

@section('content')
<div class="container mb-3">
    <h1 class="p-4 monitoring-title-header">Guide to monitoring</h1>
    <h2 class="px-4 monitoring-title-sub">Subtitle</h2>
</div>
<div class="container text-center mt-3 mb-3">
    <a href="#special" class="btn btn-primary monitoring-section-button">I saw something special</a>
    <a href="#15min" class="btn btn-primary monitoring-section-button">15 minutes count</a>
    <a href="#transect" class="btn btn-primary monitoring-section-button">Walk transect</a>
    <a href="#fit" class="btn btn-primary monitoring-section-button">Fit count</a>
</div>
<div class="container mb-3" id="special">
    <div class="row">
        <div class="col-md d-flex p-4">
            <img src="images/bf6.jpg" class="img-fluid monitoring-section-image"> 
        </div>
        <div class="col-md d-flex flex-column p-4">
            <h2 class="monitoring-section-title">I saw something special</h2>
            <h4 class="monitoring-section-subtitle">Line 1</h4>
            <h4 class="monitoring-section-subtitle">Line 2</h4>
            <h4 class="monitoring-section-subtitle">Line 3</h4>
        </div>
    </div>
</div>
<div class="container mb-3" id="15min">
    <div class="row switch-direction">
        <div class="col-md d-flex p-4">
            <img src="images/bf6.jpg" class="img-fluid monitoring-section-image"> 
        </div>
        <div class="col-md d-flex flex-column p-4">
            <h2 class="monitoring-section-title">15 minutes count</h2>
            <h4 class="monitoring-section-subtitle">Line 1</h4>
            <h4 class="monitoring-section-subtitle">Line 2</h4>
            <h4 class="monitoring-section-subtitle">Line 3</h4>
        </div>
    </div>
</div>
<div class="container mb-3" id="transect">
    <div class="row">
        <div class="col-md d-flex p-4">
            <img src="images/bf6.jpg" class="img-fluid monitoring-section-image"> 
        </div>
        <div class="col-md d-flex flex-column p-4">
            <h2 class="monitoring-section-title">Walk transect</h2>
            <h4 class="monitoring-section-subtitle">Line 1</h4>
            <h4 class="monitoring-section-subtitle">Line 2</h4>
            <h4 class="monitoring-section-subtitle">Line 3</h4>
        </div>
    </div>
</div>
<div class="container mb-3" id="fit">
    <div class="row switch-direction">
        <div class="col-md d-flex p-4">
            <img src="images/bf6.jpg" class="img-fluid monitoring-section-image"> 
        </div>
        <div class="col-md d-flex flex-column p-4">
            <h2 class="monitoring-section-title">Fit count</h2>
            <h4 class="monitoring-section-subtitle">Line 1</h4>
            <h4 class="monitoring-section-subtitle">Line 2</h4>
            <h4 class="monitoring-section-subtitle">Line 3</h4>
        </div>
    </div>
</div>

@endsection