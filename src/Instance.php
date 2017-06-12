<?php

namespace Vetal2409\ServiceDiscovery\Client;

/**
 * Class Instance
 */
class Instance implements InstanceInterface
{
    /**
     * @var ApplicationInterface
     */
    protected $application;

    /**
     * @var DataCenterInterface
     */
    protected $dataCenter;

    /**
     * @var string
     */
    protected $hostname;

    /**
     * @var string
     */
    protected $ip;

    /**
     * @var int
     */
    protected $port;

    /**
     * Instance constructor.
     * @param ApplicationInterface $application
     * @param DataCenterInterface $dataCenter
     */
    public function __construct(ApplicationInterface $application, DataCenterInterface $dataCenter)
    {
        $this->application = $application;
        $this->dataCenter = $dataCenter;
        $this->hostname = gethostname();
        $this->port = 80;
    }

    public function getId()
    {
        return sprintf('%s:%s:%s', $this->getHostname(), $this->getApplication()->getId(), $this->getPort());
    }

    public function setHostname($hostname)
    {
        $this->hostname = $hostname;
    }

    public function getHostname()
    {
        return $this->hostname;
    }

    public function getIp()
    {
        return gethostbyname($this->getHostname());
    }

    /**
     * @param string $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * @return ApplicationInterface
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**
     * @param ApplicationInterface $application
     */
    public function setApplication(ApplicationInterface $application)
    {
        $this->application = $application;
    }

    /**
     * @return DataCenterInterface
     */
    public function getDataCenter()
    {
        return $this->dataCenter;
    }

    /**
     * @param DataCenterInterface $dataCenter
     */
    public function setDataCenter(DataCenterInterface $dataCenter)
    {
        $this->dataCenter = $dataCenter;
    }

    /**
     * @return int
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param int $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }
}
