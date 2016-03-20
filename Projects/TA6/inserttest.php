  <?php


  include 'burrell_db_config.php';         // has db connection variables for TA_Application user


 
  include 'burrell_db_config.php';         // has db connection variables for TA_Application user


  try
  {
    //
    // get the hire status for this user.
    //
    
    
    //
    // Connect to the data base and select it.
    //
    $db = new PDO("mysql:host=$server_name;dbname=$db_name;charset=utf8", $db_user_name, $db_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


  $query = $db->query("UPDATE `RealCourse` SET `enrollment`= '3' WHERE `class_number`= '11564';");
  $query2 = $db->query("UPDATE `RealCourse` SET `cap`= '3' WHERE `class_number`= '11564';");
  echo 'test2';

  while ($r = $query->fetch())

      {

        $Status = $r['Status'];
       
      }

       while ($r = $query2->fetch())

      {

        $Status = $r['Status'];
       
      }


  }

  catch (PDOException $ex)
  {
   $Status .= "<p>oops</p>";
    $Status .= "<p> Code: {$ex->getCode()} </p>";
    $Status .=" <p> See: dev.mysql.com/doc/refman/5.0/en/error-messages-server.html#error_er_dup_key";
    $Status .= "<pre>$ex</pre>";

    
  }

//
// Below is the HTML for the application sign up.
//
