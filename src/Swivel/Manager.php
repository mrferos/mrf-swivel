<?php
namespace MrfSwivel\Swivel;

use Zumba\Swivel\Builder;
use Zumba\Swivel\Manager as SwivelManager;

class Manager extends SwivelManager
{
    /**
     * @var Builder[]
     */
    protected $features = array();

    /**
     * Create a new Builder instance
     *
     * @param string $slug
     * @return \Zumba\Swivel\Builder
     * @see \Zumba\Swivel\ManagerInterface
     */
    public function forFeature($slug)
    {
        $feature = parent::forFeature($slug);
        $this->features[$slug] = $feature;
        return $feature;
    }

    /**
     * @param string $slug
     * @return Builder
     */
    public function getFeature($slug)
    {
        if (!array_key_exists($slug, $this->features)) {
            return false;
        }

        return $this->features[$slug];
    }


}