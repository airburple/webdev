<?php
class Course {
	public $_db,
	$_sessionName = null,
	$_cookieName = null,
	$_data = array();

	public function __construct($course = null) {
		$this->_db = DB::getInstance();
		
		$this->find($course);
		
	}

	public function exists() {
		return (!empty($this->_data)) ? true : false;
	}

	public function find($course = null) {
		// Check if course_id specified and grab details
		if($course) {
			$field = (is_numeric($course)) ? 'class_number' : 'coursename';
			$data = $this->_db->get('RealCourse', array($field, '=', $course));

			if($data->count()) {
				$this->_data = $data->first();
				return true;
			}
		}
		return false;
	}

	public function createCourse($fields = array()) {
		if(!$this->_db->insert('Course', $fields)) {
			throw new Exception('There was a problem creating an course.');
		}
	}

	public function update($fields = array(), $id = null) {
		if(!$id) {
			$id = $this->data()->id;
		}
		
		if(!$this->_db->update('RealCourse', $id, $fields)) {
			throw new Exception('There was a problem updating course.');
		}
	}

	public function data() {
		return $this->_data;
	}

	public function getCoursesHiring() {

		$courses = DB::getInstance()->get('Course', array( 'TAneeded', '=', 'yes'));
		$results = $courses->all();
		$courseresult .= "<h2>Here are all the classes Hiring.</h2>";


		$courseresult .= "<table><tr>
		<td><b>Department</b></td>
		<td><b>Number</b></td>
		<td><b>Name</b></td> 
		<td><b>Course ID</b></td> 

	</tr>";


	$x= $courses->count();
	$array= array();

	while ($x>0)

	{
		$dep  = $results[$x-1]->dept;
		$num  = $results[$x-1]->number;
		$name = $results[$x-1]->coursename ;
		$cid = $results[$x-1]->cid ;

		$courseresult .=  
		"<tr><td>" . $dep ." </td><td> " . $num . " </td><td> " . $name ." </td><td>"  . $cid  . " </td></tr>";
		$x--;
	}

	$courseresult .=   "</table>";

	return $courseresult;

	

}

public function getApplicants() {

	$Applicants = DB::getInstance()->get('users', array( 'role', '=', 'applicant'));
	$results = $Applicants->all();
	$Applicantresult .= "<h2>Here are all Applicants with current Statuses.</h2>";


	$Applicantresult .= "<table><tr>
	<td><b>ID</b></td>
	<td><b>Name</b></td>
	<td><b>Status</b></td> 

</tr>";


$x= $Applicants->count();


while ($x>0)

{
	$uId  = $results[$x-1]->id;
	$name  = $results[$x-1]->name;
	$stat = $results[$x-1]->Status;

	$Applicantresult .=  
	"<tr><td>" . $uId ." </td><td> " . $name ." </td><td>"  . $stat . " </td></tr>";
	$x--;
}

$Applicantresult .=   "</table>";

return $Applicantresult;

}

public function getClassInfo() {

		
		$date = DB::getInstance()->get('semesteryear', array('id', '>', 0));
		$dateresults = $date->all(); 

		$classresult .= "<h2>Here are all the classes requested and names of TAs who have been assigned. <br><br> Click on class name to show more info.</h2>";

		

		$y= $date->count();
		
		$button = 'button';
		while ($y>0){
		$buttonyearsem = $dateresults[$y-1]->semesteryear;
		$classresult .=  "<button type='button' class = '$buttonyearsem$button'>Toggle $buttonyearsem </button> ";
		$y--;
		}

		$classInfo = DB::getInstance()->get('RealCourse', array( 'cat_number', '>', 999)); // selects all 
		$results = $classInfo->all();




		$classresult .= 

		"<table id = 'CourseTable'><tr>
		<td class = 'parent'><b>Number</b></td> 
		<td class = 'parent'><b>Name</b></td>
		<td class = 'parent'><b>Cat Num</b></td>
		
		<td class = 'parent'><b>Department</b></td>
		<td class = 'parent'><b>Units</b></td> 
		<td class = 'parent'><b>Days</b></td> 
		<td class = 'parent'><b>Time</b></td> 
		<td class = 'parent'><b>Location</b></td> 
		<td class = 'parent'><b>Component</b></td> 
		<td class = 'parent'><b>Section</b></td> 		
		<td class = 'parent'><b>Proffesor</b></td>
		<td class = 'parent'><b>Semester/Year</b></td> 
		
		<td class = 'parent'><b>Enrollment</b></td> 
		<td class = 'parent'><b>Cap</b></td>
		<td class = 'parent'><b>Hired TAs</b></td> 

	</tr>";


	$x= $classInfo->count();
	

	while ($x>0)

	{
		$dep  = $results[$x-1]->dept;
		$num  = $results[$x-1]->class_number;
		$cat  = $results[$x-1]->cat_number ;
		$location  = $results[$x-1]->location ;
		$name = $results[$x-1]->coursename ;
		$prof = $results[$x-1]->prof ;
		$year = $results[$x-1]->year ;
		$sem = $results[$x-1]->semester ;
		$units = $results[$x-1]->units ;
		$comp = $results[$x-1]->component ;
		$enr = $results[$x-1]->enrollment ;
		$cap = $results[$x-1]->cap ;
		$ta = $results[$x-1]->tas ;
		$time = $results[$x-1]->time ;
		$sec = $results[$x-1]->section ;
		$days = $results[$x-1]->days ;

		$classresult.=  
		"<tr class = '$sem$year'><td class = 'parent' class = '$sem $year'> ". $num  ." </td><td class = 'parent'> " . $name  ." </td><td class = '$sem $year'> " . $cat      ." </td><td class = '$sem $year'> " . $dep ." </td><td class = '$sem $year'>"  . $units  . " </td>" 
		. "<td class = '$sem $year'>"   . $days ." </td><td class = '$sem $year'> " . $time ." </td><td class = '$sem $year'> " . $location ." </td><td class = '$sem $year'> " . $comp ." </td><td class = '$sem $year'> " . $sec    ." </td><td class = '$sem $year'>"  . $prof  . " </td>"
		. "<td class = '$sem $year'>"   . $sem . $year . " </td><td class = '$sem $year'> " . $enr      ." </td><td class = '$sem $year'> " . $cap  ." </td>
		<td class = '$sem $year'> " . $ta     ." </td><td> " . 
		"<form action='scrape_enrollment.php' method='get'>
		 <input type='hidden' name='enrollcatnum' value='$cat'>
		 <input type='hidden' name='enrollyear' value='$year'>
		 <input type='hidden' name='enrollsemester' value='$sem'>
		 <input type='hidden' name='enrollsec' value='$sec'>
		 <input type='hidden' name='enrolldept' value='$dep'>
		 <input type='hidden' name='enrollnum' value='$num'>




		<button type='submit' >Update Enroll Data</button> </td></tr> </form>" ;
		$x--;
	}

	$classresult .=   "</table>";

	return $classresult;

}

}