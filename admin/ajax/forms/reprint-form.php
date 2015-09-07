<?php
include_once '../../../_includes/framework.php';
require_login();

if(!isset($form)){
  $id = @$_GET['id'];
  $id or die("<p>Error, no attendee id.</p>");

  $form = new ReprintForm(["id" => $id]);
}

$badge_types = BadgeType::all();
?>
<input type="hidden" name="id" value="<?=$id ?>">
<div class="text-center">
<h2><?=$form->attendee->badge_name ?> / <?=$form->attendee->legal_name ?></h2>
</div>

<? include "_partials/blacklist-alert.php" ?>
<? include "_partials/minor-alert.php" ?>

<div class="form-group">
  <label>Badge Reprints</label>
  <p class="form-control-static lead">
    <?=$form->attendee->badge_reprints ?>
    <? if($form->attendee->badge_reprints > 1){ ?> 
      <span class="label label-danger">This person has already had their badge reprinted.</span>
    <? } ?>
  </p>
</div>

<div class="form-group <?=$form->error_on("badge_number") ? "has-error" : "" ?>">
  <?=label_tag("badge_number", "Badge Number") ?>
  <?=input_tag($form, "badge_number") ?>
  <?=error_display($form, "badge_number") ?>
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

<div class="form-group <?=$form->error_on("badge_name") ? "has-error" : "" ?>">
  <?=label_tag("badge_name", "Badge Name") ?>
  <?=input_tag($form, "badge_name") ?>
  <?=error_display($form, "badge_name") ?>
</div>

<h3>Notes on Attendee</h3>
<div class="form-group">
  <textarea class="form-control" name="notes" id="notes"><?=htmlentities(@$form->params["note"]) ?></textarea>
</div>