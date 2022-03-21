@extends('layouts.app')

@section('title')
Welcome to showcase
@endsection

@section('content')
<div class="container title-container d-flex">
        <div class="central-container">
            <h1 class="text-center">Showcase</h1>
            <h3 class="text-center">Een subtitle</h3>
            <h3 class="text-center">Nog een subtitle</h3>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md d-flex p-4">
            <img src="images/bf6.jpg" class="img-fluid"> 
        </div>
        <div class="col-md d-flex flex-column justify-content-center p-4">
            <h2>Monitoring</h2>
            <h4>Line 1</h4>
            <h4>Line 2</h4>
            <h4>Line 3</h4>
            <a href="#" class="btn btn-outline-primary w-75">Button</a>
        </div>
    </div>
</div>
<div class="container">
    <div class="row switch-direction">
        <div class="col-md d-flex p-4">
            <img src="images/bf6.jpg" class="img-fluid"> 
        </div>
        <div class="col-md d-flex flex-column justify-content-center p-4">
            <h2>Identification</h2>
            <h4>Line 1</h4>
            <h4>Line 2</h4>
            <h4>Line 3</h4>
            <a href="#" class="btn btn-outline-primary w-75">Button</a>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md d-flex p-4">
            <img src="images/bf6.jpg" class="img-fluid"> 
        </div>
        <div class="col-md d-flex flex-column justify-content-center p-4">
            <h2>News</h2>
            <h4>Line 1</h4>
            <h4>Line 2</h4>
            <h4>Line 3</h4>
            <a href="#" class="btn btn-outline-primary w-75">Button</a>
        </div>
    </div>
</div>



@endsection