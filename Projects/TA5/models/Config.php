<?php

// A class that has a public method to get the config variable from the Global config in init.php
class Config {
	public static function get($path = null) {
		if($path) {
			$config = $GLOBALS['config'];
			$path = explode('/' , $path);

			foreach($path as $bit){
				if(isset($config[$bit])) {
					$config = $config[$bit];
				}
			}

			return $config;
		}

		return false; // if nothing is set 
	}
}

