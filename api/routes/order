<?php

Flight::route('GET /users', function(){

    $offset = Flight::query('offset',0);
    $limit = Flight::query('limit',10);
    
    $search = FLight ::query('search');

    Flight::json(Flight::UserService()->getUsers($search, $offset, $limit));

});

Flight::route('GET /users/@id', function($id){    
    Flight::json(Flight::UserService()->getByID($id));
});

Flight::route('POST /users', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::UserService()->add($data));
});

Flight::route('PUT /users/@id', function($id){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::UserService()->update($id, $data));
});

?>