<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__)."/dao/BaseDao.class.php";
require_once dirname(__FILE__)."/dao/UserDao.class.php";
require dirname(__FILE__)."/../vendor/autoload.php";

Flight::register('userDao','UserDao');

Flight::route('GET /users', function(){
    Flight::json(Flight::userDao()->getAll(0,10));
});

Flight::route('GET /users/@id', function($id){
    Flight::json(Flight::userDao()->getByID($id));
});

Flight::route('POST /users', function(){
    $request = Flight::request()->data->getData();
    Flight::json(Flight::userDao()->add($data));
});

Flight::route('PUT /users/@id', function($id){
    $request = Flight::request();
    $data = $request->data->getData();
    Flight::userDao()->update($id, $data);
    $user = Flight::userDao()->getByID($id);
    Flight::json($user);
    
});

Flight::start();

?>
