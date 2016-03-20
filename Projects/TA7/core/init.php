<?php
// This sets up our DB, sessions and cookies for use throughout TA4. PHP acadamey tutorials helped on this structure.
session_start();

$GLOBALS['config'] = array (
	'mysql' => array(
		'host'=> 'localhost',
		'username' => 'TA_Application',
		'password' => '626638918',
		'db' => 'TA7'),

	'remember' =>  array(
		'cookie_name' => 'hash',
		'cookie_expiry' => 604800
		),

	'session' => array(
		'session_name' => 'user',
		'token_name' => 'token'
		)
	);

// Autoload classes
function autoload($class) {
	require_once 'models/' . $class . '.php';
}
spl_autoload_register('autoload');

// Include functions
require_once 'functions/sanitize.php';

// Check for users that have requested to be remembered
if(Cookie::exists(Config::get('remember/cookie_name'))) {
	$hash = Cookie::get(Config::get('remember/cookie_name'));
	$hashCheck = DB::getInstance()->get('users_session', array('hash', '=', $hash));

	if($hashCheck->count()) {
		$user = new User($hashCheck->first()->user_id);
		$user->login();
	}

}

?>
