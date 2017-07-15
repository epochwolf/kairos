<?php
include_once '../_includes/framework.php'; 
require_login();

$page_title = "Admin";
include "_partials/admin-header.php"; 

$badge_name = trim(@$_POST['badge'] ?: "");
$legal_name = trim(@$_POST['legal'] ?: "");

ob_start(); 
$match = Blacklist::match($badge_name, $legal_name);
$string = ob_get_contents();
ob_end_flush();

?>

<div class="container">
  <form action="/admin/check-blacklist.php" method="post">
    <div class="col-md-12">
      <h1>
        Check Blacklist
      </h1>

      <div class="form-group col-md-4">
        <?=label_tag("badge", "Badge Name") ?>
        <input class="form-control" type="text" name="badge" value="<?=$badge_name ?>">
      </div>

      <div class="form-group col-md-4">
        <?=label_tag("legal", "Legal Name") ?>
        <input class="form-control"  type="text" name="legal" value="<?=$legal_name ?>">
      </div>

      <div class="col-md-4">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
    <pre>
    <? var_dump($match) ?>
    </pre>
  </form>
</div>
<?php
include "_partials/admin-footer.php";  
?>
