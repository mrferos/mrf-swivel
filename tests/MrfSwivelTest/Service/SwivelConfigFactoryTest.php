<?php
namespace MrfSwivelTest\Service;

use MrfSwivel\Service\SwivelConfigFactory;
use Zumba\Swivel\Map;

class SwivelConfigFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testNonExistentSwivelConfig()
    {
        $this->setExpectedException('\RuntimeException');

        $serviceLocator = $this->getMock('\Zend\ServiceManager\ServiceLocatorInterface');
        $serviceLocator->expects($this->any())
                        ->method('get')
                        ->with('Config')
                        ->willReturn(array());

        $swivelConfigFactory = new SwivelConfigFactory();
        $swivelConfigFactory->createService($serviceLocator);
    }

    public function testGetConfigWithControllerFactories()
    {
        $serviceLocator = $this->getMock('\Zend\ServiceManager\ServiceLocatorInterface');
        $serviceLocator->expects($this->once())
            ->method('get')
            ->with('Config')
            ->willReturn(array(
                'swivel' => array(
                    'controller_features' => array(
                        'test' => array(
                            'buckets' => array(1,2,3)
                        )
                    )
                )
            )
        );

        $swivelConfigFactory = new SwivelConfigFactory();
        $config = $swivelConfigFactory->createService($serviceLocator);
        $reflObject = new \ReflectionObject($config);
        $reflMap = $reflObject->getProperty('map');
        $reflMap->setAccessible(true);
        /** @var Map $map */
        $map = $reflMap->getValue($config);
        $this->assertArrayHasKey('test', $map->getMapData());
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