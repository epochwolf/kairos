<?php
include_once '../../../../_includes/framework.php';
require_admin();

$id = @$_GET['id'];
$id or die("<p>Error, no tshirt id.</p>");

$tshirt_size = TShirtSize::find($id);
$tshirt_size or die("<p>No tshirt with (ID=$id)");

?>
<input type="hidden" name="id" value="<?=$tshirt_size->id ?>">

<p>Are you sure you want to delete <?=$tshirt_size->name ?>?</p>