<?php

defined('ROOTPATH') or exit('Access Denied!');

if ($_SERVER['SERVER_NAME'] == 'localhost') {
	/** database config **/
	define('DBNAME', 'ugers');
	define('DBHOST', 'localhost');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBDRIVER', '');
	define('ACCESSKEYID', 'AKIAY5NCYP3W4VHZZIAV');
	define('SECRETACCESSKEY', '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');
	define('REGION', 'eu-north-1');
	define('VERSION', 'latest');
	define('BUCKET', 'pharmafy');

	define('ROOT', 'http://localhost/ugers/public');
} else {
	/** database config **/
	define('DBNAME', 'mvc_db');
	define('DBHOST', 'localhost');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBDRIVER', '');

	define('ROOT', 'https://www.yourwebsite.com');
}

define('APP_NAME', "My Webiste");
define('APP_DESC', "Best website on the planet");

/** true means show errors **/
define('DEBUG', true);
