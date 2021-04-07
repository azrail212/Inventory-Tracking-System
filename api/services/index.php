<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__)."/../dao/BaseDao.class.php";
require_once dirname(__FILE__)."/../dao/UserDao.class.php";
require dirname(__FILE__)."/../../vendor/autoload.php";
require_once dirname(__FILE__)."/../services/UserService.class.php";

FLight ::map('query', function($name, $default_value = NULL){
    $request = Flight::request();
    $query_param =  @$request->query->getData()[$name];
    $query_param =  $query_param ?  $query_param : $default_value;
    return $query_param;
});
/*register the dao layer*/
Flight::register('userDao','UserDao');

/*register business logic layer services*/
Flight::register('UserService','userservice');

/*include all routes*/
require_once dirname(__FILE__)."/../routes/users.php";

Flight::start();

?>
