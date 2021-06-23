<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class OrdersDao extends BaseDao{
    public function __construct(){
        parent::__construct("orders");
    }

    /*public function deleteOrder($id){
        $query = "DELETE FROM Orders WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->execute(['id'=>$id]);
    }*/
}
?>
