<?php 

class UserForm extends BaseForm{

  public $user;

  function __construct($params=[]){
    if($params["id"]){
      $this->user = User::find($params["id"]);
    }else{
      $this->user = new User([]);
    }
    $this->params["username"] = $this->user->username;
    $this->params["password"] = null;
    $this->params["admin"] = $this->user->admin;
    parent::__construct($params);
  }

  public function validate(){
    $this->error_if_empty("username");
    if($this->user->is_new_record()){
      $this->error_if_empty("password");
    }

    if(User::count_admins() < 2 && $this->user->admin && !$this->params["admin"]){
      $this->add_error("admin", "Can't remove last admin.");
    }
  }

  function save(){
    if($this->valid()){
      $this->user->username = $this->params["username"];
      $this->user->admin    = $this->params["admin"];

      if($this->params["password"]){
        $this->user->password = $this->params["password"];
      }
      
      return $this->user->save();
    }else{
      return false;
    }
  }
}