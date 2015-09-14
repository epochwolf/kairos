<?php
include_once '../../_includes/framework.php'; 
require_login();

$page_title = "Admin";
include "_partials/admin-header.php"; 

$levels = RegistrationLevel::all();
?>
<div class="container">
  <div class="col-md-12">
    <h1>Registration Levels</h1>
    <table class="table">
      <tr>
        <th>Db Name</th>
        <th>Name</th>
        <th>Price</th>
        <th>Includes T-Shirt</th>
        <th>Pre Reg</th>
        <th>At Door</th>
        <th>Sort Order</th>
        <th>Actions</th>
      </tr>
      <? foreach($levels as $level){ ?>
        <tr>
          <td><?= $level->db_name ?></td>
          <td><?= $level->name ?></td>
          <td><?=currency($level->price) ?></td>
          <td><?= $level->includes_tshirt ? "&check;" : "" ?></td>
          <td><?= $level->available_pre_reg ? "&check;" : "" ?></td>
          <td><?= $level->available_at_door ? "&check;" : "" ?></td>
          <td><?= $level->sort_order ?></td>
          <td>
            <?=edit_config_button_for($level, ["class" => "btn-sm"]) ?>
            <?=delete_config_button_for($level, ["class" => "btn-sm"]) ?>
          </td>
        </tr>
      <? } ?>
    </table>
    <?=new_config_button_for("RegistrationLevel") ?>
  </div>
</div>
<?php
include "_partials/admin-footer.php";  
?>