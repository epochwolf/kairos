<?php

class Blacklist extends BaseModel{
  const TABLE_NAME = "blacklist";
  const DISPLAY_NAME = "Blacklist";

  ## QUERIES
  # @return [Blacklist, "badge_name" or "legal_name", String] or null
  static function match($badge_name, $legal_name){
    $rows = self::cached_all();
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

  # INSTANCE METHODS

  const FIELDS = [
    "id",
    "badge_name",
    "legal_name",
    "trigger_legal_names",
    "trigger_badge_names",
    "reason",
    "type"
  ];

  private $attendees_records;

  function display_name(){
    if($this->badge_name && $this->legal_name){
      return "{$this->badge_name} / {$this->legal_name}";
    }elseif($this->badge_name){
      return $this->badge_name;
    }elseif($this->legal_name){
      return $this->legal_name;
    }else{
      return "";
    }
  }

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
    $value = trim(strtolower($value));

    foreach(explode("\n", $triggers) as $trigger){
      $regex = $this->trigger_to_regex($trigger);

      if($regex && preg_match($regex, $value)){
        return trim($trigger);
      }
    }
    return null;
  }

  private function trigger_to_regex($trigger){
    $parts = explode("*", $trigger);
    $parts = array_filter($parts);
    if(!empty($parts)){
      $parts = array_map(function($v){ return preg_quote($v, "/"); }, $parts);
      $regex = implode(".+", $parts);
      return "/$regex/i";
    }
  }
}