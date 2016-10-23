<?php

namespace Sensorario\Container;

abstract class Service
{
    protected $collaborators = [];

    public function addService(
        $collaboratorName,
        Service $collaborator
    ) {
        $this->collaborators[$collaboratorName] = $collaborator;
    }

    public function get($collaboratorName)
    {
        if (!isset($this->collaborators[$collaboratorName])) {
            throw new \RuntimeException(
                'Collaborator not found!'
            );
        }

        return $this->collaborators[$collaboratorName];
    }
}
