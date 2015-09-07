<?php
include_once '../../../../_includes/framework.php';
require_admin();

$return_url = @$_POST['return_url'] ?: "/admin/index.php";

$id = @$_POST['id'];
$id or die("<p>Error, no user id.</p>");

$payment_type = PaymentType::find($id);
$payment_type or die("<p>No Payment Type with (ID=$id)");

$payment_type->delete();

?>
<script>
  window.location = "<?=$return_url ?>";
</script>
