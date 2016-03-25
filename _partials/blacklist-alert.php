<? if($form->attendee->blacklisted){ 
  $blacklist_type = BlacklistType::find_by_db_name($form->attendee->blacklist_type);
  $blacklist = $form->attendee->blacklist();
?>
<div class="alert <?=$blacklist_type->alert_color ? "alert-{$blacklist_type->alert_color}" : "" ?>" role="alert">

  <p class="lead">
    <strong><?=$blacklist_type->alert_title ?>:</strong> 
    <?=nl2br($form->attendee->blacklist_message) ?>
  </p>

  <? if($blacklist){ ?>
    <p> 
      Automatic match:
      <code><?=$blacklist->display_name() ?></code>
      <? if($form->attendee->blacklist_trigger){ ?>
        on <?=implode(" ≈ ", explode(":", $form->attendee->blacklist_trigger)) ?>
      <? } ?> 
    </p>  
    <? if(!array_key_exists("blacklisted", $form->params)){ ?>
      <div class="checkbox">
        <label>
          <input type="checkbox" name="blacklisted" value="0"> <small>This is a mistake.</small>
        </label>
      </div>
    <? } ?>
  <? }else{ ?>
    <p>Added by administrator.</p>
  <? } ?>
  <? if($blacklist_type->security_required){ ?>
    <p><strong><?=BlacklistType::SECURITY_NOTICE ?></strong></p>
  <? } ?>
</div>
<? }elseif($form->attendee->canceled){ ?>
<div class="alert alert-black" role="alert">
  <p class="lead">
    <? if($form->attendee->paid){ ?>
      Badge Revoked
    <? }else{ ?>
      Order Canceled
    <? } ?>
  </p>
</div>
<? } ?>