	<!DOCTYPE html>
	<html>
	<head>

		<link rel="stylesheet" type="text/css" href="TA4.css">
		<meta charset="UTF-8">
		
	</head>

	<body>

	<?php
	require 'core/init.php';

	//grabs all the user data from the DB and stores it in $data

	if(!$username = Input::get('user')) {
		Redirect::to('index.php');
	} else{
		$user = new User($username);

		if(!$user->exists()) {
			Redirect::to(404);
		} else {
			$data = $user->data();
		}
	}	

	?>
		
	  <ul id= 'nav'>
	  		<li><a href="index.php">Home</a></li>
			<li><a href="logout.php">Log out</a></li>
			<li><a href="course_update.php">View Courses Hiring</a></li>
			<li><a href="apply.php">Apply</a></li>
		</ul>



		<div id ='courses'>

	<h3><?php echo escape($data->username); ?></h3>
	<br>

			 <table> 

	        <tr><td> Full name: <?php echo escape($data->name); ?>    </td></tr>
	        <tr><td> Role: <?php echo escape($data->role); ?>    </td></tr>
	        <tr><td> Employment Status: <?php echo escape($data->Status); ?>   </td></tr>
	        <tr><td> User Id: <?php echo escape($data->id); ?>  </td></tr>
	        
	   
	      </table>

		</div>

	