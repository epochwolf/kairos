<?php 

class RegistrationUpgradeForm extends BaseConfigForm{
  const MODEL = "RegistrationUpgrade";

  public function validate(){
    $this->error_if_empty("from");
    $this->error_if_empty("to");
  }
}