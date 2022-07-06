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
                Text translations
            </h5>
            <div class="card-body">
                Translations: <br>
                    <?php $lanArr = ['nl','en','fr','es','pt','it','de','dk','no','se','fi','ee','lv','lt','pl','cz','sk','hu','au','ch','si','hr','ba','rs','me','al','gr','bg','ro']; ?>
                    @foreach($lanArr as $lan)
                        <a href="/translationEdit/{{$lan}}" class="btn btn-secondary m-1">{{$lan}}</a>
                    @endforeach
                <br>
                <a href="/adminHome" class="btn btn-secondary m-1">Back</a>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="card mb-2">
            <h5 class="card-header">
                Species translations
            </h5>
            <div class="card-body">
                Translations: <br>
                    <?php $lanArr = ['nl','en','fr','es','pt','it','de','dk','no','se','fi','ee','lv','lt','pl','cz','sk','hu','au','ch','si','hr','ba','rs','me','al','gr','bg','ro']; ?>
                    @foreach($lanArr as $lan)
                        <a href="/speciesTranslationEdit/{{$lan}}" class="btn btn-secondary m-1">{{$lan}}</a>
                    @endforeach
                <br>
                <a href="/adminHome" class="btn btn-secondary m-1">Back</a>
            </div>
        </div>
    </div>
@endsection
