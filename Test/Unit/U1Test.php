<?php

declare(strict_types=1);

namespace Fiko\UnitTesting\Test\Unit;

use Magento\Cms\Controller\Adminhtml\Page\PostDataProcessor;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\Stdlib\DateTime\Filter\Date;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use Magento\Framework\View\Model\Layout\Update\ValidatorFactory;

/**
 * Class PostDataProcessorTest.
 */
class U1Test extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Date|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $dateFilterMock;

    /**
     * @var ManagerInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $messageManagerMock;

    /**
     * @var ValidatorFactory|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $validatorFactoryMock;

    /**
     * @var PostDataProcessor
     */
    protected $postDataProcessor;

    public function setUp(): void
    {
        $this->dateFilterMock = $this->getMockBuilder(Date::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->messageManagerMock = $this->getMockBuilder(ManagerInterface::class)
            ->getMockForAbstractClass();
        $this->validatorFactoryMock = $this->getMockBuilder(ValidatorFactory::class)
            ->disableOriginalConstructor()
            ->setMethods(['create'])
            ->getMock();

        $this->postDataProcessor = (new ObjectManager($this))->getObject(
            PostDataProcessor::class,
            [
                'dateFilter' => $this->dateFilterMock,
                'messageManager' => $this->messageManagerMock,
                'validatorFactory' => $this->validatorFactoryMock,
            ]
        );
    }

    public function testValidateRequireEntry()
    {
        $postData = [
            'title' => '',
        ];

        $tmp = $this->postDataProcessor;
        // header("Content-Type: application/json;");
        echo json_encode(is_object($tmp) ? get_class_methods($tmp) : $tmp);

        $this->messageManagerMock->expects($this->any())
            ->method('addError')
            ->with(__('To apply changes you should fill in hidden required "%1" field', 'Page Title'));

        $this->assertFalse($this->postDataProcessor->validateRequireEntry($postData));
    }
}
