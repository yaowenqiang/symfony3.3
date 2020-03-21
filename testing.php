<?php

include __DIR__ . "/vendor/autoload.php";

$client = new \GuzzleHttp\Client([
//    'base_url' => "http://localhost:8883",
    'defaults' => [
        'exceptions'=>false
    ]
]);


$nickname = "ObjectOrienter" . rand(0,999);
$data = [
    'nickname'=>$nickname
];


$response = $client->post('http://localhost:8883/app_dev.php/api/programmers',[
    "body" => json_encode($data),
]);

echo $response->getBody();
