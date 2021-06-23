<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class UserDao extends BaseDao{

    public function __construct(){
        parent::__construct("users");
    }

    public function get_user_by_name($username){
        return $this->query_unique("SELECT * FROM users WHERE username=:username", ["username"=>$username]);
    }

    public function update_user_by_name($username, $user){
        $this->update('users', $username, $user, 'username');
    }

    public function get_user_by_token($token){
        return $this->query_unique("SELECT * FROM users WHERE
            token = :token",
                ["token" => $token]);
      }

}
?>
