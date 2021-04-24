<?php

Flight::route('GET /users', function(){

    $offset = Flight::query('offset',0);
    $limit = Flight::query('limit',25);
    
    $search = FLight ::query('search');

    $order = FLight ::query('order', "-id");

    Flight::json(Flight::UserService()->getUsers($search, $offset, $limit, $order));

});

Flight::route('GET /users/@id', function($id){    
    Flight::json(Flight::UserService()->getByID($id));
});

Flight::route('POST /users', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::UserService()->add($data));
});

Flight::route('POST /register', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::UserService()->register($data));
});

Flight::route('GET /users/confirm/@token', function($token){
    Flight::UserService()->confirm($token);
    Flight::json(["message" => "The user has been successfully activated."]);
  });

Flight::route('PUT /users/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::UserService()->update($id, $data));
});



?>