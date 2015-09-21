<?php
namespace MrfSwivelTest\Service;

use MrfSwivel\Service\SwivelFactory;
use Zumba\Swivel\Behavior;

class SwivelFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testGetSwivelWithControllerFeatures()
    {
        $serviceLocator = $this->getMock('\Zend\ServiceManager\ServiceLocatorInterface');
        $serviceLocator->expects($this->any())
            ->method('get')
            ->with($this->logicalOr(
                'MrfSwivel\SwivelConfig',
                'Config'
            ))
            ->willReturnCallback(function($value) {
                switch ($value) {
                    case 'Config':
                        return array(
                            'swivel' => array(
                                'controller_features' => array(
                                    'test' => array(
                                        'buckets' => [1,2,3],
                                        'behaviors' => array(
                                            'versionA' => 'test1'
                                        )
                                    )
                                )
                            )
                        );
                    case 'MrfSwivel\SwivelConfig':
                        $config =  $this->getMock('\Zumba\Swivel\ConfigInterface');
                        $config->expects($this->once())
                            ->method('getLogger')
                            ->willReturn($this->getMock('Psr\Log\LoggerInterface'));

                        $config->expects($this->once())
                            ->method('getBucket')
                            ->willReturnCallback(function() {
                                $bucketMock = $this->getMock('\Zumba\Swivel\BucketInterface');
                                $bucketMock->expects($this->any())
                                            ->method('enabled')
                                            ->willReturnCallback(function(Behavior $e) {
                                                $this->assertContains('test', $e->getSlug());
                                            });


                                return $bucketMock;
                            });

                        return $config;
                }
            });

        $factory = new SwivelFactory();
        $swivel = $factory->createService($serviceLocator);

        $this->assertInstanceOf('\Zumba\Swivel\Manager', $swivel);
    }

    public function testGetSwivel()
    {
        $serviceLocator = $this->getMock('\Zend\ServiceManager\ServiceLocatorInterface');
        $serviceLocator->expects($this->any())
                        ->method('get')
                        ->with($this->logicalOr(
                            'MrfSwivel\SwivelConfig',
                            'Config'
                        ))
                        ->willReturnCallback(function($value) {
                            switch ($value) {
                                case 'Config':
                                    return array();
                                case 'MrfSwivel\SwivelConfig':
                                    $config =  $this->getMock('\Zumba\Swivel\ConfigInterface');
                                    $config->expects($this->once())
                                        ->method('getLogger')
                                        ->willReturn($this->getMock('Psr\Log\LoggerInterface'));

                                    return $config;
                            }
                        });

        $factory = new SwivelFactory();
        $swivel = $factory->createService($serviceLocator);

        $this->assertInstanceOf('\Zumba\Swivel\Manager', $swivel);
    }
}