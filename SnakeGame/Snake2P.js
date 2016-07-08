$(document).ready(function () {	
    //Canvas stuff
    var canvas = $("#canvas")[0];
    var ctx = canvas.getContext("2d");
    var w = $("#canvas").width();
    var h = $("#canvas").height();
	
	// audio
	var mainMusic = document.getElementById("main_music");
	var gameOver = document.getElementById("game_over");

    //Lets save the cell width in a variable for easy control
    var cw = 10;
    var d1;
    var d2;
    var food;
    var score_p1;
    var score_p2;

    //Lets create the snake now
    var snake_array_p1; //an array of cells to make up the snake
    var snake_array_p2;

    function init() {
        d1 = "left"; //default direction
        d2 = "right";
        create_snake();
        create_food(); //Now we can see the food particle
        //finally lets display the score
        score_p1 = 0;
        score_p2 = 0;
		// audio
		mainMusic.play();
		gameOver.pause();
		
		  document.getElementById("hp1").value = 50;
        document.getElementById('1').innerHTML  = 5;

                document.getElementById("hp2").value = 50;
        document.getElementById('2').innerHTML  = 5;
		
        //Lets move the snake now using a timer which will trigger the paint function
        //every 60ms
        if (typeof game_loop != "undefined") clearInterval(game_loop);
        game_loop = setInterval(paint, 60);
    }
    init();

    function create_snake() {
        var length = 5; //Length of the snake
        snake_array_p1 = []; //Empty array to start with
        snake_array_p2 = [];
        for (var i = length - 1; i >= 0; i--) {
            //This will create a horizontal snake starting from the top left
            snake_array_p1.push({ x: 40, y: i });
        }
        for (var i = 0; i <= length - 1; i++) {
            //This will create a horizontal snake starting from the top left
            snake_array_p2.push({ x: 5, y: i + 40 });
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

    function p1_hp(x)
    {
        var a = document.getElementById("hp1").value;
        a = a + x;
        document.getElementById("hp1").value = a;
        document.getElementById('1').innerHTML  = a/10;
    }

    function p2_hp(x)
    {
         var a2 = document.getElementById("hp2").value;
        a2 = a2 + x;
        document.getElementById("hp2").value = a2;
        document.getElementById('2').innerHTML  = a2/10;
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
        var nx_p1 = snake_array_p1[0].x;
        var ny_p1 = snake_array_p1[0].y;

        var nx_p2 = snake_array_p2[0].x;
        var ny_p2 = snake_array_p2[0].y;

        //These were the position of the head cell.
        //We will increment it to get the new head position
        //Lets add proper direction based movement now
        if (d1 == "right") nx_p1++;
        else if (d1 == "left") nx_p1--;
        else if (d1 == "up") ny_p1--;
        else if (d1 == "down") ny_p1++;

        if (d2 == "right") nx_p2++;
        else if (d2 == "left") nx_p2--;
        else if (d2 == "up") ny_p2--;
        else if (d2 == "down") ny_p2++;

        //Lets add the game over clauses now
        //This will restart the game if the snake hits the wall
        //Lets add the code for body collision
        //Now if the head of the snake bumps into its body, the game will restart
        if (nx_p1 == -1 || nx_p1 == w / cw)
        {
            var ran = Math.floor((Math.random() * 10) + 1);
            if(ny_p1 == 0)
            {
                d1 = "down"; 
                deacrease_tail();
            }
            else if(ny_p1 == 44)
            {
                d1 = "up";
                deacrease_tail();
            }
            else
            {
                if(ran <6)
                {
                    d1 = "up";
                    deacrease_tail();
                }
                else
                {
                    d1 = "down";
                    deacrease_tail();
                }
            }
            return;
        }
        else if(ny_p1 == -1 || ny_p1 == h / cw)
        {   
            var ran2 = Math.floor((Math.random() * 10) + 1);

            if(nx_p1 == 0)
            {
                d1 = "right"; 
                deacrease_tail();
            }
            else if(nx_p1 == 44)
            {
                d1 = "left";
                deacrease_tail();
            }
            else
            {

                if(ran2 <6)
                {
                    d1 = "right";
                    deacrease_tail();
                }
                else
                {
                    d1 = "left";
                    deacrease_tail();
                }
            }
            return;
        } 
        else if(check_collision(nx_p1, ny_p1, snake_array_p1)) 
        {
            if(d1 == "up")
         {
            var ran2 = Math.floor((Math.random() * 10) + 1);
            if(ran2<6)
            {
                d1 = "right";
            }
            else
            {
                d1 = "left";
            }
         }
         else if(d1 == "down")
         {
            var ran2 = Math.floor((Math.random() * 10) + 1);
            if(ran2<6)
            {
                d1 = "right";
            }
            else
            {
                d1 = "left";
            }
         }
         else if(d = "right")
         {
            var ran2 = Math.floor((Math.random() * 10) + 1);
            if(ran2 <6)
            {
                d1 = "down";
            }
            else
            {
                d1 = "up";
            }
         }
         else
         {
            var ran2 = Math.floor((Math.random() * 10) + 1);
             if(ran2 <6)
            {
                d1 = "down";
            }
            else
            {
                d1 = "up";
            }
         }

            var tail = snake_array_p1.pop(); //pops out the last cell
            tail.x = nx_p1; tail.y = ny_p1;
        }




if (nx_p2 == -1 || nx_p2 == w / cw)
        {
            var ran = Math.floor((Math.random() * 10) + 1);
            if(ny_p2 == 0)
            {
                d2 = "down"; 
                deacrease_tail2();
            }
            else if(ny_p2 == 44)
            {
                d2 = "up";
                deacrease_tail2();
            }
            else
            {
                if(ran <6)
                {
                    d2 = "up";
                    deacrease_tail2();
                }
                else
                {
                    d2 = "down";
                    deacrease_tail2();
                }
            }
            return;
        }
        else if(ny_p2 == -1 || ny_p2 == h / cw)
        {   
            var ran2 = Math.floor((Math.random() * 10) + 1);

            if(nx_p2 == 0)
            {
                d2 = "right"; 
                deacrease_tail2();
            }
            else if(nx_p2 == 44)
            {
                d2 = "left";
                deacrease_tail2();
            }
            else
            {

                if(ran2 <6)
                {
                    d2 = "right";
                    deacrease_tail2();
                }
                else
                {
                    d2 = "left";
                    deacrease_tail2();
                }
            }
            return;
        } 
        else if(check_collision(nx_p2, ny_p2, snake_array_p2)) 
        {
            if(d2 == "up")
         {
            var ran2 = Math.floor((Math.random() * 10) + 1);
            if(ran2<6)
            {
                d2 = "right";
            }
            else
            {
                d2 = "left";
            }
         }
         else if(d == "down")
         {
            var ran2 = Math.floor((Math.random() * 10) + 1);
            if(ran2<6)
            {
                d2 = "right";
            }
            else
            {
                d2 = "left";
            }
         }
         else if(d2 = "right")
         {
            var ran2 = Math.floor((Math.random() * 10) + 1);
            if(ran2 <6)
            {
                d2 = "down";
            }
            else
            {
                d2 = "up";
            }
         }
         else
         {
            var ran2 = Math.floor((Math.random() * 10) + 1);
             if(ran2 <6)
            {
                d2 = "down";
            }
            else
            {
                d2 = "up";
            }
         }

            var tail = snake_array_p2.pop(); //pops out the last cell
            tail.x = nx_p2; tail.y = ny_p2;


        }
  
        if((nx_p1 == nx_p2) && (ny_p1 == ny_p2)||(nx_p1 == nx_p2-1) && (ny_p1 == ny_p2)||(nx_p1 == nx_p2) && (ny_p1 == ny_p2-1))
        {

            var ran = Math.floor((Math.random() * 10) + 1);
            if(d1 == "up")
            {
                if(ran < 6)
                {
                    d1 = "right";
                    if(d2 == down)
                    {
                        d2 = "left";
                    }
                    else if(d2 == "right" || d2 == "left")
                    {
                        if(ran<6)
                        {
                            d2 = "up";
                        }
                        else
                        {
                            d2 = "down";
                        }
                       
                    }
                }
                else
                {
                    d1 = "left";
                    if(d2 == down)
                    {
                        d2 = "right";
                    }
                    else if(d2 == "right" || d2 == "left")
                    {
                        if(ran<6)
                        {
                            d2 = "up";
                        }
                        else
                        {
                            d2 = "down";
                        }
                    }
                }
            }
            else if(d1 == "down")
            {
                if(ran < 6)
                {
                    d1 = "right";

                    if(d2 == "down")
                    {
                        d2 = "left";
                    }
                    else if(d2 == "right" || d2 == "left")
                    {
                        if(ran<6)
                        {
                            d2 = "up";
                        }
                        else
                        {
                            d2 = "down";
                        }
                       
                    }
                }
                else
                {
                    d1 = "left";

                    if(d2 == "down")
                    {
                        d2 = "right";
                    }
                    else if(d2 == "right" || d2 == "left")
                    {
                        if(ran<6)
                        {
                            d2 = "up";
                        }
                        else
                        {
                            d2 = "down";
                        }
                       
                    }
                }
            }
            else if(d1 == "right")
            {
                if(ran < 6)
                {
                    d1 = "up";
                    if(d2 == "left")
                    {
                        d2 = "down";
                    }
                    else if (d2 == "up"||d2 == "down")
                    {
                        if(ran<6)
                        {
                            d2 = "right";
                        }
                        else
                        {
                            d2 = "left";
                        }
                    }

                }
                else
                {
                    d1 = "down";

                    if(d2 == "left")
                    {
                        d2 = "up";
                    }
                    else if (d2 == "up"||d2 == "down")
                    {
                        if(ran<6)
                        {
                            d2 = "right";
                        }
                        else
                        {
                            d2 = "left";
                        }
                    }
                }

            }
            else 
            {
                if(ran < 6)
                {
                    d1 = "up";
                    if(d2 == "right")
                    {
                        d2 = "down";
                    }
                    else if (d2 == "up"||d2 == "down")
                    {
                        if(ran<6)
                        {
                            d2 = "right";
                        }
                        else
                        {
                            d2 = "left";
                        }
                    }
                }
                else
                {
                    d1 = "down";
                    if(d2 == "right")
                    {
                        d2 = "up";
                    }
                    else if (d2 == "up"||d2 == "down")
                    {
                        if(ran<6)
                        {
                            d2 = "right";
                        }
                        else
                        {
                            d2 = "left";
                        }
                    }
                }

            }
            deacrease_tail2();
            deacrease_tail();
        }
        //Lets write the code to make the snake eat the food
        //The logic is simple
        //If the new head position matches with that of the food,
        //Create a new head instead of moving the tail
        if (nx_p1 == food.x && ny_p1 == food.y) {
            var tail = { x: nx_p1, y: ny_p1 };
            score_p1++;
            //Create new food
            create_food();
            p1_hp(10);
        }
        else {
            var tail = snake_array_p1.pop(); //pops out the last cell
            tail.x = nx_p1; tail.y = ny_p1;
        }
        //The snake can now eat the food.

        snake_array_p1.unshift(tail); //puts back the tail as the first cell

        for (var i = 0; i < snake_array_p1.length; i++) {
            var c = snake_array_p1[i];
            //Lets paint 10px wide cells
            paint_snake_p1(c.x, c.y);
        }

        if (nx_p2 == food.x && ny_p2 == food.y) {
            var tail = { x: nx_p2, y: ny_p2 };
            score_p2++;
            //Create new food
            create_food();
            p2_hp(10);
        }
        else {
            var tail = snake_array_p2.pop(); //pops out the last cell
            tail.x = nx_p2; tail.y = ny_p2;
        }
        //The snake can now eat the food.

        snake_array_p2.unshift(tail); //puts back the tail as the first cell

        for (var i = 0; i < snake_array_p2.length; i++) {
            var c = snake_array_p2[i];
            //Lets paint 10px wide cells
            paint_snake_p2(c.x, c.y);
        }

        //Lets paint the food
        paint_cell(food.x, food.y);
       
    }

    //Lets first create a generic function to paint cells
    function paint_cell(x, y) {
        ctx.fillStyle = "black";
        ctx.fillRect(x * cw, y * cw, cw, cw);
        ctx.strokeStyle = "white";
        ctx.strokeRect(x * cw, y * cw, cw, cw);
    }

     //Lets first create a generic function to paint cells
    function paint_snake_p1(x, y) {
        ctx.fillStyle = "blue";
        ctx.fillRect(x * cw, y * cw, cw, cw);
        ctx.strokeStyle = "white";
        ctx.strokeRect(x * cw, y * cw, cw, cw);
    }

     //Lets first create a generic function to paint cells
    function paint_snake_p2(x, y) {
        ctx.fillStyle = "red";
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
         snake_array_p1.pop(); //pops out the last cell
         //tail.x = nx; 
         //tail.y = ny;
         if(snake_array_p1.length == 0)
         {
            gameoverP1();      
            return;
         }
         p1_hp(-10);
    }

         function deacrease_tail2()
    {
         snake_array_p2.pop(); //pops out the last cell
         //tail.x = nx; 
         //tail.y = ny;
         if(snake_array_p2.length == 0)
         {
            gameoverP2();
            return;
         }
         p2_hp(-10);
    }

	function gameoverP1(){
			
			mainMusic.pause();
			gameOver.play();
			
			//Get the gameover text
			var goText = document.getElementById("info2");
			
			goText.innerHTML = "Game Over. Player 1 wins!";
			
			var reText = document.getElementById("restart");
			reText.innerHTML = "Back to Main";
			
	}
	
	function gameoverP2(){
			
			mainMusic.pause();
			gameOver.play();
			
			//Get the gameover text
			var goText = document.getElementById("info2");
			
			goText.innerHTML = "Game Over. Player 2 wins!";
			
			var reText = document.getElementById("restart");
			reText.innerHTML = "Again??";
			
			
	}
	
    //Lets add the keyboard controls now
    $(document).keydown(function (e) {
        var key = e.which;
        //We will add another clause to prevent reverse gear
        if (key == "74" && d1 != "right") d1 = "left";
        else if (key == "73" && d1 != "down") d1 = "up";
        else if (key == "76" && d1 != "left") d1 = "right";
        else if (key == "75" && d1 != "up") d1 = "down";
        //The snake is now keyboard controllable

        if (key == "65" && d2 != "right") d2 = "left";
        else if (key == "87" && d2 != "down") d2 = "up";
        else if (key == "68" && d2 != "left") d2 = "right";
        else if (key == "83" && d2 != "up") d2 = "down";
    })

})