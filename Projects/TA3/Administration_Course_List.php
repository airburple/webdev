<?php

session_start();




$homeurl = 'main.php'; //set home to be applicant home or admin home etc default is main.

If ( $_SESSION['role'] === 'applicant')
  {
  
  $homeurl = 'ApplicantHome.php';
  }

  else If ( $_SESSION['role'] === 'instructor')
  {
 
  $homeurl= 'instructor_home.php';
  }

  else If ( $_SESSION['role'] === 'admin')
  {
  
  $homeurl = 'admin_home.php';
  }

  else{
    
    $homeurl = 'main.php';
    
  }


  /**
   * Author: Aaron Burrell This queries the database for the course list and makes a nice table of the courses.
   */

include 'burrell_db_config.php';         // has db connection variables for TA_Application user


try
{
  //
  // The new user query or error message will be stored here as well as user IDs. We first pass along the email address to establish a userID
  //
  $courseresult = "";
  
  //
  // Connect to the data base and select it.
  //
  $db = new PDO("mysql:host=$server_name;dbname=$db_name;charset=utf8", $db_user_name, $db_password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

 
  //
  // Build the query to only return the information from the latest user
  //
  $query =     "
       SELECT * FROM Course where semester = 'Su 2015' and TAneeded > '0' ;
   ";

  //
  // Prepare and execute the query
  //
  $statement = $db->prepare( $query );
  $statement->execute(  );

  //
  // If successful a unique email address will be given a userId, which is auto incremented on the DB.
  //
  $result    = $statement->fetchAll(PDO::FETCH_ASSOC);

  //
  // Build the web page for the results
  //
  $courseresult .= "<h2>Here are all the classes Hiring for Summer 2015.</h2>";



  
      $courseresult .= "<table><tr>
        <td><b>Department</b></td>
        <td><b>Number</b></td>
        <td><b>Name</b></td> 
        
         </tr>";


  
      foreach ($result as $row)
  
    $courseresult .=

   
        
          "<tr>" .  "<td>" . $row['dept'] . "</td> ".  "<td>" . $row['number'] . "</td><td> " . $row['coursename']  ."</td></tr>";
  

       $courseresult .=   "</table>";
}



catch (PDOException $ex)
{
  $courseresult .= "<p>oops</p>";
  $courseresult .= "<p> Code: {$ex->getCode()} </p>";
  $courseresult .=" <p> See: dev.mysql.com/doc/refman/5.0/en/error-messages-server.html#error_er_dup_key";
  $courseresult .= "<pre>$ex</pre>";

}

//
// Below is the HTML for the course list sign up.
//

echo <<<END

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="TA3.css">
  <meta charset="UTF-8">
  <title>TA Application</title>
</head>

<body>


  <ul>
    <li><a href="$homeurl">Home</a></li>
    <li><a href="user_sign_up.php">Sign Up</a></li>
    
    </ul>
  <br>
  <h1>University of Utah Course List</h1>
  <div id="name">
$courseresult

      <div/>

      </body>

</html>

END;

?>
