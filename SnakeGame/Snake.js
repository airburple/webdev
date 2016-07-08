var score;

$(document).ready(function () {
    //Canvas stuff
    var canvas = $("#canvas")[0];
    var ctx = canvas.getContext("2d");
    var w = $("#canvas").width();
    var h = $("#canvas").height();

    //Lets save the cell width in a variable for easy control
    var cw = 10;
    var d;
    var food;
    var food2;
    var food3;
    var food4;
    var poison = false;
    
    var score30 = 3;
    //var level_muliplier =5;
    

    var newWallTimer = 0; // for each new wall give the player 50 frames before adding collision for new walls only.
    var newWallTimer2 = 0;
    var newWallTimer3 = 0;
    var newWallTimer4 = 0;
    var newWallTimer5 = 0;

     var newWallTimer6 = 0; // for each new wall give the player 50 frames before adding collision for new walls only.
    var newWallTimer7 = 0;
    var newWallTimer8 = 0;
    var newWallTimer9 = 0;
    var newWallTimer10 = 0;


    //set 5 random boundaries for virtical walls to be used later.
    var verticalWallStartX = Math.round(Math.random()*44);
    var verticalWallStartY = Math.round(Math.random()*15);
    var verticalWallEndY = verticalWallStartY +10;// Math.round(Math.random() * 29) + 15;

    var verticalWall2StartX = Math.round(Math.random() * 6+30);
    var verticalWall2StartY = Math.round(Math.random() * 5 +30);
    var verticalWall2EndY = verticalWall2StartY +10 ;

    var verticalWall3StartX = Math.round(Math.random() * 14);
    var verticalWall3StartY = Math.round(Math.random() * 10);
    var verticalWall3EndY = verticalWall3StartY +20;

    var verticalWall4StartX = Math.round(Math.random()/2 * 44 );
    var verticalWall4StartY = Math.round(Math.random() * 15);
    var verticalWall4EndY = verticalWall4StartY +10;

    var verticalWall5StartX = Math.round(Math.random() * 44);
    var verticalWall5StartY = Math.round(Math.random() * 10);
    var verticalWall5EndY = verticalWall5StartY +15;


    //now build 5 horizontal wall boundaries to use later

    var horizontalWallStartY = Math.round(Math.random() * 4 +39);
    var horizontalWallStartX = Math.round(Math.random() * 8 + 30);
    var horizontalWallEndX = horizontalWallStartX + 10;

    var horizontalWall2StartY = Math.round(Math.random() * 14 + 30);
    var horizontalWall2StartX = Math.round(Math.random() * 5);
    var horizontalWall2EndX = horizontalWall2StartX + 20;

    var horizontalWall3StartY = Math.round(Math.random() * 8+34);
    var horizontalWall3StartX = Math.round(Math.random() * 10+30);
    var horizontalWall3EndX = horizontalWall3StartX + 10;

    var horizontalWall4StartY = Math.round(Math.random() / 2 * 44);
    var horizontalWall4StartX = Math.round(Math.random() * 15);
    var horizontalWall4EndX = horizontalWall4StartX + 10;

    var horizontalWall5StartY = Math.round(Math.random() * 7 +12);
    var horizontalWall5StartX = Math.round(Math.random() * 10);
    var horizontalWall5EndX = horizontalWall5StartX + 15;

    // another 5 of each

    //set 5 random boundaries for virtical walls to be used later.
    var verticalWall6StartX = Math.round(Math.random()*44);
    var verticalWall6StartY = Math.round(Math.random()*15);
    var verticalWall6EndY = verticalWall6StartY +10;// Math.round(Math.random() * 29) + 15;

    

    var verticalWall7StartX = Math.round(Math.random() * 24+20);
    var verticalWall7StartY = Math.round(Math.random() * 5);
    var verticalWall7EndY = verticalWall7StartY +10 ;

    var verticalWall8StartX = Math.round(Math.random() * 14);
    var verticalWall8StartY = Math.round(Math.random() * 10+ 30);
    var verticalWall8EndY = verticalWall8StartY +20;

    var verticalWall9StartX = Math.round(Math.random()/2 * 44 );
    var verticalWall9StartY = Math.round(Math.random() * 15);
    var verticalWall9EndY = verticalWall9StartY +10;

    var verticalWall10StartX = Math.round(Math.random() * 43);
    var verticalWall10StartY = Math.round(Math.random() * 10);
    var verticalWall10EndY = verticalWall10StartY +15;


    //now build 5 horizontal wall boundaries to use later

    var horizontalWall6StartY = Math.round(Math.random() * 43);
    var horizontalWall6StartX = Math.round(Math.random() * 15);
    var horizontalWall6EndX = horizontalWall6StartX + 10;

    var horizontalWall7StartY = Math.round(Math.random() * 14 + 30);
    var horizontalWall7StartX = Math.round(Math.random() * 5);
    var horizontalWall7EndX = horizontalWall7StartX + 20;

    var horizontalWall8StartY = Math.round(Math.random() * 14);
    var horizontalWall8StartX = Math.round(Math.random() * 10);
    var horizontalWall8EndX = horizontalWall8StartX + 10;

    var horizontalWall9StartY = Math.round(Math.random() / 2 * 44);
    var horizontalWall9StartX = Math.round(Math.random() * 15);
    var horizontalWall9EndX = horizontalWall9StartX + 10;

    var horizontalWall10StartY = Math.round(Math.random() * 7 +12);
    var horizontalWall10StartX = Math.round(Math.random() * 10);
    var horizontalWall10EndX = horizontalWall10StartX + 15;


    //Lets create the snake now
    var snake_array; //an array of cells to make up the snake

    function init() {

        document.getElementById("hp1").value = 50;
        document.getElementById('1').innerHTML  = 5;
        d = "left"; //default direction
        score= 0;
        create_snake();
        create_food(); //Now we can see the food particle
        create_food2();
        create_food3();
        //finally lets display the score
        score = 0;
        newWallTimer = 0;
        newWallTimer2 = 0;
        newWallTimer3 = 0;
        newWallTimer4 = 0;
        newWallTimer5 = 0;
        newWallTimer6 = 0;
        newWallTimer7 = 0;
        newWallTimer8 = 0;
        newWallTimer9 = 0;
        newWallTimer10 = 0;

        newFoodCounter = 0;

        //Lets move the snake now using a timer which will trigger the paint function
        //every 60ms
        if (typeof game_loop != "undefined") clearInterval(game_loop);
        game_loop = setInterval(paint, 60);
    }
    init();

    function create_snake() {
        var length = 5; //Length of the snake
        snake_array = []; //Empty array to start with
        for (var i = length - 1; i >= 0; i--) {
            //This will create a horizontal snake starting from the top left
            snake_array.push({ x: 40, y: i });
        }
    }

    //Lets create the food now
    function create_food() {
        food = {
            x: Math.round(Math.random() * (w - cw) / cw),
            y: Math.round(Math.random() * (h - cw) / cw),
        };
        //This will create a cell with x/y between 0-44
        //Because there are 45(450/10) positions accross the rows and columns
    }
    function create_food2() {
        food2 = {
            x: Math.round(Math.random() * (w - cw) / cw),
            y: Math.round(Math.random() * (h - cw) / cw),
        };

        food4 = {
            x: Math.round(Math.random() * (w - cw) / cw),
            y: Math.round(Math.random() * (h - cw) / cw),
        };
        //This will create a cell with x/y between 0-44
        //Because there are 45(450/10) positions accross the rows and columns
    }

    function create_food3() {
        food3 = {
            x: Math.round(Math.random() * (w - cw) / cw),
            y: Math.round(Math.random() * (h - cw) / cw),
        };
    }

    function p1_hp(x)
    {
        var a = document.getElementById("hp1").value;
        a = a + x;
        document.getElementById("hp1").value = a;
        document.getElementById('1').innerHTML  = a/10;
    }


     // SCORE UPDATE. SEONGMAN KIM
    function updateTop30() {
        var username = prompt("Congratulation.\nYou have just gotton on our rank system! \n top30 !!", "Please type your nick name");
            
        if (username != null) {
            //alert(username);
            updateScore(username, score);
        }
    }

    //Lets paint the snake now
    function paint() {
        //To avoid the snake trail we need to paint the BG on every frame
        //Lets paint the canvas now
        ctx.fillStyle = "white";
        ctx.fillRect(0, 0, w, h);
        ctx.strokeStyle = "black";
        ctx.strokeRect(0, 0, w, h);

   

        //The movement code for the snake to come here.
        //The logic is simple
        //Pop out the tail cell and place it infront of the head cell
        var nx = snake_array[0].x;
        var ny = snake_array[0].y;
        //These were the position of the head cell.
        //We will increment it to get the new head position
        //Lets add proper direction based movement now
        if(poison)
        {
            if (d == "right") nx--;
            else if (d == "left") nx++;
            else if (d == "up") ny++;
            else if (d == "down") ny--;
        }
        else
        {
            if (d == "right") nx++;
            else if (d == "left") nx--;
            else if (d == "up") ny--;
            else if (d == "down") ny++;
        }   


       

        //Lets add the game over clauses now
        //This will restart the game if the snake hits the wall
        //Lets add the code for body collision
        //Now if the head of the snake bumps into its body, the game will restart
        if (nx == -1 || nx == w / cw)
        {
            var ran = Math.floor((Math.random() * 10) + 1);
            if(ny == 0)
            {
                d = "down"; 
                deacrease_tail();
            }
            else if(ny == 44)
            {
                d = "up";
                deacrease_tail();
            }
            else
            {
                if(ran <6)
                {
                    d = "up";
                    deacrease_tail();
                }
                else
                {
                    d = "down";
                    deacrease_tail();
                }
            }
            return;
        }
        else if(ny == -1 || ny == h / cw)
        {   
            var ran2 = Math.floor((Math.random() * 10) + 1);

            if(nx == 0)
            {
                d = "right"; 
                deacrease_tail();
            }
            else if(nx == 44)
            {
                d = "left";
                deacrease_tail();
            }
            else
            {

                if(ran2 <6)
                {
                    d = "right";
                    deacrease_tail();
                }
                else
                {
                    d = "left";
                    deacrease_tail();
                }
            }
            return;
        } 
        else if(check_collision(nx, ny, snake_array)) 
        {
            //restart game
            //init();
            //Lets organize the code a bit now.
            //return;

            if(d == "up")
         {
            var ran2 = Math.floor((Math.random() * 10) + 1);
            if(ran2<6)
            {
                d = "right";
            }
            else
            {
                d = "left";
            }
         }
         else if(d == "down")
         {
            var ran2 = Math.floor((Math.random() * 10) + 1);
            if(ran2<6)
            {
                d = "right";
            }
            else
            {
                d = "left";
            }
         }
         else if(d = "right")
         {
            var ran2 = Math.floor((Math.random() * 10) + 1);
            if(ran2 <6)
            {
                d = "down";
            }
            else
            {
                d = "up";
            }
         }
         else
         {
            var ran2 = Math.floor((Math.random() * 10) + 1);
             if(ran2 <6)
            {
                d = "down";
            }
            else
            {
                d = "up";
            }
         }

            var tail = snake_array.pop(); //pops out the last cell
            tail.x = nx; tail.y = ny;


        }
        
        

            
        //draw the walls based on which level you have reached. Right now that is based on score.
           
                        //ctx.fillRect(x,y,width,height);
            if (score >= 2) {
            
                ctx.fillStyle = 'rgba(5,255,0,.4)'; // flash from green to red to signal new wall.
                if (newWallTimer == 5  || newWallTimer == 6  || newWallTimer == 7  || newWallTimer == 8  || newWallTimer == 13 ||
                    newWallTimer == 14 || newWallTimer == 15 || newWallTimer == 16 || newWallTimer == 21 || newWallTimer == 22 ||
                    newWallTimer == 23 || newWallTimer == 24 || newWallTimer> 29) { ctx.fillStyle = 'red'; } // stays red once timer reaches 30
            ctx.fillRect(verticalWallStartX * 10, verticalWallStartY * 10, 10, (verticalWallEndY - verticalWallStartY) * 10);
            ctx.fillRect(horizontalWallStartX * 10, horizontalWallStartY* 10, (horizontalWallEndX - horizontalWallStartX) * 10, 10);




            }
            if (score >= 4) {
                
                ctx.fillStyle = 'rgba(5,255,0,.4)';
                if (newWallTimer2 == 5 || newWallTimer2 == 6 || newWallTimer2 == 7 || newWallTimer2 == 8 || newWallTimer2 == 13 ||
                   newWallTimer2 == 14 || newWallTimer2 == 15 || newWallTimer2 == 16 || newWallTimer2 == 21 || newWallTimer2 == 22 ||
                   newWallTimer2 == 23 || newWallTimer2 == 24 || newWallTimer2 > 29) { ctx.fillStyle = 'red'; }
                ctx.fillRect(verticalWall2StartX * 10, verticalWall2StartY * 10, 10, (verticalWall2EndY - verticalWall2StartY) * 10);
                ctx.fillRect(horizontalWall2StartX * 10, horizontalWall2StartY * 10, (horizontalWall2EndX - horizontalWall2StartX) * 10, 10);
            }

            if (score >= 6) {
                ctx.fillStyle = 'rgba(5,255,0,.4)';
                if(newWallTimer3 ==  5 || newWallTimer3 == 6  || newWallTimer3  == 7 || newWallTimer3   == 8 || newWallTimer3 == 13 ||
                   newWallTimer3 == 14 || newWallTimer3 == 15 || newWallTimer3 == 16 || newWallTimer3  == 21 || newWallTimer3 == 22 ||
                   newWallTimer3 == 23 || newWallTimer3 == 24 || newWallTimer3 > 29) { ctx.fillStyle = 'red'; }
                ctx.fillRect(verticalWall3StartX * 10, verticalWall3StartY * 10, 10, (verticalWall3EndY - verticalWall3StartY) * 10);
                ctx.fillRect(horizontalWall3StartX * 10, horizontalWall3StartY * 10, (horizontalWall3EndX - horizontalWall3StartX) * 10, 10);
            }

            if (score >= 8) {
                ctx.fillStyle = 'rgba(5,255,0,.4)';
                if (newWallTimer4 == 5  || newWallTimer4 == 6  || newWallTimer4 == 7  || newWallTimer4 == 8  || newWallTimer4 == 13 ||
                    newWallTimer4 == 14 || newWallTimer4 == 15 || newWallTimer4 == 16 || newWallTimer4 == 21 || newWallTimer4 == 22 ||
                    newWallTimer4 == 23 || newWallTimer4 == 24 || newWallTimer4 > 29) { ctx.fillStyle = 'red'; }
                ctx.fillRect(verticalWall4StartX * 10, verticalWall4StartY * 10, 10, (verticalWall4EndY - verticalWall4StartY) * 10);
                ctx.fillRect(horizontalWall4StartX * 10, horizontalWall4StartY * 10, (horizontalWall4EndX - horizontalWall4StartX) * 10, 10);
            }
            
            if (score >= 10) {
                ctx.fillStyle = 'rgba(5,255,0,.4)';
                if (newWallTimer5 == 5 || newWallTimer5 == 6 || newWallTimer5 == 7 || newWallTimer5 == 8 || newWallTimer5 == 13 ||
                   newWallTimer5 == 14 || newWallTimer5 == 15 || newWallTimer5 == 16 || newWallTimer5 == 21 || newWallTimer5 == 22 ||
                   newWallTimer5 == 23 || newWallTimer5 == 24 || newWallTimer5 > 29) { ctx.fillStyle = 'red'; }
                ctx.fillRect(verticalWall5StartX * 10, verticalWall5StartY * 10, 10, (verticalWall5EndY - verticalWall5StartY) * 10);
                ctx.fillRect(horizontalWall5StartX * 10, horizontalWall5StartY * 10, (horizontalWall5EndX - horizontalWall5StartX) * 10, 10);
            }



            // adding the 5-10

                    //draw the walls based on which level you have reached. Right now that is based on score.
           
                        //ctx.fillRect(x,y,width,height);
            if (score >= 12) {
            
                ctx.fillStyle = 'rgba(5,255,0,.4)'; // flash from green to red to signal new wall.
                if (newWallTimer6 == 5  || newWallTimer6 == 6  || newWallTimer6 == 7  || newWallTimer6 == 8  || newWallTimer6 == 13 ||
                    newWallTimer6 == 14 || newWallTimer6 == 15 || newWallTimer6 == 16 || newWallTimer6 == 21 || newWallTimer6 == 22 ||
                    newWallTimer6 == 23 || newWallTimer6 == 24 || newWallTimer6> 29) { ctx.fillStyle = 'red'; } // stays red once timer reaches 30
            ctx.fillRect(verticalWall6StartX * 10, verticalWall6StartY * 10, 10, (verticalWall6EndY - verticalWall6StartY) * 10);
            ctx.fillRect(horizontalWall6StartX * 10, horizontalWall6StartY* 10, (horizontalWall6EndX - horizontalWall6StartX) * 10, 10);




            }
            if (score >= 14) {
                
                ctx.fillStyle = 'rgba(5,255,0,.4)';
                if (newWallTimer7 == 5 || newWallTimer7 == 6 || newWallTimer7 == 7 || newWallTimer7 == 8 || newWallTimer7 == 13 ||
                   newWallTimer7 == 14 || newWallTimer7 == 15 || newWallTimer7 == 16 || newWallTimer7 == 21 || newWallTimer7 == 22 ||
                   newWallTimer7 == 23 || newWallTimer7 == 24 || newWallTimer7 > 29) { ctx.fillStyle = 'red'; }
                ctx.fillRect(verticalWall7StartX * 10, verticalWall7StartY * 10, 10, (verticalWall7EndY - verticalWall7StartY) * 10);
                ctx.fillRect(horizontalWall7StartX * 10, horizontalWall7StartY * 10, (horizontalWall7EndX - horizontalWall7StartX) * 10, 10);
            }

            if (score >= 16) {
                ctx.fillStyle = 'rgba(5,255,0,.4)';
                if(newWallTimer8 ==  5 || newWallTimer8 == 6  || newWallTimer8  == 7 || newWallTimer8   == 8 || newWallTimer8 == 13 ||
                   newWallTimer8 == 14 || newWallTimer8 == 15 || newWallTimer8 == 16 || newWallTimer8  == 21 || newWallTimer8 == 22 ||
                   newWallTimer8 == 23 || newWallTimer8 == 24 || newWallTimer8 > 29) { ctx.fillStyle = 'red'; }
                ctx.fillRect(verticalWall8StartX * 10, verticalWall8StartY * 10, 10, (verticalWall8EndY - verticalWall8StartY) * 10);
                ctx.fillRect(horizontalWall8StartX * 10, horizontalWall8StartY * 10, (horizontalWall8EndX - horizontalWall8StartX) * 10, 10);
            }

            if (score >= 18) {
                ctx.fillStyle = 'rgba(5,255,0,.4)';
                if (newWallTimer9 == 5  || newWallTimer9 == 6  || newWallTimer9 == 7  || newWallTimer9 == 8  || newWallTimer9 == 13 ||
                    newWallTimer9 == 14 || newWallTimer9 == 15 || newWallTimer9 == 16 || newWallTimer9 == 21 || newWallTimer9 == 22 ||
                    newWallTimer9 == 23 || newWallTimer9 == 24 || newWallTimer9 > 29) { ctx.fillStyle = 'red'; }
                ctx.fillRect(verticalWall9StartX * 10, verticalWall9StartY * 10, 10, (verticalWall9EndY - verticalWall9StartY) * 10);
                ctx.fillRect(horizontalWall9StartX * 10, horizontalWall9StartY * 10, (horizontalWall9EndX - horizontalWall9StartX) * 10, 10);
            }
            
            if (score >= 20) {
                ctx.fillStyle = 'rgba(5,255,0,.4)';
                if (newWallTimer10 == 5 || newWallTimer10 == 6 || newWallTimer10 == 7 || newWallTimer10 == 8 || newWallTimer10 == 13 ||
                   newWallTimer10 == 14 || newWallTimer10 == 15 || newWallTimer10 == 16 || newWallTimer10 == 21 || newWallTimer10 == 22 ||
                   newWallTimer10 == 23 || newWallTimer10 == 24 || newWallTimer10 > 29) { ctx.fillStyle = 'red'; }
                ctx.fillRect(verticalWall10StartX * 10, verticalWall10StartY * 10, 10, (verticalWall10EndY - verticalWall10StartY) * 10);
                ctx.fillRect(horizontalWall10StartX * 10, horizontalWall10StartY * 10, (horizontalWall10EndX - horizontalWall10StartX) * 10, 10);
            }
        //ctx.fillRect(x,y,width,height); (syntax reminder)
















        //ctx.fillRect(x,y,width,height); (syntax reminder)
            
        // handle collisions for each new wall

            if (score >= 2) {
                newWallTimer++;
                newFoodCounter++;
                if (newFoodCounter > 200){
                    newFoodCounter = 0;
                    create_food();
                }

                if (newWallTimer > 50) {
                    if (nx == verticalWallStartX && (ny >= verticalWallStartY && ny < verticalWallEndY)) {

                                       var ran2 = Math.floor((Math.random() * 10) + 1);
                                       if(d == "right")
                                       {
                                        nx = verticalWallStartX-1;
                                        }
                                        else
                                        {
                                            nx = verticalWallStartX+1;
                                        }
                if(ran2 <6)
                {
                    d = "up";
                    deacrease_tail();
                }
                else
                {
                    d = "down";
                    deacrease_tail();
                }
                    }

                    if (food.x == verticalWallStartX && (food.y >= verticalWallStartY && food.y < verticalWallEndY)) {
                        create_food(); //if food is stuck in a wall we recreate it.
                    }
                    if (food2.x == verticalWallStartX && (food.y >= verticalWallStartY && food.y < verticalWallEndY)) {
                        create_food2(); //if food is stuck in a wall we recreate it.
                    }
                    if (food3.x == verticalWallStartX && (food.y >= verticalWallStartY && food.y < verticalWallEndY)) {
                        create_food3(); //if food is stuck in a wall we recreate it.
                    }

                    if (ny == horizontalWallStartY && (nx >= horizontalWallStartX && nx < horizontalWallEndX)) {

                                       var ran2 = Math.floor((Math.random() * 10) + 1);



                                       if(d == "down")
                                       {
                                        ny = horizontalWallStartY-1;
                                        }
                                        else
                                        {
                                            ny = horizontalWallStartY+1;
                                        }


                if(ran2 <6)
                {
                    d = "right";
                    deacrease_tail();
                }
                else
                {
                    d = "left";
                    deacrease_tail();
                }
                    }

                    if (food.y == horizontalWallStartY && (food.x >= horizontalWallStartX && food.x < horizontalWallEndX)) {

                        create_food();
                    }
                    if (food2.y == horizontalWallStartY && (food.x >= horizontalWallStartX && food.x < horizontalWallEndX)) {

                        create_food2();
                    }
                    if (food3.y == horizontalWallStartY && (food.x >= horizontalWallStartX && food.x < horizontalWallEndX)) {

                        create_food3();
                    }
                    
                }
            }

  if (score >= 4) {
                newWallTimer2++;

                if (newWallTimer2 > 30) {
                    if (nx == verticalWall2StartX && (ny >= verticalWall2StartY && ny < verticalWall2EndY)) {

                                       var ran2 = Math.floor((Math.random() * 10) + 1);
                                             if(d == "right")
                                       {
                                        nx = verticalWall2StartX-1;
                                        }
                                        else
                                        {
                                            nx = verticalWall2StartX+1;
                                        }
                if(ran2 <6)
                {
                    d = "up";
                    deacrease_tail();
                }
                else
                {
                    d = "down";
                    deacrease_tail();
                }
                    }

                    if (food.x == verticalWall2StartX && (food.y >= verticalWall2StartY && food.y < verticalWall2EndY)) {
                        create_food();
                    }

                    if (food2.x == verticalWall2StartX && (food.y >= verticalWall2StartY && food.y < verticalWall2EndY)) {
                        create_food2();
                    }

                    if (food3.x == verticalWall2StartX && (food.y >= verticalWall2StartY && food.y < verticalWall2EndY)) {
                        create_food3();
                    }

                    if (ny == horizontalWall2StartY && (nx >= horizontalWall2StartX && nx < horizontalWall2EndX)) {

                                        var ran2 = Math.floor((Math.random() * 10) + 1);
                                                                               if(d == "down")
                                       {
                                        ny = horizontalWall2StartY-1;
                                        }
                                        else
                                        {
                                            ny = horizontalWall2StartY+1;
                                        }


                if(ran2 <6)
                {
                    d = "right";
                    deacrease_tail();
                }
                else
                {
                    d = "left";
                    deacrease_tail();
                }
                    }

                    if (food.y == horizontalWall2StartY && (food.x >= horizontalWall2StartX && food.x < horizontalWall2EndX)) {

                        create_food();
                    }
                    if (food2.y == horizontalWall2StartY && (food.x >= horizontalWall2StartX && food.x < horizontalWall2EndX)) {

                        create_food2();
                    }
                    if (food3.y == horizontalWall2StartY && (food.x >= horizontalWall2StartX && food.x < horizontalWall2EndX)) {

                        create_food3();
                    }
                }
            }

    if (score >= 6) {

                newWallTimer3++;

                if (newWallTimer3 > 30) {
                    if (nx == verticalWall3StartX && (ny >= verticalWall3StartY && ny < verticalWall3EndY)) {

                                       var ran2 = Math.floor((Math.random() * 10) + 1);
                                             if(d == "right")
                                       {
                                        nx = verticalWall3StartX-1;
                                        }
                                        else
                                        {
                                            nx = verticalWall3StartX+1;
                                        }
                if(ran2 <6)
                {
                    d = "up";
                    deacrease_tail();
                }
                else
                {
                    d = "down";
                    deacrease_tail();
                }
                    }
                    if (food.x == verticalWall3StartX && (food.y >= verticalWall3StartY && food.y < verticalWall3EndY)) {
                        create_food();
                    }
                    if (food2.x == verticalWall3StartX && (food.y >= verticalWall3StartY && food.y < verticalWall3EndY)) {
                        create_food2();
                    }
                    if (food3.x == verticalWall3StartX && (food.y >= verticalWall3StartY && food.y < verticalWall3EndY)) {
                        create_food3();
                    }

                    if (ny == horizontalWall3StartY && (nx >= horizontalWall3StartX && nx < horizontalWall3EndX)) {

                                        var ran2 = Math.floor((Math.random() * 10) + 1);
                                                                               if(d == "down")
                                       {
                                        ny = horizontalWall3StartY-1;
                                        }
                                        else
                                        {
                                            ny = horizontalWall3StartY+1;
                                        }

                if(ran2 <6)
                {
                    d = "right";
                    deacrease_tail();
                }
                else
                {
                    d = "left";
                    deacrease_tail();
                }
                    }

                    if (food.y == horizontalWall3StartY && (food.x >= horizontalWall3StartX && food.x < horizontalWall3EndX)) {

                        create_food();
                    }
                    if (food2.y == horizontalWall3StartY && (food.x >= horizontalWall3StartX && food.x < horizontalWall3EndX)) {

                        create_food2();
                    }

                    if (food3.y == horizontalWall3StartY && (food.x >= horizontalWall3StartX && food.x < horizontalWall3EndX)) {

                        create_food3();
                    }
                }
            }

if (score >= 8) {

                newWallTimer4++;

                if (newWallTimer4 > 30) {
                    if (nx == verticalWall4StartX && (ny >= verticalWall4StartY && ny < verticalWall4EndY)) {

                                        var ran2 = Math.floor((Math.random() * 10) + 1);
                                              if(d == "right")
                                       {
                                        nx = verticalWall4StartX-1;
                                        }
                                        else
                                        {
                                            nx = verticalWall4StartX+1;
                                        }
                if(ran2 <6)
                {
                    d = "up";
                    deacrease_tail();
                }
                else
                {
                    d = "down";
                    deacrease_tail();
                }
                    }
                    if (food.x == verticalWall4StartX && (food.y >= verticalWall4StartY && food.y < verticalWall4EndY)) {
                        create_food();
                    }

                                        if (food2.x == verticalWall4StartX && (food.y >= verticalWall4StartY && food.y < verticalWall4EndY)) {
                        create_food2();
                    }


                    if (food3.x == verticalWall4StartX && (food.y >= verticalWall4StartY && food.y < verticalWall4EndY)) {
                        create_food3();
                    }


                    if (ny == horizontalWall4StartY && (nx >= horizontalWall4StartX && nx < horizontalWall4EndX)) {

                                        var ran2 = Math.floor((Math.random() * 10) + 1);
                                                                               if(d == "down")
                                       {
                                        ny = horizontalWall4StartY-1;
                                        }
                                        else
                                        {
                                            ny = horizontalWall4StartY+1;
                                        }

                                       
                if(ran2 <6)
                {
                    d = "right";
                    deacrease_tail();
                }
                else
                {
                    d = "left";
                    deacrease_tail();
                }
                    }

                    if (food.y == horizontalWall4StartY && (food.x >= horizontalWall4StartX && food.x < horizontalWall4EndX)) {

                        create_food();
                    }

                                        if (food2.y == horizontalWall4StartY && (food.x >= horizontalWall4StartX && food.x < horizontalWall4EndX)) {

                        create_food2();
                    }

                                        if (food3.y == horizontalWall4StartY && (food.x >= horizontalWall4StartX && food.x < horizontalWall4EndX)) {

                        create_food3();
                    }
                }
            }

    if (score >= 10) {

                newWallTimer5++;

                if (newWallTimer5 > 30) {
                    if (nx == verticalWall5StartX && (ny >= verticalWall5StartY && ny < verticalWall5EndY)) {

                                       var ran2 = Math.floor((Math.random() * 10) + 1);
                                             if(d == "right")
                                       {
                                        nx = verticalWall5StartX-1;
                                        }
                                        else
                                        {
                                            nx = verticalWall5StartX+1;
                                        }
                if(ran2 <6)
                {
                    d = "up";
                    deacrease_tail();
                }
                else
                {
                    d = "down";
                    deacrease_tail();
                }
                    }

                    if (food.x == verticalWall5StartX && (food.y >= verticalWall5StartY && food.y < verticalWall5EndY)) {
                        create_food();
                    }
                                        if (food2.x == verticalWall5StartX && (food.y >= verticalWall5StartY && food.y < verticalWall5EndY)) {
                        create_food2();
                    }
                                        if (food3.x == verticalWall5StartX && (food.y >= verticalWall5StartY && food.y < verticalWall5EndY)) {
                        create_food3();
                    }

                    if (ny == horizontalWall5StartY && (nx >= horizontalWall5StartX && nx < horizontalWall5EndX)) {

                                       var ran2 = Math.floor((Math.random() * 10) + 1);
                                                                              if(d == "down")
                                       {
                                        ny = horizontalWall5StartY-1;
                                        }
                                        else
                                        {
                                            ny = horizontalWall5StartY+1;
                                        }

                if(ran2 <6)
                {
                    d = "right";
                    deacrease_tail();
                }
                else
                {
                    d = "left";
                    deacrease_tail();
                }
                    }

                    if (food.y == horizontalWall5StartY && (food.x >= horizontalWall5StartX && food.x < horizontalWall5EndX)) {

                        create_food();
                    }

                                        if (food2.y == horizontalWall5StartY && (food.x >= horizontalWall5StartX && food.x < horizontalWall5EndX)) {

                        create_food2();
                    }

                                        if (food3.y == horizontalWall5StartY && (food.x >= horizontalWall5StartX && food.x < horizontalWall5EndX)) {

                        create_food3();
                    }
                }
            }

           
        
// start 6-10
if (score >= 12) {
                newWallTimer6++;
                newFoodCounter++;
                if (newFoodCounter > 200){
                    newFoodCounter = 0;
                    create_food();
                }

                if (newWallTimer6 > 50) {
                    if (nx == verticalWall6StartX && (ny >= verticalWall6StartY && ny < verticalWall6EndY)) {

                                       var ran2 = Math.floor((Math.random() * 10) + 1);
                                       if(d == "right")
                                       {
                                        nx = verticalWall6StartX-1;
                                        }
                                        else
                                        {
                                            nx = verticalWall6StartX+1;
                                        }
                if(ran2 <6)
                {
                    d = "up";
                    deacrease_tail();
                }
                else
                {
                    d = "down";
                    deacrease_tail();
                }
                    }

                    if (food.x == verticalWall6StartX && (food.y >= verticalWall6StartY && food.y < verticalWall6EndY)) {
                        create_food(); //if food is stuck in a wall we recreate it.
                    }
                    if (food2.x == verticalWall6StartX && (food.y >= verticalWall6StartY && food.y < verticalWall6EndY)) {
                        create_food2(); //if food is stuck in a wall we recreate it.
                    }
                    if (food3.x == verticalWall6StartX && (food.y >= verticalWall6StartY && food.y < verticalWall6EndY)) {
                        create_food3(); //if food is stuck in a wall we recreate it.
                    }

                    if (ny == horizontalWall6StartY && (nx >= horizontalWall6StartX && nx < horizontalWall6EndX)) {

                                       var ran2 = Math.floor((Math.random() * 10) + 1);



                                       if(d == "down")
                                       {
                                        ny = horizontalWall6StartY-1;
                                        }
                                        else
                                        {
                                            ny = horizontalWall6StartY+1;
                                        }


                if(ran2 <6)
                {
                    d = "right";
                    deacrease_tail();
                }
                else
                {
                    d = "left";
                    deacrease_tail();
                }
                    }

                    if (food.y == horizontalWall6StartY && (food.x >= horizontalWall6StartX && food.x < horizontalWall6EndX)) {

                        create_food();
                    }
                    if (food2.y == horizontalWall6StartY && (food.x >= horizontalWall6StartX && food.x < horizontalWall6EndX)) {

                        create_food2();
                    }
                    if (food3.y == horizontalWall6StartY && (food.x >= horizontalWall6StartX && food.x < horizontalWall6EndX)) {

                        create_food3();
                    }
                    
                }
            }

  if (score >= 14) {
                newWallTimer7++;

                if (newWallTimer7 > 30) {
                    if (nx == verticalWall7StartX && (ny >= verticalWall7StartY && ny < verticalWall7EndY)) {

                                       var ran2 = Math.floor((Math.random() * 10) + 1);
                                             if(d == "right")
                                       {
                                        nx = verticalWall7StartX-1;
                                        }
                                        else
                                        {
                                            nx = verticalWall7StartX+1;
                                        }
                if(ran2 <6)
                {
                    d = "up";
                    deacrease_tail();
                }
                else
                {
                    d = "down";
                    deacrease_tail();
                }
                    }

                    if (food.x == verticalWall7StartX && (food.y >= verticalWall7StartY && food.y < verticalWall7EndY)) {
                        create_food();
                    }

                    if (food2.x == verticalWall7StartX && (food.y >= verticalWall7StartY && food.y < verticalWall7EndY)) {
                        create_food2();
                    }

                    if (food3.x == verticalWall7StartX && (food.y >= verticalWall7StartY && food.y < verticalWall7EndY)) {
                        create_food3();
                    }

                    if (ny == horizontalWall7StartY && (nx >= horizontalWall7StartX && nx < horizontalWall7EndX)) {

                                        var ran2 = Math.floor((Math.random() * 10) + 1);
                                                                               if(d == "down")
                                       {
                                        ny = horizontalWall7StartY-1;
                                        }
                                        else
                                        {
                                            ny = horizontalWall7StartY+1;
                                        }


                if(ran2 <6)
                {
                    d = "right";
                    deacrease_tail();
                }
                else
                {
                    d = "left";
                    deacrease_tail();
                }
                    }

                    if (food.y == horizontalWall7StartY && (food.x >= horizontalWall7StartX && food.x < horizontalWall7EndX)) {

                        create_food();
                    }
                    if (food2.y == horizontalWall7StartY && (food.x >= horizontalWall7StartX && food.x < horizontalWall7EndX)) {

                        create_food2();
                    }
                    if (food3.y == horizontalWall7StartY && (food.x >= horizontalWall7StartX && food.x < horizontalWall7EndX)) {

                        create_food3();
                    }
                }
            }

    if (score >= 16) {

                newWallTimer8++;

                if (newWallTimer8 > 30) {
                    if (nx == verticalWall8StartX && (ny >= verticalWall8StartY && ny < verticalWall8EndY)) {

                                       var ran2 = Math.floor((Math.random() * 10) + 1);
                                             if(d == "right")
                                       {
                                        nx = verticalWall8StartX-1;
                                        }
                                        else
                                        {
                                            nx = verticalWall8StartX+1;
                                        }
                if(ran2 <6)
                {
                    d = "up";
                    deacrease_tail();
                }
                else
                {
                    d = "down";
                    deacrease_tail();
                }
                    }
                    if (food.x == verticalWall8StartX && (food.y >= verticalWall8StartY && food.y < verticalWall8EndY)) {
                        create_food();
                    }
                    if (food2.x == verticalWall8StartX && (food.y >= verticalWall8StartY && food.y < verticalWall8EndY)) {
                        create_food2();
                    }
                    if (food3.x == verticalWall8StartX && (food.y >= verticalWall8StartY && food.y < verticalWall8EndY)) {
                        create_food3();
                    }

                    if (ny == horizontalWall8StartY && (nx >= horizontalWall8StartX && nx < horizontalWall8EndX)) {

                                        var ran2 = Math.floor((Math.random() * 10) + 1);
                                                                               if(d == "down")
                                       {
                                        ny = horizontalWall8StartY-1;
                                        }
                                        else
                                        {
                                            ny = horizontalWall8StartY+1;
                                        }

                if(ran2 <6)
                {
                    d = "right";
                    deacrease_tail();
                }
                else
                {
                    d = "left";
                    deacrease_tail();
                }
                    }

                    if (food.y == horizontalWall8StartY && (food.x >= horizontalWall8StartX && food.x < horizontalWall8EndX)) {

                        create_food();
                    }
                    if (food2.y == horizontalWall8StartY && (food.x >= horizontalWall8StartX && food.x < horizontalWall8EndX)) {

                        create_food2();
                    }

                    if (food3.y == horizontalWall8StartY && (food.x >= horizontalWall8StartX && food.x < horizontalWall8EndX)) {

                        create_food3();
                    }
                }
            }

if (score >= 18) {

                newWallTimer9++;

                if (newWallTimer9 > 30) {
                    if (nx == verticalWall9StartX && (ny >= verticalWall9StartY && ny < verticalWall9EndY)) {

                                        var ran2 = Math.floor((Math.random() * 10) + 1);
                                              if(d == "right")
                                       {
                                        nx = verticalWall9StartX-1;
                                        }
                                        else
                                        {
                                            nx = verticalWall9StartX+1;
                                        }
                if(ran2 <6)
                {
                    d = "up";
                    deacrease_tail();
                }
                else
                {
                    d = "down";
                    deacrease_tail();
                }
                    }
                    if (food.x == verticalWall9StartX && (food.y >= verticalWall9StartY && food.y < verticalWall9EndY)) {
                        create_food();
                    }

                                        if (food2.x == verticalWall9StartX && (food.y >= verticalWall9StartY && food.y < verticalWall9EndY)) {
                        create_food2();
                    }


                    if (food3.x == verticalWall9StartX && (food.y >= verticalWall9StartY && food.y < verticalWall9EndY)) {
                        create_food3();
                    }


                    if (ny == horizontalWall9StartY && (nx >= horizontalWall9StartX && nx < horizontalWall9EndX)) {

                                        var ran2 = Math.floor((Math.random() * 10) + 1);
                                                                               if(d == "down")
                                       {
                                        ny = horizontalWall9StartY-1;
                                        }
                                        else
                                        {
                                            ny = horizontalWall9StartY+1;
                                        }

                                       
                if(ran2 <6)
                {
                    d = "right";
                    deacrease_tail();
                }
                else
                {
                    d = "left";
                    deacrease_tail();
                }
                    }

                    if (food.y == horizontalWall9StartY && (food.x >= horizontalWall9StartX && food.x < horizontalWall9EndX)) {

                        create_food();
                    }

                                        if (food2.y == horizontalWall9StartY && (food.x >= horizontalWall9StartX && food.x < horizontalWall9EndX)) {

                        create_food2();
                    }

                                        if (food3.y == horizontalWall9StartY && (food.x >= horizontalWall9StartX && food.x < horizontalWall9EndX)) {

                        create_food3();
                    }
                }
            }

    if (score >= 20) {

                newWallTimer10++;

                if (newWallTimer10 > 30) {
                    if (nx == verticalWall10StartX && (ny >= verticalWall10StartY && ny < verticalWall10EndY)) {

                                       var ran2 = Math.floor((Math.random() * 10) + 1);
                                             if(d == "right")
                                       {
                                        nx = verticalWall10StartX-1;
                                        }
                                        else
                                        {
                                            nx = verticalWall10StartX+1;
                                        }
                if(ran2 <6)
                {
                    d = "up";
                    deacrease_tail();
                }
                else
                {
                    d = "down";
                    deacrease_tail();
                }
                    }

                    if (food.x == verticalWall10StartX && (food.y >= verticalWall10StartY && food.y < verticalWall10EndY)) {
                        create_food();
                    }
                                        if (food2.x == verticalWall10StartX && (food.y >= verticalWall10StartY && food.y < verticalWall10EndY)) {
                        create_food2();
                    }
                                        if (food3.x == verticalWall10StartX && (food.y >= verticalWall10StartY && food.y < verticalWall10EndY)) {
                        create_food3();
                    }

                    if (ny == horizontalWall10StartY && (nx >= horizontalWall10StartX && nx < horizontalWall10EndX)) {

                                       var ran2 = Math.floor((Math.random() * 10) + 1);
                                                                              if(d == "down")
                                       {
                                        ny = horizontalWall10StartY-1;
                                        }
                                        else
                                        {
                                            ny = horizontalWall10StartY+1;
                                        }

                if(ran2 <6)
                {
                    d = "right";
                    deacrease_tail();
                }
                else
                {
                    d = "left";
                    deacrease_tail();
                }
                    }

                    if (food.y == horizontalWall10StartY && (food.x >= horizontalWall10StartX && food.x < horizontalWall10EndX)) {

                        create_food();
                    }

                                        if (food2.y == horizontalWall10StartY && (food.x >= horizontalWall10StartX && food.x < horizontalWall10EndX)) {

                        create_food2();
                    }

                                        if (food3.y == horizontalWall10StartY && (food.x >= horizontalWall10StartX && food.x < horizontalWall10EndX)) {

                        create_food3();
                    }
                }
            }

           
        

//end 6-10
       

        //Lets write the code to make the snake eat the food
        //The logic is simple
        //If the new head position matches with that of the food,
        //Create a new head instead of moving the tail
         if(nx == food2.x && ny == food2.y) {
                 //poision = true;
            var tail = { x: nx, y: ny };
            tail.x = nx; tail.y = ny;
                       //score--;
            p1_hp(-10);
            //Create new food
           
            create_food2();
         //       if(snake_array_p1.length == 0)
         // {
         //    init();
         //    return;
         // }

         if(d == "up")
         {
            var ran2 = Math.floor((Math.random() * 10) + 1);
            if(ran2<6)
            {
                d = "right";
            }
            else
            {
                d = "left";
            }
         }
         else if(d == "down")
         {
            var ran2 = Math.floor((Math.random() * 10) + 1);
            if(ran2<6)
            {
                d = "right";
            }
            else
            {
                d = "left";
            }
         }
         else if(d = "right")
         {
            var ran2 = Math.floor((Math.random() * 10) + 1);
            if(ran2 <6)
            {
                d = "down";
            }
            else
            {
                d = "up";
            }
         }
         else
         {
            var ran2 = Math.floor((Math.random() * 10) + 1);
             if(ran2 <6)
            {
                d = "down";
            }
            else
            {
                d = "up";
            }
         }
         poison = true;

        }


            if(nx == food3.x && ny == food3.y) {
            //var tail = snake_array_p1.pop(); //pops out the last cell
            var tail = { x: nx, y: ny };
            tail.x = nx; tail.y = ny;
             //          score++;
            //p1_hp(-10);
            //Create new food
            poison = false;
            create_food3();

             if(d == "up")
         {
            var ran2 = Math.floor((Math.random() * 10) + 1);
            if(ran2<6)
            {
                d = "right";
            }
            else
            {
                d = "left";
            }
         }
         else if(d == "down")
         {
            var ran2 = Math.floor((Math.random() * 10) + 1);
            if(ran2<6)
            {
                d = "right";
            }
            else
            {
                d = "left";
            }
         }
         else if(d = "right")
         {
            var ran2 = Math.floor((Math.random() * 10) + 1);
            if(ran2 <6)
            {
                d = "down";
            }
            else
            {
                d = "up";
            }
         }
         else
         {
            var ran2 = Math.floor((Math.random() * 10) + 1);
             if(ran2 <6)
            {
                d = "down";
            }
            else
            {
                d = "up";
            }
         }
         poision = false;

        }

        if (nx == food.x && ny == food.y) {
            var tail = { x: nx, y: ny };
            score++;
            p1_hp(10);

            //Create new food
            create_food();

        }

        else {
            var tail = snake_array.pop(); //pops out the last cell
            tail.x = nx; tail.y = ny;
        }
        //The snake can now eat the food.

        snake_array.unshift(tail); //puts back the tail as the first cell

        for (var i = 0; i < snake_array.length; i++) {
            var c = snake_array[i];
            //Lets paint 10px wide cells
            paint_cell(c.x, c.y);
        }

        //Lets paint the food
        paint_cell(food.x, food.y);
        paint_cell2(food2.x, food2.y);
        paint_cell3(food3.x, food3.y);
        //Lets paint the score
        var score_text = "Score: " + score;



       



        ctx.fillText(score_text, 5, h - 5);

       // var score_text2 = "New Wall Timer: " + newWallTimer;    //for debugging
       // ctx.fillText(score_text2, 30, h - 30);

       // var score_text2 = "New Wall Timer2: " + newWallTimer2;    //for debugging
       // ctx.fillText(score_text2, 30, h - 60);

       // var score_text2 = "New Wall Timer3: " + newWallTimer3;    //for debugging
       // ctx.fillText(score_text2, 30, h - 90);

       // var score_text2 = "New Wall Timer4: " + newWallTimer4;    //for debugging
       // ctx.fillText(score_text2, 30, h - 120);

       // var score_text2 = "New Wall Timer5: " + newWallTimer5;    //for debugging
       // ctx.fillText(score_text2, 30, h - 150);

       //  var score_text3 = "Refresh Page for new Random Map";
       //  ctx.fillText(score_text3, 60, h - 5); 
    }

    //Lets first create a generic function to paint cells
    function paint_cell(x, y)


     {
        ctx.fillStyle = "blue";
        if (poison){
            ctx.fillStyle = "green";
        }

        if (score>19){
            ctx.fillStyle = '#FF1493';

        }

        ctx.fillRect(x * cw, y * cw, cw, cw);
        ctx.strokeStyle = "white";
        ctx.strokeRect(x * cw, y * cw, cw, cw);
    }
        function paint_cell2(x, y) {
        ctx.fillStyle = "red";
        ctx.fillRect(x * cw, y * cw, cw, cw);
        ctx.strokeStyle = "white";
        ctx.strokeRect(x * cw, y * cw, cw, cw);
    }

     function paint_cell3(x, y) {
        ctx.fillStyle = "green";
        ctx.fillRect(x * cw, y * cw, cw, cw);
        ctx.strokeStyle = "white";
        ctx.strokeRect(x * cw, y * cw, cw, cw);
    }

    function check_collision(x, y, array) {
        //This function will check if the provided x/y coordinates exist
        //in an array of cells or not
        for (var i = 0; i < array.length; i++) {
            if (array[i].x == x && array[i].y == y)
                return true;
        }
        return false;
    }

        function deacrease_tail()
    {
         snake_array.pop(); //pops out the last cell
         //p1_hp(-10);

         if (score >5){
                 snake_array.pop(); // if score is above 5 pop a second one off
                 p1_hp(-10);
            }


         if (score >9){
                 snake_array.pop(); // if score is above 9 pop a third one off
                 p1_hp(-10);

            }
        
        if (score >14){
                 snake_array.pop(); // if score is above 14 pop a 5 off at a time
                 snake_array.pop();
                 snake_array.pop();
                 p1_hp(-30);

            }




         //tail.x = nx; 
         //tail.y = ny;
         if(snake_array.length == 0)
         {

            if(score > lowestScore){
                updateTop30();
            }
            poison = false;

             verticalWallStartX = Math.round(Math.random()*44);      // reset the random wall values
             verticalWallStartY = Math.round(Math.random()*15);
             verticalWallEndY = Math.round(Math.random() * 29) + 15;



             verticalWall2StartX = Math.round(Math.random() * 24+20);
             verticalWall2StartY = Math.round(Math.random() * 5);
             verticalWall2EndY = Math.round(Math.random() * 30)+5 ;

             verticalWall3StartX = Math.round(Math.random() * 14);
             verticalWall3StartY = Math.round(Math.random() * 10);
             verticalWall3EndY = Math.round(Math.random() * 34) + 10;

             verticalWall4StartX = Math.round(Math.random()/2 * 44 );
             verticalWall4StartY = Math.round(Math.random() * 15);
             verticalWall4EndY = Math.round(Math.random() * 29) + 15;

             verticalWall5StartX = Math.round(Math.random() * 44);
             verticalWall5StartY = Math.round(Math.random() * 10);
             verticalWall5EndY = Math.round(Math.random() * 34) + 10;


            //now build 5 horizontal wall boundaries to use later

             horizontalWallStartY = Math.round(Math.random() * 44);
             horizontalWallStartX = Math.round(Math.random() * 15);
             horizontalWallEndX = Math.round(Math.random() * 29) + 15;

             horizontalWall2StartY = Math.round(Math.random() * 14 + 30);
             horizontalWall2StartX = Math.round(Math.random() * 5);
             horizontalWall2EndX = Math.round(Math.random() * 30) + 5;

             horizontalWall3StartY = Math.round(Math.random() * 14);
             horizontalWall3StartX = Math.round(Math.random() * 10);
             horizontalWall3EndX = Math.round(Math.random() * 34) + 10;

             horizontalWall4StartY = Math.round(Math.random() / 2 * 44);
             horizontalWall4StartX = Math.round(Math.random() * 15);
             horizontalWall4EndX = Math.round(Math.random() * 29) + 15;

             horizontalWall5StartY = Math.round(Math.random() * 7 +12);
             horizontalWall5StartX = Math.round(Math.random() * 10);
             horizontalWall5EndX = Math.round(Math.random() * 34) + 10;


            init();
            return;
         }
         p1_hp(-10);
    }

    //Lets add the keyboard controls now
    $(document).keydown(function (e) {
        var key = e.which;
        //We will add another clause to prevent reverse gear
        if (key == "74" && d != "right") d = "left";
        else if (key == "73" && d != "down") d = "up";
        else if (key == "76" && d != "left") d = "right";
        else if (key == "75" && d != "up") d = "down";
        //The snake is now keyboard controllable
    })



    function updateScore(username, score) {
    //alert(value.innerHTML);
    
    $.ajax(
            {
                type:'POST',
                url: 'updateScore.php'  ,
                data: {username:username, score:score},
                dataType: "html",             // The type of data that is getting returned.

                        /**
                         * What to do before the ajax request is sent. Perhaps gather
                         * page information, prep form, etc.
                         */
                        beforeSend: function()
                        {
                        },

                        /**
                         * What to do when the data is successfully retreived
                         */
                        success: function(response)
                        {
                            alert(username + "\n you are added to database");

                        },

                        /**
                         * What to do after the transaction is complete.
                         */
                        complete: function()
                        {

                        },

                        /**
                         * What to do if there is an error
                         * 
                         */
                        error: function( response, options, error )
                        {

                        }

            });

}



})