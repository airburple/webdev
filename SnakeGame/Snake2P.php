<!-- Lets make a simple snake game -->
<html>

<head>
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="CSS/BattleMode.css">
	
	<!-- Jquery -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
	<script src="Snake2P.js"></script>

	<!-- Audio -->
	<audio autoplay="autoplay" id="main_music" loop>
		<source src="Audio/main_music.mp3" type="audio/mp3">
	</audio>
	
	<audio autoplay="autoplay" id="game_over">
		<source src="Audio/gameOver.mp3" type="audio/mp3">
	</audio>
	
</head>

<body>
<header>
		<h1 id="BattleMode">Battle Snakes!</h1>
		<p id="info2"></p>
		<a href="Snake2P.php" id="restart" ></a> 	 
</header>
<table><tr><td>
<div id = "leftscreen">
		<p id="P1">Player  &nbsp;1 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label id="1">5</label></p>
        <progress id = "hp1" max="200" value="50" class="html5">
        </progress>

       <p id="P2">Player &nbsp;2 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label id="2">5</label></p>
        <progress id = "hp2" max="200" value="50" class="html5">
        </progress>
</div>
</td><td>
<div id ="rightscreen">
	<table>
		<tr>
			<td><canvas id="canvas" width="450" height="450"></canvas></td>		
		</tr>
	</table>
	<table>

</div>
</td></tr>
</table>
</body>
</html>
