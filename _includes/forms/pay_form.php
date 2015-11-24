<?php 

class PayForm extends BaseForm{

  public $attendee;

  function __construct($params=[]){
    $this->attendee = Attendee::find($params["id"]);
    $this->params["admission_level"] = $this->attendee->admission_level;
    $this->params["override_price"] = $this->attendee->override_price;
    $this->params["payment_method"] = $this->attendee->payment_method;
    $this->params["badge_type"] = $this->attendee->badge_type;
    parent::__construct($params);
  }

  public function validate(){
    $this->error_if_empty("admission_level");
    $this->error_if_empty("payment_method");
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
      $this->attendee->admission_level = $this->params["admission_level"];
      if(trim($this->params["override_price"]) == ""){
        $this->attendee->override_price = null;
      }else{
        $this->attendee->override_price = $this->params["override_price"];
      }
      $this->attendee->payment_method = $this->params["payment_method"];
      $this->attendee->badge_type = $this->params["badge_type"];
      $this->attendee->paid = true;
      if(array_key_exists("blacklisted", $this->params)){
        $this->attendee->blacklisted = $this->params["blacklisted"];
      }
      return $this->attendee->save();
    }else{
      return false;
    }
  }
}