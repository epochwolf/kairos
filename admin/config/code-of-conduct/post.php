<?php
include_once '../../../_includes/framework.php'; 

$text = @$_POST['editor1'];
$text or die("<p>Error, no text received.</p>");

file_put_contents($APP_ROOT."/code-of-conduct.html", $text);

header("Location: /admin/config/code-of-conduct/index.php");
die();