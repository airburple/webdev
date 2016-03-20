   
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
    $database->delete('RealCourse','class_number','>',0);

  //
  // open a socket to the acs web page
  //
    $fp = fsockopen("www.acs.utah.edu", 80, $errno, $errstr, 5);
    $year =  $_GET["year"];
    $semester =  $_GET["semester"];

    
    $dept = 'CS';


    $time = gettranslation($year,$semester);

  //
  // prepare the GET requerst to pull the data.
  //  (simulate a web browser)
  //
    $out = "GET /uofu/stu/scheduling?term=";
    $out .= "$time";
  //$out .= "$sem";
    $out .= "&dept=";
    $out .= "$dept";
    $out .= "&classtype=g HTTP/1.1\r\n";
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

    
   

    $class_number = 0; // instantiating all fields so we can run the preg_replace function on the strings to get rid of spaces and &nbsp; 
   // $dept = '';
    $c_number= '';
    $section = '';
    $component ='';
    $units = '';
    $coursename = '';
    $days = '';
    $time = '';
    $location = '';
    $prof = '';
   // $cap = '';
    //$enrolled ='';

    //$semester and $year are already passed to us. We will need to load a seperate page to get enrollment info.






    // parse through the giant array and gather each course. Once we find a keyword 
    //we know we can gather the rest of that course data from that array number.
    //for each of these cases we need to build the array of fields to send to the DB::Insert

            while ($y < ($z-1))
            { 
                      $temp =$info[$y];

                      // while we parse through the scrapped array search for the trigger ids which are the class compenents like lecture, labrotory, etc.
                if ((strcmp($temp,$lec)===0) || (strcmp($temp,$lab)===0)  || (strcmp($temp,$disc)===0) || (strcmp($temp,$labdisc)===0) || 
                   (strcmp($temp,$fw)===0) || (strcmp($temp,$res)===0) || (strcmp($temp,$st)===0) || (strcmp($temp,$sp)===0) || (strcmp($temp,$seminar)===0) ||   (strcmp($temp,$ind)===0)  )          
                {


                      // echo $y;
                      // echo $temp;  
                      // echo '<br>';
                      // $lec_count ++;


                      $section = escape($info[($y-1)]);
                      $section = preg_replace("/\s|&nbsp;/",'',$section);

                      $class_number = escape($info[($y-4)]);
                      $class_number = preg_replace("/\s|&nbsp;/",'',$class_number);
                      
                      $cat_number= escape($info[($y-2)]);
                      $cat_number = preg_replace("/\s|&nbsp;/",'',$cat_number);

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

                         
                      $fp2 = fsockopen("www.acs.utah.edu", 80, $errno, $errstr, 5);
                      $info2 = array("test2","testtwo2");

                            //
                            // prepare the GET requerst to pull the data.
                            //  (simulate a web browser)
                            //
                      $out2 = "GET /uofu/stu/scheduling/crse-info?term=";
                      $out2 .= "$time";
                      $out2 .= "&subj=CS&catno=";
                      $out2 .= "$cat_number";
                      $out2 .= "HTTP/1.1\r\n";
                      $out2 .= "Host: www.acs.utah.edu\r\n";
                      $out2 .= "Connection: Close\r\n\r\n";

                            //
                            // Send GET request
                            //
                      fwrite($fp2, $out2);

                                  //
                                  // check for success
                                  //
                                   if (!$fp2)
                                   {
                                    $content2 = " offline ";
                                   }
                                  else
                                   {
                                        //
                                        // pull the entire web page and concat it up in a single "page" variable
                                        //
                                      $page2 = "";
                                      while (!feof($fp2))
                                      {
                                        $page2 .= fgets($fp2, 1000);
                                      }
                                      fclose($fp2);

                                      $doc2 = new DOMDocument();
                                      $doc2->loadHTML( $page2 );

                                      $table2 = $doc2->getElementsByTagName('table');
                                      $rows2 = $table2->item(0)->getElementsByTagName('tr');



                                          foreach ($rows2 as $row2)
                                          {
                                            $cells2 = $row2->getElementsByTagName('td');
                                            foreach ($cells2 as $cell2)
                                            {
                                                $info2[]= $cell2->nodeValue;  // push each cell node value into an array for later use.
                                            }
                                
                                           }
      
                                     }
                 


                                    $temp2 ='';
                                    $y2=0;
                                    $z2 = count($info2);



                                            while ($y2 < ($z2-1))
                                           {
                                             $temp2 =$info2[$y2];
                                             $temp3 =$info2[($y2+2)];
                                             echo $temp3;

                                             $temp2 = preg_replace("/\s|&nbsp;/",'',$temp2);
                                               //echo $temp2;



                            
                                                $enrolled = escape($info2[($y2+3)]);
                                                $enrolled = preg_replace("/\s|&nbsp;/",'',$enrolled);


                                                $cap = escape($info2[($y2+2)]);
                                                $cap = preg_replace("/\s|&nbsp;/",'',$cap);


                                                $enrollment_fields = array(

                                                  'class_number'   =>  $class_number,  
                                                  'dept'       => escape($dept),
                                                  'cat_number'     => $cat_number,
                                                  'coursename'        => $coursename,
                                                  'semester'    => escape($semester),
                                                  'year'   => escape($year),
                                                  'units'        => $units,
                                                  'component'        => $component,
                                                  'section'        => $section,
                                                  'days'        => $days,
                                                  'time'        => $time,
                                                  'location'        => $location,
                                                  'semesteryear'  => escape($semester) . escape($year),
                                                  'prof'        => $prof);
                                                 // 'cap'     => $cap,
                                                 // 'enrollment' => $enrolled) ;

                                                $enrollment_fields2 = array(

                                                  
                                                  'semesteryear'  => escape($semester) . escape($year) );
                                                  




                                                  $database->insert('RealCourse', $enrollment_fields);
                                                  $database->insert('semesteryear', $enrollment_fields2);

                                                   $y2++;

                                              }    

                              

                                }
                          $y++;
                        }

               // header('Location: course_update.php');


?>

