<?php 

class TShirtSizeForm extends BaseForm{

  public $TShirtSize;

  function __construct($params=[]){
    if($params["id"]){
      $this->tshirt_size = TShirtSize::find($params["id"]);
    }else{
      $this->tshirt_size = new TShirtSize([]);
    }

    $this->params = $this->tshirt_size->attributes();

    parent::__construct($params);
  }

  public function validate(){
    $this->error_if_empty("db_name");
    $this->error_if_empty("name");
  }

  function save(){
    if($this->valid()){

      $safe_fields = array_diff(TShirtSize::FIELDS, array_flip(TShirtSize::PROTECTED_FIELDS));
      foreach($safe_fields as $field){
        $this->tshirt_size->{$field} = $this->params[$field];
      }

      return $this->tshirt_size->save();
    }else{
      return false;
    }
  }
}