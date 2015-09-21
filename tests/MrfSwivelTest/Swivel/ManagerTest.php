<?php
namespace MrfSwivelTest\Swivel;

use MrfSwivel\Swivel\Manager;

class ManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetFeature()
    {
        $configInterface = $this->getMock('\Zumba\Swivel\ConfigInterface');
        $configInterface->expects($this->any())
                            ->method('getLogger')
                            ->willReturn($this->getMock('Psr\Log\LoggerInterface'));

        $configInterface->expects($this->any())
                            ->method('getBucket')
                            ->willReturn($this->getMock('\Zumba\Swivel\BucketInterface'));

        $manager = new Manager($configInterface);
        $feature = $manager->forFeature('test');

        $this->assertInstanceOf('\Zumba\Swivel\BuilderInterface', $manager->getFeature('test'));
    }

    public function testGetNonExistentFeature()
    {
        $configInterface = $this->getMock('\Zumba\Swivel\ConfigInterface');
        $configInterface->expects($this->any())
            ->method('getLogger')
            ->willReturn($this->getMock('Psr\Log\LoggerInterface'));

        $configInterface->expects($this->any())
            ->method('getBucket')
            ->willReturn($this->getMock('\Zumba\Swivel\BucketInterface'));

        $manager = new Manager($configInterface);
        $this->assertFalse($manager->getFeature('test'));
    }
}