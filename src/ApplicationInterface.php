<?php

namespace Vitsyd\ServiceDiscovery\Client;

/**
 * Application Interface
 */
interface ApplicationInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @return InstanceInterface[]
     */
    public function getInstances();
}
