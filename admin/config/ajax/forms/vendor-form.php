<?php
include_once '../../../../_includes/framework.php';
require_admin();

if(!isset($form)){
  $form = new VendorForm(["id" => @$_GET['id']]);
}

?>
<input type="hidden" name="_form_class" value="<?=get_class($form) ?>">
<input type="hidden" name="_form_file" value="<?=basename(__FILE__) ?>">
<input type="hidden" name="id" value="<?=$form->id() ?>">

<div class="form-group <?=$form->error_on("name") ? "has-error" : "" ?>">
  <?=label_tag("name", "Name") ?>
  <?=input_tag($form, "name") ?>
  <?=error_display($form, "name") ?>
</div>

<div class="form-group <?=$form->error_on("assigned_tables") ? "has-error" : "" ?>">
  <?=label_tag("assigned_tables", "Assigned Tables") ?>
  <?=input_tag($form, "assigned_tables") ?>
  <?=error_display($form, "assigned_tables") ?>
</div>

<div class="form-group <?=$form->error_on("vendor_license_number") ? "has-error" : "" ?>">
  <?=label_tag("vendor_license_number", "Vendor License Number") ?>
  <?=input_tag($form, "vendor_license_number") ?>
  <?=error_display($form, "vendor_license_number") ?>
</div>

<div class="form-group">
  <?=label_tag("notes", "Notes") ?>
  <textarea class="form-control" rows="3" name="notes" id="notes"><?=htmlentities(@$form->params["notes"]) ?></textarea>
</div>