<?php

namespace Vitsyd\ServiceDiscovery\Client\Provider\Eureka;

use Vitsyd\ServiceDiscovery\Client\ApplicationInterface;
use Vitsyd\ServiceDiscovery\Client\DataCenterInterface;
use Vitsyd\ServiceDiscovery\Client\InstanceInterface;

/**
 * Class Instance
 */
class Instance implements InstanceInterface
{
    /**
     * @var string
     */
    protected $hostname;

    /**
     * @var string
     */
    protected $ip;

    /**
     * @var Application
     */
    protected $application;

    /**
     * @var DataCenter
     */
    protected $dataCenter;

    /**
     * Instance constructor.
     * @param ApplicationInterface $application
     * @param DataCenter $dataCenter
     */
    public function __construct(ApplicationInterface $application, DataCenter $dataCenter)
    {
        $this->hostname = gethostname();
//        $this->application = $application
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
     * @return Application
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**
     * @param Application $application
     */
    public function setApplication(Application $application)
    {
        $this->application = $application;
    }

    /**
     * @return DataCenter
     */
    public function getDataCenter(): DataCenter
    {
        return $this->dataCenter;
    }

    /**
     * @param DataCenter $dataCenter
     */
    public function setDataCenter(DataCenter $dataCenter)
    {
        $this->dataCenter = $dataCenter;
    }
}
