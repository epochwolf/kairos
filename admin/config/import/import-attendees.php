<?php
include_once '../../../_includes/framework.php'; 
require_admin();

$page_title = "Admin";
include "_partials/admin-header.php"; 

$levels = RegistrationLevel::pre_reg();
$badge_types = BadgeType::all();
$tshirt_sizes = TShirtSize::all();
$payment_types = PaymentType::all();
?>

<div class="container">
  <div class="col-md-12">
    <h1>
      Import from CSV
    </h1>
    <div class="well">
      <form action="post-attendees.php" method="post" enctype="multipart/form-data" class="form">
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
        <td>badge_number</td>
        <td></td>
        <td>INT</td>
        <td>No duplicates allowed with existing entries</td>
      </tr>
      <tr>
        <td>badge_name</td>
        <td>&check;</td>
        <td>VARCHAR(255)</td>
        <td>Any</td>
      </tr>
      <tr>
        <td>legal_name</td>
        <td>&check;</td>
        <td>VARCHAR(255)</td>
        <td>Any</td>
      </tr>
      <tr>
        <td>birthdate</td>
        <td>&check;</td>
        <td>DATE</td>
        <td>Format must be MM/DD/YYYY</td>
      </tr>
      <tr>
        <td>address1</td>
        <td></td>
        <td>VARCHAR(255)</td>
        <td>Any</td>
      </tr>
      <tr>
        <td>address2</td>
        <td></td>
        <td>VARCHAR(255)</td>
        <td>Any</td>
      </tr>
      <tr>
        <td>city</td>
        <td></td>
        <td>VARCHAR(255)</td>
        <td>Any</td>
      </tr>
      <tr>
        <td>state_prov</td>
        <td></td>
        <td>VARCHAR(255)</td>
        <td>Any</td>
      </tr>
      <tr>
        <td>postal_code</td>
        <td></td>
        <td>VARCHAR(255)</td>
        <td>Any</td>
      </tr>
      <tr>
        <td>phone_number</td>
        <td></td>
        <td>VARCHAR(255)</td>
        <td>Any</td>
      </tr>
      <tr>
        <td>email</td>
        <td></td>
        <td>VARCHAR(255)</td>
        <td>Any</td>
      </tr>
      <tr>
        <td>badge_type</td>
        <td>&check;</td>
        <td>VARCHAR(255)</td>
        <td>
          <?= implode(", ", array_map(function($record){ return "{$record->db_name}"; }, $badge_types)) ?>
        </td>
      </tr>
      <tr>
        <td>admission_level</td>
        <td>&check;</td>
        <td>VARCHAR(255)</td>
        <td>
          <?= implode(", ", array_map(function($record){ return "{$record->db_name}"; }, $levels)) ?>
        </td>
      </tr>
      <tr>
        <td>tshirt_size</td>
        <td></td>
        <td>VARCHAR(255)</td>
        <td>
          <?= implode(", ", array_map(function($record){ return "{$record->db_name}"; }, $tshirt_sizes)) ?>
        </td>
      </tr>
      <tr>
        <td>payment_method</td>
        <td></td>
        <td>VARCHAR(255)</td>
        <td>
          <?= implode(", ", array_map(function($record){ return "{$record->db_name}"; }, $payment_types)) ?>
        </td>
      <tr>
        <td>price</td>
        <td></td>
        <td>INT</td>
        <td>Can't be negative.</td>
      </tr>
      <tr>
        <td>adult_badge_name</td>
        <td></td>
        <td>VARCHAR(255)</td>
        <td>Any</td>
      </tr>
      <tr>
        <td>adult_legal_name</td>
        <td></td>
        <td>VARCHAR(255)</td>
        <td>Any</td>
      </tr>
      <tr>
        <td>notes</td>
        <td></td>
        <td>TEXT</td>
        <td>Any</td>
      </tr>
    </table>
  </div>
</div>
<?php
include "_partials/admin-footer.php";  
?>

