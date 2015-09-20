<?php
namespace MrfSwivel\Route;

use MrfSwivel\Service\SwivelAwareInterface;
use MrfSwivel\Service\SwivelAwareTrait;
use MrfSwivel\Swivel\Manager;
use Zend\Mvc\MvcEvent;

class RouteEvent implements SwivelAwareInterface
{
    use SwivelAwareTrait;

    /**
     * The __invoke method is called when a script tries to call an object as a function.
     *
     * @return mixed
     * @link http://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     */
    function __invoke(MvcEvent $e)
    {
        /** @var Manager $manager */
        $manager = $this->getSwivel();
        $routeMatch = $e->getRouteMatch();
        $controllerName = $routeMatch->getParam('controller');
        $feature = $manager->getFeature($controllerName);
        if ($feature === false) {
            return;
        }

        $controllerService = $feature->execute();
        if (null === $controllerService) {
            return;
        }

        $routeMatch->setParam('controller', $controllerService);
    }

}