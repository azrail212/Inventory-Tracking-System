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

    public function changeUserCredentials($userID, $user){
        $query = 'UPDATE Users SET ';
        foreach($user as $name => $value){
            $query.= $name .'= :'. $name. ', ';
        }
        
        $query=substr($query, 0, -2);
        $query .= ' WHERE userID=:userID';
       
        $stmt = $this->connection->prepare($query);
        $user['userID']= $userID;
        $stmt->execute($user);
    }

}
?>

  