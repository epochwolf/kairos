<?php

class RegistrationLevel extends BaseModel {

  const TABLE_NAME = "registration_levels";

  static function all(){
    $klass = get_called_class();
    return self::query("SELECT * FROM " . $klass::TABLE_NAME . " ORDER BY sort_order ASC");
  }

  static function at_door(){
    $klass = get_called_class();
    return self::query("SELECT * FROM " . $klass::TABLE_NAME . " WHERE available_at_door = 1 ORDER BY sort_order ASC");
  }

  static function pre_reg(){
    $klass = get_called_class();
    return self::query("SELECT * FROM " . $klass::TABLE_NAME . " WHERE available_pre_reg = 1 ORDER BY sort_order ASC");
  }

  static function first_by_db_name($db_name){
    $klass = get_called_class();
    return self::query_first("SELECT * FROM " . $klass::TABLE_NAME . " WHERE db_name = ?  ORDER BY sort_order ASC LIMIT 1", [$db_name]);
  }


  # CACHED METHODS, these load the entire table in memory before returning data. 
  protected static $_cache = [];

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

  const FIELDS = [
    "id",
    "db_name",
    "name",
    "price",
    "includes_tshirt",
    "available_at_door",
    "available_pre_reg",
    "sort_order",
  ];
  const PROTECTED_FIELDS = [
    "id",
  ];

  function __construct($row){
    parent::__construct($row);
  }

  function export_to_db(){
    $array = parent::export_to_db();
    $array["includes_tshirt"]    = self::bool_to_db($this->includes_tshirt);
    $array["available_at_door"] = self::bool_to_db($this->available_at_door);
    return $array;
  }

}