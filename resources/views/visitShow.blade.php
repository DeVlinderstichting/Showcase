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
    <div class="container mb-3">
        <h1 class="p-4">Visit details <a class="btn btn-primary mr-3 ml-3 btn-sm float-end" role="button" href="/visit/{{ $visit->id }}/edit">Edit visit</a></h1>
    </div>

    <div class="container mb-3">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <h2>General information</h2>
                    <table class="table table-sm table-borderless">
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
                <h2>Observations</h2>

                <div class="table-responsive">
                    <table class="table table-sm table-striped table-hover vertical-align">
                        <thead>
                            <th>Species</th>
                            <th>Number</th>
                            @if($isTransect)
                                <th>Section</th>
                            @endif
                        </thead>
                        <tbody id="dataTable">
                            @forelse($visit->observations()->get() as $obs)
                                <tr>
                                    <td>{{$obs->species()->first()->getName($user)}}</td>
                                    <td>{{$obs->number}}</td>
                                    @if($isTransect)
                                        <td>{{$obs->transectSection()->first()->name}}</td>
                                    @endif
                                </tr>
                            @empty
                                <tr><td colspan="100%">No observations</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection