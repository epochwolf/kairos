<?php // This is the master file for the framework.

include 'config.php';
include 'db_func.php';
include 'util_func.php';
include 'view_func.php';
include 'models/base_model.php';
include 'models/blacklist.php';
include 'models/attendee.php';
include 'models/user.php';


$db = new PDO(...$CONFIG['database']);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Set include path to the root of the application. 
$APP_ROOT = (__DIR__ . PATH_SEPARATOR . "..");

set_include_path(get_include_path() . PATH_SEPARATOR . $APP_ROOT);