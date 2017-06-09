<?php

namespace Vitsyd\ServiceDiscovery\Client;

/**
 * Interface InstanceInterface
 */
interface InstanceInterface
{
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
    public function getApp();

    /**
     * @return DataCenterInterface
     */
    public function getDataCenter();
}
