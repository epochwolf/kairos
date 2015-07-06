<?php
include_once '../../_includes/framework.php';
include_once "../../_includes/forms/edit_form.php";

if(!isset($form)){
  $id = @$_GET['id'];
  $id or die("<p>Error, no attendee id.</p>");

  $form = new EditForm(["id" => $id]);
}
?>
<input type="hidden" name="id" value="<?=$id ?>">

<div class="text-center">
<h2><?=$form->attendee->badge_name ?> / <?=$form->attendee->legal_name ?></h2>
</div>

<? include "../../_partials/blacklist-alert.php" ?>
<? include "../../_partials/minor-alert.php" ?>

<h3>Badge Information</h3>


<div class="row">
  <div class="form-group col-md-3 <?=$form->error_on("badge_number") ? "has-error" : "" ?>">
    <?=label_tag("badge_number", "Badge #") ?>
    <?=input_tag($form, "badge_number") ?>
    <?=error_display($form, "badge_number") ?>
  </div>

  <div class="form-group col-md-5 <?=$form->error_on("badge_name") ? "has-error" : "" ?>">
    <?=label_tag("badge_name", "Name on Badge") ?>
    <?=input_tag($form, "badge_name", ["placeholder" => "J Fuzzy Fox"]) ?>
    <?=error_display($form, "badge_name") ?>
  </div>

  <div class="form-group col-md-3 <?=$form->error_on("badge_type") ? "has-error" : "" ?>">
    <?=label_tag("badge_type", "Badge Type") ?>
    <select class="form-control" id="badge_type" name="badge_type">
      <? foreach($BADGE_TYPES as $key => $value){ ?>
        <option value="<?=$key ?>" <?if(@$form->params["badge_type"] == $key){?>selected="selected"<? } ?>><?=$value ?></option>
      <? } ?>
    </select>
    <?=error_display($form, "badge_type") ?>
  </div>
</div>
<div class="row">
  <div class="form-group col-md-4 <?=$form->error_on("admission_level") ? "has-error" : "" ?>">
    <?=label_tag("admission_level", "Admission Level") ?>
    <select class="form-control" id="admission_level" name="admission_level">
      <? foreach(array_keys($REGISTRATION_LEVELS) as $level){ ?>
        <option value="<?=$level ?>" <?if(@$form->params["admission_level"] == $level){?>selected="selected"<? } ?>><?=reg_level_with_price($level) ?></option>
      <? } ?>
    </select>
    <?=error_display($form, "admission_level") ?>
  </div>

  <div class="form-group col-md-2 <?=$form->error_on("tshirt_size") ? "has-error" : "" ?>">
    <?=label_tag("tshirt_size", "T-Shirt") ?>
    <select class="form-control" id="tshirt_size" name="tshirt_size">
      <option></option>
      <? foreach($TSHIRT_SIZES as $size){ ?>
        <option <?if(@$form->params["tshirt_size"] == $size){?>selected="selected"<? } ?>><?=$size ?></option>
      <? } ?>
    </select>
    <?=error_display($form, "tshirt_size") ?>
  </div>

  <div class="form-group col-md-3 <?=$form->error_on("override_price") ? "has-error" : "" ?>">
    <?=label_tag("override_price", "Override Price") ?>
    <?=input_tag($form, "override_price") ?>
    <?=error_display($form, "override_price") ?>
  </div> 

  <div class="form-group col-md-2 <?=$form->error_on("payment_method") ? "has-error" : "" ?>">
    <div class="radio">
      <label>
        <input type="radio" name="payment_method" id="payment_method_cash" value="cash" <?if(@$form->params["payment_method"] == "cash"){?>checked="checked"<? } ?>>
        Cash
      </label>
    </div>
    <div class="radio">
      <label>
        <input type="radio" name="payment_method" id="payment_method_credit" value="credit" <?if(@$form->params["payment_method"] == "credit"){?>checked="checked"<? } ?>>
        Credit/Debit
      </label>
    </div>
    <? if(!in_array(@$form->params["payment_method"], ["", "cash", "credit"])){ ?>
      <div class="radio">
        <label>
          <input type="radio" name="payment_method" id="payment_method_credit" value="<?=htmlentities(@$form->params["payment_method"])?>" checked="checked">
          Other: <?=htmlentities(@$form->params["payment_method"])?>
        </label>
      </div>
    <? } ?>
    <?=error_display($form, "payment_method") ?>
  </div>
</div>

<h3>Identification</h3>

<div class="row">
  <div class="form-group col-md-7 <?=$form->error_on("legal_name") ? "has-error" : "" ?>">
    <?=label_tag("legal_name", "Legal Name") ?>
    <?=input_tag($form, "legal_name", ["placeholder" => "John Doe"]) ?>
    <?=error_display($form, "legal_name") ?>
  </div>

  <div class="form-group col-md-3 <?=$form->error_on("birthdate") ? "has-error" : "" ?>">
    <?=label_tag("birthdate", "Date of Birth") ?>
    <?=input_tag($form, "birthdate", ["placeholder" => "MM/DD/YYYY"]) ?>
    <?=error_display($form, "birthdate") ?>
  </div>
  <div class="form-group col-md-2">
    <label>Age</label>
    <input class="form-control" type="text" value="<?=age_from_birthdate(@$form->params["birthdate"]); ?>" readonly>
  </div>
</div>

<div class="row">
  <div class="form-group col-md-8 <?=$form->error_on("address1") ? "has-error" : "" ?>">
    <?=label_tag("address1", "Address 1") ?>
    <?=input_tag($form, "address1", ["placeholder" => "123 Fake St"]) ?>
    <?=error_display($form, "address1") ?>
  </div>

  <div class="form-group col-md-4 <?=$form->error_on("address2") ? "has-error" : "" ?>">
    <?=label_tag("address2", "Address 2") ?>
    <?=input_tag($form, "address2", ["placeholder" => "Unit 3"]) ?>
    <?=error_display($form, "address2") ?>
  </div>
</div>
<div class="row">
  <div class="form-group col-md-5 <?=$form->error_on("city") ? "has-error" : "" ?>">
    <?=label_tag("city", "City") ?>
    <?=input_tag($form, "city", ["placeholder" => "Cincinnati"]) ?>
    <?=error_display($form, "city") ?>
  </div>

  <div class="form-group col-md-4 <?=$form->error_on("state_prov") ? "has-error" : "" ?>">
    <?=label_tag("state_prov", "State/Providence") ?>
    <?=input_tag($form, "state_prov", ["placeholder" => "Ohio"]) ?>
    <?=error_display($form, "state_prov") ?>
  </div>

  <div class="form-group col-md-3 <?=$form->error_on("postal_code") ? "has-error" : "" ?>">
    <?=label_tag("postal_code", "Postal Code") ?>
    <?=input_tag($form, "postal_code", ["placeholder" => "45231"]) ?>
    <?=error_display($form, "postal_code") ?>
  </div>
</div>
<div class="row">
  <div class="form-group col-md-4 <?=$form->error_on("phone_number") ? "has-error" : "" ?>">
    <?=label_tag("phone_number", "Phone Number") ?>
    <?=input_tag($form, "phone_number", ["placeholder" => "555-555-5555"]) ?>
    <?=error_display($form, "phone_number") ?>
  </div>

  <div class="form-group col-md-8 <?=$form->error_on("email") ? "has-error" : "" ?>">
    <?=label_tag("email", "Email Address") ?>
    <?=input_tag($form, "email", ["placeholder" => "fuzzyfox@example.com"]) ?>
    <?=error_display($form, "email") ?>
  </div>
</div>


<h3>Minor Information</h3>
<div class="row">
  <div class="form-group col-md-7 <?=$form->error_on("adult_legal_name") ? "has-error" : "" ?>">
    <?=label_tag("adult_legal_name", "Adult's Legal Name") ?>
    <?=input_tag($form, "adult_legal_name", ["placeholder" => "John Doe"]) ?>
    <?=error_display($form, "adult_legal_name") ?>
  </div>

  <div class="form-group col-md-5 <?=$form->error_on("adult_badge_name") ? "has-error" : "" ?>">
    <?=label_tag("adult_badge_name", "Adult's Badge Name") ?>
    <?=input_tag($form, "adult_badge_name", ["placeholder" => "mrfox"]) ?>
    <?=error_display($form, "adult_badge_name") ?>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <h3>Notes</h3>
    <div class="form-group">
      <textarea class="form-control" name="notes" id="notes"><?=htmlentities(@$form->params["note"]) ?></textarea>
    </div>
  </div>
  <div class="col-md-6">
    <h3>Flags</h3>
    <div>
      <div class="checkbox-inline">
        <input type="hidden" name="at_door"  value="0">
        <label>
          <input type="checkbox" name="at_door" value="1" <? if(@$form->params["at_door"]){ ?>checked="checked"<?}?>> At Door
        </label>
      </div>
      <div class="checkbox-inline">
        <input type="hidden" name="paid"  value="0">
        <label>
          <input type="checkbox" name="paid" value="1" <? if(@$form->params["paid"]){ ?>checked="checked"<?}?>> Paid
        </label>
      </div>
      <div class="checkbox-inline">
        <input type="hidden" name="checked_in"  value="0">
        <label>
          <input type="checkbox" name="checked_in" value="1" <? if(@$form->params["checked_in"]){ ?>checked="checked"<?}?>> Checked In
        </label>
      </div>
    </div>
    <div>
      <div class="checkbox-inline">
        <input type="hidden" name="blacklisted"  value="0">
        <label class="<? if(is_null(@$form->attendee->blacklist_id)){ ?>text-muted<?}?>">
          <input type="checkbox" name="blacklisted" value="1" <? if(@$form->params["blacklisted"]){ ?>checked="checked"<?}?> <? if(is_null(@$form->attendee->blacklist_id)){ ?>disabled="disabled"<?}?>> Blacklisted
        </label>
      </div>
    </div>
  </div>
