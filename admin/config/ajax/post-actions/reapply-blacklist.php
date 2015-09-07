<?php
include_once '../../../../_includes/framework.php';
require_admin();

$return_url = @$_POST['return_url'] ?: "/admin/index.php";

foreach(Attendee::all() as $attendee){
  $attendee->apply_blacklist();
  $attendee->save_without_callbacks();
}

?>
<script>
  window.location = "<?=$return_url ?>";
</script>