<?php

class CheckInForm extends BaseForm{

  public $attendee;

  function __construct($params=[]){
    $this->attendee = Attendee::find($params["id"]);
    $this->params["badge_name"] = $this->attendee->badge_name;
    $this->params["badge_number"] = $this->attendee->badge_number;
    $this->params["badge_type"] = $this->attendee->badge_type;

    $this->params["birthdate"] = $this->attendee->birthdate;
    $this->params["legal_name"] = $this->attendee->legal_name;

    $this->params["admission_level"] = $this->attendee->admission_level;
    $this->params["override_price"] = $this->attendee->override_price;
    $this->params["payment_method"] = $this->attendee->payment_method;

    $this->params["vendor_id"] = $this->attendee->vendor_id;

    $this->params["adult_legal_name"] = $this->attendee->adult_legal_name;
    $this->params["adult_relationship"] = $this->attendee->adult_relationship;
    $this->params["adult_phone_number"] = $this->attendee->adult_phone_number;
    $this->params["adult_badge_number"] = $this->attendee->adult_badge_number;
    parent::__construct($params);
  }

  public function validate(){
    $age = age_from_birthdate(@$this->params["birthdate"]);
    $minor = $age && $age < MINOR_AGE;

    $this->error_if_empty("badge_name");

    $this->error_if_empty("badge_number");
    if(!$this->error_on("badge_number")){
      if(!Attendee::is_unique_badge_number(@$this->params["badge_number"], $this->attendee)){
        $this->add_error("badge_number", "Number is already assigned.");
      }
    }

    $this->error_if_empty("badge_type");
    if(!$this->error_on("badge_type")){
      $badge_type = BadgeType::find_by_db_name(@$this->params["badge_type"]);
      if(!$badge_type->minor && $minor){
        $this->add_error("badge_type", "Attendee is a minor.");
      }elseif($badge_type->minor && !$minor){
        $this->add_error("badge_type", "Attendee is not a minor.");
      }
      if($badge_type->vendor && !$this->params["vendor_id"]){
        $this->add_error("vendor_id", "Vendor Required.");
      }
    }
    $this->error_if_empty("legal_name");

    $this->error_if_empty("birthdate");
    if(!$this->error_on("birthdate")){
      $this->error_if_invalid_date("birthdate");
    }

    if(!$this->attendee->paid){
      $this->error_if_empty("admission_level");
      $this->error_if_empty("payment_method");
    }

    if($minor){
      $this->error_if_empty("adult_relationship");
      
      if($this->params["adult_relationship"] != AdultRelationship::EMANCIPATED){
        $this->error_if_empty("adult_legal_name");
        $this->error_if_empty("adult_phone_number");
      }
    }
  }

  function save(){
    if($this->valid()){
      $this->attendee->badge_number = $this->params["badge_number"];
      $this->attendee->badge_name = $this->params["badge_name"];
      $this->attendee->birthdate = $this->params["birthdate"];
      $this->attendee->badge_type = $this->params["badge_type"];
      $this->attendee->legal_name = $this->params["legal_name"];
      $this->attendee->vendor_id = $this->params["vendor_id"];
      $this->attendee->adult_badge_number = $this->params["adult_badge_number"];
      $this->attendee->adult_relationship = $this->params["adult_relationship"];
      $this->attendee->adult_legal_name = $this->params["adult_legal_name"];
      $this->attendee->adult_phone_number = $this->params["adult_phone_number"];

      if(!$this->attendee->paid){
        $this->attendee->admission_level = $this->params["admission_level"];
        $this->attendee->payment_method = $this->params["payment_method"];

        if(trim($this->params["override_price"]) == ""){
          $this->attendee->override_price = null;
        }else{
          $this->attendee->override_price = $this->params["override_price"];
        }

        $this->attendee->paid = true;
      }

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