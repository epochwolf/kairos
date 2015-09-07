<?php 

class RegistrationUpgradeForm extends BaseForm{

  public $registration_upgrade;

  function __construct($params=[]){
    if($params["id"]){
      $this->registration_upgrade = RegistrationUpgrade::find($params["id"]);
    }else{
      $this->registration_upgrade = new RegistrationUpgrade([]);
    }

    $this->params = $this->registration_upgrade->attributes();

    parent::__construct($params);
  }

  public function validate(){
    $this->error_if_empty("from");
    $this->error_if_empty("to");
  }

  function save(){
    if($this->valid()){

      $safe_fields = array_diff(RegistrationUpgrade::FIELDS, array_flip(RegistrationUpgrade::PROTECTED_FIELDS));
      foreach($safe_fields as $field){
        $this->registration_upgrade->{$field} = $this->params[$field];
      }

      return $this->registration_upgrade->save();
    }else{
      return false;
    }
  }
}