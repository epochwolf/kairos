<?php
include_once '../../../_includes/framework.php'; 
require_login();

$page_title = "Admin";
include "_partials/admin-header.php"; 

$code_of_conduct = file_get_contents($APP_ROOT."/code-of-conduct.html");
?>

<div class="container">
  <form action="/admin/config/code-of-conduct/post.php" method="post">
    <div class="col-md-12">
      <h1>Code of Conduct</h1>
      <div class="form-group">
        <textarea class="" name="editor1" id="editor1"><?=htmlentities($code_of_conduct) ?></textarea>
      </div>
    </div>
    <div class="col-sm-12 text-right">
      <a href="/admin/config/code-of-conduct/index.php" class="btn btn-default btn-lg">Cancel</a>
      <button type="submit" class="btn btn-primary btn-lg">Update</button>
    </div>
  </form>
</div>

<script src="./ckeditor/ckeditor.js"></script>
<script>
  CKEDITOR.replace('editor1');
</script>
<?php
include "_partials/admin-footer.php";  
?>