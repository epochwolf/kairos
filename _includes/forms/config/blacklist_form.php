<?php 

class BlacklistForm extends BaseForm{

  public $blacklist;

  function __construct($params=[]){
    if($params["id"]){
      $this->blacklist = Blacklist::find($params["id"]);
    }else{
      $this->blacklist = new Blacklist([]);
    }

    $this->params = $this->blacklist->attributes();

    parent::__construct($params);
  }

  public function validate(){
    if($this->params["trigger_legal_names"] && preg_match("/^\*|\*$/", $this->params["trigger_legal_names"])){
      $this->add_error("trigger_legal_names", "Trigger should not start or end with *." );
    }
    if($this->params["trigger_badge_names"] && preg_match("/^\*|\*$/", $this->params["trigger_badge_names"])){
      $this->add_error("trigger_badge_names", "Trigger should not start or end with *." );
    }
  }

  function save(){
    if($this->valid()){

      $safe_fields = array_diff(Blacklist::FIELDS, array_flip(Blacklist::PROTECTED_FIELDS));
      foreach($safe_fields as $field){
        $this->blacklist->{$field} = $this->params[$field];
      }

      return $this->blacklist->save();
    }else{
      return false;
    }
  }
}