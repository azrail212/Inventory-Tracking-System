<?php

require_once dirname(__FILE__)."/../dao/UserDao.class.php";

class UserService{

    public function __construct(){
        $this->dao = new UserDao();
    }
    
    public function getUsers($search, $offset, $limit){
        if ($search){
            return($this->dao->getUsers($search, $offset, $limit));
        }else{
            return($this->dao->getAll($offset,$limit));
        }
    }
}
?>