<?php
include_once '../../_includes/framework.php'; 
require_login();

$page_title = "Admin";
include "_partials/admin-header.php"; 

$upgrades = RegistrationUpgrade::all_with_prices();
?>
<div class="container">
  <div class="col-md-12">
    <h1>Registration Upgrades</h1>
    <table class="table">
      <tr>
        <th>From</th>
        <th>From Name</th>
        <th>To</th>
        <th>To Name</th>
        <th>Calculated Price</th>
        <th>Override Price</th>
        <th>Sort Order</th>
        <th>Actions</th>
      </tr>
      <? foreach($upgrades as $upgrade){ ?>
        <tr>
          <td><?= $upgrade->from ?></td>
          <td><?= $upgrade->from_name ?></td>
          <td><?= $upgrade->to ?></td>
          <td><?= $upgrade->to_name ?></td>
          <td><?=currency($upgrade->price) ?></td>
          <td><?=!is_null($upgrade->override_price) ? currency($upgrade->override_price) : "" ?></td>
          <td><?= $upgrade->sort_order ?></td>
          <td>
            <?=registration_upgrade_button_for($upgrade, ["class" => "btn-sm"]) ?>
            <?=delete_registration_upgrade_button_for($upgrade, ["class" => "btn-sm"]) ?>
          </td>
        </tr>
      <? } ?>
    </table>
    <?=registration_upgrade_button_for() ?>
  </div>
</div>
<?php
include "_partials/admin-footer.php";  
?>