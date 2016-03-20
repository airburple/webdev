<?php

  /**
   * Author:Aaron Burrell using template from PDO example  H. James de St. Germain
   * Date: Feb 2015
   *
   *  This is the application response page displaying what was added to the database and all users info
   *
   * 
   */

include 'burrell_db_config.php';         // contains db connection variables


try
{
  //
  // The main content of the page will be in this variable
  //
  $output = "";
  
  //
  // Connect to the data base and select it.
  //
  $db = new PDO("mysql:host=$server_name;dbname=$db_name;charset=utf8", $db_user_name, $db_password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


  //
  // Check to see if a new addition has been requested then store all the info passed from before
  //
  if (isset ( $_GET['first'] ))
    {
      $email        = $_GET['email'];
      $first         = $_GET['first'];
      $last         = $_GET['last'];
      $address      = $_GET['address'];
      $phone        = $_GET['phone'];
      $password     = $_GET['password2'];
      $userId       = $_GET['userID2'];
      $coursename   = $_GET['coursename'];
      $semester     = $_GET['semester'];
      $whentaken    = $_GET['whentaken'];
      $grade        = $_GET['grade'];
      
      $query =     "
       INSERT INTO User_Info (userId, version, firstName, lastname, password, phone, address)
       VALUES           ('$userId', '1', '$first', '$last', '$password', '$phone', '$address') 
       ";

      

      $statement = $db->prepare( $query );
      $statement->execute(  );
      
    }
  else
    {
      $output .=  "<h2> Here is a List of all applicants info</h2>";
    }

  //
  // Build the basic query
  //
  $query =     "
        SELECT * from User_Info where userId=(SELECT userId FROM User_Info ORDER BY userId DESC LIMIT 1 )
   ";

  //
  // Prepare and execute the query
  //
  $statement = $db->prepare( $query );
  $statement->execute(  );

  //
  // Fetch all the results
  //
  $result    = $statement->fetchAll(PDO::FETCH_ASSOC);

  //
  // Build the web page for the results
  //
  

  if ( empty( $result ) )
    {
      $output .= "<h2> No Info </h2>";
    }
  else
    {
      $output .= "<table>";
  
      foreach ($result as $row)
  {
    $output .=
         "<tr>
        <th>UserID</th>
        <th>Firstname</th>
        <th>Lastname</th> 
        
         </tr>

        <tr>"
        .  "<td>" . $row['userId'] . "</td><td> "
        .  $row['firstName'] . "</td><td> "
  .  $row['lastname']
        ."</td></tr>";
  }

       $output .=   "</table>";
    }

}
catch (PDOException $ex)
{
  $output .= "<p>oops</p>";
  $output .= "<p> Code: {$ex->getCode()} </p>";
  $output .=" <p> See: dev.mysql.com/doc/refman/5.0/en/error-messages-server.html#error_er_dup_key";
  $output .= "<pre>$ex</pre>";

  if ($ex->getCode() == 23000)
    {
      $output .= "<h2> Duplicate Entries not allowed </h2>";
    }
}

//
// Below is the HTML content
//

echo <<<END

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>

  <head>
  <link rel="stylesheet" type="text/css" href="TA2.css">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"/>
    <meta name="author" content="Aaron Burrell"/>

    <title> Application Accepted</title>
  </head>
  
  <body>

  <ul>
    <li><a href="./Application_Form.php">    Application Home</a></li>
    <li><a href="Application_Status.html">Application Status</a></li>
    </ul>
  <br>
  <h1>Application Submitted<h1>

    <div id="application">
      Here is your application information.
      <br>
      <br>
        $output 
    </div>

  

    


END;

?>