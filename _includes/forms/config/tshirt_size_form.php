<?php 

class TShirtSizeForm extends BaseConfigForm{
  const MODEL = "TShirtSize";

  public function validate(){
    $this->error_if_empty("db_name");
    $this->error_if_empty("name");
  }
}