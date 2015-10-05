<?php
include_once '../../../_includes/framework.php';
require_login();

if(!isset($form)){
  $id = @$_GET['id'];
  $id or die("<p>Error, no attendee id.</p>");

  $form = new UpgradeForm(["id" => $id]);
}

$current_level = RegistrationLevel::find_by_db_name($form->attendee->admission_level);
$upgrades = RegistrationUpgrade::from_with_prices($form->attendee->admission_level);
?>
<input type="hidden" name="id" value="<?=$id ?>">

<div class="text-center">
<h2><?=$form->attendee->display_name() ?></h2>
<? if($form->attendee->company_name){ ?>
  <h4 class="text-muted"><?=$form->attendee->company_name ?></h4>
<? } ?>
</div>

<div class="form-group <?=$form->error_on("admission_level") ? "has-error" : "" ?>">
  <h4>Admission Level</h4>

  <div class="radio">
    <label>
      <input type="radio" name="admission_level" value="<?=$current_level->db_name ?>" checked>
      <?=$current_level->name ?> ($0) <span class="text-muted">Current Level</span>
    </label>
  </div>

  <? foreach($upgrades as $upgrade){ ?>
    <div class="radio">
      <label>
        <input type="radio" name="admission_level" value="<?=$upgrade->to ?>">
        <?=$upgrade->to_name ?> (<?=currency($upgrade->price_for($form->attendee)) ?>)
      </label>
    </div>
  <? } ?>
  <?=error_display($form, "admission_level") ?>
</div>