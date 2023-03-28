
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
    import * as SkeletonUtils from 'https://threejs.org/examples/jsm/utils/SkeletonUtils.js';

    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera( 30, window.innerWidth / window.innerHeight, 0.05, 10000 );
    camera.position.set( 25, 30, -30 );
    camera.lookAt(new THREE.Vector3(0.0,5,0.0));

    scene.background = new THREE.Color( 0xf0f0f0 ); //gray background 
   // const gridHelper = new THREE.GridHelper( 8,8 ); //black lines to show plane
   // scene.add( gridHelper );

   // const light = new THREE.AmbientLight( 0x404040 ); // soft white light
  //  const ambientLight = new THREE.AmbientLight(0xFFFFFF);
 //   ambientLight.intensity = 4;
 //   scene.add( ambientLight );
   // scene.add( light );

    const color = 0xFFFFFF;
    const intensity = 4;
    const light = new THREE.DirectionalLight(color, intensity);
    light.position.set(10, 50, 10); //x=25, y=30, z=-30
    light.target.position.set(-5, 0, 0);
    scene.add(light);
    scene.add(light.target);



   /* const directionalLight = new THREE.DirectionalLight( 0xffffff, 0.5 );
    directionalLight.intensity = 4;
    scene.add( directionalLight ); */

    const renderer = new THREE.WebGLRenderer();
    renderer.setSize( window.innerWidth, window.innerHeight );
    document.body.appendChild( renderer.domElement );

    const controls = new OrbitControls( camera, renderer.domElement );
   // controls.minZoom = 0.5;
    controls.minDistance =20;
    controls.maxDistance =80; 
  //  controls.maxZoom = 1.5;
    controls.target = new THREE.Vector3(0.0,5,0.0)
    const manager = new THREE.LoadingManager();
    manager.onLoad = renderLandscapeAjax;
    const models = {
        cube:    { url: 'images/testCube2.glb' },
        grass:    { url: 'images/grass01.glb' },
        pine:    { url: 'images/pineTree02.glb' },
        tree:    { url: 'images/decidiousTree02.glb' },
     
    };

    const gltfLoader = new GLTFLoader(manager);
    for (const model of Object.values(models)) 
    {
        gltfLoader.load(model.url, (gltf) => 
        {
            model.gltf = gltf;
        });
    }
 //   renderer.outputEncoding = THREE.sRGBEncoding;



    //const happyTexture = new THREE.TextureLoader().load( "/images/textures/grassTexture.jpg" );
    //const happyMaterial = new THREE.MeshBasicMaterial( { map: happyTexture } );
    //happyMaterial.mapping = THREE.ClampToEdgeWrapping;
    const geometry = new THREE.BoxGeometry( 1, 1, 1 );
    const material = new THREE.MeshBasicMaterial( { color: 0x00ff00 } );
    //const cube = new THREE.Mesh( geometry, material );
   // scene.add( cube );

    function animate() 
    {
      //  console.log(camera.position);
        requestAnimationFrame( animate );
        renderer.render( scene, camera );
       // cube.rotation.x += 0.01;
       // cube.rotation.y += 0.01;
       // console.log(camera.position);
    }
    animate();

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
    }

    var scale = 1;
    var invalidValue = -99999;
    function renderRaster(raster, yCorrection, zCorrection, xCorrection, borders=true) //expects a two dim raster of double arrays (x y -> [landuse, elev])
    {
        let done = 0;
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
                    

                   // if (done<5)
                  //  {
                        scene.add(mesh);
                   // }

                    if ((models.cube != null) && (done<55555))
                    {
                        if (landuseValue == 83)
                        {
                         //   Object.values(models).forEach((model, ndx) => {
                            //    console.log(model);
                            if (models.cube.gltf !== 'undefined')
                            {
                                let objNr = Math.random() * 2; //this is the number of objects rendered (max)
                                for (let i = 0; i < objNr; i++)
                                {
                                    const clonedScene = SkeletonUtils.clone(models.pine.gltf.scene);
                                    clonedScene.scale.set(0.1 + (Math.random()/10), 0.1+ (Math.random()/10), 0.1+ (Math.random()/10));

                                    const root = new THREE.Object3D();
                                    root.add(clonedScene);
                                    scene.add(root);
                                    root.position.setX(cellY+Math.random());
                                
                                    let newZ = (bottomLeftZ + bottomRightZ + topLeftZ + topRightZ)/4;

        //console.log("x: " + cellX + ", y: " + cellY + ", z: " + newZ);

                                    root.position.setY(newZ);
                                    root.position.setZ(cellX+Math.random());
                                }
                                done++;
                            }
                        }
                        if (landuseValue == 82)
                        {

                            let objNr = Math.random() * 2; //this is the number of objects rendered (max)
                            for (let i = 0; i < objNr; i++)
                            {
                                const clonedScene = SkeletonUtils.clone(models.tree.gltf.scene);
                                clonedScene.scale.set(0.1 + (Math.random()/10), 0.1+ (Math.random()/10), 0.1+ (Math.random()/10));
                                const root = new THREE.Object3D();
                                root.add(clonedScene);
                                scene.add(root);
                                let newZ = (bottomLeftZ + bottomRightZ + topLeftZ + topRightZ)/4;
                                root.position.setX(cellY+Math.random());
                                root.position.setY(newZ);
                                root.position.setZ(cellX+Math.random());
                            }
                        }
                        else if (landuseValue == 102)
                        {
                            let objNr = Math.random() * 5; //this is the number of objects rendered (max)
                            for (let i = 0; i < objNr; i++)
                            {
                                const clonedScene = SkeletonUtils.clone(models.grass.gltf.scene);
                                clonedScene.scale.set(0.001 + (Math.random()/20), 0.001+ (Math.random()/20), 0.001+ (Math.random()/20));

                                const root = new THREE.Object3D();
                                root.add(clonedScene);
                             //   let ambientLight = new THREE.AmbientLight( 0x6AA84F, 0.4 ); //00FFFF 6AA84F
                              //  root.add( ambientLight );
                                scene.add(root);
                                root.position.setX(cellY+Math.random());
                                
                                
                              //  let dirLight = new THREE.DirectionalLight( 0x00FF00, 1.5 );
                               // dirLight.position.set( 10, 10, 10 );
                               // scene.add( dirLight );


                                let newZ = (bottomLeftZ + bottomRightZ + topLeftZ + topRightZ)/4;
                                root.position.setY(newZ);
                                root.position.setZ(cellX+Math.random());
                            }
                        }

                        //console.log(models.cube.gltf);
                           
                            


                          //  const clonedScene = SkeletonUtils.clone(model.gltf.scene);
                            
                           // root.add(model);
                          //  scene.add(root);
                          //  root.position.x = (ndx - 3) * 3;
                      //  });



                      //  models.cube.scene.position.setX(cellX);
                       // models.cube.scene.position.setY(cellY);
                        //models.cube.scene.position.setZ(bottomLeftZ+2);
                       // console.log(cellX + ", " + cellY + ", " + bottomLeftZ+2);
                        

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
            let relativeZ = ((data[i].elev-minZ/diffZ)*0.2)+halfDiffZ+3;
            ras[data[i].y-1][data[i].x-1] = [parseInt(data[i].landuse), parseFloat(relativeZ)];//data[i].elev/10)];
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
  
</script>


<div class="container-fluid background-container d-flex">
    <div class="central-container" align="middle">
        <h1>Welcome to Showcase</h1>
        TEST PAGE 12
    </div>
</div>