<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" type="text/css" href="TA4.css">
  <meta charset="UTF-8">
  <title>TA Application Courses</title>
</head>

<body>

<?php
require 'core/init.php';
$user = new User();

// use our get/to string methods from the Course class 
//to return a string containing an updated course hiring list and applicant list from our Course class.
$list = '';//Course::getCoursesHiring(); 
$applicants = '';//Course::getApplicants();
$allClasses = Course::getClassInfo();
// $database = DB::getInstance();
// $classtotal= $database->count('RealCourse',array('year','=','2015')); 


if($user->isLoggedIn()) {
  ?>
  
  
  <br>
  <ul id= 'nav'>
    <li> <a id = 'navProfile'  href="profile.php?user=<?php echo escape($user->data()->username); ?>"><?php echo escape($user->data()->username); ?></a><li>
    <li><a  id = 'navLogout'   href="logout.php">Log out</a></li>
    <li><a  id = 'navHome'     href="index.php">Home</a></li>
    <li><a  id = 'navApply'    href="apply.php">Start or Resume Application</a></li>
  </ul>

  <div id='courses'>
<!-- 
 <h2><u>Classes Hiring</u></h2>
 <button id="hide">Hide</button>
 <button id="show">Show</button>  -->


<!-- <br>
  <div id ='hiring'>
  
  <?php //echo $list; // everyone logged in can see the course list but only amins can see applicants. ?> 

  </div> -->

  <?php

  if($user->hasPermission('admin')) {
     // echo 'admin';
    
    ?>
    <div class = 'hidden' >
    <h2><u>Course List</u></h2>
    <button id="hide2">Hide</button>
    <button id="show2">Show</button> 
    </div>
    
    

    <br>
    <div id ='AStatus' class = 'hidden' > 

    

      <?php  echo $allClasses ; ?> 

    
    </div>

<?php

  }

  if($user->hasPermission('instructor')) {

    ?>
    <!-- <h2><u>All Classes and TAs</u></h2>
    <button id="hide3">Hide</button>
    <button id="show3">Show</button> 
 -->
    <br>
    <div id ='ClassTA'> 
  
     

     </div>
  <?php   
  
  }

 

} else {
  echo 'You need to <a href="login.php">log in</a> or <a href="register.php">register</a>';
}







if($user->hasPermission('admin')) { // in the future admin can add delete or update classes
  
  
    
  }



?>

</div>



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>


var rowCount  = $('#CourseTable tr').length;
var rowCount2 = $('#CourseTable tr').length;

$('table tbody td').not('.parent').hide();
$('tr:not(:first)').hide();



$(document).ready(function(){
    

    $("div").removeClass("hidden").delay(4000);

    

    

    $("#hide").click(function(){
        $("#hiring").hide();
    });
    $("#show").click(function(){
        $("#hiring").show();
    });
    $("#hide2").click(function(){
        $("#AStatus").hide();
    });
    $("#show2").click(function(){
        $("#AStatus").show();
    });
    $("#hide3").click(function(){
        $("#ClassTA").hide();
    });
    $("#show3").click(function(){
        $("#ClassTA").show();
    });


    $("td").click(function(){
        $(this).siblings().show();

        $(this).next().next().val("test");

        <?php  




        ?>
    });



    $(".spring2015button").click(function(){
        $(".spring2015").toggle();
    });

     $(".spring2014button").click(function(){
        $(".spring2014").toggle();
    });

      $(".spring2013button").click(function(){
        $(".spring2013").toggle();
    });

       $(".spring2012button").click(function(){
        $(".spring2012").toggle();
    });

        $(".spring2011button").click(function(){
        $(".spring2011").toggle();
    });

         $(".spring2010button").click(function(){
        $(".spring2010").toggle();
    });

          $(".spring2009button").click(function(){
        $(".spring2009").toggle();
    });

           $(".spring2008button").click(function(){
        $(".spring2008").toggle();
    });



    $(".fall2015button").click(function(){
        $(".fall2015").toggle();
    });

     $(".fall2014button").click(function(){
        $(".fall2014").toggle();
    });

      $(".fall2013button").click(function(){
        $(".fall2013").toggle();
    });

       $(".fall2012button").click(function(){
        $(".fall2012").toggle();
    });

        $(".fall2011button").click(function(){
        $(".fall2011").toggle();
    });

         $(".fall2010button").click(function(){
        $(".fall2010").toggle();
    });

          $(".fall2009button").click(function(){
        $(".fall2009").toggle();
    });

           $(".fall2008button").click(function(){
        $(".fall2008").toggle();
    });
    

    $(".summer2015button").click(function(){
        $(".summer2015").toggle();
    });

     $(".summer2014button").click(function(){
        $(".summer2014").toggle();
    });

      $(".summer2013button").click(function(){
        $(".summer2013").toggle();
    });

       $(".summer2012button").click(function(){
        $(".summer2012").toggle();
    });

        $(".summer2011button").click(function(){
        $(".summer2011").toggle();
    });

         $(".summer2010button").click(function(){
        $(".summer2010").toggle();
    });

          $(".summer2009button").click(function(){
        $(".summer2009").toggle();
    });

           $(".summer2008button").click(function(){
        $(".summer2008").toggle();
    });
    
    
    
    
        
  

    
      
    //   $("#show4").click(function(){

    //   while (rowCount2 > 0) {
    //   $(".rowcount2").show();
    //   rowCount2--;
    // }
    // });
      
    
   
    


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
    $("#navApply").hover(function(){
        $("#navApply").css("color", "red");
        },function(){
        $("#navApply").css("color", "blue");
    });
    $("#navLogout").hover(function(){
        $("#navLogout").css("color", "red");
        },function(){
        $("#navLogout").css("color", "blue");
    });
});
</script>

