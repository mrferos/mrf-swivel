<?php
namespace MrfSwivel\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zumba\Swivel\ManagerInterface;

class Swivel extends AbstractPlugin
{
    /**
     * @var ManagerInterface
     */
    private $manager;

    /**
     * @param ManagerInterface $manager
     */
    public function __construct(ManagerInterface $manager)
    {

        $this->manager = $manager;
    }

    /**
     * @return ManagerInterface
     */
    function __invoke()
    {
        return $this->manager;
    }


}