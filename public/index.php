<?php

use Model\User;

date_default_timezone_set('Asia/Almaty');
header('Content-Type: text/html; charset=utf-8');
session_start();

/**  Valid PHP Version? **/
$minPHPVersion = '8.0';
if (phpversion() < $minPHPVersion) {
	die("Your PHP version must be {$minPHPVersion} or higher to run this app. Your current version is " . phpversion());
}

/**  Path to this file **/
define('ROOTPATH', __DIR__ . DIRECTORY_SEPARATOR);

require "../app/core/init.php";

DEBUG ? ini_set('display_errors', 1) : ini_set('display_errors', 0);

$app = new App;
$app->loadController();
if ($app->loadTables()) {
	$user = new User;
	$user->seedUserRoles();
} else {
	var_dump('Server error');
}
