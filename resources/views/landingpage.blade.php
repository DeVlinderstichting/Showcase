@extends('layouts.app')

@section('title')
Welcome to InsectsCount
@endsection

@section('content')
<div class="container landingpage-title-container d-flex">
        <div class="central-container">
            <h1 class="text-center landingpage-title-header">InsectsCount</h1>
            <h3 class="text-center landingpage-title-sub">Een subtitle</h3>
            <h3 class="text-center landingpage-title-sub">Nog een subtitle</h3>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md d-flex p-4">
            <img src="images/bf6.jpg" class="img-fluid landingpage-section-image"> 
        </div>
        <div class="col-md d-flex flex-column justify-content-center p-4">
            <h2 class="landingpage-section-title">Monitoring</h2>
            <h4 class="landingpage-section-subtitle">Line 1</h4>
            <h4 class="landingpage-section-subtitle">Line 2</h4>
            <h4 class="landingpage-section-subtitle">Line 3</h4>
            <a href="/showRecordingMethodExplanation" class="btn btn-outline-primary w-75 landingpage-section-button">Button</a>
        </div>
    </div>
</div>
<div class="container">
    <div class="row switch-direction">
        <div class="col-md d-flex p-4">
            <img src="images/bf6.jpg" class="img-fluid landingpage-section-image"> 
        </div>
        <div class="col-md d-flex flex-column justify-content-center p-4">
            <h2 class="landingpage-section-title">Identification</h2>
            <h4 class="landingpage-section-subtitle">Line 1</h4>
            <h4 class="landingpage-section-subtitle">Line 2</h4>
            <h4 class="landingpage-section-subtitle">Line 3</h4>
            <a href="/showIdHelp" class="btn btn-outline-primary w-75 landingpage-section-button">Button</a>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md d-flex p-4">
            <img src="images/bf6.jpg" class="img-fluid landingpage-section-image"> 
        </div>
        <div class="col-md d-flex flex-column justify-content-center p-4">
            <h2 class="landingpage-section-title">News</h2>
            <h4 class="landingpage-section-subtitle">Line 1</h4>
            <h4 class="landingpage-section-subtitle">Line 2</h4>
            <h4 class="landingpage-section-subtitle">Line 3</h4>
            <a href="/news" class="btn btn-outline-primary w-75 landingpage-section-button">Button</a>
        </div>
    </div>
</div>



@endsection