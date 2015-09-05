<?php
include_once '../../_includes/framework.php'; 
require_admin();

$page_title = "Admin";
include "_partials/admin-header.php"; 

$users = User::all();
?>

<div class="container">
  <div class="col-md-12">
    <h1>Users</h1>

    <table class="table">
      <tr>
        <th>Username</th>
        <th>Password</th>
        <th>Admin</th>
      </tr>
      <? foreach($users as $user){ ?>
        <tr>
          <td><?= $user->username ?></td>
          <td><?= $user->password ?></td>
          <td><?= $user->admin ? "Yes" : "No" ?></td>
        </tr>
      <? } ?>
    </table>
  </div>
</div>
<?php
$count = User::count();
include "_partials/admin-footer.php";  
?>