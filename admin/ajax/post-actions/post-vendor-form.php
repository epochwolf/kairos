<?php
include_once '../../../_includes/framework.php';
require_login();

$id = @$_POST['id'];
$id or die("<p>Error, no vendor id.</p>");

$vendor = Vendor::find($id);
$vendor or die("<p>No vendor with (ID=$id)");

$return_url = @$_POST['return_url'] ?: "/admin/index.php";


$form = new EditVendorForm($_POST);
if($form->valid()){
  $form->save();
  # Kind of a bad hack but it works. 
?>
<script>
  window.location = "<?=$return_url ?>";
</script>
<?php
}else{
  include "../forms/edit-form.php";
}
?>