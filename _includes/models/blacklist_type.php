<?php

// Acts like a database model but isn't backed by a database. 
class BlacklistType extends BaseModel{
  const TABLE_NAME = null;
  const DISPLAY_NAME = "Badge Type";

  const TYPES = [
    // 'dbname' =>   ["Name",         "Alert Title", "alert-color", security_required]
    "ban"         => ["Ban",          "BANNED",      "danger",  true], 
    "restriction" => ["Restriction",  "RESTRICTION", "warning", false], 
    "watch"       => ["Watch",        "Watch",       "warning", false],
    "notice"      => ["Notice",       "Notice",      "success", false],
  ];

  static function all(){
    $array = [];
    foreach(self::TYPES as $db_name => $fields){
      $array[] = self::fields_to_object($db_name, $fields);
    }
    return $array;
  }

  static function count(){ return count(self::TYPES); }
  static function find($id){}
  static function query($query, $params=null){ return []; }
  static function query_first($query, $params=null){}

  static function find_by_db_name($db_name){
    $fields = self::TYPES[$db_name];
    if($fields){
      return self::fields_to_object($db_name, $fields);
    }else{
      return;
    }
  }
  
  static function cached_find_by_db_name($db_name){
    $arr = array_filter(static::get_cache(), function($lvl) use ($db_name){ return $lvl->db_name == $db_name; });
    return reset($arr); // Return the first value of the array...
  }

  private static function fields_to_object($db_name, $fields){
    return new BlacklistType([
          "db_name" => $db_name,
          "name" => $fields[0],
          "alert_title" => $fields[1],
          "alert_color" => $fields[2],
          "security_required" => $fields[3]
        ]);
  }


  # INSTANCE METHODS

  const FIELDS = [
    "id",
    "db_name",
    "name",
    "alert_title",
    "alert_color",
    "security_required",
  ];

  function is_new_record(){ return false; }
  function save(){ return false;}
  function delete(){ return false;}

}