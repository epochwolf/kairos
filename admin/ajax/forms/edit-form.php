<?php
include_once '../../../_includes/framework.php';
require_login();

if(!isset($form)){
  $id = @$_GET['id'];
  $id or die("<p>Error, no attendee id.</p>");

  $form = new EditForm(["id" => $id]);
}

$badge_types = BadgeType::all();
$reg_levels = RegistrationLevel::all();
$tshirt_sizes = TShirtSize::all();
$payment_types = PaymentType::all();
$vendors = Vendor::all();

$adult_badge  = null;

if(!empty(@$form->params["adult_badge_number"])){
  $adult_badge = Attendee::find_by_badge_number($form->params["adult_badge_number"]);
}
 

?>
<input type="hidden" name="id" value="<?=$id ?>">

<div class="text-center <? if($form->attendee->canceled) {?>canceled<?}?>">
  <h2><?=$form->attendee->display_name() ?></h2>
  <? if($form->attendee->vendor()){ ?>
    <h4 class="text-muted"><?=$form->attendee->vendor()->display_name() ?></h4>
  <? } ?>
</div>

<? include "_partials/blacklist-alert.php" ?>
<? include "_partials/minor-alert.php" ?>

<div>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li class="active"><a href="#badge" data-toggle="tab">Badge</a></li>
    <li><a href="#identification" data-toggle="tab">Identification</a></li>
    <li><a href="#address" data-toggle="tab">Address</a></li>
    <li><a href="#flags" data-toggle="tab">Flags</a></li>
    <li><a href="#notes" data-toggle="tab">Notes <span class="badge">0</span></a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div class="tab-pane active" id="badge">
      <div class="row">
        <div class="form-group col-md-2 <?=$form->error_on("badge_number") ? "has-error" : "" ?>">
          <?=label_tag("badge_number", "Badge #") ?>
          <?=input_tag($form, "badge_number") ?>
          <?=error_display($form, "badge_number") ?>
        </div>

        <div class="form-group col-md-6 <?=$form->error_on("badge_name") ? "has-error" : "" ?>">
          <?=label_tag("badge_name", "Name on Badge") ?>
          <?=input_tag($form, "badge_name", ["placeholder" => "J Fuzzy Fox"]) ?>
          <?=error_display($form, "badge_name") ?>
        </div>

        <div class="form-group col-md-4 <?=$form->error_on("vendor_id") ? "has-error" : "" ?>">
          <?=label_tag("vendor_id", "Vendor") ?>
          <select class="form-control" id="vendor_id" name="vendor_id">
            <option></option>
            <? foreach($vendors as $vendor){ ?>
              <?=option_tag($vendor->display_name(), @$form->params["vendor_id"], $vendor->id) ?>
            <? } ?>
          </select>
          <?=error_display($form, "vendor_id") ?>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-4 <?=$form->error_on("badge_type") ? "has-error" : "" ?>">
          <?=label_tag("badge_type", "Badge Type") ?>
          <select class="form-control" id="badge_type" name="badge_type">
            <? foreach($badge_types as $type){ ?>
              <?=option_tag($type->name, @$form->params["badge_type"], $type->db_name) ?>
            <? } ?>
          </select>
          <?=error_display($form, "badge_type") ?>
        </div>

        <div class="form-group col-md-4 <?=$form->error_on("admission_level") ? "has-error" : "" ?>">
          <?=label_tag("admission_level", "Admission Level") ?>
          <select class="form-control" id="admission_level" name="admission_level">
            <? foreach($reg_levels as $level){ ?>
              <?=option_tag(reg_level_with_price($level), @$form->params["admission_level"], $level->db_name, ["data-includes-tshirt" => $level->includes_tshirt]) ?>
            <? } ?>
          </select>
          <?=error_display($form, "admission_level") ?>
        </div>

        <div class="form-group col-md-4 <?=$form->error_on("tshirt_size") ? "has-error" : "" ?>">
          <?=label_tag("tshirt_size", "T-Shirt") ?>
          <select class="form-control" id="tshirt_size" name="tshirt_size">
            <option></option>
            <? foreach($tshirt_sizes as $size){ ?>
              <?=option_tag($size->name, @$form->params["tshirt_size"], $size->db_name) ?>
            <? } ?>
          </select>
          <?=error_display($form, "tshirt_size") ?>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-4 <?=$form->error_on("payment_method") ? "has-error" : "" ?>">
          <?=label_tag("payment_method", "Payment Method") ?>
          <select class="form-control" id="payment_method" name="payment_method">
            <option></option>
            <? foreach($payment_types as $type){ ?>
              <?=option_tag($type->name, @$form->params["payment_method"], $type->db_name) ?>
            <? } ?>
          </select>
          <?=error_display($form, "payment_method") ?>
        </div>

        <div class="form-group col-md-4 <?=$form->error_on("override_price") ? "has-error" : "" ?>">
          <?=label_tag("override_price", "Override Price") ?>
          <div class="input-group">
            <div class="input-group-addon">$</div>
            <?=input_tag($form, "override_price") ?>
          </div>
          <?=error_display($form, "override_price") ?>
        </div> 
      </div>

    </div>

    <div class="tab-pane" id="identification">
      <div class="row">
        <div class="form-group col-md-7 <?=$form->error_on("legal_name") ? "has-error" : "" ?>">
          <?=label_tag("legal_name", "Legal Name") ?>
          <?=input_tag($form, "legal_name", ["placeholder" => "John Doe"]) ?>
          <?=error_display($form, "legal_name") ?>
        </div>

        <div class="form-group col-md-3 <?=$form->error_on("birthdate") ? "has-error" : "" ?>">
          <?=label_tag("birthdate", "Date of Birth") ?>
          <?=input_tag($form, "birthdate", ["placeholder" => "MM/DD/YYYY", "data-minor-fields" => "#minor-info"]) ?>
          <?=error_display($form, "birthdate") ?>
        </div>

        <div class="form-group col-md-2">
          <label>Age</label>
          <input class="form-control" id="age" type="text" value="<?=age_from_birthdate(@$form->params["birthdate"]); ?>" readonly>
        </div>
      </div>

      <div class="well alert alert-info" id="minor-info" <? if(!$form->attendee->minor()){ ?>style="display: none;"<? } ?>>
        <div class="row">
          <div class="col-md-12 ">
            <h4>Adult Information</h4>
          </div>
          
          <div class="col-md-12">
            <div class="row">
              <div class="form-group col-md-7 <?=$form->error_on("adult_legal_name") ? "has-error" : "" ?>">
                <?=label_tag("adult_legal_name", "Legal Name") ?>
                <?=input_tag($form, "adult_legal_name", ["placeholder" => "John Doe"]) ?>
                <?=error_display($form, "adult_legal_name") ?>
              </div>

              <div class="form-group col-md-5 <?=$form->error_on("adult_relationship") ? "has-error" : "" ?>">
                <?=label_tag("adult_relationship", "Relationship") ?>
                <select class="form-control" id="adult_relationship" name="adult_relationship">
                  <option></option>
                  <? foreach(AdultRelationship::all() as $relationship){ ?>
                    <?=option_tag($relationship->name, @$form->params["adult_relationship"], $relationship->db_name) ?>
                  <? } ?>
                </select>
                <?=error_display($form, "adult_relationship") ?>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-5 <?=$form->error_on("adult_phone_number") ? "has-error" : "" ?>">
                <?=label_tag("adult_phone_number", "Phone Number") ?>
                <?=input_tag($form, "adult_phone_number", ["placeholder" => "555-555-5555"]) ?>
                <?=error_display($form, "adult_phone_number") ?>
              </div>
              <div class="form-group col-md-2 <?=$form->error_on("adult_badge_number") ? "has-error" : "" ?>">
                <?=label_tag("adult_badge_number", "Badge #") ?>
                <?=input_tag($form, "adult_badge_number", ["placeholder" => ""]) ?>
                <?=error_display($form, "adult_badge_number") ?>
              </div>


          <div class="form-group col-md-5">
            <label>Badge Name</label>
            <input class="form-control" id="age" type="text" value="<?=$adult_badge ? $adult_badge->badge_name : "" ?>" readonly>
          </div>

            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="tab-pane" id="address">
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
    </div>


    <div class="tab-pane" id="flags">

      <div class="row">
        <div class="col-sm-3">
          <div class="form-group">
            <div>
              <div class="checkbox">
                <input type="hidden" name="at_door"  value="0">
                <label>
                  <input type="checkbox" name="at_door" value="1" <? if(@$form->params["at_door"]){ ?>checked="checked"<?}?>> At Door
                </label>
              </div>
              <div class="checkbox">
                <input type="hidden" name="paid"  value="0">
                <label>
                  <input type="checkbox" name="paid" value="1" <? if(@$form->params["paid"]){ ?>checked="checked"<?}?>> Paid
                </label>
              </div>
              <div class="checkbox">
                <input type="hidden" name="checked_in"  value="0">
                <label>
                  <input type="checkbox" name="checked_in" value="1" <? if(@$form->params["checked_in"]){ ?>checked="checked"<?}?>> Checked In
                </label>
              </div>
              <div class="checkbox">
                <input type="hidden" name="canceled"  value="0">
                <label>
                  <input type="checkbox" name="canceled" value="1" <? if(@$form->params["canceled"]){ ?>checked="checked"<?}?>> Canceled / Revoked
                </label>
              </div>
              <div class="checkbox">
                <input type="hidden" name="blacklisted"  value="0">
                <label>
                  <input type="checkbox" name="blacklisted" value="1" <? if(@$form->params["blacklisted"]){ ?>checked="checked"<?}?>> Blacklisted
                </label>
              </div>
            </div>
          </div>
        </div>

        <div class="" id="blacklist-controls">
          <div class="form-group col-sm-3 <?=$form->error_on("blacklist_type") ? "has-error" : "" ?>">
            <?=label_tag("blacklist_type", "Blacklist Type") ?>
            <div class="col-sm-12">
              <div class="radio">
                <label>
                  <?=radio_tag($form, "blacklist_type", "") ?>
                  <span class="label label-default">None</span>
                </label>
              </div>
              <? foreach(BlacklistType::all() as $type){ ?>
                <div class="radio">
                  <label>
                    <?=radio_tag($form, "blacklist_type", $type->db_name) ?>
                    <span class="label label-<?=$type->alert_color ?>"><?=$type->alert_title ?></span>
                  </label>
                </div>
              <? } ?>
            </div>
          </div>

          <div class="form-group col-sm-6 <?=$form->error_on("blacklist_message") ? "has-error" : "" ?>">
            <?=label_tag("blacklist_message", "Blacklist Message") ?>
            <textarea class="form-control" rows="4" name="blacklist_message" id="blacklist_message"><?=htmlentities(@$form->params["blacklist_message"]) ?></textarea>
            <?=error_display($form, "blacklist_message") ?>
          </div>
        </div>
      </div>
    </div>


    <div class="tab-pane" id="notes">
      <div class="form-group">
        <textarea class="form-control" rows="3" name="notes" id="notes"><?=htmlentities(@$form->params["note"]) ?></textarea>
      </div>
    </div>
  </div>

</div>

