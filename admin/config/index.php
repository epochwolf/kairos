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

    <h3>Registration Levels</h3>
    <table class="table">
      <tr>
        <th>Db Name</th>
        <th>Name</th>
        <th>Price</th>
        <th>Includes T-Shirt</th>
        <th>Available At Door</th>
        <th>Sort Order</th>
      </tr>
      <? foreach($levels as $level){ ?>
        <tr>
          <td><?= $level->db_name ?></td>
          <td><?= $level->name ?></td>
          <td><?= $level->price ?></td>
          <td><?= $level->includes_tshirt ? "Yes" : "No" ?></td>
          <td><?= $level->available_at_door ? "Yes" : "No" ?></td>
          <td><?= $level->sort_order ?></td>
        </tr>
      <? } ?>
    </table>


    <h3>Registration Upgrades</h3>
    <table class="table">
      <tr>
        <th>From</th>
        <th>From Name</th>
        <th>To</th>
        <th>To Name</th>
        <th>Price</th>
        <th>Override Price</th>
        <th>Sort Order</th>
      </tr>
      <? foreach($upgrades as $upgrade){ ?>
        <tr>
          <td><?= $upgrade->from ?></td>
          <td><?= $upgrade->from_name ?></td>
          <td><?= $upgrade->to ?></td>
          <td><?= $upgrade->to_name ?></td>
          <td><?=currency($upgrade->price) ?></td>
          <td><?=$upgrade->override_price ? currency($upgrade->override_price) : "" ?></td>
          <td><?= $upgrade->sort_order ?></td>
        </tr>
      <? } ?>
    </table>

    <h3>Badge Types</h3>
    <table class="table">
      <tr>
        <th>Db Name</th>
        <th>Name</th>
        <th>Label Color</th>
        <th>Minor</th>
        <th>Sort Order</th>
      </tr>
      <? foreach($badge_types as $badge_type){ ?>
        <tr>
          <td><?= $badge_type->db_name ?></td>
          <td><?= $badge_type->name ?></td>
          <td><?= $badge_type->label_color ?></td>
          <td><?= $badge_type->minor ? "Yes" : "No" ?></td>
          <td><?= $badge_type->sort_order ?></td>
        </tr>
      <? } ?>
    </table>

    <h3>Payment Types</h3>
    <table class="table">
      <tr>
        <th>Db Name</th>
        <th>Name</th>
        <th>At Door</th>
        <th>Sort Order</th>
      </tr>
      <? foreach($payment_types as $payment_type){ ?>
        <tr>
          <td><?= $payment_type->db_name ?></td>
          <td><?= $payment_type->name ?></td>
          <td><?= $payment_type->at_door ? "Yes" : "No" ?></td>
          <td><?= $payment_type->sort_order ?></td>
        </tr>
      <? } ?>
    </table>

    <h3>T-Shirt Size</h3>
    <table class="table">
      <tr>
        <th>Db Name</th>
        <th>Name</th>
        <th>Sort Order</th>
      </tr>
      <? foreach($tshirt_sizes as $tshirt_size){ ?>
        <tr>
          <td><?= $tshirt_size->db_name ?></td>
          <td><?= $tshirt_size->name ?></td>
          <td><?= $tshirt_size->sort_order ?></td>
        </tr>
      <? } ?>
    </table>
  </div>
</div>
<?php
include "_partials/admin-footer.php";  
?>
