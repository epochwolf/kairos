<?php
include_once '_includes/framework.php'; 
include_once "_includes/forms/new_attendee_form.php";
include "_partials/header.php"; 

if(!isset($form)){
  $form = new NewAttendeeForm();  
}

$reg_levels = RegistrationLevel::at_door();
$tshirt_sizes = TShirtSize::all();
$payment_types = PaymentType::at_door();

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
      <h3 class="title"> Identification and Contact Information </h3>
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

      <h3> Responsible Adult (Minors Only) </h3>
      <div class="well">
        <p>Any one under the age of <?=MINOR_AGE ?> must have a responsible adult on file.</p>
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

          <div class="form-group col-md-5 <?=$form->error_on("adult_phone_number") ? "has-error" : "" ?>">
            <?=label_tag("adult_phone_number", "Phone Number") ?>
            <?=input_tag($form, "adult_phone_number", ["placeholder" => "555-555-5555"]) ?>
            <?=error_display($form, "adult_phone_number") ?>
          </div>
        </div>
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
            <? foreach($reg_levels as $level){ ?>
              <?=option_tag(reg_level_with_price($level), @$form->params["admission_level"], $level->db_name, ["data-includes-tshirt" => $level->includes_tshirt]) ?>
            <? } ?>
          </select>
        </div>
        <div class="form-group col-md-5 <?=$form->error_on("tshirt_size") ? "has-error" : "" ?>">
          <?=label_tag("tshirt_size", "T-Shirt (Sponsors Only)") ?>
          <select class="form-control" id="tshirt_size" name="tshirt_size">
            <option></option>
            <? foreach($tshirt_sizes as $size){ ?>
              <?=option_tag($size->name, @$form->params["tshirt_size"], $size->db_name) ?>
            <? } ?>
          </select>
          <?=error_display($form, "tshirt_size") ?>
        </div>
      </div>
      <p>Family Packs and Minor Discounts are not reflected in the price. Please inform the person checking you in.</p>

      <h3>Payment Method</h3>
      <div class="row">
        <div class="form-group col-sm-12 <?=$form->error_on("payment_method") ? "has-error" : "" ?>">
          <div>
            <? foreach($payment_types as $type){ ?>
              <div class="radio-inline">
                <label>
                  <?=radio_tag($form, "payment_method", $type->db_name) ?>
                  <?=$type->name?>
                </label>
              </div>
            <? } ?>
            <?=error_display($form, "payment_method") ?>
          </div>
        </div>

      </div>

      <div>
        <h3> Privacy Notice </h3>
        <p>Information collected on this form is only used for identification.</p>
      </div>
    </div>
    <div class="col-sm-12 text-left">
      <p>* Required Field.</p>
    </div>
    <div class="col-sm-12 text-center">
      <button type="submit" class="btn btn-primary btn-lg">Submit</button>
    </div>
  </form>
</div>
<?php
include "_partials/footer.php";  
?>