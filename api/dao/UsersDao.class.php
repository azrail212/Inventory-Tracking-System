<?php
class UsersDao extends MainDao{
    private $table = '`Users`';

    public function getUserByID($userID){
        $userID;
        $userByIDQuery = parent::query('SELECT * FROM' .$this->table .'WHERE userID='.$this->userID )->fetch_object();
        return $userByIDQuery;
        

$myUser = $user->getById(1);
echo $myUser->name;
    }

}
?>

  