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


    <div class="container mt-4">
        <div class="card mb-2">
            <h5 class="card-header">
                Visit
                <a class="btn btn-primary mr-3 ml-3 btn-sm float-right" role="button" href="#">Edit visit</a>
            </h5>
            <div class="card-body">
                <label for="date" class="col-md-3 col-form-label">Date</label>
                <div class="col-md-9">
                    <input type="date" class="form-control @if($errors->has('startdate')) is-invalid @endif" max={{$maxDate}} min={{$minDate}} id="startdate" name="startdate" value="{{old('startdate')}}"}}>
                    @if($errors->has('startdate')) 
                        <div class="invalid-feedback"> {{$errors->first('startdate')}} </div>
                    @endif
                </div>
                <div class="col-md-9">
                    <label for="starttime" class="col-md-3 col-form-label">
                    @if($isSingle)Time @else Starttime @endif</label>
                    <div class="col-md-9">
                        <input type="time" class="form-control @if($errors->has('starttime')) is-invalid @endif" id="starttime" name="starttime" value="{{old('starttime')}}">
                        @if($errors->has('starttime')) <div class="invalid-feedback"> {{$errors->first('starttime')}} </div>@endif
                    </div>
                </div>

                @if (!$isSingle)
                    <div class="col-md-9">
                        <label for="endtime" class="col-md-3 col-form-label">Endtime</label>
                        <div class="col-md-9">
                            <input type="time" class="form-control @if($errors->has('endtime')) is-invalid @endif" id="endtime" name="endtime" value="{{old('endtime')}}">
                            @if($errors->has('endtime')) <div class="invalid-feedback"> {{$errors->first('endtime')}} </div>@endif
                        </div>
                    </div>
                    
                    @if($isTransect)
                       
                    @endif
                    @if($isFit)
                        flowerid
                    @endif
                @endif
                <div class="col-md-9">
                    <label for="endtime" class="col-md-3 col-form-label">Notes</label>
                    <input type="text" class="form-control @if($errors->has('notes')) is-invalid @endif" id="notes" name="notes" value="{{old('notes')}}"}}>
                    @if($errors->has('notes')) 
                        <div class="invalid-feedback"> {{$errors->first('notes')}} </div>
                    @endif
                </div>
                    @if(($isTransect) || ($isTimed)
                        <label for="cloud" class="col-md-3 col-form-label">Cloud cover</label>
                        <div class="col-md-9">
                            <input type="time" class="form-control @if($errors->has('cloud')) is-invalid @endif" id="cloud" name="cloud" value="{{old('cloud')}}">
                            @if($errors->has('cloud')) <div class="invalid-feedback"> {{$errors->first('cloud')}} </div>@endif
                        </div>
                        <label for="wind" class="col-md-3 col-form-label">Wind speed</label>
                        <div class="col-md-9">
                            <input type="time" class="form-control @if($errors->has('wind')) is-invalid @endif" id="wind" name="wind" value="{{old('wind')}}">
                            @if($errors->has('wind')) <div class="invalid-feedback"> {{$errors->first('wind')}} </div>@endif
                        </div>
                        <label for="temp" class="col-md-3 col-form-label">Temperature</label>
                        <div class="col-md-9">
                            <input type="time" class="form-control @if($errors->has('temp')) is-invalid @endif" id="temp" name="temp" value="{{old('temp')}}">
                            @if($errors->has('temp')) <div class="invalid-feedback"> {{$errors->first('temp')}} </div>@endif
                        </div>
                    @endif
                    <div> Location </div>
                    <div>photo</div>
                </div>
            </div>
        </div>
    </div>
@endsection