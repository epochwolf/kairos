$(function(){
  $("#hide-admin-button").click(function(e){
    e.preventDefault();
    $(".login-to-admin-buttons").hide();
    $.cookie("hide-admin-button", 1);
  });

  if($.cookie("hide-admin-button")){
    $(".login-to-admin-buttons").hide();
  }
})

