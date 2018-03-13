<?php

$this->group(['prefix' => 'v1'], function (){

    $this->resource('products', 'Api\V1\ProductController', ['except' => ['create', 'edit']]);
});

