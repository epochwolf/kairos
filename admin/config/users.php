<?php
include_once '../../_includes/framework.php'; 
require_admin();

$page_title = "Config - Users";
include "_partials/admin-header.php"; 

$users = User::all();
?>

<div class="container">
  <div class="col-md-12">
    <h1>Users</h1>

    <table class="table">
      <tr>
        <th>Username</th>
        <th>Admin</th>
        <th>Actions</th>
      </tr>
      <? foreach($users as $user){ ?>
        <tr>
          <td><?= $user->username ?></td>
          <td><?= $user->admin ? "&check;" : "" ?></td>
          <td>
            <?=edit_config_button_for($user, ["class" => ["btn-sm"]]) ?> 
            <?=delete_config_button_for($user, ["class" => ["btn-sm"]]) ?>
          </td>
        </tr>
      <? } ?>
    </table>
    <?=new_config_button_for("User") ?>
  </div>
</div>
<?php
include "_partials/admin-footer.php";  
?>