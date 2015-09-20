<?php
namespace MrfSwivelTest\Service;

use MrfSwivel\Service\SwivelFactory;

class SwivelFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testGetSwivel()
    {
        $serviceLocator = $this->getMock('\Zend\ServiceManager\ServiceLocatorInterface');
        $serviceLocator->expects($this->once())
                        ->method('get')
                        ->with('MrfSwivel\SwivelConfig')
                        ->willReturnCallback(function() {
                            $config =  $this->getMock('\Zumba\Swivel\ConfigInterface');
                            $config->expects($this->once())
                                    ->method('getLogger')
                                    ->willReturn($this->getMock('Psr\Log\LoggerInterface'));

                            return $config;
                        });

        $factory = new SwivelFactory();
        $swivel = $factory->createService($serviceLocator);

        $this->assertInstanceOf('\Zumba\Swivel\Manager', $swivel);
    }
}