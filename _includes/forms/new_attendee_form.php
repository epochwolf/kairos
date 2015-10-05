<?php 

class NewAttendeeForm extends BaseForm{

  function __construct($params=[]){
    parent::__construct($params);
    $this->params["original_admission_level"] = @$this->params["admission_level"];
    $this->params["payment_method"] = @$this->params["payment_method"] ?: "cash";
    $this->params["override_price"] = null;
    $this->params["at_door"] = true;
    $this->params["notes"] = null;
    $this->params["paid"] = false;
    $this->params["checked_in"] = false;
    $this->params["badge_reprints"] = 0;
    $d = new DateTime();
    $this->params["created_at"] = $d->format("Y-m-d H:i:s");
    $this->select_badge_type();
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

    $this->error_if_empty("admission_level");

    if(!$this->error_on("admission_level")){
      $lvl = RegistrationLevel::find_by_db_name(@$this->params["admission_level"]);
      if($lvl && $lvl->includes_tshirt){
        $this->error_if_empty("tshirt_size", "{$lvl->name} includes a T-Shirt.");
      }else{
        $this->error_unless_empty("tshirt_size", "Level doesn't include T-Shirt.");
      }
    }

    $this->error_if_empty("payment_method", "Select a payment method.");
  }

  function save(){
    if($this->valid()){
      $attendee = new Attendee($this->params);
      $attendee->apply_blacklist();
      return $attendee->save();
    }else{
      return false;
    }
  }

  private function select_badge_type(){
    $age = age_from_birthdate(@$this->params["birthdate"]);
    if($age && $age < 18){
      $badge_type = BadgeType::default_minor();
    }else{
      $badge_type = BadgeType::default_adult();
    }
    $this->params["badge_type"] = $badge_type->db_name;
  }
}