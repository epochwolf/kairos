<?php
include_once '../../../../_includes/framework.php';
require_admin();

$return_url = @$_POST['return_url'] ?: "/admin/index.php";

$id = @$_POST['id'];
$id or die("<p>Error, no user id.</p>");

$user = User::find($id);
$user or die("<p>No user with (ID=$id)");

$user->delete();

?>
<script>
  window.location = "<?=$return_url ?>";
</script>
