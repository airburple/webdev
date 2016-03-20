	<!DOCTYPE html>
	<!-- allows us to view profile information of the user logged in such as role, name, user ID, and Sataus. -->
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
	  		<li><a id = "nav1" href="index.php">Home</a></li>
			<li><a id = "nav2" href="logout.php">Log out</a></li>
			<li><a id = "nav3" href="course_update.php">View Courses Hiring</a></li>
			<li><a id = "nav4" href="apply.php">Apply</a></li>
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