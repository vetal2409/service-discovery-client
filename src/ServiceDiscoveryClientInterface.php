<?php

namespace Vetal2409\ServiceDiscovery\Client;

/**
 * Service Discovery Client Interface
 */
interface ServiceDiscoveryClientInterface
{
    /**
     * @param InstanceInterface $instance
     * @return bool
     */
    public function register(InstanceInterface $instance);

    /**
     * @param int $applicationId
     * @param int $instanceId
     * @return bool
     */
    public function heartbeat($applicationId, $instanceId);

    /**
     * @param string $id
     * @return ApplicationInterface
     */
    public function getApplication($id);

    /**
     * @param string $id
     * @return InstanceInterface
     */
    public function getInstance($id);
}
