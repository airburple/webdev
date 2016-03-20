<?php
session_start();

include 'burrell_db_config.php'; 

$id = $_SESSION['userId'] ; // store this users id.
$message = $_SESSION['message'];

try
{
  //
  // The new user query or error message will be stored here as well as user IDs. We first pass along the email address to establish a userID
  //
  $applicationresult = "";
  
  //
  // Connect to the data base and select it.
  //
  $db = new PDO("mysql:host=$server_name;dbname=$db_name;charset=utf8", $db_user_name, $db_password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


  //
  // Check to see if a userId address has been submitted. 
  //
  if (isset ( $_POST['userId'] ))
  {
    $userId             = $_POST['userId'];
    $applicant_name     = $_POST['applicant_name'];
    $coursename         = $_POST['coursename'];
    $cid                = $_POST['cid'];
    $semesterApplying   = $_POST['semesterApplying'];
    $semesterTaken      = $_POST['semesterTaken'];
    $grade              = $_POST['grade'];



    $query =     "
    INSERT INTO Course_Applied (userId, applicant_name, coursename,cid, semesterApplying, semesterTaken, grade)
    VALUES            ('$userId','$applicant_name','$coursename','$cid','$semesterApplying', '$semesterTaken', '$grade')
    ";



    $statement = $db->prepare( $query );
    $statement->execute(  );


    

    

  //
  // Build the query to only return all the applications submited from this user.
  //
    $query =     "
    SELECT * from Course_Applied where userId = '$id'
    ";

  //
  // Prepare and execute the query
  //
    $statement = $db->prepare( $query );
    $statement->execute(  );

  //
  // 
  //
    $result    = $statement->fetchAll(PDO::FETCH_ASSOC);

  //
  // Build the web page for the results

    $submissionResult = '';
  
    $submissionResult .= "<h2>Below are all your submissions.</h2>";



    if ( empty( $result ) )
    {
       $submissionResult .= "<h2> Nothing Submitted </h2>";
    }
    else
    {
       $submissionResult .= "<table><tr>
      <td><b>UserID</b></td>
      <td><b>Full Name</b></td>
      <td><b>Course Name</b></td> 
      <td><b>Course ID Number</b></td> 
      <td><b>Semester/Year Applying</b></td> 
      <td><b>Semester/Year Taken</b></td> 
      <td><b>Grade</b></td> 

    </tr>";



    foreach ($result as $row)
    {
      $submissionResult .=



      "<tr>" .  "<td>" . $row['userId'] . "</td> ".  "<td>" . $row['applicant_name'] . "</td><td> " . $row['coursename']  ."</td>" .
                "<td>" . $row['cid'] . "</td> ".  "<td>" . $row['semesterApplying'] . "</td><td> " . $row['semesterTaken']  ."</td>". "<td> " . $row['grade']  ."</td></tr>" ;
    }

     $submissionResult .=   "</table>";

  }

  }

}


catch (PDOException $ex)
{
  $result .= "<p>oops</p>";
  $result .= "<p> Code: {$ex->getCode()} </p>";
  $result .=" <p> See: dev.mysql.com/doc/refman/5.0/en/error-messages-server.html#error_er_dup_key";
  $result .= "<pre>$ex</pre>";

  if ($ex->getCode() == 23000)
  {
     $submissionResult .= "<h2> Duplicate Entries not allowed </h2>";
  }
}

echo <<<END

<!-- 

  Author: Aaron Burrell
  Date: Feb 2015
  
  This is the results page for an application.  
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
    <h1>TA Application Submitted</h1>






<div id="application">

 $submissionResult

<br>


$message



<br>



</div>

</body>
</html>

END;

?>
