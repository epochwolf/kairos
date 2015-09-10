<?php
include_once '../../../_includes/framework.php'; 
require_once '_includes/vendor/parsecsv.lib.php';
require_admin();



$csv = new parseCSV();
$csv->auto($_FILES['file']['tmp_name']);

$forms = [];
$errors = [];

foreach($csv->data as $line_number => $row){
  $line_number++;
  $form = new CSVImportRowForm($row);
  $forms[] = $form;

  if(!$form->valid()){
    $errors[$line_number] = $form;
  }
}

//CSVImportRowForm


if(empty($errors)){
  foreach($forms as $form){
    $form->save();
  }

  header("Location: /admin/index.php");
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