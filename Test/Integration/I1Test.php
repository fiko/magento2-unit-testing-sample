<?php

declare(strict_types=1);

namespace Fiko\UnitTesting\Test\Integration;

use Magento\Framework\App\ResourceConnection;
use Magento\TestFramework\Helper\Bootstrap;
use PHPUnit\Framework\TestCase;

class I1Test extends TestCase
{
    protected $resourceConnection;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->resourceConnection = Bootstrap::getObjectManager()->get(ResourceConnection::class);
    }

    public function testConnection(): void
    {
        $conn = $this->resourceConnection->getConnection();
        $query = 'SELECT * FROM sales_order limit 1';

        // $conn->query($conn)

        $tmp = $conn->query($query)->fetchAll();
        echo(json_encode(is_object($tmp) ? get_class_methods($tmp) : $tmp));
    }
}
