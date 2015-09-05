<?php
include_once '_includes/framework.php'; 
include_once "_includes/forms/login_form.php";
include "_partials/header.php"; 

if(!isset($form)){
  $form = new LoginForm();  
}

?>
<div class="container">

<div class="col-md-12 text-center">
<a href="/index.php" class="btn btn-danger pull-right">Cancel</a>
</div>

<form action="/post-login.php" method="post">
  <div class="col-sm-4 col-sm-offset-4">
    <div class="form-group <?=$form->error_on("username") ? "has-error" : "" ?>">
      <?=label_tag("username", "Username *") ?>
      <?=input_tag($form, "username") ?>
      <?=error_display($form, "username") ?>
    </div>

    <div class="form-group <?=$form->error_on("password") ? "has-error" : "" ?>">
      <?=label_tag("password", "Password *") ?>
      <?=input_tag($form, "password", ["type" => "password"]) ?>
      <?=error_display($form, "password") ?>
    </div>
  </div>

  <div class="col-sm-12 text-center">
    <button type="submit" class="btn btn-primary btn-lg">Login</button>
  </div>
</form>

</div><!-- /.container -->
<?php
include "_partials/footer.php";  
?>