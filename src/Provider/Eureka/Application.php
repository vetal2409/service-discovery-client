<?php

namespace Vitsyd\ServiceDiscovery\Client\Provider\Eureka;

use Vitsyd\ServiceDiscovery\Client\ApplicationInterface;

/**
 * Class Application
 */
class Application implements ApplicationInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $instances = [];

    /**
     * Application constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function getInstances()
    {
        return $this->instances;
    }
}
