<?php

class CheckInForm extends BaseForm{

  public $attendee;

  function __construct($params=[]){
    $this->attendee = Attendee::find($params["id"]);
    $this->params["birthdate"] = $this->attendee->birthdate;
    $this->params["badge_name"] = $this->attendee->badge_name;
    $this->params["badge_number"] = $this->attendee->badge_number;
    $this->params["badge_type"] = $this->attendee->badge_type;
    parent::__construct($params);
  }

  public function validate(){
    $this->error_if_empty("birthdate");
    if(!$this->error_on("birthdate")){
      $this->error_if_invalid_date("birthdate");
    }

    $this->error_if_empty("badge_name");
    if(!$this->error_on("badge_name")){
      if(!Attendee::is_unique_badge_name(@$this->params["badge_name"], $this->attendee)){
        $this->add_error("badge_name", "Name is already taken.");
      }
    }

    $this->error_if_empty("badge_number");
    if(!$this->error_on("badge_number")){
      if(!Attendee::is_unique_badge_number(@$this->params["badge_number"], $this->attendee)){
        $this->add_error("badge_number", "Number is already assigned.");
      }
    }

    $this->error_if_empty("badge_type");
    if(!$this->error_on("badge_type")){
      $badge_type = BadgeType::find_by_db_name(@$this->params["badge_type"]);

      if(!$badge_type->minor && $this->attendee->minor()){
        $this->add_error("badge_type", "Attendee is a minor.");
      }elseif($badge_type->minor && !$this->attendee->minor()){
        $this->add_error("badge_type", "Attendee is not a minor.");
      }
    }
  }

  function save(){
    if($this->valid()){
      $this->attendee->badge_number = $this->params["badge_number"];
      $this->attendee->badge_type = $this->params["badge_type"];
      if(array_key_exists("blacklisted", $this->params)){
        $this->attendee->blacklisted = $this->params["blacklisted"];
      }
      $this->attendee->checked_in = true;
      return $this->attendee->save();
    }else{
      return false;
    }
  }
}