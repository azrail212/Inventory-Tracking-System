<?php
require_once dirname(__FILE__)."/MainDao.class.php";

class UserDao extends MainDao{

    public function getUserByID($userID){
        return $this->queryUnique("SELECT * FROM Users WHERE userID= :id", ["id"=>$userID]);
    }

    public function getUserByName($name){
        return $this->queryUnique("SELECT * FROM Users WHERE userName=:name". ["userName"=>$name]);
    }

}
?>

  