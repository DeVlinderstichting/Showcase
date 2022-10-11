@extends('layouts.app')

@section('title')
    {{\App\Models\Language::getItem('visitCreateTitle')}} 
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
            if ($visitType == $cm->id)
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
        <h1 class="p-4 uservisitcreate-title-header">@if ($title == 'create') {{\App\Models\Language::getItem('visitCreateHeader')}} @else {{\App\Models\Language::getItem('visitEditHeader')}} @endif</h1>
    </div>

    @if($isTransect)
        <?php 
            $transects = $user->transects()->get(); 
            if (count($transects) == 0) 
            { 
                $val = \App\Models\Language::getItem('visitCreateNoTransectsFound');
                die ($val);
            } 
        ?>
        <script>
            var currentTransectId = {{ $transects->first()->id }};

            function getTransectSections(transectId)
            {
                @foreach($transects as $tr)
                    if (transectId == {{$tr->id}})
                    {
                        var res = [];
                        @foreach($tr->transectSections()->get() as $trSec)
                            var item = [{{$trSec->id}},"{{$trSec->name}}"];
                            res.push(item);
                        @endforeach
                        return res;
                    }
                @endforeach
            }
        </script>
    @endif

    <div class="modal" id="changeTransectModal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title uservisitcreate-section-title">{{\App\Models\Language::getItem('visitCreateChangeTransect')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>{{\App\Models\Language::getItem('visitCreateChangeTransectWarning')}}</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary uservisitcreate-button" onclick="dismissTransectChange();">{{\App\Models\Language::getItem('visitCreateCancel')}}</button>
              <button type="button" class="btn btn-danger uservisitcreate-button" onclick="acceptTransectChange();">{{\App\Models\Language::getItem('visitCreateProceed')}}</button>
            </div>
          </div>
        </div>
      </div>

      
    <div class="container mt-4">
        <div class="card mb-2 uservisitcreate-card">
            <div class="card-body uservisitcreate-card-body">
                @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                        @foreach ($errors->all() as $error)
                            @if(str_contains($error, 'startdate'))
                                <li>{{ \App\Models\Language::getItem('visitCreateInvalidStartdate') }}</li>
                            @elseif(str_contains($error, 'enddate'))
                                @if (!$isSingle)
                                    <li>{{ \App\Models\Language::getItem('visitCreateInvalidEnddate') }}</li>
                            @endif
                            @else
                                <li>{{ $error }}</li>
                            @endif
                        @endforeach
                    </div>
                @endif

                <form method="post" id="visitcreateform" action="/visit/store/@if($visit != null){{$visit->id}}"@else-1" @endif>
                    @csrf
                    <input type='hidden' id="counttype" name="counttype" value="{{$visitType}}">
                    @if(!$isTransect)
                        <input type='hidden' id="geometry" name="geometry" value="">
                    @endif
                    @if($isTransect)
                        <label for="transect_id" class="col-md-3 col-form-label uservisitcreate-form-label">{{\App\Models\Language::getItem('visitCreateSelectTransect')}}</label>
                        <div class="col">
                            <select id="transect_id" name="transect_id" class="form-select uservisitcreate-form-input" onChange="updateTransectSectionList()">
                                @foreach($transects as $transect)
                                    <option value="{{$transect->id}}">{{$transect->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <script>
                            var transectModal = new bootstrap.Modal('#changeTransectModal', {});

                            function updateTransectSectionList()
                            {
                                transectModal.show();
                            }

                            function dismissTransectChange()
                            {
                                document.getElementById("transect_id").value = currentTransectId;
                                transectModal.hide();
                            }

                            function acceptTransectChange()
                            {
                                $('*[id*=section_]').each(function()
                                    {
                                        $(this).empty();
                                        //Create and append the options
                                        var sectionArray = getTransectSections(document.getElementById("transect_id").value);
                                        for (var i = 0; i < sectionArray.length; i++) {
                                            
                                            var option = new Option(sectionArray[i][1], sectionArray[i][0]);
                                            $(this).append(option);
                                        }

                                    });
                                currentTransectId = document.getElementById("transect_id").value;
                                transectModal.hide();
                            }
                        </script>

                    @endif
                    <label for="date" class="col-md-3 col-form-label uservisitcreate-form-label">{{\App\Models\Language::getItem('visitCreateDate')}}</label>
                    <div class="col">
                        @if($visit)
                            <input type="date" class="form-control uservisitcreate-form-input @if($errors->has('startdate')) is-invalid @endif" max={{$maxDate}} min={{$minDate}} id="startdatedummy" name="startdatedummy" value="{{old('startdatedummy', explode(' ', $visit->startdate)[0])}}"}}>
                        @else
                            <input type="date" class="form-control uservisitcreate-form-input @if($errors->has('startdate')) is-invalid @endif" max={{$maxDate}} min={{$minDate}} id="startdatedummy" name="startdatedummy" value="{{old('startdatedummy')}}"}}>
                        @endif
<!--                         @if($errors->has('startdate')) 
                            <div class="invalid-feedback"> {{$errors->first('startdate')}} </div>
                        @endif -->
                    </div>
                    <label for="starttime" class="col-md-3 col-form-label uservisitcreate-form-label">
                    @if($isSingle){{\App\Models\Language::getItem('visitCreateTime')}} @else {{\App\Models\Language::getItem('visitCreateStarttime')}} @endif</label>
                    <div class="col">
                        @if($visit)
                            <input type="time" class="form-control uservisitcreate-form-input @if($errors->has('startdate')) is-invalid @endif" id="starttime" name="starttime" value="{{old('starttime', explode(' ', $visit->startdate)[1])}}">
                        @else
                            <input type="time" class="form-control uservisitcreate-form-input @if($errors->has('startdate')) is-invalid @endif" id="starttime" name="starttime" value="{{old('starttime')}}">
                        @endif
<!--                         @if($errors->has('starttime')) <div class="invalid-feedback"> {{$errors->first('starttime')}} </div>@endif
 -->                    </div>

                    @if (!$isSingle)
                        <label for="endtime" class="col-md-3 col-form-label uservisitcreate-form-label">{{\App\Models\Language::getItem('visitCreateEndtime')}}</label>
                        <div class="col">
                        @if($visit)
                            <input type="time" class="form-control uservisitcreate-form-input @if($errors->has('enddate')) is-invalid @endif" id="endtime" name="endtime" value="{{old('endtime', explode(' ', $visit->enddate)[1])}}">
                        @else
                            <input type="time" class="form-control uservisitcreate-form-input @if($errors->has('enddate')) is-invalid @endif" id="endtime" name="endtime" value="{{old('endtime')}}">
                        @endif
<!--                             @if($errors->has('endtime')) <div class="invalid-feedback"> {{$errors->first('endtime')}} </div>@endif
 -->                        </div>
                        
                        @if($isTransect)
                        
                        @endif
                        @if($isFit)
                            <label for="flower_id" class="col-md-3 col-form-label uservisitcreate-form-label">{{\App\Models\Language::getItem('visitCreateChooseFlower')}}</label>
                            <div class="col">
                                <select id="flower_id" name="flower_id" class="form-select uservisitcreate-form-input @if($errors->has('flower_id')) is-invalid @endif">
                                    @foreach($plantSp as $plant)
                                        @if($plant->taxon)
                                            <?php 
                                                $selected = ""; 
                                                if ($visit)
                                                {
                                                    if($visit->flower_id == $plant->id)
                                                    {
                                                        $selected = "selected";
                                                    }
                                                }
                                            ?>
                                            <option value="{{$plant->id}}" {{$selected}} >{{$plant->getName($user)}}</option>
                                        @endif
                                    @endforeach
                                </select> 
                            </div>

                            <label for="flowercount" class="col-md-3 col-form-label uservisitcreate-form-label">{{\App\Models\Language::getItem('visitCreateNumFlowerheads')}}</label>
                            <div class="col">
                                @if($visit)
                                    <input type="number" class="form-control uservisitcreate-form-input @if($errors->has('flowercount')) is-invalid @endif" id="flowercount" name="flowercount" value="{{old('flowercount', $visit->flowercount)}}">
                                @else
                                    <input type="number" class="form-control uservisitcreate-form-input @if($errors->has('flowercount')) is-invalid @endif" id="flowercount" name="flowercount" value="{{old('flowercount')}}">
                                @endif
                            </div>
                        @endif
                    @endif
                    <div class="col">
                        <label for="endtime" class="col-md-3 col-form-label uservisitcreate-form-label">{{\App\Models\Language::getItem('visitCreateNotes')}}</label>
                        @if($visit)
                            <input type="text" class="form-control uservisitcreate-form-input @if($errors->has('notes')) is-invalid @endif" id="notes" name="notes" value="{{old('notes', $visit->notes)}}"}}>
                        @else
                            <input type="text" class="form-control uservisitcreate-form-input @if($errors->has('notes')) is-invalid @endif" id="notes" name="notes" value="{{old('notes')}}"}}>
                        @endif
                        @if($errors->has('notes')) 
                            <div class="invalid-feedback"> {{$errors->first('notes')}} </div>
                        @endif
                    </div>
                    @if(($isTransect) || ($isTimed))
                        <label for="cloud" class="col-md-3 col-form-label uservisitcreate-form-label">{{\App\Models\Language::getItem('visitCreateCloudCover')}}</label>
                        <div class="col">
                            @if($visit)
                                <input type="number" min = 0, max = 8 class="form-control uservisitcreate-form-input @if($errors->has('cloud')) is-invalid @endif" id="cloud" name="cloud" value="{{old('cloud', $visit->cloud)}}">
                            @else
                                <input type="number" min = 0, max = 8  class="form-control uservisitcreate-form-input @if($errors->has('cloud')) is-invalid @endif" id="cloud" name="cloud" value="{{old('cloud')}}">
                            @endif
                            <!-- @if($errors->has('cloud')) <div class="invalid-feedback"> {{$errors->first('cloud')}} </div>@endif -->
                        </div>
                        <label for="wind" class="col-md-3 col-form-label uservisitcreate-form-label">{{\App\Models\Language::getItem('visitCreateWindSpeed')}}</label>
                        <div class="col">
                            @if($visit)
                                <input type="number" min = 0, max = 7 class="form-control uservisitcreate-form-input @if($errors->has('wind')) is-invalid @endif" id="wind" name="wind" value="{{old('wind', $visit->wind)}}">
                            @else
                                <input type="number" min = 0, max = 7 class="form-control uservisitcreate-form-input @if($errors->has('wind')) is-invalid @endif" id="wind" name="wind" value="{{old('wind')}}">
                            @endif
                            <!-- @if($errors->has('wind')) <div class="invalid-feedback"> {{$errors->first('wind')}} </div>@endif -->
                        </div>
                        <label for="temperature" class="col-md-3 col-form-label uservisitcreate-form-label">{{\App\Models\Language::getItem('visitCreateTemp')}}</label>
                        <div class="col">
                            @if($visit)
                                <input type="number" min = -20, max = 55 class="form-control uservisitcreate-form-input @if($errors->has('temperature')) is-invalid @endif" id="temperature" name="temperature" value="{{old('temperature', $visit->temperature)}}">
                            @else
                                <input type="number" min = -20, max = 55 class="form-control uservisitcreate-form-input @if($errors->has('temperature')) is-invalid @endif" id="temperature" name="temperature" value="{{old('temperature')}}">
                            @endif
                            <!-- @if($errors->has('temperature')) <div class="invalid-feedback"> {{$errors->first('temperature')}} </div>@endif -->
                        </div>
                    @endif
                    @if(!$isSingle)
                        <label for="landusetype_id" class="col-md-3 col-form-label uservisitcreate-form-label">{{\App\Models\Language::getItem('visitCreateLanduseType')}}</label>
                        <div class="col">
                            <select id="landusetype_id" name="landusetype_id" class="form-select uservisitcreate-form-input @if($errors->has('landusetype_id')) is-invalid @endif" onChange="updateTransectSectionList()">
                                <option value=-1>{{\App\Models\Language::getItem('visitCreateLanduseTypeNotSelected')}}</option>
                                @foreach($landuseTypes as $landtype)
                                    <?php 
                                        $selected = ""; 
                                        if ($visit)
                                        {
                                            if($visit->landusetype_id == $landtype->id)
                                            {
                                                $selected = "selected";
                                            }
                                        }
                                    ?>
                                    <option value="{{$landtype->id}}" {{$selected}}>{{$landtype->description}}</option>
                                @endforeach
                            </select>
                        </div>
                        <label for="managementtype_id" class="col-md-3 col-form-label uservisitcreate-form-label">{{\App\Models\Language::getItem('visitCreateManagement')}}</label>
                        <div class="col">
                            <select id="managementtype_id" name="managementtype_id" class="form-select uservisitcreate-form-input @if($errors->has('managementtype_id')) is-invalid @endif" onChange="updateTransectSectionList()">
                                <option value=-1>{{\App\Models\Language::getItem('visitCreateManagementNotSelected')}}</option>
                                @foreach($managementTypes as $landmanagement)
                                    <?php 
                                        $selected = ""; 
                                        if ($visit)
                                        {
                                            if($visit->managementtype_id == $landmanagement->id)
                                            {
                                                $selected = "selected";
                                            }
                                        }
                                    ?>
                                    <option value="{{$landmanagement->id}}" {{$selected}}>
                                        {{\App\Models\Language::getItem($landmanagement->name)}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif


                    <h2 class="mt-3">{{\App\Models\Language::getItem('visitCreateObservations')}}</h2>

                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-hover vertical-align uservisitcreate-table">
                            <thead>
                                <th class="uservisitcreate-header">{{\App\Models\Language::getItem('visitCreateTableHeaderSpecies')}}</th>
                                <th class="uservisitcreate-header">{{\App\Models\Language::getItem('visitCreateTableHeaderNumber')}}</th>
                                <th class="uservisitcreate-header">{{\App\Models\Language::getItem('visitCreateTableHeaderTime')}}</th>
                                @if($isTransect)
                                    <th class="uservisitcreate-header">{{\App\Models\Language::getItem('visitCreateTableHeaderSection')}}</th>
                                @endif
                            </thead>
                            <tbody id="dataTable">
                                @if($visit && old('observations') == [])
                                    @forelse($visit->observations()->get() as $obs)
                                        <tr>
                                            <td class="uservisitcreate-cell">{{$obs->species()->first()->getName($user)}}</td>
                                            <td class="uservisitcreate-cell"><input type="number" value="{{$obs->number}}" name="amount_{{$obs->species()->first()->id}}" id="amount_{{$obs->species()->first()->id}}"></td>
                                            <td class="uservisitcreate-cell"><input type="datetime-local" value="{{$obs->observationtime}}" name="time_{{$obs->species()->first()->id}}" id="time_{{$obs->species()->first()->id}}"></td>
                                            @if($isTransect)
                                                <td class="uservisitcreate-cell" data-sectionname="{{$obs->transectSection()->first()->name}}">
                                                    <select id="section_{{$obs->species()->first()->id}}" name="section_{{$obs->species()->first()->id}}">
                                                        @foreach(\App\Models\Transect::find($visit->transect_id)->transectSections()->get() as $tr)
                                                            <option value="{{$tr->id}}"
                                                                @if ($obs->transectSection()->first()->id == $tr->id)
                                                                    selected
                                                                @endif
                                                                >{{$tr->name}}</option>
                                                        @endforeach

                                                    </select>
                                                </td>
                                            @endif
                                        </tr>
                                    @empty
                                        <tr><td class="uservisitcreate-cell" colspan="100%">{{\App\Models\Language::getItem('visitCreateNoObservations')}}</td></tr>
                                    @endforelse
                                @else
                                    <tr><td class="uservisitcreate-cell" colspan="100%">{{\App\Models\Language::getItem('visitCreateNoObservations')}}</td></tr>
                                @endif


                            </tbody>
                        </table>
                    </div>
                    <b>{{\App\Models\Language::getItem('visitCreateAddSpecies')}}</b>
                    <div class="col mb-3">
                        <select class="add-species-select w-100 uservisitcreate-speciesselect2 @if($errors->has('observations') && $isSingle) is-invalid @endif"></select>
                    </div>

                    <script>
                        var currentGeom = "";
                    </script>
                        
                    <?php 
                        $showPoint = true;
                        $showLine = false;
                        if ($isTimed)
                        {
                            $showPoint = false;
                            $showLine = true;
                        }
                    ?>

                    @if (!$isTransect)
                        <div>Location 
                            @include('layouts.map_create', ['showLine'=>$showLine, 'showPoints'=>$showPoint, 'showPolygon'=>false, 'finishDrawFunction' => 'handleFinishDraw', 'finishModifyFunction' => 'handleFinishModify', 'initMapFunction' => 'initMap'])
                        </div>
                    @endif

                    <script>
                        function initMap(e)
                        {
                            var map = $('#map').data('map');
                            var vector = $('#map').data('vector');
                            var vectorSource = vector.getSource();
                            @if ($visit != null)
                                @if ($visit->getLocationsAsGeoJson() != '')
                                    var feats = new ol.format.GeoJSON().readFeatures( <?php print_r($visit->getLocationsAsGeoJson()); ?> , {
                                        dataProjection: 'EPSG:4326',
                                        featureProjection: map.getView().getProjection()
                                    });
                                    for (var i = 0 ; i < feats.length; i++)
                                    {
                                        vectorSource.addFeature(feats[i]);
                                        var theGeom = feats[i].getGeometry();
                                    }
                                @endif
                            @endif
                        }
                    </script>

                    <script>
                        function handleFinishDraw(e)
                        {
                            drawMap(false);
                        }

                        function handleFinishModify(e)
                        {
                            drawMap(true);
                        }

                        function drawMap(restoreLast) //I have no idea why this works... 
                        {
                            var features = vector.getSource().getFeatures();
                            var lastFeature = "";
                            features.forEach((feature) => 
                            {
                                lastFeature = feature;
                                vector.getSource().removeFeature(feature);
                            });
                            vector.getSource().clear();
                            if (restoreLast && lastFeature != "")
                            {
                                vector.getSource().addFeature(lastFeature); //remove everything but the last, to ensure there is only ever one feature
                            }
                        }
                    </script>

                    @if (!$isSingle)
                        <div class="row justify-content-center mt-3">
                            <b>{{\App\Models\Language::getItem('visitCreateCheckSpGroups')}}:</b>
                            <?php $recordingLevelNone = \App\Models\RecordingLevel::where('name', 'none')->first(); ?>
                            @foreach(\App\Models\Speciesgroup::where('visibible_for_users', true)->get() as $sg)
                                <div class="col-md-4">
                                    <img src="/{{$sg->imageLocation}}" alt="" class="img-count-settings">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                        <?php 
                                            if ($visit != null)
                                            {   
                                                $rl = $visit->method()->first()->getSpeciesGroupRecordingLevel($sg->id); 
                                                if ($rl != null)
                                                {
                                                    if ($rl->recordinglevel_id != $recordingLevelNone->id)
                                                    {
                                                        echo(' checked ');
                                                    }
                                                }
                                            }
                                        ?>
                                        value="{{$sg->id}}" id="speciesgrouprecordinglevel" name="speciesgrouprecordinglevel[]">
                                        <label class="form-check-label" for="speciesgrouprecordinglevel">
                                        {{$sg->name}}
                                        </label>
                                    </div> 
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <br>
                    <button type="submit" class="btn btn-primary">{{\App\Models\Language::getItem('visitCreateSave')}}</button>
                </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    <?php
        $speciesIdsUsed = [];
        if (old('observations')) 
        {
            $i = 0;
            foreach (old('observations') as $obs)
            {
                $speciesIdsUsed[$i] = $obs['species_id'];
                $i++;
            }
        }
        elseif ($visit != null)
        {
            $speciesIdsUsed = $visit->observations()->pluck('species_id')->unique()->toArray();
        }
    ?>
    @if($user->sci_names)
        specArray = [
            @foreach ($species as $spec)
                @if(!in_array($spec->id, $speciesIdsUsed) || $isTransect)
                    {id: {{$spec->id}}, text: "{{$spec->genus}} {{$spec->taxon}}"},
                @endif
            @endforeach
        ];
    @else
        <?php
        $prop = $user->prefered_language.'name'; 
        ?>
        specArray = [
                @foreach ($species as $spec)
                    @if(!in_array($spec->id, $speciesIdsUsed) || $isTransect)
                        {id: {{$spec->id}}, text: "{{$spec->$prop}}"},
                    @endif
                @endforeach
            ];
    @endif

    @if (old('observations') != [])
        @foreach (old('observations') as $obs)
            <?php
            $id = $obs['species_id'];
            $speciesname = \App\Models\Species::find($obs['species_id'])->getName($user);
            $count = $obs['number'];
            $time = $obs['observationtime'];
            ?>
            addObservationRow({{ $id }}, '{{ $speciesname }}', {{ $count }}, '{{ $time }}');
        @endforeach
    @endif

    $(".add-species-select").select2({
      data: specArray
    });

    $(".add-species-select").prepend('<option selected class="placeholdered" value="">{!! \App\Models\Language::getItem('SelectSpeciesPlaceholder') !!}</option>');

    $(".add-species-select").on("select2:select", function (evt) {
        var element = evt.params.data.element;

        @if(!$isTransect)
            var $element = $(element);
            $element.detach();
        @endif
        $(".add-species-select").val('').trigger('change')
        var specId = element.value;
        var specName = element.innerHTML;

        addObservationRow(specId, specName)
    });

    function addObservationRow(specId, specName, count=1, time=0) {
        $("tr td:contains('{!! \App\Models\Language::getItem('visitCreateNoObservations') !!}')").parent().remove()

        var contTable = document.getElementById('dataTable');
        var newRow = contTable.insertRow();
        var newCell = newRow.insertCell();
        var newText = document.createTextNode(specName);
        newCell.appendChild(newText);
        var newCell = newRow.insertCell();
        var input = document.createElement("input");
        input.type = 'number';
        input.id = `amount_${specId}`;
        input.name = `amount_${specId}`;
        input.min = 0;
        input.max = 1000;
        input.value = count;
        newCell.appendChild(input);

        const now = new Date();
        now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
        var newCell = newRow.insertCell();
        var input = document.createElement("input");
        input.type = 'datetime-local';
        input.id = `time_${specId}`;
        input.name = `time_${specId}`;
        input.min = 0;
        input.max = 1000;
        if (time == 0) {
            input.value = now.toISOString().slice(0, -8);    
        } else {
            input.value = time;
        }
        
        newCell.appendChild(input);

        @if($isTransect)
            //Create and append select list
            var newCell = newRow.insertCell();
            var selectList = document.createElement("select");
            selectList.id = `section_${specId}`;
            newCell.appendChild(selectList);

            //Create and append the options
            var sectionArray = getTransectSections(document.getElementById("transect_id").value);
            for (var i = 0; i < sectionArray.length; i++) {
                var option = document.createElement("option");
                option.value = sectionArray[i][0];
                option.text = sectionArray[i][1];
                selectList.appendChild(option);
            }
        @endif
    }

    function toISOLocal(d) {
        var z  = n =>  ('0' + n).slice(-2);
        var zz = n => ('00' + n).slice(-3);
        var off = d.getTimezoneOffset();
        var sign = off > 0? '-' : '+';
        off = Math.abs(off);

        return d.getFullYear() + '-'
                + z(d.getMonth()+1) + '-' +
                z(d.getDate()) + ' ' +
                z(d.getHours()) + ':'  + 
                z(d.getMinutes());
        }


    $("#visitcreateform").on("submit", function (e) 
    {
        // e.preventDefault();//stop submit event
        var form = $(this);//this form
        var results = [];
        var count = 0;

        var startDate = $('#startdatedummy').val();
        var startTime = $('#starttime').val();
        var datetime = document.createElement('input');
        datetime.type = 'hidden';
        datetime.name = 'startdate';
        datetime.value = toISOLocal(new Date(startDate + ' ' + startTime));
        form[0].appendChild(datetime);

        var enddatetime = document.createElement('input');
        enddatetime.type = 'hidden';
        enddatetime.name = 'enddate';
        @if(!$isSingle)
            var endTime = $('#endtime').val();
            enddatetime.value = toISOLocal(new Date(startDate + ' ' + endTime));
            form[0].appendChild(enddatetime);
        @else
            var newDateObj = new Date(startDate + ' ' + startTime);
            var newEndDateObj = new Date(newDateObj.getTime() + 1*60000) ;
            enddatetime.value = toISOLocal(newEndDateObj)
            form[0].appendChild(enddatetime);
        @endif
    

        @if($isTransect)
            var species = Array.from(document.querySelectorAll("[name^=amount_]")).map(x => x.name);
            var sections = Array.from(document.querySelectorAll("[id^=section_]")).map(x => x.value);
            var combined = [];
            for(var i=0; i < species.length; i++){
                combined.push([species[i], sections[i]]);
            };
            let setComb  = new Set(combined.map(JSON.stringify)); 
            if(!(combined.length === setComb.size))
            {
                alert('{!! \App\Models\Language::getItem('visitCreateSectionSameSpecies') !!}');
                return false;
            }
        @endif

        $('*[id*=amount_]').each(function()
        {
            var input1 = document.createElement('input');
            input1.type = 'hidden';
            input1.name = `observations[${count}][species_id]`;
            input1.value = this.id.split('_')[1];
            form[0].appendChild(input1);

            var input2 = document.createElement('input');
            input2.type = 'hidden';
            input2.name = `observations[${count}][number]`;
            input2.value = this.value;
            form[0].appendChild(input2);

            var input3 = document.createElement('input');
            input3.type = 'hidden';
            input3.name = `observations[${count}][observationtime]`;
            input3.value =  $(this).parent().parent().find('*[id*=time_]').val();
            form[0].appendChild(input3);

            @if($isTransect)
                var input3 = document.createElement('input');
                input3.type = 'hidden';
                input3.name = `observations[${count}][section]`;
                input3.value =  $(this).parent().parent().find('*[id*=section_]').val();
                form[0].appendChild(input3);
            @endif

            count++;
        });

        if (count == 0)
        {
            var emptyArr = [];
            var input3 = document.createElement('input');
            input3.type = 'hidden';
            input3.name = 'observationsss';
            input3.value = emptyArr;
            form[0].appendChild(input3);
            console.log("item added");           
        }

        var format = new ol.format.WKT();
        var geomElem = document.getElementById('geometry');
        var features = vector.getSource().getFeatures();
        var feat = "";
        if (features.length > 0)
        {
            feat = features[0];
            var transformedFeat = feat.getGeometry().transform('EPSG:3857', 'EPSG:4326');
            var strLine = format.writeGeometry(transformedFeat);

    /*        var feature = features[0];
var transformed = ol.proj.transform(features[0], 'EPSG:3857', 'EPSG:4326');
         //   var tr = vecDat[i].transform('EPSG:3857', 'EPSG:4326');
        var strLine = format.writeGeometry(transformed);

        */


            geomElem.value = strLine;


                                

       //     feat = features[0];
        //    feat = feat.transform('EPSG:3857', 'EPSG:4326');
          //  geomElem.value = feat.getGeometry();
        }

       // var tr = feat.transform('EPSG:3857', 'EPSG:4326');
      //  var strLine = format.writeGeometry(tr);
       // console.log(strLine);
       // geomElem.value = JSON.stringify(feat.getGeometry());

        // form.submit();//submit form
        // return false;
       return true;
    });

        

    </script>
@endsection