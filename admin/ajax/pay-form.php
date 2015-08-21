<?php
include_once '../../_includes/framework.php';
include_once "../../_includes/forms/pay_form.php";
require_login();

if(!isset($form)){
  $id = @$_GET['id'];
  $id or die("<p>Error, no attendee id.</p>");

  $form = new PayForm(["id" => $id]);
}
?>
<input type="hidden" name="id" value="<?=$id ?>">

<div class="text-center">
<h2><?=$form->attendee->badge_name ?> / <?=$form->attendee->legal_name ?></h2>
</div>

<? include "../../_partials/blacklist-alert.php" ?>
<? include "../../_partials/minor-alert.php" ?>

<div class="form-group <?=$form->error_on("admission_level") ? "has-error" : "" ?>">
  <?=label_tag("admission_level", "Admission Level") ?>
  <select class="form-control" id="admission_level" name="admission_level">
    <? foreach($AT_DOOR_REGISTRATION as $level){ ?>
      <option value="<?=$level ?>" <?if(@$form->params["admission_level"] == $level){?>selected="selected"<? } ?>><?=reg_level_with_price($level) ?></option>
    <? } ?>
  </select>
  <?=error_display($form, "admission_level") ?>
</div>

<div class="form-group <?=$form->error_on("payment_method") ? "has-error" : "" ?>">
  <div class="radio-inline">
    <label>
      <input type="radio" name="payment_method" id="payment_method_cash" value="cash" <?if(@$form->params["payment_method"] == "cash"){?>checked="checked"<? } ?>>
      Cash
    </label>
  </div>
  <div class="radio-inline">
    <label>
      <input type="radio" name="payment_method" id="payment_method_credit" value="credit" <?if(@$form->params["payment_method"] == "credit"){?>checked="checked"<? } ?>>
      Credit/Debit
    </label>
  </div>
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
    <? foreach($BADGE_TYPES as $key => $value){ ?>
      <option value="<?=$key ?>" <?if(@$form->params["badge_type"] == $key){?>selected="selected"<? } ?>><?=$value ?></option>
    <? } ?>
  </select>
  <?=error_display($form, "badge_type") ?>
</div>