<?php
namespace MrfSwivelTest\Service;

use MrfSwivel\Service\SwivelConfigFactory;

class SwivelConfigFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testNonExistentSwivelConfig()
    {
        $this->setExpectedException('\RuntimeException');

        $serviceLocator = $this->getMock('\Zend\ServiceManager\ServiceLocatorInterface');
        $serviceLocator->expects($this->once())
                        ->method('get')
                        ->with('Config')
                        ->willReturn(array());

        $swivelConfigFactory = new SwivelConfigFactory();
        $swivelConfigFactory->createService($serviceLocator);
    }

    public function testNonExistentFeatureConfig()
    {
        $this->setExpectedException('\RuntimeException');

        $serviceLocator = $this->getMock('\Zend\ServiceManager\ServiceLocatorInterface');
        $serviceLocator->expects($this->once())
            ->method('get')
            ->with('Config')
            ->willReturn(array('swivel' => array()));

        $swivelConfigFactory = new SwivelConfigFactory();
        $swivelConfigFactory->createService($serviceLocator);
    }

    public function testGetConfig()
    {
        $serviceLocator = $this->getMock('\Zend\ServiceManager\ServiceLocatorInterface');
        $serviceLocator->expects($this->once())
            ->method('get')
            ->with('Config')
            ->willReturn(array('swivel' => array('features' => array())));

        $swivelConfigFactory = new SwivelConfigFactory();
        $config = $swivelConfigFactory->createService($serviceLocator);
        $this->assertInstanceOf('\Zumba\Swivel\Config', $config);
    }
}