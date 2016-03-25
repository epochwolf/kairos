<?php
include_once '../_includes/framework.php'; 
require_login();

$page_title = "Admin";
include "_partials/admin-header.php"; 

$search_string = trim(@$_GET['q'] ?: "");

if($search_string == ""){
  header("Location: /admin/index.php");
  exit();
}
?>

<div class="container">
  <div class="col-md-12">
    <h1>
      Search: <?=$search_string ?>
      <small><a href="/admin/index.php">Clear</a></small>
    </h1>

    <table class="table table-striped table-condensed">
      <thead>
        <tr>
          <th>Number</th>
          <th>Badge Name</th>
          <th>Legal Name</th>
          <th>Birthdate</th>
          <th>Admission Level</th>
          <th>Adult</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <? foreach(Attendee::search($search_string) as $attendee){ ?>
          <tr class="<?=row_highlight($attendee) ?>">
            <td><?=hilight_search($search_string, $attendee->badge_number) ?></td>
            <td><?=hilight_search($search_string, $attendee->badge_name) ?></td>
            <td><?=hilight_search($search_string, $attendee->legal_name) ?></td>
            <td><?=$attendee->birthdate ?> (<?=$attendee->age() ?>)</td>
            <td><?=admission_display($attendee) ?></td>
            <td>
              <? if($attendee->minor()){ ?>
                <?=hilight_search($search_string, $attendee->adult_display_name()) ?>
              <? } ?>
            </td>
            <td>
              <? if($attendee->canceled){?>
                <?=edit_button_for($attendee, ["class" => ["btn-sm"]]) ?>
              <? }elseif($attendee->checked_in){ ?>
                <div class="btn-group" role="group">
                  <?=edit_button_for($attendee, ["class" => ["btn-sm"]]) ?>
                  <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><?=check_in_button_for($attendee, ["type" => "link"]) ?></li>
                    <li><?=upgrade_button_for($attendee, ["type" => "link"]) ?></li>
                    <li><?=reprint_button_for($attendee, ["type" => "link"]) ?></li>
                    <li><?=cancel_button_for($attendee, ["type" => "link"]) ?></li>
                  </ul>
                </div>
              <? }else{ ?>
                <div class="btn-group" role="group">
                  <?=check_in_button_for($attendee, ["class" => ["btn-sm"]]) ?>
                  <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><?=edit_button_for($attendee, ["type" => "link"]) ?></li>
                    <li><?=upgrade_button_for($attendee, ["type" => "link"]) ?></li>
                    <li><?=reprint_button_for($attendee, ["type" => "link"]) ?></li>
                    <li><?=cancel_button_for($attendee, ["type" => "link"]) ?></li>
                  </ul>
                </div>
              <? } ?>
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
