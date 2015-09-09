<?php
include_once '../../../../_includes/framework.php';
require_admin();

$return_url = @$_POST['return_url'] ?: "/admin/index.php";

$form_class = @$_POST['_form_class'];
$form_class or die('<p>Error, no _form_class.</p>');

$form_file = @$_POST['_form_file'];
$form_file or die('<p>Error, no _form_file.</p>');
$form_file = basename($form_file); // No shenanigans

$form = new $form_class($_POST);

if($form->valid()){
  $form->save();
?>
<script>
  window.location = "<?=$return_url ?>";
</script>
<?php
}else{
  include "../forms/$form_file";
}
?>