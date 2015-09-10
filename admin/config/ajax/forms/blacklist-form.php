<?php
include_once '../../../../_includes/framework.php';
require_admin();

if(!isset($form)){
  $form = new BlacklistForm(["id" => @$_GET['id']]);
}

$types = BlacklistType::all();

?>
<input type="hidden" name="_form_class" value="<?=get_class($form) ?>">
<input type="hidden" name="_form_file" value="<?=basename(__FILE__) ?>">
<input type="hidden" name="id" value="<?=$form->id() ?>">

<div class="row">
  <div class="form-group col-sm-6 <?=$form->error_on("badge_name") ? "has-error" : "" ?>">
    <?=label_tag("badge_name", "Badge Name") ?>
    <?=input_tag($form, "badge_name") ?>
    <?=error_display($form, "badge_name") ?>
  </div>

  <div class="form-group col-sm-6 <?=$form->error_on("legal_name") ? "has-error" : "" ?>">
    <?=label_tag("legal_name", "Legal Name") ?>
    <?=input_tag($form, "legal_name") ?>
    <?=error_display($form, "legal_name") ?>
  </div>
</div>

<div class="row">
  <div class="form-group col-sm-6 <?=$form->error_on("trigger_badge_names") ? "has-error" : "" ?>">
    <?=label_tag("trigger_badge_names", "Trigger Badge Names") ?>
    <textarea class="form-control" rows="3" name="trigger_badge_names" id="trigger_badge_names"><?=htmlentities(@$form->params["trigger_badge_names"]) ?></textarea>
    <?=error_display($form, "trigger_badge_names") ?>
  </div>

  <div class="form-group col-sm-6 <?=$form->error_on("trigger_legal_names") ? "has-error" : "" ?>">
    <?=label_tag("trigger_legal_names", "Trigger Legal Names") ?>
    <textarea class="form-control" rows="3" name="trigger_legal_names" id="trigger_legal_names"><?=htmlentities(@$form->params["trigger_legal_names"]) ?></textarea>
    <?=error_display($form, "trigger_legal_names") ?>
  </div>

  <div class="col-sm-12">
    <span class="help-block">
      One trigger per line. 
      Matches anywhere in the legal name. 
      A * may be used as a wildcard.
    </span>
  </div>
</div>

<div class="row">
  <div class="form-group col-sm-4 <?=$form->error_on("type") ? "has-error" : "" ?>">

    <label>Blacklist Type</label>
    <div class="col-sm-12">
      <? foreach($types as $type){ ?>
        <div class="radio">
          <label>
            <input type="radio" name="type" id="type_<?=$type->db_name ?>" value="<?=$type->db_name ?>" <?if(@$form->params["type"] == $type->db_name){?>checked="checked"<? } ?>>
            <? if(true){ ?>
              <span class="label label-<?=$type->alert_color ?>"><?=$type->alert_title ?></span>
            <? }else{ ?>
              <?=$type->name ?>
            <? } ?>
          </label>
        </div>
      <? } ?>
    </div>
    <?=error_display($form, "type") ?>
  </div>

  <div class="form-group col-sm-8 <?=$form->error_on("reason") ? "has-error" : "" ?>">
    <?=label_tag("reason", "Reason") ?>
    <textarea class="form-control" rows="3" name="reason" id="reason"><?=htmlentities(@$form->params["reason"]) ?></textarea>
    <?=error_display($form, "reason") ?>
  </div>
</div>

