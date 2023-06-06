@extends('layouts.app')

@section('title')
{{\App\Models\Language::getItem('generalPagesIdHelpTitle')}} 
@endsection

@section('content')
<div class="container mb-3-colour">
    <h1 class="p-4 identification-title-header">{{\App\Models\Language::getItem('generalPagesIdHelpHeader')}} </h1>
    <p class="px-4 identification-title-sub">{{\App\Models\Language::getItem('generalPagesIdHelpSubHeader')}}</p>
</div>
<div class="container text-center mt-3 mb-3">
    <a href="#eu" class="btn btn-primary identification-section-button">Europe</a>
    <a href="#nl" class="btn btn-primary identification-section-button">Netherlands</a>
    <a href="#gb" class="btn btn-primary identification-section-button">United Kingdom</a>
    <a href="#es" class="btn btn-primary identification-section-button">Spain</a>
    <a href="#se" class="btn btn-primary identification-section-button">Sweden</a>
</div>
<div class="container mb-3" id="eu">
    <div class="row">
        <div class="col-md d-flex flex-column p-4">
            <h2 class="identification-section-title">Europe</h2>
            <ul class="list-group identification-list-group">
                <li class="list-group-item identification-list-group-item">
                    Butterflies of Central Europe & Britain by Peter Gergely <br>This Field Guide contains information to identify <b>269 butterfly species</b> occurring in Britain, Western and Central Europe. With detailed pictures of identification characteristics and precise pointing marks, this Guide will help you to identify difficult and similar species. <br><br>Author Peter Gergely. A hardcopy can be bought at the <a href="https://www.vlinderstichting.nl">Dutch Butterfly Conservation</a>. 
                    <a class="btn btn-primary btn-sm float-end identification-section-button-list" href="\resources\GergelyButterflyGuide.pdf">link</a>
                </li>
                <li class="list-group-item identification-list-group-item">
                    Identify the differences between wild bees, bumblebees, wasps and hovervlies
                    <a class="btn btn-primary btn-sm float-end identification-section-button-list" href="https://jessicatowne.medium.com/how-to-tell-the-difference-between-bees-wasps-and-flies-e6361dd724ca">link</a>
                </li> 
            </ul>
        </div>
    </div>
</div>
<div class="container mb-3" id="nl">
    <div class="row">
        <div class="col-md d-flex flex-column p-4">
            <h2 class="identification-section-title">Netherlands</h2>
            <ul class="list-group identification-list-group">
                <li class="list-group-item identification-list-group-item">
                    Vlinder herkenningskaart
                    <a class="btn btn-primary btn-sm float-end identification-section-button-list" href="https://www.vlinderstichting.nl/vlinders/vlinders-herkennen/herkenningskaart/ ">link</a>
                </li> 
                <li class="list-group-item identification-list-group-item">
                    Wilde bijen determinatie
                    <a class="btn btn-primary btn-sm float-end identification-section-button-list" href="https://www.bestuivers.nl/wilde-bijen/herkenning-en-determinatie">link</a>
                </li>
                <li class="list-group-item identification-list-group-item">
                    Hommels
                    <a class="btn btn-primary btn-sm float-end identification-section-button-list" href="https://www.vlinderstichting.nl/bijen/hommels/">link</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="container mb-3" id="gb">
    <div class="row">
        <div class="col-md d-flex flex-column p-4">
            <h2 class="identification-section-title">United Kingdom</h2>
            <ul class="list-group identification-list-group">
                <li class="list-group-item identification-list-group-item">
                    Butterfly identification guide by Butterfly Conservation
                    <a class="btn btn-primary btn-sm float-end identification-section-button-list" href="https://butterfly-conservation.org/butterflies/identify-a-butterfly">link</a>
                </li>
                <li class="list-group-item identification-list-group-item">
                    Common UK Butterfly Identification and Facts - Woodland Trust
                    <a class="btn btn-primary btn-sm float-end identification-section-button-list" href="https://www.woodlandtrust.org.uk/blog/2019/07/butterfly-identification/">link</a>
                </li>
                <li class="list-group-item identification-list-group-item">
                    Bumblebee identification guide by Bumblebee Conservation Trust
                    <a class="btn btn-primary btn-sm float-end identification-section-button-list" href="https://www.bumblebeeconservation.org/bumblebee-species-guide/">link</a>
                </li>
                <li class="list-group-item identification-list-group-item">
                    <i>What's that bumblebee</i> app by Bumblebee Conservation Trust
                    <a class="btn btn-primary btn-sm float-end identification-section-button-list" href="https://apps.apple.com/gb/app/whats-that-bumblebee/id1509257038">iOS</a>
                    <a class="btn btn-primary btn-sm float-end identification-section-button-list" href="https://play.google.com/store/apps/details?id=com.bbct.bumblebee&hl=en">Android</a>
                </li>
                <li class="list-group-item identification-list-group-item">
                    UK Pollinator Monitoring Scheme (POMS)
                    <a class="btn btn-primary btn-sm float-end identification-section-button-list" href="https://ukpoms.org.uk/species-recording">link</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="container mb-3" id="es">
    <div class="row">
        <div class="col-md d-flex flex-column p-4">
            <h2 class="identification-section-title">Spain</h2>
            <ul class="list-group identification-list-group">
                <li class="list-group-item identification-list-group-item">
                    Field Guide Andalucia - Spain <br>This Field Guide includes 93 of the most common butterfly species in Andalusia in just 12 pages. This Guide aims to be useful by reducing the number of butterflies in an area as rich and diverse as Andalusia. You can download the guide in pdf and various formats: <br>
                    <a href="https://butterfly-monitoring.net/sites/default/files/Pdf/Field%20Guides/Field-Guide_SP_Andalucia%20(low).pdf">Andalusia Guide (Spanish): to print directly, three sheets to be printed on both sides, the pages are ordered for printing.</a><br>
                    <a href="https://butterfly-monitoring.net/sites/default/files/Pdf/Field%20Guides/Field-Guide_SP_Andalucia_12pages%20lowsize.pdf">Andalusia guide by pages (Spanish): pdf with individualized pages to download to your device</a><br>
                    <a href="https://butterfly-monitoring.net/sites/default/files/Pdf/Field%20Guides/Field-Guide_SP_Andalucia_English%20(low).pdf">Andalusia Guide (English): to print directly, four sheets to be printed on both sides, the pages are ordered for printing. </a>
                </li>
                <li class="list-group-item identification-list-group-item">
                    Field Guide Castilla-La Mancha - Spain <br>
                    Castilla-La Mancha is a region of the peninsular centere of Spain with a great diversity of ecosystems: mountain ranges, wetlands, river valleys good for the diversity of butterflies. You can download the CLM Field Guide guide in pdf format with the 72 most common butterfly species in CLM in 8 pages: <br>
                    <a href="https://butterfly-monitoring.net/sites/default/files/Pdf/Field%20Guides/Field-Guide_SP_CLM%20final%20v1.pdf">    (Spanish): two sheets to be printed on both sides, the pages are ordered for printing. </a><br>
                    <a href="https://butterfly-monitoring.net/sites/default/files/Pdf/Field%20Guides/Field-Guide_SP_CLM_8pages_version1_2020.pdf">(Spanish): pdf with individualized pages to download to your device or print</a><br>
                    <a href="https://butterfly-monitoring.net/sites/default/files/Pdf/Field%20Guides/Field-Guide_SP_CLM_8pages_version1_2021_English_final.pdf">pdf English version of individualized pages to download to your device or print</a>
                </li>
                <li class="list-group-item identification-list-group-item">
                    Bees
                    <a class="btn btn-primary btn-sm float-end identification-section-button-list" href="http://www.abejassilvestres.es/resources.html#guias">link</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="container mb-3" id="se">
    <div class="row">
        <div class="col-md d-flex flex-column p-4">
            <h2 class="identification-section-title">Sweden</h2>
            <ul class="list-group identification-list-group">
                <li class="list-group-item identification-list-group-item">
                    Swedish butterflies
                    <a class="btn btn-primary btn-sm float-end identification-section-button-list" href="https://www.dagfjarilar.lu.se/">link</a>
                </li>
                <li class="list-group-item identification-list-group-item">
                    Various
                    <a class="btn btn-primary btn-sm float-end identification-section-button-list" href="https://artfakta.se/artbestamning">link</a>
                </li>
            </ul>
        </div>
    </div>
</div>
@foreach($idHelps as $idHelp)
    @if ($idHelp != null)
        {{$idHelp}}
    @endif
@endforeach

@endsection
