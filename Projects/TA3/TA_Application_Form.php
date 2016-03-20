<?php
session_start();
$SessionName = $_SESSION['name'];
  

$message = $_SESSION['message'];



echo <<<END

<!-- 

  Author: Aaron Burrell
  Date: Feb 2015
  
  This is the application page that takes the info and passes along to the applied.php.  
  -->


<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="TA3.css">

<title>Log In</title>
</head>
<body>

<ul>
    <li><a href="ApplicantHome.php">Home</a></li>
    <li><a href="Administration_Course_List.php">Course List</a></li> 
    </ul>
    <br>
    <h1>TA Application</h1>






<div id="application">


<h2>Welcome $SessionName, Please Fill Out Completely</h2>
<form method="POST" action = "applied.php">


<table>
<tr><td><label for="userId">UserID:</label></td>
    <td><input type="text" size="20" name="userId" id="userId"/></td></tr>

    <tr><td><label for="applicant_name">Full Name:</label></td>
    <td><input type="text" size="20" name="applicant_name" id="applicant_name"/></td></tr>

    <tr><td><label for="coursename">Course Name:</label></td>
    <td><input type="text" size="20" name="coursename" id="coursename"/></td></tr>

    <tr><td><label for="cid">Course ID Number:</label></td>
    <td><input type="text" size="20" name="cid" id="cid"/></td></tr>

    <tr><td><label for="semesterApplying">Semester/Year Applying:</label></td>
    <td><input type="text" size="20" name="semesterApplying" id="semesterApplying"/></td></tr>
    
    <tr><td><label for="semesterTaken">Semester/Year Taken:</label></td>
    <td><input type="text" size="20" name="semesterTaken" id="semesterTaken"/></td></tr>

    <tr><td><label for="grade">Grade:</label></td>
    <td><input type="text" size="20" name="grade" id="grade"/></td></tr>
    
</table>
<br>
<input type="submit" value="Submit"/>

<br>


$message


</form>


<br>
<form action = "ApplicantHome.php">
<input type="submit" value="Cancel"/>
</form>

</div>

</body>
</html>

END;

?>
