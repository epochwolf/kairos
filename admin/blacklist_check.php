<?php
include_once '../_includes/framework.php'; 
$page_title = "Admin";
include "_partials/admin-header.php"; 

$badge_name = @$_POST["badge_name"];
$legal_name = @$_POST["legal_name"];

list($row, $trigger, $name) = Blacklist::match($badge_name, $legal_name);
?>

<div class="container">
  <form action="/admin/blacklist_check.php" method="post">
    <div class="col-sm-6">
      <h1>Blacklist Check</h1>
      <div class="form-group col-md-12 ">
        <?=label_tag("legal_name", "Legal Name") ?>
        <input type="text" class="form-control" name="legal_name" value="<?=htmlentities($legal_name) ?>">
      </div>
      <div class="form-group col-md-12 ">
        <?=label_tag("badge_name", "Badge Name") ?>
        <input type="text" class="form-control" name="badge_name" value="<?=htmlentities($badge_name) ?>">
      </div>
      <div class="">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </div>
    <div class="col-sm-6">
      <h3>Match</h3>
      <dl>
        <dt>Trigger Type</dt>
        <dd><?=$trigger ?></dd>
        <dt>Trigger Name</dt>
        <dd><?=$name ?></dd>
      </dl>
      <h3>Black List Entry</h3>
      <? if($row){ ?>
        <dl>
          <dt>Badge Name</dt>
          <dd><?=$row->badge_name ?></dd>
          <dt>Legal Name</dt>
          <dd><?=$row->legal_name ?></dd>
          <dt>Badge Name Triggers</dt>
          <dd><pre><?=$row->trigger_badge_names ?></pre></dd>
          <dt>Legal Name Triggers</dt>
          <dd><pre><?=$row->trigger_legal_names ?></pre></dd>
          <dt></dt>
          <dd><?=nl2br($row->reason) ?></dd>
        </dl>
      <? } ?>
    </div>
  </form>
</div>

<?php
include "_partials/admin-footer.php";  
?>