<?php
include_once '../_includes/framework.php'; 
require_login();

$page_title = "Admin";
include "_partials/admin-header.php"; 

$tab = @$_GET["tab"] ?: "all";  

$badge_types = BadgeType::cached_all();

$type = null;

switch($tab){
  case "badge":
    $type = BadgeType::cached_find_by_db_name($_GET["type"]);
    $query = Attendee::by_badge_type($type->db_name);
    break;
  case "under_minor_age":
    $query = Attendee::minors();
    break;
  case "blacklisted":
    $query = Attendee::blacklisted();
    break;
  case "canceled":
    $query = Attendee::canceled();
    break;
  default:
    $query = Attendee::all();
}
?>

<div class="container">
  <div class="col-md-12">
    <h1>All Attendees</h1>
    <ul class="nav nav-tabs">
      <?= nav_link("All", "/admin/index.php", $tab == "all") ?>
      <? foreach($badge_types as $bt){ ?>
        <?= nav_link($bt->name, "/admin/index.php?tab=badge&type={$bt->db_name}", $tab == "badge" && $bt->db_name == $type->db_name) ?>
      <? } ?>
      <?= nav_link("Under ".MINOR_AGE, "/admin/index.php?tab=under_minor_age", $tab == "under_minor_age") ?>
      <?= nav_link("Blacklisted", "/admin/index.php?tab=blacklisted", $tab == "blacklisted") ?>
      <?= nav_link("Canceled/Revoked", "/admin/index.php?tab=canceled", $tab == "canceled") ?>
    </ul>
    <table class="table table-striped table-condensed ">
      <thead>
        <tr>
          <th>Badge #</th>
          <th>Badge Name</th>
          <th>Legal Name</th>

          <? if($tab == "blacklisted"){ ?>
            <th>Admission Level</th>
            <th>Blacklisted</th>
            <th>Trigger</th>
            <th>Message</th>

          <? }elseif($type && $type->vendor){ ?>
            <th>Vendor</th>
            <th>Admission Level</th>

          <? }else{ ?>
            <th>Birthdate</th>
            <th>Admission Level</th>
            <th>Adult</th>
          <? } ?>

          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <? foreach($query as $attendee){ ?>
          <tr class="<?=row_highlight($attendee) ?> attendee" data-id="<?=$attendee->id ?>">
            <td><?=$attendee->badge_number ?></td>
            <td><?=$attendee->badge_name ?></td>
            <td><?=$attendee->legal_name ?></td>
            <? if($tab == "blacklisted"){ ?>
              <td><?=admission_display($attendee) ?></td>
              <td><?=$attendee->blacklisted ? "&check;" : "" ?></td>
              <td><?=$attendee->blacklist_trigger ?: "Manual" ?></td>
              <td><?=$attendee->blacklist_message ?></td>

            <? }elseif($type && $type->vendor){ ?>
              <? $vendor = $attendee->vendor() ?>
              <td><?= $vendor ? $vendor->display_name() : "" ?></td>
              <td><?=admission_display($attendee) ?></td>

            <? }else{ ?>
                <td><?=$attendee->birthdate ?> (<?=$attendee->age() ?>)</td>
                <td><?=admission_display($attendee) ?></td>
                <td>
                  <? if($attendee->minor()){ ?>
                    <?=$attendee->adult_display_name() ?>
                  <? } ?>
                </td>
            <? } ?>

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