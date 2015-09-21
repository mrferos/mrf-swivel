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
     * @return Config
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var array $config */
        $config = $serviceLocator->get('Config');
        if (!array_key_exists('swivel', $config)) {
            throw new \RuntimeException('Could not find swivel config');
        }

        $swivelConfig = array_key_exists('features', $config['swivel']) ?
                            $config['swivel']['features'] : array();

        if (array_key_exists('controller_features', $config['swivel'])) {
            foreach ($config['swivel']['controller_features'] as $key => $controllerConfig) {
                if (array_key_exists('buckets', $controllerConfig)) {
                    $swivelConfig[$key] = $controllerConfig['buckets'];
                }
            }
        }

        return new Config($swivelConfig);
    }

}