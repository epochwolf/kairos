<?php
include_once '../../_includes/framework.php'; 
require_login();

$page_title = "Checked In";
include "_partials/admin-header.php"; 

$query = Attendee::checked_in_report();


?>

<div class="container">
  <div class="col-md-12">
    <h1>Checked In</h1>
    <table class="table table-striped table-condensed ">
      <thead>
        <tr>
          <th>Badge #</th>
          <th>Badge Name</th>
          <th>Legal Name</th>
          <th>Admission Level</th>
          <th>Check In Time</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <? foreach($query as $attendee){ ?>
          <tr class="<?=row_highlight($attendee) ?> attendee" data-id="<?=$attendee->id ?>">
            <td><?=$attendee->badge_number ?></td>
            <td><?=$attendee->badge_name ?></td>
            <td><?=$attendee->legal_name ?></td>
            <td><?=admission_display($attendee) ?></td>
            <td><?=$attendee->checked_in_at ?></td>
            <td>
              <? if($attendee->canceled){?>
                <?=edit_button_for($attendee, ["class" => ["btn-sm"]]) ?>
              <? }elseif($attendee->checked_in){ ?>
                <div class="btn-group" role="group">
                  <?=edit_button_for($attendee, ["class" => ["btn-sm"]]) ?>
                  <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><?=check_in_button_for($attendee, ["type" => "link"]) ?></li>
                    <li><?=upgrade_button_for($attendee, ["type" => "link"]) ?></li>
                    <li><?=reprint_button_for($attendee, ["type" => "link"]) ?></li>
                    <li><?=cancel_button_for($attendee, ["type" => "link"]) ?></li>
                  </ul>
                </div>
              <? }else{ ?>
                <div class="btn-group" role="group">
                  <?=check_in_button_for($attendee, ["class" => ["btn-sm"]]) ?>
                  <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><?=edit_button_for($attendee, ["type" => "link"]) ?></li>
                    <li><?=upgrade_button_for($attendee, ["type" => "link"]) ?></li>
                    <li><?=reprint_button_for($attendee, ["type" => "link"]) ?></li>
                    <li><?=cancel_button_for($attendee, ["type" => "link"]) ?></li>
                  </ul>
                </div>
              <? } ?>
            </td>
          </tr>
        <? } ?>
      </tbody>
    </table>
  </div>
</div>
<?php
include "_partials/admin-footer.php";  
?>