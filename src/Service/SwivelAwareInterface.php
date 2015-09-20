<?php
namespace MrfSwivel\Service;

use Zumba\Swivel\ManagerInterface;

interface SwivelAwareInterface {
    /**
     * @param ManagerInterface $swivel
     * @return void
     */
    public function setSwivel(ManagerInterface $swivel);

    /**
     * @return ManagerInterface
     */
    public function getSwivel();
}