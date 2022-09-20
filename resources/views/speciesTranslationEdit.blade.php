@extends('layouts.app')

@section('meta')
    @include('layouts.forceReload',[])
@endsection

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
                <a href="/adminHome" class="btn btn-secondary">Back</a><br>
                Translations
            </h5>
            <div class="card-body">
                Translations: <br>
                <table> 
                    <tr><th style="width: 20%">Species</th><th style="width: 40%">En</th><th style="width: 40%">{{$language}}</th></tr>
                        @foreach(\App\Models\Species::all() as $sp)
                            <tr><td>{{$sp->genus}} {{$sp->taxon}}</td><td>{{$sp->enname}}</td><td><textarea type="text" id="tr_{{$sp->id}}_{{$language}}" class="form-control" onkeyup="uploadTranslation({{$sp->id}}, '{{$language}}');"><?php $fieldName = $language."name"; echo($sp->$fieldName); ?></textarea></td></tr>
                        @endforeach
                </table>
            </div>
            <script>
                function uploadTranslation(spId, languageName)
                {
                    var value = document.getElementById('tr_' + spId + "_" + languageName).value;
                    $.ajax({
                        type:'GET',
                        url: '/speciesTranslationPutAjax',
                        data: 
                        {
                            "spId": spId, 
                            "language": languageName,
                            "value": value
                        },
                        success:function(data) 
                        {
                        },
                        fail:function(data)
                        {
                            alert("Unable to save, please check your connection!");
                        }
                    });
                }
            </script>
        </div>
        <a href="/adminHome" class="btn btn-secondary">Back</a>
    </div>
@endsection
