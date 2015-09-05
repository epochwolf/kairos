<?php 

function current_user(){
  global $_current_user;
  return $_current_user;
}

function logged_in(){
  if(current_user()){
    return true;
  }else{
    return false;
  }
}

function set_login_cookie($user_id){
  // Cookie is session only.
  setcookie("user-id", strval($user_id), 0);
}

function clear_login_cookie(){
  unset($_COOKIE['user-id']);
  // Leaky abstraction... this is the most reliable way to delete cookies.
  setcookie("user-id", "", time()-3600);
}

function log_in_from_cookie(){
  global $_current_user;

  if(isset($_COOKIE['user-id'])){
    $_current_user = User::find($_COOKIE['user-id']);
    if($_current_user){
      return true;
    }
  }

  return false;
}

function require_login(){
  global $_current_user;

  if(!log_in_from_cookie()){
    header("Location: /login.php");
    exit();
  }
}

function require_admin(){
  require_login();
  $user = current_user();
  if(!$user->admin){
    header("Location: /admin/index.php");
    exit();
  }
}