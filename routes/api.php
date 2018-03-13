<?php

$this->group(['prefix' => 'v1' ], function (){

    $this->post('auth', 'Auth\AuthApiController@authenticate');

    $this->group(['middleware' => 'jwt.auth'], function (){
        $this->post('products/search', 'Api\V1\ProductController@search');
        $this->resource('products', 'Api\V1\ProductController', ['except' => ['create', 'edit']]);
    });
});

