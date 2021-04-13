<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class UserDao extends BaseDao{

    public function __construct(){
        parent::__construct("Users");
    }

    public function getUserByName($name){
        return $this->queryUnique("SELECT * FROM Users WHERE userName=:userName", ["userName"=>$name]);
    }

    public function updateUserByName($userName, $user){
        $this->executeUpdate('Users', $userName, $user, 'userName');
    }

    public function getUsersBySearch($search, $offset, $limit){
        return $this->query("SELECT * FROM Users 
            WHERE LOWER(userName) LIKE CONCAT('%', :name , '%') 
                LIMIT ${limit} OFFSET ${offset}", ["name" => strtolower($search)]);
    }

    public function getUserByToken($token){
        return $this->queryUnique("SELECT * FROM Users WHERE 
            userConfirmationToken = :userConfirmationToken", 
                ["userConfirmationToken" => $token]);
      }
    
}
?>
