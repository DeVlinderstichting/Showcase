@extends('layouts.app')

@section('title')
{{\App\Models\Language::getItem('monitoringGuideTitle')}} 
@endsection

@section('content')
<div class="container mb-3">
    <h1 class="p-4 monitoring-title-header">{{\App\Models\Language::getItem('monitoringGuideHeader')}}</h1>
    <h2 class="px-4 monitoring-title-sub"></h2>
</div>
<div class="container text-center mt-3 mb-3">
    <a href="#special" class="btn btn-primary monitoring-section-button">{{\App\Models\Language::getItem('monitoringGuideISawSomethingSpecialTitle')}}</a>
    <a href="#15min" class="btn btn-primary monitoring-section-button">{{\App\Models\Language::getItem('monitoringGuide15mTitle')}}</a>
    <a href="#transect" class="btn btn-primary monitoring-section-button">{{\App\Models\Language::getItem('monitoringGuideTransectTitle')}}</a>
    <a href="#fit" class="btn btn-primary monitoring-section-button">{{\App\Models\Language::getItem('monitoringGuideFitTitle')}}</a>
</div>
<div class="container mb-3" id="special">
    <div class="row">
        <div class="col-md d-flex p-4">
            <img src="images/bf6.jpg" class="img-fluid monitoring-section-image"> 
        </div>
        <div class="col-md d-flex flex-column p-4">
            <h2 class="monitoring-section-title">{{\App\Models\Language::getItem('monitoringGuideISawSomethingSpecialTitle')}}</h2>
            <h4 class="monitoring-section-subtitle">{{\App\Models\Language::getItem('monitoringGuideISawSomethingSpecialText')}}</h4>
        </div>
    </div>
</div>
<div class="container mb-3" id="15min">
    <div class="row switch-direction">
        <div class="col-md d-flex p-4">
            <img src="images/bf6.jpg" class="img-fluid monitoring-section-image"> 
        </div>
        <div class="col-md d-flex flex-column p-4">
            <h2 class="monitoring-section-title">{{\App\Models\Language::getItem('monitoringGuide15mTitle')}}</h2>
            <h4 class="monitoring-section-subtitle">{{\App\Models\Language::getItem('monitoringGuide15mText')}}</h4>
        </div>
    </div>
</div>
<div class="container mb-3" id="transect">
    <div class="row">
        <div class="col-md d-flex p-4">
            <img src="images/bf6.jpg" class="img-fluid monitoring-section-image"> 
        </div>
        <div class="col-md d-flex flex-column p-4">
            <h2 class="monitoring-section-title">{{\App\Models\Language::getItem('monitoringGuideTransectTitle')}}</h2>
            <h4 class="monitoring-section-subtitle">{{\App\Models\Language::getItem('monitoringGuideTransectText')}}</h4>
        </div>
    </div>
</div>
<div class="container mb-3" id="fit">
    <div class="row switch-direction">
        <div class="col-md d-flex p-4">
            <img src="images/bf6.jpg" class="img-fluid monitoring-section-image"> 
        </div>
        <div class="col-md d-flex flex-column p-4">
            <h2 class="monitoring-section-title">{{\App\Models\Language::getItem('monitoringGuideFitTitle')}}</h2>
            <h4 class="monitoring-section-subtitle">{{\App\Models\Language::getItem('monitoringGuideFitText')}}</h4>
        </div>
    </div>
</div>

@endsection
