@extends('layouts.app')

@section('title')
Admin home
@endsection

@section('sidebar')
    @include('layouts.navbar',['menuActive'=>'adminhome'])
@endsection

@section('extraNavItems')
@endsection

@section('content')

 <?php $region = new \App\Models\Region(); ?>

    <div class="container mt-4">
        <div class="card mb-2">
            <h5 class="card-header">
                Create/edit region
            </h5>
            <div class="card-body">
                <form action="/regionCreate/{{$region->id}}" method="post">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control @if($errors->has('name')) is-invalid @endif" id="name" name="name" value="{{old('name')}}">
                    @if($errors->has('name')) <div class="invalid-feedback"> {{$errors->first('name')}} </div>@endif</div>
                    <br><br>
                    <label for="description" class="col-sm-2 col-form-label">description</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control @if($errors->has('description')) is-invalid @endif" id="description" name="description" value="{{old('description')}}">
                    @if($errors->has('description')) <div class="invalid-feedback"> {{$errors->first('description')}} </div>@endif</div>
                    <br><br>
                    <a class="btn btn-primary btn-sm" role="button" href="/user/create">Store</a>
                </form>
            </div>
        </div>
    </div>
@endsection
