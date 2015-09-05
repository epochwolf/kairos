<?php
include_once '../../../_includes/framework.php';
include_once "_includes/forms/reprint_form.php";
require_login();

$id = @$_POST['id'];
$id or die("<p>Error, no attendee id.</p>");

$attendee = Attendee::find($id);
$attendee or die("<p>No attendee with (ID=$id)");

$return_url = @$_POST['return_url'] ?: "/admin/index.php";


$form = new ReprintForm($_POST);
if($form->valid()){
  $form->save();
  # Kind of a bad hack but it works. 
?>
<script>
  window.location = "<?=$return_url ?>";
</script>
<?php
}else{
  include "../forms/reprint-form.php";
}
?>