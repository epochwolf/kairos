<?php
include_once '../_includes/framework.php'; 
$page_title = "Registration Levels";
include "_partials/admin-header.php"; 
?>

<!--  
AT_DOOR_REGISTRATION
PRE_REGISTRATION
REGISTRATION_UPGRADE_PRICING
-->
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
        <? foreach($PRE_REGISTRATION as $level){ ?>
          <tr>
            <td><?=reg_level($level) ?></td>
            <td class="text-right"><?=currency(reg_price($level)) ?></td>
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
        <? foreach($AT_DOOR_REGISTRATION as $level){ ?>
          <tr>
            <td><?=reg_level($level) ?></td>
            <td class="text-right"><?=currency(reg_price($level)) ?></td>
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
        <? foreach($REGISTRATION_UPGRADE_PRICING as $old_level => $new_levels){ ?>
          <? foreach($new_levels as $new_level => $price){ ?>
            <tr>
              <td><?=reg_level($old_level) ?></td>
              <td><?=reg_level($new_level) ?></td>
              <td class="text-right"><?=currency($price) ?></td>
            </tr>
          <? } ?>
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