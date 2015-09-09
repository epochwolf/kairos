<?php 

class BlacklistForm extends BaseConfigForm{
  const MODEL = "Blacklist";

  public function validate(){
    $this->error_if_empty("type");

    if($this->params["trigger_legal_names"] && preg_match("/^\*|\*$/", $this->params["trigger_legal_names"])){
      $this->add_error("trigger_legal_names", "Trigger should not start or end with *." );
    }
    if($this->params["trigger_badge_names"] && preg_match("/^\*|\*$/", $this->params["trigger_badge_names"])){
      $this->add_error("trigger_badge_names", "Trigger should not start or end with *." );
    }
  }
}