<?php
namespace MrfSwivel\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zumba\Swivel\Config;
use Zumba\Swivel\Manager;

class SwivelFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var Config $swivelConfig */
        $swivelConfig = $serviceLocator->get('MrfSwivel\SwivelConfig');
        return new Manager($swivelConfig);
    }
}