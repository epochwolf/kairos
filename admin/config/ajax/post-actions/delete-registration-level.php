<?php
include_once '../../../../_includes/framework.php';
require_admin();

$return_url = @$_POST['return_url'] ?: "/admin/index.php";

$id = @$_POST['id'];
$id or die("<p>Error, no registration level.</p>");

$registration_level = RegistrationLevel::find($id);
$registration_level or die("<p>No Registration Level with (ID=$id)");

$registration_level->delete();

?>
<script>
  window.location = "<?=$return_url ?>";
</script>
