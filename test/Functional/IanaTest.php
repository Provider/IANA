<?php
namespace ScriptFUSIONTest\Porter\Provider\Iana\Functional;

use Psr\Container\ContainerInterface;
use ScriptFUSION\Porter\Porter;
use ScriptFUSION\Porter\Provider\Iana\Provider\IanaProvider;

abstract class IanaTest extends \PHPUnit_Framework_TestCase
{
    /** @var Porter */
    protected $porter;

    protected function setUp()
    {
        $this->porter = (new Porter(
            \Mockery::mock(ContainerInterface::class)
                ->shouldReceive('has')
                    ->with(IanaProvider::class)
                    ->andReturn(true)
                ->shouldReceive('get')
                    ->with(IanaProvider::class)
                    ->andReturn(new IanaProvider)
                ->getMock()
        ));
    }
}
