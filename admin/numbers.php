<?php
include_once '../_includes/framework.php'; 
$page_title = "Admin";
include "_partials/admin-header.php"; 


$by_at_door = db_query("select at_door, count(at_door) as badge_count from attendees group by at_door order by at_door");
$prereg_checked_in = db_query("select checked_in, count(checked_in) as badge_count from attendees where at_door=0 group by checked_in order by checked_in");
$by_badges = db_query("select badge_type, count(badge_type) as badge_count from attendees group by badge_type");
$by_level = db_query("select admission_level, count(admission_level) as level_count from attendees group by admission_level order by admission_level");

$pre_reg_total = $by_at_door[0][1];
$at_door_total = $by_at_door[1][1];

$pre_reg_checked_in = $prereg_checked_in[1][1];
$pre_reg_not_checked_in = $prereg_checked_in[0][1];
$total = $at_door_total + $pre_reg_total
?>

<div class="container">
  <div class="col-md-12">
    <h1>Numbers</h1>

    <div class="row">
      <div class="col-md-3 lead">Total: <?=$total ?></div>
      <div class="col-md-3 lead">Pre Reg In: <?=$pre_reg_checked_in ?></div>
      <div class="col-md-3 lead">Pre Reg Not In: <?=$pre_reg_not_checked_in ?></div>
      <div class="col-md-3 lead">At Door: <?=$at_door_total ?></div>
    </div>

    <div class="row">

      <div class="col-md-4">
        <table class="table table-bordered lead">
          <thead>
            <tr>
              <th>Admission Level</th>
              <th>Count</th>
            </tr>
          </thead>
          <tbody>
            <? foreach($by_level as $row){?>
              <tr>
                <td><?=reg_level($row["admission_level"]) ?></td>
                <td class="text-right"><?=$row["level_count"] ?></td>
              </tr>
            <? } ?>
          </tbody>
        </table>
      </div>

      <div class="col-md-4">
        <table class="table table-bordered lead">
          <thead>
            <tr>
              <th>Badge Type</th>
              <th>Count</th>
            </tr>
          </thead>
          <tbody>
            <? foreach($by_badges as $row){?>
              <tr>
                <td><?=badge_type($row["badge_type"]) ?></td>
                <td class="text-right"><?=$row["badge_count"] ?></td>
              </tr>
            <? } ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>
<?php
include "_partials/admin-footer.php";  
?>