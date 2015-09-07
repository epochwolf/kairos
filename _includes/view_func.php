<?php

## LINK HELPERS

// Meant for use with bootstrap's navbar.
function nav_link($title, $file, $active=NULL){
  if(is_null($active)){
    $active = $file == $_SERVER['SCRIPT_NAME'];
  }
  if($active){
    return "<li class=\"active\"><a href=\"$file\">$title</a></li>";
  }else{
    return "<li><a href=\"$file\">$title</a></li>";
  }
}


## FORM HELPERS

function label_tag($field_name, $text){
  return "<label for=\"$field_name\">$text</label>";
}

function input_tag($form, $field, $html_options=[]){
  $attributes = build_html_attributes([
    "class" => "form-control",
    "id"    => $field,
    "name"  => $field,
    "value" => @$form->params[$field],
    "type"  => "text",
  ], $html_options);

  return "<input $attributes>";
}

function option_tag($label, $current_value=null, $value=null, $html_options=[]){
  $value = $value ?: $label;
  $attributes = build_html_attributes([
    "selected" => $current_value == $value ? "selected" : null,
    "value" => $value,
  ], $html_options);

  return "<option $attributes>$label</option>";
}

function error_display($form, $field){
  if($message = $form->error_on($field)){
    return '<span class="help-block">'.$message.'</span>';
  }else{
    return '';
  }
}


# FORMATING
function currency($number){
  return '$' . number_format($number);
}

function row_highlight($attendee, $prefix=""){
  $age = $attendee->age() ?: 0;
  if($attendee->blacklisted){
    $type = BlacklistType::find_by_db_name($attendee->blacklist_type);
    $class = $type->alert_color;
    return $prefix ? "$prefix-$class" : "$class";
  }else{
    return "";
  }
}

function admission_display($row){
  $lvl = RegistrationLevel::cached_first_by_db_name($row->admission_level);
  $level = reg_level_with_price($lvl, $row->override_price);
  $badge = badge_label($row->badge_type);
  return "$level $badge";
}

function badge_label($badge_type){
  $type = BadgeType::cached_first_by_db_name($badge_type);

  if($type){
    if($type->label_color){
      return '<span class="label label-' . $type->label_color . '">' . $type->name . '</span>';
    }else{
      return '';
    }
  }else{
    return "";
  }
}

function format_address($address1, $address2, $city, $state, $zip){
  if($address2){
    return "$address1<br>$address2<br>$city, $state $zip";
  }elseif($address1){
    return "$address1<br>$city, $state $zip";
  }else{
    return "";
  }
}

function reg_level_with_price($reg_level, $override_price=null){
  $title = $reg_level->name;
  $price = $reg_level->price;
  
  if(!is_null($override_price) && strval($override_price) == "0"){
    $price = "comped";
  }else{
    $price = currency(is_null($override_price) ? $price : $override_price);
  }
  return "$title ($price)";
}

function hilight_search($search, $string){
  return str_replace($search, "<mark>$search</mark>", $string);
}
