<?php
include_once '../_includes/framework.php'; 
require_login();

$page_title = "Admin";
include "_partials/admin-header.php"; 

$totals = db_query(<<<SQL
select 
  count(id) as total,
  sum(at_door) as at_door_in,
  sum(IF(at_door=0 AND checked_in=1, 1, 0)) as pre_reg_in,
  sum(IF(at_door=0 AND checked_in=0, 1, 0)) as pre_reg_not_in
from attendees
SQL
)[0];

$by_badges = db_query(<<<SQL
select 
  badge_type, 
  count(badge_type) as badge_count,
  sum(at_door) as at_door_in,
  sum(IF(at_door=0 AND checked_in=1, 1, 0)) as pre_reg_in,
  sum(IF(at_door=0 AND checked_in=0, 1, 0)) as pre_reg_not_in
from attendees 
group by badge_type
SQL
);

$by_level = db_query(<<<SQL
select 
  admission_level, 
  count(admission_level) as level_count,
  sum(at_door) as at_door_in,
  sum(IF(at_door=0 AND checked_in=1, 1, 0)) as pre_reg_in,
  sum(IF(at_door=0 AND checked_in=0, 1, 0)) as pre_reg_not_in
from attendees 
group by admission_level 
order by admission_level
SQL
);
?>

<div class="container">
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-12">
        <table class="table table-bordered lead">
          <tr>
            <th>NUMBERS</th>
            <th>Total</th>
            <th>At Door</th>
            <th>Pre Reg In</th>
            <th>Pre Reg Not In</th>
          </tr>
          <tr>
            <td>All Attendees</td>
            <td class="text-right"><?=$totals["total"] ?></td>
            <td class="text-right"><?=$totals["at_door_in"] ?></td>
            <td class="text-right"><?=$totals["pre_reg_in"] ?></td>
            <td class="text-right"><?=$totals["pre_reg_not_in"] ?></td>
          </tr>

          <tr>
            <th>By Admission Level</th>
            <th>Total</th>
            <th>At Door</th>
            <th>Pre Reg In</th>
            <th>Pre Reg Not In</th>
          </tr>
          <? foreach($by_level as $row){?>
            <tr>
              <td><?=reg_level($row["admission_level"]) ?></td>
              <td class="text-right"><?=$row["level_count"] ?></td>
              <td class="text-right"><?=$row["at_door_in"] ?></td>
              <td class="text-right"><?=$row["pre_reg_in"] ?></td>
              <td class="text-right"><?=$row["pre_reg_not_in"] ?></td>
            </tr>
          <? } ?>

          <tr>
            <th>By Badge Type</th>
            <th>Total</th>
            <th>At Door</th>
            <th>Pre Reg In</th>
            <th>Pre Reg Not In</th>
          </tr>
          <? foreach($by_badges as $row){?>
            <tr>
              <td><?=badge_type($row["badge_type"]) ?></td>
              <td class="text-right"><?=$row["badge_count"] ?></td>
              <td class="text-right"><?=$row["at_door_in"] ?></td>
              <td class="text-right"><?=$row["pre_reg_in"] ?></td>
              <td class="text-right"><?=$row["pre_reg_not_in"] ?></td>
            </tr>
          <? } ?>
        </table>
      </div>

    </div>
  </div>
</div>
<?php
include "_partials/admin-footer.php";  
?>