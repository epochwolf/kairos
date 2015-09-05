<?php 

class BaseModel{

  # These need to be overridden
  const TABLE_NAME = "blacklist";
  const FIELDS = [];
  const JOIN_FIELDS = [];
  const PROTECTED_FIELDS = [];

  function __construct($row){
    $klass = get_called_class();
    foreach($klass::FIELDS as $field){
      $this->{$field} = @$row[$field];
    }
    foreach($klass::JOIN_FIELDS as $field){
      $this->{$field} = @$row[$field];
    }
  }

  function attributes(){
    $klass = get_called_class();
    $array = [];
    foreach($klass::FIELDS as $field){
      $array[$field] = $this->{$field};
    }
    return $array;
  }

  function export_to_db(){
    $klass = get_called_class();
    $array = [];
    foreach($klass::FIELDS as $field){
      $array[$field] = $this->{$field};
    }
    return $array;
  }

  # CACHE
  protected static $_cache = [];

  protected static function get_cache(){
    $klass = get_called_class();
    if(empty($klass::$_cache)){
      $klass::$_cache = $klass::all();
    }
    return $klass::$_cache;
  }

  # QUERIES

  static function all(){
    $klass = get_called_class();
    return self::query("SELECT * FROM " . $klass::TABLE_NAME);
  }

  static function count(){
    $klass = get_called_class();
    $results = db_query("SELECT count(*) as row_count FROM " . $klass::TABLE_NAME);
    return @$results[0]["row_count"];
  }

  static function find($id){
    $klass = get_called_class();
    return self::query_first("SELECT * FROM " . $klass::TABLE_NAME . " WHERE id = ? LIMIT 1", [$id]);
  }

  static function query($query, $params=null){
    global $db;
    $map_func = function($row){ $klass = get_called_class(); return new $klass($row); };

    $result = db_query($query, $params);
    return array_map($map_func, $result);
  }

  static function query_first($query, $array=null){
    $results = self::query($query, $array);
    return @$results[0];
  }

  ## HELPER METHODS

  protected static function phone_to_ui($phone_number){
    return preg_replace("/^(\d{3})(\d{3})(\d{4})(\d*)/", "(\\1) \\2-\\3 \\4", $phone_number); 
  }

  protected static function phone_to_db($phone_number){
    return preg_replace("/[^\d]*/", "", $phone_number);
  }

  // Converts blank strings to nulls
  protected static function nullable_string_to_db($string){
    $string = trim("$string");
    if($string === ""){
      return null;
    }else{
      return $string;
    }
  }

  protected static function date_to_ui($date){
    try{
      $d = new DateTime($date);
      return $d->format("m/d/Y");
    } catch(Exception $e){
      return $date;
    }

  }
  protected static function date_to_db($date){
    try{
      $d = new DateTime($date);
      return $d->format("Y-m-d");
    } catch(Exception $e){
      return $date;
    }
  }

  protected static function bool_to_db($bool){
    if($bool){
      return 1;
    }else{
      return 0;
    }
  }

  ## INSTANCE 

  public $id;


  protected function after_save(){ return true; }
  protected function after_create(){ return true; }
  protected function after_update(){ return true; }

  public function save(){

    if($this->id){
      $result = $this->update();
      $this->after_update();
      $this->after_save();
      return true;
    }else{
      $result = $this->create();
      $this->after_create();
      $this->after_save();
      return ;
    }
  }

  private function create(){
    $klass = get_called_class();
    $attributes = $this->export_to_db();
    $fields = array_keys($attributes);
    $values = array_values($attributes);

    $sql = db_prepared_insert_sql($klass::TABLE_NAME, $fields);

    global $db;
    $stmt = $db->prepare($sql);
    $stmt->execute($values);
    $this->id = $db->lastInsertId();
    return true;
  }

  private function update(){
    global $db;
    $klass = get_called_class();
    $attributes = $this->export_to_db();

    $attributes = array_diff_key($attributes, array_flip($klass::PROTECTED_FIELDS));

    $fields = array_keys($attributes);
    $values = array_values($attributes);

    $sql = db_prepared_update_sql($klass::TABLE_NAME, $fields, "id=".$this->id);
    
    global $db;
    $stmt = $db->prepare($sql);
    $stmt->execute($values);
    return true;
  }

}