<?php

namespace Sensorario\Container;

interface ServiceInterface
{
    public function addService($identifier, Service $service);

    public function get($identifier);
}
