<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" type="text/css" href="TA4.css">
	<meta charset="UTF-8">
	<title>TA Eval</title>
</head>

<body>

	<?php
	require 'core/init.php';

	$user = new User();



	if(Session::exists('home')) {
	echo '<p>', Session::flash('home'), '</p>';  // flashes if a new user just registered.
}


// check to see if user is logged in.
if($user->isLoggedIn()) {
	?>
	
	
	
	<ul id= 'nav'>
		<li><a id = "nav1" href="profile.php?user=<?php echo escape($user->data()->username); ?>"><?php echo escape($user->data()->username); ?></a></li>
		<li><a id = "nav2" href="logout.php">Log out</a></li>
		<li><a id = "nav3" href="course_update.php">View Courses Hiring</a></li>
		<li><a id = "nav4" href="index.php">Home</a></li>
	</ul>
	<br>
	<?php

	if($user->hasPermission('instructor')) {
		?>
<div id='courses'><p> You Have Permission to Evaluate</p>


			<?php
		}

	} else {
		echo 'You need to <a href="login.php">log in</a> or <a href="register.php">register</a>!';
	}

	?>

</div>

	               <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
               <script>
                $(document).ready(function(){
                  

                  $("#nav1").hover(function(){
                    $("#nav1").css("color", "red");
                  },function(){
                    $("#nav1").css("color", "blue");
                  });
                  $("#nav2").hover(function(){
                    $("#nav2").css("color", "red");
                  },function(){
                    $("#nav2").css("color", "blue");
                  });
                  $("#nav3").hover(function(){
                    $("#nav3").css("color", "red");
                  },function(){
                    $("#nav3").css("color", "blue");
                  });
                  $("#nav4").hover(function(){
                    $("#nav4").css("color", "red");
                  },function(){
                    $("#nav4").css("color", "blue");
                  });
                });
</script>