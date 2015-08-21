<?php 
include_once("base_form.php");

class NewAttendeeForm extends BaseForm{

  function __construct($params=[]){
    parent::__construct($params);
    $this->params["original_admission_level"] = @$this->params["admission_level"];
    $this->params["payment_method"] = "cash";
    $this->params["override_price"] = null;
    $this->params["at_door"] = true;
    $this->params["notes"] = null;
    $this->params["paid"] = false;
    $this->params["checked_in"] = false;
    $this->params["badge_reprints"] = 0;
    $d = new DateTime();
    $this->params["created_at"] = $d->format("Y-m-d H:i:s");
    $this->select_badge_type();
    $this->check_against_blacklist();
  }

  public function validate(){
    $this->error_if_empty("legal_name");
    $this->error_if_empty("birthdate");
    if(!$this->error_on("birthdate")){
      $this->error_if_invalid_date("birthdate");
    }

    $this->error_if_empty("address1");
    $this->error_if_empty("city");
    $this->error_if_empty("state_prov");
    $this->error_if_empty("postal_code");

    $this->error_if_empty("phone_number");
    // $this->error_if_empty("email");
    // if(!$this->error_on("email")){
    //   $this->error_unless_regex_match("email", "/@/");
    // }
    if(!empty($this->params["email"])){
      $this->error_unless_regex_match("email", "/@/");
    }

    $age = age_from_birthdate(@$this->params["birthdate"]);
    if($age && $age < 18){
      $this->error_if_empty("adult_legal_name");
      $this->error_if_empty("adult_badge_name");
    }

    $this->error_if_empty("badge_name");
    if(!$this->error_on("badge_name")){
      if(!Attendee::is_unique_badge_name(@$this->params["badge_name"])){
        $this->add_error("badge_name", "Name is already taken.");
      }
    }

    $this->error_if_empty("admission_level");

    if(@$this->params["admission_level"] == "sponsor"){
      $this->error_if_empty("tshirt_size", "Sponsors get a T-Shirt!");
    }else{
      $this->error_unless_empty("tshirt_size", "T-Shirts are only for sponsors.");
    }
    $this->error_if_empty("payment_method", "Select a payment method.");
  }

  function save(){
    if($this->valid()){
      $attendee = new Attendee($this->params);
      return $attendee->save();
    }else{
      return false;
    }
  }

  private function select_badge_type(){
    $age = age_from_birthdate(@$this->params["birthdate"]);
    if($age && $age < 18){
      $this->params["badge_type"] = "minor";
    }else{
      $this->params["badge_type"] = "attendee";
    }
  }

  private function check_against_blacklist(){
    if(!array_key_exists("badge_name", $this->params) && !array_key_exists("legal_name", $this->params)){
      return;
    }
    list($blacklist, $field, $trigger) = Blacklist::match(@$this->params["badge_name"], @$this->params["legal_name"]);
    if($blacklist){
      $this->params["blacklisted"] = true;
      $this->params["blacklist_id"] = $blacklist->id;
      $this->params["blacklist_trigger"] = "$field:$trigger";
      $this->params["banned"] = $blacklist->banned;
    }else{
      $this->params["blacklisted"] = false;
      $this->params["blacklist_id"] = null;
      $this->params["banned"] = 0;
    }
  }
}