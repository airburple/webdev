<?php
require 'core/init.php';

// on this page we validate inout and send it along to the db, if there are applications in the db they are posted below the form.


$user = new User();
$application = new Application();
$allApplications = Application::getApplication($user->data()->id); // get and store a table of all our applications
$eMessage ='';
$usersId = $user->data()->id;
$usersName = $user->data()->name;

$list = Course::getCoursesHiring(); 




if (Input::exists()) {

  if(Token::check(Input::get('token'))) {

    $validate = new Validate();
    $validation = $validate->check($_POST, array(
      'applicant_name' => array(
        'required' => true,
        'min' => 2,
        'max' => 45
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

// useing the escape function to sanitize the form data with  
/*function escape($string) {
  return htmlentities($string, ENT_QUOTES, 'UTF-8');
}*/
$application->createApplication(array(

  'username'   =>  escape(Input::get('applicant_name')),  
  'userID'       => $usersId,
  'coursename'     => escape(Input::get('coursename')),
  'grade'        => escape(Input::get('grade')),
  'semesterTaken'    => escape(Input::get('semesterTaken')),
  'semesterApplying'   => escape(Input::get('semesterApplying')),
  'cid'        => escape(Input::get('cid')),
  'status'       =>'pending'


  ));

Session::flash('home', 'Your application has been submitted!');
header('Location: index.php');

} 
catch(Exception $e) {
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
    <li><a id = "navProfile" href="profile.php?user=<?php echo escape($user->data()->username); ?>"><?php echo escape($user->data()->username); ?></a><li>
      <li><a id = "navLogout" href="logout.php">Log out</a></li>
      <li><a id = "navCourse" href="course_update.php">View Courses Hiring</a></li>
      <li><a id = "navHome" href="index.php">Home</a></li>
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
          <td><input type="text" size="20" name="applicant_name" id="applicant_name" 
            required   minlength="3" maxlength="20" value= "<?php echo $usersName ; ?>" ></td></tr>

            <tr><td><label for="coursename">Course Name:</label></td>
              <td><input type="text" size="20" name="coursename" id="coursename" 
               minlength="3" required value="Drawing"> </td></tr>

               <tr><td><label for="grade">Grade:</label></td>
                <td><input type="text" size="20" name="grade" id="grade" required 
                 minlength="1" maxlength="2" value="A"></td></tr>

                 <tr><td><label for="semesterTaken">Semester Course Was Taken:</label></td>
                  <td><input type="text" size="20" name="semesterTaken" id="semesterTaken" 
                   minlength="6" maxlength="15" required value="Summer 2014"></td></tr>

                   <tr><td><label for="semesterApplying">Semester You Are Applying:</label></td>
                    <td><input type="text" size="20" name="semesterApplying" id="semesterApplying" required
                      minlength="6" maxlength="15" value="Summer 2015"></td></tr>

                      <tr><td><label for="cid">Course Id :</label></td>
                        <td><input type="number" size="20" name="cid" id="cid" 
                         min="1" max="1000000"  required value="4"></td></tr>


                         <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

                       </table>
                       <br>


                       <input  id = "submit"type="submit" value="Submit"/>


                       <br>


                     </form>
                     <form action = "index.php">
                      <input id = "cancel" type="submit" value="Cancel"/>
                    </form>
                    <br>
                    <br>



                    <span style = "color:Blue;"> 
                      <?php echo $eMessage; ?>
                    </span>
                    <br>

                    <h2><u> Show Classes Hiring</u></h2>

                    <button id="show">Show</button> 
                    <button id="hide">Hide</button>

                    <br>
                    <div  id ='hiring'>

                      <?php echo $list; // everyone logged in can see the course list but only amins can see applicants. ?> 

                    </div>


                    <h2><u> Show All Submitted Applications</u></h2>

                    <button id="show2">Show</button> 
                    <button id="hide2">Hide</button>

                    <br>
                    <div  id ='myaps'>

                     <?php echo  $allApplications; ?>  <!-- display all applications table -->

                   </div>



                 </div>



                 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
                 <script>
                  $(document).ready(function(){
                    $("#hide").click(function(){
                      $("#hiring").hide();
                    });
                    $("#show").click(function(){
                      $("#hiring").show();
                    });
                    $("#hide2").click(function(){
                      $("#myaps").hide();
                    });
                    $("#show2").click(function(){
                      $("#myaps").show();
                    });

                    $("#submit").hover(function(){
                      $("#submit").css("background-color", "green");
                    },function(){
                      $("#submit").css("background-color", "white");
                    });

                    $("#cancel").hover(function(){
                      $("#cancel").css("background-color", "red");
                    },function(){
                      $("#cancel").css("background-color", "white");
                    });

                    $("#navProfile").hover(function(){
                      $("#navProfile").css("color", "red");
                    },function(){
                      $("#navProfile").css("color", "blue");
                    });
                    $("#navHome").hover(function(){
                      $("#navHome").css("color", "red");
                    },function(){
                      $("#navHome").css("color", "blue");
                    });
                    $("#navCourse").hover(function(){
                      $("#navCourse").css("color", "red");
                    },function(){
                      $("#navCourse").css("color", "blue");
                    });
                    $("#navLogout").hover(function(){
                      $("#navLogout").css("color", "red");
                    },function(){
                      $("#navLogout").css("color", "blue");
                    });
                  });
</script>

</body>
</html>