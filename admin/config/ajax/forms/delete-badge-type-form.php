<?php
include_once '../../../../_includes/framework.php';
require_admin();

$id = @$_GET['id'];
$id or die("<p>Error, no payment type id.</p>");

$badge_type = BadgeType::find($id);
$badge_type or die("<p>No payment type with (ID=$id)");

?>
<input type="hidden" name="id" value="<?=$badge_type->id ?>">

<p>Are you sure you want to delete <?=$badge_type->name ?>?</p>