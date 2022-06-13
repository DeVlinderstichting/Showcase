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
    <a href="#fit" class="btn btn-primary monitoring-section-button">Flowerpatch count</a>
</div>
<div class="container mb-3" id="special">
    <div class="row">
        <div class="col-md d-flex p-4">
            <img src="images/bf6.jpg" class="img-fluid monitoring-section-image"> 
        </div>
        <div class="col-md d-flex flex-column p-4">
            <h2 class="monitoring-section-title">I saw something special</h2>
            <h4 class="monitoring-section-subtitle">Imagine you are walking and suddenly you see something special.</h4><h4>An insect or flower that you have never seen before, is very beautiful or perhaps even rare, but you are not monitoring it.</h4><h4>In this case, there is the possibility to report a single observation in the Showcase app.  </h4>
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
            <h4 class="monitoring-section-subtitle">A 15-minute count is a monitoring method that can be used at any place at any time. This method is mainly used to monitor insects. You either walk around or stay in one place and report all insects that you see in the 15-minute timeframe. You can put the time on hold if you need to spend time for identification. Your track is being recorded automatically. After 15 minutes you submit the observations. If you like to continue you can start a new count at a different location.</h4>
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
            <h4 class="monitoring-section-subtitle">Transect counts only apply to sites that are included in the <a href="https://butterfly-monitoring.net">European Butterfly Monitoring Scheme (EBMS)</a>. When monitoring by walking a transect you start by setting out a transect of approximately 1 kilometre and monitoring on this transect several times between April and September, taking in to account the weather conditions. During the observation you record all insects in the app. If possible, you include fewer occurring plants and flowers. Walking a transect is a way of monitoring that provides high quality data, because one specific route is monitored long-term and throughout the season.  </h4>
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
            <h4 class="monitoring-section-subtitle">The Flowerpatch or Flower-Insect Timed (FIT) count is an easy way to observe insects and flowers in good weather. You select a flowerpatch of around 50x50 cm and note the flower type. Then you stand or sit down in one spot for 10 to 15 minutes and record all flowers and insects you observe in that timeframe.</h4>
        </div>
    </div>
</div>

@endsection
