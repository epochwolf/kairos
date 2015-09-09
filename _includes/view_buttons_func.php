<?php

// ATTENDEE SCREENS

function edit_button_for($attendee, $html_options=[]){
  $attributes = build_html_attributes([
    "class"             => ["btn", "btn-default"],
    "data-toggle"       => "modal",
    "data-target"       => "#standard-modal",
    "data-form"         => "/admin/ajax/forms/edit-form.php",
    "data-post-form"    => "/admin/ajax/post-actions/post-edit-form.php",
    "data-title"        => "Edit Attendee",
    "data-submit-label" => "Update",
    "data-id"           => $attendee->id,
    "type"              => "button",
  ], $html_options);

  return "<button $attributes>Edit</button>";
}

function upgrade_button_for($attendee, $html_options=[]){
  if(!$attendee->paid){ return ""; }
  if(!$attendee->upgradeable()){ return ""; }
  $attributes = build_html_attributes([
    "class"             => ["btn", "btn-default"],
    "data-toggle"       => "modal",
    "data-target"       => "#standard-modal",
    "data-form"         => "/admin/ajax/forms/upgrade-form.php",
    "data-post-form"    => "/admin/ajax/post-actions/post-upgrade-form.php",
    "data-title"        => "Upgrade Attendee",
    "data-submit-label" => "Pay",
    "data-id"           => $attendee->id,
    "type"              => "button",
  ], $html_options);

  return "<button $attributes>Upgrade</button>";
}

function check_in_button_for($attendee, $html_options=[]){
  if($attendee->checked_in){ return ""; }
  $attributes = build_html_attributes([
    "class"             => ["btn", "btn-default"],
    "data-toggle"       => "modal",
    "data-target"       => "#standard-modal",
    "data-form"         => "/admin/ajax/forms/check-in-form.php",
    "data-post-form"    => "/admin/ajax/post-actions/post-check-in-form.php",
    "data-title"        => "Check In",
    "data-submit-label" => "Check In",
    "data-id"           => $attendee->id,
    "type"              => "button",
  ], $html_options);

  return "<button $attributes>Check In</button>";
}

function pay_button_for($attendee, $html_options=[]){
  if($attendee->paid){ return ""; }
  $attributes = build_html_attributes([
    "class"             => ["btn", "btn-default"],
    "data-toggle"       => "modal",
    "data-target"       => "#standard-modal",
    "data-form"         => "/admin/ajax/forms/pay-form.php",
    "data-post-form"    => "/admin/ajax/post-actions/post-pay-form.php",
    "data-title"        => "Payment",
    "data-submit-label" => "Pay",
    "data-id"           => $attendee->id,
    "type"              => "button",
  ], $html_options);

  return "<button $attributes>Pay</button>";
}

function reprint_button_for($attendee, $html_options=[]){
  if(!$attendee->paid){ return ""; }
  if(!$attendee->checked_in){ return ""; }
  $attributes = build_html_attributes([
    "class"             => ["btn", "btn-default"],
    "data-toggle"       => "modal",
    "data-target"       => "#standard-modal",
    "data-form"         => "/admin/ajax/forms/reprint-form.php",
    "data-post-form"    => "/admin/ajax/post-actions/post-reprint-form.php",
    "data-title"        => "Reprint Badge",
    "data-submit-label" => "Reprint",
    "data-id"           => $attendee->id,
    "type"              => "button",
  ], $html_options);

  return "<button $attributes>Reprint</button>";
}

// CONFIGURATION SCREENS

function blacklist_button_for($blacklist=null, $html_options=[]){
  $attributes = build_html_attributes([
    "class"             => $blacklist ? ["btn", "btn-default"] : ["btn", "btn-success"],
    "data-toggle"       => "modal",
    "data-target"       => "#standard-modal",
    "data-form"         => "/admin/config/ajax/forms/blacklist-form.php",
    "data-post-form"    => "/admin/config/ajax/post-actions/post-blacklist-form.php",
    "data-title"        => $blacklist ? "Edit Blacklist: {$blacklist->badge_name}" : "New Blacklist",
    "data-submit-label" => $blacklist ? "Update" : "Create",
    "data-id"           => $blacklist ? $blacklist->id : "",
    "type"              => "button",
  ], $html_options);
  $label = $blacklist ? "Edit" : "New Blacklist";

  return "<button $attributes>$label</button>";
}

function delete_blacklist_button_for($blacklist=null, $html_options=[]){
  $attributes = build_html_attributes([
    "class"             => ["btn", "btn-danger"],
    "data-toggle"       => "modal",
    "data-target"       => "#standard-modal",
    "data-form"         => "/admin/config/ajax/forms/delete-blacklist-form.php",
    "data-post-form"    => "/admin/config/ajax/post-actions/delete-blacklist.php",
    "data-title"        => "Delete Blacklist: {$blacklist->badge_name}",
    "data-submit-label" => "Delete",
    "data-id"           => $blacklist->id,
    "type"              => "button",
  ], $html_options);

  return "<button $attributes>Delete</button>";
}


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


function registration_level_button_for($registration_level=null, $html_options=[]){
  $attributes = build_html_attributes([
    "class"             => $registration_level ? ["btn", "btn-default"] : ["btn", "btn-success"],
    "data-toggle"       => "modal",
    "data-target"       => "#standard-modal",
    "data-form"         => "/admin/config/ajax/forms/registration-level-form.php",
    "data-post-form"    => "/admin/config/ajax/post-actions/post-registration-level-form.php",
    "data-title"        => $registration_level ? "Edit Registration Level: {$registration_level->name}" : "New Registration Level",
    "data-submit-label" => $registration_level ? "Update" : "Create",
    "data-id"           => $registration_level ? $registration_level->id : "",
    "type"              => "button",
  ], $html_options);
  $label = $registration_level ? "Edit" : "New Registration Level";

  return "<button $attributes>$label</button>";
}

function delete_registration_level_button_for($registration_level=null, $html_options=[]){
  $attributes = build_html_attributes([
    "class"             => ["btn", "btn-danger"],
    "data-toggle"       => "modal",
    "data-target"       => "#standard-modal",
    "data-form"         => "/admin/config/ajax/forms/delete-registration-level-form.php",
    "data-post-form"    => "/admin/config/ajax/post-actions/delete-registration-level.php",
    "data-title"        => "Delete Registration Level: {$registration_level->name}",
    "data-submit-label" => "Delete",
    "data-id"           => $registration_level->id,
    "type"              => "button",
  ], $html_options);

  return "<button $attributes>Delete</button>";
}


function registration_upgrade_button_for($registration_upgrade=null, $html_options=[]){
  $attributes = build_html_attributes([
    "class"             => $registration_upgrade ? ["btn", "btn-default"] : ["btn", "btn-success"],
    "data-toggle"       => "modal",
    "data-target"       => "#standard-modal",
    "data-form"         => "/admin/config/ajax/forms/registration-upgrade-form.php",
    "data-post-form"    => "/admin/config/ajax/post-actions/post-registration-upgrade-form.php",
    "data-title"        => $registration_upgrade ? "Edit Registration Upgrade: {$registration_upgrade->from} -> {$registration_upgrade->to}" : "New Registration Upgrade",
    "data-submit-label" => $registration_upgrade ? "Update" : "Create",
    "data-id"           => $registration_upgrade ? $registration_upgrade->id : "",
    "type"              => "button",
  ], $html_options);
  $label = $registration_upgrade ? "Edit" : "New Registration Upgrade";

  return "<button $attributes>$label</button>";
}

function delete_registration_upgrade_button_for($registration_upgrade=null, $html_options=[]){
  $attributes = build_html_attributes([
    "class"             => ["btn", "btn-danger"],
    "data-toggle"       => "modal",
    "data-target"       => "#standard-modal",
    "data-form"         => "/admin/config/ajax/forms/delete-registration-upgrade-form.php",
    "data-post-form"    => "/admin/config/ajax/post-actions/delete-registration-upgrade.php",
    "data-title"        => "Delete Registration Upgrade: {$registration_upgrade->from} -> {$registration_upgrade->to}",
    "data-submit-label" => "Delete",
    "data-id"           => $registration_upgrade->id,
    "type"              => "button",
  ], $html_options);

  return "<button $attributes>Delete</button>";
}


function badge_type_button_for($badge_type=null, $html_options=[]){
  $attributes = build_html_attributes([
    "class"             => $badge_type ? ["btn", "btn-default"] : ["btn", "btn-success"],
    "data-toggle"       => "modal",
    "data-target"       => "#standard-modal",
    "data-form"         => "/admin/config/ajax/forms/badge-type-form.php",
    "data-post-form"    => "/admin/config/ajax/post-actions/post-badge-type-form.php",
    "data-title"        => $badge_type ? "Edit Badge Type: {$badge_type->name}" : "New Badge Type",
    "data-submit-label" => $badge_type ? "Update" : "Create",
    "data-id"           => $badge_type ? $badge_type->id : "",
    "type"              => "button",
  ], $html_options);
  $label = $badge_type ? "Edit" : "New Badge Type";

  return "<button $attributes>$label</button>";
}

function delete_badge_type_button_for($badge_type=null, $html_options=[]){
  $attributes = build_html_attributes([
    "class"             => ["btn", "btn-danger"],
    "data-toggle"       => "modal",
    "data-target"       => "#standard-modal",
    "data-form"         => "/admin/config/ajax/forms/delete-badge-type-form.php",
    "data-post-form"    => "/admin/config/ajax/post-actions/delete-badge-type.php",
    "data-title"        => "Delete Badge Type: {$badge_type->name}",
    "data-submit-label" => "Delete",
    "data-id"           => $badge_type->id,
    "type"              => "button",
  ], $html_options);

  return "<button $attributes>Delete</button>";
}


function payment_type_button_for($payment_type=null, $html_options=[]){
  $attributes = build_html_attributes([
    "class"             => $payment_type ? ["btn", "btn-default"] : ["btn", "btn-success"],
    "data-toggle"       => "modal",
    "data-target"       => "#standard-modal",
    "data-form"         => "/admin/config/ajax/forms/payment-type-form.php",
    "data-post-form"    => "/admin/config/ajax/post-actions/post-payment-type-form.php",
    "data-title"        => $payment_type ? "Edit Payment Type: {$payment_type->name}" : "New Payment Type",
    "data-submit-label" => $payment_type ? "Update" : "Create",
    "data-id"           => $payment_type ? $payment_type->id : "",
    "type"              => "button",
  ], $html_options);
  $label = $payment_type ? "Edit" : "New Payment Type";

  return "<button $attributes>$label</button>";
}

function delete_payment_type_button_for($payment_type=null, $html_options=[]){
  $attributes = build_html_attributes([
    "class"             => ["btn", "btn-danger"],
    "data-toggle"       => "modal",
    "data-target"       => "#standard-modal",
    "data-form"         => "/admin/config/ajax/forms/delete-payment-type-form.php",
    "data-post-form"    => "/admin/config/ajax/post-actions/delete-payment-type.php",
    "data-title"        => "Delete Payment Type: {$payment_type->name}",
    "data-submit-label" => "Delete",
    "data-id"           => $payment_type->id,
    "type"              => "button",
  ], $html_options);

  return "<button $attributes>Delete</button>";
}


function tshirt_size_button_for($tshirt_size=null, $html_options=[]){
  $attributes = build_html_attributes([
    "class"             => $tshirt_size ? ["btn", "btn-default"] : ["btn", "btn-success"],
    "data-toggle"       => "modal",
    "data-target"       => "#standard-modal",
    "data-form"         => "/admin/config/ajax/forms/tshirt-size-form.php",
    "data-post-form"    => "/admin/config/ajax/post-actions/post-tshirt-size-form.php",
    "data-title"        => $tshirt_size ? "Edit TShirt Size: {$tshirt_size->name}" : "New TShirt Size",
    "data-submit-label" => $tshirt_size ? "Update" : "Create",
    "data-id"           => $tshirt_size ? $tshirt_size->id : "",
    "type"              => "button",
  ], $html_options);
  $label = $tshirt_size ? "Edit" : "New TShirt Size";

  return "<button $attributes>$label</button>";
}

function delete_tshirt_size_button_for($tshirt_size=null, $html_options=[]){
  $attributes = build_html_attributes([
    "class"             => ["btn", "btn-danger"],
    "data-toggle"       => "modal",
    "data-target"       => "#standard-modal",
    "data-form"         => "/admin/config/ajax/forms/delete-tshirt-size-form.php",
    "data-post-form"    => "/admin/config/ajax/post-actions/delete-tshirt-size.php",
    "data-title"        => "Delete TShirt Size: {$tshirt_size->name}",
    "data-submit-label" => "Delete",
    "data-id"           => $tshirt_size->id,
    "type"              => "button",
  ], $html_options);

  return "<button $attributes>Delete</button>";
}


function user_button_for($user=null, $html_options=[]){
  $attributes = build_html_attributes([
    "class"             => $user ? ["btn", "btn-default"] : ["btn", "btn-success"],
    "data-toggle"       => "modal",
    "data-target"       => "#standard-modal",
    "data-form"         => "/admin/config/ajax/forms/user-form.php",
    "data-post-form"    => "/admin/config/ajax/post-actions/post-user-form.php",
    "data-title"        => $user ? "Edit User: {$user->username}" : "New User",
    "data-submit-label" => $user ? "Update" : "Create",
    "data-id"           => $user ? $user->id : "",
    "type"              => "button",
  ], $html_options);
  $label = $user ? "Edit" : "New User";

  return "<button $attributes>$label</button>";
}

function delete_user_button_for($user=null, $html_options=[]){
  if($user->id == current_user()->id){ return; }
  $attributes = build_html_attributes([
    "class"             => ["btn", "btn-danger"],
    "data-toggle"       => "modal",
    "data-target"       => "#standard-modal",
    "data-form"         => "/admin/config/ajax/forms/delete-user-form.php",
    "data-post-form"    => "/admin/config/ajax/post-actions/delete-user.php",
    "data-title"        => "Delete User: {$user->username}",
    "data-submit-label" => "Delete",
    "data-id"           => $user->id,
    "type"              => "button",
  ], $html_options);

  return "<button $attributes>Delete</button>";
}