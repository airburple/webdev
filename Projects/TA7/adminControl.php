<?php
require 'core/init.php';
	header('Content-Type: text/xml');
	echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';

	echo '<response>';
		$course=$_GET['course'];
		$courseArray = array('math','english','french','spanish','art');

		$application = new Application();
		$allStudentsArray = Application::getApplicationsByClassNumber($course);

		$x= count($allStudentsArray);
		$y=0;
		if ($course=='')
		 echo "Enter course";
	

	while ($y<$x)

	{
		
		
		// $name = $results[$x-1]->coursename ;
		// $grade = $results[$x-1]->grade ;
		// $SemA = $results[$x-1]->semesterApplying;
		// $SemT = $results[$x-1]->semesterTaken ;
		// $CID = $results[$x-1]->cid ;
		// $stat = $results[$x-1]->status ;

		echo $allStudentsArray[$y];
	
		$y++;
	}

		// if (in_array($course,$allStudentsArray)) {
		// 	echo "We do have ".$course;
		
		// } else {
		// 	echo	"Sorry, we do not have ".$course;
		// }

	echo '</response>';
?>