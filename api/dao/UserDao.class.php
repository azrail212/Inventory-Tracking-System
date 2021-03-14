<?php
require_once dirname(__FILE__)."/MainDao.class.php";

class UserDao extends MainDao{

    public function getUserByID($userID){
        return $this->queryUnique("SELECT * FROM Users WHERE userID= :id", ["id"=>$userID]);
    }

    public function getUserByName($name){
        return $this->queryUnique("SELECT * FROM Users WHERE userName=:name". ["userName"=>$name]);
    }

    public function addUser($user){
        $query = "INSERT INTO Users (userName, userPassword, userStatus, userPermissions) VALUES (:userName, :userPassword, :userStatus, :userPermissions)";
        
        //connection to server, execution of sql
        $stmt = $this->connection->prepare($query);
        $stmt->execute($user);
        $user['id']= $this->connection->lastInsertId();
        return $user;
    }

    public function changeUserCredentials($userName, $userPassword){

        $query= "UPDATE Users SET userName = :name, userPassword=:password WHERE userName= :name";
        $stmt = $this->connection->prepare($query);
        $userName['name']= $userName;
        $stmt->execute($userName);
    }

}
?>

  