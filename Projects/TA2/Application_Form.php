<?php

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
  // The new user query or error message will be stored here as well as user IDs. We first pass along the email address to establish a userID
  //
  $emailresult = "";
  
  //
  // Connect to the data base and select it.
  //
  $db = new PDO("mysql:host=$server_name;dbname=$db_name;charset=utf8", $db_user_name, $db_password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


  //
  // Check to see if an email address has been submitted. 
  //
  if (isset ( $_GET['email'] ))
    {
      $email        = $_GET['email'];
      $fist         = $_GET['first'];
      $address      = $_GET['address'];
      $phone        = $_GET['phone'];
      $new_password = $_GET['new_password'];


      $query =     "
       INSERT INTO User (email)
       VALUES            ('$email')
       ";

      //$emailresult =
      //"<h2> Inserting new row into User Table of DB</h2>
       //<p> This page was called by a form using a GET request </p> ... This was used in debugging in Jim's example. I found it helpfull.
       //<p> The query was: </p>
       //$query<hr/>";

      $statement = $db->prepare( $query );
      $statement->execute(  );
      

      // set up the next quiery using the new user id
    
  
    
      $emailresult .=  "";
    
       
  //
  // Build the query to only return the information from the latest user
  //
  $query =     "
       SELECT * from User where userId=(SELECT userId FROM User ORDER BY userId DESC LIMIT 1 )
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
  $emailresult .= "<h2>Below is your email address and user ID.</h2>
  
  <h2> You may now apply below.</h2>";



  if ( empty( $result ) )
    {
      $emailresult .= "<h2> No Info </h2>";
    }
  else
    {
      $emailresult .= "<table>";
  
      foreach ($result as $row)
  {
    $emailresult .=
        "<tr>"
      .  "<td>" . $row['email'] . "</td><td> "
        
         . $row['userId'] 
        ."</td></tr>";
  }

       $emailresult .=   "</table>";
    }

}

}
catch (PDOException $ex)
{
  $emailresult .= "<p>oops</p>";
  $emailresult .= "<p> Code: {$ex->getCode()} </p>";
  $emailresult .=" <p> See: dev.mysql.com/doc/refman/5.0/en/error-messages-server.html#error_er_dup_key";
  $emailresult .= "<pre>$ex</pre>";

  if ($ex->getCode() == 23000)
    {
      $emailresult .= "<h2> Duplicate Entries not allowed </h2>";
    }
}

//
// Below is the HTML for the application sign up.
//

echo <<<END

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>

  <head>
   <link rel="stylesheet" type="text/css" href="TA2.css">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"/>
    <meta name="author" content="Aaron Burrell"/>

    <title> TA Application Form.</title>
  </head>
  
  <body>


    <ul>
    <li><a href="TA2.html">Home</a></li>
    <li><a href="Administration_Course_List.php">Course List</a></li> 
    </ul>
    <br>
    <h1>TA Application</h1>

   
 <div id="application">

 <h2>New users sign up with your email address here.</h2>
 <br>
<form method="get">
      
      Email Address:<br>
      <input type="text" name="email" >
        <br>
      New Password: <br> 
        <input type="text"name="new_password" >
        <br>
        <br>
      <input type="submit" value="Submit">
    </form>
      
    $emailresult
  <br>  


 <h2> Existing users may apply here.</h2>

  <form action ="TA2.php" method "get">
  <br>  
    First Name:<br>
      <input type="text" name="first" >
      <br>
      Last Name:<br>
      <input type="text" name="last" >
      <br>
       Address:<br>
      <input type="text" name="address" >
      <br>
      Phone Number:<br>
      <input type="text" name="phone" >
      <br>
      User ID:<br>
      <input type="text" name="userID2" >
      <br>
      Password:<br>
      <input type="text" name="password2" >
      <br>
    
   <h2> Which course would you like to add to your application? Please add one course at a time.</h2>

    <br>
    <br>
    <a href="Administration_Course_List.php">Click here to see available courses.</a></li>

    <br>
    
    Course Name:<br>
      <input type="text" name="coursename" >
      <br>
    Course Semester:<br>
      <input type="text" name="phonenumber" >
      <br>
      When did you take this course? (Semester/Year):<br>
      <input type="text" name="whentaken"> 
      <br>
      What was your grade:<br>
      <input type="text" name="grade" >
      <br>

      <br>

      <input type="submit" value="Submit">
    </form> 

 <br>
 
</div>

END;

?>
