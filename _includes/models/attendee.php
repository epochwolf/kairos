<?php

class Attendee extends BaseModel {
  const TABLE_NAME = "attendees";
  const DISPLAY_NAME = "Attendee";

  ## QUERY METHODS
  static function all(){
    return self::query("SELECT * FROM " . static::TABLE_NAME . " ORDER BY created_at DESC");
  }

  static function by_badge_number($number){
    return self::query("SELECT * FROM " . static::TABLE_NAME . " WHERE badge_number = ? ", [$number]);
  }

  static function by_badge_name($name){
    return self::query("SELECT * FROM " . static::TABLE_NAME . " WHERE badge_name = ?", [$name]);
  }

  static function by_blacklist_id($id){
    return self::query("SELECT * FROM " . static::TABLE_NAME . " WHERE blacklist_id = ?", [$id]);
  }

  static function by_badge_type($type){
    return self::query("SELECT * FROM " . static::TABLE_NAME . " WHERE badge_type = ? ORDER BY created_at DESC", [$type]);
  }

  static function pre_reg_pending(){
    $sql = "SELECT * FROM " . static::TABLE_NAME . " WHERE at_door = 0 AND checked_in = 0 ORDER BY created_at DESC";
    return self::query($sql, [':at_door' => 0]);
  }

  static function at_door_pending(){
    $sql = "SELECT * FROM " . static::TABLE_NAME . " WHERE at_door = 1 AND (checked_in = 0 || paid = 0) order by created_at asc";
    return self::query($sql, [':at_door' => 1]);
  }

  static function blacklisted(){
    $sql = "SELECT * FROM " . static::TABLE_NAME . " WHERE blacklisted = 1 OR blacklist_id IS NOT NULL ORDER BY badge_name ASC";
    return self::query($sql);
  }

  static function minors(){
    $sql = "SELECT * FROM " . static::TABLE_NAME . " WHERE FLOOR(DATEDIFF (NOW(), birthdate)/365) < 18 ORDER BY birthdate ASC";
    return self::query($sql);
  }

  static function search($name){
    $sql = "SELECT * FROM " . static::TABLE_NAME . " " .
    "WHERE (badge_number != '0' AND badge_number = :name_exact) " .
    "OR badge_name LIKE :name_like " .
    "OR legal_name LIKE :name_like " .
    "OR phone_number = :name_exact " .
    "OR email LIKE :name_like " .
    "OR adult_badge_name LIKE :name_like " .
    "OR adult_legal_name LIKE :name_like ";
    return self::query($sql, [":name_exact" => $name, ":name_like" => "%$name%"]);
  }

  static function is_unique_badge_name($name, $attendee = null){
    $records = self::by_badge_name($name);
    switch(count($records)){
      case 0: 
        return true;
      case 1:
        if($attendee && $records[0]->id == $attendee->id){
          return true;
        }else{
          return false;
        }
      default:
        return false;
    }
  }

  static function is_unique_badge_number($number, $attendee = null){
    $records = self::by_badge_number($number);
    switch(count($records)){
      case 0: 
        return true;
      case 1:
        if($attendee && $records[0]->id == $attendee->id){
          return true;
        }else{
          return false;
        }
      default:
        return false;
    }
  }


  # INSTANCE

  const FIELDS = [
    "id",
    "badge_number",
    "badge_name",
    "legal_name",
    "company_name",
    "birthdate",
    "address1",
    "address2",
    "city",
    "state_prov",
    "postal_code",
    "phone_number",
    "email",
    "newsletter",
    "badge_type",
    "badge_reprints",
    "original_admission_level",
    "admission_level",
    "tshirt_size",
    "payment_method",
    "override_price",
    "at_door",
    "blacklisted",
    "blacklist_id",
    "blacklist_type",
    "blacklist_message",
    "blacklist_trigger",
    "adult_legal_name",
    "adult_badge_name",
    "checked_in",
    "paid",
    "created_at",
    "notes",
  ];
  const PROTECTED_FIELDS = [
    "id",
    "created_at",
  ];

  private $blacklist_record;

  function __construct($row=[]){
    parent::__construct($row);
    $this->phone_number  = self::phone_to_ui(@$row["phone_number"]);
    $this->birthdate     = self::date_to_ui(@$row["birthdate"]);
  }

  function export_to_db(){
    $array = parent::export_to_db();
    $array["badge_number"]       = self::nullable_string_to_db($this->badge_number);
    $array["birthdate"]          = self::date_to_db($this->birthdate);
    $array["phone_number"]       = self::phone_to_db($this->phone_number);
    $array["newsletter"]         = self::bool_to_db($this->newsletter);
    $array["tshirt_size"]        = self::nullable_string_to_db($this->tshirt_size);
    $array["override_price"]     = self::override_price_to_db($this->override_price);
    $array["at_door"]            = self::bool_to_db($this->at_door);
    $array["blacklisted"]        = self::bool_to_db($this->blacklisted);
    $array["blacklist_type"]     = self::nullable_string_to_db($this->blacklist_type);
    $array["blacklist_message"]  = self::nullable_string_to_db($this->blacklist_message);
    $array["adult_legal_name"]   = self::nullable_string_to_db($this->adult_legal_name);
    $array["adult_badge_name"]   = self::nullable_string_to_db($this->adult_badge_name);
    $array["checked_in"]         = self::bool_to_db($this->checked_in);
    $array["paid"]               = self::bool_to_db($this->paid);
    $array["created_at"]         = $this->created_at;
    $array["notes"]              = self::nullable_string_to_db($this->notes);
    return $array;
  }

  function display_name(){
    return "{$this->badge_name} / {$this->legal_name}";
  }

  function adult_display_name(){
    if($this->minor()){
      return "{$this->adult_badge_name} / {$this->adult_legal_name}";
    }else{
      return "";
    }
  }

  function age(){
    return age_from_birthdate($this->birthdate);
  }

  function minor(){
    return $this->age() < 18;
  }

  // function upgradeable(){
  //   global $REGISTRATION_UPGRADE_PRICING;
  //   return array_key_exists($this->admission_level, $REGISTRATION_UPGRADE_PRICING);
  // }

  function upgradeable(){
    $upgrade = RegistrationUpgrade::cached_available_for($this->admission_level);
    return $upgrade ? true : false;
  }

  function blacklist(){
    if(isset($this->blacklist_record)){ return $this->blacklist_record;}
    if($this->blacklist_id){
      $this->blacklist_record = Blacklist::find($this->blacklist_id);
      return $this->blacklist_record;
    }else{
      return null;
    }
  }

  function formatted_address(){
    return format_address($this->address1, $this->address2, $this->city, $this->state_prov, $this->postal_code);
  }

  static function override_price_to_db($override_price){
    $override_price = preg_replace("/[^\d]*/", "", $override_price);
    if(trim($override_price) === ""){
      return null;
    }else{
      return floatval($override_price);
    }
  }

  function after_create(){
    $this->write_to_log("created");
    return true;
  }

  function after_update(){
    $this->write_to_log("updated");
    return true;
  }

  protected function write_to_log($operation){
    AttendeeLog::log($operation, $this);
  }

  function apply_blacklist(){
    if(empty($this->badge_name) && empty($this->legal_name)){ return; }

    list($blacklist, $field, $trigger) = Blacklist::match($this->badge_name, $this->legal_name);
    if($blacklist){
      $this->blacklisted = true;
      $this->blacklist_id = $blacklist->id;
      $this->blacklist_trigger = "$field:$trigger";
      $this->blacklist_type = $blacklist->type;
      $this->blacklist_message = $blacklist->reason;
    }else{
      if($this->blacklisted && !$this->blacklist_id){
        // Manual blacklists shouldn't be reset. 
        return;
      }
      $this->blacklisted = false;
      $this->blacklist_id = null;
      $this->blacklist_trigger = null;
      $this->blacklist_type = null;
      $this->blacklist_message = null;
    }
  }
}