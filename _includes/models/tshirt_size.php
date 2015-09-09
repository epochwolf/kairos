<?php

class TShirtSize extends BaseModel {
  const TABLE_NAME = "tshirt_sizes";

  static function all(){
    return self::query("SELECT * FROM " . static::TABLE_NAME . " ORDER BY sort_order ASC");
  }

  const FIELDS = [
    "id",
    "db_name",
    "name",
    "sort_order",
  ];
  const PROTECTED_FIELDS = [
    "id",
  ];

}