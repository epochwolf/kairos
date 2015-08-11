<?php
include_once '../_includes/framework.php'; 
require_admin();

$page_title = "Admin";
include "_partials/admin-header.php"; 

$blacklists = Blacklist::all();

?>

<div class="container">
  <div class="col-md-12">
    <h1>Blacklist</h1>
    <table class="table table-striped">
      <tr>
        <th>Badge Name</th>
        <th>Legal Name</th>
        <th>Trigger Badge Names</th>
        <th>Trigger Legal Names</th>
        <th>Reason</th>
        <th>Checked In As</th>
      </tr>
      <? foreach($blacklists as $blacklist){ ?>            
        <tr class="<?=$blacklist->banned ? "danger" : "" ?>">
          <td><?=$blacklist->badge_name ?: "<i>none</i>" ?></td>
          <td><?=$blacklist->legal_name ?: "<i>none</i>" ?></td>
          <td><?=nl2br($blacklist->trigger_badge_names, false) ?></td>
          <td><?=nl2br($blacklist->trigger_legal_names, false) ?></td>
          <td><?=nl2br($blacklist->reason, false) ?></td>
          <td>

            <? $attendees = $blacklist->attendees() ?>
            <? if(!empty($attendees)){ ?>
              <ul class="list-unstyled">
                <? foreach($attendees as $row){ ?>
                  <li><?=$row->badge_name ?></li>
                <? } ?>
              </ul>
            <? } ?>
          </td>
        </tr>
      <? }?>
    </table>
  </div>
</div>
<?php
include "_partials/admin-footer.php";  
?>