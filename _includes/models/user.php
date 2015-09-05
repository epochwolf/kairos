<?php

class User extends BaseModel {
  const TABLE_NAME = "users";

  static function count_admins(){
    $klass = get_called_class();
    $results = self::db_query("SELECT count(*) as row_count FROM " . $klass::TABLE_NAME . " WHERE admin=1");
    return @$results[0]["row_count"];
  }

  ## QUERY METHODS
  static function find_by_username($username){
    $klass = get_called_class();
    return self::query_first("SELECT * FROM " . $klass::TABLE_NAME . " WHERE username = ? LIMIT 1", [$username]);
  }

  # INSTANCE METHODS
  const FIELDS = [
    "id",
    "username",
    "password",
    "admin",
  ];

  const PROTECTED_FIELDS = [
    "id",
  ];

  function export_to_db(){
    $array = parent::export_to_db();
    $array["admin"] = self::bool_to_db($this->admin);
    
    return $array;
  }

  function check_password($password){
    return $password == $this->password;
  }
}