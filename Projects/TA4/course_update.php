<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" type="text/css" href="TA4.css">
  <meta charset="UTF-8">
  <title>TA Application Courses</title>
</head>

<body>

<?php
require 'core/init.php';
$user = new User();

// use our get/to string methods from the Course class 
//to return a string containing an updated course hiring list and applicant list from our Course class.
$list = Course::getCoursesHiring(); 
$applicants = Course::getApplicants();
$allClasses = Course::getClassInfo();


if($user->isLoggedIn()) {
  ?>
  
  
  <br>
  <ul id= 'nav'>
    <li> <a href="profile.php?user=<?php echo escape($user->data()->username); ?>"><?php echo escape($user->data()->username); ?></a><li>
    <li><a href="logout.php">Log out</a></li>
    <li><a href="index.php">Home</a></li>
    <li><a href="apply.php">Start or Resume Application</a></li>
  </ul>

  <div id='courses'>

  <?php

    echo $list; // everyone logged in can see the course list but only amins can see applicants. 

  if($user->hasPermission('admin')) {
     // echo 'admin';
      echo $applicants;
  }

  if($user->hasPermission('instructor')) {
  
     echo $allClasses ;
  
  }

} else {
  echo 'You need to <a href="login.php">log in</a> or <a href="register.php">register</a>';
}







if($user->hasPermission('admin')) { // in the future admin can add delete or update classes
  
  
    
  }



?>

</div>