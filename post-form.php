<?php
include_once '_includes/framework.php'; 
include_once "_includes/forms/new_attendee_form.php";

$form = new NewAttendeeForm($_POST);

if(!$form->valid()){
  include "form.php";
}else{
  $form->save();
  include "_partials/header.php"; 
?>


<div class="container text-center">
<h1>You Are Now Registered</h1>
<p class="lead">Pay at the desk to collect your swag!</p>
<a href="/index.php" class="btn btn-primary btn-lg">Start Over</a>
</div>

<script>
  setTimeout(function(){ window.location = "/"; }, 8000);
</script>

<?php
  include "_partials/footer.php";  
}
?>