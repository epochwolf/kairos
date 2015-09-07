<? if($form->attendee->blacklisted){ 
  $blacklist_type = BlacklistType::find_by_db_name($form->attendee->blacklist_type);
  $blacklist = $form->attendee->blacklist();
?>
<div class="alert <?=$blacklist_type->alert_color ? "alert-{$blacklist_type->alert_color}" : "" ?>" role="alert">
  <h4>
    <?=$blacklist_type->alert_title ?>: 
    <? if($blacklist){ ?>
      <?=$blacklist->badge_name ?> <? if($blacklist->legal_name){ ?> / <?=$blacklist->legal_name ?> <? } ?>
      <? if($form->attendee->blacklist_trigger){ ?>
        <small class="pull-right"><?=implode(" ≈ ", explode(":", $form->attendee->blacklist_trigger)) ?></small>
      <? } ?> 
    <? }else{ ?>
      MANUAL
    <? } ?>
  </h4>
  <p><?=nl2br($form->attendee->blacklist_message) ?></p>
  <? if(!array_key_exists("blacklisted", $form->params)){ ?>
    <div class="checkbox">
      <label>
        <input type="checkbox" name="blacklisted" value="0"> This is a mistake.
      </label>
    </div>
  <? } ?>
</div>
<? } ?>