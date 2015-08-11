<?php


class User extends BaseModel {
  const TABLE_NAME = "users";

  ## QUERY METHODS


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
}