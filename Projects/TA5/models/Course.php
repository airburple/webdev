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
			$field = (is_numeric($course)) ? 'cid' : 'coursename';
			$data = $this->_db->get('Course', array($field, '=', $course));

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
		
		if(!$this->_db->update('Course', $id, $fields)) {
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

		$classInfo = DB::getInstance()->get('Course', array( 'cid', '>', 0)); // selects all 
		$results = $classInfo->all();
		$classresult .= "<h2>Here are all the classes and names of TAs who have been assigned.</h2>";


		$classresult .= "<table><tr>
		<td><b>Department</b></td>
		<td><b>Number</b></td>
		<td><b>Name</b></td> 
		<td><b>Professor</b></td> 
		<td><b>Enrollment</b></td> 
		<td><b>Semester</b></td> 
		<td><b>TA</b></td> 

	</tr>";


	$x= $classInfo->count();


	while ($x>0)

	{
		$dep  = $results[$x-1]->dept;
		$num  = $results[$x-1]->number;
		$name = $results[$x-1]->coursename ;
		$Prof = $results[$x-1]->prof ;
		$Enr = $results[$x-1]->Enrollment ;
		$Sem = $results[$x-1]->semester ;
		$TA = $results[$x-1]->TA_Situation ;

		$classresult.=  
		"<tr><td>" . $dep ." </td><td> " . $num ." </td><td>"  . $name  . " </td>" 
		. "<td>" . $Prof ." </td><td> " . $Enr ." </td><td>"  . $Sem  . " </td>"
		. "<td>" . $TA ." </td></tr> " ;
		$x--;
	}

	$classresult .=   "</table>";

	return $classresult;

}

}