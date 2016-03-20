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
    <li> <a id = 'navProfile'  href="profile.php?user=<?php echo escape($user->data()->username); ?>"><?php echo escape($user->data()->username); ?></a><li>
    <li><a  id = 'navLogout'   href="logout.php">Log out</a></li>
    <li><a  id = 'navHome'     href="index.php">Home</a></li>
    <li><a  id = 'navApply'    href="apply.php">Start or Resume Application</a></li>
  </ul>

  <div id='courses'>

 <h2><u>Classes Hiring</u></h2>
 <button id="hide">Hide</button>
 <button id="show">Show</button> 


<br>
  <div id ='hiring'>
  
  <?php echo $list; // everyone logged in can see the course list but only amins can see applicants. ?> 

  </div>

  <?php

  if($user->hasPermission('admin')) {
     // echo 'admin';
    
    ?>
    <h2><u>Applicants Statuses</u></h2>
    <button id="hide2">Hide</button>
    <button id="show2">Show</button> 

    <br>
    <div id ='AStatus'> 

      <?php echo $applicants; ?> 

      </div>

<?php

  }

  if($user->hasPermission('instructor')) {

    ?>
    <h2><u>All Classes and TAs</u></h2>
    <button id="hide3">Hide</button>
    <button id="show3">Show</button> 

    <br>
    <div id ='ClassTA'> 
  
     <?php  echo $allClasses ; ?> 

     </div>
  <?php   
  
  }

 

} else {
  echo 'You need to <a href="login.php">log in</a> or <a href="register.php">register</a>';
}







if($user->hasPermission('admin')) { // in the future admin can add delete or update classes
  
  
    
  }



?>

</div>



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#hide").click(function(){
        $("#hiring").hide();
    });
    $("#show").click(function(){
        $("#hiring").show();
    });
    $("#hide2").click(function(){
        $("#AStatus").hide();
    });
    $("#show2").click(function(){
        $("#AStatus").show();
    });
    $("#hide3").click(function(){
        $("#ClassTA").hide();
    });
    $("#show3").click(function(){
        $("#ClassTA").show();
    });

    $("#navProfile").hover(function(){
        $("#navProfile").css("color", "red");
        },function(){
        $("#navProfile").css("color", "blue");
    });
    $("#navHome").hover(function(){
        $("#navHome").css("color", "red");
        },function(){
        $("#navHome").css("color", "blue");
    });
    $("#navApply").hover(function(){
        $("#navApply").css("color", "red");
        },function(){
        $("#navApply").css("color", "blue");
    });
    $("#navLogout").hover(function(){
        $("#navLogout").css("color", "red");
        },function(){
        $("#navLogout").css("color", "blue");
    });
});
</script>

