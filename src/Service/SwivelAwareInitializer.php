<?php
namespace MrfSwivel\Service;

use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zumba\Swivel\ManagerInterface;

class SwivelAwareInitializer implements InitializerInterface
{
    /**
     * Initialize
     *
     * @param $instance
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function initialize($instance, ServiceLocatorInterface $serviceLocator)
    {
        if ($instance instanceof SwivelAwareInterface) {
            /** @var ManagerInterface $swivelService */
            $swivelService = $serviceLocator->get('MrfSwivel\Swivel');
            $instance->setSwivel($swivelService);
        }
    }

}