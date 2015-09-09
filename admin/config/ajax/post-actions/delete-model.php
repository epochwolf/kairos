<?php
include_once '../../../../_includes/framework.php';
require_admin();

$return_url = @$_POST['return_url'] ?: "/admin/index.php";

$id = @$_POST['id'];
$id or die("<p>Error, no id.</p>");

$model = @$_POST['model'];
$model or die('<p>Error, no modal.</p>');

$user = $model::find($id);
$user or die("<p>No $model with (ID=$id)");

$user->delete();

?>
<script>
  window.location = "<?=$return_url ?>";
</script>
