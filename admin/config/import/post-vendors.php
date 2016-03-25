<?php
include_once '../../../_includes/framework.php'; 
require_once '_includes/vendor/parsecsv.lib.php';
require_admin();

$csv = new parseCSV();
$csv->auto($_FILES['file']['tmp_name']);

$forms = [];
$errors = [];

try {  
  db_start_transaction();

  foreach($csv->data as $line_number => $row){
    $line_number++;
    $form = new CSVImportVendorForm($row);
    $forms[] = $form;

    if(!$form->valid()){
      $errors[$line_number] = $form;
    }else{
      $form->save();
    }
  }

  if(empty($errors)){
    db_commit_transaction();
  }else{
    db_rollback_transaction();
  }

} catch (Exception $e) {
  db_rollback_transaction();
  throw $e;
}



if(empty($errors)){
  header("Location: /admin/vendors.php");
  die();
}else{
  $page_title = "Admin";
  include "_partials/admin-header.php";
?>
<div class="container">
  <h2>Import Errors</h2>
  <table class="table table-striped">
    <tr>
      <th>Line Number</th>
      <th>Error</th>
    </tr>
    <? foreach($errors as $line => $form){ ?>
      <tr>
        <td><?=$line ?></td>
        <td>
          <ul class="list-unstyled">
            <? foreach($form->errors as $field => $error){ ?>
              <li><?=$field ?> = "<?=@$form->params["$field"] ?>" : <?=$error ?> </li>
            <? } ?>
          </ul>
        </td>
      </tr>
    <? } ?>
  </table>
</div>
<?php
  include "_partials/admin-footer.php";  
}