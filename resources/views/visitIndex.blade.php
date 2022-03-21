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
                            <th>Date</th>
                            <th>Species</th>
                            <th>Number</th>
                            <th></th>
                        </thead>
                        <tbody id="dataTable">
                            @foreach($singleObservations as $so)
                                <tr>
                                    <td>{{$so->startdate}}</td>
                                    @if($so->observations()->first() != null) 
                                        <td>{{$so->observations->first()->species()->first()->getName($user)}}</td>
                                        <td>{{$so->observations->first()->count()}}</td>
                                        @else
                                            <td>-</td><td>-</td>
                                        @endif
                                    </td>
                                    <td>
                                        <a href='/visit/{{$so->id}}'><i class='fa fa-search' style='font-size:24px;'></i></a>
                                        <a href='/visit/{{$so->id}}/edit'><i class='fa fa-pencil' style='font-size:24px;'></i></a>
                                        <a href='/visit/{{$so->id}}'><i class='fa fa-trash' style='font-size:24px;'></i></a>
                                    </td>
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
                            <th>Name</th>
                            <th>Date</th>
                            <th>Duration</th>
                            <th></th>
                        </thead>
                        <tbody id="dataTable">
                            @foreach($transect as $tr)
                                <tr>
                                    <td>{{$tr->transect()->first()->name}}</td>
                                    <td>{{$tr->startdate}}</td>
                                    <td>{{$tr->getDuration()}}</td>
                                    <td>
                                        <a href='/visit/{{$so->id}}'><i class='fa fa-search' style='font-size:24px;'></i></a>
                                        <a href='/visit/{{$so->id}}/edit'><i class='fa fa-pencil' style='font-size:24px;'></i></a>
                                        <a href='/visit/{{$so->id}}'><i class='fa fa-trash' style='font-size:24px;'></i></a>
                                    </td>
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
                            <th>Date</th>
                            <th>Flower</th>
                            <th>Number of Species</th>
                            <th></th>
                        </thead>
                        <tbody id="dataTable">
                            @foreach($fit as $f)
                                <tr>
                                    <td>{{$f->startdate}}</td>
                                    <td>{{\App\Models\Species::find($f->flower_id)->first()->getName($user)}}</td>
                                    <td>{{$f->observations()->count()}}</td>
                                    <td>
                                        <a href='/visit/{{$so->id}}'><i class='fa fa-search' style='font-size:24px;'></i></a>
                                        <a href='/visit/{{$so->id}}/edit'><i class='fa fa-pencil' style='font-size:24px;'></i></a>
                                        <a href='/visit/{{$so->id}}'><i class='fa fa-trash' style='font-size:24px;'></i></a>
                                    </td>
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
                            <th>Startdate</th>
                            <th>Enddate</th>
                            <th>Number of observations</th>
                            <th></th>
                        </thead>
                        <tbody id="dataTable">
                            @foreach($timed as $ti)
                                <tr>
                                    <td>{{$ti->startdate}}</td>
                                    <td>{{$ti->enddate}}</td>
                                    <td>{{$f->observations()->count()}}</td>
                                    <td></td>
                                    <td>
                                        <a href='/visit/{{$so->id}}'><i class='fa fa-search' style='font-size:24px;'></i></a>
                                        <a href='/visit/{{$so->id}}/edit'><i class='fa fa-pencil' style='font-size:24px;'></i></a>
                                        <a href='/visit/{{$so->id}}'><i class='fa fa-trash' style='font-size:24px;'></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection