<?php
include_once '_includes/framework.php'; 
include "_partials/header.php"; 
?>
<div class="container">

<div class="col-md-12 text-center">
<h1>Register At The Door</h1>
<p class="lead">Before registering, you must agree to the Code of Conduct.</p>
</div>

<div class="row">
<div class="col-md-8 col-md-offset-2">
<? include "_partials/code-of-conduct.php"; ?>
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