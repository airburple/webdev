<!-- Lets make a simple snake game -->
<html>
<head>
	
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="CSS/SingleMode.css">
	
	<!-- Audio -->
	<audio autoplay="autoplay" id="main_music" loop>
		<source src="Audio/singlemode.mp3" type="audio/mp3">
	</audio>

	 <p>Player  &nbsp;1 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label id="1">5</label></p>
	<progress id = "hp1" max="200" value="50" class="html5">
		<div class="progress-bar">
			<span style="width: 80%"></span>
		</div>
	</progress>
	
	<!-- Jquery -->

<script language="javaScript" type="text/javascript">

	<?php
	include("dbconnector.php");

	//SELECTING TOP x user (now 5)
	$sql = "SELECT * FROM SnakeGame.scores ORDER BY score DESC LIMIT 30;	";
	
	$stmt = $db->prepare ( $sql );
	$stmt->execute ();
	//$count = $stmt->rowCount ();
	//echo $count;


	$usersArray = array();
	$scoresArray = array();
    
    $counter = 1;
    $lowestScore = 0;
    $topOneScore = 0;
    
    $result = $stmt->fetchAll ( PDO::FETCH_ASSOC );

    if (empty ( $result )) {
    	echo "No Information arrived\n";
    } else {
    	foreach ( $result as $row ) {
    		if ($counter == 1)
    			$topOneScore = $row ['score'];
    		$counter ++;
    		array_push($usersArray, "".$row ['username']);
    		array_push($scoresArray, "".$row ['score']);
    		
    		if ($counter == 30 )
    			$lowestScore = $row ['score'];
    	}
    	$js_users_array = json_encode($usersArray);
    	$js_scores_array = json_encode($scoresArray);
		//echo "var javascript_users_array = ". $js_users_array . ";\n";
		//echo "var javascript_scores_array = ". $js_scores_array . ";\n"; 
		?>
		<?php

    }
	?>

	var js_users_array= <?php echo json_encode($js_users_array ); ?>;
	var js_scores_array= <?php echo json_encode($js_scores_array ); ?>;
	var lowestScore = <?php echo $lowestScore; ?>;
	var topOneScore = <?php echo $topOneScore; ?>;

</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src='ScoreBoardCanvas.js'></script>
<script src="Snake.js"></script>
</head>
<body>
	

<table>
	<tr>
		<td><canvas id="canvas" width="450" height="450"></canvas></td>
		<td><canvas id="scoreCanvas" width="100" height="100"></canvas></td>
	<tr>
</table>
</body>
</html>
<!-- SEONGMAN KIM, TILL HERE -->

