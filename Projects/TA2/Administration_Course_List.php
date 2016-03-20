<?php

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
       SELECT * FROM Course_Info;
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



  
      $courseresult .= "<table>";
  
      foreach ($result as $row)
  
    $courseresult .=
        "<tr>
        <th>Department</th>
        <th>Number</th>
        <th>Name</th> 
        
         </tr>"
         . "<tr>" .  "<td>" . $row['dept'] . "</td> ".  "<td>" . $row['number'] . "</td><td> " . $row['name']  ."</td></tr>";
  

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
  <link rel="stylesheet" type="text/css" href="TA2.css">
  <meta charset="UTF-8">
  <title>TA Application</title>
</head>

<body>


  <ul>
    <li><a href="TA2.html">Home</a></li>
    <li><a href="Application_Form.php">TA Application</a></li>
    <!--An Application Status link will be added later. -->
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
