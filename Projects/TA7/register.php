
<?php
require_once 'core/init.php';
$eMessage =''; 

//As an extra layer of security we call the validate function, which checks the data being sent in 
// we also handle the password validity, password1 must match password2 before salting and hashing.

if (Input::exists()) {

  if(Token::check(Input::get('token'))) {

    $validate = new Validate();
    $validation = $validate->check($_POST, array(
      'name' => array(
          'required' => true,
          'min' => 2,
          'max' => 45
        ),
      'username' => array(
          'required' => true,
          'min' => 2,
          'max' => 20
          
        ),

      'email' => array(
          'required' => true,
          'min' => 3,
          'max' => 20
          
        ),
      'password1' => array(
          'required' => true,
          'min' => 6
        ),
      'password2' => array(
            'required'=> true,
            'matches' => 'password1'
        )
  ));



//if the validation passes we will create a new user here.

// useing the escape function to sanitize the form data with  
/*function escape($string) {
  return htmlentities($string, ENT_QUOTES, 'UTF-8');
}*/

  if($validation->passed()) {
     $user = new User();

     $salt = Hash::salt(32); //get a salt from our hash function

     try {

        $user->create(array(

            'username' => escape(Input::get('username')),
            'name' => escape(Input::get('name')),
            'email' => escape(Input::get('email')),
            'password' => Hash::make(Input::get('password1'), $salt),
            'salt' => $salt,
            'role' => 'applicant', //role is default to applicant, must be updated by an admin.
            'group' => 1
          ));

          Session::flash('home', 'You are registered and can now log in!');
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

?>

<!-- 

  Author: Aaron Burrell
  Date: Feb 2015
  
  This is the account sign up page that passes info to be validated and create new user. The front end validation mostly
  matches the backend validation. 
  -->


<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="TA4.css">

<title>Register</title>
</head>
<body>

<ul id= 'nav'>
    <li><a href="index.php">Home</a></li>
    
    </ul>
    <br>
    


<div id="signup">

<h2>Please Fill Out Completely To Register</h2>
<form method="POST" >


<table>

    <tr><td><label for="username">User Name:</label></td>
    <td><input type="text" size="20" name="username" id="username"  placeholder="username" 
     minlength="2" maxlength="20" required/></td></tr>

    <tr><td><label for="name">Full Name:</label></td>
    <td><input type="text" size="20" name="name" id="name" required  
     minlength="2" maxlength="20" placeholder="John Doe" /></td></tr>

    <tr><td><label for="email">email address:</label></td>
    <td><input type="email" size="20" name="email" id="email"  placeholder="login@gmail.com"
    onchange="validate_email(event)"
    required /></td></tr>

    <tr><td><label for="password1">New Password:</label></td>
    <td><input type="password" size="20" name="password1" id="password1" 
     minlength="6" maxlength="50"required/></td></tr>
    
    <tr><td><label for="password2">ReEnter Password:</label></td>
    <td><input type="password" size="20" name="password2" id="password2" 
     minlength="6" maxlength="50"required required/></td></tr>

  
    
    
</table>
<br>
<input id ='submit' type="submit" value="Submit"/>
<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

<br>





</form>


<br>
<form action = "index.php">
<input id ='cancel' type="submit" value="Cancel"/>
</form>


<span style = "color:Blue;"> 
    <?php echo $eMessage; // if password 1 and password 2 don't match an error will show up?> 
</span>
<br>

  

</div>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
$(document).ready(function(){
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

     $("a").hover(function(){
        $("a").css("color", "red");
        },function(){
        $("a").css("color", "blue"); });


    
});

</script>



<script>

//Changed from Jims version to work with the email field.
// This function is applied when the gesistration input is changed,
// thus allowing a custom error message (and if the pattern isn't
// enough, a custom regular expression check could be made as well)
//

function validate_email(event)
{
  var input        = event.target;
  var validity_obj = input.validity;

  input.setCustomValidity("");

  console.log("in validate email");
  
  if (! validity_obj.valid)
    {
      console.log(" regester page is invalid, setting custom message");
      input.setCustomValidity("Please use the following form: username@provider.com ");
    }
  else
    {
      console.log("register page email is valid");
    }
}
     
</script>
 



</body>
</html>




