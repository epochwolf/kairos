<?php // This file includes functions for database access. 


function db_query($query, $params=null){
  global $db;
  if(is_null($params)){
    $result = $db->query($query);
    return $result->fetchAll();
  }else{
    $stmt = $db->prepare($query);
    $stmt->execute($params);
    return $stmt->fetchAll();
  }
}

function db_start_transaction(){
  global $db;
  $db->beginTransaction();
}

function db_rollback_transaction(){
  global $db;
  $db->rollBack();
}

function db_commit_transaction(){
  global $db;
  $db->commit();
}


function db_prepared_insert_sql($table, $fields){
  $values = array_map(function($field){ return "?"; }, $fields);
  $fields = array_map(function($field) use ($table){ return "`$table`.`$field`"; }, $fields);

  return sprintf("INSERT INTO $table (%s) VALUES (%s)", implode(",", $fields), implode(",", $values));
}

function db_prepared_update_sql($table, $fields, $where){
  $values = array_map(function($field) use ($table){ return "`$table`.`$field` = ?"; }, $fields);

  return sprintf("UPDATE $table SET %s WHERE $where", implode(", ", $values));
}

function db_prepared_delete_sql($table, $where){
  return "DELETE FROM $table WHERE $where";
}