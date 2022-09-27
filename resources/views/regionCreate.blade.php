@extends('layouts.app')

@section('meta')
    @include('layouts.forceReload',[])
@endsection

@section('title')
Admin home
@endsection

@section('sidebar')
    @include('layouts.navbar',['menuActive'=>'adminhome'])
@endsection

@section('extraNavItems')
@endsection

@section('content')
    <?php //$region = new \App\Models\Region();// $region->id = -1; ?>
    <form action="/regionCreate/{{$region->id}}" method="post" id="editRegionForm" >

        @csrf
        <div class="container mt-4">
            <div class="card mb-2">
                <h5 class="card-header">
                    Create/edit region
                </h5>
                <div class="card-body">
                    @csrf
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control @if($errors->has('name')) is-invalid @endif" id="name" name="name" value="{{old('name', $region->name)}}">
                    @if($errors->has('name')) <div class="invalid-feedback"> {{$errors->first('name')}} </div>@endif</div>
                    <br><br>
                    <label for="description" class="col-sm-2 col-form-label">description</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control @if($errors->has('description')) is-invalid @endif" id="description" name="description" value="{{old('description', $region->description)}}">
                    @if($errors->has('description')) <div class="invalid-feedback"> {{$errors->first('description')}} </div>@endif</div>
                    <br><br>                    
                </div>
            </div>
            <div class="card mb-2">
                <h5 class="card-header">
                    Edit region location
                </h5>
                <div class="card-body">
                    <div class="card mb-3">
                        <div class="card-body">
                            <input type="hidden" id='regionData' name="regionData" value=""/>
                            @include('layouts.map_create', ['showLine'=>false, 'showPoints'=>false, 'showPolygon'=>true, 'finishDrawFunction' => 'handleFinishDraw', 'finishModifyFunction' => 'handleFinishModify', 'initMapFunction' => 'initMap', 'locDat' => $region->getLocationsAsGeoJson()])
                            <script type="text/javascript">
                              //  var secDat = [];
                                var vecDat = [];
                            </script>
                            <script>
                                function redrawMap()
                                {
                                    clearMap();
                                    var notActiveStyle = new ol.style.Style(
                                    {
                                        image: new ol.style.Circle(
                                        {
                                            radius: 5,
                                            fill: new ol.style.Fill({color: 'black'})
                                        }),
                                        stroke: new ol.style.Stroke(
                                        {
                                          color: 'black',
                                          width: 5
                                        })
                                    });

                                    var format = new ol.format.WKT();
                                    for (var i = 0; i < vecDat.length; i++)
                                    {
                                        if (vecDat[i] != "")
                                        {
                                            var strLine = format.writeGeometry(vecDat[i]);
                                            addItemToMap(vecDat[i], notActiveStyle);
                                        }
                                    }
                                }

                                function handleFinishDraw(e)
                                {   
                                    var currentFeature = e.feature;
                                    vecDat[0] = currentFeature.getGeometry();
                                    redrawMap();
                                }
                                function handleFinishModify(e)
                                {
                                }
                                
                                function initMap()
                                {
                                    var map = $('#map').data('map');
                                    var vector = $('#map').data('vector');
                                    var vectorSource = vector.getSource();
                                    @if ($region->getLocationsAsGeoJson() != '')
                                        var feats = new ol.format.GeoJSON().readFeatures( <?php print_r($region->getLocationsAsGeoJson()); ?> , {
                                            dataProjection: 'EPSG:4326',
                                            featureProjection: map.getView().getProjection()
                                        });
                                        var doZoom = true;
                                    @else 
                                        var feats=[];
                                        var doZoom = false;
                                    @endif

                                    if (feats.length == 0)
                                    {
                                    }
                                    else 
                                    {
                                        for (var i = 0 ; i < feats.length; i++)
                                        {
                                            var theGeom = feats[i].getGeometry();
                                            vecDat[0]= theGeom;
                                        }
                                    }
                                    redrawMap();
                                    if (doZoom)
                                    {
                                        map.getView().fit(vectorSource.getExtent());
                                        map.getView().setZoom(map.getView().getZoom()-0.25);
                                    }
                                    //addFeatureToVectorSource(feat);
                                }
                              //  initMap();
                            </script>
                        </div>
                    </div>
                              
                    <script>
                        $("#editRegionForm").submit(function(e) 
                        {
                            e.preventDefault();
                            var res = "";
                            var format = new ol.format.WKT();
                            if ((vecDat.length > 0) &&(vecDat[0] != ""))
                            {
                                var tr = vecDat[0].transform('EPSG:3857', 'EPSG:4326');
                                var strLine = format.writeGeometry(tr);
                                res = strLine;
                                var elem = document.getElementById('regionData');
                                elem.value = JSON.stringify(res);
                                this.submit();
                            }
                            else 
                            {
                                alert("unable to create location (did you enter a valid geometry?)");
                            }
                            
                            // return false; //I put it here as a fallback
                        });
                    </script>
                </div>

                <div class="modal fade" id="manuallyEnterSectionModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Edit section</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="modalManualEditSectionBody">
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" onclick="storeManualEdit()" class="btn btn-primary" data-dismiss="modal">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-2">
                <h5 class="card-header">
                    Select region-species
                </h5>
                <div class="card-body">
                    <table class="table table-sm table-striped table-hover vertical-align">
                        <thead>
                            <th>Species</th>
                            <th>Can be recorded</th>
                        </thead>
                        <tbody>
                            <?php 
                                $allSpIds = $region->species()->pluck('species.id')->toArray();
                                $selectedSpeciesGroupIds = $region->species()->get()->pluck('speciesgroup_id')->unique()->toArray();
                            ?>
                            @foreach(\App\Models\Speciesgroup::all() as $spGroup)
                                <tr>
                                    <th> <a id="id_{{$spGroup->id}}" class="btn btn-primary btn-sm" onclick="show_{{$spGroup->id}}();" role="button">+</a> {{$spGroup->name}}:
                                    </th>
                                    <td>
                                        <input @if(in_array($spGroup->id, $selectedSpeciesGroupIds))checked @endif type="checkbox" onclick="changeAll_{{$spGroup->id}}()" id="spgroup_{{$spGroup->id}}" name="spgroup_{{$spGroup->id}}" value="{{old('spgroup_' . $spGroup->id, '1')}}"/> (all)
                                    </td>
                                </tr>
                                @foreach($spGroup->species()->where('taxrank', 'species')->get() as $sp)
                                    <tr class="spGroupRow{{$spGroup->id}}" >
                                        <td>&emsp;&emsp;{{ucwords($sp->genus)}} {{$sp->taxon}}</td>
                                        <td><input class='check_{{$spGroup->id}}'
                                            @if (in_array($sp->id, $allSpIds))checked @endif type="checkbox"  id="spCanCount_{{$sp->id}}" name="spCanCount_{{$sp->id}}" value="{{old('sp_' . $sp->id, '1')}}"/></td>
                                    </tr>
                                @endforeach
                            
                                <script>
                                    var showing{{$spGroup->id}} = 1;
                                    function show_{{$spGroup->id}}()
                                    {
                                        showing{{$spGroup->id}} = (showing{{$spGroup->id}} * -1) + 1;
                                        if (showing{{$spGroup->id}})
                                        {
                                            $('.spGroupRow{{$spGroup->id}}').show();
                                            $('#id_{{$spGroup->id}}').text('-');
                                        }
                                        else 
                                        {
                                            $('.spGroupRow{{$spGroup->id}}').hide();
                                            $('#id_{{$spGroup->id}}').text($('#id_{{$spGroup->id}}').text().replace("-", "+"));
                                        }                        
                                    }
                                    function changeAll_{{$spGroup->id}}()
                                    {
                                        var elem = document.getElementById('spgroup_{{$spGroup->id}}');

                                        if (elem.checked)
                                        {
                                            $('.check_{{$spGroup->id}}').prop('checked', true);
                                        }
                                        else 
                                        {
                                            $('.check_{{$spGroup->id}}').prop('checked', false);
                                        }
                                    }
                                    show_{{$spGroup->id}}();
                                </script>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card mb-2">
                <h5 class="card-header">
                    Select management options
                </h5>
                <div class="card-body">
                    <table class="table table-sm table-striped table-hover vertical-align">
                        <thead>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Enabled</th>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\ManagementType::all() as $mt)
                                <?php 
                                    $isChecked = "";
                                    if ($region->managementtypes()->where('managementtype_id', $mt->id)->first() != null)
                                    {
                                        $isChecked = "checked";
                                    }
                                ?>
                                <tr><td>{{$mt->name}}</td><td>{{$mt->description}}</td><td><input type="checkbox" {{$isChecked}} name="mt_{{$mt->id}}" id="mt_{{$mt->id}}"></td></tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card mb-2">
                <h5 class="card-header">
                    Select landscape options
                </h5>
                <div class="card-body">
                    <table class="table table-sm table-striped table-hover vertical-align">
                        <thead>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Enabled</th>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\LanduseType::all() as $lt)
                                <?php 
                                    $isChecked = "";
                                    if ($region->landusetypes()->where('landusetype_id', $lt->id)->first() != null)
                                    {
                                        $isChecked = "checked";
                                    }
                                ?>
                                <tr><td>{{$lt->name}}</td><td>{{$lt->description}}</td><td><input type="checkbox" {{$isChecked}} name="lt_{{$lt->id}}" id="lt_{{$lt->id}}"></td></tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card mb-2">
                <h5 class="card-header">
                    Save edits
                </h5>
            <div class="card-body">
                <button type="submit" class="btn btn-primary m-1">Store</button>
                <a href="/adminHome" class="btn btn-secondary m-1">Back</a>
            </div>
        </div> 
    </form>
@endsection
