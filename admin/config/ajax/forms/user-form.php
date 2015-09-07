<?php
include_once '../../../../_includes/framework.php';
require_admin();

if(!isset($form)){
  $form = new UserForm(["id" => @$_GET['id']]);
}

?>
<input type="hidden" name="id" value="<?=$form->user->id ?>">

<div class="text-center">
<? if($form->user->is_new_record()){ ?>
  <h2>New User</h2>
<? }else{ ?>
  <h2>Edit User: <?= $form->user->username ?></h2>
<? } ?> 
</div>

<div class="form-group <?=$form->error_on("username") ? "has-error" : "" ?>">
  <?=label_tag("username", "Username") ?>
  <?=input_tag($form, "username") ?>
  <?=error_display($form, "username") ?>
</div>

<div class="form-group <?=$form->error_on("password") ? "has-error" : "" ?>">
  <?=label_tag("password", "Password") ?>
  <?=input_tag($form, "password", ['type' => 'password']) ?>
  <?=error_display($form, "password") ?>
</div>

<div class="form-group <?=$form->error_on("admin") ? "has-error" : "" ?>">
  <div class="checkbox-inline">
    <input type="hidden" name="admin"  value="0">
    <label>
      <input type="checkbox" name="admin" value="1" <? if(@$form->params["admin"]){ ?>checked="checked"<?}?>> Admin
    </label>
    <?=error_display($form, "admin") ?>
  </div>
</div>