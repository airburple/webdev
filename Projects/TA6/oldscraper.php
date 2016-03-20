   
<?php
require('functions/functions.php');
require_once 'core/init.php';

    /**
     *    Author: Aaron Burrell
     *    Date:   Spring 2015
     *
     *    This php file opens the UofU web site to pull class data from CS
     *
     *    RESOLVED (I explain how I resolved warnings in paranthasis, from Professor Jim's warnings from his nba scrapper.) 
     *
     *      As with all scraping, this file assumes many things about the
     *    page being scraped.  If any of these change the scraper will have to
     *    be modified.  The following are main areas of concern:
     *
     *    1)  the table of course info is the first table in the document (actually I pulled the 4rth table)
     *    2)  the dept, num, section, name, etc. are in specific columns of a
     *        given table row: 1,2,3,4 (I anchored onto the component of each class and grabbed info around it adjusting left and right.)
     *
     *  A mroe useful page would provide ids for the elements containing the data so
     *  we could pull the info without having to determine rows/cols/etc. 
     *   (I dumped each cell into an array and wrote conditions for the different types of components encountered. )
     */
    $info = array("test","testtwo");
    $x =0;
    $database = DB::getInstance();

  //
  // open a socket to the acs web page
  //
    $fp = fsockopen("www.acs.utah.edu", 80, $errno, $errstr, 5);
    $year =  $_GET["year"];
    $semester =  $_GET["semester"];

    $time = gettranslation($year,$semester);

    

  //
  // prepare the GET requerst to pull the data.
  //  (simulate a web browser)
  //
    $out = "GET /uofu/stu/scheduling?term=";
    $out .= "$time";
  //$out .= "$sem";
    $out .= "&dept=CS&classtype=g HTTP/1.1\r\n";
    $out .= "Host:www.acs.utah.edu\r\n";
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
      $rows = $table->item(4)->getElementsByTagName('tr');

      
      
      foreach ($rows as $row)
      {
        $cells = $row->getElementsByTagName('td');
        foreach ($cells as $cell)
        {
          $info[]= $cell->nodeValue;  // push each cell node value into an array for later use.
          $x++; 
          
        }
        


      }
      
    }
    $temp ='';
    $y=0;
    $z = count($info);


    $lec = "Lecture";   //key words to look for in our parsing
    $lab = "Laboratory";
    $disc = "Discussion";
    $labdisc = "Lab/Discussion";
    $fw = "Field Work";
    $res = "Research";
    $st = "Special Topics";
    $sp = "Special Projects";
    $seminar = "Seminar";
    $ind = "Independent Study";

    
    $lec_count = 0;  // for debuggin and keeping track of what is added.
    $lab_count = 0;
    $disc_count = 0;
    $labdisc_count = 0;
    $fw_count = 0;
    $res_count = 0;
    $st_count = 0;
    $sp_count = 0;
    $seminar_count = 0; 
    $ind_count = 0;

    $class_number = 0;
    $dept = '';
    $c_number= '';
    $section = '';
    $component ='';
    $units = '';
    $coursename = '';
    $days = '';
    $time = '';
    $location = '';
    $prof = '';
    //$semester and $year are already passed to us. We will need to load a seperate page to get enrollment info.






    // parse through the giant array and gather each course. Once we find a keyword 
    //we know we can gather the rest of that course data from that array number.
    //for each of these cases we need to build the array of fields to send to the DB::Insert

    while ($y < ($z-1))
    { 
      $temp =$info[$y];


      if (strcmp($temp,$lec)===0){

        








        echo $y;
        echo $temp;  
        echo '<br>';
        $lec_count ++;
      }

      else if(strcmp($temp,$lab)===0){

        echo $y;
        echo $temp;  
        echo '<br>';
        $lab_count ++;


      }
      else if(strcmp($temp,$disc)===0){

        echo $y;
        echo $temp;  
        echo '<br>';
        $disc_count ++;


      }

      else if(strcmp($temp,$labdisc)===0){

        echo $y;
        echo $temp;  
        echo '<br>';
        $labdisc_count ++;


      }

      else if(strcmp($temp,$fw)===0){

        echo $y;
        echo $temp;  
        echo '<br>';
        $fw_count ++;


      }

      else if(strcmp($temp,$res)===0){

        echo $y;
        echo $temp;  
        echo '<br>';
        $res_count ++;


      }

      else if(strcmp($temp,$st)===0){

        echo $y;
        echo $temp;  
        echo '<br>';
        $st_count ++;


      }

      else if(strcmp($temp,$sp)===0){

        echo $y;
        echo $temp;  
        echo '<br>';
        $sp_count ++;


      }
      
      else if(strcmp($temp,$seminar)===0){

        echo $y;
        echo $temp;  
        echo '<br>';
        $seminar_count ++;


      }

      else if(strcmp($temp,$ind)===0){


        $section = escape($info[($y-1)]);
        $section = preg_replace("/\s|&nbsp;/",'',$section);

        $class_number = escape($info[($y-4)]);
        $class_number = preg_replace("/\s|&nbsp;/",'',$class_number);
        
        $c_number= escape($info[($y-2)]);
        $c_number = preg_replace("/\s|&nbsp;/",'',$c_number);

        $component = escape($info[($y)]);
        $component = preg_replace("/\s|&nbsp;/",'',$component);

        $units = escape($info[($y+1)]);
        $units = preg_replace("/\s|&nbsp;/",'',$units);

        $coursename = escape($info[($y+2)]);
        $coursename = preg_replace("/\s|&nbsp;/",'',$coursename);

        $days = escape($info[($y+3)]);
        $days = preg_replace("/\s|&nbsp;/",'',$days);

        $time = escape($info[($y+4)]);
        $time = preg_replace("/\s|&nbsp;/",'',$time);

        $location = escape($info[($y+5)]);
        $location = preg_replace("/\s|&nbsp;/",'',$location);

        $prof = escape($info[($y+7)]);
        $prof = preg_replace("/\s|&nbsp;/",'',$prof);




       $course_fields = array(

        'class_number'   =>  $class_number,  
        'dept'       => "CS",
        'c_number'     => $c_number,
        'coursename'        => $coursename,
        'semester'    => escape($semester),
        'year'   => escape($year),
        'units'        => $units,
        'component'        => $component,
        'section'        => $section,
        'days'        => $days,
        'time'        => $time,
        'location'        => $location,
        'prof'        => $prof

        );

       $database->insert('RealCourse', $course_fields);

       echo $y;
       echo $temp;  
       echo '<br>';
       $ind_count ++;


     }



      //print_r($info[$y]);

     $y++;

   }
   echo 'lectures: ';
   echo $lec_count;
   echo "<br>";

   echo 'labs: ';
   echo $lab_count;
   echo "<br>";

   echo 'Discussions: ';
   echo $disc_count;
   echo "<br>";

   echo 'lab/discs: ';
   echo $labdisc_count;
   echo "<br>";

   echo 'Field Works: ';
   echo $fw_count;
   echo "<br>";

   echo 'researches: ';
   echo $res_count;
   echo "<br>";

   echo 'Special Topics: ';
   echo $st_count;
   echo "<br>";

   echo 'Special Projects: ';
   echo $sp_count;
   echo "<br>";

   echo 'Seminars: ';
   echo $seminar_count;
   echo "<br>";

   echo 'Ind Study: ';
   echo $ind_count;
   echo "<br>";

   ?>

