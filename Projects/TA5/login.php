<!-- if you select remember a cookie will be stored and you will be loggin in automatically on returning unless you logged out. -->

<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" type="text/css" href="TA4.css">
  <meta charset="UTF-8">
  <title>TA Application Login</title>
</head>

<body>


  <ul id= 'nav'>
    <li><a href="./TA4.php">Home</a></li>

  </ul>
  <br/>
  <br>
  


  <div id= 'signup'>

  

    <?php
    require 'core/init.php';



    if(Input::exists()) {
      if(Token::check(Input::get('token'))) {
        $user = new User();

        $remember = (Input::get('remember') === 'on') ? true : false;
        $login = $user->login(Input::get('username'), Input::get('password'), $remember);

        if($login) {
          Redirect::to('index.php');
        } else {
          echo '<p>Sorry, that username and password wasn\'t recognised.</p>';
        }
      }
    }

    ?>


    <h2 > Welcome to the TA Application Login</h2>
    <br>

    <form action="" method="post">

      <table>

        <tr><td><label for="username">User Name:</label></td>
        <td><input type="text" size="20" name="username" value = "newguy" required/></td></tr>

        <tr><td><label for="password">Password:</label></td>
        <td><input type="password" size="20" name="password" required/></td></tr>

     
      </table>
  
  <br>
      <div class="field">
        <label for="remember">
        <input type="checkbox" name="remember" id="remember"> Remember me
        </label>
      </div>
  <br>
        <input type="submit" value="Log in">
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

      

    </form>

  </div>

