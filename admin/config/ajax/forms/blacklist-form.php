<?php
include_once '../../../../_includes/framework.php';
require_admin();

if(!isset($form)){
  $form = new BlacklistForm(["id" => @$_GET['id']]);
}

$types = BlacklistType::all();

?>
<input type="hidden" name="id" value="<?=$form->id() ?>">

<div class="form-group <?=$form->error_on("badge_name") ? "has-error" : "" ?>">
  <?=label_tag("badge_name", "Badge Name") ?>
  <?=input_tag($form, "badge_name") ?>
  <?=error_display($form, "badge_name") ?>
</div>

<div class="form-group <?=$form->error_on("legal_name") ? "has-error" : "" ?>">
  <?=label_tag("legal_name", "Legal Name") ?>
  <?=input_tag($form, "legal_name") ?>
  <?=error_display($form, "legal_name") ?>
</div>

<div class="form-group <?=$form->error_on("trigger_badge_names") ? "has-error" : "" ?>">
  <?=label_tag("trigger_badge_names", "Trigger Badge Names") ?>
  <textarea class="form-control" rows="3" name="trigger_badge_names" id="trigger_badge_names"><?=htmlentities(@$form->params["trigger_badge_names"]) ?></textarea>
  <?=error_display($form, "trigger_badge_names") ?>
  <span class="help-block">One trigger per line. Matches anywhere in the badge name. A * may be used as a wildcard.</span>
</div>

<div class="form-group <?=$form->error_on("trigger_legal_names") ? "has-error" : "" ?>">
  <?=label_tag("trigger_legal_names", "Trigger Legal Names") ?>
  <textarea class="form-control" rows="3" name="trigger_legal_names" id="trigger_legal_names"><?=htmlentities(@$form->params["trigger_legal_names"]) ?></textarea>
  <?=error_display($form, "trigger_legal_names") ?>
  <span class="help-block">One trigger per line. Matches anywhere in the legal name. A * may be used as a wildcard.</span>
</div>

<div class="form-group <?=$form->error_on("reason") ? "has-error" : "" ?>">
  <?=label_tag("reason", "Reason") ?>
  <textarea class="form-control" rows="2" name="reason" id="reason"><?=htmlentities(@$form->params["reason"]) ?></textarea>
  <?=error_display($form, "reason") ?>
</div>

<div class="form-group <?=$form->error_on("type") ? "has-error" : "" ?>">
  <?=label_tag("type", "Blacklist Type") ?>
  <select class="form-control" id="type" name="type">
    <option></option>
    <? foreach($types as $type){ ?>
      <?=option_tag($type->name, @$form->params["type"], $type->db_name) ?>
    <? } ?>
  </select>
  <?=error_display($form, "type") ?>
</div>

