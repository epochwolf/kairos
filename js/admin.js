$('.standard-modal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget); // Button that triggered the modal
  var modal = $(this);
  var modal_form_tag      = modal.find('form');
  var modal_title_tag     = modal.find('.modal-title');
  var modal_body_tag      = modal.find('.modal-body');
  var modal_submit_button = modal.find('.modal-submit-button');

  // Parameters from button.
  var form_url     = button.data("form");
  var post_url     = button.data("post-form");
  var title        = button.data("title");
  var button_label = button.data("submit-label");

  // Set up modal.
  modal_title_tag.html(title);
  modal_form_tag.attr("action", post_url);
  modal_body_tag.html("Loading...");
  modal_submit_button.html(button_label);

  // Load the form.
  $.ajax({
    url: form_url
  }).done(function( html ) {
    modal_body_tag.html(html);
    // Focus on the first text field after the form is loaded. 
    setTimeout(function(){ modal.find("input[type=text]:visible,select:visible").first().focus(); }, 400);
  });
});

$('.standard-modal').on('submit', "form", function(event){
  event.preventDefault();
  var form = $(this);
  var body = form.find('.modal-body');

  $.post(form.attr("action"), form.serialize(), function(html) {
    body.html(html);
  });
});