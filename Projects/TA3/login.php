
<?php
session_start();


$message = $_SESSION['message'];


echo <<<END

<!-- 

  Author: Aaron Burrell
  Date: Feb 2015
  
  This is the login page that takes a username and password the info is passed along to the authenticator.  
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
    <h1>TA Application Login</h1>






<div id="application">
<h2>Please Log In Here</h2>
<form method="POST" action = "logged.php">


<table>
<tr><td><label for="login">Login Name:</label></td>
    <td><input type="text" size="20" name="login" id="login"/></td></tr>
    
<tr><td><label for="password">Password:</label></td>
    <td><input type="password" size="20" name="password" id="password"/></td></tr>
    
</table>
<br>
<input type="submit" value="Submit"/>

<br>


$message


</form>
<br>



</div>

</body>
</html>

END;

?>
