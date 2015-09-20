<?php
namespace MrfSwivelTest\Service;

use MrfSwivel\Service\SwivelAwareInitializer;

class SwivelAwareInitializerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $swivel;
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $locator;
    /**
     * @var SwivelAwareInitializer;
     */
    protected $initializer;

    public function setUp()
    {
        $this->swivel   = $this->getMock('Zumba\Swivel\ManagerInterface');
        $this->locator     = $this->getMock('Zend\\ServiceManager\\ServiceLocatorInterface');
        $this->initializer = new SwivelAwareInitializer();

        $this->locator->expects($this->any())
                        ->method('get')
                        ->willReturn($this->swivel);
    }

    public function testInitializeWithAuthorizeAwareObject()
    {
        $awareObject = $this->getMock('MrfSwivel\Service\SwivelAwareInterface');
        $awareObject->expects($this->once())
                        ->method('setSwivel')
                        ->with($this->swivel);

        $this->initializer->initialize($awareObject, $this->locator);
    }

    public function testInitializeWithSimpleObject()
    {
        $awareObject = $this->getMock('stdClass', array('setSwivel'));
        $awareObject->expects($this->never())
                        ->method('setSwivel');

        $this->initializer->initialize($awareObject, $this->locator);
    }
}