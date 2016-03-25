<?php
include_once '../../../_includes/framework.php';
require_login();

if(!isset($form)){
  $id = @$_GET['id'];
  $id or die("<p>Error, no attendee id.</p>");

  $form = new CheckInForm(["id" => $id]);
}

$reg_levels = RegistrationLevel::at_door();
$badge_types = BadgeType::all();
$payment_types = PaymentType::at_door();
?>
<input type="hidden" name="id" value="<?=$id ?>">
<div class="text-center">
<h2><?=$form->attendee->display_name() ?></h2>
<? if($form->attendee->vendor()){ ?>
  <h4 class="text-muted"><?=$form->attendee->vendor()->display_name() ?></h4>
<? } ?>
</div>

<? include "_partials/blacklist-alert.php" ?>

<div class="row" id="minor-info" <? if(!$form->attendee->minor()){ ?>style="display: none;"<? } ?>>
  <div class="col-md-12 alert alert-info">
    <div class="col-md-12">
      <h4>Responsible Adult</h4>
      <p>Attendee is a minor. Please verify Responsible Adult's information.</p>
    </div>

    <div class="form-group col-md-6 col-md-offset-1 <?=$form->error_on("adult_relationship") ? "has-error" : "" ?>">
      <?=label_tag("adult_relationship", "Relationship") ?>
      <select class="form-control" id="adult_relationship" name="adult_relationship">
        <option></option>
        <? foreach(AdultRelationship::all() as $relationship){ ?>
          <?=option_tag($relationship->name, @$form->params["adult_relationship"], $relationship->db_name) ?>
        <? } ?>
      </select>
      <?=error_display($form, "adult_relationship") ?>
    </div>

    <div class="form-group col-md-2 <?=$form->error_on("adult_badge_number") ? "has-error" : "" ?>">
      <?=label_tag("adult_badge_number", "Badge #") ?>
      <?=input_tag($form, "adult_badge_number", ["placeholder" => ""]) ?>
      <?=error_display($form, "adult_badge_number") ?>
    </div>


    <div class="form-group col-md-6 col-md-offset-1 <?=$form->error_on("adult_legal_name") ? "has-error" : "" ?>">
      <?=label_tag("adult_legal_name", "Legal Name") ?>
      <?=input_tag($form, "adult_legal_name", ["placeholder" => "John Doe"]) ?>
      <?=error_display($form, "adult_legal_name") ?>
    </div>


    <div class="form-group col-md-4 <?=$form->error_on("adult_phone_number") ? "has-error" : "" ?>">
      <?=label_tag("adult_phone_number", "Phone Number") ?>
      <?=input_tag($form, "adult_phone_number", ["placeholder" => "555-555-5555"]) ?>
      <?=error_display($form, "adult_phone_number") ?>
    </div>
  </div>
</div>

<div class="row">
  <div class="form-group col-md-2 <?=$form->error_on("badge_number") ? "has-error" : "" ?>">
    <?=label_tag("badge_number", "Badge #") ?>
    <?=input_tag($form, "badge_number") ?>
    <?=error_display($form, "badge_number") ?>
  </div>

  <div class="form-group col-md-3 <?=$form->error_on("badge_name") ? "has-error" : "" ?>">
    <?=label_tag("badge_name", "Badge Name") ?>
    <?=input_tag($form, "badge_name") ?>
    <?=error_display($form, "badge_name") ?>
  </div>

  <div class="form-group col-md-3  <?=$form->error_on("badge_type") ? "has-error" : "" ?>">
    <?=label_tag("badge_type", "Badge Type") ?>
    <select class="form-control" id="badge_type" name="badge_type">
      <? foreach($badge_types as $type){ ?>
        <?=option_tag($type->name, @$form->params["badge_type"], $type->db_name) ?>
      <? } ?>
    </select>
    <?=error_display($form, "badge_type") ?>
  </div>

  <div class="form-group col-md-4 <?=$form->error_on("vendor_id") ? "has-error" : "" ?>">
    <?=label_tag("vendor_id", "Vendor") ?>
    <select class="form-control" id="vendor_id" name="vendor_id">
      <option></option>
      <? foreach(Vendor::all() as $vendor){ ?>
        <?=option_tag($vendor->display_name(), @$form->params["vendor_id"], $vendor->id) ?>
      <? } ?>
    </select>
    <?=error_display($form, "vendor_id") ?>
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

<? if(!$form->attendee->paid){ ?>
  <div class="row">
    <div class="form-group col-md-4 <?=$form->error_on("admission_level") ? "has-error" : "" ?>">
      <?=label_tag("admission_level", "Admission Level") ?>
      <select class="form-control" id="admission_level" name="admission_level">
        <? foreach($reg_levels as $level){ ?>
          <?=option_tag(reg_level_with_price($level), @$form->params["admission_level"], $level->db_name, ["data-includes-tshirt" => $level->includes_tshirt]) ?>
        <? } ?>
      </select>
      <?=error_display($form, "admission_level") ?>
    </div>

    <div class="form-group col-md-4 <?=$form->error_on("override_price") ? "has-error" : "" ?>">
      <?=label_tag("override_price", "Override Price") ?>
      <div class="input-group">
        <div class="input-group-addon">$</div>
        <?=input_tag($form, "override_price") ?>
      </div>
      <?=error_display($form, "override_price") ?>
    </div> 

    <div class="form-group col-md-4 <?=$form->error_on("payment_method") ? "has-error" : "" ?>">
      <? foreach($payment_types as $type){ ?>
        <div class="radio">
          <label>
            <input type="radio" name="payment_method" id="payment_method_<?=$type->db_name?>" value="<?=$type->db_name?>" <?if(@$form->params["payment_method"] == $type->db_name){?>checked="checked"<? } ?>>
            <?=$type->name?>
          </label>
        </div>
      <? } ?>
      <?=error_display($form, "payment_method") ?>
    </div>

  </div>
<? } ?>