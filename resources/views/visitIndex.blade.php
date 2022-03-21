@extends('layouts.app')

@section('title')
    Visits
@endsection

@section('sidebar')

@endsection

@section('content')
    <div class="container mt-4">
        <div class="card mb-2">
            <h5 class="card-header">
                Single observation
                <a class="btn btn-primary mr-3 ml-3 btn-sm float-right" role="button" href="#">Add new single observation</a>
            </h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-hover vertical-align">
                        <thead>
                            <th><td>Date<td></th>
                            <th><td>Species</td></th>
                        </thead>
                        <tbody id="dataTable">
                            @foreach($singleObservations as $so)
                                <tr>
                                    <td>{$so->startdate}</td>
                                    <td>{$so->observations()->first()->id}
                                </tr>
                            @endforeach
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
                            <th><td>Date<td></th>
                            <th><td>Species</td></th>
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