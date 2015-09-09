<?php
include_once '../../../../_includes/framework.php';
require_admin();

$id = @$_GET['id'];
$id or die("<p>Error, no user id.</p>");

$model = @$_GET['model'];
$model or die('<p>Error, no model.</p>');

$record = $model::find($id);
$record or die("<p>No $model with (ID=$id)");

?>
<input type="hidden" name="model" value="<?=$model ?>">
<input type="hidden" name="id" value="<?=$record->id ?>">

<p>Are you sure you want to delete <?=$record->display_name() ?>?</p>