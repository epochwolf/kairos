<?php 

class BadgeTypeForm extends BaseConfigForm{
  const MODEL = "BadgeType";

  public function validate(){
    $this->error_if_empty("db_name");
    $this->error_if_empty("name");
  }
}