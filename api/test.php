<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

require_once dirname(__FILE__)."/dao/UserDao.class.php";

$userDao = new UserDao('Users'); //creating userdao class object

$user=$userDao->getUserByID(3);

echo($user);
?>