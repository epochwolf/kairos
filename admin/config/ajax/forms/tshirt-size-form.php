<?php
include_once '../../../../_includes/framework.php';
require_admin();

if(!isset($form)){
  $form = new TShirtSizeForm(["id" => @$_GET['id']]);
}

?>
<input type="hidden" name="_form_class" value="<?=get_class($form) ?>">
<input type="hidden" name="_form_file" value="<?=basename(__FILE__) ?>">
<input type="hidden" name="id" value="<?=$form->id() ?>">


<div class="form-group <?=$form->error_on("db_name") ? "has-error" : "" ?>">
  <?=label_tag("db_name", "DB Name") ?>
  <?=input_tag($form, "db_name") ?>
  <?=error_display($form, "db_name") ?>
</div>

<div class="form-group <?=$form->error_on("name") ? "has-error" : "" ?>">
  <?=label_tag("name", "Name") ?>
  <?=input_tag($form, "name") ?>
  <?=error_display($form, "name") ?>
</div>

<div class="form-group <?=$form->error_on("sort_order") ? "has-error" : "" ?>">
  <?=label_tag("sort_order", "Sort Order") ?>
  <?=input_tag($form, "sort_order") ?>
  <?=error_display($form, "sort_order") ?>
  <span class="help-block">Controls the order the shirt appears in dropdowns. Lower numbers are higher in the list.</span>

</div>