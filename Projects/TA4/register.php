
<?php
require_once 'core/init.php';

//call the validate function if input exists and submit it.

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

  if($validation->passed()) {
     $user = new User();

     $salt = Hash::salt(32); //get a salt from our hash function

     try {

        $user->create(array(

            'username' => Input::get('username'),
            'name' => Input::get('name'),
            'email' => Input::get('email'),
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
        echo $error, '<br>';
            }
      }
    }

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

<title>Log In</title>
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
    <td><input type="text" size="20" name="username" id="username"/></td></tr>

    <tr><td><label for="name">Full Name:</label></td>
    <td><input type="text" size="20" name="name" id="name"   /></td></tr>

    <tr><td><label for="email">email address:</label></td>
    <td><input type="text" size="20" name="email" id="email"  /></td></tr>

    <tr><td><label for="password1">New Password:</label></td>
    <td><input type="password" size="20" name="password1" id="password1"/></td></tr>
    
    <tr><td><label for="password2">ReEnter Password:</label></td>
    <td><input type="password" size="20" name="password2" id="password2"/></td></tr>

  
    
    
</table>
<br>
<input type="submit" value="Submit"/>
<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

<br>





</form>


<br>
<form action = "index.php">
<input type="submit" value="Cancel"/>
</form>

</div>

</body>
</html>




