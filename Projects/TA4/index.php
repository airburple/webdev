
<!-- Author Aaron Burrell, this site was patterned after PHP acadamies OOP PHP tutorial on Login/Register 23 part series.
Depending on if you are logged in or not this page displays a login or register option or if you are an administrator you may 
look at course lists or aplicants lists. If you are an instructor you may go to the TA feedback form. If you are an applicant the links to apply show. -->

<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" type="text/css" href="TA4.css">
	<meta charset="UTF-8">
	<title>TA Application Home</title>
</head>

<body>


	<ul id= 'nav'>
		<li><a id='homenav' href="./TA4.php">Home</a></li>

	</ul>
	<br/>
	<br>
	



	<div id= 'signup'>

	<h2>Welcome to the TA Application Website</h2>
	<br>

		Do you have what it takes to be a TA?
		Sign up today to start the application process.
		<br><br>


		<?php
		require 'core/init.php';

		$user = new User();



		if(Session::exists('home')) {
	echo '<p>', Session::flash('home'), '</p>';  // flashes if a new user just registered.
}


// check to see if user is logged in.
if($user->isLoggedIn()) {
	?>
	
	<p>Hello <a href="profile.php?user=<?php echo escape($user->data()->username); ?>"><?php echo escape($user->data()->username); ?></a></p>
	
	<ul>
		<li><a href="logout.php">Log out</a></li>
		<li><a href="course_update.php">View Courses Hiring</a></li>
		<li><a href="apply.php">Start or View Applications</a></li>
	</ul>

	<?php

	if($user->hasPermission('admin')) {
		?>
		<p><li><a href="course_update.php">Admins May View Updated Course And Applicant Lists</a></li></p>
		<br><br>
		<?php
	}

	if($user->hasPermission('instructor')) {
		?>
		<p><li><a href="course_update.php">Instructors May View Course Info</a></li> </p><p><li><a href="TAEval.php">Instructors May Submit A TA Eval Form</a></li></p>
		<?php
	}

} else {
	echo 'Please <a href="login.php">log in</a> or <a href="register.php">register</a>';
}

?>


</div>

