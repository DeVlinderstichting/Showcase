@extends('layouts.app')

@section('title')
    Visits
@endsection

@section('sidebar')

@endsection

@section('content')
    <?php 
        $isFit = false;
        $isTransect = false;
        $isSingle = false;
        $isTimed = false;
        $acm = \App\Models\CountingMethod::all();
        foreach($acm as $cm)
        {
            if ($visit->countingmethod_id == $cm->id)
            {
                if ($cm->name == 'single')
                {
                    $isSingle = true;
                }
                if ($cm->name == 'timed')
                {
                    $isTimed = true;
                }
                if ($cm->name == 'transect')
                {
                    $isTransect = true;
                }
                if ($cm->name == 'fit')
                {
                    $isFit = true;
                }
            }
        }
    ?>


    <div class="container mt-4">
        <div class="card mb-2">
            <h5 class="card-header">
                Visit
                <a class="btn btn-primary mr-3 ml-3 btn-sm float-right" role="button" href="#">Edit visit</a>
            </h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-hover vertical-align">
                        <thead>
                            <th>Item</th>
                            <th>Value</th>
                        </thead>
                        <tbody id="dataTable">
                            @if ($isSingle)
                                <tr>
                                    <td>Date</td>
                                    <td>{{$visit->startdate}}</td>
                                </tr>
                                <tr>
                                    <td>Notes</td>
                                    <td>{{$visit->notes}}</td>
                                </tr>
                            @endif
                            @if($isTimed)
                                <tr>
                                    <td>Startdate</td>
                                    <td>{{$visit->startdate}}</td>
                                </tr>
                                <tr>
                                    <td>Enddate</td>
                                    <td>{{$visit->enddate}}</td>
                                </tr>
                                <tr>
                                    <td>Number of observations</td>
                                    <td>{{$visit->observations()->count()}}
                                </tr>
                                <tr>
                                    <td>Cloud coverage</td>
                                    <td>{{$visit->cloud}}</td>
                                </tr>
                                <tr>
                                    <td>Temperature</td>
                                    <td>{{$visit->temperature}}</td>
                                </tr>
                                <tr>
                                    <td>Wind</td>
                                    <td>{{$visit->wind}}</td>
                                </tr>
                                <tr>
                                    <td>Notes</td>
                                    <td>{{$visit->notes}}</td>
                                </tr>
                            @endif
                            @if($isTransect)
                                <tr>
                                    <td>Startdate</td>
                                    <td>{{$visit->startdate}}</td>
                                </tr>
                                <tr>
                                    <td>Enddate</td>
                                    <td>{{$visit->enddate}}</td>
                                </tr>
                                <tr>
                                    <td>Duration</td>
                                    <td>{{$visit->getDuration()}}</td>
                                </tr>
                                <tr>
                                    <td>Cloud coverage</td>
                                    <td>{{$visit->cloud}}</td>
                                </tr>
                                <tr>
                                    <td>Temperature</td>
                                    <td>{{$visit->temperature}}</td>
                                </tr>
                                <tr>
                                    <td>Wind</td>
                                    <td>{{$visit->wind}}</td>
                                </tr>
                                <tr>
                                    <td>Number of observations</td>
                                    <td>{{$visit->observations()->count()}}
                                </tr>
                                <tr>
                                    <td>Notes</td>
                                    <td>{{$visit->notes}}</td>
                                </tr>
                            @endif
                            @if($isFit)
                                <tr>
                                    <td>Startdate</td>
                                    <td>{{$visit->startdate}}</td>
                                </tr>
                                <tr>
                                    <td>Enddate</td>
                                    <td>{{$visit->enddate}}</td>
                                </tr>
                                <tr>
                                    <td>Duration</td>
                                    <td>{{$visit->getDuration()}}</td>
                                </tr>
                                <tr>
                                    <td>Number of observations</td>
                                    <td>{{$visit->observations()->count()}}
                                </tr>
                                <tr>
                                    <td>Observed flower</td>
                                    <td>{{\App\Models\Species::find($visit->flower_id)->getName($user)}}
                                </tr>
                                <tr>
                                    <td>Notes</td>
                                    <td>{{$visit->notes}}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-hover vertical-align">
                        Observation
                        <thead>
                            <th>Species</th>
                            <th>Number</th>
                            @if($isTransect)
                                <th>Section</th>
                            @endif
                        </thead>
                        <tbody id="dataTable">
                            @if ($isSingle)
                                <tr>
                                    <td>Date</td>
                                    <td>{{$visit->startdate}}</td>
                                </tr>
                                <tr>
                                    <td>Notes</td>
                                    <td>{{$visit->notes}}</td>
                                </tr>
                            @endif
                            @if($isTimed)
                                <tr>
                                    <td>Startdate</td>
                                    <td>{{$visit->startdate}}</td>
                                </tr>
                                <tr>
                                    <td>Enddate</td>
                                    <td>{{$visit->enddate}}</td>
                                </tr>
                                <tr>
                                    <td>Number of observations</td>
                                    <td>{{$visit->observations()->count()}}
                                </tr>
                                <tr>
                                    <td>Cloud coverage</td>
                                    <td>{{$visit->cloud}}</td>
                                </tr>
                                <tr>
                                    <td>Temperature</td>
                                    <td>{{$visit->temperature}}</td>
                                </tr>
                                <tr>
                                    <td>Wind</td>
                                    <td>{{$visit->wind}}</td>
                                </tr>
                                <tr>
                                    <td>Notes</td>
                                    <td>{{$visit->notes}}</td>
                                </tr>
                            @endif
                            @if($isTransect)
                                <tr>
                                    <td>Startdate</td>
                                    <td>{{$visit->startdate}}</td>
                                </tr>
                                <tr>
                                    <td>Enddate</td>
                                    <td>{{$visit->enddate}}</td>
                                </tr>
                                <tr>
                                    <td>Duration</td>
                                    <td>{{$visit->getDuration()}}</td>
                                </tr>
                                <tr>
                                    <td>Cloud coverage</td>
                                    <td>{{$visit->cloud}}</td>
                                </tr>
                                <tr>
                                    <td>Temperature</td>
                                    <td>{{$visit->temperature}}</td>
                                </tr>
                                <tr>
                                    <td>Wind</td>
                                    <td>{{$visit->wind}}</td>
                                </tr>
                                <tr>
                                    <td>Number of observations</td>
                                    <td>{{$visit->observations()->count()}}
                                </tr>
                                <tr>
                                    <td>Notes</td>
                                    <td>{{$visit->notes}}</td>
                                </tr>
                            @endif
                            @if($isFit)
                                <tr>
                                    <td>Startdate</td>
                                    <td>{{$visit->startdate}}</td>
                                </tr>
                                <tr>
                                    <td>Enddate</td>
                                    <td>{{$visit->enddate}}</td>
                                </tr>
                                <tr>
                                    <td>Duration</td>
                                    <td>{{$visit->getDuration()}}</td>
                                </tr>
                                <tr>
                                    <td>Number of observations</td>
                                    <td>{{$visit->observations()->count()}}
                                </tr>
                                <tr>
                                    <td>Observed flower</td>
                                    <td>{{\App\Models\Species::find($visit->flower_id)->getName($user)}}
                                </tr>
                                <tr>
                                    <td>Notes</td>
                                    <td>{{$visit->notes}}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection