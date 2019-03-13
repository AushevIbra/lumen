<?php

use Illuminate\Http\Request;


$router->get('/', [
    'as' => 'index',
    'uses' => 'ExampleController@index'
]);
$router->get('parse', [
    'as' => 'parse',
    'uses' => "ExampleController@parse"
]);
