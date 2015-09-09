<?php 

class PaymentTypeForm extends BaseConfigForm{
  const MODEL = "PaymentType";

  public function validate(){
    $this->error_if_empty("db_name");
    $this->error_if_empty("name");
  }
}