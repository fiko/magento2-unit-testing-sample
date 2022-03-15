<?php

declare(strict_types=1);

namespace Fiko\UnitTesting\Test\Unit;

use Fiko\UnitTesting\Helper\Data as FikoHelper;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use PHPUnit\Framework\TestCase;

class U2Test extends TestCase
{
    protected $helper;

    /**
     * {@inheritdoc}
     */
    public function setUp(): void
    {
        // parent::setUp();

        $om = new ObjectManager($this);

        $this->helper = $om->getObject(FikoHelper::class);
        // $helper->expects($this->any())->method('getName')->willReturn('yes');
    }

    public function testConnection(): void
    {
        $conn = $this->helper->getName();
        // $query = 'SELECT * FROM sales_order';
        $tmp = $conn;

        // $tmp = $conn->query($query)->fetchAll();
        print_r(json_encode(is_object($tmp) ? get_class_methods($tmp) : $tmp));
    }
}
