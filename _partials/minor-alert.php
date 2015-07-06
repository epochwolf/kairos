<? if($form->attendee->minor()){ ?>
<div class="alert alert-info" role="alert">
  <h4>
    Minor: <?= $form->attendee->age(); ?> Years Old 
  </h4>
  <p><strong>Responsible Adult:</strong>
    <?=$form->attendee->adult_badge_name ?> / <?=$form->attendee->adult_legal_name ?>
  </p>
  <? if($form->attendee->age() < 13){ ?>
    <p>Minor is under thirteen. Must be escorted at <u>all</u> times. Badge is free.</p>
  <? } ?>
</div>
<? } ?>