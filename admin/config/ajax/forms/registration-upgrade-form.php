<?php
include_once '../../../../_includes/framework.php';
require_admin();

if(!isset($form)){
  $form = new RegistrationUpgradeForm(["id" => @$_GET['id']]);
}

$reg_levels = RegistrationLevel::all();

?>
<input type="hidden" name="id" value="<?=$form->id() ?>">

<div class="form-group <?=$form->error_on("from") ? "has-error" : "" ?>">
  <?=label_tag("from", "From") ?>
  <select class="form-control" id="from" name="from">
    <option></option>
    <? foreach($reg_levels as $level){ ?>
      <?=option_tag($level->name, @$form->params["from"], $level->db_name) ?>
    <? } ?>
  </select>
  <?=error_display($form, "from") ?>
</div>

<div class="form-group <?=$form->error_on("to") ? "has-error" : "" ?>">
  <?=label_tag("to", "To") ?>
  <select class="form-control" id="to" name="to">
    <option></option>
    <? foreach($reg_levels as $level){ ?>
      <?=option_tag($level->name, @$form->params["to"], $level->db_name) ?>
    <? } ?>
  </select>
  <?=error_display($form, "to") ?>
</div>

<div class="form-group <?=$form->error_on("override_price") ? "has-error" : "" ?>">
  <?=label_tag("override_price", "Override Price") ?>
  <?=input_tag($form, "override_price") ?>
  <?=error_display($form, "override_price") ?>
  <span class="help-block">Price is automatically calculated as the difference between registration levels. You can set a different price here if needed.</span>
</div>

<div class="form-group <?=$form->error_on("sort_order") ? "has-error" : "" ?>">
  <?=label_tag("sort_order", "Sort Order") ?>
  <?=input_tag($form, "sort_order") ?>
  <?=error_display($form, "sort_order") ?>
  <span class="help-block">Controls the order the upgrades appear in dropdowns. Lower numbers are higher in the list.</span>
</div>


