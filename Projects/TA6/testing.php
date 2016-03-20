<?php

require('functions/functions.php');
require_once 'core/init.php';


	$enrollcat =  $_GET["enrollcatnum"];
    $enrollsec =  $_GET["enrollsec"];
    $enrollyear =  $_GET["enrollyear"];
    $enrollsem =  $_GET["enrollsemester"];
    $enrolldept =  $_GET["enrolldept"];
    

    echo  $enrollcat ; 
    echo  $enrollsec ;
    echo  $enrollyear ;
    echo  $enrolldept ;
    echo  $enrollsem ;



if ($enrollcat ==='104')
	echo 'true';
    ?>

