@extends('layouts.app')

@section('title')
{{\App\Models\Language::getItem('projectInfoTitle')}}
@endsection

@section('content')
    <div class="container mb-3-colour">
        <h1 class="p-4 about-title-header">{{$eba->name}}</h1>
        <h2 class="px-4 about-title-sub">{{$eba->description}}</h2>
    </div>
    <div class="container mb-3">

        <div class="row">
            <div class="col-md p-4">
                 {{\App\Models\Language::getItem('regionInfoBeforeTime')}} <b>{{$totalVisitTime}}</b>&nbsp;{{\App\Models\Language::getItem('regionInfoAfterTime')}}
            </div>
            <div class="col-md flex-column p-4">
                {{\App\Models\Language::getItem('regionInfoBeforeDistance')}}&nbsp;<b>{{intval($totalVisitLength)}}</b>&nbsp;{{\App\Models\Language::getItem('regionInfoAfterDistance')}}
            </div>
            <div class="col-md flex-column p-4">
                {{\App\Models\Language::getItem('regionInfoBeforeIndivCount')}}&nbsp;<b>{{$nrOfIndividuals}}</b>&nbsp;{{\App\Models\Language::getItem('regionInfoBetweenIndivCountAndSpNr')}}&nbsp;<b>{{$nrOfSpecies}}</b>&nbsp;{{\App\Models\Language::getItem('regionInfoAfterNrOfSpecies')}}
                <br>
            </div>
        </div>
        <div class="row"> 
            @include('layouts.map_show', ['countObjects'=>[$eba], 'showSectionNrs' => 0, 'mapPrefix' => $eba->id])
            <script>
                $( document ).ready(function() 
                {
                    var map = $('#map{{$eba->id}}').data('map{{$eba->id}}');
                    map.updateSize();
                })
            </script>
        </div>
        <div class="row">
            <div class="col-md flex-column p-4">
                <div class="userhome-section-graph">
                    <canvas id="visitsPerYearGraph"></canvas>
                    <canvas id="landscapeCompGraph"></canvas>
                </div>
            </div>
            <div class="col-md flex-column p-4">
                <div class="userhome-section-graph">
                    <canvas id="spCompGraph"></canvas>
                </div>
            </div>
            <div class="col-md flex-column p-4">
                <div class="userhome-section-graph">
                    <canvas id="managementCompGraph"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
    <script>
        var colorScheme = [];
        var landscapeLabels = [];
        var managementLabels = [];
        var visitsPerYearLabels = [];
        var speciesLabels = [];
        var countPerLandscape = [];
        var countPerManagement = [];
        var visitsPerYearInputData = [];
        var countPerSp = [];
        

        function getRandomColor() 
        {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        @foreach($landuse as $l)
            @if (!empty($l->landusetype_id))
                landscapeLabels.push('{{\App\Models\LanduseType::find($l->landusetype_id)->description}}');
                countPerLandscape.push({{$l->landscapecount}});
            @endif
        @endforeach

        @foreach($management as $m)
            @if (!empty($m->managementtype_id))
                managementLabels.push('{{\App\Models\ManagementType::find($m->managementtype_id)->description}}');
                countPerManagement.push({{$m->managementcount}});
            @endif
        @endforeach
        
        @foreach($visitsPerYear as $vpy)
            visitsPerYearLabels.push({{$vpy->year}});
            visitsPerYearInputData.push({{$vpy->countperyear}});
        @endforeach

        @foreach ($countPerSpecies as $cps)
            speciesLabels.push('{{\App\Models\Species::find($cps->spid)->getName(null)}}');
            countPerSp.push({{$cps->num}});
        @endforeach

        @for($i = 0; $i < (max([count($countPerSpecies), count($landuse), count($management)]));$i++)
            if (colorScheme.length == 0) { colorScheme.push('#62b2a0'); }
            if (colorScheme.length == 1) { colorScheme.push('#96a8be'); }
            if (colorScheme.length == 2) { colorScheme.push('#d8b667'); }
            if (colorScheme.length == 3) { colorScheme.push('#d5967d'); }
            if (colorScheme.length == 4) { colorScheme.push('orange'); }
            if (colorScheme.length == 5) { colorScheme.push('gray'); }
            if (colorScheme.length == 6) { colorScheme.push('purple'); }
            if (colorScheme.length > 6) { colorScheme.push(getRandomColor()); }
           // var randomColor = Math.floor(Math.random()*16777215).toString(16);
        @endfor

        const pieLandscapeCompData = {
            labels: landscapeLabels,
            datasets: [{
                label: '{{\App\Models\Language::getItem('regionInfoPieChartLandscapesInEba')}}',
                backgroundColor: colorScheme,
                borderColor: colorScheme,
                data: countPerLandscape
            }]
        };

        const pieManagementCompData = {
            labels: managementLabels,
            datasets: [{
                label: '{{\App\Models\Language::getItem('regionInfoPieChartManagementInEba')}}',
                backgroundColor: colorScheme,
                borderColor: colorScheme,
                data: countPerManagement
            }]
        };

        const visitsPerYearData = {
            labels: visitsPerYearLabels,
            datasets: [{
                    label: '{{\App\Models\Language::getItem('regionInfoVisitsPerYearTitle')}}',
                    backgroundColor: 'rgb(180, 50, 70)',
                    borderColor: 'rgb(180, 50, 70)',
                    data: visitsPerYearInputData,
                }
            ]
        };

        const pieSpCompData = {
            labels: speciesLabels,
            datasets: [{
                label: '{{\App\Models\Language::getItem('regionInfoPieChartSpeciesInEba')}}',
                backgroundColor: colorScheme,
                borderColor: colorScheme,
                data: countPerSp
            }]
        };

        const landscapeCompConfig = {
            type: 'pie',
            data: pieLandscapeCompData,
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: '{{\App\Models\Language::getItem('regionInfoPieChartLandscapesInEba')}}'
                    }, 
                    datalabels: {
                        color: '#36A2EB'
                    }
                }
            }
        };

        const managementCompConfig = {
            type: 'pie',
            data: pieManagementCompData,
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: '{{\App\Models\Language::getItem('regionInfoPieChartManagementInEba')}}'
                    }, 
                    datalabels: {
                        color: '#36A2EB'
                    }
                }
            }
        };

        const visitsPerYearConfig = {
            type: 'bar',
            data: visitsPerYearData,
            options: {}
        };

        const spCompConfig = {
            type: 'pie',
            data: pieSpCompData,
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: '{{\App\Models\Language::getItem('regionInfoPieChartSpeciesInEba')}}'
                    }
                }
            }
        };
        const chartVisitsPerYear = new Chart(document.getElementById('visitsPerYearGraph'),visitsPerYearConfig);
        const chartPieLandscapeComp = new Chart(document.getElementById('landscapeCompGraph'),landscapeCompConfig);
        const chartPieManagementComp = new Chart(document.getElementById('managementCompGraph'),managementCompConfig);
        const chartPieSpComp = new Chart(document.getElementById('spCompGraph'),spCompConfig);
    </script>

@endsection