<?php

class BadgeType extends BaseModel {
  const TABLE_NAME = "badge_types";

  static function all(){
    $klass = get_called_class();
    return self::query("SELECT * FROM " . $klass::TABLE_NAME . " ORDER BY sort_order ASC");
  }

  static function first_by_db_name($db_name){
    $klass = get_called_class();
    return self::query_first("SELECT * FROM " . $klass::TABLE_NAME . " WHERE db_name = ?  ORDER BY sort_order ASC LIMIT 1", [$db_name]);
  }

  static function default_adult(){
    $klass = get_called_class();
    return self::query_first("SELECT * FROM " . $klass::TABLE_NAME . " WHERE minor=0 ORDER BY sort_order ASC LIMIT 1");
  }

  static function default_minor(){
    $klass = get_called_class();
    return self::query_first("SELECT * FROM " . $klass::TABLE_NAME . " WHERE minor=1 ORDER BY sort_order ASC LIMIT 1");
  }

  protected static $_cache = [];

  static function cached_first_by_db_name($db_name){
    $klass = get_called_class();
    $cache = $klass::get_cache();

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