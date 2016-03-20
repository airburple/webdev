  <?php
  session_start();
  $_SESSION['role'] = '' ;
  $_SESSION['message'] ='';

  include 'burrell_db_config.php'; 

  //$_SESSION['userId'] ; // store this users id.
  //$message = $_SESSION['message'];

  try
  {
    //
    // The new user query or error message will be stored here as well as user IDs. We first pass along the email address to establish a userID
    //
    $Signupresult = "";
    
    //
    // Connect to the data base and select it.
    //
    $db = new PDO("mysql:host=$server_name;dbname=$db_name;charset=utf8", $db_user_name, $db_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


   $cryptedPW1         = '1';
   $cryptedPW2         = '2';

    //
    // Check to see if a email address has been submitted. 
    //
    if (isset ( $_POST['password1'], $_POST['email'], $_POST['loginname'], $_POST['applicant_name'] ))
    {
      



      $applicant_name     = $_POST['applicant_name'];
      $loginname          = $_POST['loginname'];
      $email              = $_POST['email'];
      $cryptedPW1         = crypt($_POST['password1'],'sa');
      $cryptedPW2         = crypt($_POST['password2'],'sa');

      $_SESSION['userId'] = '' ;
      $_SESSION['name'] = $applicant_name ;

    }
    else {

      $_SESSION['message'] ='sign up failed';

      header ('Location: Account_Sign_Up.php');
    }



      if($cryptedPW1===$cryptedPW2)
      {

      $query =     "
      INSERT INTO User (name, email, login ,password, role)
      VALUES            ('$applicant_name','$email','$loginname','$cryptedPW1', 'applicant')
      ";

  //default role is applicant forTA3

      $statement = $db->prepare( $query );
      $statement->execute(  );


      

      

    //
    // Build the query to only return all the applications submited from this user.
    //
      $query =     "
      SELECT * from User where login = '$loginname' 
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

      $Signupresult = '';
    
      $Signupresult .= "<h2>Please Record Your UserId Number.</h2>";



      if ( empty( $result ) )
      {
         $Signupresult .= "<h2> Nothing Submitted </h2>";
      }
      else
      {
         $Signupresult .= "<table><tr>
        <td><b>UserID</b></td>
        <td><b>Full Name</b></td>
        <td><b>Email</b></td> 
        <td><b>Login Name</b></td> 
        

      </tr>";



      foreach ($result as $row)
      {
        $Signupresult .=



        "<tr>" .  "<td>" . $row['userId'] . "</td> ".  "<td>" . $row['name'] . "</td><td> " . $row['email']  ."</td>" .
                  "<td>" . $row['login'] ."</td></tr>" ;
      }

       $Signupresult .=   "</table>";
       $_SESSION['role'] = 'applicant' ;

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
       $_SESSION['message'] = "<h2> Sign Up Failed </h2>";
       header ('Location: Account_Sign_Up.php');
    }
  }

echo <<<END

<!-- 

  Author: Aaron Burrell
  Date: Feb 2015
  
  This is the results page for a user sign up.  
  -->


<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="TA3.css">

<title>Signed Up</title>
</head>
<body>

<ul>
    <li><a href="main.php">Home</a></li>
    <li><a href="Administration_Course_List.php">Course List</a></li> 
    </ul>
    <br>
    <h1>Welcome $applicant_name!</h1>






<div id="application">

 $Signupresult

<br>
<br>

<a href="ApplicantHome.php">Start Applying!</a>









<br>



</div>

</body>
</html>

END;

?>
