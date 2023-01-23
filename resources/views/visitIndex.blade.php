@extends('layouts.app')

@section('title')
    {{\App\Models\Language::getItem('visitIndexTitle')}}
@endsection

@section('sidebar')

@endsection

@section('content')
    <div class="container mt-4">
        <div class="card mb-2 uservisitindex-card">
            <h5 class="card-header uservisitindex-card-header">
                {{\App\Models\Language::getItem('visitIndexSingleObsHeader')}}
                <a class="btn btn-primary mr-3 ml-3 btn-sm float-end uservisitindex-button" role="button" href="/visit/0/1/create">{{\App\Models\Language::getItem('visitIndexAddNewSingleObs')}}</a>
            </h5>
            <div class="card-body uservisitindex-card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-hover vertical-align uservisitindex-table">
                        <thead>
                            <th class="uservisitindex-header">{{\App\Models\Language::getItem('visitIndexTableHeaderDate')}}</th>
                            <th class="uservisitindex-header">{{\App\Models\Language::getItem('visitIndexTableHeaderSpecies')}}</th>
                            <th class="uservisitindex-header">{{\App\Models\Language::getItem('visitIndexTableHeaderNumber')}}</th>
                            <th class="uservisitindex-header"></th>
                        </thead>
                        <tbody id="dataTable">
                            @foreach ($singleObservations as $so)
                                <tr>
                                    <td class="uservisitindex-cell"><time>{{ $so->startdate }}</time></td>
                                    @if ($so->observations()->first() != null)
                                        <td class="uservisitindex-cell">{{ $so->observations->first()->species()->first()->getName($user) }}</td>
                                        <td class="uservisitindex-cell">{{ $so->observations->first()->number }}</td>
                                    @else
                                        <td class="uservisitindex-cell">-</td>
                                        <td class="uservisitindex-cell">-</td>
                                    @endif
                                    </td>
                                    <td class="uservisitindex-cell">
                                        <a class="uservisitindex-actionbutton" href='/visit/{{ $so->id }}'><i class='fa fa-search'
                                                style='font-size:24px;'></i></a>
                                        <a class="uservisitindex-actionbutton" href='/visit/{{ $so->id }}/edit'><i class='fa fa-pencil'
                                                style='font-size:24px;'></i></a>
                                        <a class="uservisitindex-actionbutton" href='#' delete_link='/visit/{{ $so->id }}/delete' onclick="showModal(this); event.preventDefault();"><i class='fa fa-trash'
                                                style='font-size:24px;'></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mb-2 uservisitindex-card">
            <h5 class="card-header uservisitindex-card-header">
                {{\App\Models\Language::getItem('visitIndexTransectHeader')}}
                <a class="btn btn-primary mr-3 ml-3 btn-sm float-end uservisitindex-button <?=count($user->transects()->get()) == 0 ? "disabled" : ""; ?>" role="button" href="/visit/0/3/create">{{\App\Models\Language::getItem('visitIndexAddNewTransect')}}</a>
            </h5>
            <div class="card-body uservisitindex-card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-hover vertical-align uservisitindex-table">
                        <thead>
                            <th class="uservisitindex-header">{{\App\Models\Language::getItem('visitIndexTableHeaderName')}}</th>
                            <th class="uservisitindex-header">{{\App\Models\Language::getItem('visitIndexTableHeaderDate')}}</th>
                            <th class="uservisitindex-header">{{\App\Models\Language::getItem('visitIndexTableHeaderDuration')}}</th>
                            <th class="uservisitindex-header"></th>
                        </thead>
                        <tbody id="dataTable">
                            @foreach ($transect as $tr)
                                <tr>
                                    <?php 
                                        $trObject = \App\Models\Transect::find($tr->transect_id);
                                    ?>
                                    <td class="uservisitindex-cell">{{ $trObject->name }}</td>
                                    <td class="uservisitindex-cell"><time>{{ $tr->startdate }}</time></td>
                                    <td class="uservisitindex-cell">{{ $tr->getDuration() }}</td>
                                    <td class="uservisitindex-cell">
                                        <a class="uservisitindex-actionbutton" href='/visit/{{ $tr->id }}'><i class='fa fa-search'
                                                style='font-size:24px;'></i></a>
                                        <a class="uservisitindex-actionbutton" href='/visit/{{ $tr->id }}/edit'><i class='fa fa-pencil'
                                                style='font-size:24px;'></i></a>
                                        <a class="uservisitindex-actionbutton" href='#' delete_link='/visit/{{ $tr->id }}/delete' onclick="showModal(this); event.preventDefault();"><i class='fa fa-trash'
                                                style='font-size:24px;'></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mb-2 uservisitindex-card">
            <h5 class="card-header uservisitindex-card-header">
                {{\App\Models\Language::getItem('visitIndexFitHeader')}}
                <a class="btn btn-primary mr-3 ml-3 btn-sm float-end uservisitindex-button " role="button" href="/visit/0/4/create">{{\App\Models\Language::getItem('visitIndexAddNewFit')}}</a>
            </h5>
            <div class="card-body uservisitindex-card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-hover vertical-align uservisitindex-table">
                        <thead>
                            <th class="uservisitindex-header">{{\App\Models\Language::getItem('visitIndexTableHeaderDate')}}</th>
                            <th class="uservisitindex-header">{{\App\Models\Language::getItem('visitIndexTableHeaderFlower')}}</th>
                            <th class="uservisitindex-header">{{\App\Models\Language::getItem('visitIndexTableHeaderSpNum')}}</th>
                            <th class="uservisitindex-header"></th>
                        </thead>
                        <tbody id="dataTable">
                            @foreach ($fit as $f)
                                <tr>
                                    <td class="uservisitindex-cell"><time>{{ $f->startdate }}</time></td>
                                    <td class="uservisitindex-cell">{{ \App\Models\Species::where('id', $f->flower_id)->first()->getName($user) }}</td>
                                    <td class="uservisitindex-cell">{{ $f->observations()->count() }}</td>
                                    <td class="uservisitindex-cell">
                                        <a class="uservisitindex-actionbutton" href='/visit/{{ $f->id }}'><i class='fa fa-search'
                                                style='font-size:24px;'></i></a>
                                        <a class="uservisitindex-actionbutton" href='/visit/{{ $f->id }}/edit'><i class='fa fa-pencil'
                                                style='font-size:24px;'></i></a>
                                        <a class="uservisitindex-actionbutton" href='#' delete_link='/visit/{{ $f->id }}/delete' onclick="showModal(this); event.preventDefault();"><i class='fa fa-trash'
                                                style='font-size:24px;'></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mb-2 uservisitindex-card">
            <h5 class="card-header uservisitindex-card-header">
                {{\App\Models\Language::getItem('visitIndexTimedCountsHeader')}}
                <a class="btn btn-primary mr-3 ml-3 btn-sm float-end uservisitindex-button " role="button" href="/visit/0/2/create">{{\App\Models\Language::getItem('visitIndexAddNewTimedCount')}}</a>
            </h5>
            <div class="card-body uservisitindex-card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-hover vertical-align uservisitindex-table">
                        <thead>
                            <th class="uservisitindex-header">{{\App\Models\Language::getItem('visitIndexTableHeaderStartDate')}}</th>
                            <th class="uservisitindex-header">{{\App\Models\Language::getItem('visitIndexTableHeaderEndDate')}}</th>
                            <th class="uservisitindex-header">{{\App\Models\Language::getItem('visitIndexTableHeaderObsNum')}}</th>
                            <th class="uservisitindex-header"></th>
                        </thead>
                        <tbody id="dataTable">
                            @foreach ($timed as $ti)
                                <tr>
                                    <td class="uservisitindex-cell"><time>{{ $ti->startdate }}</time></td>
                                    <td class="uservisitindex-cell"><time>{{ $ti->enddate }}</time></td>
                                    <td class="uservisitindex-cell">{{ $ti->observations()->count() }}</td>
                                    <td class="uservisitindex-cell"></td>
                                    <td class="uservisitindex-cell">
                                        <a class="uservisitindex-actionbutton" href='/visit/{{ $ti->id }}'><i class='fa fa-search'
                                                style='font-size:24px;'></i></a>
                                        <a class="uservisitindex-actionbutton" href='/visit/{{ $ti->id }}/edit'><i class='fa fa-pencil'
                                                style='font-size:24px;'></i></a>
                                        <a class="uservisitindex-actionbutton" href='#' delete_link='/visit/{{ $ti->id }}/delete' onclick="showModal(this); event.preventDefault();"><i class='fa fa-trash'
                                                style='font-size:24px;'></i></a>
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
                {{\App\Models\Language::getItem('visitIndexDataDownloadHeader')}}
            </h5>
            <div class="card-body">
                <a class="btn btn-primary mr-3 ml-3 btn-sm" role="button" href="/user/dataDownload">{{\App\Models\Language::getItem('visitIndexDataDownloadButton')}}</a>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalId" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageTitle">{{\App\Models\Language::getItem('visitIndexDeleteVisit')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="messageContent">
                    {{\App\Models\Language::getItem('visitIndexDeleteVisitConfirmMessage')}}
                </div>
                <div class="modal-footer">
                    <button type="button" id="deleteLink" class="btn btn-danger" onclick="deleteVisit(this);">{{\App\Models\Language::getItem('visitIndexDelete')}}</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{\App\Models\Language::getItem('visitIndexClose')}}</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showModal(elem) 
        {
            var myModal = new bootstrap.Modal(document.getElementById('modalId'), {
                    keyboard: false
                });
            $('#deleteLink').attr('data_link', elem.getAttribute('delete_link'));
            myModal.show();
    
        }

        function deleteVisit(elem)
        {
            var deleteLink = elem.getAttribute('data_link');
            $.ajax( deleteLink, {
                type : 'DELETE',
                async: false,
            });
            location.reload(); 
        }

        timesToLocal();      
    </script>

    @endsection
