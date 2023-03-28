
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
    import { GLTFLoader } from 'https://threejs.org/examples/jsm/loaders/GLTFLoader.js';

    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera( 30, window.innerWidth / window.innerHeight, 0.05, 10000 );
    camera.position.set( 0.5, 5, 0.5 );
    camera.lookAt(new THREE.Vector3(0.5,1,0.5));

    scene.background = new THREE.Color( 0xf0f0f0 ); //gray background 
   // const gridHelper = new THREE.GridHelper( 8,8 ); //black lines to show plane
   // scene.add( gridHelper );

    const renderer = new THREE.WebGLRenderer();
    renderer.setSize( window.innerWidth, window.innerHeight );
    document.body.appendChild( renderer.domElement );

    const controls = new OrbitControls( camera, renderer.domElement );

    const manager = new THREE.LoadingManager();
    manager.onLoad = init;
    const models = {
      pig:    { url: 'resources/models/animals/Pig.gltf' },
      cow:    { url: 'resources/models/animals/Cow.gltf' },
      llama:  { url: 'resources/models/animals/Llama.gltf' },
      pug:    { url: 'resources/models/animals/Pug.gltf' },
      sheep:  { url: 'resources/models/animals/Sheep.gltf' },
      zebra:  { url: 'resources/models/animals/Zebra.gltf' },
      horse:  { url: 'resources/models/animals/Horse.gltf' },
      knight: { url: 'resources/models/knight/KnightCharacter.gltf' },
    };
    {
      const gltfLoader = new GLTFLoader(manager);
      for (const model of Object.values(models)) {
        gltfLoader.load(model.url, (gltf) => {
          model.gltf = gltf;
        });
      }
    }

    var theCube = null;

    const loader = new GLTFLoader().setPath( 'images/' );
    await loader.load( 'testCube2.glb', function ( gltf ) 
    {
        //gltf.scene.position.setX(5);
        theCube = gltf.scene;
        console.log("gltf loaded");
        
      //  render();
    });



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
            material = new THREE.MeshBasicMaterial( { color: 0xff0000 } );
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

    
    var materials = [];
    materials[0] = ['clouds', new THREE.MeshBasicMaterial( { color: 0xffffff})];
    materials[62] = ['Artificial surfaces and constructions', new THREE.MeshBasicMaterial( { color: 0xff0000})];
    materials[73] = ['Cultivated areas', new THREE.MeshBasicMaterial( { color: 0x666666})];
    materials[82] = ['Broadleaf tree cover', new THREE.MeshBasicMaterial( { color: 0x6AA84F})];
    materials[83] = ['Coniferous tree cover', new THREE.MeshBasicMaterial( { color: 0x3B811C})];
    materials[102] = ['Herbaceous vegetation', new THREE.MeshBasicMaterial( { color: 0x1AF41A})];
    materials[103] = ['Moors and Heathland', new THREE.MeshBasicMaterial( { color: 0xE154E1})];
    materials[104] = ['Sclerophyllous vegetation', new THREE.MeshBasicMaterial( { color: 0x82EED2})];
    materials[105] = ['Marshes', new THREE.MeshBasicMaterial( { color: 0x48C9A6})];
    materials[106] = ['Peatbogs', new THREE.MeshBasicMaterial( { color: 0x1B9A9A})];
    materials[121] = ['Natural material surfaces', new THREE.MeshBasicMaterial( { color: 0x785B5B})];
    materials[123] = ['Permanent snow covered surfaces', new THREE.MeshBasicMaterial( { color: 0xffffff})];
    materials[162] = ['Water bodies', new THREE.MeshBasicMaterial( { color: 0x008FFF})];
    materials[255] = ['No data', new THREE.MeshBasicMaterial( { color: 0x000000})];




    function getMaterialFromValue(value)
    {
        return materials[value][1];




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

    var scale = 1;
    function renderCell(cellX, cellY, cellZ, cellValue)
    {
        
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
       // var mat = new THREE.MeshBasicMaterial( { color: 0x00ff00 } );
        var mat = getMaterialFromValue(cellValue);
        var mesh = new THREE.Mesh( polyGeometry, mat );
        scene.add(mesh);

     /*   if (cellZ > 0)
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
    */
    }
    var invalidValue = -99999;
    function renderRaster(raster, yCorrection, zCorrection, xCorrection, borders=true) //expects a two dim raster of double arrays (x y -> [landuse, elev])
    {
        
        for (let y = 0; y < raster.length; y++)
        {
            for (let x = 0; x < raster[y].length; x++)
            {
                let landuseValue = raster[y][x][0]; 
                if (landuseValue != invalidValue)
                {
                    let cellY = (y - yCorrection) * scale;
                    let cellX = (x - xCorrection) * scale;

                    let queenMoran = [];
                    for (let mX =-1; mX < 2; mX++)
                    {
                        for (let mY = -1; mY < 2; mY++)
                        {
                            if ((x+mX >= 0) && (y+mY >= 0) && (y+mY < raster.length) && (x+mX < raster[y].length))
                            {
                                queenMoran.push(raster[y+mY][x+mX][1]);
                            }
                            else 
                            {
                                queenMoran.push(invalidValue);
                            }
                        }
                    }

                    let topLeftZSum = 0; //queenMoran[0] + queenMoran[1] + queenMoran[3] + queenMoran[4];
                    let topLeftCount = 0;
                    let topLeftQueenNumbers = [0,1,3,4];
                    for(let tlqn = 0; tlqn < topLeftQueenNumbers.length; tlqn++)
                    {
                        if (queenMoran[topLeftQueenNumbers[tlqn]] != invalidValue)
                        {
                            topLeftZSum += queenMoran[topLeftQueenNumbers[tlqn]];
                            topLeftCount++;
                        }
                    }
                    let topLeftZ = (topLeftZSum / topLeftCount) - zCorrection;

                    let topRightZSum = 0; 
                    let topRightCount = 0;
                    let topRightQueenNumbers = [1,2,4,5];
                    for(let trqn = 0; trqn < topRightQueenNumbers.length; trqn++)
                    {
                        if (queenMoran[topRightQueenNumbers[trqn]] != invalidValue)
                        {
                            topRightZSum += queenMoran[topRightQueenNumbers[trqn]];
                            topRightCount++;
                        }
                    }
                    let topRightZ = (topRightZSum / topRightCount) - zCorrection;


                    let bottomLeftZSum = 0; 
                    let bottomLeftCount = 0;
                    let bottomLeftQueenNumbers = [3,4,6,7];
                    for(let blqn = 0; blqn < bottomLeftQueenNumbers.length; blqn++)
                    {
                        if (queenMoran[bottomLeftQueenNumbers[blqn]] != invalidValue)
                        {
                            bottomLeftZSum += queenMoran[bottomLeftQueenNumbers[blqn]];
                            bottomLeftCount++;
                        }
                    }
                    let bottomLeftZ = (bottomLeftZSum / bottomLeftCount) - zCorrection;

                    let bottomRightZSum = 0;
                    let bottomRightCount = 0;
                    let bottomRightQueenNumbers = [4,5,7,8];
                    for(let brqn = 0; brqn < bottomRightQueenNumbers.length; brqn++)
                    {
                        if (queenMoran[bottomRightQueenNumbers[brqn]] != invalidValue)
                        {
                            bottomRightZSum += queenMoran[bottomRightQueenNumbers[brqn]];
                            bottomRightCount++;
                        }
                    }
                    let bottomRightZ = (bottomRightZSum / bottomRightCount) - zCorrection;


                    var verticeDat = [];
                    var uvDat = [];
                    var uvPoints = [[0,0], [1,0], [1,1], [0,1]];
             
                    verticeDat.push(cellY*scale); //yzx
                    verticeDat.push(topLeftZ*scale);
                   // verticeDat.push(1*scale);
                    verticeDat.push(cellX*scale);
                    uvDat.push(uvPoints[0][0]);
                    uvDat.push(uvPoints[0][1]);

                    verticeDat.push(cellY*scale); //yzx
                    verticeDat.push(bottomLeftZ*scale);
                    verticeDat.push(cellX+1*scale);
                    uvDat.push(uvPoints[1][0]);
                    uvDat.push(uvPoints[1][1]);

                    verticeDat.push(cellY+1*scale); //yzx
                    verticeDat.push(bottomRightZ*scale);
                    verticeDat.push(cellX+1*scale);
                    uvDat.push(uvPoints[2][0]);
                    uvDat.push(uvPoints[2][1]);


                    verticeDat.push(cellY*scale); //yzx
                    verticeDat.push(topLeftZ*scale);
                    verticeDat.push(cellX*scale);
                    uvDat.push(uvPoints[0][0]);
                    uvDat.push(uvPoints[0][1]);

                    verticeDat.push(cellY+1*scale); //yzx
                    verticeDat.push(bottomRightZ*scale);
                    verticeDat.push(cellX+1*scale);
                    uvDat.push(uvPoints[2][0]);
                    uvDat.push(uvPoints[2][1]);

                    verticeDat.push(cellY+1*scale); //yzx
                    verticeDat.push(topRightZ*scale);
                    verticeDat.push(cellX*scale);
                    uvDat.push(uvPoints[3][0]);
                    uvDat.push(uvPoints[3][1]);


                    var vertices = new Float32Array(verticeDat);
                    var uvs = new Float32Array(uvDat);
                    var polyGeometry = new THREE.BufferGeometry();

                    polyGeometry.setAttribute( 'position', new THREE.BufferAttribute( vertices, 3 ) );
                    polyGeometry.setAttribute( 'uv', new THREE.BufferAttribute( uvs, 2 ) );

                    var mat = getMaterialFromValue(landuseValue);
                    var mesh = new THREE.Mesh( polyGeometry, mat );
                    scene.add(mesh);


                    console.log("rendering");
                    if (theCube != null)
                    {
                        theCube.position.setX(cellX);
                        theCube.position.setY(cellY);
                        theCube.position.setZ(bottomLeftZ+2);
                        console.log(cellX + ", " + cellY + ", " + bottomLeftZ+2);
                        scene.add(theCube)

                    }
                }
            }
        }
        if (borders)
        {
            xCorrection += 1;
            verticeDat = [];
            uvDat = [];
            for (let y = 0; y < raster.length; y++)
            {
                let topLeftZ = raster[y][raster[y].length-1][1];
                let topRightZ = raster[y][raster[y].length-1][1];
                if (y > 0)
                {
                    topLeftZ = (topLeftZ + raster[y-1][raster[y-1].length-1][1])/2;
                }
                if (y < raster.length-1)
                {
                    topRightZ = (topRightZ + raster[y+1][raster[y+1].length-1][1])/2;
                }

                topLeftZ -= zCorrection; 
                topRightZ -= zCorrection;
               // let topLefZ = (raster[y][0][1] + raster[y+1][0][1])/2

                //up
                verticeDat.push((y-yCorrection)*scale); //yzx
                verticeDat.push(0);
                verticeDat.push(xCorrection*scale);
                uvDat.push(uvPoints[0][0]);
                uvDat.push(uvPoints[0][1]);

                verticeDat.push((y-yCorrection)*scale); //yzx
                verticeDat.push(topLeftZ);
                verticeDat.push(xCorrection*scale);
                uvDat.push(uvPoints[0][0]);
                uvDat.push(uvPoints[0][1]);

                verticeDat.push((y+1-yCorrection)*scale); //yzx
                verticeDat.push(0);
                verticeDat.push(xCorrection*scale);
                uvDat.push(uvPoints[0][0]);
                uvDat.push(uvPoints[0][1]);

                //inverse up
                verticeDat.push((y-yCorrection)*scale); //yzx
                verticeDat.push(0);
                verticeDat.push(xCorrection*scale);
                uvDat.push(uvPoints[0][0]);
                uvDat.push(uvPoints[0][1]);

                verticeDat.push((y+1-yCorrection)*scale); //yzx
                verticeDat.push(0);
                verticeDat.push(xCorrection*scale);
                uvDat.push(uvPoints[0][0]);
                uvDat.push(uvPoints[0][1]);

                verticeDat.push((y-yCorrection)*scale); //yzx
                verticeDat.push(topLeftZ);
                verticeDat.push(xCorrection*scale);
                uvDat.push(uvPoints[0][0]);
                uvDat.push(uvPoints[0][1]);

                //down
                verticeDat.push((y-yCorrection)*scale); //yzx
                verticeDat.push(topLeftZ);
                verticeDat.push(xCorrection*scale);
                uvDat.push(uvPoints[0][0]);
                uvDat.push(uvPoints[0][1]);

                verticeDat.push((y+1-yCorrection)*scale); //yzx
                verticeDat.push(topRightZ);
                verticeDat.push(xCorrection*scale);
                uvDat.push(uvPoints[0][0]);
                uvDat.push(uvPoints[0][1]);

                verticeDat.push((y+1-yCorrection)*scale); //yzx
                verticeDat.push(0);
                verticeDat.push(xCorrection*scale);
                uvDat.push(uvPoints[0][0]);
                uvDat.push(uvPoints[0][1]);


                //inverse down
                verticeDat.push((y-yCorrection)*scale); //yzx
                verticeDat.push(topLeftZ);
                verticeDat.push(xCorrection*scale);
                uvDat.push(uvPoints[0][0]);
                uvDat.push(uvPoints[0][1]);

                verticeDat.push((y+1-yCorrection)*scale); //yzx
                verticeDat.push(0);
                verticeDat.push(xCorrection*scale);
                uvDat.push(uvPoints[0][0]);
                uvDat.push(uvPoints[0][1]);

                verticeDat.push((y+1-yCorrection)*scale); //yzx
                verticeDat.push(topRightZ);
                verticeDat.push(xCorrection*scale);
                uvDat.push(uvPoints[0][0]);
                uvDat.push(uvPoints[0][1]);
                

                //other side 
                topLeftZ = raster[y][0][1];
                topRightZ = raster[y][0][1];
                if (y > 0)
                {
                    topLeftZ = (topLeftZ + raster[y-1][0][1])/2;
                }
                if (y < raster.length-1)
                {
                    topRightZ = (topRightZ + raster[y+1][0][1])/2;
                }

                topLeftZ -= zCorrection; 
                topRightZ -= zCorrection;

                //up
                verticeDat.push((y-yCorrection)*scale); //yzx
                verticeDat.push(0);
                verticeDat.push(-xCorrection+1*scale);
                uvDat.push(uvPoints[0][0]);
                uvDat.push(uvPoints[0][1]);

                verticeDat.push((y-yCorrection)*scale); //yzx
                verticeDat.push(topLeftZ);
                verticeDat.push(-xCorrection+1*scale);
                uvDat.push(uvPoints[0][0]);
                uvDat.push(uvPoints[0][1]);

                verticeDat.push((y+1-yCorrection)*scale); //yzx
                verticeDat.push(0);
                verticeDat.push(-xCorrection+1*scale);
                uvDat.push(uvPoints[0][0]);
                uvDat.push(uvPoints[0][1]);

                //down
                verticeDat.push((y-yCorrection)*scale); //yzx
                verticeDat.push(topLeftZ);
                verticeDat.push(-xCorrection+1*scale);
                uvDat.push(uvPoints[0][0]);
                uvDat.push(uvPoints[0][1]);

                verticeDat.push((y+1-yCorrection)*scale); //yzx
                verticeDat.push(topRightZ);
                verticeDat.push(-xCorrection+1*scale);
                uvDat.push(uvPoints[0][0]);
                uvDat.push(uvPoints[0][1]);

                verticeDat.push((y+1-yCorrection)*scale); //yzx
                verticeDat.push(0);
                verticeDat.push(-xCorrection+1*scale);
                uvDat.push(uvPoints[0][0]);
                uvDat.push(uvPoints[0][1]);

                var boxVertices = new Float32Array(verticeDat);
                var boxUvs = new Float32Array(uvDat);
                var boxPolyGeometry = new THREE.BufferGeometry();

                boxPolyGeometry.setAttribute( 'position', new THREE.BufferAttribute( boxVertices, 3 ) );
                boxPolyGeometry.setAttribute( 'uv', new THREE.BufferAttribute( boxUvs, 2 ) );
                var boxMesh = new THREE.Mesh( boxPolyGeometry, polyMaterialGrassland );
                scene.add(boxMesh);
            }
         //   for (let x = 0; x < raster[y].length; x++)
          //  {
           //     
            //}
        }
        for (let x = 0; x < raster[0].length; x++)
        {
            let topLeftZ = raster[0][x][1];
            let topRightZ = raster[0][x][1];
            if (x > 0)
            {
                topLeftZ = (topLeftZ + raster[0][x-1][1])/2;
            }
            if (x < raster.length-1)
            {
                topRightZ = (topRightZ + raster[0][x+1][1])/2;
            }

            topLeftZ -= zCorrection; 
            topRightZ -= zCorrection;
           // let topLefZ = (raster[y][0][1] + raster[y+1][0][1])/2

            //up        //bottom left
            verticeDat.push((-yCorrection)*scale); //yzx
            verticeDat.push(0);
            verticeDat.push((x+1-xCorrection)*scale);
            uvDat.push(uvPoints[0][0]);
            uvDat.push(uvPoints[0][1]);

                        //bottom right
            verticeDat.push((-yCorrection)*scale); //yzx
            verticeDat.push(0);
            verticeDat.push((x +2 - xCorrection)*scale);
            uvDat.push(uvPoints[0][0]);
            uvDat.push(uvPoints[0][1]);

                        //top left
            verticeDat.push((-yCorrection)*scale); //yzx
            verticeDat.push(topLeftZ);
            verticeDat.push((x+1-xCorrection)*scale);
            uvDat.push(uvPoints[0][0]);
            uvDat.push(uvPoints[0][1]);

            //down
            verticeDat.push((-yCorrection)*scale); //yzx
            verticeDat.push(topLeftZ);
            verticeDat.push((x+1-xCorrection)*scale);
            uvDat.push(uvPoints[0][0]);
            uvDat.push(uvPoints[0][1]);

            verticeDat.push((-yCorrection)*scale); //yzx
            verticeDat.push(0);
            verticeDat.push((x +2 - xCorrection)*scale);
            uvDat.push(uvPoints[0][0]);
            uvDat.push(uvPoints[0][1]);

            verticeDat.push((-yCorrection)*scale); //yzx
            verticeDat.push(topRightZ);
            verticeDat.push((x +2 - xCorrection)*scale);
            uvDat.push(uvPoints[0][0]);
            uvDat.push(uvPoints[0][1]);
            

            //other side 
            topLeftZ = raster[raster.length-1][x][1];
            topRightZ = raster[raster.length-1][x][1];
            if (x > 0)
            {
                topLeftZ = (topLeftZ + raster[raster.length-1][x-1][1])/2;
            }
            if (x < raster.length-1)
            {
                topRightZ = (topRightZ + raster[raster.length-1][x+1][1])/2;
            }
            topLeftZ -= zCorrection; 
            topRightZ -= zCorrection;

            //up        //bottom left
            verticeDat.push((yCorrection+1)*scale); //yzx
            verticeDat.push(0);
            verticeDat.push((x+1-xCorrection)*scale);
            uvDat.push(uvPoints[0][0]);
            uvDat.push(uvPoints[0][1]);

           
                        //top left
            verticeDat.push((yCorrection+1)*scale); //yzx
            verticeDat.push(topLeftZ);
            verticeDat.push((x+1-xCorrection)*scale);
            uvDat.push(uvPoints[0][0]);
            uvDat.push(uvPoints[0][1]);

                         //bottom right
            verticeDat.push((yCorrection+1)*scale); //yzx
            verticeDat.push(0);
            verticeDat.push((x +2 - xCorrection)*scale);
            uvDat.push(uvPoints[0][0]);
            uvDat.push(uvPoints[0][1]);

            //down
            verticeDat.push((yCorrection+1)*scale); //yzx
            verticeDat.push(topLeftZ);
            verticeDat.push((x+1-xCorrection)*scale);
            uvDat.push(uvPoints[0][0]);
            uvDat.push(uvPoints[0][1]);

            verticeDat.push((yCorrection+1)*scale); //yzx
            verticeDat.push(topRightZ);
            verticeDat.push((x +2 - xCorrection)*scale);
            uvDat.push(uvPoints[0][0]);
            uvDat.push(uvPoints[0][1]);
            
            verticeDat.push((yCorrection+1)*scale); //yzx
            verticeDat.push(0);
            verticeDat.push((x +2 - xCorrection)*scale);
            uvDat.push(uvPoints[0][0]);
            uvDat.push(uvPoints[0][1]);

            var boxVertices = new Float32Array(verticeDat);
            var boxUvs = new Float32Array(uvDat);
            var boxPolyGeometry = new THREE.BufferGeometry();

            boxPolyGeometry.setAttribute( 'position', new THREE.BufferAttribute( boxVertices, 3 ) );
            boxPolyGeometry.setAttribute( 'uv', new THREE.BufferAttribute( boxUvs, 2 ) );
            var boxMesh = new THREE.Mesh( boxPolyGeometry, polyMaterialGrassland );
            scene.add(boxMesh);
        }

        //finally add the bottom plate 
        //down
        verticeDat.push((yCorrection+1)*scale); //yzx
        verticeDat.push(0);
        verticeDat.push((xCorrection)*scale);
        uvDat.push(uvPoints[0][0]);
        uvDat.push(uvPoints[0][1]);

        verticeDat.push((-yCorrection)*scale); //yzx
        verticeDat.push(0);
        verticeDat.push((- xCorrection+1)*scale);
        uvDat.push(uvPoints[0][0]);
        uvDat.push(uvPoints[0][1]);

        verticeDat.push((yCorrection+1)*scale); //yzx
        verticeDat.push(0);
        verticeDat.push((-xCorrection+1)*scale);
        uvDat.push(uvPoints[0][0]);
        uvDat.push(uvPoints[0][1]);
        
        verticeDat.push((yCorrection+1)*scale); //yzx
        verticeDat.push(0);
        verticeDat.push((xCorrection)*scale);
        uvDat.push(uvPoints[0][0]);
        uvDat.push(uvPoints[0][1]);

        verticeDat.push((-yCorrection)*scale); //yzx
        verticeDat.push(0);
        verticeDat.push((xCorrection)*scale);
        uvDat.push(uvPoints[0][0]);
        uvDat.push(uvPoints[0][1]);

        verticeDat.push((-yCorrection)*scale); //yzx
        verticeDat.push(0);
        verticeDat.push((- xCorrection+1)*scale);
        uvDat.push(uvPoints[0][0]);
        uvDat.push(uvPoints[0][1]);

        var boxVertices = new Float32Array(verticeDat);
        var boxUvs = new Float32Array(uvDat);
        var boxPolyGeometry = new THREE.BufferGeometry();

        boxPolyGeometry.setAttribute( 'position', new THREE.BufferAttribute( boxVertices, 3 ) );
        boxPolyGeometry.setAttribute( 'uv', new THREE.BufferAttribute( boxUvs, 2 ) );
        var boxMesh = new THREE.Mesh( boxPolyGeometry, polyMaterialGrassland );
        scene.add(boxMesh);


    }

    function renderOutlineBox(minX, minY, maxX, maxY, baseZ, plainZ)
    {
        var boxVerticeDat = [];
        var boxUvDat =[];
        var uvPoints = [[0,0], [1,0], [1,1], [0,1]];
        boxVerticeDat.push(minY*scale); //yzx
        boxVerticeDat.push(baseZ*scale);
        boxVerticeDat.push(minX*scale);
        boxUvDat.push(uvPoints[0][0]);
        boxUvDat.push(uvPoints[0][1]);

        boxVerticeDat.push(minY*scale); //yzx
        boxVerticeDat.push(baseZ*scale);
        boxVerticeDat.push(maxX*scale);
        boxUvDat.push(uvPoints[0][0]);
        boxUvDat.push(uvPoints[0][1]);

        boxVerticeDat.push(minY*scale); //yzx
        boxVerticeDat.push(plainZ*scale);
        boxVerticeDat.push(minX*scale);
        boxUvDat.push(uvPoints[0][0]);
        boxUvDat.push(uvPoints[0][1]);

        boxVerticeDat.push(minY*scale); //yzx
        boxVerticeDat.push(plainZ*scale);
        boxVerticeDat.push(minX*scale);
        boxUvDat.push(uvPoints[0][0]);
        boxUvDat.push(uvPoints[0][1]);

        boxVerticeDat.push(minY*scale); //yzx
        boxVerticeDat.push(baseZ*scale);
        boxVerticeDat.push(maxX*scale);
        boxUvDat.push(uvPoints[0][0]);
        boxUvDat.push(uvPoints[0][1]);

        boxVerticeDat.push(minY*scale); //yzx
        boxVerticeDat.push(plainZ*scale);
        boxVerticeDat.push(maxX*scale);
        boxUvDat.push(uvPoints[0][0]);
        boxUvDat.push(uvPoints[0][1]);



        boxVerticeDat.push(minY*scale); //yzx
        boxVerticeDat.push(plainZ*scale);
        boxVerticeDat.push(maxX*scale);
        boxUvDat.push(uvPoints[0][0]);
        boxUvDat.push(uvPoints[0][1]);

        boxVerticeDat.push(maxY*scale); //yzx
        boxVerticeDat.push(baseZ*scale);
        boxVerticeDat.push(maxX*scale);
        boxUvDat.push(uvPoints[0][0]);
        boxUvDat.push(uvPoints[0][1]);
        
        boxVerticeDat.push(maxY*scale); //yzx
        boxVerticeDat.push(plainZ*scale);
        boxVerticeDat.push(maxX*scale);
        boxUvDat.push(uvPoints[0][0]);
        boxUvDat.push(uvPoints[0][1]);


        boxVerticeDat.push(minY*scale); //yzx
        boxVerticeDat.push(baseZ*scale);
        boxVerticeDat.push(maxX*scale);
        boxUvDat.push(uvPoints[0][0]);
        boxUvDat.push(uvPoints[0][1]);

        boxVerticeDat.push(maxY*scale); //yzx
        boxVerticeDat.push(baseZ*scale);
        boxVerticeDat.push(maxX*scale);
        boxUvDat.push(uvPoints[0][0]);
        boxUvDat.push(uvPoints[0][1]);

        boxVerticeDat.push(minY*scale); //yzx
        boxVerticeDat.push(plainZ*scale);
        boxVerticeDat.push(maxX*scale);
        boxUvDat.push(uvPoints[0][0]);
        boxUvDat.push(uvPoints[0][1]);


        boxVerticeDat.push(minY*scale); //yzx
        boxVerticeDat.push(baseZ*scale);
        boxVerticeDat.push(minX*scale);
        boxUvDat.push(uvPoints[0][0]);
        boxUvDat.push(uvPoints[0][1]);

        boxVerticeDat.push(minY*scale); //yzx
        boxVerticeDat.push(plainZ*scale);
        boxVerticeDat.push(minX*scale);
        boxUvDat.push(uvPoints[0][0]);
        boxUvDat.push(uvPoints[0][1]);

        boxVerticeDat.push(maxY*scale); //yzx
        boxVerticeDat.push(baseZ*scale);
        boxVerticeDat.push(minX*scale);
        boxUvDat.push(uvPoints[0][0]);
        boxUvDat.push(uvPoints[0][1]);

        boxVerticeDat.push(maxY*scale); //yzx
        boxVerticeDat.push(plainZ*scale);
        boxVerticeDat.push(minX*scale);
        boxUvDat.push(uvPoints[0][0]);
        boxUvDat.push(uvPoints[0][1]);

        boxVerticeDat.push(maxY*scale); //yzx
        boxVerticeDat.push(baseZ*scale);
        boxVerticeDat.push(minX*scale);
        boxUvDat.push(uvPoints[0][0]);
        boxUvDat.push(uvPoints[0][1]);
        
        boxVerticeDat.push(minY*scale); //yzx
        boxVerticeDat.push(plainZ*scale);
        boxVerticeDat.push(minX*scale);
        boxUvDat.push(uvPoints[0][0]);
        boxUvDat.push(uvPoints[0][1]);

        boxVerticeDat.push(maxY*scale); //yzx
        boxVerticeDat.push(baseZ*scale);
        boxVerticeDat.push(minX*scale);
        boxUvDat.push(uvPoints[0][0]);
        boxUvDat.push(uvPoints[0][1]);

        boxVerticeDat.push(maxY*scale); //yzx
        boxVerticeDat.push(plainZ*scale);
        boxVerticeDat.push(minX*scale);
        boxUvDat.push(uvPoints[0][0]);
        boxUvDat.push(uvPoints[0][1]);

        boxVerticeDat.push(maxY*scale); //yzx  
        boxVerticeDat.push(baseZ*scale);
        boxVerticeDat.push(maxX*scale);
        boxUvDat.push(uvPoints[0][0]);
        boxUvDat.push(uvPoints[0][1]);

        boxVerticeDat.push(maxY*scale); //yzx
        boxVerticeDat.push(baseZ*scale);
        boxVerticeDat.push(maxX*scale);
        boxUvDat.push(uvPoints[0][0]);
        boxUvDat.push(uvPoints[0][1]);    

        boxVerticeDat.push(maxY*scale); //yzx
        boxVerticeDat.push(plainZ*scale);
        boxVerticeDat.push(minX*scale);
        boxUvDat.push(uvPoints[0][0]);
        boxUvDat.push(uvPoints[0][1]);

        boxVerticeDat.push(maxY*scale); //yzx
        boxVerticeDat.push(plainZ*scale);
        boxVerticeDat.push(maxX*scale);
        boxUvDat.push(uvPoints[0][0]);
        boxUvDat.push(uvPoints[0][1]);


/*

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
*/
            var boxVertices = new Float32Array(boxVerticeDat);
            var boxUvs = new Float32Array(boxUvDat);
            var boxPolyGeometry = new THREE.BufferGeometry();

            boxPolyGeometry.setAttribute( 'position', new THREE.BufferAttribute( boxVertices, 3 ) );
            boxPolyGeometry.setAttribute( 'uv', new THREE.BufferAttribute( boxUvs, 2 ) );
            var boxMesh = new THREE.Mesh( boxPolyGeometry, polyMaterialWood );
            scene.add(boxMesh);

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
    
    function renderLandscapeAjax()
    {
        let lat = 51.98258822621598;
        let lon = 5.682704182774078;

        $.ajax({
            type:'GET',
            url: '/game/getLandscapeAjax',
            data: 
            {
                'lat':lat,
                'lon':lon
            },
            success:function(data)
            {
                renderLandscapeFromGrid(data);
            }
        });

    }

    function renderLandscapeFromGrid(data)
    {
        let minX = 999999999;
        let minY = 999999999;
        let minZ = 999999999;
        let maxX = -99999999;
        let maxY = -99999999;
        let maxZ = -99999999;
        for(let i = 0; i < data.length; i++)
        {
            if (data[i].x < minX) {minX = data[i].x;}
            if (data[i].y < minY) {minY = data[i].y;}
            if (data[i].x > maxX) {maxX = data[i].x;}
            if (data[i].y > maxY) {maxY = data[i].y;}
            if (data[i].elev > maxZ) {maxZ = data[i].elev;}
            if (data[i].elev < minZ) {minZ = data[i].elev;}
        }

        let diffX = maxX - minX;
        let diffY = maxY - minY;
        let diffZ = maxY - minY;
        let halfDiffX = diffX / 2;
        let halfDiffY = diffY / 2;
        let halfDiffZ = diffZ / 2;

        let ras = [];
        for (let y = 0; y < maxY; y++)
        {
            let xLine = [];
            for (let x = 0; x < maxX; x++)
            {
                xLine.push([invalidValue, invalidValue]);
            }
            ras.push(xLine);
        }

        for(let i = 0; i < data.length; i++)
        {
            ras[data[i].y-1][data[i].x-1] = [parseInt(data[i].landuse), parseFloat(data[i].elev)];
            //renderCell(data[i].x - halfDiffX, data[i].y - halfDiffY, data[i].elev, data[i].landuse);
        }

       /* let testRas =[];
        let testY1 = [[73,2], [82,3], [73,5], [73,6]];
        let testY2 = [[82,3], [73,4], [82,5], [83,6]];
        let testY3 = [[73,4], [83,4], [83,5], [82,7]];
        let testY4 = [[82,8], [83,8], [82,8], [73,8]];
        testRas.push(testY1);
        testRas.push(testY2);
        testRas.push(testY3);
        testRas.push(testY4);
        halfDiffY = 0;
        minZ = 0;
        halfDiffX = 0;
        ras = testRas;*/

        renderRaster(ras, halfDiffY, minZ, halfDiffX, true);
     //   renderRaster(ras, halfDiffY, minZ, halfDiffX);
        //renderOutlineBox(minX - halfDiffX, minY - halfDiffY, maxX + 1 - halfDiffX, maxY + 1 -halfDiffY, 0, 1);
    }
    renderLandscapeAjax();

 <?php $landscape = [[1,2,1],[0,1,1],[3,2,1]]; ?>
var landscape = [[1,2,1],[0,1,1],[3,2,1]];
//renderMatrix(landscape);
    
  
</script>


<div class="container-fluid background-container d-flex">
    <div class="central-container" align="middle">
        <h1>Welcome to Showcase</h1>
        TEST PAGE 12
    </div>
</div>