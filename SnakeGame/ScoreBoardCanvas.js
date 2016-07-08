//$.getScript("twoPSnake.js", function(){
//            //alert("Script loaded and executed.");
//});

// for(var i=0; 0 < js_users_array.length; i++){
//         alert(js_users_array[i]);
// }

$(document).ready(function () {
    //Canvas stuff
    var canvas = $("#scoreCanvas")[0];
    var scoreBoard_ctx = canvas.getContext("2d");
    var w = $("#scoreCanvas").width();
    var h = $("#scoreCanvas").height();


    // 0 for default
    // 0 : single player
    // 1 : multiple player
    // 2 : battle for two.
    // 3 : .. etc .. 
    var case_choice = 0; 

    // IP ADDRESS :  $ip=$_SERVER['REMOTE_ADD'];   
    //top ten user with score
    
    
    // high score control variables
    var _timer_highscore = 0;
    var timecount = 0;
    var highscore = lowestScore+1;

    var yourscore = 0;

    var score_change = 0;
    var score30 = 3;




    scoreBoard_ctx.fillStyle = 'blue';
    scoreBoard_ctx.strokeStyle = 'black';

    scoreBoard_ctx.font = '20pt Verdana';
    scoreBoard_ctx.fillText('TODAY\'s TOP 10 USERS', 30, 30);
    scoreBoard_ctx.strokeText('TODAY\'s TOP 10 USERS', 30, 30);

    scoreBoard_ctx.fill();
    scoreBoard_ctx.stroke();

    scoreBoard_ctx.fillStyle = 'blue';
    scoreBoard_ctx.strokeStyle = 'black';

    scoreBoard_ctx.font = '20pt Verdana';
    scoreBoard_ctx.fillText('NEW CANVAS HERE', 125, 225);
    scoreBoard_ctx.strokeText('NEW CANVAS HERE', 125, 225);

    scoreBoard_ctx.fill();
    scoreBoard_ctx.stroke();


    function drawYourScore(){
        scoreBoard_ctx.fillStyle = 'red';
        scoreBoard_ctx.strokeStyle = 'black';

        scoreBoard_ctx.font = '40pt Verdana';
        scoreBoard_ctx.textAlign = 'center';
        scoreBoard_ctx.fillText('GOOD, RANK 30', 225, 225);
        scoreBoard_ctx.strokeText('GOOD RANK 30', 225, 225);

        
        //scoreBoard_ctx.fillText(_timer_highscore, 225, 225);
        //scoreBoard_ctx.strokeText(_timer_highscore, 225, 225);
        //scoreBoard_ctx.strokeText(''+_timer_highscore , 50,50);

        scoreBoard_ctx.fill();
        scoreBoard_ctx.stroke();
    }

    function drawHowTo(){
        scoreBoard_ctx.textAlign = 'left';
        var fontSize = 17;
        var location = 55;
        scoreBoard_ctx.fillStyle = '#4DFF4D';
        scoreBoard_ctx.font = fontSize+'pt Verdana';
        scoreBoard_ctx.fillText("HOW TO?", 10, location-20);
        

        scoreBoard_ctx.fill();
        scoreBoard_ctx.stroke();
        location = location + 20;





        scoreBoard_ctx.fillStyle = 'blue';
        scoreBoard_ctx.fillRect(10, location -10, 10, 10);






        scoreBoard_ctx.fillStyle = 'blue';
        scoreBoard_ctx.fillText(" Food", 30, location);
        scoreBoard_ctx.fill();
        scoreBoard_ctx.stroke();
        location = location + 20;

        scoreBoard_ctx.fillStyle = 'red';
         scoreBoard_ctx.fillRect(10, location -10, 10, 10);
        scoreBoard_ctx.fillText(" Poison", 30, location);
        scoreBoard_ctx.fill();
        scoreBoard_ctx.stroke();
        location = location + 20;


        scoreBoard_ctx.fillStyle = 'green';
         scoreBoard_ctx.fillRect(10, location -10, 10, 10);
        scoreBoard_ctx.fillText(" Medicine", 30, location);
        scoreBoard_ctx.fill();
        scoreBoard_ctx.stroke();
        location = location + 20;

        scoreBoard_ctx.fillStyle = '#FF1493';
         scoreBoard_ctx.fillRect(10, location -10, 10, 10);
        scoreBoard_ctx.fillText(" Super Player", 30, location);
        scoreBoard_ctx.fill();
        scoreBoard_ctx.stroke();
        location = location + 50;

        scoreBoard_ctx.fillStyle = '#4DFF4D';

        scoreBoard_ctx.fillText("Up = I", 30, location);
        scoreBoard_ctx.fill();
        scoreBoard_ctx.stroke();
        location = location + 20;

        scoreBoard_ctx.fillText("Down = K", 30, location);
        scoreBoard_ctx.fill();
        scoreBoard_ctx.stroke();
        location = location + 20;

        scoreBoard_ctx.fillText("Left = J", 30, location);
        scoreBoard_ctx.fill();
        scoreBoard_ctx.stroke();
        location = location + 20;

        scoreBoard_ctx.fillText("Right = L", 30, location);
        scoreBoard_ctx.fill();
        scoreBoard_ctx.stroke();
        location = location + 20;

        scoreBoard_ctx.fillText("TOP SCORE : " + topOneScore, 30, location+ 100);
        scoreBoard_ctx.fill();
        scoreBoard_ctx.stroke();
        
    }

    function getScript(url, callback) {
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = url;

        script.onreadystatechange = callback;
        script.onload = callback;

        document.getElementsByTagName('head')[0].appendChild(script);
    }


//EXPLOSION
window.requestAnimFrame = (function(){
  return  window.requestAnimationFrame       || 
          window.webkitRequestAnimationFrame || 
          window.mozRequestAnimationFrame    || 
          window.oRequestAnimationFrame      || 
          window.msRequestAnimationFrame     || 
          function( callback ){
            window.setTimeout(callback, 1000 / 60);
          };
})();

var W = 450,
H = 450,
circles = [];

canvas.width = W;
canvas.height = H; 

//Random Circles creator
function create() {
    
    //Place the circles at the center
    
    this.x = W/2;
    this.y = H/2;

    //Random radius between 2 and 6
    this.radius = 2 + Math.random()*3; 
    
    //Random velocities
    this.vx = -5 + Math.random()*10;
    this.vy = -5 + Math.random()*10;
    
    //Random colors
    this.r = Math.round(Math.random())*255;
    this.g = Math.round(Math.random())*255;
    this.b = Math.round(Math.random())*255;
}

for (var i = 0; i < 500; i++) {
    circles.push(new create());
}


// draw function

function draw() {
    timecount ++;
    yourscore=score;
    score_change = score;

    // SINGLE PLAYER MODE CASE CHOICE == 0
    if(case_choice == 0){
        if(yourscore>=highscore && _timer_highscore <700){
            _timer_highscore ++;            
            //Fill canvas with black color
            cleanCanvas();
                
            //Fill the canvas with circles
            for(var j = 0; j < circles.length; j++){
                var c = circles[j];
                
                //Create the circles
                scoreBoard_ctx.beginPath();
                scoreBoard_ctx.arc(c.x, c.y, c.radius, 0, Math.PI*2, false);
                scoreBoard_ctx.fillStyle = "rgba("+c.r+", "+c.g+", "+c.b+", 0.5)";
                scoreBoard_ctx.fill();
                
                c.x += c.vx;
                c.y += c.vy;
                c.radius -= .02;
                
                if(c.radius < 0)
                    circles[j] = new create();
            }
            if(timecount % 100 >5){
                timecount = 0;
                drawYourScore(yourscore);
            }
        }
        else{
            drawHowTo();
            if(_timer_highscore == 700){
                scoreBoard_ctx.clearRect(0, 0, W, H);
                _timer_highscore ++;
            }

            if(timecount % 100 >5){
                timecount = 0;
                
            }
            
        }

        if(score != score_change){
            score_change = score;
            cleanCanvas();
        }
        //show my score
        // scoreBoard_ctx.fillStyle = 'blue';
        // scoreBoard_ctx.strokeStyle = 'white';
        // scoreBoard_ctx.font = '20pt Verdana';
        // scoreBoard_ctx.textAlign = 'right';
        // scoreBoard_ctx.fillText("Score : "+score_change , 430, 400);
        // scoreBoard_ctx.strokeText("Score : "+score_change , 430, 400);



        scoreBoard_ctx.fillStyle = 'blue';
        scoreBoard_ctx.strokeStyle = 'white';
        scoreBoard_ctx.font = '20pt Verdana';
        scoreBoard_ctx.textAlign = 'right';
        scoreBoard_ctx.fillText(score_change , 430, 400);
        scoreBoard_ctx.strokeText(score_change , 430, 400);
        cleanCanvas();
    }
    
}




function animate() {
    requestAnimFrame(animate);
    draw();
}

//clean canvas
function cleanCanvas(){
    scoreBoard_ctx.globalCompositeOperation = "source-over";
    scoreBoard_ctx.fillStyle = "rgba(0,0,0,0.25)";
    scoreBoard_ctx.fillRect(0, 0, W, H);
}

if(case_choice == 0)
    animate();
else if (case_choice==1)
{}

    
   //  function flashyText() {
   //  var count = 10;
   //  var timer = setInterval(function() {
   //          count--;
   //          if( count%2 == 1) {
   //              // draw the text
                
   //          }
   //          else {
   //              // don't draw it (ie. clear it off)
   //          }
   //          if( count == 0) clearInterval(timer);
   //      },1000);
   //  }
   // flashyText();
   

})