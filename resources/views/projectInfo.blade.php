@extends('layouts.app')

@section('title')
Project information
@endsection

@section('content')
<div class="container mb-3">
    <h1 class="p-4 about-title-header">Project information</h1>
    <h2 class="px-4 about-title-sub">Subtitle</h2>
</div>
<div class="container mb-3">
    <div class="row">
        <div class="col-md d-flex p-4">
            <img src="images/bf6.jpg" class="img-fluid about-section-image"> 
        </div>
        <div class="col-md d-flex flex-column p-4">
            <h2 class="about-section-title">Introduction</h2>
            <h4 class="about-section-subtitle">Line 1</h4>
            <h4 class="about-section-subtitle">Line 2</h4>
            <h4 class="about-section-subtitle">Line 3</h4>
        </div>
    </div>
</div>
<div class="container mb-3">
    <div class="row">
        <div class="col-md p-4">
            <h2 class="px-4 about-section-title">Institutions</h2>
        </div>
        <div class="d-flex flex-nowrap about-institution-scroller" style="overflow-x: auto;">
            <div class="flex-shrink-0 about-institution-item" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;"></div>
            <div class="flex-shrink-0 about-institution-item" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;"></div>
            <div class="flex-shrink-0 about-institution-item" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;"></div>
            <div class="flex-shrink-0 about-institution-item" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;"></div>
            <div class="flex-shrink-0 about-institution-item" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;"></div>
            <div class="flex-shrink-0 about-institution-item" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;"></div>
            <div class="flex-shrink-0 about-institution-item" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;"></div>
            <div class="flex-shrink-0 about-institution-item" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;"></div>
            <div class="flex-shrink-0 about-institution-item" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;"></div>

        </div>
    </div>
</div>
<div class="container mb-3">
    <div class="row">
        <div class="col-md p-4">
            <h2 class="px-4 about-section-title">Team</h2>
        </div>
        <div class="d-flex flex-wrap about-team-container">
            <div class="flex-shrink-0 rounded-circle about-team-item" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;"></div>
            <div class="flex-shrink-0 rounded-circle about-team-item" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;"></div>
            <div class="flex-shrink-0 rounded-circle about-team-item" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;"></div>
            <div class="flex-shrink-0 rounded-circle about-team-item" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;"></div>
            <div class="flex-shrink-0 rounded-circle about-team-item" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;"></div>
            <div class="flex-shrink-0 rounded-circle about-team-item" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;"></div>
            <div class="flex-shrink-0 rounded-circle about-team-item" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;"></div>
            <div class="flex-shrink-0 rounded-circle about-team-item" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;"></div>
            <div class="flex-shrink-0 rounded-circle about-team-item" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;"></div>
        </div>
    </div>
</div>

@endsection