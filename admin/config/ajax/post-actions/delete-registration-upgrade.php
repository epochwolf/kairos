<?php
include_once '../../../../_includes/framework.php';
require_admin();

$return_url = @$_POST['return_url'] ?: "/admin/index.php";

$id = @$_POST['id'];
$id or die("<p>Error, no registration upgrade id.</p>");

$registration_upgrade = RegistrationUpgrade::find($id);
$registration_upgrade or die("<p>No Registration Upgrade with (ID=$id)");

$registration_upgrade->delete();

?>
<script>
  window.location = "<?=$return_url ?>";
</script>
