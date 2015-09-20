<?php
namespace MrfSwivel\Service;

use Zumba\Swivel\ManagerInterface;

trait SwivelAwareTrait {

    /**
     * @var ManagerInterface
     */
    protected $swivel;

    /**
     * @param ManagerInterface $swivel
     */
    public function setSwivel(ManagerInterface $swivel)
    {
        $this->swivel = $swivel;
    }

    /**
     * @return ManagerInterface
     */
    public function getSwivel()
    {
        return $this->swivel;
    }
}