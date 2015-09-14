<?php
include_once '../../_includes/framework.php'; 
require_login();

$page_title = "Admin";
include "_partials/admin-header.php"; 

$payment_types = PaymentType::all();
?>
<div class="container">
  <div class="col-md-12">
    <h1>Payment Types</h1>
    <table class="table">
      <tr>
        <th>Db Name</th>
        <th>Name</th>
        <th>At Door</th>
        <th>Sort Order</th>
        <th>Actions</th>
      </tr>
      <? foreach($payment_types as $payment_type){ ?>
        <tr>
          <td><?= $payment_type->db_name ?></td>
          <td><?= $payment_type->name ?></td>
          <td><?= $payment_type->at_door ? "&check;" : "" ?></td>
          <td><?= $payment_type->sort_order ?></td>
          <td>
            <?=edit_config_button_for($payment_type, ["class" => "btn-sm"]) ?>
            <?=delete_config_button_for($payment_type, ["class" => "btn-sm"]) ?>
          </td>
        </tr>
      <? } ?>
    </table>
    <?=new_config_button_for("PaymentType") ?>
  </div>
</div>
<?php
include "_partials/admin-footer.php";  
?>