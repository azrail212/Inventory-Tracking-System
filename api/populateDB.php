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
require_once dirname(__FILE__)."/resources.php";

$resources= new Resources();
echo 'Im ok';
/*$dao= new StorageSpacesDao();
for ($i=0;$i<100;$i++){
$storageSpaceAdd=[
    'storageSpaceCapacity'=> rand(10, 200).'m2',
    'storageSpaceBranchOfficeID'=>rand(1,100)
];
$dao->add($storageSpaceAdd);
}*/

/*$dao=new LocationsDao();
for ($i=0;$i<200;$i++){
    $locationAdd=[
        'locationAddress'=> $resources->randomString(10).' '.rand(1,100),
        'locationCity'=>$resources->cities(),
        'locationCountry'=>'BiH',
        'locationZipcode' => bin2hex(random_bytes(3))
    ];
    $dao->add($locationAdd);

}*/

/*$dao = new BranchOfficesDao();
for ($i=0;$i<100;$i++){
$testOffice = [
    'branchOfficeName' => $resources->randomString(rand(5,10)),
    'branchOfficeCEOID' => rand(1,1000),
    'branchOfficeLocationID'=>rand(1,200)
    ];
    $dao->add($testOffice);
}*/

/*$dao = new UserDao();

for ($i=0;$i<1000;$i++){
$testUser = [
    'userName' => $resources->peopleNames(),
    'userPassword' => bin2hex(random_bytes(4)),
    'userStatus'=>$resources->randomStatus(),
    'userPermissions'=>$resources->randomPermission(),
    'userBranchOfficeID'=> rand(1,100)
    ];
    $dao->add($testUser);
}*/
/*$dao = new SuppliersDao();

for ($i=0;$i<50;$i++){
$testSupplier = [
    'supplierEmail' => $resources->randomString(rand(5,10)).'@'.'supplier.com',
    'supplierLocationID'=>rand(1,200),
    'supplierName'=> $resources->randomString(rand(5,10))
    ];
    $dao->add($testSupplier);
}*/

/*$dao = new OrdersDao();
for ($i=0;$i<5000;$i++){
    $testSupplier = [
        'supplierID' => rand(1,50),
        'userCreatorID'=>rand(1,1000),
        'orderCreationTime'=> date("Y-m-d h:m:s"),
        'storageSpaceID'=>rand(1,100),
        'orderStatus'=>array_rand(array_flip(array("active","cancelled","waiting")))
        ];
        $dao->add($testSupplier);
    }*/
?>
