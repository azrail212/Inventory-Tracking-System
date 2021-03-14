<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

require_once dirname(__FILE__)."/dao/UserDao.class.php";

$userDao = new UserDao(); //creating userdao class object

//$getUserByName=$userDao->getUserByName('Azrail2122');
//print_r($getUserByName);

$user=$userDao->getUserByID(1);
//print_r($user);

$testAddUser = [
    'userName'=>'Dino Keco',
    'userPassword'=>'root123',
    'userActive'=>true,
    'userPermissions'=>'admin'];

    $user=$userDao->addUser($testAddUser);
    print_r($user);
?>