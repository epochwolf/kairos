<?php
include_once '../_includes/framework.php'; 
require_login();

$page_title = "Registration Levels";
include "_partials/admin-header.php"; 

$pre_reg_reg_levels = RegistrationLevel::pre_reg();
$at_door_reg_levels = RegistrationLevel::at_door();
$upgrades = RegistrationUpgrade::all_with_prices();
?>

<div class="container">
  <div class="col-md-12">
    <h1>Registration Levels</h1>
  </div>
  <div class="col-md-4 col-offset-4">

    <h2>Pre Registered</h2>
    <table class="table">
      <thead>
        <tr>
          <th>Level</th>
          <th>Price</th>
        </tr>
      </thead>
      <tbody>
        <? foreach($pre_reg_reg_levels as $level){ ?>
          <tr>
            <td><?=$level->name ?></td>
            <td class="text-right"><?=currency($level->price) ?></td>
          </tr>
        <? } ?>
      </tbody>
    </table>
  </div>
  <div class="col-md-4 col-offset-4">
    <h2>At Door</h2>
    <table class="table">
      <thead>
        <tr>
          <th>Level</th>
          <th>Price</th>
        </tr>
      </thead>
      <tbody>
        <? foreach($at_door_reg_levels as $level){ ?>
          <tr>
            <td><?=$level->name ?></td>
            <td class="text-right"><?=currency($level->price) ?></td>
          </tr>
        <? } ?>
      </tbody>
    </table>
  </div>
  <div class="col-md-4 col-offset-4">
    <h2>Upgrades</h2>
    <table class="table">
      <thead>
        <tr>
          <th>Old Level</th>
          <th>New Level</th>
          <th>Price</th>
        </tr>
      </thead>
      <tbody>
        <? foreach($upgrades as $upgrade){ ?>
          <tr>
            <td><?=$upgrade->from_name ?></td>
            <td><?=$upgrade->to_name ?></td>
            <td class="text-right"><?=currency($upgrade->override_price ?: $upgrade->price) ?></td>
          </tr>
        <? } ?>
        <tr>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>


  </div>
</div>
<?php
include "_partials/admin-footer.php";  
?>