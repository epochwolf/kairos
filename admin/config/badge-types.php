<?php
include_once '../../_includes/framework.php'; 
require_login();

$page_title = "Admin";
include "_partials/admin-header.php"; 

$badge_types = BadgeType::all();
?>
<div class="container">
  <div class="col-md-12">
    <h1>Badge Types</h1>
    <table class="table">
      <tr>
        <th>Db Name</th>
        <th>Name</th>
        <th>Label</th>
        <th>Minor Only</th>
        <th>Vendor Badge</th>
        <th>Sort Order</th>
        <th>Actions</th>
      </tr>
      <? foreach($badge_types as $badge_type){ ?>
        <tr>
          <td><?= $badge_type->db_name ?></td>
          <td><?= $badge_type->name ?></td>
          <td><?= $badge_type->label_color ? "<span class=\"label label-{$badge_type->label_color}\">{$badge_type->name}</span>" : "" ?></td>
          <td><?= $badge_type->minor ? "&check;" : "" ?></td>
          <td><?= $badge_type->vendor ? "&check;" : "" ?></td>
          <td><?= $badge_type->sort_order ?></td>
          <td>
            <?=edit_config_button_for($badge_type, ["class" => "btn-sm"]) ?>
            <?=delete_config_button_for($badge_type, ["class" => "btn-sm"]) ?>
          </td>
        </tr>
      <? } ?>
    </table>
    <?=new_config_button_for("BadgeType") ?>
  </div>
</div>
<?php
include "_partials/admin-footer.php";  
?>