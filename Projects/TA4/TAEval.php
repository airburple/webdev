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
		<li><a href="profile.php?user=<?php echo escape($user->data()->username); ?>"><?php echo escape($user->data()->username); ?></a></li>
		<li><a href="logout.php">Log out</a></li>
		<li><a href="course_update.php">View Courses Hiring</a></li>
		<li><a href="index.php">Home</a></li>
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