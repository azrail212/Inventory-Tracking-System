<?php

Flight::route('GET /users', function(){

    $offset = Flight::query('offset',0);
   
    $limit = Flight::query('limit',100);
    
    $search = FLight ::query('search');
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

?>