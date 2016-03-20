<?php
require 'core/init.php';

//reset our user to new and log out.

$user = new User();
$user->logout();

Redirect::to('index.php');