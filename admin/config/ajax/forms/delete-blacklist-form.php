<?php
include_once '../../../../_includes/framework.php';
require_admin();

$id = @$_GET['id'];
$id or die("<p>Error, no user id.</p>");

$blacklist = Blacklist::find($id);
$blacklist or die("<p>No user with (ID=$id)");

?>
<input type="hidden" name="id" value="<?=$blacklist->id ?>">

<p>Are you sure you want to delete <?=$blacklist->badge_name ?>?</p>