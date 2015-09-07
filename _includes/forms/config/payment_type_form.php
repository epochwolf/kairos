<?php 

class PaymentTypeForm extends BaseForm{

  public $payment_type;

  function __construct($params=[]){
    if($params["id"]){
      $this->payment_type = PaymentType::find($params["id"]);
    }else{
      $this->payment_type = new PaymentType([]);
    }

    $this->params = $this->payment_type->attributes();

    parent::__construct($params);
  }

  public function validate(){
    $this->error_if_empty("db_name");
    $this->error_if_empty("name");
  }

  function save(){
    if($this->valid()){

      $safe_fields = array_diff(PaymentType::FIELDS, array_flip(PaymentType::PROTECTED_FIELDS));
      foreach($safe_fields as $field){
        $this->payment_type->{$field} = $this->params[$field];
      }

      return $this->payment_type->save();
    }else{
      return false;
    }
  }
}