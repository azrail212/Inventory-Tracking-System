<?php
require_once dirname(__FILE__)."/../config.php";

class MainDao {
  protected $connection;
  private $table;
  //connecting to server
  public function __construct($table){
    $this->table=$table;
    try{
      $this->connection = new PDO("mysql:host=".Config::DB_HOST.";dbname=".Config::DB_SCHEME, Config::DB_USERNAME, Config::DB_PASSWORD);
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Connected";
    }
    catch(PDOException $e) {
    throw $e;
    }
  }
  //returns a maximum of 25 record from the table currently in focus
  public function getAll($offset=0, $limit=25){
    return $this->query("SELECT * FROM".$this->table." LIMIT ${limit} OFFSET {$offset}",[]);
  }
//inserts wanted values for an entity into a specified table
  protected function insertIntoTable($table,$entity){
    $query="INSERT INTO ${table} (";
    //looping through columns in a row/entity
    foreach($entity as $column => $value){
      $query .=$column.",";
    }
    $query = substr($query, 0, -2);
    $query.=") VALUES (";
    //looping again, appending values to the query 
    foreach($entity as $column=>$value){
      $query.=":".$column.", ";
    }
    $query = substr($query, 0, -2);
    $query.=")";//closing query

    //prepare connection to execute $query
    $stmt=$this->connection->prepare($query);
    $stmt->execute($entity); //execution and injection prevention
    $entity['id']=$this->connection->lastInsertID();//returns ID of the last inserted row or sequence value
    return $entity;
  }
//allows changing existing values in a table
  protected function updateTable($table, $id, $entity, $idColumn="id"){
    $query= "UPDATE ${$table} SET ";
    foreach($entity as $name=>$value){
      $query.= $name ."= :". $name. ", ";
    }
    $query=substr($query, 0, -2);
    $query .= 'WHERE ${idColumn} = :id';

    $stmt = $this->connection->prepare($query);
    $entity['id']=$id;
    $stmt->execure($entity);
  }

  protected function query($query, $parameters){
    $stmt = $this->connection->prepare($query);
    $stmt->execute($parameters);
    return $stmt->fetchAll(PDO::FETCH_ASSOC); //returns an array indexed by column name as returned in your result set
  }

  protected function queryUnique($query, $parameters){
    $results = $this->query($query, $parameters);
    return reset($results);
  }

  public function add($entity){
    return $this->insertIntoTable($this->table, $entity);
  }

  public function updateByID($id, $entity){
    $this->execute_update($this->table, $id, $entity);
  }

  public function getByID($id){
    return $this->queryUnique("SELECT * FROM " .$this->table."WHERE id = :id", ["id"=>$id]);
  }
}
?>