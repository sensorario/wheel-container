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

    public function test()
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
}
