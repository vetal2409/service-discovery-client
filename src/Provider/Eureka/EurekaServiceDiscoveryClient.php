<?php

namespace Vetal2409\ServiceDiscovery\Client\Provider\Eureka;

use GuzzleHttp\Psr7\Request;
use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use JMS\Serializer\SerializerBuilder;
use Vetal2409\ServiceDiscovery\Client\DataCenter;
use Vetal2409\ServiceDiscovery\Client\Instance;
use Vetal2409\ServiceDiscovery\Client\InstanceInterface;
use Vetal2409\ServiceDiscovery\Client\ServiceDiscoveryClientInterface;
use Vetal2409\ServiceDiscovery\Client\Application;

/**
 * Service Discovery Client
 */
class EurekaServiceDiscoveryClient implements ServiceDiscoveryClientInterface
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * @var MessageFactory
     */
    private $messageFactory;

    /**
     * EurekaServiceDiscoveryClient constructor.
     * @param string $url
     * @param HttpClient $httpClient
     * @param MessageFactory $messageFactory
     */
    public function __construct($url, HttpClient $httpClient, MessageFactory $messageFactory)
    {
        $this->url = $url;
        $this->httpClient = $httpClient;
        $this->messageFactory = $messageFactory;
    }

    /**
     * @inheritdoc
     */
    public function register(InstanceInterface $instance)
    {
        $serializer = SerializerBuilder::create()->build();

        $data = [
            'instance' => [
                'instanceId' => $instance->getId(),
                'hostName' => $instance->getHostname(),
                'ipAddr' => $instance->getIp(),
                'app' => $instance->getApplication()->getId(),
                'port' => [
                    '$' => $instance->getPort(),
                    '@enabled' => true
                ],
                'dataCenterInfo' => [
                    '@class' => 'com.netflix.appinfo.InstanceInfo$DefaultDataCenterInfo',
                    'name' => $instance->getDataCenter()->getId()
                ],
                'homePageUrl' => $this->url . '/sd/info',
                'statusPageUrl' => $this->url . '/sd/info'
            ]
        ];
        $json = $serializer->serialize($data, 'json');

        $requestUrl = sprintf('%s/eureka/apps/%s', $this->url, $instance->getApplication()->getId());
        $request = $this->messageFactory->createRequest(
            'POST',
            $requestUrl,
            ['Content-Type' => 'application/json'],
            $json
        );

        $response = $this->httpClient->sendRequest($request);
        return $response->getStatusCode() === 204;
    }


    /**
     * @inheritdoc
     */
    public function heartbeat($applicationId, $instanceId)
    {
        $requestUrl = sprintf('%s/eureka/apps/%s/%s', $this->url, $applicationId, $instanceId);
        $request = new Request('PUT', $requestUrl);
        $response = $this->httpClient->sendRequest($request);
        return $response->getStatusCode() === 200;
    }

    /**
     * @inheritdoc
     */
    public function getApplication($id)
    {
        $requestUrl = sprintf('%s/eureka/apps/%s', $this->url, $id);
        $request = $this->messageFactory->createRequest('GET', $requestUrl, ['Accept' => 'application/json']);
        $response = $this->httpClient->sendRequest($request);
        $content = $response->getBody()->getContents();

        $data = json_decode($content, true);
        /** @var array $dataInstances */
        $dataInstances = &$data['application']['instance'];

        $application = new Application($data['application']['name']);
        foreach ($dataInstances as $dataInstance) {
            $instance = new Instance($application, new DataCenter($dataInstance['dataCenterInfo']['name']));
            $instance->setHostname($dataInstance['hostName']);
            $instance->setIp($dataInstance['ipAddr']);
            $instance->setPort($dataInstance['port']['$']);

            $application->addInstance($instance);
        }

        return $application;
    }

    /**
     * @inheritdoc
     */
    public function getInstance($id)
    {
        $requestUrl = sprintf('%s/eureka/instances/%s', $this->url, $id);
        $request = $this->messageFactory->createRequest('GET', $requestUrl, ['Accept' => 'application/json']);
        $response = $this->httpClient->sendRequest($request);
        $content = $response->getBody()->getContents();

        $data = json_decode($content, true);
        /** @var array $dataInstances */
        $dataInstance = &$data['instance'];

        $application = new Application($dataInstance['app']);
        $instance = new Instance($application, new DataCenter($dataInstance['dataCenterInfo']['name']));
        $instance->setHostname($dataInstance['hostName']);
        $instance->setIp($dataInstance['ipAddr']);
        $instance->setPort($dataInstance['port']['$']);

        return $instance;
    }
}
