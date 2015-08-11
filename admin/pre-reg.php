<?php
include_once '../_includes/framework.php'; 
require_login();

$page_title = "Admin";
include "_partials/admin-header.php"; 

$query = Attendee::pre_reg_pending();
$count = count($query);
?>

<div class="container">
  <div class="col-md-12">
    <h1>
      Pre Reg Check In (<?=$count ?>)
    </h1>
    <table class="table table-striped table-condensed">
      <thead>
        <tr>
          <th>Badge #</th>
          <th>Badge Name</th>
          <th>Legal Name</th>
          <th>Birthdate</th>
          <th>Address</th>
          <th>Level</th>
          <th>TShirt</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <? foreach($query as $attendee){ ?>
          <tr class="<?=row_highlight($attendee) ?> attendee" data-id="<?=$attendee->id ?>">
            <td><?=$attendee->badge_number ?></td>
            <td><?=$attendee->badge_name ?></td>
            <td><?=$attendee->legal_name ?></td>
            <td><?=$attendee->birthdate ?> (<?=$attendee->age() ?>)</td>
            <td><?=$attendee->formatted_address() ?></td>
            <td><?=admission_display($attendee) ?></td>
            <td><?=$attendee->tshirt_size ?></td>
            <td>
              <div class="btn-group" role="group">
                <?=edit_button_for($attendee, ["class" => ["btn-sm"]]) ?>
                <?=upgrade_button_for($attendee, ["class" => ["btn-sm"]]) ?>
                <?=check_in_button_for($attendee, ["class" => ["btn-sm"]]) ?>
              </div>
            </td>
          </tr>
        <? } ?>
      </tbody>
    </table>
  </div>
</div>

<?php
include "_partials/check-in-modal.php";
include "_partials/edit-modal.php";
include "_partials/upgrade-modal.php";
include "_partials/pay-modal.php";
include "_partials/admin-footer.php";  
?>