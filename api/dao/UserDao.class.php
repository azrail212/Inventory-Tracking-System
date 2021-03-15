<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class UserDao extends BaseDao{

    public function getUserByID($userID){
        return $this->queryUnique("SELECT * FROM Users WHERE userID= :id", ["id"=>$userID]);
    }

    public function getUserByName($name){
        return $this->queryUnique("SELECT * FROM Users WHERE userName=:userName", ["userName"=>$name]);
    }
    
    //when adding user to db, this will add to db and present him back to us
    public function addUser($user){
        $query = "INSERT INTO Users (userName, userPassword, userStatus, userPermissions, userBranchOfficeID) VALUES (:userName, :userPassword, :userStatus, :userPermissions, :userBranchOfficeID)";
        //connection to server, execution of sql
        $stmt = $this->connection->prepare($query);
        $stmt->execute($user);
        $user['userID']=$this->connection->lastInsertId();
        return $user; 
    }

    public function updateUser($userID, $user){
        $this->update('Users', $userID, $user);
    }

    public function updateUserByName($userName, $user){
        $this->update('Users', $userName, $user, 'userName');
    }

}
?>

  