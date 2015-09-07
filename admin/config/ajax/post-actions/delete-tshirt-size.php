<?php
include_once '../../../../_includes/framework.php';
require_admin();

$return_url = @$_POST['return_url'] ?: "/admin/index.php";

$id = @$_POST['id'];
$id or die("<p>Error, no user id.</p>");

$tshirt_size = TShirtSize::find($id);
$tshirt_size or die("<p>No tshirt with (ID=$id)");

$tshirt_size->delete();

?>
<script>
  window.location = "<?=$return_url ?>";
</script>
