<?php
isset($CONFIG) or die("Fatal: _includes/config.php wasn't included.");


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

function edit_button_for($attendee, $html_options=[]){
  $attributes = build_html_attributes([
    "class"        => ["btn", "btn-default"],
    "data-toggle"  => "modal",
    "data-target"  => "#edit-modal",
    "data-id"      => $attendee->id,
    "type"         => "button",
  ], $html_options);

  return "<button $attributes>Edit</button>";
}

function upgrade_button_for($attendee, $html_options=[]){
  if(!$attendee->paid){ return ""; }
  if(!$attendee->upgradeable()){ return ""; }
  $attributes = build_html_attributes([
    "class"        => ["btn", "btn-default"],
    "data-toggle"  => "modal",
    "data-target"  => "#upgrade-modal",
    "data-id"      => $attendee->id,
    "type"         => "button",
  ], $html_options);

  return "<button $attributes>Upgrade</button>";
}

function check_in_button_for($attendee, $html_options=[]){
  if($attendee->checked_in){ return ""; }
  $attributes = build_html_attributes([
    "class"        => ["btn", "btn-default"],
    "data-toggle"  => "modal",
    "data-target"  => "#check-in-modal",
    "data-id"      => $attendee->id,
    "type"         => "button",
  ], $html_options);

  return "<button $attributes>Check In</button>";
}

function pay_button_for($attendee, $html_options=[]){
  if($attendee->paid){ return ""; }
  $attributes = build_html_attributes([
    "class"        => ["btn", "btn-default"],
    "data-toggle"  => "modal",
    "data-target"  => "#pay-modal",
    "data-id"      => $attendee->id,
    "type"         => "button",
  ], $html_options);

  return "<button $attributes>Pay</button>";
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
  if($attendee->blacklisted()){
    $class = $attendee->banned ? "danger" : "warning";
    return $prefix ? "$prefix-$class" : "$class";
  }else{
    return "";
  }
}

function admission_display($row){
  $level = reg_level_with_price($row->admission_level, $row->override_price);
  $badge = badge_label($row->badge_type);
  return "$level $badge";
}

function badge_type($badge_type){
  global $BADGE_TYPES;

  if(array_key_exists($badge_type, $BADGE_TYPES)){
    return $BADGE_TYPES[$badge_type];
  }else{
    return "Unknown Level";
  }
}

function badge_label($badge_type){
  global $BADGE_LABELS;

  if($label = @$BADGE_LABELS[$badge_type]){
    return '<span class="label ' . $label . '">' . badge_type($badge_type) . '</span>';
  }else{
    return "";
  }
}

function reg_level($reg_level){
  global $REGISTRATION_LEVELS;

  if(array_key_exists($reg_level, $REGISTRATION_LEVELS)){
    return $REGISTRATION_LEVELS[$reg_level];
  }else{
    return "Unknown Level";
  }
}

function reg_price($reg_level){
  global $REGISTRATION_PRICING;

  if(array_key_exists($reg_level, $REGISTRATION_PRICING)){
    return $REGISTRATION_PRICING[$reg_level];
  }else{
    return 0;
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
  $title = reg_level($reg_level);
  if(!is_null($override_price) && strval($override_price) == "0"){
    $price = "comped";
  }else{
    $price = currency(is_null($override_price) ? reg_price($reg_level) : $override_price);
  }
  return "$title ($price)";
}

function hilight_search($search, $string){
  return str_replace($search, "<mark>$search</mark>", $string);
}
