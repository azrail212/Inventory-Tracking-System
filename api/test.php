<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

require_once dirname(__FILE__)."/dao/UserDao.class.php";
require_once dirname(__FILE__)."/dao/BranchOfficesDao.class.php";
require_once dirname(__FILE__)."/dao/LocationsDao.class.php";
require_once dirname(__FILE__)."/dao/OrdersDao.class.php";
require_once dirname(__FILE__)."/dao/StorageSpacesDao.class.php";
require_once dirname(__FILE__)."/dao/SuppliersDao.class.php";
require_once dirname(__FILE__)."/dao/AccountDao.class.php";

echo 'Im OK';
$dao= new UserDao();
$bDao = new BaseDao();

$user=[
  "name"="Azra Becirovic",
    "email"="Azra Becirovic",
      "password"="azra",
        "account_id"= 3
];
$user = $dao->add($user);

?>
