<?php
include_once '../../../_includes/framework.php';
require_login();

if(!isset($form)){
  $id = @$_GET['id'];
  $id or die("<p>Error, no attendee id.</p>");

  $form = new CancelForm(["id" => $id]);
}

$current_level = RegistrationLevel::find_by_db_name($form->attendee->admission_level);
$upgrades = RegistrationUpgrade::from_with_prices($form->attendee->admission_level);
?>
<input type="hidden" name="id" value="<?=$id ?>">

<div class="text-center">
<h2><?=$form->attendee->display_name() ?></h2>
<? if($form->attendee->vendor()){ ?>
  <h4 class="text-muted"><?=$form->attendee->vendor()->display_name() ?></h4>
<? } ?>
</div>

<div class="form-group">
  <div>
    <div class="checkbox <?=$form->error_on("canceled") ? "has-error" : "" ?>">
      <input type="hidden" name="canceled"  value="0">
      <label>
        <input type="checkbox" name="canceled" value="1" <? if(@$form->params["canceled"]){ ?>checked="checked"<?}?>> Confirm this action.
      </label>
      <?=error_display($form, "canceled") ?>
    </div>
  </div>
</div>