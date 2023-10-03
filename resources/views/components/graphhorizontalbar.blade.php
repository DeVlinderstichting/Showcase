
<?php 
    if (!(isset($itemLabel)))
    {
        $itemLabel = "";
    }
    if (!(isset($itemTitle)))
    {
        $itemTitle = "";
    }
    if (!(isset($myLabel)))
    {
        $myLabel = "My value";
    }
    if (!(isset($ebaLabel)))
    {
        $ebaLabel = "EBA value";
    }

    if (!(isset($uniqueId)))
    {
        $uniqueId = 1;
    }
    if (!(isset($myValue)))
    {
        $myValue = 0;
    }
    if (!(isset($ebaValue)))
    {
        $ebaValue = 1;
    }
    if ($ebaValue == 0)
    {
        $ebaValue = 1;
    }
    $myPercentageValue = (floatval($myValue) / floatval($ebaValue))*100;
    //$ebaRelativeValue = 100-$myRelativeValue;
    $myRelativeValue = $myValue;
    $ebaRelativeValue = $ebaValue-$myValue;
?>

<div class="userhome-section-graph">
    <canvas id="hbg{{$uniqueId}}"></canvas>
</div>

<script>

const labelsHbg{{$uniqueId}} = ["{{$itemLabel}}"];
const data{{$uniqueId}} = {
  labels: labelsHbg{{$uniqueId}},
  datasets: [
    {
      label: '{{$ebaLabel}}',
      data: [{{$ebaRelativeValue}}],
      borderColor: '#4bbb64',
      backgroundColor: '#4bbb64',
      stack: 'Stack 0',
    },
    {
      label: '{{$myLabel}}',
      data: [{{$myRelativeValue}}],
      borderColor: '#4bb1bb',
      backgroundColor: '#4bb1bb',
      stack: 'Stack 0',
    }
  ]
};

var chartAreaBorder = {
  id: 'chartAreaBorder',
  beforeDraw(chart, args, options) {
    const {ctx, chartArea: {left, top, width, height}} = chart;
    ctx.save();
    ctx.strokeStyle = options.borderColor;
    ctx.lineWidth = options.borderWidth;
    ctx.setLineDash(options.borderDash || []);
    ctx.lineDashOffset = options.borderDashOffset;
    ctx.strokeRect(left, top, width, height);
    ctx.restore();
  }
};

const config{{$uniqueId}} = {
    type: 'bar',
    data: data{{$uniqueId}},
    options: {
        indexAxis: 'y',
        elements: {
            bar: {
                borderWidth: 0,
            }
        },
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            },
            title: {
                display: true,
                text: '{{$itemTitle}} ({{intval($myPercentageValue)}}%}'
            },
            chartAreaBorder: {
                borderColor: 'black',//'#d4efd2',
                borderWidth: 0
            }
        },
        scales: {
            x: {
                min: 0,
                max: {{$ebaValue}},
                display:false
            }
        }
    },plugins: [chartAreaBorder]
};

const horizontalBarGraph{{$uniqueId}} = new Chart(document.getElementById('hbg{{$uniqueId}}'),config{{$uniqueId}});
</script>