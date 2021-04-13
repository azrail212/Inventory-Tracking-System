<?php

require_once dirname(__FILE__)."/../dao/UserDao.class.php";
require_once dirname(__FILE__)."/BaseService.class.php";
require_once dirname(__FILE__)."/../dao/BranchOfficesDao.class.php";

class UserService extends BaseService{
    private $officeDao;

    public function __construct(){
        $this->dao = new UserDao();
        $this->officeDao = new BranchOfficesDao();
    }
    
    public function getUsers($search, $offset, $limit){
        if ($search){
            return($this->dao->getUsersBySearch($search, $offset, $limit));
        }else{
            return($this->dao->getAll($offset,$limit));
        }
    }

    public function add($user){
        return parent::add($user);
    }

    /* only allow registration if admin is doing it*/
    public function register($user){
        if(!isset($user['userName'])) 
            throw new Exception ('Username not set.');
        if(!isset($user['userPassword'])) 
            throw new Exception ('Password not set.');
        if($this->officeDao->getByID($user['userBranchOfficeID']) == NULL) 
            throw new Exception ('That Branch office does not exist.');

        $user = ([
            "userName" => $user['userName'],
            "userPassword"=> $user["userPassword"],
            "userStatus"=> 'PENDING',
            "userPermissions"=>$user["userPermissions"],
            "userBranchOfficeID"=>$user["userBranchOfficeID"],
            "userConfirmationToken" => md5(random_bytes(16))
        ]);

        return parent::add($user);
    }

    public function confirm($token){
        $user = $this->dao->getUserByToken($token);
    
        if (!isset($user['id'])) 
            throw new Exception("Invalid token");
    
        $this->dao->update($user['id'], ["userStatus" => "ACTIVE"]);
    
    }
}
?>