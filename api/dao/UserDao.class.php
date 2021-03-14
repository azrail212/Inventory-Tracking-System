<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class UserDao extends BaseDao{

    public function getUserByID($userID){
        return $this->queryUnique("SELECT * FROM Users WHERE userID= :id", ["id"=>$userID]);
    }

    public function getUserByName($name){
        return $this->queryUnique("SELECT * FROM Users WHERE userName=:userName", ["userName"=>$name]);
    }

    public function addUser($user){
        $query = "INSERT INTO Users (userName, userPassword, userActive, userPermissions) VALUES (:userName, :userPassword, :userActive, :userPermissions)";
        
        //connection to server, execution of sql
        $stmt = $this->connection->prepare($query);
        $stmt->execute($user);
    }

    public function changeUserCredentials($userName, $userPassword){

        $query= "UPDATE Users SET userPassword=:password WHERE userName= :name";
        $stmt = $this->connection->prepare($query);
        $userName['name']= $userName;
        $stmt->execute($userName);
    }

}
?>

  