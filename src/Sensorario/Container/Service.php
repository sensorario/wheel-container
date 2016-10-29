<?php

namespace Sensorario\Container;

abstract class Service implements ServiceInterface
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
        return $this->collaborators[$collaboratorName];
    }
}
