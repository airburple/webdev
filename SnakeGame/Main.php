<html>
<canvas id="canvas"></canvas>

<head>
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="CSS/Snake.css">
	<!-- Jquery -->
	
	<!-- Audio -->
	<audio autoplay="autoplay" controls="controls" id="start">
			<source src="Audio/start.mp3" type="audio/mp3">
	</audio>

</head>

<body>

	<div id="menu">
		<h1 id="snake">Super Snake</h1>
		<p id="info">by <a target="_blank" rel="nofollow" href="Team M.A.N.Y. Final Project Declaration.pdf">Team M.A.N.Y</a></p>
		
		<form action="Snake.php"> 
			<br><br><br><br>
			<input type="submit" id="menuItems" value="P1 start"></input>			
		</form>
		<form action="Snake2P.php">
			<br><br>
			<input type="submit" id="menuItems" value="P1 vs P2 start"></input>
		</form>
		<form action="board.php">
			<br><br>
			<input type="submit" id="menuItems" value="Score board"></input>
		</form>
		<form action="keyboard.html">
			<br><br>
			<input type="submit" id="menuItems" value="Controls"></input>
		</form>
		<form action="readme.html">
			<br><br>
			<input type="submit" id="menuItems" value="ReadMe(tutorial)"></input>
		</form>
		<br><br>
	</div>
	
</body>

</html>

