<?php
include_once '../_includes/framework.php'; 
require_login();

$page_title = "At Door Check In";
include "_partials/admin-header.php"; 

$query = Attendee::at_door_pending();
$count = count($query);
?>

<div class="container">
  <div class="col-md-12">
    <h1>
      At Door Check In (<?=$count ?>)
      <small><?=add_attendee_button() ?></small>
    </h1>
    <? foreach($query as $attendee){ ?>
      <div class="col-md-6">      
        <div class="panel panel-default <?=row_highlight($attendee, "panel") ?>" id="attendee-<?=$attendee->id ?>">
          <div class="panel-heading" style="overflow: hidden;">
            <div class="pull-left">
              <h3 class="panel-title">
                <?=$attendee->display_name() ?>
              </h3>
              <div>
                <? if($attendee->minor()){ ?>
                  <small>Adult: <?=$attendee->adult_display_name() ?></small>
                <? } ?>
              </div>
            </div>

            <div class="btn-group pull-right" role="group">
              <?=cancel_button_for($attendee) ?>
              <?=edit_button_for($attendee) ?>
              <?=check_in_button_for($attendee) ?>
            </div>
          </div>
          <div class="panel-body">

            <div class="row">
              <div class="col-md-4">
                <dl>
                  <dt>Badge Name</dt>
                  <dd id="attendee-<?=$attendee->id ?>-badge_name"><?=$attendee->badge_name ?></dd>
                </dl>
                <dl>
                  <dt>Level</dt>
                  <dd><?=admission_display($attendee) ?> </dd>
                </dl>
              </div>

              <div class="col-md-4">
                <dl>
                  <dt>Legal Name</dt>
                  <dd id="attendee-<?=$attendee->id ?>-legal_name"><?=$attendee->legal_name ?></dd>
                </dl>
                <dl>
                  <dt>Payment Method</dt>
                  <dd><?=$attendee->payment_method ?></dd>
                </dl>
              </div>

              <div class="col-md-4">
                <dl>
                  <dt>Birthdate</dt>
                  <dd><?=$attendee->birthdate ?> (<?=$attendee->age() ?>)</dd>
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
include "_partials/admin-footer.php";  
?>