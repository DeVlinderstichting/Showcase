@extends('layouts.app')

@section('title')
Species Identification
@endsection

@section('content')
<div class="container mb-3">
    <h1 class="p-4">Species Identification</h1>
    <h2 class="px-4">Subtitle</h2>
</div>
<div class="container mb-3">
    <div class="row">
        <div class="col-md d-flex flex-column p-4">
            <ul class="list-group">
                <li class="list-group-item">
                    List item 1
                    <button class="btn btn-primary btn-sm float-end">link</button>
                </li>
                <li class="list-group-item">
                    List item 2
                    <button class="btn btn-primary btn-sm float-end">link</button>
                </li>
                <li class="list-group-item">
                    List item 3
                    <button class="btn btn-primary btn-sm float-end">link</button>
                </li>
                <li class="list-group-item">
                    List item 4
                    <button class="btn btn-primary btn-sm float-end">link</button>
                </li>
                <li class="list-group-item">
                    List item 5
                    <button class="btn btn-primary btn-sm float-end">link</button>
                </li>
                <li class="list-group-item">
                    List item 6
                    <button class="btn btn-primary btn-sm float-end">link</button>
                </li>
                <li class="list-group-item">
                    List item 7
                    <button class="btn btn-primary btn-sm float-end">link</button>
                </li>
                <li class="list-group-item">
                    List item 8
                    <button class="btn btn-primary btn-sm float-end">link</button>
                </li>
                <li class="list-group-item">
                    List item 9
                    <button class="btn btn-primary btn-sm float-end">link</button>
                </li>   
                <li class="list-group-item">
                    List item 10
                    <button class="btn btn-primary btn-sm float-end">link</button>
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
