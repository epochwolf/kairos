<?php
include_once '../../_includes/framework.php'; 
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
        <? $type = BlacklistType::cached_find_by_db_name($blacklist->type) ?>
        <tr class="<?=$type->alert_color ?>">
          <td><?=$blacklist->badge_name ?: "<i>none</i>" ?></td>
          <td><?=$blacklist->legal_name ?: "<i>none</i>" ?></td>
          <td><?=nl2br($blacklist->trigger_badge_names, false) ?></td>
          <td><?=nl2br($blacklist->trigger_legal_names, false) ?></td>
          <td><?=nl2br($blacklist->reason, false) ?></td>
          <td><?=$type->name ?></td>
          <td>
            <div class="btn-group" role="group">
              <?= edit_config_button_for($blacklist, ["class" => ["btn-sm"]]) ?>
              <?= delete_config_button_for($blacklist, ["class" => ["btn-sm"]]) ?>
            </div>
          </td>
        </tr>
      <? }?>
    </table>
    <?=new_config_button_for("Blacklist") ?>
  </div>
</div>
<?php
include "_partials/admin-footer.php";  
?>