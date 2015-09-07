<?php
include_once '../../../../_includes/framework.php';
require_admin();

$id = @$_GET['id'];
$id or die("<p>Error, no payment type id.</p>");

$payment_type = PaymentType::find($id);
$payment_type or die("<p>No payment type with (ID=$id)");

?>
<input type="hidden" name="id" value="<?=$payment_type->id ?>">

<p>Are you sure you want to delete <?=$payment_type->name ?>?</p>