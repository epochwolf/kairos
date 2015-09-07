<?php
include_once '_includes/framework.php'; 
include "_partials/header.php"; 
?>
<div class="container">

<div class="col-md-12 text-center">

<div class="btn-group login-to-admin-buttons pull-right"  >
  <a href="/login.php" class="btn btn-default">Admin</a>
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    <li><a id="hide-admin-button" href="#">Hide Button</a></li>
  </ul>
</div>


<h1>Register At The Door</h1>
<p class="lead">Before registering, you must agree to the Code of Conduct.</p>
</div>

<div class="row">
<div class="col-md-8 col-md-offset-2">
<?=file_get_contents("code-of-conduct.html", true); ?>
</div>
</div>
<div class="row" style="margin-top: 30px;">
<div class="col-sm-12 text-center">
  <a href="/form.php" class="btn btn-primary btn-lg">I agree</a>
</div>
</div>
</div><!-- /.container -->
<?php
include "_partials/footer.php";  
?>