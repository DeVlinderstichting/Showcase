@extends('layouts.app')

@section('title')
{{\App\Models\Language::getItem('projectInfoTitle')}}
@endsection

@section('content')
<div class="container mb-3-colour">
    <h1 class="p-4 about-title-header">{{\App\Models\Language::getItem('projectInfoHeader')}}</h1>
    <h2 class="px-4 about-title-sub">{{\App\Models\Language::getItem('projectInfoSubHeader')}}</h2>
</div>
<div class="container mb-3">
    <div class="row">
        <div class="col-md d-flex p-4">
            <img src="images/bf6.jpg" class="img-fluid about-section-image"> 
        </div>
        <div class="col-md d-flex flex-column p-4">
            <h2 class="about-section-title">{{\App\Models\Language::getItem('projectInfoAboutTitle')}}</h2>
            <h4 class="about-section-subtitle">{{\App\Models\Language::getItem('projectInfoAboutSubTitle')}}</h4>
            <h4 class="about-section-subtitle">{{\App\Models\Language::getItem('projectInfoAboutParagraph1')}}</h4>
            <h4 class="about-section-subtitle">{{\App\Models\Language::getItem('projectInfoAboutParagraph2')}}</h4>
            <h4 class="about-section-subtitle"><a href="https://showcase-project.eu">{{\App\Models\Language::getItem('projectInfoReadMore')}}</a></h4>
        </div>
    </div>
</div>
<!-- <div class="container mb-3">
    <div class="row">
        <div class="col-md p-4">
            <h2 class="px-4 about-section-title">Institutions</h2>
        </div>
        <div class="d-flex flex-nowrap about-institution-scroller" style="overflow-x: auto;">
             <div class="flex-shrink-0 about-institution-item" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;">Dutch Butterfly Conservation (De Vlinderstichting), Netherlands</div>
             <div class="flex-shrink-0 about-institution-item" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;">The University of Reading (UREAD), United Kingdom</div>
            <div class="flex-shrink-0 about-institution-item" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;">Swedish University of Agricultural Sciences (SLU), Sweden</div>
            <div class="flex-shrink-0 about-institution-item" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;">Scienseed SL, Spain</div>
            <div class="flex-shrink-0 about-institution-item" style="margin: 2rem; background-color: grey; width: 200px; height: 200px;">Spanish National Research Council (CSIC), Spain</div>
        </div>
    </div>
</div>
 -->

@endsection