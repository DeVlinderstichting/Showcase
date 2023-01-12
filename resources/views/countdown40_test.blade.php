


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">



<script>

var dateList = []; //open date, title, surprise title, pre date image, post date image, surprise link
dateList[1]= [new Date('2023-01-01'), "Week 1","Free birdnest giveaway", "images/giftPackage_gray.jpg", "images/giftPackage.jpg", "https://whatever.nl"];
https://watchButterflies.com"];
dateList[2]= [new Date('2023-01-02'),"Week 2","Free birdnest giveaway", "images/giftPackage_gray.jpg","images/giftPackage.jpg", "https://whatever.nl"];
dateList[3]= [new Date('2023-01-02'),"Week 2,5","Free birdnest giveaway", "images/giftPackage_gray.jpg","images/giftPackage.jpg", "https://whatever.nl"];
dateList[4]= [new Date('2023-01-03'),"Week 3","Free birdnest giveaway", "images/giftPackage_gray.jpg","images/giftPackage.jpg", "https://whatever.nl"];
dateList[5]= [new Date('2023-01-04'),"Week 4","Free birdnest giveaway", "images/giftPackage_gray.jpg","images/giftPackage.jpg", "https://whatever.nl"];
dateList[6]= [new Date('2023-01-05'),"Week 5","Free birdnest giveaway", "images/giftPackage_gray.jpg","images/giftPackage.jpg", "https://whatever.nl"];
dateList[7]= [new Date('2023-01-06'),"Week 6","Free birdnest giveaway", "images/giftPackage_gray.jpg","images/giftPackage.jpg", "https://whatever.nl"];
dateList[8]= [new Date('2023-01-07'),"Week 7","Free birdnest giveaway", "images/giftPackage_gray.jpg","images/giftPackage.jpg", "https://whatever.nl"];
dateList[9]= [new Date('2023-01-08'),"Week 8","Free birdnest giveaway", "images/giftPackage_gray.jpg","images/giftPackage.jpg", "https://whatever.nl"];
dateList[10]= [new Date('2023-01-09'),"Week 9","Free birdnest giveaway", "images/giftPackage_gray.jpg","images/giftPackage.jpg", "https://whatever.nl"];
dateList[11] = [new Date('2023-01-10'), "Week 9,5", "Butterfly watching event", "images/giftPackage_gray.jpg","images/bij.jpg", "images/bij.jpg", "https://whatever.nl"];
dateList[12]= [new Date('2023-01-11'),"Week 10","Free birdnest giveaway","images/giftPackage_gray.jpg","images/giftPackage.jpg", "https://whatever.nl"];
dateList[13]= [new Date('2023-01-21'),"Week 11","Free birdnest giveaway","images/giftPackage_gray.jpg","images/giftPackage.jpg","https://whatever.nl"];
dateList[14]= [new Date('2023-01-12'),"Week 12","Free birdnest giveaway","images/giftPackage_gray.jpg","images/giftPackage.jpg","https://whatever.nl"];
dateList[15]= [new Date('2023-01-15'),"Week 13","Free birdnest giveaway","images/giftPackage_gray.jpg","images/giftPackage.jpg","https://whatever.nl"];
dateList[16]= [new Date('2023-01-16'),"Week 14","Free birdnest giveaway","images/giftPackage_gray.jpg","images/giftPackage.jpg","https://whatever.nl"];
dateList[17]= [new Date('2023-01-17'),"Week 15","Free birdnest giveaway","images/giftPackage_gray.jpg","images/giftPackage.jpg","https://whatever.nl"];
dateList[18]= [new Date('2023-01-18'),"Week 16","Free birdnest giveaway","images/giftPackage_gray.jpg","images/giftPackage.jpg","https://whatever.nl"];
dateList[19]= [new Date('2023-01-19'),"Week 17","Free birdnest giveaway","images/giftPackage_gray.jpg","images/giftPackage.jpg","https://whatever.nl"];
dateList[20]= [new Date('2023-01-20'),"Week 18","Free birdnest giveaway","images/giftPackage_gray.jpg","images/giftPackage.jpg","https://whatever.nl"];
dateList[21]= [new Date('2023-01-21'),"Week 19","Free birdnest giveaway 19","images/giftPackage_gray.jpg","images/giftPackage.jpg","https://whatever.nl"];

</script>

<div class="panel panel-default">
    <table id="itemTable" class="table">
    </table>
</div>

<canvas id="firework"></canvas>

<script>
    var itemsPerLine = 5;
    var elem = document.getElementById('itemTable');
    var innerHtml = "";
    var tdCounter = 0;
    var addNewRow = false;
    for(var key in dateList)
    {
        if (addNewRow)
        {
            addNewRow = false;
            innerHtml += "<tr>";
        }
        innerHtml += buildTableCell(key);
      //  innerHtml += "<td><img src='" + dateList[key][2] +"' style='height: 150px; width: 150px; display: block;'> </td>";
        tdCounter++;
        if (tdCounter >= itemsPerLine)
        {
            tdCounter = 0;
            innerHtml += "</tr>";
            addNewRow = true;
        }
    }
    elem.innerHTML = innerHtml;
   

window.addEventListener('load', function () 
{
   drawImagesInTable();
})
function buildTableCell(indexKey)
{
    var tableCell = "";
   // tableCell += "<div class='panel-heading'>Event</div><img src='" + dateList[indexKey][2] +"' style='height: 150px; width: 150px; display: block;'>";
  //  tableCell += "<td onclick='handleTdClick("+indexKey+")'><div class=''> <canvas id='canvas_"+indexKey+"' width='200' height='100' style='border:1px solid #000000;'></canvas> "+dateList[indexKey][1]+"</div><img src='" + dateList[indexKey][2] +"' style='height: 150px; width: 150px; display: block;'></td>";
    tableCell += "<td onclick='handleTdClick("+indexKey+")'><div class=''> <canvas id='canvas_"+indexKey+"' width='220' height='200' style='border:1px solid #000000;'></canvas></td>";
    return tableCell;
}
function drawImagesInTable()
{
    for(var key in dateList)
    {
        const img = new Image();
        if (dateList[key][0]>new Date())
        {
            img.src = dateList[key][3];
        }
        else
        {
            img.src = dateList[key][4];
        }
        
        img.key = key;
        img.onload = function()
        {
            var elem = document.getElementById('canvas_' + this.key);
            var ctx = elem.getContext("2d");
            ctx.drawImage(img, 20, 20, 180, 180);
            ctx.font = "20px Arial";
            ctx.fillText(dateList[this.key][1], 10, 20); 
        };
      //  console.log(imgSource);
       // img.src = imgSource;

        
        
        

      //  elem.ctx.canvas.hidden = true;

       // var sourceCtx = renderImage.getContext('2d');
    /*    var imgData = ctx.getImageData(0, 0, 100, 100);
        for (i = 0; i < imgData.data.length; i += 4) 
        {
            let count = imgData.data[i] + imgData.data[i + 1] + imgData.data[i + 2];
            var val = count/3;
            imgData.data[i] = val;
            imgData.data[i + 1] = val;
            imgData.data[i + 2] = val;
            imgData.data[i + 3] = 255;
            ctx.putImageData(imgData, 0, 0);
        } */

       // ctx.drawImage(renderImage, 0, 0, 100, 100);

      //  elem.ctx.canvas.hidden = false;

    }
}
function handleTdClick(indexKey)
{
    if (dateList[indexKey][0] <= new Date())
    {
        alert("A very nice modal indicating what you just discovered ("+dateList[indexKey][2]+") and if you want to open it now");
    }
};


</script>



<script>

    var theNow = new Date();
    var theTimeDiff = -1;
    var lowestKey = -1;
    for(var key in dateList)
    {
        var timeDiff = theNow-dateList[key][0];
        if ((timeDiff > 0) && (timeDiff < theTimeDiff || theTimeDiff < 0))
        {
            theTimeDiff = timeDiff;
            lowestKey = key;
        }
    }



    var canvas = document.getElementById('canvas_' + lowestKey);
    var context = canvas.getContext('2d');

    var width = 200;
    var height = 220;

    var positions = {
        mouseX: 0,
        mouseY: 0,
        startX: width/2,
        startY: height
    };

    var fireworks = [];
    var particles = [];
    var numberOfParticles = 100; // keep in mind performance degrades with higher number of particles

    var random = (min, max) => Math.random() * (max - min) + min;

    var getDistance = (x1, y1, x2, y2) => {
        var xDistance = x1 - x2;
        var yDistance = y1 - y2;

        return Math.sqrt(Math.pow(xDistance, 2) + Math.pow(yDistance, 2));
    };

    
    var renderImage = new Image();
    renderImage.src = dateList[lowestKey][4];

    const loop = () => {
        context.clearRect(0, 0, canvas.width, canvas.height);
        requestAnimationFrame(loop);


        context.drawImage(renderImage, 20, 20, 180, 180);
        context.font = "20px Arial";
        context.fillText(dateList[lowestKey][1], 10, 20); 


       // context.restore();

        if (fireworks.length < 1)
        {
            fireworks.push(new Firework());
        }

        
        let fireworkIndex = fireworks.length;
        while(fireworkIndex--) 
        {
            fireworks[fireworkIndex].draw(fireworkIndex);
        }

        let particleIndex = particles.length;
        while(particleIndex--) 
        {
            particles[particleIndex].draw(particleIndex);
        }
        
    };

    loop();
   // image.onload = () => {
   //     attachEventListeners();
   //     loop();
   // }
    
    function Firework() {
        const init = () => {
            let fireworkLength = 10;

            this.x = positions.startX;
            this.y = positions.startY;
            this.tx = random(0,width);
            this.ty = random(0,height/2);

            this.distanceToTarget = getDistance(positions.startX, positions.startY, this.tx, this.ty);
            this.distanceTraveled = 0;

            this.coordinates = [];
            this.angle = Math.atan2(this.ty - positions.startY, this.tx - positions.startX);
            this.speed = 20;
            this.friction = .99;
            this.hue = random(0, 360);

            while (fireworkLength--) {
                this.coordinates.push([this.x, this.y]);
            }
        };

        this.animate = index => {
            this.coordinates.pop();
            this.coordinates.unshift([this.x, this.y]);

            this.speed *= this.friction;

            let vx = Math.cos(this.angle) * this.speed;
            let vy = Math.sin(this.angle) * this.speed;

            this.distanceTraveled = getDistance(positions.startX, positions.startY, this.x + vx, this.y + vy);
            
            if(this.distanceTraveled >= this.distanceToTarget) {
                let i = numberOfParticles;
        
                while(i--) {
                    particles.push(new Particle(this.tx, this.ty));
                }

                fireworks.splice(index, 1);
            } else {
                this.x += vx;
                this.y += vy;
            }
        }

        this.draw = index => {
            context.beginPath();
            context.moveTo(this.coordinates[this.coordinates.length - 1][0],
                           this.coordinates[this.coordinates.length - 1][1]);
            context.lineTo(this.x, this.y);

            context.strokeStyle = `hsl(${this.hue}, 100%, 50%)`;
            context.stroke();

            this.animate(index);
        }

        init();
    }
    
    function Particle(x, y) 
    {
        const init = () => {
            let particleLength = 7;

            this.x = x;
            this.y = y;

            this.coordinates = [];

            this.angle = random(0, Math.PI * 2);
            this.speed = random(1, 10);

            this.friction = 0.95;
            this.gravity = 2;

            this.hue = random(0, 360);
            this.alpha = 1;
            this.decay = random(.015, .03);

            while(particleLength--) {
                this.coordinates.push([this.x, this.y]);
            }
        };

        this.animate = index => {
            this.coordinates.pop();
            this.coordinates.unshift([this.x, this.y]);

            this.speed *= this.friction;
            this.x += Math.cos(this.angle) * this.speed;
            this.y += Math.sin(this.angle) * this.speed + this.gravity;

            this.alpha -= this.decay;
            
            if (this.alpha <= this.decay) {
                particles.splice(index, 1);
            }
        }

        this.draw = index => {
            context.beginPath();
            context.moveTo(this.coordinates[this.coordinates.length - 1][0],
                           this.coordinates[this.coordinates.length - 1][1]);
            context.lineTo(this.x, this.y);

            context.strokeStyle = `hsla(${this.hue}, 100%, 50%, ${this.alpha})`;
            context.stroke();

            this.animate(index);
        }

        init();
    }


</script>