<?
include_once("base_form.php");

class EditForm extends BaseForm{
  public $attendee;

  function __construct($params=[]){
    $this->attendee = Attendee::find($params["id"]);

    $this->params = $this->attendee->attributes();

    parent::__construct($params);
  }

  public function validate(){
    $age = age_from_birthdate(@$this->params["birthdate"]);
    $minor = $age && $age < 18;

    $this->error_if_empty("legal_name");
    $this->error_if_empty("birthdate");
    if(!$this->error_on("birthdate")){
      $this->error_if_invalid_date("birthdate");
    }

    if($minor){
      $this->error_if_empty("adult_legal_name");
      $this->error_if_empty("adult_badge_name");
    }

    if(@$this->params["checked_in"]){
      $this->error_if_empty("badge_number", "Already checked in, field required.");
    }

    if(!empty(@$this->params["badge_number"])){
      if(!Attendee::is_unique_badge_number(@$this->params["badge_number"], $this->attendee)){
        $this->add_error("badge_number", "Number is already assigned.");
      }
    }

    $this->error_if_empty("badge_name");
    if(!$this->error_on("badge_name")){
      if(!Attendee::is_unique_badge_name(@$this->params["badge_name"], $this->attendee)){
        $this->add_error("badge_name", "Name is already taken.");
      }
    }

    $this->error_if_empty("admission_level");
    $this->error_if_empty("payment_method", "Select a payment method.");

    $this->error_if_empty("badge_type");
    if(!$this->error_on("badge_type")){

      if(@$this->params["badge_type"] != "minor" && $minor){
        $this->add_error("badge_type", "Attendee is a minor.");
      }elseif(@$this->params["badge_type"] == "minor" && !$minor){
        $this->add_error("badge_type", "Attendee is not a minor.");
      }
    }
  }

  function save(){
    if($this->valid()){

      $safe_fields = array_diff(Attendee::FIELDS, array_flip(Attendee::PROTECTED_FIELDS));
      foreach($safe_fields as $field){
        $this->attendee->{$field} = $this->params[$field];
      }

      return $this->attendee->save();
    }else{
      return false;
    }
  }
}