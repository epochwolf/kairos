<?php

class User extends BaseModel {
  const TABLE_NAME = "users";
  const DISPLAY_NAME = "User";

  static function count_admins(){
    $results = db_query("SELECT count(*) as row_count FROM " . static::TABLE_NAME . " WHERE admin=1");
    return @$results[0]["row_count"];
  }

  ## QUERY METHODS
  static function find_by_username($username){
    return self::query_first("SELECT * FROM " . static::TABLE_NAME . " WHERE username = ? LIMIT 1", [$username]);
  }

  # INSTANCE METHODS
  const FIELDS = [
    "id",
    "username",
    "encrypted_password",
    "admin",
  ];

  const PROTECTED_FIELDS = [
    "id",
  ];

  public $password;

  function __construct($row=[]){
    $this->password = null;
    parent::__construct($row);
  }

  function display_name(){
    return $this->username;
  }

  function export_to_db(){
    $array = parent::export_to_db();
    if($this->password){
      $array["encrypted_password"] = password_hash($this->password, PASSWORD_BCRYPT);
    }
    $array["admin"] = self::bool_to_db($this->admin);
    
    return $array;
  }

  function check_password($password){
    return password_verify($password, $this->encrypted_password);
  }
}