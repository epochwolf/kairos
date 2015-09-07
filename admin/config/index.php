<?php
include_once '../../_includes/framework.php'; 
require_login();

$page_title = "Admin";
include "_partials/admin-header.php"; 

$levels = RegistrationLevel::all();
$upgrades = RegistrationUpgrade::all_with_prices();
$badge_types = BadgeType::all();
$tshirt_sizes = TShirtSize::all();
$payment_types = PaymentType::all();
?>

<div class="container">
  <div class="col-md-12">
    <h1>Configuration Overview</h1>
  </div>

  <div class="row">
    <div class="col-md-6">
      <h3>Reg Levels</h3>
      <table class="table">
        <tr>
          <th>Name</th>
          <th>Price</th>
          <th>T-Shirt</th>
          <th>At Door</th>
        </tr>
        <? foreach($levels as $level){ ?>
          <tr>
            <td><?= $level->name ?></td>
            <td><?=currency($level->price) ?></td>
            <td><?= $level->includes_tshirt ? "&check;" : "" ?></td>
            <td><?= $level->available_at_door ? "&check;" : "" ?></td>
          </tr>
        <? } ?>
      </table>
    </div>

    <div class="col-md-6">
      <h3>Reg Upgrades</h3>
      <table class="table">
        <tr>
          <th>From Name</th>
          <th>To Name</th>
          <th>Price</th>
        </tr>
        <? foreach($upgrades as $upgrade){ ?>
          <tr>
            <td><?= $upgrade->from_name ?></td>
            <td><?= $upgrade->to_name ?></td>
            <td><?=currency($upgrade->price()) ?></td>
          </tr>
        <? } ?>
      </table>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4">
      <h3>Badge Types</h3>
      <table class="table">
        <tr>
          <th>Name</th>
          <th>Minor</th>
        </tr>
        <? foreach($badge_types as $badge_type){ ?>
          <tr>
            <td>
              <? if($badge_type->label_color){ ?>
                <span class="label label-<?=$badge_type->label_color ?>"><?= $badge_type->name ?></span>
              <? }else{ ?>
                <?= $badge_type->name ?>
              <? } ?>
            </td>
            <td><?= $badge_type->minor ? "&check;" : "" ?></td>
          </tr>
        <? } ?>
      </table>
    </div>

    <div class="col-md-4">
      <h3>Payment Types</h3>
      <table class="table">
        <tr>
          <th>Name</th>
          <th>At Door</th>
        </tr>
        <? foreach($payment_types as $payment_type){ ?>
          <tr>
            <td><?= $payment_type->name ?></td>
            <td><?= $payment_type->at_door ? "&check;" : "" ?></td>
          </tr>
        <? } ?>
      </table>
    </div>

    <div class="col-md-4">
      <h3>T-Shirt Size</h3>
      <table class="table">
        <tr>
          <th>Name</th>
        </tr>
        <? foreach($tshirt_sizes as $tshirt_size){ ?>
          <tr>
            <td><?= $tshirt_size->name ?></td>
          </tr>
        <? } ?>
      </table>
    </div>
  </div>
  
</div>
<?php
include "_partials/admin-footer.php";  
?>
