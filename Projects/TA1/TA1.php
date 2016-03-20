<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="TA1.css">
  <meta charset="UTF-8">
  <title>TA Application</title>
</head>

<body>
  

  <ul>
    <li><a href="./Application_Form.html">    Application Home</a></li>
    <li><a href="Application_Status.html">Check Application Status</a></li>
    </ul>
  <br>
  <h1>University of Utah TA Application</h1>
  <div id="name">

<h2>Thank you <?php echo $_GET["first"];?> <?php echo $_GET["lastname"];?>.<h2>
<h2>Your application for <?php echo $_GET["course"];?> has been submitted!<h2>
<h2>Your grade for the course was <?php echo $_GET["grade"];?>.<h2> 
We'll be in touch.

   <div/>

</body>
</html>
