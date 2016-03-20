 
<?php

require('functions/functions.php');
require_once 'core/init.php';
include 'burrell_db_config.php';  

  
    $info = array("test","testtwo");
    
    $database = DB::getInstance();
     $enrollcat =  $_GET["enrollcatnum"];
    $enrollsec =  $_GET["enrollsec"];
    $enrollyear =  $_GET["enrollyear"];
    $enrollsem =  $_GET["enrollsemester"];
    $enrolldept =  $_GET["enrolldept"];
    $enrollnum =  $_GET["enrollnum"];

 $time = gettranslation($enrollyear, $enrollsem);
 //echo $time; 


//
// open a socket to the acs web page
//
$fp = fsockopen("www.acs.utah.edu", 80, $errno, $errstr, 5);



//
// prepare the GET requerst to pull the data.
//  (simulate a web browser)
//
$out = "GET /uofu/stu/scheduling/crse-info?term=";
$out.= "$time";
$out .= "&subj=CS&catno=";
$out .= "$enrollcat";
$out .= " HTTP/1.1\r\n";
$out .= "Host: www.acs.utah.edu\r\n";
$out .= "Connection: Close\r\n\r\n";

//
// Send GET request
//
fwrite($fp, $out);

//
// check for success
//
if (!$fp)
  {
    $content = " offline ";
  }
else
  {
    //
    // pull the entire web page and concat it up in a single "page" variable
    //
    $page = "";
    while (!feof($fp))
      {
  $page .= fgets($fp, 1000);
      }
    fclose($fp);

    $doc = new DOMDocument();
    $doc->loadHTML( $page );

    $table = $doc->getElementsByTagName('table');
    $rows = $table->item(0)->getElementsByTagName('tr');

    $content = 0;
    foreach ($rows as $row)
      {
  $cells = $row->getElementsByTagName('td');
  foreach ($cells as $cell)
    {
      $info[]= $cell->nodeValue; 
    }
  
      }
    
  }
    

    $temp ='';
    $y=0;
    $z = count($info);


 while ($y < ($z-1))

 {
    $temp =$info[$y];
    
     $temp = preg_replace("/\s|&nbsp;/",'',$temp);
   // echo $temp;
    echo '<br>';
    if (strcmp($temp,'001')===0||strcmp($temp,'002')===0||strcmp($temp,'003')===0||strcmp($temp,'004')===0||strcmp($temp,'005')===0||
      strcmp($temp,'006')===0||strcmp($temp,'007')===0||strcmp($temp,'008')===0||strcmp($temp,'009')===0||strcmp($temp,'010')===0||
      strcmp($temp,'090')===0) 

    {
      
      $enrolled = escape($info[($y+3)]);
       $enrolled = preg_replace("/\s|&nbsp;/",'',$enrolled);

       $cap = escape($info[($y+2)]);
       $cap = preg_replace("/\s|&nbsp;/",'',$cap);


       $cnum = escape($info[($y-3)]);
       $cnum = preg_replace("/\s|&nbsp;/",'',$cnum);

       echo 'Enrollment for class number '; echo $cnum; echo ' catalogue number '; echo $temp; echo ' has been updated.' ;


      $enrollment_fields = array(


          'cat_number'     => $enrollcat,
          'section'        => $temp,
          'enrollment'  => $enrolled,
          'cap'         => $cap,
          'semester'    => $enrollsem,
          'year'   => $enrollyear,
          'classnumber'   => $cnum,
          'dept'       => "CS");

      $database->insert('Enrollment', $enrollment_fields);



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


  $query = $db->query("UPDATE `RealCourse` SET `enrollment`= $enrolled WHERE `class_number`= $cnum;");
  $query2 = $db->query("UPDATE `RealCourse` SET `cap`= $cap WHERE `class_number`=   $cnum ;");
  //echo 'test2';

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


    }

    




    $y++;
 }






///////////////////////////////////////////////////////////
//
// Build The Web Page
//
//  MVC (Model/Controll above, View below)
//

?>
