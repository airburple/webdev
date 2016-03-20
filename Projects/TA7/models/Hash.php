<?php

// creates hashes for use in passwords.
class Hash {
	public static function make($string, $salt = '') {
		return hash('sha256', $string . $salt);
	}

	public static function salt($length) {
		return mcrypt_create_iv($length); // creates a bunch of garbage values
	}

	public static function unique() {
		return self::make(uniqid());
	}
}