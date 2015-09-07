<?php

// Acts like a database model but isn't backed by a database. 
class BlacklistType extends BaseModel{

  const TYPES = [
    // 'dbname' =>   ["Name",         "Alert Title", "alert-color"]
    "ban"         => ["Ban",          "BANNED",      "danger"], 
    "restriction" => ["Restriction",  "RESTRICTION", "warning"], 
    "watch"       => ["Watch",        "Watch",       "warning"]
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
  
  static function cached_all(){
    $klass = get_called_class();
    return $klass::get_cache();
  }

  static function cached_first_by_db_name($db_name){
    $klass = get_called_class();
    $cache = $klass::get_cache();

    $arr = array_filter($cache, function($lvl) use ($db_name){ return $lvl->db_name == $db_name; });
    return reset($arr); // Return the first value of the array...
  }

  private static function fields_to_object($db_name, $fields){
    return new BlacklistType([
          "db_name" => $db_name,
          "name" => $fields[0],
          "alert_title" => $fields[1],
          "alert_color" => $fields[2]
        ]);
  }


  # INSTANCE METHODS

  const FIELDS = [
    "id",
    "db_name",
    "name",
    "alert_title",
    "alert_color",
  ];


  function is_new_record(){ return false; }
  function save(){ return false;}
  function delete(){ return false;}

}