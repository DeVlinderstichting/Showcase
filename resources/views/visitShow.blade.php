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
                            @if (@isSingle)

                            @endif


                            <tr>
                                <td>{$so->startdate}</td>
                                <td>{$so->observations()->first()->id}
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mb-2">
            <h5 class="card-header">
                Transect
                <a class="btn btn-primary mr-3 ml-3 btn-sm float-right" role="button" href="#">Add new visit</a>
            </h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-hover vertical-align">
                        <thead>
                            <th><td>Date<td></th>
                            <th><td>Name</td></th>
                            <th><td></td></th>
                        </thead>
                        <tbody id="dataTable">
                            @foreach($transect as $tr)
                                <tr>
                                    <td>{$tr->startdate}</td>
                                    <td>{$tr->observations()->first()->id}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mb-2">
            <h5 class="card-header">
                Fit counts
                <a class="btn btn-primary mr-3 ml-3 btn-sm float-right" role="button" href="#">Add new fit count</a>
            </h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-hover vertical-align">
                        <thead>
                            <th><td>Flower<td></th>
                            <th><td>Number of Species</td></th>
                            <th><td></td></th>
                        </thead>
                        <tbody id="dataTable">
                            @foreach($fit as $f)
                                <tr>
                                    <td>{\App\Models\Species::find($f->flower_id)->first()->getName($user)}</td>
                                    <td>{$f->observations()->count()}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mb-2">
            <h5 class="card-header">
                Timed counts
                <a class="btn btn-primary mr-3 ml-3 btn-sm float-right" role="button" href="#">Add new timed count</a>
            </h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-hover vertical-align">
                        <thead>
                            <th><td>Startdate<td></th>
                            <th><td>Enddate</td></th>
                            <th><td>Number of observations</td></th>
                            <th><td>Location</td></th>
                            <th><td></td></th>
                        </thead>
                        <tbody id="dataTable">
                            @foreach($timed as $ti)
                                <tr>
                                    <td>{$ti->startdate}</td>
                                    <td>{$ti->observations()->first()->id}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection