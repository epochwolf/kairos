<?php
include_once '../_includes/framework.php'; 
require_login();

$page_title = "Numbers";
include "_partials/admin-header.php"; 

$totals = db_query(<<<SQL
select 
  count(id) as total,
  sum(at_door) as at_door_in,
  sum(IF(at_door=0 AND checked_in=1, 1, 0)) as pre_reg_in,
  sum(IF(at_door=0 AND checked_in=0, 1, 0)) as pre_reg_not_in,
  sum(IF(badge_reprints > 0, 1, 0)) as attendees_reprinted, 
  sum(badge_reprints) as total_reprints,
  sum(IF(override_price = 0, 1, 0)) as comped_badges,
  sum(IF(canceled=1, 1, 0)) as revoked_badges
from attendees
where NOT (attendees.canceled = 1 AND attendees.paid = 0)
SQL
)[0];

$cancelled = db_query(<<<SQL
select 
  count(id) as total
from attendees
where (attendees.canceled = 1 AND attendees.paid = 0)
SQL
)[0];

$by_badges = db_query(<<<SQL
select 
  badge_types.name as badge_type, 
  count(badge_type) as badge_count,
  sum(at_door) as at_door_in,
  sum(IF(at_door=0 AND checked_in=1, 1, 0)) as pre_reg_in,
  sum(IF(at_door=0 AND checked_in=0, 1, 0)) as pre_reg_not_in
from attendees 
join badge_types on badge_types.db_name = attendees.badge_type
where NOT (attendees.canceled = 1 AND attendees.paid = 0)
group by attendees.badge_type
order by badge_types.sort_order ASC
SQL
);

$by_level = db_query(<<<SQL
select 
  rl.name as admission_level, 
  count(admission_level) as level_count,
  sum(at_door) as at_door_in,
  sum(IF(at_door=0 AND checked_in=1, 1, 0)) as pre_reg_in,
  sum(IF(at_door=0 AND checked_in=0, 1, 0)) as pre_reg_not_in
from attendees 
join registration_levels rl on rl.db_name = admission_level
where NOT (attendees.canceled = 1 AND attendees.paid = 0)
group by rl.name 
order by rl.sort_order ASC
SQL
);

$upgrades = db_query(<<<SQL
select 
  old_rl.name as original_admission_level, 
  rl.name as admission_level, 
  count(admission_level) as level_count 
from attendees
join registration_levels rl on rl.db_name = admission_level
join registration_levels old_rl on old_rl.db_name = original_admission_level
where original_admission_level != admission_level AND NOT (attendees.canceled = 1 AND attendees.checked_in = 0)
group by rl.name, old_rl.name
order by rl.sort_order, old_rl.sort_order
SQL
);


$payment_report = db_query(<<<SQL
SELECT 
  SUM(COALESCE(attendees.override_price, registration_levels.price)) as total, 
  attendees.payment_method as payment_method, 
  DATE_FORMAT(attendees.created_at, "%Y-%m-%d %W") as day 
FROM `attendees` 
JOIN registration_levels 
  ON attendees.admission_level = registration_levels.db_name
GROUP BY 
  attendees.payment_method, 
  DATE_FORMAT(attendees.created_at, "%Y-%m-%d %W")
ORDER BY
  DATE_FORMAT(attendees.created_at, "%Y-%m-%d %W"),
  attendees.payment_method
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
              <td><?=$row["admission_level"] ?></td>
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
              <td><?=$row["badge_type"] ?></td>
              <td class="text-right"><?=$row["badge_count"] ?></td>
              <td class="text-right"><?=$row["at_door_in"] ?></td>
              <td class="text-right"><?=$row["pre_reg_in"] ?></td>
              <td class="text-right"><?=$row["pre_reg_not_in"] ?></td>
            </tr>
          <? } ?>
        </table>
      </div>
      <div class="col-md-6">
        <h2>Upgrades</h2>
        <table class="table table-bordered lead">
          <tr>
            <th>From</th>
            <th>To</th>
            <th>Total</th>
          </tr>
          <? foreach($upgrades as $row){?>
            <tr>
              <td><?=$row["original_admission_level"] ?></td>
              <td><?=$row["admission_level"] ?></td>
              <td class="text-right"><?=$row["level_count"] ?></td>
            </tr>
          <? } ?>
        </table>
      </div>
      <div class="col-md-6">
        <h2>Other Numbers</h2>
        <table class="table table-bordered lead">
          <tr>
            <td>Comped Badges</td>
            <td><?=$totals["comped_badges"] ?></td>
          </tr>
          <tr>
            <td>Attendees Needing Badge Reprinted</td>
            <td><?=$totals["attendees_reprinted"] ?></td>
          </tr>
          <tr>
            <td>Total Badge Reprints</td>
            <td><?=$totals["total_reprints"] ?></td>
          </tr>
          <tr>
            <td>Revoked Badges<sup>1</sup></td>
            <td><?=$totals["revoked_badges"] ?></td>
          </tr>
          <tr>
            <td>Canceled Orders<sup>2</sup></td>
            <td><?=$cancelled["total"] ?></td>
          </tr>
        </table>
      </div>

    </div>
    <div class="row">
      <ol>
        <li>Revoked badges (Canceled & Paid) are included in all numbers.</li>
        <li>Canceled orders (Canceled & Not Paid) do not count towards other numbers listed.</li>
      </ol>
    </div>
    <div class="row">
      <h2>Payment Records</h2>
      <table class="table table-bordered lead">
        <tr>
          <th>Day</th>
          <th>Payment Method</th>
          <th>Amount</th>
        </tr>

        <? foreach($payment_report as $row){?>
          <tr>
            <td><?=$row["day"] ?></td>
            <td><?=$row["payment_method"] ?></td>
            <td class="text-right">$<?=number_format($row["total"]) ?></td>
          </tr>
        <? } ?>
      </table>
      
    </div>
  </div>
</div>


<?php
include "_partials/admin-footer.php";  
?>