@extends('layouts.app')

@section('title')
Project information
@endsection

@section('content')
<div class="container mb-3">
    <h1 class="p-4 about-title-header">Project information</h1>
    <h2 class="px-4 about-title-sub">SHOWCASing synergies between agriculture, biodiversity and Ecosystem services to help farmers capitalising on native biodiversity.</h2>
</div>
<div class="container mb-3">
    <div class="row">
        <div class="col-md d-flex p-4">
            <img src="images/bf6.jpg" class="img-fluid about-section-image"> 
        </div>
        <div class="col-md d-flex flex-column p-4">
            <h2 class="about-section-title">About SHOWCASE</h2>
            <h4 class="about-section-subtitle">SHOWCASE is dedicated to the integration of biodiversity into farming practices. Biodiversity is closely interrelated with the development of the agricultural sector. Farmland biodiversity is steeply declining throughout Europe. Society at large is increasingly concerned about the loss of public goods, such as iconic wildlife and cultural landscapes.  Long-term monitoring of biodiversity across European countries is increasingly reliant on efforts by members of the public. </h4>
            <h4 class="about-section-subtitle">In the context of achieving the European goal of sustainable farming production, a bridge of knowledge between incentives of agricultural producers and biodiversity management practices is key. Various platforms allow people to volunteer biodiversity observations opportunistically, covering a wide range of species and habitats. </h4>
            <h4 class="about-section-subtitle">Yet, the unstructured and often closed nature of those data make it difficult to determine biodiversity trends, particularly when needing to appraise changes in land use in specific regions or landscape types. On this platform, citizen scientists and famers can record and share their data.</h4>
            <h4 class="about-section-subtitle"><a href="https://showcase-project.eu">More about Showcase?</a></h4>


        </div>
    </div>
</div>
<div class="container mb-3">
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


@endsection