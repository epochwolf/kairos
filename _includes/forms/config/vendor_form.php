<?php 

class VendorForm extends BaseConfigForm{
  const MODEL = "Vendor";

  public function validate(){
    $this->error_if_empty("name");
  }
}