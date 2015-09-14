<?php
include_once '../_includes/framework.php'; 
require_login();

$page_title = "Admin";
include "_partials/admin-header.php"; 

$tab = @$_GET["tab"] ?: "all";  

switch($tab){
  case "staff":
    $query = Attendee::by_badge_type("staff");
    break;
  case "dealers":
    $query = Attendee::by_badge_type("dealer");
    break;
  case "minors":
    $query = Attendee::by_badge_type("minor");
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
      <?= nav_link("Staff", "/admin/index.php?tab=staff", $tab == "staff") ?>
      <?= nav_link("Dealers", "/admin/index.php?tab=dealers", $tab == "dealers") ?>
      <?= nav_link("Minors", "/admin/index.php?tab=minors", $tab == "minors") ?>
    </ul>
    <table class="table table-striped table-condensed ">
      <thead>
        <tr>
          <th>Badge #</th>
          <th>Badge Name</th>
          <th>Legal Name</th>
          <? if($tab != "dealers"){ ?>
            <th>Birthdate</th>
          <? }else{ ?>
            <th>Company Name</th>
          <? } ?>
          <th>Admission Level</th>
          <? if($tab != "dealers"){ ?>
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
            <? if($tab != "dealers"){ ?>
              <td><?=$attendee->birthdate ?> (<?=$attendee->age() ?>)</td>
            <? }else{ ?>
              <td><?=$attendee->company_name ?></td>
            <? } ?>
            <td><?=admission_display($attendee) ?></td>
            <? if($tab != "dealers"){ ?>
              <td>
                <? if($attendee->minor()){ ?>
                  <?=$attendee->adult_display_name() ?>
                <? } ?>
              </td>
            <? } ?>
            <td>
              <div class="btn-group" role="group">
                <?=edit_button_for($attendee, ["class" => ["btn-sm"]]) ?>
                <?=upgrade_button_for($attendee, ["class" => ["btn-sm"]]) ?>
                <?=reprint_button_for($attendee, ["class" => ["btn-sm"]]) ?>
                <?=pay_button_for($attendee, ["class" => ["btn-sm"]]) ?>
                <?=check_in_button_for($attendee, ["class" => ["btn-sm"]]) ?>
              </div>
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