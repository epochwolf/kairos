<?php 
include_once("base_form.php");

class CheckInForm extends BaseForm{

  public $attendee;

  function __construct($params=[]){
    $this->attendee = Attendee::find($params["id"]);
    $this->params["badge_number"] = $this->attendee->badge_number;
    $this->params["badge_type"] = $this->attendee->badge_type;
    parent::__construct($params);
  }

  public function validate(){
    $this->error_if_empty("badge_number");
    if(!$this->error_on("badge_number")){
      if(!Attendee::is_unique_badge_number(@$this->params["badge_number"], $this->attendee)){
        $this->add_error("badge_number", "Number is already assigned.");
      }
    }

    $this->error_if_empty("badge_type");
    if(!$this->error_on("badge_type")){

      if(@$this->params["badge_type"] != "minor" && $this->attendee->minor()){
        $this->add_error("badge_type", "Attendee is a minor.");
      }elseif(@$this->params["badge_type"] == "minor" && !$this->attendee->minor()){
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