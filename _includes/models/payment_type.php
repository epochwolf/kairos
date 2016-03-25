<?php

class PaymentType extends BaseModel {
  const TABLE_NAME = "payment_types";
  const DISPLAY_NAME = "Payment Type";

  static function all(){
    return self::query("SELECT * FROM " . static::TABLE_NAME . " ORDER BY sort_order ASC");
  }

  static function at_door(){
    return self::query("SELECT * FROM " . static::TABLE_NAME . " WHERE at_door = 1 ORDER BY sort_order ASC");
  }

  static function default_type(){
    return self::query_first("SELECT * FROM " . static::TABLE_NAME . " ORDER BY at_door DESC, sort_order ASC LIMIT 1");
  }

  const FIELDS = [
    "id",
    "db_name",
    "name",
    "at_door",
    "sort_order",
  ];
  const PROTECTED_FIELDS = [
    "id",
  ];

  function export_to_db(){
    $array = parent::export_to_db();
    $array["at_door"] = self::bool_to_db($this->at_door);
    return $array;
  }

  static function default_name(){
    return self::default_type()->name;
  }
}