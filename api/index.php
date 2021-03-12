<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__)."/dao/MainDao.class.php";
require_once dirname(__FILE__)."/dao/UsersDao.class.php";

$mainDaoSetup = new MainDao();
echo "Hello from API";
$myUser;
echo $myUser->getUserByID();
?>


