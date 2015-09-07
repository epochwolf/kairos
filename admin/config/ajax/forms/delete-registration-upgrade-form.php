<?php
include_once '../../../../_includes/framework.php';
require_admin();

$id = @$_GET['id'];
$id or die("<p>Error, no payment type id.</p>");

$registration_upgrade = RegistrationUpgrade::find($id);
$registration_upgrade or die("<p>No registration upgrade with (ID=$id)");

?>
<input type="hidden" name="id" value="<?=$registration_upgrade->id ?>">

<p>Are you sure you want to delete <?=$registration_upgrade->from ?>-><?=$registration_upgrade->from ?>?</p>