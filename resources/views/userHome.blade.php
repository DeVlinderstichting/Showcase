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
<style>
  .messages-list{
    max-height: 300px;
    margin-bottom: 10px;
    overflow-y:scroll;
    -webkit-overflow-scrolling: touch;
}
</style>

<div class="container mb-3">
    <h1 class="p-4">My Profile <a href="/settings" class="btn btn-outline-primary float-end">Settings</a></h1>
    
</div>


<div class="container mb-3">
    <h1 class="p-4">Statistics</h1>
    <div class="row">
        <div class="col-md-6 d-flex justify-content-center"><div class="p-4 border rounded w-75 my-4">{{$obsCount}} observations</div></div>
        <div class="col-md-6 d-flex justify-content-center"><div class="p-4 border rounded w-75 my-4">{{$spCount}} Species seen</div></div>
        <div class="col-md-6 d-flex justify-content-center"><div class="p-4 border rounded w-75 my-4">{{$spGroupCount}} Species groups seen</div></div>
        <div class="col-md-6 d-flex justify-content-center"><div class="p-4 border rounded w-75 my-4">{{$nrOfInsects}} Total insects seen</div></div>
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

<?php
    use Illuminate\Support\Str;
?>

<div class="container mb-3">
    <h1 class="p-4">Messages</h1>
    <div class="list-group messages-list">
        @foreach($userMessages as $um)
        <?php
            $truncCont = Str::limit($um->content, 100, ' (...)');
        ?>
  
            <a href="#" data_header="{{$um->header}}" data_at="{{$um->created_at}}" data_content="{{$um->content}}" onClick="showModal(this); event.preventDefault();" class="list-group-item list-group-item-action" aria-current="true">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{$um->header}}</h5>
                    <small>{{$um->created_at}}</small>
                </div>
                <p class="mb-1">{{$truncCont}}</p>
            </a>
        @endforeach
    </div>
</div>

<div class="container mb-3">
    <h1 class="p-4">Observations</h1>
    <div class="row">
        <div class="col-md-3 d-flex align-items-center justify-content-center">
            <a href="/visit" class="btn btn-outline-primary m-4">All Observations</a>
        </div>
        <div class="col-md-9">
            <?php // dd($allObservations[0]->getLocationsAsGeoJson()); ?>
            @include('layouts.map_show', ['countObjects'=>$allObservations, 'showSectionNrs' => 0])
        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="modalId" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="messageTitle">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="messageContent">
          ...
        </div>
        <span class="text-end text-small p-3" id="messageAt"></span>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<script>

    function showModal(elem) 
    {
        var myModal = new bootstrap.Modal(document.getElementById('modalId'), {
                keyboard: false
            })
        $('#messageTitle').html(elem.getAttribute('data_header'));
        $('#messageContent').html(elem.getAttribute('data_content'));
        $('#messageAt').html(elem.getAttribute('data_at'));
        myModal.show();

    }


    const labels = [
      'January',
      'February',
      'March',
      'April',
      'May',
      'June',
      'July',
      'August',
      'September',
      'October', 
      'November',
      'December'
    ];
    var thisYearAll = [0,0,0,0,0,0,0,0,0,0,0,0];
    var thisYearMine = [0,0,0,0,0,0,0,0,0,0,0,0];
    var lastYearAll = [0,0,0,0,0,0,0,0,0,0,0,0];
    var lastYearMine = [0,0,0,0,0,0,0,0,0,0,0,0];

    var countPerSpeciesAll = [];
    var countPerSpeciesMine = [];
    var speciesLabels = [];
    var colorScheme = [];

    @foreach($allSpMonthlyData as $asmd)
        @if($asmd->year == date("Y"))
            thisYearAll
        @else 
            lastYearAll
        @endif 
        [{{$asmd->month}}] = {{$asmd->count}};
    @endforeach
    @foreach($userSpMonthlyData as $usmd)
        @if($usmd->year == date("Y"))
            thisYearMine
        @else 
            lastYearMine
        @endif 
        [{{$usmd->month}}] = {{$usmd->count}};
    @endforeach

    function getRandomColor() 
    {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) 
        {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    @foreach($countPerSpeciesUser as $userSp)
        speciesLabels.push('{{\App\Models\Species::find($userSp->species_id)->getName($user)}}');
        countPerSpeciesMine.push({{$userSp->sum}});
        if (colorScheme.length == 0) { colorScheme.push('red'); }
        if (colorScheme.length == 1) { colorScheme.push('green'); }
        if (colorScheme.length == 2) { colorScheme.push('blue'); }
        if (colorScheme.length == 3) { colorScheme.push('yellow'); }
        if (colorScheme.length == 4) { colorScheme.push('orange'); }
        if (colorScheme.length == 5) { colorScheme.push('gray'); }
        if (colorScheme.length == 6) { colorScheme.push('purple'); }
        if (colorScheme.length > 6) { colorScheme.push(getRandomColor()); }
        var randomColor = Math.floor(Math.random()*16777215).toString(16);
        @foreach($countPerSpeciesAll as $allSp)
            @if ($allSp->species_id == $userSp->species_id)
                countPerSpeciesAll.push({{$allSp->sum}});
                @break;
            @endif
        @endforeach
    @endforeach


    const barData = {
      labels: labels,
      datasets: [{
        label: 'Species per month (all {{date("Y")}})',
        backgroundColor: 'rgb(180, 50, 70)',
        borderColor: 'rgb(180, 50, 70)',
        data: thisYearAll,
      },{
        label: 'Species per month (all {{date("Y",strtotime("-1 year"))}})',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: lastYearAll,
      },
      {
        label: 'Species per month (mine {{date("Y")}})',
        backgroundColor: 'rgb(70, 50, 180)',
        borderColor: 'rgb(70, 50, 180)',
        data: thisYearMine,
      },
      {
        label: 'Species per month (mine {{date("Y",strtotime("-1 year"))}})',
        backgroundColor: 'rgb(132, 99, 255)',
        borderColor: 'rgb(132, 99, 255)',
        data: lastYearMine,
      }]
    };

    const pie1Data = {
        labels: speciesLabels,
        datasets: [{
        label: 'Seen species (mine)',
        backgroundColor: colorScheme,
        borderColor: colorScheme,
        data: countPerSpeciesMine}]
    };
    const pie2Data = {
        labels: speciesLabels,
        datasets: [{
        label: 'Seen species (all)',
        backgroundColor : colorScheme,
        borderColor: colorScheme,
        data: countPerSpeciesAll}]
    };
  
    const config1 = {
      type: 'bar',
      data: barData,
      options: {}
    };
  
    const config2 = {
      type: 'pie',
      data: pie1Data,
      options: {}
    };
  
    const config3 = {
      type: 'pie',
      data: pie2Data,
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
