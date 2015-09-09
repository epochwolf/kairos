<?php
include_once '../../../../_includes/framework.php';
require_admin();

if(!isset($form)){
  $form = new RegistrationLevelForm(["id" => @$_GET['id']]);
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


<div class="form-group <?=$form->error_on("price") ? "has-error" : "" ?>">
  <?=label_tag("price", "Price") ?>
  <?=input_tag($form, "price") ?>
  <?=error_display($form, "price") ?>
</div>

<div class="form-group <?=$form->error_on("includes_tshirt") ? "has-error" : "" ?>">
  <label>TShirt Included with Level</label>
  <div class="checkbox">
    <input type="hidden" name="includes_tshirt"  value="0">
    <label>
      <input type="checkbox" name="includes_tshirt" value="1" <? if(@$form->params["includes_tshirt"]){ ?>checked="checked"<?}?>> TShirt Included
    </label>
    <?=error_display($form, "includes_tshirt") ?>
  </div>
</div>

<div class="form-group <?=$form->error_on("available_pre_reg") ? "has-error" : "" ?>">
  <label>Available</label>
  <div class="checkbox">
    <input type="hidden" name="available_pre_reg"  value="0">
    <label>
      <input type="checkbox" name="available_pre_reg" value="1" <? if(@$form->params["available_pre_reg"]){ ?>checked="checked"<?}?>> Pre Register
    </label>
    <?=error_display($form, "available_pre_reg") ?>
  </div>
  <div class="checkbox">
    <input type="hidden" name="available_at_door"  value="0">
    <label>
      <input type="checkbox" name="available_at_door" value="1" <? if(@$form->params["available_at_door"]){ ?>checked="checked"<?}?>> At Door
    </label>
    <?=error_display($form, "available_at_door") ?>
  </div>
</div>

<div class="form-group <?=$form->error_on("sort_order") ? "has-error" : "" ?>">
  <?=label_tag("sort_order", "Sort Order") ?>
  <?=input_tag($form, "sort_order") ?>
  <?=error_display($form, "sort_order") ?>
  <span class="help-block">Controls the order the level appears in dropdowns. Lower numbers are higher in the list.</span>
</div>