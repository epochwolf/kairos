<?php

class RegistrationUpgrade extends BaseModel {

  const TABLE_NAME = "registration_upgrades";

  static function all(){
    return self::query("SELECT * FROM " . static::TABLE_NAME . " ORDER BY sort_order ASC");
  }

  static function all_with_prices(){
    return self::query(
      "SELECT " . static::TABLE_NAME . ".*, (to_lvl.price - from_lvl.price) as price, to_lvl.name as to_name, from_lvl.name as from_name ".
      "FROM " . static::TABLE_NAME . " ".
      "LEFT OUTER JOIN registration_levels from_lvl ON from_lvl.db_name = registration_upgrades.`from` " . 
      "LEFT OUTER JOIN registration_levels to_lvl ON to_lvl.db_name = registration_upgrades.`to` " . 
      "ORDER BY " . static::TABLE_NAME . ".sort_order ASC"); 
  }

  static function from_with_prices($from){
    return self::query(
      "SELECT " . static::TABLE_NAME . ".*, (to_lvl.price - from_lvl.price) as price, to_lvl.name as to_name, from_lvl.name as from_name ".
      "FROM " . static::TABLE_NAME . " ".
      "LEFT OUTER JOIN registration_levels from_lvl ON from_lvl.db_name = registration_upgrades.`from` " . 
      "LEFT OUTER JOIN registration_levels to_lvl ON to_lvl.db_name = registration_upgrades.`to` " . 
      "WHERE " . static::TABLE_NAME . ".`from` = ? ". 
      "ORDER BY " . static::TABLE_NAME . ".sort_order ASC", [$from]); 
  }

  protected static $_cache = [];

  static function cached_from($from){
    $arr = array_filter(static::get_cache(), function($lvl) use ($from){ 
      return $lvl->from == $from; 
    });
    return reset($arr); // return first value of array. 
  }

  static function cached_available_for($from){
    return !empty(static::cached_from($from));
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

  function price(){
    return is_null($this->override_price) ? $this->price : $this->override_price;
  }

  function export_to_db(){
    $array = parent::export_to_db();
    $array["override_price"] = self::override_price_to_db($this->override_price);
    return $array;
  }

  static function override_price_to_db($override_price){
    $override_price = preg_replace("/[^\d]*/", "", $override_price);
    if(trim($override_price) === ""){
      return null;
    }else{
      return floatval($override_price);
    }
  }
}