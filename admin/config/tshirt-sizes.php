<?php
include_once '../../_includes/framework.php'; 
require_login();

$page_title = "Config - T-Shirt Sizes";
include "_partials/admin-header.php"; 

$tshirt_sizes = TShirtSize::all();
?>
<div class="container">
  <div class="col-md-12">
    <h1>T-Shirt Size</h1>
    <table class="table">
      <tr>
        <th>Db Name</th>
        <th>Name</th>
        <th>Sort Order</th>
        <th>Actions</th>
      </tr>
      <? foreach($tshirt_sizes as $tshirt_size){ ?>
        <tr>
          <td><?= $tshirt_size->db_name ?></td>
          <td><?= $tshirt_size->name ?></td>
          <td><?= $tshirt_size->sort_order ?></td>
          <td>
            <?=edit_config_button_for($tshirt_size, ["class" => "btn-sm"]) ?>
            <?=delete_config_button_for($tshirt_size, ["class" => "btn-sm"]) ?>
          </td>
        </tr>
      <? } ?>
    </table>
    <?=new_config_button_for("TShirtSize") ?>
  </div>
</div>
<?php
include "_partials/admin-footer.php";  
?>