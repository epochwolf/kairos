<?php 

class AddAttendeeForm extends NewAttendeeForm{

  public function validate(){
    $age = age_from_birthdate(@$this->params["birthdate"]);
    $minor = $age && $age < MINOR_AGE;

    $this->error_if_empty("legal_name");
    $this->error_if_empty("badge_name");

    if(!$this->error_on("birthdate")){
      $this->error_if_invalid_date("birthdate");
    }

    $this->error_if_empty("admission_level");
  }

  function save(){
    if($this->valid()){
      $this->params["badge_number"] = Attendee::next_badge_number();
      $attendee = new Attendee($this->params);
      $attendee->apply_blacklist();
      return $attendee->save();
    }else{
      return false;
    }
  }
}