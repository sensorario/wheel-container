<?php

namespace Sensorario\Tests\Container;

use PHPUnit_Framework_TestCase;
use Sensorario\Container\Container;

class ContainerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Undefined Service
     */
    public function testUndefinedServiceIsCallThrowException()
    {
        $config = [];

        $container = new Container();
        $container->setConfiguration($config);

        $container->get('foo');
    }

    public function testCallingAServiceNameNewClassIsDefined()
    {
        $config = [
            'foo' => [
                'class' => '\\DateTime'
            ]
        ];

        $container = new Container();
        $container->setConfiguration($config);

        $service = $container->get('foo');

        $this->assertEquals(
            get_class(new \DateTime()),
            get_class($service)
        );
    }

    public function testAllowAccessToCollaboratorsViaGetMethod()
    {
        $config = [
            'data' => [
                'class' => '\\SensorarioDateTime',
            ],
            'foo' => [
                'class' => '\\EmptyService',
                'collaborators' => [
                    'data',
                ],
            ]
        ];

        $container = new Container();
        $container->setConfiguration($config);

        $service = $container->get('foo');

        $this->assertEquals(
            get_class(new \SensorarioDateTime()),
            get_class($service->get('data'))
        );
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Undefined Service
     */
    public function testThrowAnExceptionWhenCollaboratorNotExists()
    {
        $config = [
            'foo' => [
                'class' => '\\EmptyService',
            ]
        ];

        $container = new Container();
        $container->setConfiguration($config);

        $service = $container->get('bar');
    }
}
