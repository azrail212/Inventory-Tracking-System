<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

require_once dirname(__FILE__)."/dao/UserDao.class.php";

$userDao = new UserDao(); //creating userdao class object

//$getUserByName=$userDao->getUserByName('Azrail2122');
//print_r($getUserByName);

//print_r($user);

$testUser = [
    'userName'=>'Frederik Henson',
    'userPassword'=>'fredoHans',
    'userStatus'=>'BLOCKED',
    'userPermissions'=>'basic',
    'userBranchOfficeID'=>2
    ];

$user=$userDao->addUser($testUser);
print_r($user);
?>