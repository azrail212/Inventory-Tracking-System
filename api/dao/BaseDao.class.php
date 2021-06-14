<?php
require_once dirname(__FILE__)."/../config.php";

class BaseDao {

  private $table;

  //connecting to server
  public function __construct($table){
    $this->table=$table;

    try{
      $this->connection = new PDO("mysql:host=".Config::DB_HOST.";dbname=".Config::DB_SCHEME, Config::DB_USERNAME, Config::DB_PASSWORD);
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->connection->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);
    }
    catch(PDOException $e) {
      throw $e;
    }
  }

  public function beginTransaction(){
    $this->connection->beginTransaction();
  }

  public function commit(){
    $this->connection->commit();
  }

  public function rollBack(){
    $this->connection->rollBack();
    //$this->connection->setAttribute(PDO::ATTR_AUTOCOMMIT, 1);
  }

  public static function parseOrder($order){
    switch(substr($order, 0, 1)){
      case '-': 
        $orderDirection = "ASC"; 
        break;
      case '+': 
        $orderDirection = "DESC"; 
        break;
      default: 
        throw new Exception("Invalid order format. First character should be either + or -"); 
        break;
    };

    $orderColumn = substr($order, 1);
   
    return [$orderColumn, $orderDirection];
  }


  
  //inserts wanted values for an entity into a specified table
  protected function insert($table, $entity){
    $query="INSERT INTO ${table} (";

    //looping through columns in a row/entity
    foreach($entity as $column => $value){
      $query .= $column.", ";
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
    $entity['id']=$this->connection->lastInsertID(); //returns ID of the last inserted row or sequence value
    return $entity;
  }
  
  //allows changing existing values in any table
  protected function executeUpdate($table, $id, $entity, $idColumn='id'){
    $query= "UPDATE ${table} SET ";

    foreach($entity as $name=>$value){
      $query.= $name ."= :". $name. ", ";
    }

    $query=substr($query, 0, -2);
    $query .= " WHERE ${idColumn} = :id";

    $stmt = $this->connection->prepare($query);
    $entity['id']=$id;
    $stmt->execute($entity);
  }

  //this can execute any kind of query on the database
  protected function query($query, $parameters){
    $stmt = $this->connection->prepare($query);
    $stmt->execute($parameters); //executes query using parameters we passed
    return $stmt->fetchAll(PDO::FETCH_ASSOC); //returns an array indexed by column name as returned in your result set
  }

  protected function queryUnique($query, $parameters){
    $results = $this->query($query, $parameters);
    return reset($results);
  }

  public function add($entity){
    return $this->insert($this->table, $entity);
  }

  public function update($id, $entity){
    $this->executeUpdate($this->table, $id, $entity);
  }

  public function getAll($offset=0, $limit=25, $order = "-id"){
    list($orderColumn, $orderDirection) = self::parseOrder($order);

    return $this->query("SELECT *
                        FROM ".$this->table."
                        ORDER BY ${orderColumn} ${orderDirection}
                        LIMIT ${limit} OFFSET ${offset}", []);
  }

  public function getByID($id){
    return $this->queryUnique("SELECT * FROM " .$this->table." WHERE id = :id", ["id"=>$id]);
  }
}
?>