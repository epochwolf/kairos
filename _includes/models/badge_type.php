<?php

class BadgeType extends BaseModel {
  const TABLE_NAME = "badge_types";

  static function all(){
    return self::query("SELECT * FROM " . static::TABLE_NAME . " ORDER BY sort_order ASC");
  }

  static function find_by_db_name($db_name){
    return self::query_first("SELECT * FROM " . static::TABLE_NAME . " WHERE db_name = ?  ORDER BY sort_order ASC LIMIT 1", [$db_name]);
  }

  static function default_adult(){
    return self::query_first("SELECT * FROM " . static::TABLE_NAME . " WHERE minor=0 ORDER BY sort_order ASC LIMIT 1");
  }

  static function default_minor(){
    return self::query_first("SELECT * FROM " . static::TABLE_NAME . " WHERE minor=1 ORDER BY sort_order ASC LIMIT 1");
  }

  static function cached_find_by_db_name($db_name){
    $cache = static::get_cache();

    $arr = array_filter($cache, function($type) use ($db_name){ return $type->db_name == $db_name; });
    return reset($arr); // Return the first value of the array...
  }

  const FIELDS = [
    "id",
    "db_name",
    "name",
    "label_color",
    "minor",
    "sort_order",
  ];
  const PROTECTED_FIELDS = [
    "id",
  ];

  function export_to_db(){
    $array = parent::export_to_db();
    $array["label_color"] = self::nullable_string_to_db($this->label_color);
    $array["minor"]       = self::bool_to_db($this->minor);
    return $array;
  }
}