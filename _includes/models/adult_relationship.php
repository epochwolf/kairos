<?php

// Acts like a database model but isn't backed by a database. 
class AdultRelationship extends BaseModel{
  const TABLE_NAME = null;
  const DISPLAY_NAME = "Adult Relationship";

  const EMANCIPATED = "emancipated";

  const RELATIONSHIPS = [
    // 'dbname' =>   ["Name"]
    "parent"       => ["Parent"], 
    "guardian"     => ["Legal Guardian"], 
    "consent-form" => ["By Consent Form"],
    "emancipated"  => ["Emancipated (No Adult)"],
  ];

  static function all(){
    $array = [];
    foreach(self::RELATIONSHIPS as $db_name => $fields){
      $array[] = self::fields_to_object($db_name, $fields);
    }
    return $array;
  }

  static function count(){ return count(self::RELATIONSHIPS); }
  static function find($id){}
  static function query($query, $params=null){ return []; }
  static function query_first($query, $params=null){}

  static function find_by_db_name($db_name){
    $fields = self::RELATIONSHIPS[$db_name];
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
    return new AdultRelationship([
          "db_name" => $db_name,
          "name" => $fields[0]
        ]);
  }


  # INSTANCE METHODS

  const FIELDS = [
    "id",
    "db_name",
    "name",
  ];

  function is_new_record(){ return false; }
  function save(){ return false;}
  function delete(){ return false;}

}