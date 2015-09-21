<?php
namespace MrfSwivel;

use MrfSwivel\Route\RouteEvent;
use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface,
    Zend\ModuleManager\Feature\ControllerPluginProviderInterface,
    Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\Mvc\Application;
use Zend\Mvc\MvcEvent;
use Zend\ServiceManager\AbstractPluginManager;

class Module implements
    ConfigProviderInterface,
    ControllerPluginProviderInterface,
    BootstrapListenerInterface
{
    /**
     * Listen to the bootstrap event
     *
     * @param EventInterface $e
     * @return array
     */
    public function onBootstrap(EventInterface $e)
    {
        /** @var Application $app */
        $app = $e->getApplication();
        $serviceLocator = $app->getServiceManager();
        /** @var RouteEvent $featureDispatchEvent */
        $routeEvent = $serviceLocator->get('MrfSwivel\Route\RouteEvent');

        /** @var EventManagerInterface $eventManager */
        $eventManager = $app->getEventManager();
        $eventManager->attach(MvcEvent::EVENT_ROUTE, $routeEvent);
    }

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