<?php
require 'core/init.php';

// on this page we validate inout and send it along to the db, if there are applications in the db they are posted below the form.


$user = new User();
$application = new Application();
$allApplications = Application::getApplication($user->data()->id); // get and store a table of all our applications
$eMessage ='';



if (Input::exists()) {

  if(Token::check(Input::get('token'))) {

    $validate = new Validate();
    $validation = $validate->check($_POST, array(
      'applicant_name' => array(
          'required' => true,
          'min' => 2,
          'max' => 45
        ),
      'userId' => array(
          'required' => true,
          'min' => 1,
          'max' => 20
          
        ),

      'coursename' => array(
          'required' => true,
          'min' => 3,
          'max' => 20
          
        ),
      'grade' => array(
          'required' => true,
          'min' => 1,
          'max' => 2
        ),
      'semesterTaken' => array(
            'required'=> true
            
        ),
      'semesterApplying' => array(
            'required'=> true
            
        ),
      'cid' => array(
            'required'=> true
            
        )

  ));

//if the validation passes we will create a new application here.

  if($validation->passed()) {
     $application = new Application();

    
     try {

        $application->createApplication(array(

            'applicant_name'   =>Input::get('applicant_name'),
            'userId'       =>Input::get('userId'),
            'coursename'     =>Input::get('coursename'),
            'grade'        =>Input::get('grade'),
            'semesterTaken'    =>Input::get('semesterTaken'),
            'semesterApplying'   =>Input::get('semesterApplying'),
            'cid'        =>Input::get('cid'),
            'status'       =>'pending'
            

          ));

          Session::flash('home', 'Your application has been submitted!');
          header('Location: index.php');

      } catch(Exception $e) {
        die($e->getMessage());
      }

    } else {
      foreach($validate->errors() as $error) {
        $eMessage .= $error .'<br>';
            }
      }
    }

}





// check to see if user is logged in.
if($user->isLoggedIn()) {
  ?>
  
  <ul id= 'nav'>
    <li><a href="profile.php?user=<?php echo escape($user->data()->username); ?>"><?php echo escape($user->data()->username); ?></a><li>
    <li><a href="logout.php">Log out</a></li>
    <li><a href="course_update.php">View Courses Hiring</a></li>
    <li><a href="index.php">Home</a></li>
  </ul>



  <?php



  if($user->hasPermission('admin')) {
  ?>
    
    
  <?php
  }

  if($user->hasPermission('instructor')) {
  ?>
    
  <?php
  }

} else {
  echo 'You need to <a href="login.php">log in</a> or <a href="register.php">register</a>!';
}


?>



<!-- 

  Author: Aaron Burrell
  Date: Feb 2015
  
  This is the account sign up page that passes info to be validated and create new user.
  -->


<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="TA4.css">

<title>Apply</title>
</head>
<body>


   
    


<div id="application">
<h2>TA Applications</h2>
<br><br>

<h2>Please Fill Out Completely</h2>
<form  method="POST" >


<table>

    <tr><td><label for="applicant_name"> Full Name</label></td>
    <td><input type="text" size="20" name="applicant_name" id="applicant_name"  value="<?php echo escape(Input::get('applicant_name')); ?>"></td></tr>

    <tr><td><label for="userId">User Id</label></td>
    <td><input type="text" size="20" name="userId" id="userId" value="<?php echo escape(Input::get('userId')); ?>"></td></tr>

    <tr><td><label for="coursename">Course Name:</label></td>
    <td><input type="text" size="20" name="coursename" id="coursename" value="<?php echo escape(Input::get('coursename')); ?>"> </td></tr>

    <tr><td><label for="grade">Grade:</label></td>
    <td><input type="text" size="20" name="grade" id="grade" value="<?php echo escape(Input::get('grade')); ?>"></td></tr>
    
    <tr><td><label for="semesterTaken">Semester Course Was Taken:</label></td>
    <td><input type="text" size="20" name="semesterTaken" id="semesterTaken" value="<?php echo escape(Input::get('semesterTaken')); ?>"></td></tr>

     <tr><td><label for="semesterApplying">Semester You Are Applying:</label></td>
    <td><input type="text" size="20" name="semesterApplying" id="semesterApplying" value="<?php echo escape(Input::get('semesterApplying')); ?>"></td></tr>

     <tr><td><label for="cid">Course Id :</label></td>
    <td><input type="text" size="20" name="cid" id="cid" value="<?php echo escape(Input::get('cid')); ?>"></td></tr>

  
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    
</table>
<br>
<input type="submit" value="Submit"/>


<br>





</form>


<br>

<?php echo $eMessage; ?>
<form action = "index.php">
<input type="submit" value="Cancel"/>
</form>


 
 <?php echo $allApplications; ?>  <!-- display all applications table -->

</div>

</body>
</html>




