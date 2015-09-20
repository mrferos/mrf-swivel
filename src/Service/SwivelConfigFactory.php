<?php
namespace MrfSwivel\Service;

use Zend\EventManager\EventManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zumba\Swivel\Config;

class SwivelConfigFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var array $config */
        $config = $serviceLocator->get('Config');
        if (!array_key_exists('swivel', $config)
            || !array_key_exists('features', $config['swivel'])) {
            throw new \RuntimeException('Could not find swivel.features configuration');
        }

        return new Config($config['swivel']['features']);
    }

}