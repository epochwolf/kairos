<?php

class PaymentType extends BaseModel {
  const TABLE_NAME = "payment_types";

  static function all(){
    $klass = get_called_class();
    return self::query("SELECT * FROM " . $klass::TABLE_NAME . " ORDER BY sort_order ASC");
  }

  static function at_door(){
    $klass = get_called_class();
    return self::query("SELECT * FROM " . $klass::TABLE_NAME . " WHERE at_door = 1 ORDER BY sort_order ASC");
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
}