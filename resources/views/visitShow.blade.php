@extends('layouts.app')

@section('title')
    {{\App\Models\Language::getItem('visitShowTitle')}}
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
        <h1 class="p-4">{{\App\Models\Language::getItem('visitShowHeader')}}<a class="btn btn-primary mr-3 ml-3 btn-sm float-end" role="button" href="/visit/{{ $visit->id }}/edit">{{\App\Models\Language::getItem('visitShowEditButton')}}</a></h1>
    </div>

    <div class="container mb-3">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <h2>{{\App\Models\Language::getItem('visitShowGeneralInfoHeader')}}</h2>
                    <table class="table table-sm table-borderless">
                        <tbody id="dataTable">
                            @if ($isSingle)
                                <tr>
                                    <td>{{\App\Models\Language::getItem('visitShowDate')}}</td>
                                    <td>{{$visit->startdate}}</td>
                                </tr>
                                <tr>
                                    <td>{{\App\Models\Language::getItem('visitShowNotes')}}</td>
                                    <td>{{$visit->notes}}</td>
                                </tr>
                            @endif
                            @if($isTimed)
                                <tr>
                                    <td>{{\App\Models\Language::getItem('visitShowStartdate')}}</td>
                                    <td>{{$visit->startdate}}</td>
                                </tr>
                                <tr>
                                    <td>{{\App\Models\Language::getItem('visitShowEnddate')}}</td>
                                    <td>{{$visit->enddate}}</td>
                                </tr>
                                <tr>
                                    <td>{{\App\Models\Language::getItem('visitShowObsNum')}}</td>
                                    <td>{{$visit->observations()->count()}}
                                </tr>
                                <tr>
                                    <td>{{\App\Models\Language::getItem('visitShowCloudCover')}}</td>
                                    <td>{{$visit->cloud}}</td>
                                </tr>
                                <tr>
                                    <td>{{\App\Models\Language::getItem('visitShowTemperature')}}</td>
                                    <td>{{$visit->temperature}}</td>
                                </tr>
                                <tr>
                                    <td>{{\App\Models\Language::getItem('visitShowWind')}}</td>
                                    <td>{{$visit->wind}}</td>
                                </tr>
                                <tr>
                                    <td>{{\App\Models\Language::getItem('visitShowNotes')}}</td>
                                    <td>{{$visit->notes}}</td>
                                </tr>
                            @endif
                            @if($isTransect)
                                <tr>
                                    <td>{{\App\Models\Language::getItem('visitShowStartdate')}}</td>
                                    <td>{{$visit->startdate}}</td>
                                </tr>
                                <tr>
                                    <td>{{\App\Models\Language::getItem('visitShowEnddate')}}</td>
                                    <td>{{$visit->enddate}}</td>
                                </tr>
                                <tr>
                                    <td>{{\App\Models\Language::getItem('visitShowDuration')}}</td>
                                    <td>{{$visit->getDuration()}}</td>
                                </tr>
                                <tr>
                                    <td>{{\App\Models\Language::getItem('visitShowCloudCover')}}</td>
                                    <td>{{$visit->cloud}}</td>
                                </tr>
                                <tr>
                                    <td>{{\App\Models\Language::getItem('visitShowTemperature')}}</td>
                                    <td>{{$visit->temperature}}</td>
                                </tr>
                                <tr>
                                    <td>{{\App\Models\Language::getItem('visitShowWind')}}</td>
                                    <td>{{$visit->wind}}</td>
                                </tr>
                                <tr>
                                    <td>{{\App\Models\Language::getItem('visitShowObsNum')}}</td>
                                    <td>{{$visit->observations()->count()}}
                                </tr>
                                <tr>
                                    <td>{{\App\Models\Language::getItem('visitShowNotes')}}</td>
                                    <td>{{$visit->notes}}</td>
                                </tr>
                            @endif
                            @if($isFit)
                                <tr>
                                    <td>{{\App\Models\Language::getItem('visitShowStartdate')}}</td>
                                    <td>{{$visit->startdate}}</td>
                                </tr>
                                <tr>
                                    <td>{{\App\Models\Language::getItem('visitShowEnddate')}}</td>
                                    <td>{{$visit->enddate}}</td>
                                </tr>
                                <tr>
                                    <td>{{\App\Models\Language::getItem('visitShowDuration')}}</td>
                                    <td>{{$visit->getDuration()}}</td>
                                </tr>
                                <tr>
                                    <td>{{\App\Models\Language::getItem('visitShowObsNum')}}</td>
                                    <td>{{$visit->observations()->count()}}
                                </tr>
                                <tr>
                                    <td>{{\App\Models\Language::getItem('visitShowObservedFlower')}}</td>
                                    <td>{{\App\Models\Species::find($visit->flower_id)->getName($user)}}
                                </tr>
                                <tr>
                                    <td>{{\App\Models\Language::getItem('visitShowNotes')}}</td>
                                    <td>{{$visit->notes}}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <h2>{{\App\Models\Language::getItem('visitShowObservationsHeader')}}</h2>

                <div class="table-responsive">
                    <table class="table table-sm table-striped table-hover vertical-align">
                        <thead>
                            <th>{{\App\Models\Language::getItem('visitShowTableHeaderSpecies')}}</th>
                            <th>{{\App\Models\Language::getItem('visitShowTableHeaderNumber')}}</th>
                            @if($isTransect)
                                <th>{{\App\Models\Language::getItem('visitShowTableHeaderSection')}}</th>
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
                                <tr><td colspan="100%">{{\App\Models\Language::getItem('visitShowTableContentNoObservations')}}</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection