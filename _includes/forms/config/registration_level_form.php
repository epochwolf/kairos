<?php 

class RegistrationLevelForm extends BaseForm{

  public $registration_level;

  function __construct($params=[]){
    if($params["id"]){
      $this->registration_level = RegistrationLevel::find($params["id"]);
    }else{
      $this->registration_level = new RegistrationLevel([]);
    }

    $this->params = $this->registration_level->attributes();

    parent::__construct($params);
  }

  public function validate(){
    $this->error_if_empty("db_name");
    $this->error_if_empty("name");
    $this->error_if_empty("price");
  }

  function save(){
    if($this->valid()){

      $safe_fields = array_diff(RegistrationLevel::FIELDS, array_flip(RegistrationLevel::PROTECTED_FIELDS));
      foreach($safe_fields as $field){
        $this->registration_level->{$field} = $this->params[$field];
      }

      return $this->registration_level->save();
    }else{
      return false;
    }
  }
}