<?php

function build_button_or_link($label, $attributes, $html_options){
  $tag = "button";

  if(@$html_options["type"] == "link"){
    $tag = "a";
    unset($html_options["type"]);
    unset($attributes["type"]);
    unset($attributes["class"]);
    $attributes["href"] = "#";
  }

  $str = build_html_attributes($attributes, $html_options);
  return "<$tag $str>$label</$tag>";
}

// ATTENDEE SCREENS


function add_attendee_button($html_options=[]){
  $attributes = [
    "class"             => ["btn", "btn-success"],
    "data-toggle"       => "modal",
    "data-target"       => "#standard-modal",
    "data-form"         => "/admin/ajax/forms/add-attendee-form.php", 
    "data-post-form"    => "/admin/ajax/post-actions/post-add-attendee-form.php",
    "data-title"        => "New Attendee",
    "data-submit-label" => "Create",
    "type"              => "button",
  ];

  return build_button_or_link("New Attendee", $attributes, $html_options);
}

function edit_button_for($attendee, $html_options=[]){
  $id = $attendee ? $attendee->id : "";
  $attributes = [
    "class"             => ["btn", "btn-default"],
    "data-toggle"       => "modal",
    "data-target"       => "#standard-modal",
    "data-form"         => "/admin/ajax/forms/edit-form.php?id={$id}", 
    "data-post-form"    => "/admin/ajax/post-actions/post-edit-form.php",
    "data-title"        => "Edit Attendee",
    "data-submit-label" => "Update",
    "type"              => "button",
  ];

  return build_button_or_link("Edit", $attributes, $html_options);
}

function check_in_button_for($attendee, $html_options=[]){
  if($attendee->checked_in){ return ""; }
  if($attendee->canceled){ return ""; }
  $id = $attendee ? $attendee->id : "";
  $attributes = [
    "class"             => ["btn", "btn-default"],
    "data-toggle"       => "modal",
    "data-target"       => "#standard-modal",
    "data-form"         => "/admin/ajax/forms/check-in-form.php?id={$id}", 
    "data-post-form"    => "/admin/ajax/post-actions/post-check-in-form.php",
    "data-title"        => "Check In",
    "data-submit-label" => "Check In",
    "type"              => "button",
  ];

  return build_button_or_link("Check In", $attributes, $html_options);
}

function upgrade_button_for($attendee, $html_options=[]){
  if(!$attendee->paid){ return ""; }
  if($attendee->canceled){ return ""; }
  if(!$attendee->upgradeable()){ return ""; }

  $id = $attendee ? $attendee->id : "";
  $attributes = [
    "class"             => ["btn", "btn-default"],
    "data-toggle"       => "modal",
    "data-target"       => "#standard-modal",
    "data-form"         => "/admin/ajax/forms/upgrade-form.php?id={$id}", 
    "data-post-form"    => "/admin/ajax/post-actions/post-upgrade-form.php",
    "data-title"        => "Upgrade Attendee",
    "data-submit-label" => "Pay",
    "type"              => "button",
  ];

  return build_button_or_link("Upgrade", $attributes, $html_options);
}

function cancel_button_for($attendee, $html_options=[]){
  if($attendee->canceled){ return ""; }
  $id = $attendee ? $attendee->id : "";

  $attributes = [
    "class"             => ["btn", "btn-default"],
    "data-toggle"       => "modal",
    "data-target"       => "#standard-modal",
    "data-form"         => "/admin/ajax/forms/cancel-form.php?id={$id}", 
    "data-post-form"    => "/admin/ajax/post-actions/post-cancel-form.php",
    "data-title"        => $attendee->paid ? "Revoke Badge" : "Delete Order",
    "data-submit-label" => $attendee->paid ? "Revoke" : "Delete",
    "type"              => "button",
  ];

  return build_button_or_link($attendee->paid ? "Revoke" : "Delete", $attributes, $html_options);
}

function reprint_button_for($attendee, $html_options=[]){
  if(!$attendee->paid){ return ""; }
  if(!$attendee->checked_in){ return ""; }
  if($attendee->canceled){ return ""; }
  $id = $attendee ? $attendee->id : "";
  $attributes = [
    "class"             => ["btn", "btn-default"],
    "data-toggle"       => "modal",
    "data-target"       => "#standard-modal",
    "data-form"         => "/admin/ajax/forms/reprint-form.php?id={$id}", 
    "data-post-form"    => "/admin/ajax/post-actions/post-reprint-form.php",
    "data-title"        => "Reprint Badge",
    "data-submit-label" => "Reprint",
    "type"              => "button",
  ];

  return build_button_or_link("Reprint", $attributes, $html_options);
}

// CONFIGURATION SCREENS

function reapply_blacklist_button($html_options=[]){
  $attributes = build_html_attributes([
    "class"             => ["btn", "btn-danger"],
    "data-toggle"       => "modal",
    "data-target"       => "#standard-modal",
    "data-form"         => "/admin/config/ajax/forms/reapply-blacklist.php",
    "data-post-form"    => "/admin/config/ajax/post-actions/reapply-blacklist.php",
    "data-title"        => "Reapply Blacklist",
    "data-submit-label" => "Run",
    "type"              => "button",
  ], $html_options);

  return "<button $attributes>Reapply Blacklist</button>";
}

function new_config_button_for($class, $html_options=[]){
  $class_display_name = $class::DISPLAY_NAME;
  $form_file = strtolower(preg_replace('/([a-z])([A-Z])/', '$1-$2', $class));

  $attributes = build_html_attributes([
    "class"             => ["btn", "btn-success"],
    "data-toggle"       => "modal",
    "data-target"       => "#standard-modal",
    "data-form"         => "/admin/config/ajax/forms/{$form_file}-form.php", 
    "data-post-form"    => "/admin/config/ajax/post-actions/post-form.php",
    "data-title"        => "New {$class_display_name}",
    "data-submit-label" => "Create",
    "type"              => "button",
    "accesskey"         => "n"
  ], $html_options);

  return "<button $attributes>New {$class_display_name}</button>";
}

function edit_config_button_for($record, $html_options=[]){
  $class = get_class($record);
  $class_display_name = $class::DISPLAY_NAME;
  $display_name = $record->display_name();
  $form_file = strtolower(preg_replace('/([a-z])([A-Z])/', '$1-$2', $class));

  $attributes = build_html_attributes([
    "class"             => ["btn", "btn-default"],
    "data-toggle"       => "modal",
    "data-target"       => "#standard-modal",
    "data-form"         => "/admin/config/ajax/forms/{$form_file}-form.php?id={$record->id}", 
    "data-post-form"    => "/admin/config/ajax/post-actions/post-form.php",
    "data-title"        => "Edit {$class_display_name}: {$display_name}",
    "data-submit-label" => "Update",
    "type"              => "button",
  ], $html_options);

  return "<button $attributes>Edit</button>";

}

function delete_config_button_for($record, $html_options=[]){
  $id = $record ? $record->id : "";
  $class = get_class($record);
  $class_display_name = $class::DISPLAY_NAME;
  $display_name = $record->display_name();

  $attributes = build_html_attributes([
    "class"             => ["btn", "btn-danger"],
    "data-toggle"       => "modal",
    "data-target"       => "#standard-modal",
    "data-form"         => "/admin/config/ajax/forms/delete-model-form.php?model={$class}&id={$id}", 
    "data-post-form"    => "/admin/config/ajax/post-actions/delete-model.php",
    "data-title"        => "Delete {$class_display_name}: {$display_name}",
    "data-submit-label" => "Delete",
    "type"              => "button",
  ], $html_options);
  return "<button $attributes>Delete</button>";
}