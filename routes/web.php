<?php

use Illuminate\Http\Request;

$router->get('/', function () {
    //$data = date("Y.m.d", strtotime("12.12.19"));
    //var_dump($data);die;
    $data = json_decode(file_get_contents("https://www.sberbank.ru/portalserver/proxy/?pipe=shortCachePipe&url=http%3A%2F%2Flocalhost%2Fsbt-services%2Fservices%2Frest%2Fast%2FgetPurchaseOpen/47253"));
    dd($data);

});
