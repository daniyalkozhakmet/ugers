<?php

defined('ROOTPATH') or exit('Access Denied!');

if (((empty($_SERVER['SERVER_NAME'])) && php_sapi_name() == 'cli') || !empty($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] == 'localhost') {
	/** database config **/
	define('DBNAME', 'ugers');
	define('DBHOST', 'localhost');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBDRIVER', '');
	define('ACCESSKEYID', 'AKIAZNZLSE4EULSXF427');
	define('SECRETACCESSKEY', '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');
	define('REGION', 'eu-north-1');
	define('VERSION', 'latest');
	define('BUCKET', 'ugerss');

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

define('APP_NAME', "УГЕРС");
define('APP_DESC', "УГЕРС");

/** true means show errors **/
define('DEBUG', true);
