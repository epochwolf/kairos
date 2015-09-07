<div class="modal standard-modal fade" id="standard-modal">
  <div class="modal-dialog">
    <form action="/admin/<? // FORM_URL ?>" method="post">
      <input type="hidden" name="return_url" value="<?=$_SERVER['REQUEST_URI'] ?>">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><? // TITLE ?></h4>
        </div>
        <div class="modal-body">
          <p>Loading...</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary modal-submit-button"><? // LABEL ?></button>
        </div>
      </div>
    </form>
  </div>
</div>