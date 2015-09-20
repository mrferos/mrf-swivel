<?php
namespace MrfSwivelTest\Controller\Plugin;

use MrfSwivel\Controller\Plugin\Swivel;

class SwivelTest extends \PHPUnit_Framework_TestCase
{
    public function testGetSwivel()
    {
        $managerMock = $this->getMock('\Zumba\Swivel\ManagerInterface');
        $swivel = new Swivel($managerMock);
        $this->assertInstanceOf('\Zumba\Swivel\ManagerInterface', $swivel());
    }
}