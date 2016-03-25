<?php
include_once '../../../_includes/framework.php'; 
require_admin();

$page_title = "Admin";
include "_partials/admin-header.php"; 
?>

<div class="container">
  <div class="col-md-12">
    <h1>
      Import Vendors from CSV
    </h1>
    <div class="well">
      <form action="post-vendors.php" method="post" enctype="multipart/form-data" class="form">
        <div class="form-group">
          <label for="file">Select csv to upload:</label>
          <input type="file" name="file" id="file">
        </div>
        <input type="submit" value="Import" name="submit" class="btn btn-default">
      </form>
    </div>
    <p>
      To import from CSV, you'll need a CSV file with the following columns: 
    </p>
    <table class="table">
      <tr>
        <th>Column Name</th>
        <th>Required?</th>
        <th>Data Type</th>
        <th>Valid Values</th>
      </tr>
      <tr>
        <td>id</td>
        <td>&check;</td>
        <td>INT</td>
        <td>No duplicates allowed with existing entries</td>
      </tr>
      <tr>
        <td>name</td>
        <td>&check;</td>
        <td>VARCHAR(255)</td>
        <td>Any</td>
      </tr>
      <tr>
        <td>assigned_tables</td>
        <td></td>
        <td>VARCHAR(255)</td>
        <td>Comma seperated numbers</td>
      </tr>
      <tr>
        <td>vendor_license_number</td>
        <td></td>
        <td>VARCHAR(255)</td>
        <td>Vendor's Tax ID</td>
      </tr>
      <tr>
        <td>notes</td>
        <td></td>
        <td>VARCHAR(255)</td>
        <td>Any</td>
      </tr>
    </table>
  </div>
</div>
<?php
include "_partials/admin-footer.php";  
?>

