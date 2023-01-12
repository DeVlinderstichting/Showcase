

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>




<script async src="https://unpkg.com/es-module-shims@1.3.6/dist/es-module-shims.js"></script>

<script type="importmap">
{
    "imports": {
        "three": "/js/three.module.js"
    }
}
</script>

<script type="module">
    import * as THREE from 'three';
    import { OrbitControls } from "https://threejs.org/examples/jsm/controls/OrbitControls.js";
    import { Earcut } from "/js/Earcut.js";

    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera( 30, window.innerWidth / window.innerHeight, 0.05, 10000 );
    camera.position.set( 0.5, 5, 0.5 );
    camera.lookAt(new THREE.Vector3(0.5,1,0.5));

    scene.background = new THREE.Color( 0xf0f0f0 ); //gray background 
    const gridHelper = new THREE.GridHelper( 8,8 ); //black lines to show plane
    scene.add( gridHelper );

    const renderer = new THREE.WebGLRenderer();
    renderer.setSize( window.innerWidth, window.innerHeight );
    document.body.appendChild( renderer.domElement );

    const controls = new OrbitControls( camera, renderer.domElement );


    //const happyTexture = new THREE.TextureLoader().load( "/images/textures/grassTexture.jpg" );
    //const happyMaterial = new THREE.MeshBasicMaterial( { map: happyTexture } );
    //happyMaterial.mapping = THREE.ClampToEdgeWrapping;
    const geometry = new THREE.BoxGeometry( 1, 1, 1 );
    const material = new THREE.MeshBasicMaterial( { color: 0x00ff00 } );
    //const cube = new THREE.Mesh( geometry, material );
   // scene.add( cube );

    function animate() 
    {
        requestAnimationFrame( animate );
        renderer.render( scene, camera );
       // cube.rotation.x += 0.01;
       // cube.rotation.y += 0.01;
       // console.log(camera.position);
    }
    animate();

    function earcutFlatten (data) 
    {
        var dim = data[0][0].length, result = {vertices: [], holes: [], dimensions: dim}, holeIndex = 0;

        for (var i = 0; i < data.length; i++) 
        {
            for (var j = 0; j < data[i].length; j++) 
            {
                for (var d = 0; d < dim; d++) 
                {
                    result.vertices.push(data[i][j][d]);
                }
            }
            if (i > 0) 
            {
                holeIndex += data[i - 1].length;
                result.holes.push(holeIndex);
            }
        }
        return result;
    }

    const grassTexture = new THREE.TextureLoader().load( "/images/textures/grassTexture.jpg" );
    grassTexture.wrapS = THREE.RepeatWrapping;
    grassTexture.wrapT = THREE.RepeatWrapping;
    
   // const brickTexture = new THREE.TextureLoader().load( "/images/textures/brickTexture.jpg" );
    const buildingTexture = new THREE.TextureLoader().load( "/images/textures/roofTexture.jpg" );
    buildingTexture.wrapS = THREE.RepeatWrapping;
    buildingTexture.wrapT = THREE.RepeatWrapping;

    const waterTexture = new THREE.TextureLoader().load( "/images/textures/waterTexture.png" );
    waterTexture.wrapS = THREE.RepeatWrapping;
    waterTexture.wrapT = THREE.RepeatWrapping;

    const forestTexture = new THREE.TextureLoader().load( "/images/textures/forestTexture.jpg" );
    forestTexture.wrapS = THREE.RepeatWrapping;
    forestTexture.wrapT = THREE.RepeatWrapping;

    const roadTexture = new THREE.TextureLoader().load( "/images/textures/roadTexture.jpg" );
    roadTexture.wrapS = THREE.RepeatWrapping;
    roadTexture.wrapT = THREE.RepeatWrapping;

    const woodTexture = new THREE.TextureLoader().load( "/images/textures/woodTexture.jpg" );
    woodTexture.wrapS = THREE.RepeatWrapping;
    woodTexture.wrapT = THREE.RepeatWrapping;

    const polyMaterialGrassland = new THREE.MeshBasicMaterial( { color:0x00ff55, map: grassTexture } );
    const polyMaterialBuilding = new THREE.MeshBasicMaterial( { color: 0xff0000, map:buildingTexture } );
    const polyMaterialWater = new THREE.MeshBasicMaterial( { color:  0x3D85C6, map:waterTexture } ); 
    const polyMaterialForest = new THREE.MeshBasicMaterial( { color: 0x38761D, map:forestTexture } );
    const polyMaterialRoad = new THREE.MeshBasicMaterial( { color: 0x000000, map:roadTexture } );
    const polyMaterialRemainder = new THREE.MeshBasicMaterial( { color: 0x999999 } );
    const polyMaterialWood = new THREE.MeshBasicMaterial( { color: 0x999999, map:woodTexture } );

    function getMaterial()
    {
        var rnd = Math.random();
        var material = polyMaterialGrassland;
        if (rnd < 0.25)
        {
            material = polyMaterialGrassland;
        }
        else if (rnd < 0.5)
        {
            material = polyMaterialWater;
        }
        else if (rnd < 0.75)
        {
            material = polyMaterialForest;
        }
        else 
        {
            var material = new THREE.MeshBasicMaterial( { color: 0xff0000 } );
            //material = polyMaterialForest;
        }
        return material;
    }

    var minX = 99999999;
    var minY = 99999999;
    var maxX = 0;
    var maxY = 0;

    var xRange = -1;
    var yRange = -1;

    var renderScale = 3;
    function normalizeCoordinates(x, y, z)
    {
        if (xRange <0){ xRange = maxX - minX;}
        if (yRange <0){ yRange = maxY - minY;}

        var newX = ((x - minX) / xRange);
        var newY = ((y - minY) / yRange);

        if (newX < 0) {newX = 0;}
        if (newX > 1) {newX = 1;}
        if (newY < 0) {newY = 0;}
        if (newY > 1) {newY = 1;}

   //     console.log("xrange: " + xRange + ", yrange: " + yRange);
    //    console.log("oldx: " + x + ", newx: " + newX);
     //   console.log("oldy: " + y + ", newy: " + newY);
        newX -= 0.5;
        newY -= 0.5;
        return [newX * renderScale, newY * renderScale, z];
    }

    function setDataNormalisationRange(input)
    {
        for(var i = 0 ; i < input.length; i++) //loop over geometries
        {
            var item = JSON.parse(input[i]);
            for (var j = 0 ; j < item['coordinates'][0].length; j++)
            {
                if (item['coordinates'][0][j][0] < minX) { minX = item['coordinates'][0][j][0];}
                if (item['coordinates'][0][j][1] < minY) { minY = item['coordinates'][0][j][1];}
                if (item['coordinates'][0][j][0] > maxX) { maxX = item['coordinates'][0][j][0];}
                if (item['coordinates'][0][j][1] > maxY) { maxY = item['coordinates'][0][j][1];}
            }
        }
   //     console.log("minX: " + minX);
   //     console.log("minY: " + minY);
   //     console.log("maxX: " + maxX);
   //     console.log("maxY: " + maxY);
    }
    const lineMaterial = new THREE.LineBasicMaterial({
            color: 0x0000ff
        }); 
    function addGeoJson(input)
    {
        var defaultZ = 0.2;
        setDataNormalisationRange(input);
        for(var i = 0 ; i < input.length; i++) //loop over geometries
        {
            var polyInputArr = []; //3d
            var polyPointPos = []; //2d
            var polyInputNormals = [];
            var lineInputArr = [];

            var item = JSON.parse(input[i]);
            var description = input[i]['type'];

            var itemCount = item['coordinates'][0].length;
            itemCount--;

            if ((item['type'] == "MultiPolygon") || (item['type'] == "Polygon"))
            {
                var coordinates = [];
                if (item['type'] == "Polygon")
                {
                    coordinates = item['coordinates'][0];
                }
                else if (item['type'] == "MultiPolygon")
                {
                    itemCount = item['coordinates'][0][0].length;
                    itemCount--;
                    coordinates = item['coordinates'][0][0];
                }

                var data = earcutFlatten(item['coordinates']);
                var triangles = Earcut.triangulate(data.vertices, data.holes, 2); //returns indices of points 
                var verticeDat = [];
                var uvDat = [];
                var uvPoints = [[0,0], [1,0], [1,1]];
              
                for (var vert = 0; vert < triangles.length; vert++) //main area
                {
                    var point = normalizeCoordinates(data.vertices[(triangles[vert]*2)], data.vertices[(triangles[vert]*2)+1], defaultZ);
                    verticeDat.push(point[1]); //yzx
                    verticeDat.push(point[2]);
                    verticeDat.push(point[0]);

                    uvDat.push(point[1]);
                    uvDat.push(point[0]); 
                }

                for (var vert = triangles.length -1; vert > -1 ; vert--) //make the underside 
                {
                    var point = normalizeCoordinates(data.vertices[(triangles[vert]*2)], data.vertices[(triangles[vert]*2)+1], defaultZ);
                    verticeDat.push(point[1]); //yzx
                    verticeDat.push(0);
                    verticeDat.push(point[0]);

                    uvDat.push(point[1]);
                    uvDat.push(point[0]); 
                }

                //going down
                for (var vert = 0; vert < triangles.length; vert+=3)
                {
                    var pA = normalizeCoordinates(data.vertices[(triangles[vert]*2)], data.vertices[(triangles[vert]*2)+1], defaultZ);
                    var pB = normalizeCoordinates(data.vertices[(triangles[vert+1]*2)], data.vertices[(triangles[vert+1]*2)+1], defaultZ);
                    var pC = normalizeCoordinates(data.vertices[(triangles[vert+2]*2)], data.vertices[(triangles[vert+2]*2)+1], defaultZ);

                    //triangle abbz 
                    //point a
                    verticeDat.push(pA[1]); //yzx
                    verticeDat.push(pA[2]);
                    verticeDat.push(pA[0]);
                    uvDat.push(pA[1]);
                    uvDat.push(pA[0]);

                    //point b 
                    verticeDat.push(pB[1]); //yzx
                    verticeDat.push(pB[2]);
                    verticeDat.push(pB[0]);
                    uvDat.push(pB[1]);
                    uvDat.push(pB[0]);

                    //point bz 
                    verticeDat.push(pB[1]); //yzx
                    verticeDat.push(0);
                    verticeDat.push(pB[0]);
                    uvDat.push(pB[1]);
                    uvDat.push(pB[0]);

                    //and the inverse (bzba)
                    verticeDat.push(pB[1]); //yzx
                    verticeDat.push(0);
                    verticeDat.push(pB[0]);
                    uvDat.push(pB[1]);
                    uvDat.push(pB[0]);
                    verticeDat.push(pB[1]); //yzx
                    verticeDat.push(pB[2]);
                    verticeDat.push(pB[0]);
                    uvDat.push(pB[1]);
                    uvDat.push(pB[0]);
                    verticeDat.push(pA[1]); //yzx
                    verticeDat.push(pA[2]);
                    verticeDat.push(pA[0]);
                    uvDat.push(pA[1]);
                    uvDat.push(pA[0]);
                    
                    //triangle bz az a
                    verticeDat.push(pB[1]); //yzx
                    verticeDat.push(0);
                    verticeDat.push(pB[0]);
                    uvDat.push(point[1]);
                    uvDat.push(point[0]);

                    verticeDat.push(pA[1]); //yzx
                    verticeDat.push(0);
                    verticeDat.push(pA[0]); 
                    uvDat.push(point[1]);
                    uvDat.push(point[0]);
                    verticeDat.push(pA[1]); //yzx
                    verticeDat.push(pA[2]);
                    verticeDat.push(pA[0]);
                    uvDat.push(point[1]);
                    uvDat.push(point[0]);
                    
                    //and aazbz
                    verticeDat.push(pA[1]); //yzx
                    verticeDat.push(pA[2]);
                    verticeDat.push(pA[0]);
                    uvDat.push(point[1]);
                    uvDat.push(point[0]);
                    verticeDat.push(pA[1]); //yzx
                    verticeDat.push(0);
                    verticeDat.push(pA[0]); 
                    uvDat.push(point[1]);
                    uvDat.push(point[0]);
                    verticeDat.push(pB[1]); //yzx
                    verticeDat.push(0);
                    verticeDat.push(pB[0]);
                    uvDat.push(point[1]);
                    uvDat.push(point[0]);
                    
                    //triangle b c cz
                    verticeDat.push(pB[1]); //yzx
                    verticeDat.push(pB[2]);
                    verticeDat.push(pB[0]); 
                    uvDat.push(point[1]);
                    uvDat.push(point[0]);
                    verticeDat.push(pC[1]); //yzx
                    verticeDat.push(pC[2]);
                    verticeDat.push(pC[0]); 
                    uvDat.push(point[1]);
                    uvDat.push(point[0]);
                    verticeDat.push(pC[1]); //yzx
                    verticeDat.push(0);
                    verticeDat.push(pC[0]); 
                    uvDat.push(point[1]);
                    uvDat.push(point[0]);

                    verticeDat.push(pC[1]); //yzx
                    verticeDat.push(0);
                    verticeDat.push(pC[0]);
                    uvDat.push(point[1]);
                    uvDat.push(point[0]);
                    verticeDat.push(pC[1]); //yzx
                    verticeDat.push(pC[2]);
                    verticeDat.push(pC[0]); 
                    uvDat.push(point[1]);
                    uvDat.push(point[0]);
                    verticeDat.push(pB[1]); //yzx
                    verticeDat.push(pB[2]);
                    verticeDat.push(pB[0]); 
                    uvDat.push(point[1]);
                    uvDat.push(point[0]);

                    //triangle cz bz b
                    verticeDat.push(pC[1]); //yzx
                    verticeDat.push(0);
                    verticeDat.push(pC[0]); 
                    uvDat.push(point[1]);
                    uvDat.push(point[0]);
                    verticeDat.push(pB[1]); //yzx
                    verticeDat.push(0);
                    verticeDat.push(pB[0]); 
                    uvDat.push(point[1]);
                    uvDat.push(point[0]);
                    verticeDat.push(pB[1]); //yzx
                    verticeDat.push(pB[2]);
                    verticeDat.push(pB[0]); 
                    uvDat.push(point[1]);
                    uvDat.push(point[0]);

                    verticeDat.push(pB[1]); //yzx
                    verticeDat.push(pB[2]);
                    verticeDat.push(pB[0]);
                    uvDat.push(point[1]);
                    uvDat.push(point[0]);
                    verticeDat.push(pB[1]); //yzx
                    verticeDat.push(0);
                    verticeDat.push(pB[0]); 
                    uvDat.push(point[1]);
                    uvDat.push(point[0]);
                    verticeDat.push(pC[1]); //yzx
                    verticeDat.push(0);
                    verticeDat.push(pC[0]); 
                    uvDat.push(point[1]);
                    uvDat.push(point[0]);

                    //triangle a az c 
                    verticeDat.push(pA[1]); //yzx
                    verticeDat.push(pA[2]);
                    verticeDat.push(pA[0]); 
                    uvDat.push(point[1]);
                    uvDat.push(point[0]);
                    verticeDat.push(pA[1]); //yzx
                    verticeDat.push(0);
                    verticeDat.push(pA[0]); 
                    uvDat.push(point[1]);
                    uvDat.push(point[0]);
                    verticeDat.push(pC[1]); //yzx
                    verticeDat.push(pC[2]);
                    verticeDat.push(pC[0]);
                    uvDat.push(point[1]);
                    uvDat.push(point[0]);

                    verticeDat.push(pC[1]); //yzx
                    verticeDat.push(pC[2]);
                    verticeDat.push(pC[0]);
                    uvDat.push(point[1]);
                    uvDat.push(point[0]);
                    verticeDat.push(pA[1]); //yzx
                    verticeDat.push(0);
                    verticeDat.push(pA[0]); 
                    uvDat.push(point[1]);
                    uvDat.push(point[0]);
                    verticeDat.push(pA[1]); //yzx
                    verticeDat.push(pA[2]);
                    verticeDat.push(pA[0]);
                    uvDat.push(point[1]);
                    uvDat.push(point[0]);

                    //triangle az cz c 
                    verticeDat.push(pA[1]); //yzx
                    verticeDat.push(0);
                    verticeDat.push(pA[0]); 
                    uvDat.push(point[1]);
                    uvDat.push(point[0]);
                    verticeDat.push(pC[1]); //yzx
                    verticeDat.push(0);
                    verticeDat.push(pC[0]); 
                    uvDat.push(point[1]);
                    uvDat.push(point[0]);
                    verticeDat.push(pC[1]); //yzx
                    verticeDat.push(pC[2]);
                    verticeDat.push(pC[0]);
                    uvDat.push(point[1]);
                    uvDat.push(point[0]);

                    verticeDat.push(pC[1]); //yzx
                    verticeDat.push(pC[2]);
                    verticeDat.push(pC[0]);
                    uvDat.push(point[1]);
                    uvDat.push(point[0]);
                    verticeDat.push(pC[1]); //yzx
                    verticeDat.push(0);
                    verticeDat.push(pC[0]); 
                    uvDat.push(point[1]);
                    uvDat.push(point[0]);
                    verticeDat.push(pA[1]); //yzx
                    verticeDat.push(0);
                    verticeDat.push(pA[0]); 
                    uvDat.push(point[1]);
                    uvDat.push(point[0]);
                    
                }



                var vertices = new Float32Array(verticeDat);
                var uvs = new Float32Array(uvDat);
                var polyGeometry = new THREE.BufferGeometry();

                polyGeometry.setAttribute( 'position', new THREE.BufferAttribute( vertices, 3 ) );
                polyGeometry.setAttribute( 'uv', new THREE.BufferAttribute( uvs, 2 ) );

                var mesh = new THREE.Mesh( polyGeometry, getMaterial(description) );
                scene.add(mesh);

//var exporter = new GLTFExporter();
           //     exporter.parse( mesh, function ( gltf ){console.log(gltf);}, { binary: false, embedImages: false } );


                //cheat a little (add line from first poly point to origin to find weird renders) 
                var lineInputArr = [];
                lineInputArr.push(new THREE.Vector3(polyInputArr[0], polyInputArr[1], polyInputArr[2]));
                lineInputArr.push(new THREE.Vector3(0,0,0));
                var lineGeometry = new THREE.BufferGeometry().setFromPoints( lineInputArr );
                var line = new THREE.Line( lineGeometry, lineMaterial );
                scene.add(line); 
            }
            else if (item['type'] == "LineString")
            {
                var straightDownLineInputArr = [];
                for (var j = 0; j < item.coordinates.length; j++) //loop over points in geometry
                {
                    var point = normalizeCoordinates(item['coordinates'][j][0], item['coordinates'][j][1], 1.03);
                    lineInputArr.push( new THREE.Vector3(point[1], point[2], point[0])); //y z x

                  //  straightDownLineInputArr.push( new THREE.Vector3(point[1], z, point[0])); //y z x
                }
                var lineGeometry = new THREE.BufferGeometry().setFromPoints( lineInputArr );
                
                var straightDownLineGeometry = new THREE.BufferGeometry().setFromPoints( straightDownLineInputArr );

                var line = new THREE.Line( lineGeometry, lineMaterial );
                var straightDownLine = new THREE.Line( straightDownLineGeometry, lineMaterial );
                scene.add(line);
                scene.add(straightDownLine);

                var cheatLineInputArr = [];
                cheatLineInputArr.push(lineInputArr[0]);
                cheatLineInputArr.push(new THREE.Vector3(0,0,0));
                var lineGeometry = new THREE.BufferGeometry().setFromPoints( cheatLineInputArr );
                var line = new THREE.Line( lineGeometry, lineMaterial );
                scene.add(line); 
            }
        }
    }

    var jsonLines = [];
    <?php 
        $landscape = \App\Models\Landscape::first();
        $sqLine = "SELECT ST_AsGeoJSON(shape) as shape FROM landscapecomponents where landscape_id = $landscape->id";
        $geomData = DB::select($sqLine);
        foreach($geomData as $gd)
        {
            print("jsonLines.push('". $gd->shape . "');\n");
        }
        
       // $jsonGeomDat = json_encode($geomData, JSON_FORCE_OBJECT);
       // dd($jsonGeomDat);
    ?>
   // addGeoJson(jsonLines);

   
    function getMaterialFromValue(value)
    {
        var material = polyMaterialGrassland;
        if (value == 1)
        {
            material = polyMaterialGrassland;
        }
        else if (value == 2)
        {
            material = polyMaterialWater;
        }
        else if (value == 3)
        {
            material = polyMaterialForest;
        }
        else 
        {
            var material = new THREE.MeshBasicMaterial( { color: 0xff0000 } );
            //material = polyMaterialForest;
        }
        return material;
    }


    function renderCell(cellX, cellY, cellZ, cellValue)
    {
        var scale = 1;
        var verticeDat = [];
        var uvDat = [];
        var uvPoints = [[0,0], [1,0], [1,1], [0,1]];
        verticeDat.push(cellY*scale); //yzx
        verticeDat.push(cellZ*scale);
        verticeDat.push(cellX*scale);
        uvDat.push(uvPoints[0][0]);
        uvDat.push(uvPoints[0][1]);

        verticeDat.push(cellY*scale); //yzx
        verticeDat.push(cellZ*scale);
        verticeDat.push(cellX+1*scale);
        uvDat.push(uvPoints[1][0]);
        uvDat.push(uvPoints[1][1]);

        verticeDat.push(cellY+1*scale); //yzx
        verticeDat.push(cellZ*scale);
        verticeDat.push(cellX+1*scale);
        uvDat.push(uvPoints[2][0]);
        uvDat.push(uvPoints[2][1]);


        verticeDat.push(cellY*scale); //yzx
        verticeDat.push(cellZ*scale);
        verticeDat.push(cellX*scale);
        uvDat.push(uvPoints[0][0]);
        uvDat.push(uvPoints[0][1]);

        verticeDat.push(cellY+1*scale); //yzx
        verticeDat.push(cellZ*scale);
        verticeDat.push(cellX+1*scale);
        uvDat.push(uvPoints[2][0]);
        uvDat.push(uvPoints[2][1]);

        verticeDat.push(cellY+1*scale); //yzx
        verticeDat.push(cellZ*scale);
        verticeDat.push(cellX*scale);
        uvDat.push(uvPoints[3][0]);
        uvDat.push(uvPoints[3][1]);


        var vertices = new Float32Array(verticeDat);
        var uvs = new Float32Array(uvDat);
        var polyGeometry = new THREE.BufferGeometry();

        polyGeometry.setAttribute( 'position', new THREE.BufferAttribute( vertices, 3 ) );
        polyGeometry.setAttribute( 'uv', new THREE.BufferAttribute( uvs, 2 ) );
        var mat = new THREE.MeshBasicMaterial( { color: 0x00ff00 } );
        var mat = getMaterialFromValue(cellValue);
        var mesh = new THREE.Mesh( polyGeometry, mat );
        scene.add(mesh);

        if (cellZ > 0)
        {
            var boxVerticeDat = [];
            var boxUvDat =[];
            boxVerticeDat.push(cellY*scale); //yzx
            boxVerticeDat.push(cellZ*scale);
            boxVerticeDat.push(cellX*scale);
            boxUvDat.push(uvPoints[0][0]);
            boxUvDat.push(uvPoints[0][1]);

            boxVerticeDat.push(cellY*scale); //yzx
            boxVerticeDat.push(0);
            boxVerticeDat.push(cellX*scale);
            boxUvDat.push(uvPoints[0][0]);
            boxUvDat.push(uvPoints[0][1]);

            boxVerticeDat.push(cellY*scale); //yzx
            boxVerticeDat.push(cellZ*scale);
            boxVerticeDat.push(cellX+1*scale);
            boxUvDat.push(uvPoints[1][0]);
            boxUvDat.push(uvPoints[1][1]);

            boxVerticeDat.push(cellY*scale); //yzx
            boxVerticeDat.push(0);
            boxVerticeDat.push(cellX*scale);
            boxUvDat.push(uvPoints[0][0]);
            boxUvDat.push(uvPoints[0][1]);

            boxVerticeDat.push(cellY*scale); //yzx
            boxVerticeDat.push(0);
            boxVerticeDat.push(cellX+1*scale);
            boxUvDat.push(uvPoints[1][0]);
            boxUvDat.push(uvPoints[1][1]);

            boxVerticeDat.push(cellY*scale); //yzx
            boxVerticeDat.push(cellZ*scale);
            boxVerticeDat.push(cellX+1*scale);
            boxUvDat.push(uvPoints[1][0]);
            boxUvDat.push(uvPoints[1][1]);

            var boxVertices = new Float32Array(boxVerticeDat);
            var boxUvs = new Float32Array(boxUvDat);
            var boxPolyGeometry = new THREE.BufferGeometry();

            boxPolyGeometry.setAttribute( 'position', new THREE.BufferAttribute( boxVertices, 3 ) );
            boxPolyGeometry.setAttribute( 'uv', new THREE.BufferAttribute( boxUvs, 2 ) );
            var boxMesh = new THREE.Mesh( boxPolyGeometry, polyMaterialWood );
            scene.add(boxMesh);
        }


       

    }
    function renderMatrix(inputMatrix)
    {
        for(var x = 0; x < inputMatrix.length; x++) 
        {
            var line = inputMatrix[x];
            for(var y = 0; y < line.length; y++) 
            {
                renderCell(x,y,1,line[y]);
            }
        }
    }
   // renderCell(0,0,0,2);
   // renderCell(1,1,0,1);
    
 <?php $landscape = [[1,2,1],[0,1,1],[3,2,1]]; ?>
var landscape = [[1,2,1],[0,1,1],[3,2,1]];
renderMatrix(landscape);
    
  
</script>


<div class="container-fluid background-container d-flex">
    <div class="central-container" align="middle">
        <h1>Welcome to Showcase</h1>
        TEST PAGE 12
    </div>
</div>