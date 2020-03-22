<?php

namespace Tests\AppBundle\Controller\Api;

use AppBundle\Controller\Api\ProgrammerController;

class ProgrammerControllerTest extends \PHPUnit\Framework\TestCase
{
    public function testPOST()
    {
        $client = new \GuzzleHttp\Client([
//    'base_url' => "http://localhost:8883",
            'defaults' => [
                'exceptions'=>false
            ]
        ]);

        $nickname = "ObjectOrienter" . rand(0,999);
        $data = [
            'nickname'=>$nickname,
            'avatarNumber'=>1
        ];


        $response = $client->post('http://localhost:8883/app_dev.php/api/programmers',[
            "body" => json_encode($data),
        ]);
        $this->assertEquals(201, $response->getStatusCode());
        $this->assertTrue($response->hasHeader('Location'));

        $finishedData = json_decode($response->getBody(), true);
        echo $response->getBody();
        $this->assertArrayHasKey('nickname', $finishedData);


    }
}
