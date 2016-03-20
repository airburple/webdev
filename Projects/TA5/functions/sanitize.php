<?php

// escape function allows us to escape the string we pass in.

function escape($string) {
	return htmlentities($string, ENT_QUOTES, 'UTF-8');
}