<?php

class Vendor extends BaseModel {
  const TABLE_NAME = "vendors";
  const DISPLAY_NAME = "Vendor";

  static function all(){
    return self::query("SELECT * FROM " . static::TABLE_NAME . " ORDER BY name ASC");
  }

  static function order_by_id(){
    return self::query("SELECT * FROM " . static::TABLE_NAME . " ORDER BY id ASC");
  }


  # INSTANCE METHODS
  const FIELDS = [
    "id",
    "name",
    "assigned_tables",
    "vendor_license_number",
    "notes",
  ];

  const PROTECTED_FIELDS = [
    "id",
  ];
  
  function display_name(){
    return $this->name;
  }

  function create_with_id(){
    $attributes = $this->export_to_db();
    $attributes["id"] = $this->id;
    $fields = array_keys($attributes);
    $values = array_values($attributes);

    $sql = db_prepared_insert_sql(static::TABLE_NAME, $fields);

    global $db;
    $stmt = $db->prepare($sql);
    $stmt->execute($values);
    return true;
  }
}