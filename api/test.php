<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

require_once dirname(__FILE__)."/dao/UserDao.class.php";
require_once dirname(__FILE__)."/dao/BranchOfficesDao.class.php";
require_once dirname(__FILE__)."/dao/LocationsDao.class.php";
require_once dirname(__FILE__)."/dao/OrdersDao.class.php";



/*$dao = new BranchOfficesDao();
$testOffice = [
    'branchOfficeName' => 'Envera Sehovica 1a',
    'branchOfficeCEOID' => 1,
    'branchOfficeLocationID'=>1
    ];

$results = $dao->getAll();
print_r($results);

$dao = new UserDao();
$testUser = [
    'userName' => 'Enver Sehovic',
    'userPassword' => '123456',
    'userStatus'=>'active',
    'userPermissions'=>'all'
    ];

$user=$dao->getByID(3);

print_r($user);
$dao=new LocationsDao();
$dao=$dao->getAll();
print_r($dao);*/
$dao=new OrdersDao();
$test=$dao->deleteOrder(2);
print_r($test);

?>
