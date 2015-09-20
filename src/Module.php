<?php
namespace MrfSwivel;

use Zend\ModuleManager\Feature\ConfigProviderInterface,
    Zend\ModuleManager\Feature\ControllerPluginProviderInterface;
use Zend\ServiceManager\AbstractPluginManager;

class Module implements
    ConfigProviderInterface,
    ControllerPluginProviderInterface
{
    /**
     * Returns configuration to merge with application configuration
     *
     * @return array|\Traversable
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getControllerPluginConfig()
    {
        return array(
            'swivel' => function(AbstractPluginManager $pluginManager) {
                $sm = $pluginManager->getServiceLocator();
                return $sm->get('MrfSwivel\Swivel');
            }
        );
    }
}