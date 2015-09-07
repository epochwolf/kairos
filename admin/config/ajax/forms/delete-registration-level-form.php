<?php
include_once '../../../../_includes/framework.php';
require_admin();

$id = @$_GET['id'];
$id or die("<p>Error, no payment type id.</p>");

$registration_level = RegistrationLevel::find($id);
$registration_level or die("<p>No payment type with (ID=$id)");

?>
<input type="hidden" name="id" value="<?=$registration_level->id ?>">

<p>Are you sure you want to delete <?=$registration_level->name ?>?</p>