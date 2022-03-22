@extends('layouts.app')

@section('title')
Translations
@endsection

@section('sidebar')
    @include('layouts.navbar',['menuActive'=>'adminhome'])
@endsection

@section('extraNavItems')
@endsection

@section('content')
    <div class="container mt-4">
        <div class="card mb-2">
            <h5 class="card-header">
                Identifiction help
            </h5>
            <div class="card-body">
                @foreach($idHelps as $idHelp)
                    @if ($idHelp != null)
                        {{$idHelp}}
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
