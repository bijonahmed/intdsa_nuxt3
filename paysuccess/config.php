<?php
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'internationaldsa_user_ds');
define('DB_PASSWORD', 'bangladesh@123');
define('DB_PORT', '3306');
define('DB_NAME', 'internationaldsa_db_ds');
require('db/'.DB_DRIVER.'.php');
require('db.php');
return new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);