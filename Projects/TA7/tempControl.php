<?php
require('functions/functions.php');
require_once 'core/init.php';
include 'burrell_db_config.php'; 





$classNumber = 0;

 if (isset($_POST['CourseNumber'])){
 	//echo 'You selected class ' . $_POST['CourseNumber'];
 	$hiring = Course::getCoursesHiring(); 
 	echo '<div id="temp">'. $hiring .'</div>';
 	$classNumber = $_POST['CourseNumber'];
 	$classNumber = escape($classNumber);

 	
 	$allStudentsApps = Application::getApplicationsByClassNumber($classNumber);

 	echo '<br> ';
 	echo $allStudentsApps; 


 }

 if (!empty($_POST['taID'])){

 	$ta = $_POST['taID'] ;
 	$ta = escape($ta);
 	$change = $_POST['assignment'] ;
 	$change = escape($change);

 				if ($change == 'assign'){

 				try
					  {
					    //
					    // get the hire status for this user.
					    //
					    
					    
					    //
					    // Connect to the data base and select it.
					    //
					    $db = new PDO("mysql:host=$server_name;dbname=$db_name;charset=utf8", $db_user_name, $db_password);
					    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


					  $query = $db->query("UPDATE `RealCourse` SET `taHired`= $ta WHERE `class_number`= $classNumber;");
					  $query2 = $db->query("UPDATE `users` SET `Status`= 'Assigned' WHERE `id`= $ta;");
					 

					 	   while ($r = $query->fetch())
					      	{
					       		$Status = $r['Status'];					       
					     	}

					     	while ($r = $query2->fetch())
					      	{
					       		$Status = $r['Status'];					       
					     	}
					  


					  }

					  catch (PDOException $ex)
					  {
					    $Status .= "<p>oops</p>";
					    $Status .= "<p> Code: {$ex->getCode()} </p>";
					    $Status .=" <p> See: dev.mysql.com/doc/refman/5.0/en/error-messages-server.html#error_er_dup_key";
					    $Status .= "<pre>$ex</pre>";

					    
					  }

					}

					if ($change == 'unassign'){

 				try
					  {
					    //
					    // get the hire status for this user.
					    //
					    
					    
					    //
					    // Connect to the data base and select it.
					    //
					    $db = new PDO("mysql:host=$server_name;dbname=$db_name;charset=utf8", $db_user_name, $db_password);
					    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


					  $query = $db->query("UPDATE `RealCourse` SET `taHired`= '' WHERE `class_number`= $classNumber;"); // set to empty string to remove the ta (one TA per class)
					  $query2 = $db->query("UPDATE `users` SET `Status`= 'Unassigned' WHERE `id`= $ta;");
					 

					 	   while ($r = $query->fetch())
					      	{
					       		$Status = $r['Status'];					       
					     	}

					     	while ($r = $query2->fetch())
					      	{
					       		$Status = $r['Status'];					       
					     	}
					  


					  }

					  catch (PDOException $ex)
					  {
					    $Status .= "<p>oops</p>";
					    $Status .= "<p> Code: {$ex->getCode()} </p>";
					    $Status .=" <p> See: dev.mysql.com/doc/refman/5.0/en/error-messages-server.html#error_er_dup_key";
					    $Status .= "<pre>$ex</pre>";

					    
					  }

					}

					if ($change == 'probable'){

 				try
					  {
					    //
					    // get the hire status for this user.
					    //
					    
					    
					    //
					    // Connect to the data base and select it.
					    //
					    $db = new PDO("mysql:host=$server_name;dbname=$db_name;charset=utf8", $db_user_name, $db_password);
					    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


					  $query = $db->query("UPDATE `RealCourse` SET `taHired`= 'Considering $ta' WHERE `class_number`= $classNumber;"); // set to empty string to remove the ta (one TA per class)
					  $query2 = $db->query("UPDATE `users` SET `Status`= 'Under Consideration' WHERE `id`= $ta;");
					 

					 	   while ($r = $query->fetch())
					      	{
					       		$Status = $r['Status'];					       
					     	}

					     	while ($r = $query2->fetch())
					      	{
					       		$Status = $r['Status'];					       
					     	}
					  


					  }

					  catch (PDOException $ex)
					  {
					    $Status .= "<p>oops</p>";
					    $Status .= "<p> Code: {$ex->getCode()} </p>";
					    $Status .=" <p> See: dev.mysql.com/doc/refman/5.0/en/error-messages-server.html#error_er_dup_key";
					    $Status .= "<pre>$ex</pre>";

					    
					  }

					}



	

 // 	echo '<script language="javascript">';
	// echo 'alert("change was succesfull, details below.")';
	// echo '</script>';
 // 	echo '<span style="color:blue"> <h2>You changed the assignment to "' .$_POST['assignment']. '" of the TA with userID ' . $_POST['taID'] . ' to class number '. $classNumber . '</H2> </span>' ;
 // 	echo '<form  class= "ajax"><input type = "submit" value="OK"></form>';


 }

?>

