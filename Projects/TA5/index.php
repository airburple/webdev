
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
		<li><a id='homenav' href="./TA5.php">Home</a></li>

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
	
	<p>Hello <a id = "nav7" href="profile.php?user=<?php echo escape($user->data()->username); ?>"><?php echo escape($user->data()->username); ?></a></p>
	
	<ul>
		<li><a id = "nav2" href="logout.php">Log out</a></li>
		<li><a id = "nav3" href="course_update.php">View Courses Hiring</a></li>
		<li><a id = "nav4" href="apply.php">Start or View Applications</a></li>
	</ul>

	<?php

	if($user->hasPermission('admin')) {
		?>
		<p><li><a id = "nav5" href="course_update.php">Admins May View Updated Course And Applicant Lists</a></li></p>
		<br><br>
		<?php
	}

	if($user->hasPermission('instructor')) {
		?>
		<p><li><a id = "nav6" href="course_update.php">Instructors May View Course Info</a></li> </p><p><li><a id = "nav8" href="TAEval.php">Instructors May Submit A TA Eval Form</a></li></p>
		<?php
	}

} else {
	echo 'Please <a id = "nav5"   href="login.php">Log In</a> or <a id = "nav8" href="register.php">Register</a>';
}

?>


</div>

<!-- handles all the navbar hover ccolor changes to red on hover and blue after hover.  -->

 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
               <script>
                $(document).ready(function(){
                  
                  $("#homenav").hover(function(){
                    $("#homenav").css("color", "red");
                  },function(){
                    $("#homenav").css("color", "blue");
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

                  $("#nav5").hover(function(){
                    $("#nav5").css("color", "red");
                  },function(){
                    $("#nav5").css("color", "blue");
                  });

                  $("#nav6").hover(function(){
                    $("#nav6").css("color", "red");
                  },function(){
                    $("#nav6").css("color", "blue");
                  });

                  $("#nav7").hover(function(){
                    $("#nav7").css("color", "red");
                  },function(){
                    $("#nav7").css("color", "blue");
                  });

                  $("#nav8").hover(function(){
                    $("#nav8").css("color", "red");
                  },function(){
                    $("#nav8").css("color", "blue");
                  });
                });
</script>