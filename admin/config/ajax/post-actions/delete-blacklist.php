<?php
include_once '../../../../_includes/framework.php';
require_admin();

$return_url = @$_POST['return_url'] ?: "/admin/index.php";

$id = @$_POST['id'];
$id or die("<p>Error, no user id.</p>");

$blacklist = Blacklist::find($id);
$blacklist or die("<p>No blacklist with (ID=$id)");

$blacklist->delete();

?>
<script>
  window.location = "<?=$return_url ?>";
</script>
