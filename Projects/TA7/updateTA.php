<?php


require 'core/init.php';
$user = new User();

// use our get/to string methods from the Course class 
//to return a string containing an updated course hiring list and applicant list from our Course class.
$list = '';//Course::getCoursesHiring(); 
$applicants = '';//Course::getApplicants();
//// $database = DB::getInstance();
// $classtotal= $database->count('RealCourse',array('year','=','2015')); 




$allStudentsArray = Application::getAllApplications();
$list = Course::getCoursesHiring(); 
?>

<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript" src="adminControl.js"> </script>
	<link rel="stylesheet" type="text/css" href="TA4.css"> 
</head>
	<body>

	

	<?php if($user->hasPermission('admin')) {  ?>
 
  
  
  
  <ul id= 'nav'>
    <li> <a id = 'navProfile'  href="profile.php?user=<?php echo escape($user->data()->username); ?>"><?php echo escape($user->data()->username); ?></a><li>
    <li><a  id = 'navLogout'   href="logout.php">Log out</a></li>
    <li><a  id = 'navHome'     href="index.php">Home</a></li>
    <li><a  id = 'navApply'    href="apply.php">Start or Resume Application</a></li>
  </ul>

  
<div id= "application">




  		<form action = "tempControl.php" method = "post" class= "ajax">
  			<div>
  				First enter a class number to pull all applications for that class and click submit.
  				<br>
  				<input type = "text" name = "CourseNumber" placeholder="5294">
  			</div>
  			
  				<br><br>
				<input type = "button" value="Send">
			<div>
  				<select name = "assignment">
				  <option value="assign">Assign</option>
				  <option value="unassign">Unassign</option>
				  <option value="probable">Probable</option>
				  
				</select>
			</div>
  			
  			<div >
  				Choose a TA from the application list and select an assignment change.
  				<br>
  				<input type = "text" name = "taID" placeholder = "99">
  			</div>
  				<br><br>
				<input type = "button" value="Double Click">
			</form>

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="updateTA.js"></script>

		<!-- <input type="text" id="userInput" />
		
		<input type ="submit" onclick="process()"> -->
		<div id="content">


			
		<?php  echo $list ; ?> 
		
		<?php // echo $allStudentsArray ; ?> 





		</div> 

		<!-- <form method="GET">
		<h2>Enter TA Name you wish to assgin.</h2>
		<input type="text" id="userInputAssign" />
		<input type="submit" onclick="processAssign()">
		</form>
		<div id="underInputAssign"> </div> -->

		<?php } else echo 'access denied!'; ?>

		</div>
	</body>
</html>