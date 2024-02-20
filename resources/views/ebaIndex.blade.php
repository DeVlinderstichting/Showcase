@extends('layouts.app')

@section('title')
{{\App\Models\Language::getItem('projectInfoTitle')}}
@endsection

@section('content')
<div class="container mb-3-colour">
    <h1 class="p-4 about-title-header">{{\App\Models\Language::getItem('ebaIndexInfoHeader')}}</h1>
    <h2 class="px-4 about-title-sub">{{\App\Models\Language::getItem('ebaIndexInfoSubHeader')}}</h2>
</div>
<div class="container mb-3">
    @foreach($allEbas as $eba)
        <div class="row">
            <div class="card col mb-2">
                <div class="card-body">
                    @include('layouts.map_show', ['countObjects'=>[$eba], 'showSectionNrs' => 0, 'mapPrefix' => $eba->id])
                    <script>
                        $( document ).ready(function() 
                        {
                            var map = $('#map{{$eba->id}}').data('map{{$eba->id}}');
                            map.updateSize();
                        })
                    </script>
                </div>
            </div>
            <div class="col">
                <h2 class="about-section-title">{{$eba->name}}</h2>
                <h4 class="about-section-subtitle">{{$eba->description}}</h4>
                <h4 class="about-section-subtitle"><a href="/regionPublicShow/{{$eba->id}}">{{\App\Models\Language::getItem('regionMoreInfo')}}</a></h4>
            </div>
        </div>
    @endforeach
</div>
@endsection