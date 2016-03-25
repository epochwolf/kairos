<?php
include_once '../_includes/framework.php'; 
require_login();

$page_title = "Admin";
include "_partials/admin-header.php"; 

$query = Vendor::all();
$count = count($query);
?>

<div class="container">
  <div class="col-md-12">
    <h1>
      Vendors (<?=$count ?>)
    </h1>
    <table class="table table-striped table-condensed">
      <thead>
        <tr>
          <th>Name</th>
          <th>Assigned Table(s)</th>
          <th class="hidden-print">Badges</th>
        </tr>
      </thead>
      <tbody>
        <? foreach($query as $vendor){ ?>
          <tr data-id="<?=$vendor->id ?>">
            <td><?=$vendor->display_name() ?></td>
            <td><?=$vendor->assigned_tables ?></td>
            <td>
              <ol class="">
                <? foreach(Attendee::by_vendor_id($vendor->id) as $attendee){ ?>
                  <li>
                    <?=$attendee->display_name() ?> 
                    <?=badge_label($attendee->badge_type) ?> 
                    <?=edit_button_for($attendee, ["class" => ["btn-xs"]]) ?>
                  </li>
                <? } ?>
              </ol>
            </td>
          </tr>
        <? } ?>
      </tbody>
    </table>
  </div>
</div>

<?php
include "_partials/admin-footer.php";  
?>