<?php

declare(strict_types=1);

namespace Fiko\UnitTesting\Test\Api;

use Magento\Framework\Webapi\Rest\Request;
use Magento\TestFramework\TestCase\WebapiAbstract;

class A1Test extends WebapiAbstract
{
    public function testAuth(): void
    {
        $user = 'fikocustomer+1@yopmail.com';
        $pass = 'Password123';
        $serviceInfo = [
            'rest' => [
                'resourcePath' => '/V1/integration/customer/token',
                'httpMethod' => Request::HTTP_METHOD_POST,
            ],
            // 'soap' => [
            //     'service' => 'testModule1AllSoapAndRestV1',
            //     'operation' => 'testModule1AllSoapAndRestV1Item',
            // ],
        ];
        $requestData = [
            'username' => $user,
            'password' => $pass,
        ];
        $item = $this->_webApiCall($serviceInfo, $requestData);
        $this->assertEquals(32, strlen($item), 'Wrong authentication');
    }
}
