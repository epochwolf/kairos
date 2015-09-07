<?php
include_once '../../../../_includes/framework.php';
require_admin();

$return_url = @$_POST['return_url'] ?: "/admin/index.php";

$id = @$_POST['id'];
$id or die("<p>Error, no user id.</p>");

$badge_type = BadgeType::find($id);
$badge_type or die("<p>No Badge Type with (ID=$id)");

$badge_type->delete();

?>
<script>
  window.location = "<?=$return_url ?>";
</script>
