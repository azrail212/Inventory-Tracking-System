<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require dirname(__FILE__)."/../vendor/autoload.php";
require_once dirname(__FILE__)."/services/UserService.class.php";

FLight::map('query', function($name, $defaultValue = NULL){
    $request = Flight::request();
    $queryParam =  @$request->query->getData()[$name];
    $queryParam =  $queryParam ?  $queryParam : $defaultValue;
    return $queryParam;
});

/*register business logic layer services*/
Flight::register('UserService','userservice');

/*include all routes*/
require_once dirname(__FILE__)."/routes/users.php";

Flight::start();

?>
