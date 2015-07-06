<? if($form->attendee->blacklisted()){ 
  $blacklist = $form->attendee->blacklist();
?>
<div class="alert <?=$form->attendee->banned ? "alert-danger" : "alert-warning" ?>" role="alert">
  <h4>
    <?=$form->attendee->banned ? "BANNED" : "Watchlist" ?>: 
    <?=$blacklist->badge_name ?> <? if($blacklist->legal_name){ ?> / <?=$blacklist->legal_name ?> <? } ?>
    <? if($form->attendee->blacklist_trigger){ ?>
      <small class="pull-right"><?=implode(" ≈ ", explode(":", $form->attendee->blacklist_trigger)) ?></small>
    <? } ?> 
  </h4>
  <p><?=nl2br($blacklist->reason) ?></p>
  <? if(!array_key_exists("blacklisted", $form->params)){ ?>
    <div class="checkbox">
      <label>
        <input type="checkbox" name="blacklisted" value="0"> This is a mistake.
      </label>
    </div>
  <? } ?>
</div>
<? } ?>