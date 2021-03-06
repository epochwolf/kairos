<?php 

class CSVImportAttendeeForm extends BaseForm{

  const VALID_FIELDS = [
    "badge_number",
    "badge_name",
    "legal_name",
    "vendor_id",
    "birthdate",
    // "address1",
    // "address2",
    // "city",
    // "state_prov",
    // "postal_code",
    "phone_number",
    "email",
    "badge_type",
    "admission_level",
    "tshirt_size",
    "payment_method",
    "price",
    "adult_legal_name",
    "adult_phone_number",
    "notes",
  ];


  function __construct($params=[]){
    $clean_params = array_intersect_key($params, array_flip(static::VALID_FIELDS));
    parent::__construct($clean_params);

    $this->params["override_price"] = $params["price"];
    $this->params["original_admission_level"] = @$this->params["admission_level"];
    $this->params["at_door"] = false;
    $this->params["paid"] = true;
    $this->params["checked_in"] = false;
    $this->params["canceled"] = false;
    $this->params["badge_reprints"] = 0;
    $d = new DateTime();
    $this->params["created_at"] = $d->format("Y-m-d H:i:s");

    if(!@$this->params["badge_type"]){
      $this->select_badge_type();
    }
  }

  public function validate(){
    $age = age_from_birthdate(@$this->params["birthdate"]);
    $minor = $age && $age < MINOR_AGE;

    $this->error_if_empty("legal_name");
    $this->error_if_empty("badge_name");

    if(!empty(@$this->params["badge_number"])){
      if(!Attendee::is_unique_badge_number(@$this->params["badge_number"])){
        $this->add_error("badge_number", "Number is already assigned.");
      }
    }

    $this->error_if_empty("birthdate");
    if(!$this->error_on("birthdate")){
      $this->error_if_invalid_date("birthdate");
    }

    $this->error_if_empty("admission_level");
    //$this->error_if_empty("payment_method");

    if(!$this->error_on("admission_level")){
      $this->error_unless_in_list("admission_level", static::valid_admission_levels());
    }

    if(!empty(@$this->params["vendor_id"])){
      $this->error_unless_in_list("vendor_id", static::valid_vendor_ids());
    }

    if(!@$this->params["payment_method"]){
      $this->error_unless_in_list("payment_method", static::valid_payment_types());
    }

    if(@$this->params["tshirt_size"]){
      $this->error_unless_in_list("tshirt_size", static::valid_tshirt_sizes());
    }

    if(@$this->params["badge_type"]){
      $this->error_unless_in_list("badge_type", static::valid_badge_types());

      if(!$this->error_on("badge_type")){
        $badge_type = BadgeType::cached_find_by_db_name(@$this->params["badge_type"]);
        if(!$badge_type->minor && $minor){
          $this->add_error("badge_type", "Attendee is a minor.");
        }elseif($badge_type->minor && !$minor){
          $this->add_error("badge_type", "Attendee is not a minor.");
        }
      }
    }

    //$this->error_if_empty("address1");
    //$this->error_if_empty("city");
    //$this->error_if_empty("state_prov");
    //$this->error_if_empty("postal_code");

    //$this->error_if_empty("phone_number");

    // $this->error_if_empty("email");
    // if(!$this->error_on("email")){
    //   $this->error_unless_regex_match("email", "/@/");
    // }

    // if(!empty($this->params["email"])){
    //   $this->error_unless_regex_match("email", "/@/");
    // }

    // $age = age_from_birthdate(@$this->params["birthdate"]);
    // if($age && $age < MINOR_AGE){
    //   $this->error_if_empty("adult_legal_name");
    //   $this->error_if_empty("adult_phone_number");
    // }

    // if(!$this->error_on("admission_level")){
    //   $lvl = RegistrationLevel::find_by_db_name(@$this->params["admission_level"]);
    //   if($lvl && $lvl->includes_tshirt){
    //     $this->error_if_empty("tshirt_size", "{$lvl->name} includes a T-Shirt.");
    //   }else{
    //     $this->error_unless_empty("tshirt_size", "Level doesn't include T-Shirt.");
    //   }
    // }

    // $this->error_if_empty("payment_method", "Select a payment method.");
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

  protected function select_badge_type(){
    $age = age_from_birthdate(@$this->params["birthdate"]);
    if($age && $age < MINOR_AGE){
      $badge_type = BadgeType::default_minor();
    }else{
      $badge_type = BadgeType::default_adult();
    }
    $this->params["badge_type"] = $badge_type->db_name;
  }

  protected static function valid_admission_levels(){
    return array_map(function($lvl){ return $lvl->db_name; }, RegistrationLevel::cached_all());
  }
  
  protected static function valid_payment_types(){
    return array_map(function($lvl){ return $lvl->db_name; }, PaymentType::cached_all());
  }
  
  protected static function valid_tshirt_sizes(){
    return array_map(function($lvl){ return $lvl->db_name; }, TShirtSize::cached_all());
  }

  protected static function valid_badge_types(){
    return array_map(function($lvl){ return $lvl->db_name; }, BadgeType::cached_all());
  }

  protected static function valid_vendor_ids(){
    return array_map(function($lvl){ return $lvl->id; }, Vendor::cached_all());
  }
}