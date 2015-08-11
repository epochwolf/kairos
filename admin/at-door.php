<?php
include_once '../_includes/framework.php'; 
require_login();

$page_title = "Admin";
include "_partials/admin-header.php"; 

$query = Attendee::at_door_pending();
$count = count($query);
?>

<!--  
AT_DOOR_REGISTRATION
PRE_REGISTRATION
REGISTRATION_UPGRADE_PRICING
-->
<div class="container">
  <div class="col-md-12">
    <h1>At Door Check In (<?=$count ?>)</h1>
    <? foreach($query as $attendee){ ?>
      <div class="col-md-6">      
        <div class="panel panel-default <?=row_highlight($attendee, "panel") ?>" id="attendee-<?=$attendee->id ?>">
          <div class="panel-heading" style="overflow: hidden;">
            <h3 class="panel-title pull-left">
              <?=$attendee->legal_name ?> / <?=$attendee->badge_name ?>
            </h3>

            <div class="btn-group pull-right" role="group">
              <?=edit_button_for($attendee) ?>
              <?=pay_button_for($attendee) ?>
              <?=check_in_button_for($attendee) ?>
            </div>
          </div>
          <div class="panel-body">

            <div class="row">
              <div class="col-md-6">
                <dl>
                  <dt>Legal Name</dt>
                  <dd id="attendee-<?=$attendee->id ?>-legal_name"><?=$attendee->legal_name ?></dd>
                </dl>

                <dl>
                  <dt>Birthdate</dt>
                  <dd><?=$attendee->birthdate ?></dd>
                </dl>
                
                <dl>
                  <dt>Address</dt>
                  <dd><?=$attendee->formatted_address() ?></dd>
                </dl>
                
                <dl>
                  <dt>Phone</dt>
                  <dd><?=$attendee->phone_number ?></dd>
                </dl>
                
                <dl>
                  <dt>Email</dt>
                  <dd><?=$attendee->email ?></dd>
                </dl>
              </div>

              <div class="col-md-6">
                <dl>
                  <dt>Badge Name</dt>
                  <dd id="attendee-<?=$attendee->id ?>-badge_name"><?=$attendee->badge_name ?></dd>
                </dl>

                <dl>
                  <dt>Badge Number</dt>
                  <dd><?=$attendee->badge_number ?: "Not Assigned" ?></dd>
                </dl>
                
                <dl>
                  <dt>Level</dt>
                  <dd><?=admission_display($attendee) ?> </dd>
                </dl>
                
                <dl>
                  <dt>Payment Method</dt>
                  <dd><?=$attendee->payment_method ?></dd>
                </dl>
                
                <dl>
                  <dt>TShirt Size</dt>
                  <dd><?=$attendee->tshirt_size ?: "N/A" ?></dd>
                </dl>
              </div>
            </div>
          </div>
        </div>
      </div>
    <? } ?>
  </div>
</div>

<?php
include "_partials/pay-modal.php";
include "_partials/check-in-modal.php";
include "_partials/edit-modal.php";
include "_partials/admin-footer.php";  
?>