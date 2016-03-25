<?php
include_once '../../_includes/framework.php'; 
require_admin();

$page_title = "Admin";
include "_partials/admin-header.php"; 

$vendors = Vendor::order_by_id();
?>

<div class="container">
  <div class="col-md-12">
    <h1>Vendors</h1>

    <table class="table">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Assigned Tables</th>
        <th>Actions</th>
      </tr>
      <? foreach($vendors as $vendor){ ?>
        <tr>
          <td><?= $vendor->id ?></td>
          <td><?= $vendor->name ?></td>
          <td><?= $vendor->assigned_tables ?></td>
          <td>
            <?=edit_config_button_for($vendor, ["class" => ["btn-sm"]]) ?> 
            <?=delete_config_button_for($vendor, ["class" => ["btn-sm"]]) ?>
          </td>
        </tr>
      <? } ?>
    </table>
    <?=new_config_button_for("Vendor") ?>
  </div>
</div>
<?php
include "_partials/admin-footer.php";  
?>