<?php
include_once '../../../_includes/framework.php'; 
require_login();

$page_title = "Admin";
include "_partials/admin-header.php"; 

$code_of_conduct = file_get_contents($APP_ROOT."/code-of-conduct.html");
?>

<div class="container">
    <div class="col-md-12">
      <h1>
        Code of Conduct
        <a href="/admin/config/code-of-conduct/edit.php" class="btn btn-default btn-sm">Edit</a>
      </h1>
      <?=$code_of_conduct ?>
    </div>
</div>

<script src="./ckeditor/ckeditor.js"></script>
<?php
include "_partials/admin-footer.php";  
?>
<script>
  $(function(){ CKEDITOR.replace('editor1'); });
</script>