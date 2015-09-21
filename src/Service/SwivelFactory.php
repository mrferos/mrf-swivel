<?php
namespace MrfSwivel\Service;

use MrfSwivel\Swivel\Manager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zumba\Swivel\Config;
use Zumba\Swivel\ManagerInterface;

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
        $config = $serviceLocator->get('Config');
        $manager = new Manager($swivelConfig);

        if (array_key_exists('swivel', $config)
            && array_key_exists('controller_features', $config['swivel'])) {
            $this->attachFeatures($manager, $config['swivel']['controller_features']);
        }

        return $manager;
    }

    protected function attachFeatures(ManagerInterface $manager, $configs)
    {
        foreach ($configs as $key => $config) {
            $feature = $manager->forFeature($key);
            if (!array_key_exists('default', $config)) {
                $feature->noDefault();
            } else {
                $feature->defaultBehavior($config['default']);
            }

            if (array_key_exists('behaviors', $config)) {
                foreach ($config['behaviors'] as $slug => $strat) {
                    $feature->addBehavior($slug, $strat);
                }
            }
        }
    }
}