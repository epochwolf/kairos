<?php
include_once '../../../_includes/framework.php';
require_login();

if(!isset($form)){
  $form = new AddAttendeeForm();
}


$badge_types = BadgeType::all();
$reg_levels = RegistrationLevel::all();
$tshirt_sizes = TShirtSize::all();
$payment_types = PaymentType::all();
$vendors = Vendor::all();

?>

<div class="row">
  <div class="form-group col-md-6 <?=$form->error_on("badge_name") ? "has-error" : "" ?>">
    <?=label_tag("badge_name", "Badge Name") ?>
    <?=input_tag($form, "badge_name") ?>
    <?=error_display($form, "badge_name") ?>
  </div>

  <div class="form-group col-md-6 <?=$form->error_on("admission_level") ? "has-error" : "" ?>">
    <?=label_tag("admission_level", "Admission Level") ?>
    <select class="form-control" id="admission_level" name="admission_level">
      <? foreach($reg_levels as $level){ ?>
        <?=option_tag(reg_level_with_price($level), @$form->params["admission_level"], $level->db_name, ["data-includes-tshirt" => $level->includes_tshirt]) ?>
      <? } ?>
    </select>
    <?=error_display($form, "admission_level") ?>
  </div>
</div>

<div class="row">
  <div class="form-group col-md-7 <?=$form->error_on("legal_name") ? "has-error" : "" ?>">
    <?=label_tag("legal_name", "Legal Name") ?>
    <?=input_tag($form, "legal_name", ["placeholder" => "John Doe"]) ?>
    <?=error_display($form, "legal_name") ?>
  </div>

  <div class="form-group col-md-3 <?=$form->error_on("birthdate") ? "has-error" : "" ?>">
    <?=label_tag("birthdate", "Birthdate") ?>
    <?=input_tag($form, "birthdate") ?>
    <?=error_display($form, "birthdate") ?>
  </div>

  <div class="form-group col-md-2">
    <label>Age</label>
    <input class="form-control" id="age" type="text" value="<?=age_from_birthdate(@$form->params["birthdate"]); ?>" readonly>
  </div>
</div>