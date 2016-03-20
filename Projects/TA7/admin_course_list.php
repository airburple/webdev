




<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" type="text/css" href="TA4.css">
  <meta charset="UTF-8">
  <title>TA Admin Course List</title>
</head>

<body>


  <ul id= 'nav'>
    <li><a href="index.php">Home</a></li>

  </ul>
  <br/>
  <br>
  


  <div id= 'courses'>



    <h2 > Welcome to the Admin Course Schedule Page</h2>
    <br>

    <form action="scrape_course.php" method="get">


      <select name="semester">
       <option value="spring">Spring</option>
       <option value="summer">Summer</option>
       <option value="fall">Fall</option>
     

      </select>

      <select name="year">
      <option value="2015"> 2015</option>      
      <option value="2014"> 2014</option>
      <option value="2013"> 2013</option>
      <option value="2012"> 2012</option>
      <option value="2011"> 2011</option>
      <option value="2010"> 2010</option>
      <option value="2009"> 2009</option>
      <option value="2008"> 2008</option>

      </select>
      <select name="dept">
      <option value="1"> CS</option>      
      <option value="2"> MATH</option>
      <option value="FA"> FA</option>
      <option value="ITAL"> ITAL</option>
      <option value="EAE"> EAE</option>
      <option value="COMM"> COMM</option>
      <option value="CHEM"> CHEM</option>
      <option value="HIST"> HIST</option>

      </select>
     
  
  
      
  
        <input type="submit" value="Update Courses to DB">
        <!-- <input type="hidden" name="token" value="<?php //echo Token::generate(); ?>"> -->

      


    </form>



  </div>


