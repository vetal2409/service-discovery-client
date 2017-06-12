<?php

namespace Vetal2409\ServiceDiscovery\Client;

/**
 * Application Interface
 */
interface ApplicationInterface
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @return InstanceInterface[]
     */
    public function getInstances();

    /**
     * @param array $instances
     * @return void
     */
    public function setInstances(array $instances);

    /**
     * @param InstanceInterface $instance
     * @return void
     */
    public function addInstance(InstanceInterface $instance);
}
