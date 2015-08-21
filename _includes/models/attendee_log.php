<?php

class AttendeeLog extends BaseModel {
  const TABLE_NAME = "attendee_logs";


  static function by_attendee_id($number){
    return self::query("SELECT * FROM attendee_logs WHERE attendee_id = ? ORDER BY created_at DESC", [$number]);
  }

  static function log($operation, $attendee){
    $d = new DateTime();
    $record = new self([
      "attendee_id" => $attendee->id,
      "attributes" => json_encode($attendee->export_to_db()),
      "operation" => $operation,
      "created_at" => $d->format("Y-m-d H:i:s") 
    ]);
    if($record->save()){
      return $record;
    }else{
      return;
    }
  }

  const FIELDS = [
    "id",
    "attendee_id",
    "operation",
    "attributes",
    "created_at",
  ];
  const PROTECTED_FIELDS = [
    "id",
    "created_at",
  ];

  function __construct($row){
    parent::__construct($row);
    $this->attributes = json_decode($row["attributes"]);
  }

  function export_to_db(){
    $array = parent::export_to_db();
    $array["attributes"] = json_encode($this->attributes);
    return $array;
  }

}