@extends('layouts.app')

@section('title')
Welcome to InsectsCount
@endsection

@section('sidebar')
    @include('layouts.navbar',['menuActive'=>'users'])
@endsection

@section('content')
<div class="container-fluid background-container d-flex">
    <div class="central-container" align="middle">
        <h1>Welcome to InsectsCount</h1>
        <h2 align="middle">Select your device</h2>
        <div align='middle'>
            <a href='/index.html'>
                <img src='/img/smartphone-icon.png' alt='smartphone icon' height='100' hspace='30' vspace='20'></a>
            <a href='/showLoginScreen'>
                <img src='/img/computer-monitor-icon.png' alt='monitor icon' height='100' hspace='30' vspace='20'></a>
        </div>
    </div>
</div>
@endsection