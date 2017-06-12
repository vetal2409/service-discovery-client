<?php

namespace Vetal2409\ServiceDiscovery\Client;

/**
 * Interface InstanceInterface
 */
interface InstanceInterface
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @return string
     */
    public function getHostname();

    /**
     * @return string
     */
    public function getIp();

    /**
     * @return ApplicationInterface
     */
    public function getApplication();

    /**
     * @return DataCenterInterface
     */
    public function getDataCenter();

    /**
     * @return int
     */
    public function getPort();
}
