<?php
include_once '../../_includes/framework.php';
include_once "../../_includes/forms/upgrade_form.php";

if(!isset($form)){
  $id = @$_GET['id'];
  $id or die("<p>Error, no attendee id.</p>");

  $form = new UpgradeForm(["id" => $id]);
}
?>
<input type="hidden" name="id" value="<?=$id ?>">

<div class="text-center">
<h2><?=$form->attendee->badge_name ?> / <?=$form->attendee->legal_name ?></h2>
</div>

<div class="form-group <?=$form->error_on("admission_level") ? "has-error" : "" ?>">
  <h4>Admission Level</h4>

  <div class="radio">
    <label>
      <input type="radio" name="admission_level" value="<?=$form->attendee->admission_level ?>" checked>
      <?=reg_level_with_price($form->attendee->admission_level, 0) ?> <span class="text-muted">Current Level</span>
    </label>
  </div>

  <? foreach($REGISTRATION_UPGRADE_PRICING[$form->attendee->admission_level] as $level => $price){ ?>
    <div class="radio">
      <label>
        <input type="radio" name="admission_level" value="<?=$level ?>">
        <?=reg_level_with_price($level, $price) ?>
      </label>
    </div>
  <? } ?>
  <?=error_display($form, "admission_level") ?>
</div>