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

  public function begin_transaction(){
    $this->connection->begin_transaction();
  }

  public function commit(){
    $this->connection->commit();
  }

  public function rollback(){
    $this->connection->rollback();
    //$this->connection->setAttribute(PDO::ATTR_AUTOCOMMIT, 1);
  }

  public function parse_order($order){
    switch(substr($order, 0, 1)){
      case '-': $order_direction = "ASC";break;
      case '+':$order_direction = "DESC";break;
      default:throw new Exception("Invalid order format. First character should be either + or -"); break;
    };

    $order_column = substr($order, 1);

    return [$order_column, $order_direction];
  }

  //inserts wanted values for an entity into a specified table
  protected function insert($table, $entity){
    $query="INSERT INTO ${table} (";

    foreach($entity as $column => $value){
      $query .= $column.", ";
    }

    $query = substr($query, 0, -2);
    $query.=") VALUES (";


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
  protected function execute_update($table, $id, $entity, $idcolumn='id'){
    $query= "UPDATE ${table} SET ";

    foreach($entity as $name=>$value){
      $query.= $name ."= :". $name. ", ";
    }

    $query=substr($query, 0, -2);
    $query .= " WHERE ${idcolumn} = :id";

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

  protected function query_unique($query, $parameters){
    $results = $this->query($query, $parameters);
    return reset($results);
  }

  public function add($entity){
    return $this->insert($this->table, $entity);
  }

  public function update($id, $entity){
    $this->execute_update($this->table, $id, $entity);
  }

  public function get_all($offset=0, $limit=25, $order = "-id"){
    list($order_column, $order_direction) = self::parse_order($order);

    $order_column = substr($order,1);
    return $this->query("SELECT *
                        FROM ".$this->table."
                        ORDER BY ${order_column} ${order_direction}
                        LIMIT ${limit} OFFSET ${offset}",[]);
  }

  public function get_by_id($id){
    return $this->query_unique("SELECT * FROM " .$this->table." WHERE id = :id", ["id"=>$id]);
  }
}
?>
