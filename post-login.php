<?php
include_once '_includes/framework.php'; 
include_once "_includes/forms/login_form.php";

$form = new LoginForm($_POST);

if(!$form->valid()){
  include "login.php";
}else{
  $form->save();
  header('Location: /admin/index.php');
  die();
}
