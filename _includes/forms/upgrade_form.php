<?php 

class UpgradeForm extends BaseForm{

  public $attendee;

  function __construct($params=[]){
    $this->attendee = Attendee::find($params["id"]);
    $this->params["admission_level"] = $this->attendee->admission_level;
    parent::__construct($params);
  }

  public function validate(){
    $this->error_if_empty("admission_level");
  }

  function save(){
    if($this->valid()){
      $this->attendee->admission_level = $this->params["admission_level"];
      return $this->attendee->save();
    }else{
      return false;
    }
  }
}