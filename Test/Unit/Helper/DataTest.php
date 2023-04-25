<?php

namespace Fiko\Testing\Test\Unit\Helper;

use Fiko\Testing\Helper\Data;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use Magento\Store\Api\Data\StoreInterface;
use Magento\Store\Model\StoreManagerInterface;
use PHPUnit\Framework\TestCase;

class DataTest extends TestCase
{
    /**
     * @var ObjectManager
     */
    public $objectManager;

    /**
     * @var StoreManagerInterface
     */
    public $storeManager;

    /**
     * @var Helper
     */
    public $helper;

    /**
     * This method will be called on every test method
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->objectManager = new ObjectManager($this);
        $this->storeManager = $this->createMock(StoreManagerInterface::class);
        // or we can use this way:
        // $this->storeManager = $this->getMockBuilder(StoreManagerInterface::class)
        //     ->disableOriginalConstructor()
        //     ->onlyMethods(['getStore']) // it's optional if we want to mock getStore as well
        //     ->getMockForAbstractClass();

        $this->helper = $this->objectManager->getObject(
            Data::class,
            [
                'storeManager' => $this->storeManager
            ]
        );
    }

    /**
     * Testing to get integer for getStoreId
     *
     * @return void
     */
    public function testGetStoreId(): void
    {
        $storeMock = $this->createMock(StoreInterface::class);
        $storeMock->expects($this->once())->method('getId')->willReturn(1);
        // or we can use this way:
        // $storeMock = $this->getMockBuilder(StoreInterface::class)
        //     ->disableOriginalConstructor()
        //     ->onlyMethods(['getId'])
        //     ->getMockForAbstractClass();
        // $storeMock->expects($this->once())->method('getId')->willReturn(1);

        $this->storeManager->expects($this->once())->method('getStore')->willReturn($storeMock);

        $this->assertIsInt($this->helper->getStoreId());
    }

    /**
     * Test correct name
     *
     * @param string $name
     * @param string $expected
     *
     * @return void
     * @dataProvider getNameDataProvider
     */
    public function testGetName($name, $expected): void
    {
        $this->assertSame($expected, $this->helper->getName($name));
    }

    /**
     * @return array
     * @see self::testGetName()
     */
    public function getNameDataProvider(): array
    {
        return [
            [
                'Fiko',
                'Fiko'
            ],
            [
                'Borizqy',
                'Borizqy'
            ],
        ];
    }

    /**
     * Test wrong name
     *
     * @param string $name
     * @param string $expected
     * @return void
     * @dataProvider wrongNameDataProvider
     */
    public function testWrongName($name, $expected): void
    {
        $this->assertNotSame($expected, $this->helper->getName($name));
    }

    /**
     * @return array
     * @see self::testWrongName()
     */
    public function wrongNameDataProvider(): array
    {
        return [
            [
                'Fiko Input',
                'Fiko Expected'
            ],
            [
                'Borizqy Input',
                'Borizqy Expected'
            ],
        ];
    }

    /**
     * Testing is borizqy
     *
     * @param string $surname
     * @param boolean $expected
     *
     * @return void
     * @dataProvider isBorizqyDataProvider
     */
    public function testIsBorizqy($surname, $expected)
    {
        $this->assertSame($expected, $this->helper->isBorizqy($surname));
    }

    /**
     * @return array
     * @see self::testIsBorizqy()
     */
    public function isBorizqyDataProvider()
    {
        return [
            ['Borizqy', true],
            ['borizqy', true],
            ['bORIZQY', true],
            ['BORIZQY', true],
            ['boRIZQY', true],
            ['Fiko', false],
        ];
    }
}
