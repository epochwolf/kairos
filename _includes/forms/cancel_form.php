<?php 

class CancelForm extends BaseForm{

  public $attendee;

  function __construct($params=[]){
    $this->attendee = Attendee::find($params["id"]);
    $this->params["canceled"] = $this->attendee->canceled;
    parent::__construct($params);
  }

  public function validate(){
    $this->error_if_empty("canceled", "You must confirm this action.");
  }

  function save(){
    if($this->valid()){
      $this->attendee->canceled = $this->params["canceled"];
      return $this->attendee->save();
    }else{
      return false;
    }
  }
}