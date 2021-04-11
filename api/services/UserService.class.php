<?php

require_once dirname(__FILE__)."/../dao/UserDao.class.php";
require_once dirname(__FILE__)."/BaseService.class.php";

class UserService extends BaseService{

    public function __construct(){
        $this->dao = new UserDao();
    }
    
    public function getUsers($search, $offset, $limit){
        if ($search){
            return($this->dao->getUsersBySearch($search, $offset, $limit));
        }else{
            return($this->dao->getAll($offset,$limit));
        }
    }

    public function add($user){
        if(!isset($user['userName'])) throw new Exception ('Username not valid.');

        return parent::add($user);
    }
}
?>