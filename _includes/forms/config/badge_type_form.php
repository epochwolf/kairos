<?php 

class BadgeTypeForm extends BaseForm{

  public $badge_type;

  function __construct($params=[]){
    if($params["id"]){
      $this->badge_type = BadgeType::find($params["id"]);
    }else{
      $this->badge_type = new BadgeType([]);
    }

    $this->params = $this->badge_type->attributes();

    parent::__construct($params);
  }

  public function validate(){
    $this->error_if_empty("db_name");
    $this->error_if_empty("name");
  }

  function save(){
    if($this->valid()){

      $safe_fields = array_diff(BadgeType::FIELDS, array_flip(BadgeType::PROTECTED_FIELDS));
      foreach($safe_fields as $field){
        $this->badge_type->{$field} = $this->params[$field];
      }

      return $this->badge_type->save();
    }else{
      return false;
    }
  }
}