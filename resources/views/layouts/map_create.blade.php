
            <link rel="stylesheet" href="/css/ol.css" type="text/css">
            <script src="/js/ol.js"></script>

            <div id="map" class="map" style="height:600px; width=100%"></div>

            <style>
                .mapSelector {
                    top: .5em;
                    right: .5em;
                    position: absolute;
                    border-radius: 4px;
                    padding: 2px;
                }
            </style>

            <script>

                fetch('https://service.pdok.nl/hwh/luchtfotorgb/wmts/v1_0?&request=GetCapabilities')
                .then(function (response) 
                {
                    return response.text();
                })
                .then(function (text) 
                {
                    var result =  new ol.format.WMTSCapabilities().read(text);
                    var options = ol.source.WMTS.optionsFromCapabilities(result, 
                    {
                        layer: 'Actueel_ortho25',
                        matrixSet: 'EPSG:4326',
                    });
                    options.wrapX = true;
                    var vectorSource = new ol.source.Vector({wrapX: true});
                    vector = new ol.layer.Vector({source: vectorSource});
                    var map = new ol.Map(
                    {
                        projection: 'EPSG:4326',
                        target: 'map',
                        layers: 
                        [
                            new ol.layer.Tile(
                            {
                                source: new ol.source.OSM(),
                            }),
                        /*    new ol.layer.Tile(
                            {
                                opacity: 0.7,
                                source: new ol.source.WMTS(options),
                            }), */
                            vector
                        ],
                        view: new ol.View(
                        {
                            center: ol.proj.fromLonLat([5, 52]),
                            zoom: 7
                        })
                    });

                    $('#map').data('map', map);
                    $('#map').data('vector', vector);

                    var modify = new ol.interaction.Modify({source: vectorSource});
                    modify.on('modifyend',function(e)
                    {
                        {{$finishModifyFunction}}(e);
                        //{{$finishDrawFunction}}(e);
                        //console.log("feature id is",e.features.getArray()[0].getId());
                    });
                    map.addInteraction(modify);
                    var draw, snap;

                    $(".ol-overlaycontainer-stopevent").append(`
                        <select id="geomType" style="pointer-events: auto; background-color: white;" class="mapSelector ol-control">
                            @if($showPoints==1) <option value="Point">Punt</option> @endif
                            @if($showLine==1)<option value="LineString" selected>Lijn</option> @endif
                            @if($showPolygon==1)<option value="Polygon">Polygoon</option> @endif
                            @isset($showCircle)<option value="Circle">Cirkel</option>@endisset
                        </select>`);

                    var typeSelect = document.getElementById('geomType');
                    function addInteractions() 
                    {
                        var value = typeSelect.value;
                        if (value !== 'None') 
                        {
                            draw = new ol.interaction.Draw(
                            {
                                source: vectorSource,
                                type: typeSelect.value,
                            });
                            map.addInteraction(draw);
                            snap = new ol.interaction.Snap({source: vectorSource});
                            map.addInteraction(snap);

                            @isset($finishDrawFunction)
                                draw.on('drawend', function (e) 
                                {
                                    {{$finishDrawFunction}}(e);
                                });
                            @endisset
                        }
                    }

                    typeSelect.onchange = function () 
                    {
                        map.removeInteraction(draw);
                        map.removeInteraction(snap);
                        addInteractions();
                    };
                    addInteractions();  
                }).then(function()
                {
                    {{$initMapFunction}}();
                });


/*
                var vectorSource = new ol.source.Vector({wrapX: false});
               
             //   $(document).ready(function()
              //  { 
                    var raster = new ol.layer.Tile(
                    {
                        source: new ol.source.OSM(),
                    });

                    var vectorSource = new ol.source.Vector({wrapX: false});
                    vector = new ol.layer.Vector({source: vectorSource});

                    var map = new ol.Map(
                    {
                        layers: [raster, vector],
                        target: 'map',
                        projection: 'EPSG:4326',
                        view: new ol.View(
                        {
                            center: ol.proj.fromLonLat([5, 52]),
                            zoom: 4
                        })
                    });

                    var modify = new ol.interaction.Modify({source: vectorSource});
                    modify.on('modifyend',function(e)
                    {
                        {{$finishModifyFunction}}(e);
                        //{{$finishDrawFunction}}(e);
                        //console.log("feature id is",e.features.getArray()[0].getId());
                    });
                    map.addInteraction(modify);
                    var draw, snap;

                    $(".ol-overlaycontainer-stopevent").append(`
                        <select id="geomType" style="pointer-events: auto;" class="mapSelector ol-control">
                            @if($showPoints==1) <option value="Point">Punt</option> @endif
                            @if($showLine==1)<option value="LineString" selected>Lijn</option> @endif
                            @if($showPolygon==1)<option value="Polygon">Polygoon</option> @endif
                            @isset($showCircle)<option value="Circle">Cirkel</option>@endisset
                        </select>`);

                    var typeSelect = document.getElementById('geomType');
                    function addInteractions() 
                    {
                        var value = typeSelect.value;
                        if (value !== 'None') 
                        {
                            draw = new ol.interaction.Draw(
                            {
                                source: vectorSource,
                                type: typeSelect.value,
                            });
                            map.addInteraction(draw);
                            snap = new ol.interaction.Snap({source: vectorSource});
                            map.addInteraction(snap);

                            @isset($finishDrawFunction)
                                draw.on('drawend', function (e) 
                                {
                                    {{$finishDrawFunction}}(e);
                                });
                            @endisset
                        }
                    }

                    typeSelect.onchange = function () 
                    {
                        map.removeInteraction(draw);
                        map.removeInteraction(snap);
                        addInteractions();
                    };
                    addInteractions();
*/
               // });
                    function addFeatureToVectorSource(feat)
                    {
                      //  console.log(feat);

                        var vector = $('#map').data('vector');

                        vector.getSource().addFeature(feat);
                       // vectorSource.addFeatures(feat);
                    }

                function getDrawData() 
                {
                    var features = vectorSource.getFeatures();
                    lines = [];
                    for(var i = 0; i<features.length;i++)
                    {
                        allCoors = features[i].values_.geometry.flatCoordinates;
                        points = [];
                        for (var j = 0; j < allCoors.length; j+=2)
                        {
                            var x = allCoors[j];
                            var y = allCoors[j+1];
                            var point = ol.proj.transform([x,y], 'EPSG:3857', 'EPSG:4326');
                            points.push(point);
                        }
                        lines.push(points);
                    }
                    return lines;
                }

                function addItemToMap(featureGeom, style = "")
                {
                    var vector = $('#map').data('vector');
                    var vectorSource = vector.getSource();
                   // var x = 143;
                   // var y = 5;
                   // var geom = new ol.geom.Point(ol.proj.fromLonLat([x, y]));
                    var feature = new ol.Feature(featureGeom);
                    if (style != "")
                    {
                        feature.setStyle(style);
                    }
                    vectorSource.addFeature(feature);
                }

                function clearMap()
                {
                    var vector = $('#map').data('vector');

                    var features = vector.getSource().getFeatures();
                    features.forEach((feature) => {
                        vector.getSource().removeFeature(feature);
                    });
                   // features.forEach((feature) => {
                  //   //   vector.getSource().addFeature(feature);
                  //  });
                 //   features.forEach((feature) => {
                  //      vectorLayer.getSource().removeFeature(feature);
                   // });
                    //alert("check");
                   // vectorSource = new ol.source.Vector({wrapX: false});
                    //vector = new ol.layer.Vector({source: vectorSource,});
                }

                function extractCoordinates(dat)
                {
                    var geom = dat.getGeometry();
                    allCoors = geom.flatCoordinates;
                    points = [];
                    for (var j = 0; j < allCoors.length; j+=2)
                    {
                        var x = allCoors[j];
                        var y = allCoors[j+1];
                        var point = ol.proj.transform([x,y], 'EPSG:3857', 'EPSG:4326');
                        points.push(point);
                    }
                    return points;
                }
            </script>