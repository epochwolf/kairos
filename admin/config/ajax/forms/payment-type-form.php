<?php
include_once '../../../../_includes/framework.php';
require_admin();

if(!isset($form)){
  $form = new PaymentTypeForm(["id" => @$_GET['id']]);
}

?>
<input type="hidden" name="id" value="<?=$form->payment_type->id ?>">

<div class="text-center">
<? if($form->payment_type->is_new_record()){ ?>
  <h2>New Payment Type</h2>
<? }else{ ?>
  <h2>Edit Payment Type: <?= $form->payment_type->name ?></h2>
<? } ?> 
</div>

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

<div class="form-group <?=$form->error_on("at_door") ? "has-error" : "" ?>">
  <div class="checkbox-inline">
    <input type="hidden" name="at_door"  value="0">
    <label>
      <input type="checkbox" name="at_door" value="1" <? if(@$form->params["at_door"]){ ?>checked="checked"<?}?>> Available At Door
    </label>
    <?=error_display($form, "at_door") ?>
  </div>
</div>

<div class="form-group <?=$form->error_on("sort_order") ? "has-error" : "" ?>">
  <?=label_tag("sort_order", "Sort Order") ?>
  <?=input_tag($form, "sort_order") ?>
  <?=error_display($form, "sort_order") ?>
  <span class="help-block">Controls the order the payment appears in dropdowns. Lower numbers are higher in the list.</span>
</div>