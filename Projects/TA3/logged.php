	<?php
session_start();
$_SESSION[ 'message'] = ''; // default message only passed if login failed.
$_SESSION['role'] = '';
	//require("TA_Application/db.php");
	//require("TA_Application/functions.php");
	include 'burrell_db_config.php';   

	//session_start();

	try
	{
	  

	  

	  

	  

	  //
	  // Connect to the data base and select it.
	  //
		$db = new PDO("mysql:host=$server_name;dbname=$db_name;charset=utf8", $db_user_name, $db_password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

 
	// grab the login from post and post the password into the crypt function, only storing the cyrpted password and check that against the crypted pw in the db.
		
					$savedrole = ''; 
					$savedname = '';
					$savedlogin= '';
					$login     = $_POST['login'];
					$cryptedPW = crypt($_POST['password'],'sa');
					
				

					
				

			

			

				if (isset ( $_POST['login'], $_POST['password'] )){

			$query = $db->query("SELECT * FROM User where login = '$login' and password= '$cryptedPW'");



			while ($r = $query->fetch())
			{

				$savedname = $r['name'];
				$savedrole = $r['role'];
				$savedlogin = $r['login'];
				$saveduserId= $r['userId'];
			}

			

			


	// if the login was successful take the role and start the appropriate session and redirect to appropriate page.

	

	$_SESSION['role']="$savedrole";
	$_SESSION['name']="$savedname";
	$_SESSION['login']="$savedlogin";
	$_SESSION['userId']="$saveduserId";
	

	$redirect_page = '';

	//if none of the role sessions work then send them back to the login page.

	

	If ( $savedrole === 'applicant')
	{
	$_SESSION[ 'message'] = '';
	$redirect_page = 'ApplicantHome.php';
	}

	else If ( $savedrole === 'instructor')
	{
	$_SESSION[ 'message'] = '';	
	$redirect_page = 'Instructor_Home.php';
	}

	else If ( $savedrole === 'admin')
	{
	$_SESSION[ 'message'] = '';
	$redirect_page = 'Admin_Home.php';
	}

	else{
		$_SESSION[ 'message'] = 'login failed';
		$redirect_page = 'login.php';
		
	}


	

	header ('Location:'. $redirect_page);

			




}

}
catch (PDOException $ex)
{
	$loginresult .= "<p>oops</p>";
	$loginresult .= "<p> Code: {$ex->getCode()} </p>";
	$loginresult .=" <p> See: dev.mysql.com/doc/refman/5.0/en/error-messages-server.html#error_er_dup_key";
	$loginresult .= "<pre>$ex</pre>";

	
}

?>
