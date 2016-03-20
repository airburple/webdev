  <?php
  session_start();

  $sessionName = $_SESSION['name'];
  $sessionLogin = $_SESSION['login'];
  $Status = ""; // will store Hiring status from db. or error message
    /**
     * Author: Aaron Burrell
     * Date: Feb 2015
     * This PDO portion follows the example of H. James de St. Germain's code in PDO class example.
     * This is the page that takes an email and assigns a user ID, it also posts user ID's next to emails alread in the system,
     *once you have a user ID is assigned you may move on to apply for a course. In the future I will not display all email addresses publicly, 
     *I am showing them for the purpose of this assignment only to showcase the database info.
     */

  include 'burrell_db_config.php';         // has db connection variables for TA_Application user


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


  $query = $db->query("SELECT * FROM User where login = '$sessionLogin'");

  while ($r = $query->fetch())

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

//
// Below is the HTML for the application sign up.
//

echo <<<END

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>

  <head>
   <link rel="stylesheet" type="text/css" href="TA3.css">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"/>
    <meta name="author" content="Aaron Burrell"/>

    <title> TA Applicant Home.</title>
  </head>
  
  <body>


    <ul>
    <li><a href="ApplicantHome.php">Applicant Home</a></li>
    <li><a href="Administration_Course_List.php">Course List</a></li> 
    
    </ul>
    <br>
    <h1>TA Application</h1>

   
 <div id="application">



 <h2> Welcome  $sessionName .</h2>

<a href="TA_Application_Form.php">Start New Application</a>
<br>
Current Application Status: <br><br>  $Status 

 <br>
<a href="LogOut.php">Logout</a>


END;

?>
