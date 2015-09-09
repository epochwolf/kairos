<?php 

class RegistrationLevelForm extends BaseConfigForm{
  const MODEL = "RegistrationLevel";

  public function validate(){
    $this->error_if_empty("db_name");
    $this->error_if_empty("name");
    $this->error_if_empty("price");
  }
}