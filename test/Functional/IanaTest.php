<?php
declare(strict_types=1);

namespace ScriptFUSIONTest\Porter\Provider\Iana\Functional;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use ScriptFUSION\Porter\Porter;
use ScriptFUSION\Porter\Provider\Iana\Provider\IanaProvider;

abstract class IanaTest extends TestCase
{
    /** @var Porter */
    protected $porter;

    protected function setUp(): void
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
