<?php
include_once '../../../_includes/framework.php';
require_login();

$return_url = @$_POST['return_url'] ?: "/admin/index.php";

$form = new AddAttendeeForm($_POST);
if($form->valid()){
  $form->save();
  # Kind of a bad hack but it works. 
?>
<script>
  window.location = "<?=$return_url ?>";
</script>
<?php
}else{
  include "../forms/add-attendee-form.php";
}
?>