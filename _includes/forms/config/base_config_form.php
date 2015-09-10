<?php 

class BaseConfigForm extends BaseForm{

  public $model = null;

  function __construct($params=[]){
    $class = static::MODEL;

    if($params["id"]){
      $this->model = $class::find($params["id"]);
    }else{
      $this->model = new $class([]);
      if(in_array("sort_order", $class::FIELDS) && !@$params["sort_order"]){
        $params["sort_order"] = $class::max("sort_order") + 1;
      }
    }
    $this->params = $this->model->attributes();

    parent::__construct($params);
  }

  public function id(){
    return $this->model->id;
  }

  public function is_new_record(){
    return $this->model->is_new_record();
  }

  public function validate(){
  }

  function save(){
    if($this->valid()){
      $class = static::MODEL;
      $safe_fields = array_diff($class::FIELDS, array_flip($class::PROTECTED_FIELDS));

      foreach($safe_fields as $field){
        $this->model->{$field} = $this->params[$field];
      }

      return $this->model->save();
    }else{
      return false;
    }
  }
}