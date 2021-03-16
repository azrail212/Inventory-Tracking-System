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
    
}
?>
