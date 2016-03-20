<?php

// this class handles our input from various forms. help from phpacademy oop tuts

class Input {

	// checks to see if data is posted via post or get.
	public static function exists($type = 'post') {
		switch($type) {
			case 'post':
				return (!empty($_POST)) ? true : false;
			break;
			case 'get':
				return (!empty($_GET)) ? true: false;
			break;
			default:
				return false;
			break;
		}
	}

	// gets the posted item. If data not available returns an empty string.
	public static function get($item) {
		if(isset($_POST[$item])) {
			return $_POST[$item];
		} else if (isset($_GET[$item])) {
			return $_GET[$item];
		}
		
		return '';
	}
}