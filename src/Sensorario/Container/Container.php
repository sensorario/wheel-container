<?php

namespace Sensorario\Container;

class Container 
{
    private $config;

    private $services;

    public function setConfiguration(array $config)
    {
        $this->config = $config;
    }

    public function get($serviceName)
    {
        if (!isset($this->config[$serviceName]['class'])) {
            throw new \RuntimeException(
                'Undefined Service '.$serviceName.'!'
            );
        }

        if (!isset($this->services[$serviceName])) {
            $this->services[$serviceName] = new $this->config[$serviceName]['class']();

            if (isset($this->config[$serviceName]['collaborators'])) {
                foreach ($this->config[$serviceName]['collaborators'] as $collaborator) {
                    $this->services[$serviceName]->addService(
                        $collaborator,
                        $this->get($collaborator)
                    );
                }
            }
        }

        return $this->services[$serviceName];
    }
}
