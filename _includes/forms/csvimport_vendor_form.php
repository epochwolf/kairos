<?php 

class CSVImportVendorForm extends BaseForm{

  const VALID_FIELDS = [
    "id",
    "name",
    "assigned_tables",
    "vendor_license_number",
    "notes",
  ];

  function __construct($params=[]){
    $clean_params = array_intersect_key($params, array_flip(static::VALID_FIELDS));
    parent::__construct($clean_params);
  }

  public function validate(){
    $this->error_if_empty("id");
    $this->error_if_empty("name");

    if(@$this->params["id"]){
      if(Vendor::find($this->params["id"])){
        $this->add_error("id", "Number is already assigned.");
      }
    }

  }

  function save(){
    if($this->valid()){
      $attendee = new Vendor($this->params);
      return $attendee->create_with_id();
    }else{
      return false;
    }
  }
}