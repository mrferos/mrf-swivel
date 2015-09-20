<?php
namespace MrfSwivelTest\Service;

class SwivelAwareTraitTest extends \PHPUnit_Framework_TestCase
{
    public static function setUpBeforeClass()
    {
        if (!class_exists('TestAwareClass')) {
            include __DIR__ . '/../../fixtures/TestAwareClass.php';
        }
    }

    public function testTrait()
    {
        $managerMock = $this->getMock('\Zumba\Swivel\ManagerInterface');

        $testAwareClass = new \TestAwareClass();
        $testAwareClass->setSwivel($managerMock);

        $this->assertInstanceOf('\Zumba\Swivel\ManagerInterface', $testAwareClass->getSwivel());
    }
}