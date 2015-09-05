<?php

class RegistrationUpgrade extends BaseModel {

  const TABLE_NAME = "registration_upgrades";

  static function all(){
    $klass = get_called_class();
    return self::query("SELECT * FROM " . $klass::TABLE_NAME . " ORDER BY sort_order ASC");
  }

  static function all_with_prices(){
    $klass = get_called_class();
    return self::query(
      "SELECT " . $klass::TABLE_NAME . ".*, (to_lvl.price - from_lvl.price) as price, to_lvl.name as to_name, from_lvl.name as from_name ".
      "FROM " . $klass::TABLE_NAME . " ".
      "LEFT OUTER JOIN registration_levels from_lvl ON from_lvl.db_name = registration_upgrades.`from` " . 
      "LEFT OUTER JOIN registration_levels to_lvl ON to_lvl.db_name = registration_upgrades.`to` " . 
      "ORDER BY " . $klass::TABLE_NAME . ".sort_order ASC"); 
  }

  static function from_with_prices($from){
    $klass = get_called_class();
    return self::query(
      "SELECT " . $klass::TABLE_NAME . ".*, (to_lvl.price - from_lvl.price) as price, to_lvl.name as to_name, from_lvl.name as from_name ".
      "FROM " . $klass::TABLE_NAME . " ".
      "LEFT OUTER JOIN registration_levels from_lvl ON from_lvl.db_name = registration_upgrades.`from` " . 
      "LEFT OUTER JOIN registration_levels to_lvl ON to_lvl.db_name = registration_upgrades.`to` " . 
      "WHERE " . $klass::TABLE_NAME . ".`from` = ? ". 
      "ORDER BY " . $klass::TABLE_NAME . ".sort_order ASC", [$from]); 
  }

  protected static $_cache = [];

  static function cached_from($from){
    $klass = get_called_class();
    $cache = $klass::get_cache();

    $arr = array_filter($cache, function($lvl) use ($from){ return $lvl->from == $from; });
    return reset($arr); // return first value of array. 
  }

  static function cached_available_for($from){
    $klass = get_called_class();
    return !empty($klass::cached_from($from));
  }

  const FIELDS = [
    "id",
    "from",
    "to",
    "override_price",
    "sort_order"
  ];
  const JOIN_FIELDS = [
    "to_name",
    "from_name",
    "price",
    ];
  const PROTECTED_FIELDS = [
    "id",
  ];

  function __construct($row){
    parent::__construct($row);
  }

  function export_to_db(){
    $array = parent::export_to_db();
    return $array;
  }

}