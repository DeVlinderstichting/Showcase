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
        <h1 class="p-4">{{ $title }}</h1>
    </div>

    <div class="container mt-4">
        <div class="card mb-2">
            <div class="card-body">
                <form method="post">
                    <label for="date" class="col-md-3 col-form-label">Date</label>
                    <div class="col">
                        @if($visit)
                            <input type="date" class="form-control @if($errors->has('startdate')) is-invalid @endif" max={{$maxDate}} min={{$minDate}} id="startdate" name="startdate" value="{{old('startdate', explode(' ', $visit->startdate)[0])}}"}}>
                        @else
                            <input type="date" class="form-control @if($errors->has('startdate')) is-invalid @endif" max={{$maxDate}} min={{$minDate}} id="startdate" name="startdate" value="{{old('startdate')}}"}}>
                        @endif
                            @if($errors->has('startdate')) 
                            <div class="invalid-feedback"> {{$errors->first('startdate')}} </div>
                        @endif
                    </div>
                    <label for="starttime" class="col-md-3 col-form-label">
                    @if($isSingle)Time @else Starttime @endif</label>
                    <div class="col">
                        @if($visit)
                            <input type="time" class="form-control @if($errors->has('starttime')) is-invalid @endif" id="starttime" name="starttime" value="{{old('starttime', explode(' ', $visit->startdate)[1])}}">
                        @else
                            <input type="time" class="form-control @if($errors->has('starttime')) is-invalid @endif" id="starttime" name="starttime" value="{{old('starttime')}}">
                        @endif
                        @if($errors->has('starttime')) <div class="invalid-feedback"> {{$errors->first('starttime')}} </div>@endif
                    </div>

                    @if (!$isSingle)
                        <label for="endtime" class="col-md-3 col-form-label">Endtime</label>
                        <div class="col">
                        @if($visit)
                            <input type="time" class="form-control @if($errors->has('endtime')) is-invalid @endif" id="endtime" name="endtime" value="{{old('endtime', explode(' ', $visit->enddate)[1])}}">
                        @else
                            <input type="time" class="form-control @if($errors->has('endtime')) is-invalid @endif" id="endtime" name="endtime" value="{{old('endtime')}}">
                        @endif
                            @if($errors->has('endtime')) <div class="invalid-feedback"> {{$errors->first('endtime')}} </div>@endif
                        </div>
                        
                        @if($isTransect)
                        
                        @endif
                        @if($isFit)
                            flowerid
                        @endif
                    @endif
                    <div class="col">
                        <label for="endtime" class="col-md-3 col-form-label">Notes</label>
                        @if($visit)
                            <input type="text" class="form-control @if($errors->has('notes')) is-invalid @endif" id="notes" name="notes" value="{{old('notes', $visit->notes)}}"}}>
                        @else
                            <input type="text" class="form-control @if($errors->has('notes')) is-invalid @endif" id="notes" name="notes" value="{{old('notes')}}"}}>
                        @endif
                        @if($errors->has('notes')) 
                            <div class="invalid-feedback"> {{$errors->first('notes')}} </div>
                        @endif
                    </div>
                        @if(($isTransect) || ($isTimed))
                            <label for="cloud" class="col-md-3 col-form-label">Cloud cover</label>
                            <div class="col">
                                @if($visit)
                                    <input type="number" class="form-control @if($errors->has('cloud')) is-invalid @endif" id="cloud" name="cloud" value="{{old('cloud', $visit->cloud)}}">
                                @else
                                    <input type="number" class="form-control @if($errors->has('cloud')) is-invalid @endif" id="cloud" name="cloud" value="{{old('cloud')}}">
                                @endif
                                @if($errors->has('cloud')) <div class="invalid-feedback"> {{$errors->first('cloud')}} </div>@endif
                            </div>
                            <label for="wind" class="col-md-3 col-form-label">Wind speed</label>
                            <div class="col">
                                @if($visit)
                                    <input type="number" class="form-control @if($errors->has('wind')) is-invalid @endif" id="wind" name="wind" value="{{old('wind', $visit->wind)}}">
                                @else
                                    <input type="number" class="form-control @if($errors->has('wind')) is-invalid @endif" id="wind" name="wind" value="{{old('wind')}}">
                                @endif
                                @if($errors->has('wind')) <div class="invalid-feedback"> {{$errors->first('wind')}} </div>@endif
                            </div>
                            <label for="temp" class="col-md-3 col-form-label">Temperature</label>
                            <div class="col">
                                @if($visit)
                                    <input type="number" class="form-control @if($errors->has('temp')) is-invalid @endif" id="temp" name="temp" value="{{old('temp', $visit->temp)}}">
                                @else
                                    <input type="number" class="form-control @if($errors->has('temp')) is-invalid @endif" id="temp" name="temp" value="{{old('temp')}}">
                                @endif
                                @if($errors->has('temp')) <div class="invalid-feedback"> {{$errors->first('temp')}} </div>@endif
                            </div>
                        @endif
                        <h2 class="mt-3">Observations</h2>

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
                                @if($visit)
                                    @forelse($visit->observations()->get() as $obs)
                                        <tr>
                                            <td>{{$obs->species()->first()->getName($user)}}</td>
                                            <td><input type="number" value="{{$obs->number}}" name="amount_{{$obs->species()->first()->id}}" id="amount_{{$obs->species()->first()->id}}"></td>
                                            @if($isTransect)
                                                <td>{{$obs->transectSection()->get()->name}}</td>
                                            @endif
                                        </tr>
                                    @empty
                                        <tr><td colspan="100%">No observations</td></tr>
                                    @endforelse
                                @else
                                    <tr><td colspan="100%">No observations</td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <b>Add species</b>
                    <div class="col mb-3">
                        <select class="add-species-select w-100"></select>
                    </div>

                    <div>Location </div>
                    <div>photo</div>
                    <div class="row justify-content-center mt-3">
                        <b>Check the speciesgroups that you counted:</b>
                        @foreach(\App\Models\Speciesgroup::where('visibible_for_users', true)->get() as $sg)
                            <div class="col-md-4">
                                <img src="/{{$sg->imageLocation}}" alt="" class="img-count-settings">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                    Observed
                                    </label>
                                </div> 
                            </div>
                        @endforeach
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                </div>
            </div>
        </div>
    </div>

<script>
<?php
    if ($visit != null)
    {
        $speciesIdsUsed = $visit->observations()->pluck('species_id')->unique()->toArray();
    }
    else 
    {
        $speciesIdsUsed = [];
    }
?>
@if($user->sci_names)
    specArray = [
        @foreach ($species as $spec)
            @if(!in_array($spec->id, $speciesIdsUsed))
                {id: {{$spec->id}}, text: "{{$spec->Genus}} {{$spec->Taxon}}"},
            @endif
        @endforeach
    ];
@else
    <?php
    $prop = $user->prefered_language.'name';
    ?>
    specArray = [
            @foreach ($species as $spec)
                @if(!in_array($spec->id, $speciesIdsUsed))
                    {id: {{$spec->id}}, text: "{{$spec->$prop}}"},
                @endif
            @endforeach
        ];
@endif

$(".add-species-select").select2({
  data: specArray
})

$(".add-species-select").on("select2:select", function (evt) {
    var element = evt.params.data.element;
    var $element = $(element);
    $element.detach();
    var specId = element.value;
    var specName = element.innerHTML;
    $("tr td:contains('No observations')").parent().remove()

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
    newCell.appendChild(input);
});

</script>
@endsection