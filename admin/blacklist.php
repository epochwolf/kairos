<?php
include_once '../_includes/framework.php'; 
require_admin();

$page_title = "Admin";
include "_partials/admin-header.php"; 

$blacklists = Blacklist::all();

?>

<div class="container">
  <div class="col-md-12">
    <h1>Blacklist Entries</h1>
    <table class="table table-striped">
      <tr>
        <th>Badge Name</th>
        <th>Legal Name</th>
        <th>Trigger Badge Names</th>
        <th>Trigger Legal Names</th>
        <th>Reason</th>
        <th>Type</th>
        <th>Actions</th>
      </tr>
      <? foreach($blacklists as $blacklist){ ?>
        <? $type = BlacklistType::cached_first_by_db_name($blacklist->type) ?>
        <tr class="<?=$type->alert_color ?>">
          <td><?=$blacklist->badge_name ?: "<i>none</i>" ?></td>
          <td><?=$blacklist->legal_name ?: "<i>none</i>" ?></td>
          <td><?=nl2br($blacklist->trigger_badge_names, false) ?></td>
          <td><?=nl2br($blacklist->trigger_legal_names, false) ?></td>
          <td><?=nl2br($blacklist->reason, false) ?></td>
          <td><?=$type->name ?></td>
          <td>
            <div class="btn-group" role="group">
              <?= blacklist_button_for($blacklist, ["class" => ["btn-sm"]]) ?>
              <?= delete_blacklist_button_for($blacklist, ["class" => ["btn-sm"]]) ?>
            </div>
          </td>
        </tr>
      <? }?>
    </table>
    <?= blacklist_button_for() ?>


    <h1>
      Blacklisted Attendees
      <?=reapply_blacklist_button(["class" => ["btn-sm"]]) ?>
    </h1>
    <table class="table table-striped table-condensed ">
      <thead>
        <tr>
          <th>Badge #</th>
          <th>Badge Name</th>
          <th>Legal Name</th>
          <th>Admission Level</th>
          <th>Blacklisted</th>
          <th>Trigger</th>
          <th>Message</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <? foreach(Attendee::blacklisted() as $attendee){ ?>
          <tr class="<?=row_highlight($attendee) ?> attendee" data-id="<?=$attendee->id ?>">
            <td><?=$attendee->badge_number ?></td>
            <td><?=$attendee->badge_name ?></td>
            <td><?=$attendee->legal_name ?></td>
            <td><?=admission_display($attendee) ?></td>
            <td><?=$attendee->blacklisted ? "Yes" : "No" ?></td>
            <td><?=$attendee->blacklist_trigger ?: "Manual" ?></td>
            <td><?=$attendee->blacklist_message ?></td>
            <td>
              <div class="btn-group" role="group">
                <?=edit_button_for($attendee, ["class" => ["btn-sm"]]) ?>
              </div>
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