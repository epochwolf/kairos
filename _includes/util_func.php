<?php

function age_from_birthdate($birthdate){
  try{
    if($birthdate){
      $date = new DateTime($birthdate);
      $now = new DateTime();
      $interval = $now->diff($date);
      return $interval->y;
    }else{
      return null;
    }
  } catch(Exception $e){
    return null;
  }
}

function build_html_attributes($defaults, $html_options=[]){
  $html_options = array_merge_recursive($defaults, $html_options);

  $attributes = "";
  foreach($html_options as $k => $v){
    if(is_null($v)){ continue; }
    if(is_array($v)){ 
      if($k == "class"){
        $v = implode(" ", $v);
      }else{
        $v = end($v);
      } 
    }
    $v = htmlspecialchars(strval($v));
    $attributes .= " $k='$v'";
  }
  return $attributes;
}