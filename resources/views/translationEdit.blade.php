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
                    <tr><th>Key</th><th>En</th><th>{{$language}}</th></tr>
                        @foreach(\App\Models\Language::all() as $lan)
                            <tr><td>{{$lan->key}}</td><td>{{$lan->en}}</td><td><input type="text" id="tr_{{$lan->id}}_{{$language}}" class="form-control" onkeyup="uploadTranslation({{$lan->id}}, {{$language}});" value="{{$lan->$language}}"></td></tr>
                        @endforeach
                </table>
            </div>
            <script>
                function uploadTranslation(keyId, languageName)
                {
                    
                }
            </script>
        </div>
    </div>
@endsection
