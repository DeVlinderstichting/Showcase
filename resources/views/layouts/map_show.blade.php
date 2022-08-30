
<link rel="stylesheet" href="/css/ol.css" type="text/css">
<script src="/js/ol.js"></script>
            
</script>
<?php 
    if (!(isset($showSectionNrs)))
    {
        $showSectionNrs = false;
    }
    if (!(isset($highResImage)))
    {
        $highResImage = false;
    }
    if (!(isset($zoomModifier)))
    {
        $zoomModifier = -0.25;
    }
?> 
<div id="map" class="map" style="height: 500px; width:100%"></div>
<script type="text/javascript">
    @if($highResImage)
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
                        new ol.layer.Tile(
                        {
                            opacity: 0.7,
                            source: new ol.source.WMTS(options),
                        }),
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


                var extentEmpty = true;
                var extent = ol.extent.createEmpty();
                @foreach($countObjects as $object)
                    @if ($object->getLocationsAsGeoJson() != '')
                        var vectorSource{{$object->id}} = new ol.source.Vector({wrapX: false});
                        vectorSource{{$object->id}}.addFeatures( new ol.format.GeoJSON().readFeatures( <?php print_r($object->getLocationsAsGeoJson()); ?> , 
                            {
                                dataProjection: 'EPSG:4326',
                                featureProjection: map.getView().getProjection()
                            }));

                            var vectorLayer{{$object->id}} = new ol.layer.Vector(
                            {
                                source: vectorSource{{$object->id}},
                                style: function(feature)
                                {
                                    var itemName = feature.get('name');
                                    var iVal = parseInt(itemName);

                                    if (isNaN(itemName))
                                    {
                                        style = new ol.style.Style(
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
                                            }),
                                            text: new ol.style.Text(
                                            {
                                                font: '20px Calibri,sans-serif',
                                                fill: new ol.style.Fill({ color: '#000' }),
                                                stroke: new ol.style.Stroke(
                                                {
                                                    color: '#fff', width: 2
                                                })
                                            })
                                        });
                                    }
                                    else 
                                    {
                                        if (iVal % 2 == 0)
                                        {
                                            style = new ol.style.Style(
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
                                                }),
                                                text: new ol.style.Text(
                                                {
                                                    font: '20px Calibri,sans-serif',
                                                    fill: new ol.style.Fill({ color: '#000' }),
                                                    stroke: new ol.style.Stroke(
                                                    {
                                                        color: '#fff', width: 2
                                                    })
                                                })
                                            });
                                        }
                                        else 
                                        {
                                            style = new ol.style.Style(
                                            {
                                                image: new ol.style.Circle(
                                                {
                                                    radius: 5,
                                                    fill: new ol.style.Fill({color: 'black'})
                                                }),
                                                stroke: new ol.style.Stroke(
                                                {
                                                    color: 'OrangeRed',
                                                    width: 5
                                                }),
                                                text: new ol.style.Text(
                                                {
                                                    font: '20px Calibri,sans-serif',
                                                    fill: new ol.style.Fill({ color: '#000' }),
                                                    stroke: new ol.style.Stroke(
                                                    {
                                                        color: '#fff', width: 2
                                                    })//,
                                                    //text: "iglo"//feature.get('name')
                                                })
                                            });
                                        }
                                    }

                                    @if ($showSectionNrs)
                                        style.getText().setText("      " + feature.get('name'));
                                    @else
                                        if (iVal == 1)
                                        {
                                            style.getText().setText("      {{$object->friendlycode}}");
                                        }
                                    @endif
                                    return style;
                                }
                            });
                        map.addLayer(vectorLayer{{$object->id}});
                        ol.extent.extend(extent, vectorSource{{$object->id}}.getExtent());
                        extentEmpty = false;
                    @endif
                @endforeach
                if (!extentEmpty)
                {
                    map.getView().fit(extent, map.getSize());
                }
                map.getView().setZoom(map.getView().getZoom()+ {{$zoomModifier}});
            });
    @else 


        var vectorSource = new ol.source.Vector({wrapX: true});
        vector = new ol.layer.Vector({source: vectorSource});
        var map = new ol.Map(
        {
            projection: 'EPSG:4326',
            target: 'map',
            layers: [
                new ol.layer.Tile(
                {
                    source: new ol.source.OSM(),
                }), vector //,
              /*  new ol.layer.Tile(
                {
                    opacity: 0.7,
                    source: new ol.source.WMTS(
                    {
                        url:
                          'https://service.pdok.nl/hwh/luchtfotorgb/wmts/v1_0', //?&request=GetTile&service=wmts
                        layer: 'Actueel_ortho25',
                        matrixSet: 'EPSG:4326',
                        format: 'image/png',
                        projection: 'EPSG:4326',
                        tileGrid: new ol.tilegrid.WMTS(
                        {
                            origin: ol.extent.getTopLeft(projectionExtent),
                            resolutions: resolutions,
                            matrixIds: matrixIds,
                        }),
                        style: 'default',
                        wrapX: true,
                    }),
                }) */
            ],
            view: new ol.View(
            {
                center: ol.proj.fromLonLat([5, 52]),
                zoom: 4
            })
        });


        function addObjectsToMap()
        {
         //   var map = $('#map').data('map'); 
         // console.log(document.getElementById("map").data);
           // var map = document.getElementById("map").data;
           // console.log(map);
         //   var proje = map.getView().getProjection();
       //     $('#map').data('map', map);
         //   var map = $('#map').data('map');

            var extentEmpty = true;
            var extent = ol.extent.createEmpty();
            @foreach($countObjects as $object)
                @if ($object->getLocationsAsGeoJson() != '')
                    var vectorSource{{$object->id}} = new ol.source.Vector({wrapX: false});
                    vectorSource{{$object->id}}.addFeatures( new ol.format.GeoJSON().readFeatures( <?php print_r($object->getLocationsAsGeoJson()); ?> , 
                        {
                            dataProjection: 'EPSG:4326',
                            featureProjection: map.getView().getProjection()
                        }));

                        var vectorLayer{{$object->id}} = new ol.layer.Vector(
                        {
                            source: vectorSource{{$object->id}},
                            style: function(feature)
                            {
                                var itemName = feature.get('name');
                                var iVal = parseInt(itemName);

                                if (isNaN(itemName))
                                {
                                    style = new ol.style.Style(
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
                                        }),
                                        text: new ol.style.Text(
                                        {
                                            font: '20px Calibri,sans-serif',
                                            fill: new ol.style.Fill({ color: '#000' }),
                                            stroke: new ol.style.Stroke(
                                            {
                                                color: '#fff', width: 2
                                            })//,
                                            //text: "iglo"//feature.get('name')
                                        })
                                    });
                                }
                                else 
                                {
                                    if (iVal % 2 == 0)
                                    {
                                        style = new ol.style.Style(
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
                                            }),
                                            text: new ol.style.Text(
                                            {
                                                font: '20px Calibri,sans-serif',
                                                fill: new ol.style.Fill({ color: '#000' }),
                                                stroke: new ol.style.Stroke(
                                                {
                                                    color: '#fff', width: 2
                                                })//,
                                                //text: "iglo"//feature.get('name')
                                            })
                                        });
                                    }
                                    else 
                                    {
                                        style = new ol.style.Style(
                                        {
                                            image: new ol.style.Circle(
                                            {
                                                radius: 5,
                                                fill: new ol.style.Fill({color: 'black'})
                                            }),
                                            stroke: new ol.style.Stroke(
                                            {
                                                color: 'OrangeRed',
                                                width: 5
                                            }),
                                            text: new ol.style.Text(
                                            {
                                                font: '20px Calibri,sans-serif',
                                                fill: new ol.style.Fill({ color: '#000' }),
                                                stroke: new ol.style.Stroke(
                                                {
                                                    color: '#fff', width: 2
                                                })//,
                                                //text: "iglo"//feature.get('name')
                                            })
                                        });
                                    }
                                }

                                @if ($showSectionNrs)
                                    style.getText().setText("      " + feature.get('name'));
                                @else
                                    if (iVal == 1)
                                    {
                                        style.getText().setText("      {{$object->friendlycode}}");
                                    }
                                @endif
                                return style;
                            }
                        });


                  /* 
                //text: "iglo"//feature.get('name')
                   vectorLayer{{$object->id}}.features.forEach(function(feature)
                    {
                        var myStyle = new ol.style.Style(
                        {
                            font: '20px Calibri,sans-serif',
                            fill: new ol.style.Fill({ color: '#000' }),
                            stroke: new ol.style.Stroke(
                            {
                                color: '#fff', width: 2
                            }),
                        });
                        myStyle.getText().setText(feature['name']);
                        feature.setStyle(myStyle);
                    });*/

                 //  vectorLayer{{$object->id}}.getStyle style.setText("test text");
                    map.addLayer(vectorLayer{{$object->id}});
                    ol.extent.extend(extent, vectorSource{{$object->id}}.getExtent());
                   // console.log(extent);
                    extentEmpty = false;
                @endif
            @endforeach
            if (!extentEmpty)
            {
                map.getView().fit(extent, map.getSize());
            }
            map.getView().setZoom(map.getView().getZoom()+{{$zoomModifier}});
        }
        addObjectsToMap();
        if (map.getView().getZoom() > 18)
        {
            map.getView().setZoom(18);
        }
    @endif
    $('#map').data('vector', vector);
    $('#map').data('map', map);
    
</script>