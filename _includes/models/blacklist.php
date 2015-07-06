<?php

class Blacklist extends BaseModel{
  const TABLE_NAME = "blacklist";

  ## QUERIES
  # @return [Blacklist, "badge_name" or "legal_name", String] or null
  static function match($badge_name, $legal_name){
    $rows = self::all();
    foreach($rows as $row){
      if(!empty($badge_name)){
        if($trigger_badge_name = $row->matches_badge_name($badge_name)){
          return [$row, "badge_name", $trigger_badge_name];
        }
      }
      if(!empty($legal_name)){
        if($trigger_legal_name = $row->matches_legal_name($legal_name)){
          return [$row, "legal_name", $trigger_legal_name];
        }
      }
    }
    return null;
  }


  static function map_row($row){
    return new Blacklist($row);
  }

  # INSTANCE METHODS

  const FIELDS = [
    "id",
    "badge_name",
    "legal_name",
    "trigger_legal_names",
    "trigger_badge_names",
    "reason",
    "banned",
  ];

  private $attendees_records;

  function attendees(){
    if(isset($this->attendees_records)){ return $this->attendees_records;}

    $this->attendees_records = Attendee::by_blacklist_id($this->id);
    return $this->attendees_records;
  }


  function matches_badge_name($value){
    return $this->matches_triggers($this->trigger_badge_names, $value);
  }

  function matches_legal_name($value){
    return $this->matches_triggers($this->trigger_legal_names, $value);
  }

  private function matches_triggers($triggers, $value){
    if(empty($triggers)){ return false; }
    if(empty($value)){ return false; }
    $value = strtolower($value);

    foreach(explode("\n", $triggers) as $trigger){
      $trigger = strtolower(trim($trigger));

      if(!empty($trigger) && strstr($value, $trigger)){
        return trim($trigger);
      }
    }
    return null;
  }

  # Saving isn't supported for this class. 
  function save(){
    return false;
  }
}