<?php

namespace Vitsyd\ServiceDiscovery\Client\Provider\Eureka;

use Vitsyd\ServiceDiscovery\Client\ApplicationInterface;
use Vitsyd\ServiceDiscovery\Client\DataCenterInterface;
use Vitsyd\ServiceDiscovery\Client\InstanceInterface;

class DataCenter implements DataCenterInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @param string $name
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
}
