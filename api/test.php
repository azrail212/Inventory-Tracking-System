<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

require_once dirname(__FILE__)."/dao/UserDao.class.php";

$userDao = new UserDao('Users'); //creating userdao class object

$user=$userDao->getUserByID(3);

print_r($user);

$testUser = [
    'userName'=>'Azrail2122',
    'userPassword'=>'sifra123',
    'userStatus'=>true,
    'userPermissions'=>'admin'];

    $user=$userDao->addUser($testUser);
    print_r($user);
?>