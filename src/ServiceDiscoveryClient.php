<?php

namespace Vitsyd\ServiceDiscovery\Client;

use Psr\Http\Message\ResponseInterface;

/**
 * Service Discovery Client
 */
interface ServiceDiscoveryClient
{
    /**
     * @param InstanceInterface $instance
     * @return ResponseInterface
     */
    public function register(InstanceInterface $instance);


    public function heartbeat();

    /**
     * @param string $id
     * @return InstanceInterface
     */
    public function getInstance($id);
}
