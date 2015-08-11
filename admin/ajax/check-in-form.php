<?php
include_once '../../_includes/framework.php';
include_once "../../_includes/forms/check_in_form.php";
require_login();

if(!isset($form)){
  $id = @$_GET['id'];
  $id or die("<p>Error, no attendee id.</p>");

  $form = new CheckInForm(["id" => $id]);
}
?>
<input type="hidden" name="id" value="<?=$id ?>">
<div class="text-center">
<h2><?=$form->attendee->badge_name ?> / <?=$form->attendee->legal_name ?></h2>
</div>

<? include "../../_partials/blacklist-alert.php" ?>
<? include "../../_partials/minor-alert.php" ?>


<div class="form-group <?=$form->error_on("badge_number") ? "has-error" : "" ?>">
  <?=label_tag("badge_number", "Badge Number") ?>
  <?=input_tag($form, "badge_number") ?>
  <?=error_display($form, "badge_number") ?>
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