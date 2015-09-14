<?php
include_once '../../../_includes/framework.php';
require_login();

if(!isset($form)){
  $id = @$_GET['id'];
  $id or die("<p>Error, no attendee id.</p>");

  $form = new PayForm(["id" => $id]);
}

$reg_levels = RegistrationLevel::at_door();
$payment_types = PaymentType::at_door();
$badge_types = BadgeType::all();
?>
<input type="hidden" name="id" value="<?=$id ?>">

<div class="text-center">
<h2><?=$form->attendee->display_name() ?></h2>
<? if($form->attendee->company_name){ ?>
  <h4 class="text-muted"><?=$form->attendee->company_name ?></h4>
<? } ?>
</div>

<? include "_partials/blacklist-alert.php" ?>
<? include "_partials/minor-alert.php" ?>

<div class="form-group <?=$form->error_on("admission_level") ? "has-error" : "" ?>">
  <?=label_tag("admission_level", "Admission Level") ?>
  <select class="form-control" id="admission_level" name="admission_level">
    <? foreach($reg_levels as $level){ ?>
      <?=option_tag(reg_level_with_price($level), @$form->params["admission_level"], $level->db_name, ["data-includes-tshirt" => $level->includes_tshirt]) ?>
    <? } ?>
  </select>
  <?=error_display($form, "admission_level") ?>
</div>

<div class="form-group <?=$form->error_on("payment_method") ? "has-error" : "" ?>">
  <? foreach($payment_types as $type){ ?>
    <div class="radio-inline">
      <label>
        <input type="radio" name="payment_method" id="payment_method_<?=$type->db_name?>" value="<?=$type->db_name?>" <?if(@$form->params["payment_method"] == $type->db_name){?>checked="checked"<? } ?>>
        <?=$type->name?>
      </label>
    </div>
  <? } ?>
  <?=error_display($form, "payment_method") ?>
</div>

<div class="form-group <?=$form->error_on("override_price") ? "has-error" : "" ?>">
  <?=label_tag("override_price", "Override Price") ?>
  <div class="input-group">
    <div class="input-group-addon">$</div>
    <?=input_tag($form, "override_price") ?>
  </div>
  <?=error_display($form, "override_price") ?>
</div> 

<div class="form-group  <?=$form->error_on("badge_type") ? "has-error" : "" ?>">
  <?=label_tag("badge_type", "Badge Type") ?>
  <select class="form-control" id="badge_type" name="badge_type">
    <? foreach($badge_types as $type){ ?>
      <?=option_tag($type->name, @$form->params["badge_type"], $type->db_name) ?>
    <? } ?>
  </select>
  <?=error_display($form, "badge_type") ?>
</div>