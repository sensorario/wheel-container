<?php

namespace Sensorario\Container;

class Container 
{
    private $config;

    public function setConfiguration(array $config)
    {
        $this->config = $config;
    }

    public function get($serviceName)
    {
        $service = new $this->config[$serviceName]['class']();

        if (isset($this->config[$serviceName]['collaborators'])) {
            foreach ($this->config[$serviceName]['collaborators'] as $collaborator) {
                $service->addService(
                    $collaborator,
                    $this->get($collaborator)
                );
            }
        }

        return $service;
    }
}
