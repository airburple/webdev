<?php
session_start();
$SessionName = $_SESSION['name'];
  

$message = $_SESSION['message'];



echo <<<END

<!-- 

  Author: Aaron Burrell
  Date: Feb 2015
  
  This is the account sign up page that takes the info and passes along to the signed.php.  
  -->


<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="TA3.css">

<title>Log In</title>
</head>
<body>

<ul>
    <li><a href="main.php">Home</a></li>
    <li><a href="Administration_Course_List.php">Course List</a></li> 
    </ul>
    <br>
    <h1>TA Application Sign Up</h1>






<div id="application">


<h2>Please Fill Out Completely</h2>
<form method="POST" action = "signed.php">


<table>

    <tr><td><label for="applicant_name">Full Name:</label></td>
    <td><input type="text" size="20" name="applicant_name" id="applicant_name"/></td></tr>

    <tr><td><label for="loginname">Login Name:</label></td>
    <td><input type="text" size="20" name="loginname" id="loginname"/></td></tr>

    <tr><td><label for="email">email address:</label></td>
    <td><input type="text" size="20" name="email" id="email"/></td></tr>

    <tr><td><label for="password1">New Password:</label></td>
    <td><input type="password" size="20" name="password1" id="password1"/></td></tr>
    
    <tr><td><label for="password2">ReEnter Password:</label></td>
    <td><input type="password" size="20" name="password2" id="password2"/></td></tr>

    
    
</table>
<br>
<input type="submit" value="Submit"/>

<br>


$message


</form>


<br>
<form action = "main.php">
<input type="submit" value="Cancel"/>
</form>

</div>

</body>
</html>

END;

?>
