@extends('layouts.app')

@section('title')
    {{\App\Models\Language::getItem('userHomeTitle')}}
@endsection

@section('sidebar')
    @include('layouts.navbar',['menuActive'=>'adminhome'])
@endsection

@section('extraNavItems')
@endsection

@section('content')
    <style>
        .messages-list {
            max-height: 300px;
            margin-bottom: 10px;
            overflow-y: scroll;
            -webkit-overflow-scrolling: touch;
        }
    </style>


<div class="container mb-3">
    <h2 class="p-4 userhome-section-title">{{\App\Models\Language::getItem('userHomeStatistics')}}</h2>
    <div class="row">
        <div class="col-md-4">
            <table>
                <tr><td>{{ $obsCount }}</td><td> {{\App\Models\Language::getItem('userHomeObsNum')}}&nbsp;&nbsp;&nbsp;</td>   
                <td>{{ $spCount }}</td><td> {{\App\Models\Language::getItem('userHomeSpNum')}}&nbsp;&nbsp;&nbsp;</td></tr>
                <tr><td><{{ $spGroupCount }} </td><td> {{\App\Models\Language::getItem('userHomeSpGroupNum')}}&nbsp;&nbsp;&nbsp;</td>
                <td>{{ $nrOfInsects }} </td><td> {{\App\Models\Language::getItem('userHomeInsectsNum')}}&nbsp;&nbsp;&nbsp;</td></tr>
            </table>
        </div>
    </div>

        

        




        <div class="row my-4">
            <div class="col-lg-6 userhome-section-graph">
                <canvas id="chartBar"></canvas>
                <br><br>
            </div>
            <div class="col-lg-6">
                <div class="d-flex justify-content-center">
                    <div class="userhome-section-graph">
                        <canvas id="chartPie1"></canvas>
                    </div>
                    <div class="userhome-section-graph">
                        <canvas id="chartPie2"></canvas>
                    </div>
                </div>
            </div>
        </div>

        

    <h2 class="p-4 userhome-title-header">{{\App\Models\Language::getItem('userHomeEbaStatsHeader')}}</h2> 
    <div class="row">
        <div class="col-md-4">
            <label for="customGraphXAxis">{{\App\Models\Language::getItem('userStatsValueOfXAxis')}}</label>
            <select name="customGraphXAxis" id="customGraphXAxis" onchange="updateGraph()">
                <option value="landscape">{{\App\Models\Language::getItem('userStatsSelectLandscape')}}</option>
                <option value="management">{{\App\Models\Language::getItem('userStatsSelectManagement')}}</option>
                <option value="contribution">{{\App\Models\Language::getItem('userStatsSelectContribution')}}</option>
            </select> <br><div id="chartXAxisSelectionExplanation"></div><br>
            <label for="customGraphYAxis">{{\App\Models\Language::getItem('userStatsValueOfYAxis')}}</label>
            <select name="customGraphYAxis" id="customGraphYAxis" onchange="updateGraph()">
                <option value="spcount_normalizedbyvisit">{{\App\Models\Language::getItem('userStatsNumSpNorm')}}</option>
                <option value="indivcount_normalizedbyvisit">{{\App\Models\Language::getItem('userStatsNumIndivNorm')}}</option>
                <option value="spcount_raw">{{\App\Models\Language::getItem('userStatsNumSp')}}</option>
                <option value="indivcount_raw">{{\App\Models\Language::getItem('userStatsNumIndiv')}}</option>
                <option value="visitcount">{{\App\Models\Language::getItem('userStatsNumVisit')}}</option>
            </select> <br>
            <div id="chartYAxisSelectionExplanation"></div>
            <canvas id="chartCustom"></canvas>


        <script>
            var currentGraph;
            function updateGraph()
            {
                var xAxis = document.getElementById('customGraphXAxis').value;
                var yAxis = document.getElementById('customGraphYAxis').value;

                var visitCount = {{$ebaVisitCount}}
 

                if (currentGraph != null)
                {
                    currentGraph.destroy();
                }






                $.ajax({
                    type:'GET',
                    url: '/user/stats/{{$user->id}}/ajaxGraphData',
                    data: 
                    {
                        "xAxis": xAxis, 
                        "yAxis": yAxis
                    },
                    success:function(data) 
                    {

                        var graphCanvas = document.getElementById('chartCustom');
                        var customLabels = [];
                        var customData = [];
                        var contributionData = [];

                        for (var i = 0; i < data.length; i++)
                        {
                            if (xAxis != "contribution")
                            {
                                customLabels.push(data[i][0]);
                                customData.push(data[i][1]);
                            }
                            else 
                            {
                                customLabels.push("Contribution");
                                customData.push(data[i][0]);
                                contributionData.push(data[i][1]);
                            }
                        }

                        if (xAxis != "contribution")
                        {
                            var customGraphData = {
                                labels: customLabels,
                                datasets: [
                                {
                                    label: '{{\App\Models\Language::getItem('userStatsEba')}}',
                                    data: customData,
                                    backgroundColor: "#8AC1B4",
                                }]
                            };
                        }
                        else
                        {
                            var customGraphData = {
                                labels: customLabels,
                                datasets: [
                                {
                                    label: '{{\App\Models\Language::getItem('userStatsEba')}}',
                                    data: customData,
                                    backgroundColor: "#8AC1B4",
                                }, 
                                {
                                    label: '{{\App\Models\Language::getItem('userStatsMine')}}',
                                    data: contributionData,
                                    backgroundColor: "#505099",
                                }]
                            };
                        }

                        var xAxisText = "";
                        var yAxisText = "";
                        var headerText = "";

                        var xAxisExplanation = "";
                        var yAxisExplanation = "";

                        if (xAxis == "contribution") 
                        {   
                            headerText = "{{\App\Models\Language::getItem('userStatsCustomChartHeaderContribution')}}";
                            xAxisExplanation = "{{\App\Models\Language::getItem('userStatsCustomChartXAxisExplanationContribution')}}";
                        }
                        if (xAxis == "landscape") 
                        {
                            headerText = "{{\App\Models\Language::getItem('userStatsCustomChartHeaderLanduse')}}";
                            xAxisExplanation = "{{\App\Models\Language::getItem('userStatsCustomChartXAxisExplanationLanduse')}}";
                        }
                        if (xAxis == "management") 
                        {
                            headerText = "{{\App\Models\Language::getItem('userStatsCustomChartHeaderManagement')}}";
                            xAxisExplanation = "{{\App\Models\Language::getItem('userStatsCustomChartXAxisExplanationManagement')}}";
                        }

                        if (yAxis == "spcount_normalizedbyvisit") 
                        {
                            yAxisText = "{{\App\Models\Language::getItem('userStatsCustomChartYAxisSpCountNormalizedByVisit')}}";
                            yAxisExplanation = "{{\App\Models\Language::getItem('userStatsCustomChartYAxisExplanationSpCountNorm')}}";
                        }
                        if (yAxis == "indivcount_normalizedbyvisit") 
                        {
                            yAxisText = "{{\App\Models\Language::getItem('userStatsCustomChartYAxisIndivCountNormalizedByVisit')}}";
                            yAxisExplanation = "{{\App\Models\Language::getItem('userStatsCustomChartYAxisExplanationIndivCountNorm')}}";
                        }
                        if (yAxis == "spcount_raw") 
                        {
                            yAxisText = "{{\App\Models\Language::getItem('userStatsCustomChartYAxisSpCount')}}";
                            yAxisExplanation = "{{\App\Models\Language::getItem('userStatsCustomChartYAxisExplanationSpCountRaw')}}";
                        }
                        if (yAxis == "indivcount_raw") 
                        {
                            yAxisText = "{{\App\Models\Language::getItem('userStatsCustomChartYAxisIndivCount')}}";
                            yAxisExplanation = "{{\App\Models\Language::getItem('userStatsCustomChartYAxisExplanationIndivCountRaw')}}";
                        }
                        if (yAxis == "visitcount") 
                        {
                            yAxisText = "{{\App\Models\Language::getItem('userStatsCustomChartYAxisVisitCount')}}";
                            yAxisExplanation = "{{\App\Models\Language::getItem('userStatsCustomChartYAxisExplanationVisitCount')}}";
                        }

                        var explanationElemX = document.getElementById('chartXAxisSelectionExplanation');
                        explanationElemX.innerHTML = xAxisExplanation;
                        var explanationElemY = document.getElementById('chartYAxisSelectionExplanation');
                        explanationElemY.innerHTML = yAxisExplanation;


                        var customGraphConfig = {
                        type: 'bar',
                        data: customGraphData,
                            options: {
                                plugins: {
                                    title: {
                                        display: true,
                                        text: headerText
                                    },
                                },
                                responsive: true,
                                scales: {
                                    x: {
                                        stacked: false,
                                    },
                                    y: {
                                        stacked: false,
                                        title: {
                                            display: true,
                                            text: yAxisText
                                        }
                                    }
                                }
                            }
                        };
                        var customGraph = new Chart(graphCanvas,customGraphConfig);
                        currentGraph = customGraph;
                    }
                });
            }
            updateGraph();
        </script>    

<?php /* 
            
            @include('components.graphhorizontalbar', 
            [
                'itemLabel' => \App\Models\Language::getItem('userHomeSpCountHorizontalGraphItemLabel'),
                'itemTitle' => \App\Models\Language::getItem('userHomeSpCountHorizontalGraphItemTitle'),
                'myLabel' => \App\Models\Language::getItem('userHomeSpCountHorizontalGraphItemMyLabel'),
                'ebaLabel' => \App\Models\Language::getItem('userHomeSpCountHorizontalGraphItemEbaLabel'),
                'uniqueId' => 'ghb1',
                'myValue' => $obsCount,
                'ebaValue' => $ebaSpeciesCount
            ])
        </div>
        <div class="col-md-4">
            @include('components.graphhorizontalbar', 
            [
                'itemLabel' => \App\Models\Language::getItem('userHomeVisitCountHorizontalGraphItemLabel'),
                'itemTitle' => \App\Models\Language::getItem('userHomeVisitCountHorizontalGraphItemTitle'),
                'myLabel' => \App\Models\Language::getItem('userHomeVisitCountHorizontalGraphItemMyLabel'),
                'ebaLabel' => \App\Models\Language::getItem('userHomeVisitCountHorizontalGraphItemEbaLabel'),
                'uniqueId' => 'ghb2',
                'myValue' => $userVisitCount,
                'ebaValue' => $ebaVisitCount
            ])
        </div>
        <div class="col-md-4">
            @include('components.graphhorizontalbar', 
            [
                'itemLabel' => \App\Models\Language::getItem('userHomeDistanceSumHorizontalGraphItemLabel'),
                'itemTitle' => \App\Models\Language::getItem('userHomeDistanceSumHorizontalGraphItemTitle'),
                'myLabel' => \App\Models\Language::getItem('userHomeDistanceSumHorizontalGraphItemMyLabel'),
                'ebaLabel' => \App\Models\Language::getItem('userHomeDistanceSumHorizontalGraphItemEbaLabel'),
                'uniqueId' => 'ghb3',
                'myValue' => $totalUserDistance,
                'ebaValue' => $totalEbaDistance
            ])
        </div>
        <div class="col-md-4">
            @include('components.graphhorizontalbar', 
            [
                'itemLabel' => \App\Models\Language::getItem('userHomeIndivCountHorizontalGraphItemLabel'),
                'itemTitle' => \App\Models\Language::getItem('userHomeIndivCountHorizontalGraphItemTitle'),
                'myLabel' => \App\Models\Language::getItem('userHomeIndivCountHorizontalGraphItemMyLabel'),
                'ebaLabel' => \App\Models\Language::getItem('userHomeIndivCountHorizontalGraphItemEbaLabel'),
                'uniqueId' => 'ghb4',
                'myValue' => $userIndivCount,
                'ebaValue' => $ebaIndivCount
            ])
        </div>
        <div class="col-md-4">
              @include('components.graphhorizontalbar', 
            [
                'itemLabel' => \App\Models\Language::getItem('userHomeVisitTimeCountHorizontalGraphItemLabel'),
                'itemTitle' => \App\Models\Language::getItem('userHomeVisitTimeCountHorizontalGraphItemTitle'),
                'myLabel' => \App\Models\Language::getItem('userHomeVisitTimeCountHorizontalGraphItemMyLabel'),
                'ebaLabel' => \App\Models\Language::getItem('userHomeVisitTimeCountHorizontalGraphItemEbaLabel'),
                'uniqueId' => 'ghb5',
                'myValue' => $userTotalVisitTime,
                'ebaValue' => $ebaTotalVisitTime
            ])
        </div>
        <div class="col-md-4">
              @include('components.graphhorizontalbar', 
            [
                'itemLabel' => \App\Models\Language::getItem('userHomeBadgeCountHorizontalGraphItemLabel'),
                'itemTitle' => \App\Models\Language::getItem('userHomeBadgeCountHorizontalGraphItemTitle'),
                'myLabel' => \App\Models\Language::getItem('userHomeBadgeCountHorizontalGraphItemMyLabel'),
                'ebaLabel' => \App\Models\Language::getItem('userHomeBadgeCountHorizontalGraphItemEbaLabel'),
                'uniqueId' => 'ghb6',
                'myValue' => $userBadgeCount,
                'ebaValue' => $ebaBadgeCount
            ])
        </div>
       
        <div class="col-md-4">
            <canvas id="landscapeBarGraph"></canvas>
        </div>
         <div class="col-md-4">
            <canvas id="managementBarGraph"></canvas>
        </div>
        <div class="col-md-4">
            <canvas id="landscapeBarGraphIndiv"></canvas>
        </div>
         <div class="col-md-4">
            <canvas id="managementBarGraphIndiv"></canvas>
        </div>

        */ ?>
    </div>

<script type="text/javascript">
    
//ebaLandscape
//ebaManagement
//userManagement
//userLandscape

//spcount
//indivcount
 
    var landscapeLabels = [];
    var ebaLanduseSpCount = []; 
    var ebaLanduseIndivCount = [];  
    var userLanduseSpCount = [];
    var userLanduseIndivCount = [];
    @if (is_array($ebaLandscape))
        @foreach($ebaLandscape as $eLa)
            landscapeLabels.push('{!!\App\Models\LanduseType::find($eLa->landusetype_id)->description!!}');
            <?php $userLanduseSpCount = 0; $userLanduseIndivCount = 0;?>
            @foreach($userLandscape as $uLa)
                @if ($uLa->landusetype_id == $eLa->landusetype_id)
                    <?php $userLanduseSpCount = $uLa->spcount; $userLanduseIndivCount = $uLa->indivcount; ?>
                @endif
            @endforeach
            userLanduseSpCount.push({{$userLanduseSpCount}});
            userLanduseIndivCount.push({{$userLanduseIndivCount}});
            ebaLanduseSpCount.push({{$eLa->spcount - $userLanduseSpCount}});
            ebaLanduseIndivCount.push({{$eLa->indivcount - $userLanduseIndivCount}});
        @endforeach
    @endif

    var managementLabels = [];
    var ebaManagementSpCount = []; 
    var ebaManagementIndivCount = [];  
    var userManagementSpCount = [];
    var userManagementIndivCount = [];
    @foreach($ebaManagement as $eMa)
        managementLabels.push('{!!\App\Models\ManagementType::find($eMa->managementtype_id)->description!!}');
        <?php $userManagementSpCount = 0; $userManagementIndivCount = 0;?>
        @foreach($userManagement as $uMa)
            @if ($uMa->managementtype_id == $eMa->managementtype_id)
                <?php $userManagementSpCount = $uMa->spcount; $userManagementIndivCount = $uMa->indivcount; ?>
            @endif
        @endforeach
        userManagementSpCount.push({{$userManagementSpCount}});
        userManagementIndivCount.push({{$userManagementIndivCount}});
        ebaManagementSpCount.push({{$eMa->spcount - $userManagementSpCount}});
        ebaManagementIndivCount.push({{$eMa->indivcount - $userManagementIndivCount}});
    @endforeach



    const labelslandscapeBarGraph = landscapeLabels;
    const datalandscapeBarGraph = {
        labels: labelslandscapeBarGraph,
        datasets: [
        {
            label: 'Eba',
            data: ebaLanduseSpCount,
            backgroundColor: "blue",
        },
        {
            label: 'User',
            data: userLanduseSpCount,
            backgroundColor: "green",
        }]
    };
    const datalandscapeBarGraphIndiv = {
        labels: labelslandscapeBarGraph,
        datasets: [
        {
            label: 'Eba',
            data: ebaLanduseIndivCount,
            backgroundColor: "blue",
        },
        {
            label: 'User',
            data: userLanduseIndivCount,
            backgroundColor: "green",
        }]
    };

    const labelsManagementBarGraph = managementLabels;
    const dataManagementBarGraph = {
        labels: labelsManagementBarGraph,
        datasets: [
        {
            label: 'Eba',
            data: ebaManagementSpCount,
            backgroundColor: "blue",
        },
        {
            label: 'User',
            data: userManagementSpCount,
            backgroundColor: "green",
        }]
    };
    const dataManagementBarGraphIndiv = {
        labels: labelsManagementBarGraph,
        datasets: [
        {
            label: 'Eba',
            data: ebaManagementIndivCount,
            backgroundColor: "blue",
        },
        {
            label: 'User',
            data: userManagementIndivCount,
            backgroundColor: "green",
        }]
    };

    const configlandscapeBarGraph = {
        type: 'bar',
        data: datalandscapeBarGraph,
        options: {
            plugins: {
                title: {
                    display: true,
                    text: '{{\App\Models\Language::getItem('userStatsLandscapeGraphTitle')}}'
                },
            },
            responsive: true,
            scales: {
                x: {
                    stacked: true,
                },
                y: {
                    stacked: true,
                    title: {
                        display: true,
                        text: '{{\App\Models\Language::getItem('userStatsLandscapeGraphYAxisSpCount')}}'
                    }
                }
            }
        }
    };
    const configlandscapeBarGraphIndiv = {
        type: 'bar',
        data: datalandscapeBarGraphIndiv,
        options: {
            plugins: {
                title: {
                    display: true,
                    text: '{{\App\Models\Language::getItem('userStatsLandscapeGraphTitle')}}'
                },
            },
            responsive: true,
            scales: {
                x: {
                    stacked: true,
                },
                y: {
                    stacked: true,
                    title: {
                        display: true,
                        text: '{{\App\Models\Language::getItem('userStatsLandscapeGraphYAxisIndiv')}}'
                    }
                }
            }
        }
    };

    const configManagementBarGraph = {
        type: 'bar',
        data: dataManagementBarGraph,
        options: {
            plugins: {
                title: {
                    display: true,
                    text: '{{\App\Models\Language::getItem('userStatsManagementGraphTitle')}}'
                },
            },
            responsive: true,
            scales: {
                x: {
                    stacked: true,
                },
                y: {
                    stacked: true, 
                    title: {
                        display: true,
                        text: '{{\App\Models\Language::getItem('userStatsManagementGraphYAxisSpCount')}}'
                    }
                }
            }
        }
    };

     const configManagementBarGraphIndiv = {
        type: 'bar',
        data: dataManagementBarGraphIndiv,
        options: {
            plugins: {
                title: {
                    display: true,
                    text: '{{\App\Models\Language::getItem('userStatsManagementGraphTitle')}}'
                },
            },
            responsive: true,
            scales: {
                x: {
                    stacked: true,
                },
                y: {
                    stacked: true, 
                    title: {
                        display: true,
                        text: '{{\App\Models\Language::getItem('userStatsManagementGraphYAxisIndiv')}}'
                    }
                }
            }
        }
    };
<?php /* 
const landscapeBarGraph = new Chart(document.getElementById('landscapeBarGraph'),configlandscapeBarGraph);
const managementBarGraph = new Chart(document.getElementById('managementBarGraph'),configManagementBarGraph);

const landscapeBarGraphIndiv = new Chart(document.getElementById('landscapeBarGraphIndiv'),configlandscapeBarGraphIndiv);
const managementBarGraphIndiv = new Chart(document.getElementById('managementBarGraphIndiv'),configManagementBarGraphIndiv);
*/ ?>
</script>


    

    <div class="container mb-3">
        <h2 class="p-4 userhome-section-title">{{\App\Models\Language::getItem('userHomeObservations')}}</h2>
        <div class="row">
            
            <div class="col-md-9 userhome-section-map">
                @include('layouts.map_show', ['countObjects'=>[], 'showSectionNrs' => 0]) 
            </div>
        </div>

    </div>



    <!-- Modal -->
    <div class="modal fade" id="modalId" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="messageContent">
                    ...
                </div>
                <div class="modal-body">
                    <img src="" id="messageImage1" class="img-fluid userhome-section-message-image">
                    <img src="" id="messageImage2" class="img-fluid userhome-section-message-image">
                </div>
                <span class="text-end text-small p-3" id="messageAt"></span>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary userhome-section-button" data-bs-dismiss="modal">{{\App\Models\Language::getItem('userHomeModalCloseButton')}}</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showModal(elem) {
            var myModal = new bootstrap.Modal(document.getElementById('modalId'), {
                keyboard: false
            })
            $('#messageTitle').html(elem.getAttribute('data_header'));
            $('#messageContent').html(elem.getAttribute('data_content'));
            $('#messageAt').html(elem.getAttribute('data_at'));
            $('#messageImage1').attr('src', elem.getAttribute('data_image1'));
            $('#messageImage2').attr('src', elem.getAttribute('data_image2'));
            ($('#messageImage1').attr('src') == "" ) ? $('#messageImage1').hide() : $('#messageImage1').show();
            ($('#messageImage2').attr('src') == "" ) ? $('#messageImage2').hide() : $('#messageImage2').show();
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
        var thisYearAll = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        var thisYearMine = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        var lastYearAll = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        var lastYearMine = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        var countPerSpeciesAll = [];
        var countPerSpeciesMine = [];
        var speciesLabels = [];
        var colorScheme = [];

        @foreach ($allSpMonthlyData as $asmd)
            @if ($asmd->year == date('Y'))
                thisYearAll
            @else
                lastYearAll
            @endif
            [{{ $asmd->month-1}}] = {{ $asmd->count }};
        @endforeach
        @foreach ($userSpMonthlyData as $usmd)
            @if ($usmd->year == date('Y'))
                thisYearMine
            @else
                lastYearMine
            @endif
            [{{ $usmd->month-1}}] = {{ $usmd->count }};
        @endforeach

        function getRandomColor() 
        {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        @foreach ($countPerSpeciesUser as $userSp)
            speciesLabels.push('{{ \App\Models\Species::find($userSp->species_id)->getName($user) }}');
            countPerSpeciesMine.push({{ $userSp->sum }});
            if (colorScheme.length == 0) { colorScheme.push('#62b2a0'); }
            if (colorScheme.length == 1) { colorScheme.push('#96a8be'); }
            if (colorScheme.length == 2) { colorScheme.push('#d8b667'); }
            if (colorScheme.length == 3) { colorScheme.push('#d5967d'); }
            if (colorScheme.length == 4) { colorScheme.push('orange'); }
            if (colorScheme.length == 5) { colorScheme.push('gray'); }
            if (colorScheme.length == 6) { colorScheme.push('purple'); }
            if (colorScheme.length > 6) { colorScheme.push(getRandomColor()); }
            var randomColor = Math.floor(Math.random()*16777215).toString(16);
            @foreach ($countPerSpeciesAll as $allSp)
                @if ($allSp->species_id == $userSp->species_id)
                    countPerSpeciesAll.push({{ $allSp->sum }});
                    @break;
                @endif
            @endforeach
        @endforeach

 
        // Species per month (all 2023): #F87A13  'rgb(180, 50, 70)',
        // Species per month (mine 2023): #1F7263  rgb(70, 50, 180) 
        // Species per month (all 2022): #FCB05E rgb(255, 99, 132)
        // Species per month (mine 2022): #69B2A4 rgb(132, 99, 255)

        const barData = {
            labels: labels,
            datasets: [{
                    label: 'Species per month (all {{ date('Y') }})',
                    backgroundColor: '#F87A13',
                    borderColor: '#F87A13',
                    data: thisYearAll,
                }, {
                    label: 'Species per month (all {{ date('Y', strtotime('-1 year')) }})',
                    backgroundColor: '#FCB05E',
                    borderColor: '#FCB05E',
                    data: lastYearAll,
                },
                {
                    label: 'Species per month (mine {{ date('Y') }})',
                    backgroundColor: '#1F7263',
                    borderColor: '#1F7263',
                    data: thisYearMine,
                },
                {
                    label: 'Species per month (mine {{ date('Y', strtotime('-1 year')) }})',
                    backgroundColor: '#69B2A4',
                    borderColor: '#69B2A4',
                    data: lastYearMine,
                }
            ]
        };

        const pie1Data = {
            labels: speciesLabels,
            datasets: [{
                label: 'Seen species (mine)',
                backgroundColor: colorScheme,
                borderColor: colorScheme,
                data: countPerSpeciesMine
            }]
        };
        const pie2Data = {
            labels: speciesLabels,
            datasets: [{
                label: 'Seen species (all)',
                backgroundColor: colorScheme,
                borderColor: colorScheme,
                data: countPerSpeciesAll
            }]
        };

        const config1 = {
            type: 'bar',
            data: barData,
            options: {}
        };

        const config2 = {
            type: 'pie',
            data: pie1Data,
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Seen species (mine)'
                    }
                }
            }
        };

        const config3 = {
            type: 'pie',
            data: pie2Data,
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Seen species (all)'
                    }
                }
            }
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

    <script>
        var map = $('#map').data('map');
        

        var vectorSourceAll = new ol.source.Vector({wrapX: false});
        @foreach($allObservations as $obs)
            @if (($obs->getLocationsAsGeoJson() != '') && (!str_contains($obs->getLocationsAsGeoJson(), '"geometry": {"type": null}')))
                vectorSourceAll.addFeatures( new ol.format.GeoJSON().readFeatures( <?php print_r($obs->getLocationsAsGeoJson()); ?> , 
                    {
                        dataProjection: 'EPSG:4326',
                        featureProjection: map.getView().getProjection()
                    }));
            @endif
        @endforeach

        var vectorSourceMy = new ol.source.Vector({wrapX: false});
        @foreach($allUserObservations as $obs)
            @if (($obs->getLocationsAsGeoJson() != '') && (!str_contains($obs->getLocationsAsGeoJson(), '"geometry": {"type": null}')))
                vectorSourceMy.addFeatures( new ol.format.GeoJSON().readFeatures( <?php print_r($obs->getLocationsAsGeoJson()); ?> , 
                    {
                        dataProjection: 'EPSG:4326',
                        featureProjection: map.getView().getProjection()
                    }));
            @endif
        @endforeach

        var vectorSource = '';
        function toggleObs(elem) 
        {
            if ($(elem).html() == '{{\App\Models\Language::getItem('userHomeMapMyObs')}}') 
            {
                $(elem).html('{{\App\Models\Language::getItem('userHomeMapAllObs')}}');
                vectorSource = vectorSourceAll;
            } 
            else 
            {
                $(elem).html('{{\App\Models\Language::getItem('userHomeMapMyObs')}}');
                vectorSource = vectorSourceMy;
            }
            
            var vector = $('#map').data('vector');
            vector.setSource(vectorSource);
            $('#map').data('vector', vector);
        }

        $( document ).ready(function() {
            toggleObs($('#toggleObsBut'))
        });

    </script>

    <style>
        .ol-custom {
            z-index: 1000;
            top: .5em;
            right: .5em;
        }

    </style>


@endsection
