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
    <button class="btn btn-primary">Netherlands</button>
    <button class="btn btn-primary">United Kingdom</button>
    <button class="btn btn-primary">Spain</button>
    <button class="btn btn-primary">Germany</button>
</div>
<div class="container mb-3">
    <div class="row">
        <div class="col-md d-flex p-4">
            <img src="images/bf6.jpg" class="img-fluid"> 
        </div>
        <div class="col-md d-flex flex-column p-4">
            <h2>Netherlands</h2>
            <h4>Line 1</h4>
            <h4>Line 2</h4>
            <h4>Line 3</h4>
        </div>
    </div>
</div>
<div class="container mb-3">
    <div class="row switch-direction">
        <div class="col-md d-flex p-4">
            <img src="images/bf6.jpg" class="img-fluid"> 
        </div>
        <div class="col-md d-flex flex-column p-4">
            <h2>United Kingdom</h2>
            <h4>Line 1</h4>
            <h4>Line 2</h4>
            <h4>Line 3</h4>
        </div>
    </div>
</div>
<div class="container mb-3">
    <div class="row">
        <div class="col-md d-flex p-4">
            <img src="images/bf6.jpg" class="img-fluid"> 
        </div>
        <div class="col-md d-flex flex-column p-4">
            <h2>Spain</h2>
            <h4>Line 1</h4>
            <h4>Line 2</h4>
            <h4>Line 3</h4>
        </div>
    </div>
</div>
<div class="container mb-3">
    <div class="row switch-direction">
        <div class="col-md d-flex p-4">
            <img src="images/bf6.jpg" class="img-fluid"> 
        </div>
        <div class="col-md d-flex flex-column p-4">
            <h2>Germany</h2>
            <h4>Line 1</h4>
            <h4>Line 2</h4>
            <h4>Line 3</h4>
        </div>
    </div>
</div>

@endsection