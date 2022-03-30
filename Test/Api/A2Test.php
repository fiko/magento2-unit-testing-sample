<?php

declare(strict_types=1);

namespace Fiko\UnitTesting\Test\Api;

use Magento\Framework\DataObject;
use Magento\TestFramework\TestCase\GraphQlAbstract;

class A2Test extends GraphQlAbstract
{
    public function testAuth(): void
    {
        $email = 'fikocustomer+1@yopmail.com';
        $password = 'Password123';
        $query = <<<QUERY
mutation {
    generateCustomerToken(
        email: "{$email}",
        password: "{$password}"
    ) {
        token
    }
}
QUERY;
        $response = $this->graphQlMutation($query);
        $data = new DataObject($response);

        $this->assertEquals(32, strlen($data->getData('generateCustomerToken/token')));
    }
}
