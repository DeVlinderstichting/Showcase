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
                Translations
            </h5>
            <div class="card-body">
                Translations: <br>
                <table> 
                    <tr><th style="width: 20%">Key</th><th style="width: 40%">En</th><th style="width: 40%">{{$language}}</th></tr>
                        @foreach(\App\Models\Language::all() as $lan)
                            <tr><td>{{$lan->key}}</td><td>{{$lan->en}}</td><td><textarea type="text" id="tr_{{$lan->id}}_{{$language}}" class="form-control" onkeyup="uploadTranslation({{$lan->id}}, '{{$language}}');">{{$lan->$language}}</textarea></td></tr>
                        @endforeach
                </table>
            </div>
            <script>
                function uploadTranslation(keyId, languageName)
                {
                    var value = document.getElementById('tr_' + keyId + "_" + languageName).value;
                    $.ajax({
                        type:'GET',
                        url: '/translationPutAjax',
                        data: 
                        {
                            "key": keyId, 
                            "language": languageName,
                            "value": value
                        },
                        success:function(data) 
                        {
                        }
                    });
                }
            </script>
        </div>
    </div>
@endsection
