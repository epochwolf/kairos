<?php 

class BaseModel{
  # These need to be overridden
  const TABLE_NAME = "blacklist";
  const DISPLAY_NAME = "Base Model";
  const FIELDS = [];
  const JOIN_FIELDS = [];
  const PROTECTED_FIELDS = [];

  function __construct($row=[]){
    foreach(static::FIELDS as $field){
      $this->{$field} = @$row[$field];
    }
    foreach(static::JOIN_FIELDS as $field){
      $this->{$field} = @$row[$field];
    }
  }

  function display_name(){
    if(in_array("name", static::FIELDS)){
      return $this->name;
    }else{
      return get_called_class()."(ID={$this->id})";
    }
  }

  function attributes(){
    $array = [];
    foreach(static::FIELDS as $field){
      $array[$field] = $this->{$field};
    }
    return $array;
  }

  function export_to_db(){
    $array = [];
    foreach(static::FIELDS as $field){
      $array[$field] = $this->{$field};
    }
    return $array;
  }

  # CACHED METHODS
  # These are used to work with an entire table in memory. 
  # It's a simple way to avoid the n+1 query problem. 
  protected static $_cache = false;

  # Loads the entire table into memory. 
  static function cached_all(){
    return static::get_cache();
  }

  protected static function get_cache(){
    static::init_cache();

    if(empty(static::$_cache)){
      static::$_cache = static::all();
    }
    return static::$_cache;
  }

  protected static function clear_cache(){
    static::$_cache = [];
  }

  # Workaround to define a separate static property for each child class. 
  protected static function init_cache(){
    if(static::$_cache === false){ 
      $tmp = [];
      static::$_cache =& $tmp;
      unset($tmp);
    }
  }

  # QUERIES

  static function all(){
    return self::query("SELECT * FROM " . static::TABLE_NAME);
  }

  static function count(){
    $results = db_query("SELECT count(*) as row_count FROM " . static::TABLE_NAME);
    return @$results[0]["row_count"];
  }

  static function max($field){
    $results = db_query("SELECT max($field) as row_max FROM " . static::TABLE_NAME);
    return @$results[0]["row_max"] ?: 0;
  }

  static function find($id){
    return self::query_first("SELECT * FROM " . static::TABLE_NAME . " WHERE id = ? LIMIT 1", [$id]);
  }

  static function query($query, $params=null){
    global $db;
    $map_func = function($row){ return new static($row); };

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

  public function is_new_record(){
    return $this->id ? false : true;
  }

  public function save(){
    $result = $this->save_without_callbacks();
    if($this->is_new_record()){
      $this->after_create();
    }else{
      $this->after_update();
    }
    $this->after_save();
    return $result;
  }

  public function save_without_callbacks(){
    if($this->is_new_record()){
      $result = $this->create();
    }else{
      $result = $this->update();
    }
    return $result;
  }

  public function delete(){

    if(!$this->is_new_record()){
      $sql = db_prepared_delete_sql(static::TABLE_NAME, "id = ?");

      global $db;
      $stmt = $db->prepare($sql);
      $stmt->execute([$this->id]);
      return true;
    }
  }

  private function create(){
    $attributes = $this->export_to_db();
    $fields = array_keys($attributes);
    $values = array_values($attributes);

    $sql = db_prepared_insert_sql(static::TABLE_NAME, $fields);

    global $db;
    $stmt = $db->prepare($sql);
    $stmt->execute($values);
    $this->id = $db->lastInsertId();
    return true;
  }

  private function update(){
    $attributes = $this->export_to_db();

    $attributes = array_diff_key($attributes, array_flip(static::PROTECTED_FIELDS));

    $fields = array_keys($attributes);
    $values = array_values($attributes);

    $sql = db_prepared_update_sql(static::TABLE_NAME, $fields, "id={$this->id}");

    global $db;
    $stmt = $db->prepare($sql);
    $stmt->execute($values);
    return true;
  }

}