<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require dirname(__FILE__)."/../vendor/autoload.php";
require_once dirname(__FILE__)."/services/UserService.class.php";
require_once dirname(__FILE__)."/services/AccountService.class.php";

Flight::set('flight.log_errors', TRUE);

FLight::map('query', function($name, $default_value = NULL){
    $request = Flight::request();
    $query_param =  @$request->query->getData()[$name];
    $query_param =  $query_param ?  $query_param : $default_value;
    return $query_param;
});

/*register business logic layer services*/
Flight::register('userService','UserService');
Flight::register('accountService','AccountService');

/*include all routes*/
require_once dirname(__FILE__)."/routes/users.php";
require_once dirname(__FILE__)."/routes/accounts.php";
Flight::start();

?>
