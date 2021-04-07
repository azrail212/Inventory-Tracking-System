<?php
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

?>