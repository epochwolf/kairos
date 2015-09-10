<?php

abstract class BaseForm{
  public $params = [];
  public $valid = null;
  public $errors = [];
  
  abstract public function validate();

  function __construct($params=[]){
    $this->params = array_merge($this->params, $params);
  }

  function valid(){
    if(empty($this->params)){ return false; }
    if(is_null($this->valid)){
      $this->validate();
      $this->valid = empty($this->errors);
    }
    return $this->valid;
  }

  # Slightly different behavior from valid(). 
  # Will return false if params is empty.
  function has_errors(){
    valid();
    return !empty($this->errors);
  }
  
  function error_on($field){
    return @$this->errors[$field];
  }

  protected function error_unless_regex_match($field, $regex, $message="Invalid format."){
    if(!preg_match($regex, @strval(@$this->params[$field]))){
      $this->add_error($field, $message);
    }
  }

  protected function error_if_invalid_date($field, $format = "m/d/Y", $message="Invalid date format. Expected MM/DD/YYYY."){
    $field_value = @$this->params[$field];
    $date = DateTime::createFromFormat($format, $field_value);
    if(!($date && $date->format($format) == $field_value)){
      $this->add_error($field, $message);
    }
  }

  protected function error_if_empty($field, $message="Can't be empty."){
    if(empty(@$this->params[$field])){
      $this->add_error($field, $message);
    }
  }

  protected function error_unless_empty($field, $message="Must be empty."){
    if(!empty(@$this->params[$field])){
      $this->add_error($field, $message);
    }
  }

  protected function error_unless_in_list($field, $list, $message="Not a valid value."){
    if(!in_array(@$this->params[$field], $list)){
      $this->add_error($field, $message);
    }
  }

  protected function add_error($field, $message){
    $this->errors[$field] = $message;
  }

}
