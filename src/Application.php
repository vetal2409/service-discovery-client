<?php

namespace Vetal2409\ServiceDiscovery\Client;

/**
 * Class Application
 */
class Application implements ApplicationInterface
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var array
     */
    protected $instances = [];

    /**
     * Application constructor.
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getInstances()
    {
        return $this->instances;
    }

    public function setInstances(array $instances)
    {
        $this->instances = $instances;
    }

    public function addInstance(InstanceInterface $instance)
    {
        $this->instances[] = $instance;
    }
}
