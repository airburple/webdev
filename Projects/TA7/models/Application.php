<?php
class Application {
	public $_db,
			$_sessionName = null,
			$_cookieName = null,
			$_data = array();

	public function __construct($application = null) {
		$this->_db = DB::getInstance();
		
		$this->find($application); 		//use the find method to construct this application.
		
	}

	public function exists() {
		return (!empty($this->_data)) ? true : false;
	}

	public function find($application = null) {
		// Check if application_id specified and grab details
		if($application) {
			$field = 'applicationId';
			$data = $this->_db->get('Course_Applied', array($field, '=', $application));

			if($data->count()) {
				$this->_data = $data->first();
				return true;
			}
		}
		return false;
	}

	public function createApplication($fields = array()) {
		if(!$this->_db->insert('Course_Applied', $fields)) {
			throw new Exception('There was a problem creating an application.');
		}
	}

	public function update($fields = array(), $id = null) {
		if(!$id) {
			$id = $this->data()->id;
		}
		
		if(!$this->_db->update('Course_Applied', $id, $fields)) {
			throw new Exception('There was a problem updating application.');
		}
	}

	public function data() {
		return $this->_data;
	}


//returns the application as a string table
public function getApplication($userId=null) {

		$applicationInfo = DB::getInstance()->get('Course_Applied', array( 'userId', '=', $userId)); // selects all 
		$results = $applicationInfo->all();
		$Appresult .= "<h2>Here are all of your applications.</h2>";


		$Appresult .= "<table><tr>
		
		
		<td><b>Name </b></td> 
		<td><b>Grade </b></td> 
		<td><b>Semester Applied </b></td> 
		<td><b>Semester Taken </b></td> 
		<td><b>Course Id </b></td> 
		<td><b>Application Status </b></td>

	</tr>";


	$x= $applicationInfo->count();


	while ($x>0)

	{
		
		
		$name = $results[$x-1]->coursename ;
		$grade = $results[$x-1]->grade ;
		$SemA = $results[$x-1]->semesterApplying;
		$SemT = $results[$x-1]->semesterTaken ;
		$CID = $results[$x-1]->cid ;
		$stat = $results[$x-1]->status ;

		$Appresult.=  
		"<tr><td class='myappname'>" . $name ." </td><td> " . $grade ." </td><td>"  . $SemA  . " </td>" 
		. "<td>" . $SemT ." </td><td class='myappcid'> " . $CID . " </td><td> " . $stat . " </td></tr> " ;
		$x--;
	}

	$Appresult .=   "</table>";

	return $Appresult;

}


//returns the application as a string table
public function getAllApplications() {

		$applicationInfo = DB::getInstance()->get('Course_Applied', array( 'userId', '>', 0)); // selects all 
		$results = $applicationInfo->all();
		$Appresult .= "<h2>Here are all applications.</h2>";


		$Appresult .= "<table><tr>
		
		
		<td><b>Course Name </b></td> 
		<td><b>Course Id </b></td> 
		<td><b>Applicant Name</b></td> 
		<td><b>Applicant ID </b></td> 
		<td><b>Semester Applied </b></td> 
		<td><b>Semester Taken </b></td>
		<td><b>Grade </b></td>
		<td><b>Hire Status</b></td>   
		
		

	</tr>";


	$x= $applicationInfo->count();


	while ($x>0)

	{
		
		$user = $results[$x-1]->username ;
		$userId = $results[$x-1]->userID ;
		$name = $results[$x-1]->coursename ;
		$grade = $results[$x-1]->grade ;
		$SemA = $results[$x-1]->semesterApplying;
		$SemT = $results[$x-1]->semesterTaken ;
		$CID = $results[$x-1]->cid ;
		$stat = $results[$x-1]->status ;

		$Appresult.=  
		"<tr><td>" . $name ." </td><td> " . $CID ." </td><td>"  . $user  . " </td>" 
		. "<td>" . $userId ." </td><td> " . $SemA . " </td><td> " . $SemT . " </td><td> " . $grade . " </td>
		<td> " . $stat . " </td></tr> " ;
		$x--;
	}

	$Appresult .=   "</table>";

	return $Appresult;

}





public function getApplicationsByClassNumber($classNumber=null) {

		$applicationInfo = DB::getInstance()->get('Course_Applied', array( 'cid', '=', $classNumber)); // selects all 
		$results = $applicationInfo->all();
		$Appresult .= "<h2>Here are all the applicants for " .$classNumber. ".</h2>";




		$Appresult .= "<table><tr>
		
		
		<td><b>Course Name </b></td> 
		<td><b>Course Id </b></td> 
		<td><b>Applicant Name</b></td> 
		<td><b>Applicant ID </b></td> 
		<td><b>Semester Applied </b></td> 
		<td><b>Semester Taken </b></td>
		<td><b>Grade </b></td>
		 
		
		

	</tr>";


	$x= $applicationInfo->count();


	while ($x>0)

	{
		
		$user = $results[$x-1]->username ;
		$userId = $results[$x-1]->userID ;
		$name = $results[$x-1]->coursename ;
		$grade = $results[$x-1]->grade ;
		$SemA = $results[$x-1]->semesterApplying;
		$SemT = $results[$x-1]->semesterTaken ;
		$CID = $results[$x-1]->cid ;
		//$stat = $results[$x-1]->status ;

		$Appresult.=  
		"<tr><td>" . $name ." </td><td> " . $CID ." </td><td>"  . $user  . " </td>" 
		. "<td>" . $userId ." </td><td> " . $SemA . " </td><td> " . $SemT . " </td><td> " . $grade . " </td></tr> " ;
		$x--;
	}

	$Appresult .=   "</table>";

	return $Appresult;

}









	
}