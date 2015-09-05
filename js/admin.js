$('.attendee-modal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget); // Button that triggered the modal
  var attendee_id = button.data('id'); // Extract info from data-* attributes
  var modal = $(this);
  var file = modal.data("body");
  var body = modal.find('.modal-body');

  body.html("Loading...");

  $.ajax({
    url: "/admin/ajax/forms/"+file+"?id="+attendee_id
  }).done(function( html ) {
    body.html(html);
    setTimeout(function(){ modal.find("input[type=text]:visible,select:visible").first().focus(); }, 400);
  });
});

$('.attendee-modal').on('submit', "form", function(event){
  event.preventDefault();
  var form = $(this);
  var body = form.find('.modal-body');

  $.post(form.attr("action"), form.serialize(), function(html) {
    body.html(html);
  });
});