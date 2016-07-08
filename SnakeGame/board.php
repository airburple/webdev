<?php
$username = "TA_Application";
$password = "626638918";
$mysql_database = "SnakeGame";

// username score

$query = "SELECT * FROM SnakeGame.scores ORDER BY score DESC LIMIT 30;	";
$output = "";

try {
	$dbh = new PDO ( "mysql:host=$mysql_hostname;dbname=$mysql_dbname;charset=utf8", $username, $password );
	$newUser = $dbh->query ( $query );
} catch ( PDOException $e ) {
	print "Error!: " . $e->getMessage () . "<br/>";
	die ();
}
$statement = $dbh->prepare ( $query );
$statement->execute ();

$result = $statement->fetchAll ( PDO::FETCH_ASSOC );

if (empty ( $result )) {
	$output .= "<h2> No Info </h2>";
} else {
	$username = $row ['user_name'];
	$score = $row ['score'];
	$rank = 1;
	
	$output .= "<table id=\"class_table\" class=\"display\">";
	$output .= "<thead><tr><th>RANK</th><th>Username</th><th>Score</th></tr></thead>";
	$output .= "<tfoot><tr><th>Rank</th><th>Username</th><th>Score</th></tr></tfoot>";
	$output .= "<tbody>";
	$output .= "<tr><td></td><td></td><td></td></tr>";
	foreach ( $result as $row ) { // . $row ['cid']
		$output .= "<tr> <td id=\"rank\" onclick=\"dispTblContents(this);\">" . "". $rank ++ . "</td><td id=\"username\">" . $row ['user_name'] . "</td><td id=\"scores\">" . $row ['score']  . "</td><td id=\"available\">" . $row ['available'] . "</td></tr>";
	}
	$output .= "</tbody></table>";
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>ScoreBoard</title>
<style type="text/css" media="all">
@import url(./CSS/Snake.css);
</style>
<link rel="stylesheet" type="text/css" href="CSS/Snake.css"
	media="all" />
<script type="text/javascript" language="javascript"
	src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" language="javascript"
	src="//cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript"
	src="../resources/demo.js"></script>
<script>


//<? echo $output ?>


$(document).ready(function() {
    var table = $('#class_table').DataTable( {
        "scrollY": "200px",
        "paging": false
    } );
 
    $('a.toggle-vis').on( 'click', function (e) {
        e.preventDefault();
 
        // Get the column API object
        var column = table.column( $(this).attr('data-column') );
 
        // Toggle the visibility
        column.visible( ! column.visible() );
    } );
} );




//<td id='subject'>Subject</td> <td id='catalog'>Catalog</td> <td id='section'>Section</td> <td id='title'>Title</td> <td id='time'>Time</td> <td id='enrollment'>Enrollment</td>   <td id='current'>Current</td>   <td id='available'>Available</td></tr>";
function dispTblContents(currentTd) {
	
	var cid = currentTd.innerHTML;
	var elem = document.getElementById("cid_change");
	
	alert(currentTd.innerHTML + " is selected\n Please click 'GET DETAIL' below \n to see the detail of the class");
	elem.value = cid; 
}

</script>
</head>
<body >
	<div>
		Toggle column: <a class="toggle-vis" data-column="0">RANK</a> - <a
			class="toggle-vis" data-column="1">USERNAME</a> - <a
			class="toggle-vis" data-column="2">SCORE</a> - <a
			class="toggle-vis" data-column="3">SCORE</a>
	</div>
	<br />
	<br />


	
	<div name="title_section">
		<h1>
			<font size=16>TOP '30' SNAKE USERS</font>
		</h1>
	</div>
	<div class="CSSTableGenerator">
<?php
echo $output;
?>
</div>

	<form action="more_information.php" method="post">
	<input type ="submit" id="menuItems"value="GET DETAIL">
	<input type ="hidden" id="cid_change" name ="value" value=""></form>
</body>
<font color="WHITE" size=10><a href="Main.php">Go back to
			previous page</a></font>
</html>