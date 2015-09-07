<?php // This is the master file for the framework.
include 'db_func.php';
include 'util_func.php';
include 'view_func.php';
include 'view_buttons_func.php';
include 'permission_func.php';

function __autoload($class_name){
  $name = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $class_name));

  if(preg_match("/_form$/", $name) > 0){ // ends with "_form", it's a form
    if(file_exists(__DIR__."/forms/" . $name . ".php")){
      require_once("forms/" . $name . ".php");
      return true;
    }else{
      require_once("forms/config/" . $name . ".php");
      return true;
    }
  }else{ // else, it's a model.
    require_once("models/" . $name . ".php");
  }
  return false;
}

$db_config = json_decode(file_get_contents(__DIR__."/config.json", true));
$db_conn_str = "mysql:host=localhost;dbname={$db_config->database_name};host={$db_config->database_host}";

$db = new PDO($db_conn_str, $db_config->database_user, $db_config->database_password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Set include path to the root of the application. 
$APP_ROOT = realpath(__DIR__ . '/' . "..");
set_include_path(get_include_path() . PATH_SEPARATOR . $APP_ROOT);
