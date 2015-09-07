<?php
include_once '../../../../_includes/framework.php';
require_admin();

$id = @$_GET['id'];
$id or die("<p>Error, no user id.</p>");

$user = User::find($id);
$user or die("<p>No user with (ID=$id)");

?>
<input type="hidden" name="id" value="<?=$user->id ?>">

<p>Are you sure you want to delete <?=$user->username ?>?</p>