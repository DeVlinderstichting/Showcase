@extends('layouts.app')

@section('title')
My Profile
@endsection

@section('sidebar')
    @include('layouts.navbar',['menuActive'=>'adminhome'])
@endsection

@section('extraNavItems')
@endsection

@section('content')
<div class="container mb-3">
    <h1 class="p-4">My Profile <a href="/settings" class="btn btn-outline-primary float-end">Settings</a></h1>
    
</div>


<div class="container mb-3">
    <h1 class="p-4">Statistics</h1>
    <div class="row">
        <div class="col-md-6 d-flex justify-content-center"><div class="p-4 border rounded w-75 my-4">100 Observations</div></div>
        <div class="col-md-6 d-flex justify-content-center"><div class="p-4 border rounded w-75 my-4">100 Species seen</div></div>
        <div class="col-md-6 d-flex justify-content-center"><div class="p-4 border rounded w-75 my-4">100 Species groups seen</div></div>
        <div class="col-md-6 d-flex justify-content-center"><div class="p-4 border rounded w-75 my-4">100 Total insects seen</div></div>
    </div>
    <div class="row my-4">
        <div class="col-lg-6">
                <canvas id="chartBar"></canvas>
                <br><br>
        </div>
        <div class="col-lg-6">
            <div class="d-flex justify-content-center">
                <div>
                    <canvas id="chartPie1"></canvas>
                </div>
                <div>
                    <canvas id="chartPie2"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mb-3">
    <h1 class="p-4">Messages</h1>
    <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action" aria-current="true">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">List group item heading</h5>
            <small>3 days ago</small>
          </div>
          <p class="mb-1">Some placeholder content in a paragraph.</p>
          <small>And some small print.</small>
        </a>
        <a href="#" class="list-group-item list-group-item-action">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">List group item heading</h5>
            <small class="text-muted">3 days ago</small>
          </div>
          <p class="mb-1">Some placeholder content in a paragraph.</p>
          <small class="text-muted">And some muted small print.</small>
        </a>
        <a href="#" class="list-group-item list-group-item-action">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">List group item heading</h5>
            <small class="text-muted">3 days ago</small>
          </div>
          <p class="mb-1">Some placeholder content in a paragraph.</p>
          <small class="text-muted">And some muted small print.</small>
        </a>
      </div>
</div>

<div class="container mb-3">
    <h1 class="p-4">Observations</h1>
    <div class="row">
        <div class="col-md-3 d-flex align-items-center justify-content-center">
            <a href="/observations" class="btn btn-outline-primary m-4">All Observations</a>
        </div>
        <div class="col-md-9">
            <div class="map border rounded ratio ratio-4x3 bg-secondary align-middle text-center">
                <div>A MAP HERE</div>
            </div>
        </div>
    </div>

</div>

<script>
    const labels = [
      'January',
      'February',
      'March',
      'April',
      'May',
      'June',
    ];
  
    const data = {
      labels: labels,
      datasets: [{
        label: 'Species per month',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: [0, 10, 5, 2, 20, 30, 45],
      }]
    };
  
    const config1 = {
      type: 'bar',
      data: data,
      options: {}
    };
  
    const config2 = {
      type: 'pie',
      data: data,
      options: {}
    };
  
    const config3 = {
      type: 'pie',
      data: data,
      options: {}
    };
  </script>
  
  <script>
    const chartBar = new Chart(
      document.getElementById('chartBar'),
      config1
    );
    const chartPie1 = new Chart(
      document.getElementById('chartPie1'),
      config2
    );
    const chartPie2 = new Chart(
      document.getElementById('chartPie2'),
      config3
    );
  </script>
  
   
  
   

@endsection
