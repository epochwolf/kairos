<?php 
include_once("base_form.php");

class LoginForm extends BaseForm{

  public $user;

  function __construct($params=[]){
    parent::__construct($params);
  }

  public function validate(){
    $this->create_inital_user();

    $this->error_if_empty("username");
    $this->error_if_empty("password");

    $this->user = User::find_by_username($this->params["username"]);
    if($this->user){
      if($this->user->check_password($this->params["password"])){
        return true;
      }else{
        $this->add_error("password", "Invalid password");
      }
    }else{
      $this->add_error("username", "Invalid username");
    }
    return false;
  }

  function save(){
    if($this->valid()){
      set_login_cookie($this->user->id);
      return true;
    }else{
      return false;
    }
  }

  private function create_inital_user(){
    if(User::count() == 0){
      $user = new User(["username" => "admin", "password" => "admin", "admin" => true]);
      $user->save();
    }
  }
}