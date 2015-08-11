<?php
include_once '_includes/framework.php'; 
include_once "_includes/forms/new_attendee_form.php";
include "_partials/header.php"; 

if(!isset($form)){
  $form = new NewAttendeeForm();  
}
?>

<div class="container">
  <form action="/post-form.php" method="post">
    <div class="col-sm-12 text-center">
      <a href="/index.php" class="btn btn-danger pull-right">Cancel</a>
      <h1>Register At The Door</h1>
      <? if(!empty($form->errors)){?>
        <div class="alert alert-danger" role="alert">
          There was one or more errors with your registration.
        </div>
      <? } ?>
    </div>
    <div class="col-sm-6">
      <h3 class="title"> Identification </h3>
      <p>To register you must have a government issued photo ID.</p>
      <div class="row">
        <div class="form-group col-md-8 <?=$form->error_on("legal_name") ? "has-error" : "" ?>">
          <?=label_tag("legal_name", "Legal Name *") ?>
          <?=input_tag($form, "legal_name", ["placeholder" => "John Doe"]) ?>
          <?=error_display($form, "legal_name") ?>
        </div>
        <div class="form-group col-md-4 <?=$form->error_on("birthdate") ? "has-error" : "" ?>">
          <?=label_tag("birthdate", "Date of Birth *") ?>
          <?=input_tag($form, "birthdate", ["placeholder" => "MM/DD/YYYY"]) ?>
          <?=error_display($form, "birthdate") ?>
          <? if(@$form->params["birthdate"] && !$form->error_on("birthdate")){ ?>
            <span class="help-block">Age: <?=age_from_birthdate(@$form->params["birthdate"]); ?></span>
          <? } ?>
        </div>
      </div>

      <h3>Address</h3>
      <div class="row">
        <div class="form-group col-md-7 <?=$form->error_on("address1") ? "has-error" : "" ?>">
          <?=label_tag("address1", "Address 1 *") ?>
          <?=input_tag($form, "address1", ["placeholder" => "123 Fake St"]) ?>
          <?=error_display($form, "address1") ?>
        </div>
        <div class="form-group col-md-5 <?=$form->error_on("address2") ? "has-error" : "" ?>">
          <?=label_tag("address2", "Address 2") ?>
          <?=input_tag($form, "address2", ["placeholder" => "Unit 3"]) ?>
          <?=error_display($form, "address2") ?>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-4 <?=$form->error_on("city") ? "has-error" : "" ?>">
          <?=label_tag("city", "City *") ?>
          <?=input_tag($form, "city", ["placeholder" => "Cincinnati"]) ?>
          <?=error_display($form, "city") ?>
        </div>
        <div class="form-group col-md-4 col-sm-6 <?=$form->error_on("state_prov") ? "has-error" : "" ?>">
          <?=label_tag("state_prov", "State/Providence *") ?>
          <?=input_tag($form, "state_prov", ["placeholder" => "Ohio"]) ?>
          <?=error_display($form, "state_prov") ?>
        </div>
        <div class="form-group col-md-4 col-sm-6 <?=$form->error_on("postal_code") ? "has-error" : "" ?>">
          <?=label_tag("postal_code", "Postal Code *") ?>
          <?=input_tag($form, "postal_code", ["placeholder" => "45231"]) ?>
          <?=error_display($form, "postal_code") ?>
        </div>
      </div>

      <h3>Contact Information</h3>
      <div class="row">
        <div class="form-group col-md-6 <?=$form->error_on("phone_number") ? "has-error" : "" ?>">
          <?=label_tag("phone_number", "Phone Number *") ?>
          <?=input_tag($form, "phone_number", ["placeholder" => "555-555-5555"]) ?>
          <?=error_display($form, "phone_number") ?>
        </div>

        <div class="form-group col-md-6 <?=$form->error_on("email") ? "has-error" : "" ?>">
          <?=label_tag("email", "Email Address") ?>
          <?=input_tag($form, "email", ["placeholder" => "fuzzyfox@example.com"]) ?>
          <?=error_display($form, "email") ?>
        </div>
      </div>

      <div class="checkbox">
        <input type="hidden" name="newsletter"  value="0">
        <label>
          <input type="checkbox" name="newsletter" value="1"> Keep me informed about local Fur Reality events.
        </label>
        <span class="help-block">Like a party at a castle. We don't do bowling.</span>
      </div>
    </div>

    <div class="col-sm-6">
      <h3>Badge Information</h3>
      <div class="form-group <?=$form->error_on("badge_name") ? "has-error" : "" ?>">
        <?=label_tag("badge_name", "Name on Badge *") ?>
        <?=input_tag($form, "badge_name", ["placeholder" => "J Fuzzy Fox"]) ?>
        <?=error_display($form, "badge_name") ?>
      </div>
      <div class="row">
        <div class="form-group col-md-7">
          <?=label_tag("admission_level", "Admission Level") ?>
          <select class="form-control" id="admission_level" name="admission_level">
            <? foreach($AT_DOOR_REGISTRATION as $level){ ?>
              <option value="<?=$level ?>" <?if(@$form->params["admission_level"] == $level){?>selected="selected"<? } ?>><?=reg_level_with_price($level) ?></option>
            <? } ?>
          </select>
        </div>
        <div class="form-group col-md-5 <?=$form->error_on("tshirt_size") ? "has-error" : "" ?>">
          <?=label_tag("tshirt_size", "T-Shirt (Sponsors Only)") ?>
          <select class="form-control" id="tshirt_size" name="tshirt_size">
            <option></option>
            <? foreach($TSHIRT_SIZES as $size){ ?>
              <option <?if(@$form->params["tshirt_size"] == $size){?>selected="selected"<? } ?>><?=$size ?></option>
            <? } ?>
          </select>
          <?=error_display($form, "tshirt_size") ?>
        </div>
      </div>

      <h3>Payment Method</h3>
      <div class="row">
        <div class="form-group col-sm-12 <?=$form->error_on("payment_method") ? "has-error" : "" ?>">
          <div class="radio-inline">
            <label>
              <input type="radio" name="payment_method" id="payment_method_cash" value="cash" <?if(@$form->params["payment_method"] == "cash"){?>checked="checked"<? } ?>>
              Cash
            </label>
          </div>
          <div class="radio-inline">
            <label>
              <input type="radio" name="payment_method" id="payment_method_credit" value="credit" <?if(@$form->params["payment_method"] == "credit"){?>checked="checked"<? } ?>>
              Credit/Debit
            </label>
          </div>
          <?=error_display($form, "payment_method") ?>
        </div>

      </div>

      <div class="well">
        <h3> Adult Guardian (Minors Only) </h3>
        <p>Any one under the age of 18 must have a registered adult with them.</p>
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
      </div>

      <div>
        <h3> Privacy Notice </h3>
        <p>Information collected on this form is only used for identification.</p>
      </div>
    </div>
    <div class="col-sm-12 text-center">
      <button type="submit" class="btn btn-primary btn-lg">Submit</button>
    </div>
    <div class="col-sm-12 text-left">
      <p>* Required Field.</p>
    </div>
  </form>
</div>
<?php
include "_partials/footer.php";  
?>